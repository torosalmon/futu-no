/*!
 * *****************************************************************************
 * [futu-no JavaScript]
 * @URL:     http://trs.mn/blog/futu-no/
 * @License: MIT License
 *
 * [sweet-scroll - v2.2.1]
 * @URL:     https://github.com/tsuyoshiwada/sweet-scroll
 * @author:  tsuyoshiwada
 * @License: MIT License
 * *****************************************************************************
!*/

{

  /* ========================================================================== */
  /* グローバル変数                                                             */
  /* ========================================================================== */

  /* class instance */
  let theme_color_control;
  let header_control;
  let drawer_control;
  let search_form_control;
  let share_control;
  let html_support;

  /* DOM */
  const $meta_theme_color:   NodeListOf <Element>         = document.querySelectorAll('meta[name="theme-color"]');
  const $body:               NodeListOf <HTMLBodyElement> = document.getElementsByTagName('body');
  const $header:             NodeListOf <HTMLElement>     = document.getElementsByTagName('header');
  const $drawer:             HTMLCollectionOf <Element>   = document.getElementsByClassName('drawer');
  const $drawer_button:      HTMLCollectionOf <Element>   = document.getElementsByClassName('js-drawer-button');
  const $search_form_button: HTMLCollectionOf <Element>   = document.getElementsByClassName('js-search-form-button');
  const $share_button:       HTMLCollectionOf <Element>   = document.getElementsByClassName('js-share-button');

  /* 設定 */
  const header_change_trigger_y = 160; /* ヘッダーUIを切り替えるY座標 */

  /* ========================================================================== */
  /* メインスレッド                                                             */
  /* ========================================================================== */

  /* ================ */
  /* DOMContentLoaded */
  /* ================ */

  document.addEventListener('DOMContentLoaded', () => {
    theme_color_control = new THEME_COLOR_CONTROL();
    header_control      = new HEADER_CONTROL();
    drawer_control      = new DRAWER_CONTROL();
    search_form_control = new SEARCH_FORM_CONTROL();
    share_control       = new SHARE_CONTROL();
    html_support        = new HTML_SUPPORT();

    html_support.smooth_scroll();

    /* ================ */
    /* タグ存在判定起動 */
    /* ================ */

    if(document.getElementsByTagName('video')[0] != null) {
      html_support.inline_playing_video();
    }

    /* ====== */
    /* scroll */
    /* ====== */

    window.addEventListener('scroll', header_control.change, <any> {
      once:    false,
      passive: true,
      capture: true
    });
    document.addEventListener('touchmove', header_control.change, <any> {
      once:    false,
      passive: true,
      capture: true
    });

    /* ============== */
    /* $drawer_button */
    /* ============== */

    $drawer_button[0].addEventListener('click', drawer_control.change, <any> {
      once:    false,
      passive: false,
      capture: false
    });

    /* =================== */
    /* $search_form_button */
    /* =================== */

    for(let i: number = 0; i < $search_form_button.length; i += 1) {
      $search_form_button[i].addEventListener('click', search_form_control.change, <any> {
        once:    false,
        passive: false,
        capture: false
      });
    }

    /* ============= */
    /* $share_button */
    /* ============= */

    for(let i: number = 0; i < $share_button.length; i += 1) {
      $share_button[i].addEventListener('click', share_control.change, <any> {
        once:    false,
        passive: false,
        capture: false
      });
    }

  }, <any> {
    once:    true,
    passive: false,
    capture: true
  });

  /* ========================================================================== */
  /* テーマカラーの切り替え                                                     */
  /* ========================================================================== */

  class THEME_COLOR_CONTROL {

    private current_color: string; /* 現在適用されている色 */
    private main_color:    string; /* <header>  border-top-color */
    private sub_color:     string; /* <.drawer> background-color */

    /* ============== */
    /* コンストラクタ */
    /* ============== */

    constructor() {

      /* <meta theme-color>の初期色指定 */
      this.main_color    = getComputedStyle($header[0]).borderTopColor;
      this.sub_color     = getComputedStyle($drawer[0]).backgroundColor;
      this.current_color = this.main_color;

      $meta_theme_color[0].setAttribute('content', this.current_color);
    }

    /* ======== */
    /* 切り替え */
    /* ======== */

    public change(): void {

      /* main_color => sub_color */
      if (this.current_color === this.main_color) {
        $meta_theme_color[0].setAttribute('content', this.sub_color);
        $header[0].style.borderTopColor = this.sub_color;

        this.current_color = this.sub_color;
      }

      /* sub_color => main_color */
      else {
        $meta_theme_color[0].setAttribute('content', this.main_color);
        $header[0].style.borderTopColor = this.main_color;

        this.current_color = this.main_color;
      }
    }

  }

  /* ========================================================================== */
  /* スクロールでヘッダー表示を切り替え                                         */
  /* ========================================================================== */

  class HEADER_CONTROL {

    /* ============== */
    /* コンストラクタ */
    /* ============== */

    constructor() {
      this.change();
    }

    /* ======== */
    /* 切り替え */
    /* ======== */

    public change(): void {
      if(header_change_trigger_y < window.pageYOffset) {
        $body[0].classList.add('show-scroll-header');
      } else {
        $body[0].classList.remove('show-scroll-header');
      }
    }

  }

  /* ========================================================================== */
  /* ドロワーの出し入れ                                                         */
  /* ========================================================================== */

  class DRAWER_CONTROL {

    /* ======== */
    /* 切り替え */
    /* ======== */

    public change(): void {

      /* 開く */
      if(!$body[0].classList.contains('show-drawer')) {
        $body[0].classList.add('show-drawer');
        $body[0].classList.remove('show-search-form');

        /* テーマカラー変更 */
        theme_color_control.change();
      }

      /* 閉じる */
      else {
        $body[0].classList.remove('show-drawer');

        /* テーマカラー変更 */
        theme_color_control.change();
      }
    }

  }

  /* ========================================================================== */
  /* 検索フォームの出し入れ                                                     */
  /* ========================================================================== */

  class SEARCH_FORM_CONTROL {

    /* ======== */
    /* 切り替え */
    /* ======== */

    public change(): void {

      /* 開く */
      if(!$body[0].classList.contains('show-search-form')) {
        $body[0].classList.add('show-search-form');
        $body[0].classList.remove('show-drawer');

        /* テーマカラー変更 */
        theme_color_control.change();
      }

      /* 閉じる */
      else {
        $body[0].classList.remove('show-search-form');

        /* テーマカラー変更 */
        theme_color_control.change();
      }
    }

  }

  /* ========================================================================== */
  /* 共有メニューの表示                                                         */
  /* ========================================================================== */

  class SHARE_CONTROL {

    private timer: number;

    /* ============ */
    /* 表示切り替え */
    /* ============ */

    public change(): void {

      /* 開く */
      if(!$body[0].classList.contains('show-share-overlay')) {
        $body[0].classList.add('show-share-overlay');

        /* 背景スクロール開始 */
        share_control.background_scroll(true);
      }

      /* 閉じる */
      else {
        $body[0].classList.remove('show-share-overlay');

        /* 背景スクロール停止 */
        share_control.background_scroll(false);
      }
    }

    /* ================== */
    /* 背景スクロール演出 */
    /* ================== */

    private background_scroll(status: boolean): void {

      /* スクロール開始 */
      if(status) {
        this.timer = setInterval(() => {

          /* ページ最下部であれば最上部へ強制移動 */
          if(window.pageYOffset === document.body.scrollHeight - window.innerHeight) {
            window.scrollTo(0, 0);
          } else {
            window.scrollBy(0, 1);
          }
        }, 30);
      }

      /* スクロール停止 */
      else {
        clearInterval(this.timer);
      }
    }

  }

  /* ========================================================================== */
  /* HTML UX補佐                                                                */
  /* ========================================================================== */

  class HTML_SUPPORT {

    /* ================== */
    /* スムーススクロール */
    /* ================== */

    public smooth_scroll(): void {

      /* sweet-scroll */
      const sweetScroll = new SweetScroll({
        trigger:          '.js-scroll',  /* トリガーとなる要素をCSSセレクタで指定 */
        header:           'header',      /* 固定ヘッダをCSSセレクタで指定 */
        duration:         900,           /* アニメーション再生時間のミリ秒 */
        delay:            0,             /* アニメーション開始までの遅延ミリ秒 */
        easing:           'easeOutExpo', /* イージングのタイプ（デフォルト：easeOutQuint） */
        offset:           0,             /* スクロール位置のオフセット */
        verticalScroll:   true,          /* 垂直方向のスクロールを許可 */
        horizontalScroll: false,         /* 水平方向のスクロールを許可 (デフォルトでは無効) */
        stopScroll:       true,          /* ホイール・タッチイベントが発生した時にスクロールを停止 */

        /* Callbacks */
        beforeScroll: null, /* スクロールが始まる前 (return falseでキャンセル可) */
        afterScroll:  null, /* スクロールが終わった時 */
        cancelScroll: null, /* スクロールがキャンセルされた時 */
      });
    }

    /* =========================== */
    /* 動画のインライン再生（iOS） */
    /* =========================== */

    public inline_playing_video(): void {
      const $video: NodeListOf <HTMLVideoElement> = document.getElementsByTagName('video');

      for(let i: number = 0; i < $video.length; i += 1) {
        $video[i].setAttribute('webkit-playsinline', 'webkit-playsinline');
      }
    }

  }

}
