/*!
 * *****************************************************************************
 * [futu-no JavaScript]
 * @URL:     http://trs.mn/blog/futu-no/
 * @License: MIT License
 * *****************************************************************************
!*/

// =============================================================================
// Polyfill
// =============================================================================

// =======================
// Passive Event Listeners
// =======================

var supportsPassive = false;
try {
  var opts = Object.defineProperty({}, 'passive', {
    get: function() {
      supportsPassive = true;
    }
  });
  window.addEventListener('test', null, opts);
} catch (e) {}

// =====================
// requestAnimationFrame
// =====================

window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame;

// =============================================================================
// Mainstream
// =============================================================================

{
  'use strict';

  // ==============
  // グローバル変数
  // ==============

  const $meta_theme_color = document.querySelector('meta[name="theme-color"]');
  const $body = document.getElementsByTagName('body')[0];
  const $header = document.getElementsByTagName('header')[0];
  const $drawer = document.getElementsByClassName('drawer')[0];

  // ============
  // テーマカラー
  // ============

  // <header> border-top-colorからアクセントカラーを取得
  const color_accent = getComputedStyle($header).borderTopColor;
  // <.drawer> background-colorからサブカラーを取得
  const color_sub = getComputedStyle($drawer).backgroundColor;
  // テーマカラーセット
  $meta_theme_color.setAttribute('content', color_accent);

  // ================
  // DOMContentLoaded
  // ================

  document.addEventListener('DOMContentLoaded', function(e) {
    const menu = new MENU();
    const html_support = new HTML_SUPPORT();
  }, false);

  // =============================================================================
  // メニュー
  // =============================================================================

  class MENU {

    constructor() {
      this.scroll_header();
      this.drawer();
      this.search_form();
      this.share_overlay();
    }

    // ===============================
    // ヘッダー スクロール表示切り替え
    // ===============================

    scroll_header() {
      // 起動させるスクロール座標
      const offset = 80;

      window.addEventListener('scroll', event_interval, supportsPassive ? {
        passive: true
      } : false);
      document.addEventListener('touchmove', event_interval, supportsPassive ? {
        passive: true
      } : false);

      // イベント発火調整
      function event_interval() {
        window.requestAnimationFrame(toggle);
      }

      // 表示切り替え
      function toggle() {
        if (window.pageYOffset > offset) {
          $body.classList.add('show-scroll-header');
        } else {
          $body.classList.remove('show-scroll-header');
        }
      }
      toggle();

    }

    // ========
    // ドロワー
    // ========

    drawer() {
      const $toggle = document.getElementsByClassName('js-drawer-toggle')[0];
      $toggle.addEventListener('click', function() {

        // 開く
        if (!$body.classList.contains('show-drawer')) {
          // ステータス変更
          $body.classList.remove('show-search-form');
          $body.classList.add('show-drawer');
          // テーマカラー変更
          $meta_theme_color.setAttribute('content', color_sub);
          $header.style.borderTopColor = color_sub;
        }

        // 閉じる
        else {
          // ステータス変更
          $body.classList.remove('show-drawer');
          // テーマカラー変更
          $meta_theme_color.setAttribute('content', color_accent);
          $header.style.borderTopColor = color_accent;
        }

      }, false);
    }

    // ============
    // 検索フォーム
    // ============

    search_form() {

      // 開く
      const $open = document.getElementsByClassName('js-search-form-open')[0];
      $open.addEventListener('click', function() {
        // ステータス変更
        $body.classList.remove('show-drawer');
        $body.classList.add('show-search-form');
        // テーマカラー変更
        $meta_theme_color.setAttribute('content', color_sub);
        $header.style.borderTopColor = color_sub;
      }, false);

      // 閉じる
      const $close = document.getElementsByClassName('js-search-form-close')[0];
      $close.addEventListener('click', function() {
        // ステータス変更
        $body.classList.remove('show-search-form');
        // テーマカラー変更
        $meta_theme_color.setAttribute('content', color_accent);
        $header.style.borderTopColor = color_accent;
      }, false);

    }

    // ================
    // 共有オーバーレイ
    // ================

    share_overlay() {

      // 開く
      const $open = document.getElementsByClassName('js-share-overlay-open')[0];
      $open.addEventListener('click', function() {
        // ステータス変更
        $body.classList.add('show-share-overlay');
        // 背景スクロール開始
        background_scroll('start');
      }, false);

      // 閉じる
      const $close = document.getElementsByClassName('js-share-overlay-close')[0];
      $close.addEventListener('click', function() {
        // ステータス変更
        $body.classList.remove('show-share-overlay');
        // 背景スクロール停止
        background_scroll('stop');
      }, false);

      // ==================
      // 背景スクロール演出
      // ==================

      let timer;

      function background_scroll(arg_state) {

        // 開始
        if (arg_state === 'start') {
          timer = setInterval(function() {
            if (window.pageYOffset === document.body.scrollHeight - window.innerHeight) {
              window.scrollTo(0, 0);
            } else {
              window.scrollBy(0, 1);
            }
          }, 30);
        }

        // 停止
        else if (arg_state === 'stop') {
          clearInterval(timer);
        }

      }

    }

  }

  // =============================================================================
  // HTML 機能補完
  // =============================================================================

  class HTML_SUPPORT {

    constructor() {
      this.smooth_scroll();
      if (document.querySelector('pre code') != null) {
        this.source_highlight();
      }
      if (document.getElementsByTagName('video')[0] != null) {
        this.inline_playing_video();
      }
    }

    // ==================
    // スムーススクロール
    // ==================

    // [API]
    // sweet-scroll.js
    // https://github.com/tsuyoshiwada/sweet-scroll

    smooth_scroll() {
      const sweetScroll = new SweetScroll({
        // トリガーとなる要素をCSSセレクタで指定
        trigger: '.js-scroll',
        // 固定ヘッダをCSSセレクタで指定
        header: 'header',
        // アニメーション再生時間のミリ秒
        duration: 900,
        // アニメーション開始までの遅延ミリ秒
        delay: 0,
        // イージングのタイプ（デフォルト：easeOutQuint）
        easing: 'easeOutExpo',
        // スクロール位置のオフセット
        offset: 0,
        // 垂直方向のスクロールを許可
        verticalScroll: true,
        // 水平方向のスクロールを許可 (デフォルトでは無効)
        horizontalScroll: false,
        // ホイール・タッチイベントが発生した時にスクロールを停止
        stopScroll: true,

        // Callbacks

        // スクロールが始まる前 (return falseでキャンセル可)
        beforeScroll: null,
        // スクロールが終わった時
        afterScroll: null,
        // スクロールがキャンセルされた時
        cancelScroll: null
      });
    }

    // ================
    // コードハイライト
    // ================

    // [API]
    // highlight.js
    // https://highlightjs.org/

    source_highlight() {
      hljs.initHighlightingOnLoad();
    }

    // ====================
    // 動画のインライン再生
    // ====================

    inline_playing_video() {
      const $video = document.getElementsByTagName('video');
      for (let i = 0; i < $video.length; i++) {
        $video[i].setAttribute('webkit-playsinline', 'webkit-playsinline');
      }
    }

  }

}
