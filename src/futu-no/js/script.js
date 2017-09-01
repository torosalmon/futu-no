/*!
 * *****************************************************************************
 * [futu-no JavaScript]
 * @URL:     http://trs.mn/blog/futu-no/
 * @License: MIT License
 * *****************************************************************************
!*/

// =============================================================================
// init
// =============================================================================

// Passive Event Listeners - Feature Detection
var supportsPassive = false;
try {
  var opts = Object.defineProperty({}, 'passive', {
    get: function() {
      supportsPassive = true;
    }
  });
  window.addEventListener('test', null, opts);
}
catch(e) {}

// requestAnimationFrame - Vendor Prefix
let requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
window.requestAnimationFrame = requestAnimationFrame;

// =============================================================================
// DOMContentLoaded
// =============================================================================

document.addEventListener('DOMContentLoaded', function(e) {
  'use strict';

  // ==============
  // グローバル変数
  // ==============

  const $body   = document.getElementsByTagName('body')[0];
  const $header = document.getElementsByTagName('header')[0];
  const $drawer = document.getElementsByClassName('drawer')[0];

  // ============
  // テーマカラー
  // ============

  // <header> border-top-colorからアクセントカラーを取得
  let color_accent = getComputedStyle($header);
      color_accent = color_accent.borderTopColor;

  // <.drawer> background-colorからサブカラーを取得
  let color_sub = getComputedStyle($drawer);
      color_sub = color_sub.backgroundColor;

  // テーマカラーセット
  let $meta_accent_color = document.querySelector('meta[name="theme-color"]');
      $meta_accent_color.setAttribute('content', color_accent);

// =============================================================================
// メニュー
// =============================================================================

  class menu {

    constructor() {
      this.scroll_header();
      this.drawer();
      this.share_overlay();
      this.search_form();
    }

    // ===============================
    // ヘッダー スクロール表示切り替え
    // ===============================

    scroll_header() {
      const offset = 80; // 起動させるスクロール座標

      window.addEventListener('scroll', event_interval, supportsPassive ? { passive: true } : false);
      document.addEventListener('touchmove', event_interval, supportsPassive ? { passive: true } : false);

      function event_interval() {
        window.requestAnimationFrame(toggle);
      }

      // 表示切り替え
      function toggle() {
        if(window.pageYOffset > offset) {
          $body.classList.add('show-scroll-header');
        }
        else {
          $body.classList.remove('show-scroll-header');
        }
      }
      toggle();
    }

    // ========
    // ドロワー
    // ========

    drawer() {

      // ============
      // ドロワー開閉
      // ============

      const $toggle = document.getElementsByClassName('js-drawer-toggle')[0];
      $toggle.addEventListener('click', function() {
        if(!$body.classList.contains('show-drawer')) {
          $body.classList.remove('show-search-form');
          $body.classList.add('show-drawer');

          $meta_accent_color.setAttribute('content', color_sub);
          $header.style.borderTopColor = color_sub;
        }
        else {
          $body.classList.remove('show-drawer');

          $meta_accent_color.setAttribute('content', color_accent);
          $header.style.borderTopColor = color_accent;
        }
      }, false);
    }

    // ================
    // 共有オーバーレイ
    // ================

    share_overlay() {

      // ================
      // オーバーレイ開閉
      // ================

      const $open = document.getElementsByClassName('js-share-overlay-open')[0];
      $open.addEventListener('click', function() {
        $body.classList.add('show-share-overlay');

        // 背景スクロール開始
        background_scroll('start');
      }, false);

      const $close = document.getElementsByClassName('js-share-overlay-close')[0];
      $close.addEventListener('click', function() {
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
        if(arg_state === 'start') {
          timer = setInterval(function() {
            if(window.pageYOffset === document.body.scrollHeight - window.innerHeight) {
              window.scrollTo(0, 0);
            }
            else {
              window.scrollBy(0, 1);
            }
          }, 30);
        }

        // 停止
        else if(arg_state === 'stop') {
          clearInterval(timer);
        }
      }

    }

    // ============
    // 検索フォーム
    // ============

    search_form() {

      // ============
      // フォーム開閉
      // ============

      const $open = document.getElementsByClassName('js-search-form-open')[0];
      $open.addEventListener('click', function() {
        $body.classList.remove('show-drawer');
        $body.classList.add('show-search-form');

        $meta_accent_color.setAttribute('content', color_sub);
        $header.style.borderTopColor = color_sub;
      }, false);

      const $close = document.getElementsByClassName('js-search-form-close')[0];
      $close.addEventListener('click', function() {
        $body.classList.remove('show-search-form');

        $meta_accent_color.setAttribute('content', color_accent);
        $header.style.borderTopColor = color_accent;
      }, false);
    }

  }

  const Menu = new menu();

// =============================================================================
// HTML 機能補完
// =============================================================================

  class html_upgrade {

    constructor() {
      this.smooth_scroll();
      if(document.querySelector('pre code') != null) {
        this.source_highlight();
      }
      if(document.getElementsByTagName('video')[0] != null) {
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
        trigger: '.js-scroll',   // トリガーとなる要素をCSSセレクタで指定
        header: 'header',        // 固定ヘッダをCSSセレクタで指定
        duration: 900,           // アニメーション再生時間のミリ秒
        delay: 0,                // アニメーション開始までの遅延ミリ秒
        easing: 'easeOutExpo',   // イージングのタイプ（デフォルト：easeOutQuint）
        offset: 0,               // スクロール位置のオフセット
        verticalScroll: true,    // 垂直方向のスクロールを許可
        horizontalScroll: false, // 水平方向のスクロールを許可 (デフォルトでは無効)
        stopScroll: true,        // ホイール・タッチイベントが発生した時にスクロールを停止

        // Callbacks
        beforeScroll: null,      // スクロールが始まる前 (return falseでキャンセル可)
        afterScroll: null,       // スクロールが終わった時
        cancelScroll: null       // スクロールがキャンセルされた時
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
      for(let i = 0; i < $video.length; i ++) {
        $video[i].setAttribute('webkit-playsinline', 'webkit-playsinline');
      }
    }

  }

  const HTML_upgrade = new html_upgrade();

}, false);
