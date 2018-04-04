# futu-no v1.3 - WordPress theme

* Demo : [http://trs.mn/blog/](http://trs.mn/blog/)
* License : [MIT license](https://opensource.org/licenses/MIT)

---

## Outline

“普通の”見た目なWordPressテーマ、[futu-no]です。よろしくおねがいします。

#### View

* よくあるドロワー
* 本文にフォーカスさせるシングルカラムレイアウト
* 操作UIをヘッダーに集約してコンテンツを極力シンプルに
* 一行あたりの文字数、フォントサイズや行間設定、見出しのジャンプ率など、文字組にこだわりました

#### Architecture

* WPテンプレート構成をなるべくシンプルで読みやすく
* HTML minify機能付き
* jQuery未使用

---

## Use

/dist/フォルダ以下を/wp-content/theme/futu-no/へ格納してください。

#### Option : Color Customize

テーマカスタマイズ画面から簡単に配色の編集が可能です。デモブログも気分で色が変わります。
futu-noでは色を考えるのに疲れてしまわないように設定できる色数を5色に絞りました。
アイコンは全てSVGでデザインされており、カラーカスタマイズと動的に連動します。

#### Option : SNS Profile

プロフィール管理画面にSNSのマイページURLを入力できるフィールドを拡張します。
入力のある項目はサイドバーのプロフィール欄へリンク付きで反映します。

---

#### Lib

* less - [https://github.com/filipelinhares/ress](https://github.com/filipelinhares/ress)
* sweet-scroll - [https://github.com/tsuyoshiwada/sweet-scroll](https://github.com/tsuyoshiwada/sweet-scroll)
