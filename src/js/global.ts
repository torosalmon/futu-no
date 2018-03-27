/*!
 * *****************************************************************************
 * [futu-no JavaScript] - http://trs.mn/blog/futu-no/
 * @Author:  trs
 * @License: MIT License
 *
 * [sweet-scroll] v3.0.0 - https://github.com/tsuyoshiwada/sweet-scroll
 * @Author:  tsuyoshiwada
 * @License: MIT License
 * *****************************************************************************
!*/

{

  // =============================================================================
  // グローバル変数
  // =============================================================================

  // 設定
  const header_change_trigger_y: number = 160; // ヘッダー表示を切り替えるブレイクポイント

  // class instance
  let ux;
  let theme_color;
  let header;
  let search_form;
  let drawer;
  let share;

  // DOM
  const $meta_theme_color:   NodeListOf <HTMLElement>     = document.querySelectorAll('meta[name="theme-color"]');
  const $body:               NodeListOf <HTMLBodyElement> = document.getElementsByTagName('body');
  const $header:             HTMLCollectionOf <Element>   = document.getElementsByClassName('js--header');
  const $search_form_button: HTMLCollectionOf <Element>   = document.getElementsByClassName('js--search-form-button');
  const $drawer_button:      HTMLCollectionOf <Element>   = document.getElementsByClassName('js--drawer-button');
  const $share_button:       HTMLCollectionOf <Element>   = document.getElementsByClassName('js--share-button');
  const $overlay:            HTMLCollectionOf <Element>   = document.getElementsByClassName('js--overlay');

  // =============================================================================
  // メインスレッド
  // =============================================================================

  // ================
  // DOMContentLoaded
  // ================

  document.addEventListener('DOMContentLoaded', () => {
    ux          = new UX();
    theme_color = new THEME_COLOR();
    header      = new HEADER();
    search_form = new SEARCH_FORM();
    drawer      = new DRAWER();
    share       = new SHARE();
  }, {
    once:    true,
    passive: false,
    capture: true
  });

  // =============================================================================
  // UX
  // =============================================================================

  class UX {

    constructor() {

      // スムーススクロール
      if(document.getElementsByClassName('js--scroll')[0] != null) {
        this.smooth_scroll();
      }
    }

    // ==================
    // スムーススクロール
    // ==================

    private smooth_scroll(): void {

      // sweet-scroll
      const sweetScroll = new SweetScroll({
        trigger:          '.js--scroll', // トリガーとなる要素をCSSセレクタで指定
        header:           '.js--header', // 固定ヘッダをCSSセレクタで指定
        duration:         900,           // アニメーション再生時間のミリ秒
        delay:            0,             // アニメーション開始までの遅延ミリ秒
        easing:           'easeOutExpo', // イージングのタイプ（デフォルト：easeOutQuint）
        offset:           0,             // スクロール位置のオフセット
        verticalScroll:   true,          // 垂直方向のスクロールを許可
        horizontalScroll: false,         // 水平方向のスクロールを許可 (デフォルトでは無効)
        stopScroll:       true,          // ホイール・タッチイベントが発生した時にスクロールを停止

        // Callbacks
        beforeScroll: null, // スクロールが始まる前 (return falseでキャンセル可)
        afterScroll:  null, // スクロールが終わった時
        cancelScroll: null, // スクロールがキャンセルされた時
      });
    }

  }

  // =============================================================================
  // <meta theme-color>の切り替え
  // =============================================================================

  class THEME_COLOR {

    private main_color:    string; // <body> border-top-color
    private sub_color:     string; // <body> border-bottom-color
    private current_color: string; // 現在適用されている色

    constructor() {

      // <meta theme-color>の初期色指定
      this.main_color    = getComputedStyle($body[0]).borderTopColor;
      this.sub_color     = getComputedStyle($body[0]).borderBottomColor;
      this.current_color = this.main_color;

      $meta_theme_color[0].setAttribute('content', this.current_color);
    }

    // ========
    // 切り替え
    // ========

    public change(): void {
      const $header_cast = $header as HTMLCollectionOf<HTMLElement>;

      // sub_colorへ変更
      if($body[0].classList.contains('state--show-drawer') || $body[0].classList.contains('state--show-search-form')) {
        $meta_theme_color[0].setAttribute('content', this.sub_color);
        $header_cast[0].style.borderTopColor = this.sub_color;

        this.current_color = this.sub_color;
      }

      // main_colorへ変更
      else {
        $meta_theme_color[0].setAttribute('content', this.main_color);
        $header_cast[0].style.borderTopColor = this.main_color;

        this.current_color = this.main_color;
      }
    }

  }

  // =============================================================================
  // ヘッダーの切り替え
  // =============================================================================

  class HEADER {

    constructor() {
      window.addEventListener('scroll', this.change, {
        once:    false,
        passive: true,
        capture: true
      });
      document.addEventListener('touchmove', this.change, {
        once:    false,
        passive: true,
        capture: true
      });
    }

    // ========
    // 切り替え
    // ========

    private change(): void {
      if(header_change_trigger_y < window.pageYOffset) {
        $body[0].classList.add('state--show-scroll-header');
      } else {
        $body[0].classList.remove('state--show-scroll-header');
      }
    }

  }

  // =============================================================================
  // 検索フォーム
  // =============================================================================

  class SEARCH_FORM {

    constructor() {
      for(let i: number = 0; i < $search_form_button.length; i += 1) {
        $search_form_button[i].addEventListener('click', this.change, {
          once:    false,
          passive: false,
          capture: false
        });
      }
    }

    // ============
    // 表示切り替え
    // ============

    private change(): void {

      // ====
      // 開く
      // ====

      if(!$body[0].classList.contains('state--show-search-form')) {

        // ドロワーが開いていたら閉じる
        if($body[0].classList.contains('state--show-drawer')) {
          $body[0].classList.remove('state--show-drawer');
          $body[0].classList.remove('state--show-overlay');
          $overlay[0].removeEventListener('click', drawer.change, false);
        }

        // 共有が開いていたら閉じる
        if($body[0].classList.contains('state--show-share')) {
          $body[0].classList.remove('state--show-share');
          $body[0].classList.remove('state--show-overlay');
          $overlay[0].removeEventListener('click', share.change, false);

          // 背景スクロール停止
          share.background_scroll(false);
        }

        $body[0].classList.add('state--show-search-form');
      }

      // ======
      // 閉じる
      // ======

      else {
        $body[0].classList.remove('state--show-search-form');
      }

      // テーマカラー変更
      theme_color.change();
    }

  }

  // =============================================================================
  // ドロワー
  // =============================================================================

  class DRAWER {

    constructor() {
      for(let i: number = 0; i < $drawer_button.length; i += 1) {
        $drawer_button[i].addEventListener('click', this.change, {
          once:    false,
          passive: false,
          capture: false
        });
      }
    }

    // ============
    // 表示切り替え
    // ============

    public change(): void {

      // ====
      // 開く
      // ====

      if(!$body[0].classList.contains('state--show-drawer')) {

        // 共有が開いていたら閉じる
        if($body[0].classList.contains('state--show-share')) {
          $body[0].classList.remove('state--show-share');
          $overlay[0].removeEventListener('click', share.change, false);

          // 背景スクロール停止
          share.background_scroll(false);
        }

        $body[0].classList.add('state--show-drawer');
        $body[0].classList.add('state--show-overlay');

        // オーバーレイクリックで表示解除
        $overlay[0].addEventListener('click', drawer.change, {
          once:    true,
          passive: false,
          capture: false
        });
      }

      // ======
      // 閉じる
      // ======

      else {
        $body[0].classList.remove('state--show-drawer');
        $body[0].classList.remove('state--show-overlay');
        $overlay[0].removeEventListener('click', drawer.change, false);
      }

      // テーマカラー変更
      theme_color.change();
    }

  }

  // =============================================================================
  // 共有
  // =============================================================================

  class SHARE {

    private timer: number;

    constructor() {
      for(let i: number = 0; i < $share_button.length; i += 1) {
        $share_button[i].addEventListener('click', this.change, {
          once:    false,
          passive: false,
          capture: false
        });
      }
    }

    // ============
    // 表示切り替え
    // ============

    public change(): void {

      // ====
      // 開く
      // ====

      if(!$body[0].classList.contains('state--show-share')) {

        // ドロワーが開いていたら閉じる
        if($body[0].classList.contains('state--show-drawer')) {
          $body[0].classList.remove('state--show-drawer');
          $overlay[0].removeEventListener('click', drawer.change, false);
        }

        $body[0].classList.add('state--show-share');
        $body[0].classList.add('state--show-overlay');

        // オーバーレイクリックで表示解除
        $overlay[0].addEventListener('click', share.change, {
          once:    true,
          passive: false,
          capture: false
        });

        // 背景スクロール開始
        share.background_scroll(true);
      }

      // ======
      // 閉じる
      // ======

      else {
        $body[0].classList.remove('state--show-share');
        $body[0].classList.remove('state--show-overlay');
        $overlay[0].removeEventListener('click', drawer.change, false);

        // 背景スクロール停止
        share.background_scroll(false);
      }

      // テーマカラー変更
      theme_color.change();
    }

    // ==================
    // 背景スクロール演出
    // ==================

    public background_scroll(status: boolean): void {

      // スクロール開始
      if(status) {
        this.timer = setInterval(() => {

          // ページ最下部であれば最上部へ強制移動
          if(window.pageYOffset === document.body.scrollHeight - window.innerHeight) {
            window.scrollTo(0, 0);
          } else {
            window.scrollBy(0, 1);
          }
        }, 30);
      }

      // スクロール停止
      else {
        clearInterval(this.timer);
      }
    }

  }

}