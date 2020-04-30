import SweetScroll from 'sweet-scroll'

/*!
 * *****************************************************************************
 * [futu-no] - http://trs.mn/blog/futu-no/
 * @Author: torosalmon
 * @License: MIT License
 * *****************************************************************************
 */

{
  // 指定したY座標以上スクロールするとヘッダー表示を切り替える
  const changeDisplayHeaderOffset = 160

  // DOM
  const $metaThemeColor: HTMLElement = document.querySelector(
    'meta[name="theme-color"]'
  ) as HTMLElement
  const $body: HTMLCollectionOf<HTMLBodyElement> = document.getElementsByTagName(
    'body'
  )
  const $header: HTMLCollectionOf<HTMLElement> = document.getElementsByClassName(
    'js--header'
  ) as HTMLCollectionOf<HTMLElement>
  const $searchFormButton: HTMLCollectionOf<Element> = document.getElementsByClassName(
    'js--search-form-button'
  )
  const $drawerButton: HTMLCollectionOf<Element> = document.getElementsByClassName(
    'js--drawer-button'
  )
  const $shareButton: HTMLCollectionOf<Element> = document.getElementsByClassName(
    'js--share-button'
  )
  const $overlay: HTMLCollectionOf<Element> = document.getElementsByClassName(
    'js--overlay'
  )

  // =============================================================================
  // スムーススクロール
  // =============================================================================

  interface SmoothScrollInterface extends SmoothScroll {
    sweetScroll(): void
  }

  class SmoothScroll implements SmoothScrollInterface {
    // ==============
    // コンストラクタ
    // ==============

    constructor () {
      if (document.getElementsByClassName('js--scroll')[0] != null) {
        this.sweetScroll()
      }
    }

    // ============
    // sweet-scroll
    // ============

    public sweetScroll (): void {
      const sweetScroll: SweetScroll = new SweetScroll({
        trigger: '.js--scroll', // トリガーとなる要素をCSSセレクタで指定
        header: '.js--header', // 固定ヘッダをCSSセレクタで指定
        duration: 900, // アニメーション再生時間のミリ秒
        easing: 'easeOutExpo' // イージングのタイプ（デフォルト：easeOutQuint）
      })
    }
  }

  // =============================================================================
  // パララックス
  // =============================================================================

  interface ParallaxInterface extends Parallax {
    run(): void
  }

  class Parallax implements ParallaxInterface {
    // ==============
    // コンストラクタ
    // ==============

    constructor () {
      if (document.getElementsByClassName('js--parallax')[0] != null) {
        this.run()
      }
    }

    // ================
    // パララックス実行
    // ================

    public run (): void {
      // ====
      // init
      // ====

      const $parallax: NodeListOf<HTMLElement> = document.querySelectorAll(
        '.js--parallax'
      )
      const friction: number[] = []

      Array.from($parallax).forEach((element: HTMLElement, index: number) => {
        // 速度補正オプションを取得
        const $parallaxAttrFriction: string = element.dataset
          .parallaxFriction as string
        friction[index] = ($parallaxAttrFriction as unknown) as number

        // $parallaxをwrapするタグを生成
        const $container: HTMLElement = document.createElement('div')
        $container.className = 'js--parallax-container'
        element.before($container)
        $container.append(element)
      })
      const $parallaxContainer: NodeListOf<HTMLElement> = document.querySelectorAll(
        '.js--parallax-container'
      )

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
        Array.from($parallax).forEach((element: HTMLElement, index: number) => {
          const y: number = $parallaxContainer[index].getBoundingClientRect()
            .top
          element.style.transform = `translateY(${-y / friction[index]}px)`
        })
      }
    }
  }

  // =============================================================================
  // テーマカラーの切り替え
  // =============================================================================

  interface ChangeDisplayThemeColorInterface extends ChangeDisplayThemeColor {
    mainColor: string // <body> border-top-color
    subColor: string // <body> border-bottom-color
    currentColor: string // 現在適用されている色

    change(): void
  }

  class ChangeDisplayThemeColor implements ChangeDisplayThemeColorInterface {
    public mainColor: string
    public subColor: string
    public currentColor: string

    // ==============
    // コンストラクタ
    // ==============

    constructor () {
      // <meta theme-color>の初期色指定
      this.mainColor = getComputedStyle($body[0]).borderTopColor as string
      this.subColor = getComputedStyle($body[0]).borderBottomColor as string
      this.currentColor = this.mainColor

      $metaThemeColor.setAttribute('content', this.currentColor)
    }

    // ============
    // 表示切り替え
    // ============

    public change (): void {
      if (
        $body[0].classList.contains('state--show-drawer') ||
        $body[0].classList.contains('state--show-search-form')
      ) {
        // subColorへ変更

        $metaThemeColor.setAttribute('content', this.subColor)
        $header[0].style.borderTopColor = this.subColor

        this.currentColor = this.subColor
      } else {
        // mainColorへ変更

        $metaThemeColor.setAttribute('content', this.mainColor)
        $header[0].style.borderTopColor = this.mainColor

        this.currentColor = this.mainColor
      }
    }
  }

  // =============================================================================
  // ヘッダーの切り替え
  // =============================================================================

  interface ChangeDisplayHeaderInterface extends ChangeDisplayHeader {
    change(): void
  }

  class ChangeDisplayHeader implements ChangeDisplayHeaderInterface {
    // ==============
    // コンストラクタ
    // ==============

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

    // ============
    // 表示切り替え
    // ============

    public change (): void {
      if (changeDisplayHeaderOffset < window.pageYOffset) {
        $body[0].classList.add('state--show-scroll-header')
      } else {
        $body[0].classList.remove('state--show-scroll-header')
      }
    }
  }

  // =============================================================================
  // 検索フォームの切り替え
  // =============================================================================

  interface ChangeDisplaySearchFormInterface extends ChangeDisplaySearchForm {
    change(): void
  }

  class ChangeDisplaySearchForm implements ChangeDisplaySearchFormInterface {
    // ==============
    // コンストラクタ
    // ==============

    constructor () {
      Array.from($searchFormButton).forEach(element => {
        element.addEventListener('click', this.change, {
          once: false,
          passive: false,
          capture: false
        })
      })
    }

    // ============
    // 表示切り替え
    // ============

    public change (): void {
      if (!$body[0].classList.contains('state--show-search-form')) {
        // 開く

        // ドロワーが開いていたら閉じる
        if ($body[0].classList.contains('state--show-drawer')) {
          $body[0].classList.remove('state--show-drawer')
          $body[0].classList.remove('state--show-overlay')
          $overlay[0].removeEventListener(
            'click',
            changeDisplayDrawer.change,
            false
          )
        }

        // 共有が開いていたら閉じる
        if ($body[0].classList.contains('state--show-share')) {
          $body[0].classList.remove('state--show-share')
          $body[0].classList.remove('state--show-overlay')
          $overlay[0].removeEventListener(
            'click',
            changeDisplayShare.change,
            false
          )

          // 背景スクロール停止
          changeDisplayShare.backgroundScroll(false)
        }

        $body[0].classList.add('state--show-search-form')
      } else {
        // 閉じる

        $body[0].classList.remove('state--show-search-form')
      }

      // テーマカラー変更
      changeDisplayThemeColor.change()
    }
  }

  // =============================================================================
  // ドロワーの切り替え
  // =============================================================================

  interface ChangeDisplayDrawerInterface extends ChangeDisplayDrawer {
    change(): void
  }

  class ChangeDisplayDrawer implements ChangeDisplayDrawerInterface {
    // ==============
    // コンストラクタ
    // ==============

    constructor () {
      Array.from($drawerButton).forEach(element => {
        element.addEventListener('click', this.change, {
          once: false,
          passive: false,
          capture: false
        })
      })
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
          $overlay[0].removeEventListener(
            'click',
            changeDisplayShare.change,
            false
          )

          // 背景スクロール停止
          changeDisplayShare.backgroundScroll(false)
        }

        $body[0].classList.add('state--show-drawer')
        $body[0].classList.add('state--show-overlay')

        // オーバーレイクリックで表示解除
        $overlay[0].addEventListener('click', changeDisplayDrawer.change, {
          once: true,
          passive: false,
          capture: false
        })
      } else {
        // 閉じる

        $body[0].classList.remove('state--show-drawer')
        $body[0].classList.remove('state--show-overlay')
        $overlay[0].removeEventListener(
          'click',
          changeDisplayDrawer.change,
          false
        )
      }

      // テーマカラー変更
      changeDisplayThemeColor.change()
    }
  }

  // =============================================================================
  // 共有の切り替え
  // =============================================================================

  interface ChangeDisplayShareInterface extends ChangeDisplayShare {
    timer: number // setInterval

    change(): void
    backgroundScroll(status: boolean): void
  }

  class ChangeDisplayShare implements ChangeDisplayShareInterface {
    public timer = 0

    // ==============
    // コンストラクタ
    // ==============

    constructor () {
      Array.from($shareButton).forEach(element => {
        element.addEventListener('click', this.change, {
          once: false,
          passive: false,
          capture: false
        })
      })
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
          $overlay[0].removeEventListener(
            'click',
            changeDisplayDrawer.change,
            false
          )
        }

        $body[0].classList.add('state--show-share')
        $body[0].classList.add('state--show-overlay')

        // オーバーレイクリックで表示解除
        $overlay[0].addEventListener('click', changeDisplayShare.change, {
          once: true,
          passive: false,
          capture: false
        })

        // 背景スクロール開始
        changeDisplayShare.backgroundScroll(true)
      } else {
        // 閉じる

        $body[0].classList.remove('state--show-share')
        $body[0].classList.remove('state--show-overlay')
        $overlay[0].removeEventListener(
          'click',
          changeDisplayDrawer.change,
          false
        )

        // 背景スクロール停止
        changeDisplayShare.backgroundScroll(false)
      }

      // テーマカラー変更
      changeDisplayThemeColor.change()
    }

    // ==================
    // 背景スクロール演出
    // ==================

    public backgroundScroll (status: boolean): void {
      if (status) {
        // スクロール開始

        this.timer = window.setInterval(() => {
          // ページ最下部であれば最上部へ強制移動
          if (
            window.pageYOffset ===
            document.body.scrollHeight - window.innerHeight
          ) {
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

  const smoothScroll: SmoothScroll = new SmoothScroll()
  const parallax: Parallax = new Parallax()
  const changeDisplayThemeColor: ChangeDisplayThemeColor = new ChangeDisplayThemeColor()
  const changeDisplayHeader: ChangeDisplayHeader = new ChangeDisplayHeader()
  const changeDisplaySearchForm: ChangeDisplaySearchForm = new ChangeDisplaySearchForm()
  const changeDisplayDrawer: ChangeDisplayDrawer = new ChangeDisplayDrawer()
  const changeDisplayShare: ChangeDisplayShare = new ChangeDisplayShare()
}
