/*!
 * *****************************************************************************
 * [futu-no] - http://trs.mn/blog/futu-no/
 * @Author: torosalmon
 * @License: MIT License
 * *****************************************************************************
 */

const SweetScroll = require('sweet-scroll')

{

  // =============================================================================
  // 設定
  // =============================================================================

  // 指定したY座標以上スクロールするとヘッダー表示を切り替える
  const changeHeaderDisplay: number = 160

  // class instance
  let smoothScroll
  let parallax
  let themeColor
  let header
  let searchForm
  let drawer
  let share

  // DOM
  const $metaThemeColor: HTMLElement = document.querySelector('meta[name="theme-color"]')
  const $body: HTMLCollectionOf <HTMLBodyElement> = document.getElementsByTagName('body')
  const $header: HTMLCollectionOf <Element> = document.getElementsByClassName('js--header')
  const $searchFormButton: HTMLCollectionOf <Element> = document.getElementsByClassName('js--search-form-button')
  const $drawerButton: HTMLCollectionOf <Element> = document.getElementsByClassName('js--drawer-button')
  const $shareButton: HTMLCollectionOf <Element> = document.getElementsByClassName('js--share-button')
  const $overlay: HTMLCollectionOf <Element> = document.getElementsByClassName('js--overlay')

  // =============================================================================
  // メインスレッド
  // =============================================================================

  document.addEventListener('DOMContentLoaded', () => {
    smoothScroll = new SMOOTHSCROLL()
    parallax = new PARALLAX()
    themeColor = new THEMECOLOR()
    header = new HEADER()
    searchForm = new SEARCHFORM()
    drawer = new DRAWER()
    share = new SHARE()
  }, {
    once: true,
    passive: false,
    capture: true
  })

  // =============================================================================
  // スムーススクロール
  // =============================================================================

  class SMOOTHSCROLL {

    constructor () {

      // 対象の存在を判定
      if (document.getElementsByClassName('js--scroll')[0] != null) {
        this.sweetScroll()
      }
    }

    // ============
    // sweet-scroll
    // ============

    private sweetScroll (): void {
      const option = {
        trigger: '.js--scroll', // トリガーとなる要素をCSSセレクタで指定
        header: '.js--header', // 固定ヘッダをCSSセレクタで指定
        duration: 900, // アニメーション再生時間のミリ秒
        easing: 'easeOutExpo', // イージングのタイプ（デフォルト：easeOutQuint）
        stopScroll: true // ホイール・タッチイベントが発生した時にスクロールを停止
      }
      const sweetScroll: void = new SweetScroll(option)
    }
  }

  // =============================================================================
  // パララックス
  // =============================================================================

  class PARALLAX {

    constructor () {

      // 対象の存在を判定
      if (document.getElementsByClassName('js--parallax')[0] != null) {
        this.parallax()
      }
    }

    // ============
    // パララックス
    // ============

    private parallax (): void {

      // ====
      // init
      // ====

      const $parallax: NodeListOf <HTMLElement> = document.querySelectorAll('.js--parallax')
      const friction = []

      for (let i: number = 0; i < $parallax.length; i += 1) {

        // 速度補正オプションを取得
        if ($parallax[i].dataset.parallaxFriction != null) {
          friction[i] = $parallax[i].dataset.parallaxFriction
        }

        // $parallaxをwrapするタグを生成
        const $container: HTMLElement = document.createElement('div')
        $container.className = 'js--parallax-container'
        $parallax[i].parentNode.insertBefore($container, $parallax[i])
        $parallax[i].parentNode.removeChild($parallax[i])
        $container.appendChild($parallax[i])
      }
      const $parallaxContainer: NodeListOf <HTMLElement> = document.querySelectorAll('.js--parallax-container')

      // ========
      // イベント
      // ========

      window.addEventListener('scroll', animation, {
        once: false,
        passive: true,
        capture: true
      })
      document.addEventListener('touchmove', animation, {
        once: false,
        passive: true,
        capture: true
      })

      // ==============
      // アニメーション
      // ==============

      function animation (): void {
        for (let i: number = 0; i < $parallax.length; i += 1) {
          const y: number = $parallaxContainer[i].getBoundingClientRect().top

          $parallax[i].style.transform = `translateY(${-y / friction[i]}px)`
        }
        window.requestAnimationFrame(animation)
      }
    }
  }

  // =============================================================================
  // <meta theme-color>の切り替え
  // =============================================================================

  class THEMECOLOR {

    private mainColor: string; // <body> border-top-color
    private subColor: string; // <body> border-bottom-color
    private currentColor: string; // 現在適用されている色

    constructor () {

      // <meta theme-color>の初期色指定
      this.mainColor = getComputedStyle($body[0]).borderTopColor
      this.subColor = getComputedStyle($body[0]).borderBottomColor
      this.currentColor = this.mainColor

      $metaThemeColor.setAttribute('content', this.currentColor)
    }

    // ========
    // 切り替え
    // ========

    public change (): void {
      const $headerCast = $header as HTMLCollectionOf<HTMLElement>

      if ($body[0].classList.contains('state--show-drawer') || $body[0].classList.contains('state--show-search-form')) {
        // subColorへ変更

        $metaThemeColor.setAttribute('content', this.subColor)
        $headerCast[0].style.borderTopColor = this.subColor

        this.currentColor = this.subColor
      } else {
        // mainColorへ変更

        $metaThemeColor.setAttribute('content', this.mainColor)
        $headerCast[0].style.borderTopColor = this.mainColor

        this.currentColor = this.mainColor
      }
    }

  }

  // =============================================================================
  // ヘッダーの切り替え
  // =============================================================================

  class HEADER {

    constructor () {
      window.addEventListener('scroll', this.change, {
        once: false,
        passive: true,
        capture: true
      })
      document.addEventListener('touchmove', this.change, {
        once: false,
        passive: true,
        capture: true
      })
    }

    // ========
    // 切り替え
    // ========

    private change (): void {
      if (changeHeaderDisplay < window.pageYOffset) {
        $body[0].classList.add('state--show-scroll-header')
      } else {
        $body[0].classList.remove('state--show-scroll-header')
      }
    }

  }

  // =============================================================================
  // 検索フォーム
  // =============================================================================

  class SEARCHFORM {

    constructor () {
      for (let i: number = 0; i < $searchFormButton.length; i += 1) {
        $searchFormButton[i].addEventListener('click', this.change, {
          once: false,
          passive: false,
          capture: false
        })
      }
    }

    // ============
    // 表示切り替え
    // ============

    private change (): void {

      if (!$body[0].classList.contains('state--show-search-form')) {
        // 開く

        // ドロワーが開いていたら閉じる
        if ($body[0].classList.contains('state--show-drawer')) {
          $body[0].classList.remove('state--show-drawer')
          $body[0].classList.remove('state--show-overlay')
          $overlay[0].removeEventListener('click', drawer.change, false)
        }

        // 共有が開いていたら閉じる
        if ($body[0].classList.contains('state--show-share')) {
          $body[0].classList.remove('state--show-share')
          $body[0].classList.remove('state--show-overlay')
          $overlay[0].removeEventListener('click', share.change, false)

          // 背景スクロール停止
          share.backgroundScroll(false)
        }

        $body[0].classList.add('state--show-search-form')
      } else {
        // 閉じる

        $body[0].classList.remove('state--show-search-form')
      }

      // テーマカラー変更
      themeColor.change()
    }

  }

  // =============================================================================
  // ドロワー
  // =============================================================================

  class DRAWER {

    constructor () {
      for (let i: number = 0; i < $drawerButton.length; i += 1) {
        $drawerButton[i].addEventListener('click', this.change, {
          once: false,
          passive: false,
          capture: false
        })
      }
    }

    // ============
    // 表示切り替え
    // ============

    public change (): void {
      if (!$body[0].classList.contains('state--show-drawer')) {
        // 開く

        // 共有が開いていたら閉じる
        if ($body[0].classList.contains('state--show-share')) {
          $body[0].classList.remove('state--show-share')
          $overlay[0].removeEventListener('click', share.change, false)

          // 背景スクロール停止
          share.backgroundScroll(false)
        }

        $body[0].classList.add('state--show-drawer')
        $body[0].classList.add('state--show-overlay')

        // オーバーレイクリックで表示解除
        $overlay[0].addEventListener('click', drawer.change, {
          once: true,
          passive: false,
          capture: false
        })
      } else {
        // 閉じる

        $body[0].classList.remove('state--show-drawer')
        $body[0].classList.remove('state--show-overlay')
        $overlay[0].removeEventListener('click', drawer.change, false)
      }

      // テーマカラー変更
      themeColor.change()
    }

  }

  // =============================================================================
  // 共有
  // =============================================================================

  class SHARE {

    private timer: number;

    constructor () {
      for (let i: number = 0; i < $shareButton.length; i += 1) {
        $shareButton[i].addEventListener('click', this.change, {
          once: false,
          passive: false,
          capture: false
        })
      }
    }

    // ============
    // 表示切り替え
    // ============

    public change (): void {
      if (!$body[0].classList.contains('state--show-share')) {
        // 開く

        // ドロワーが開いていたら閉じる
        if ($body[0].classList.contains('state--show-drawer')) {
          $body[0].classList.remove('state--show-drawer')
          $overlay[0].removeEventListener('click', drawer.change, false)
        }

        $body[0].classList.add('state--show-share')
        $body[0].classList.add('state--show-overlay')

        // オーバーレイクリックで表示解除
        $overlay[0].addEventListener('click', share.change, {
          once: true,
          passive: false,
          capture: false
        })

        // 背景スクロール開始
        share.backgroundScroll(true)
      } else {
        // 閉じる

        $body[0].classList.remove('state--show-share')
        $body[0].classList.remove('state--show-overlay')
        $overlay[0].removeEventListener('click', drawer.change, false)

        // 背景スクロール停止
        share.backgroundScroll(false)
      }

      // テーマカラー変更
      themeColor.change()
    }

    // ==================
    // 背景スクロール演出
    // ==================

    public backgroundScroll (status: boolean): void {
      if (status) {
        // スクロール開始

        this.timer = window.setInterval(() => {

          // ページ最下部であれば最上部へ強制移動
          if (window.pageYOffset === document.body.scrollHeight - window.innerHeight) {
            window.scrollTo(0, 0)
          } else {
            window.scrollBy(0, 1)
          }
        }, 30)
      } else {
        // スクロール停止

        clearInterval(this.timer)
      }
    }

  }

}
