# [futu-no] v1.3 - WordPress theme

![img](https://user-images.githubusercontent.com/17419773/38294778-eb4c68c6-3826-11e8-960f-2f223cd4564d.png)

* Demo : [http://trs.mn/blog/](http://trs.mn/blog/) {:target="_blank"}
* License : [MIT license](https://opensource.org/licenses/MIT) {:target="_blank"}

---

### Outline

“普通の”見た目なWordPressテーマ、[futu-no]です。よろしくおねがいします。

#### View

* よくあるドロワー
* 文章に集中できるシングルカラムレイアウト
* 操作UIをヘッダーに集約してコンテンツを極力シンプルに
* 一行あたりの文字数、フォントサイズや行間設定、見出しのジャンプ率など、文字組にこだわりました
* シンプルだけど“ちょっと変わった”アニメーション演出を入れてます

#### Architecture

* jQuery未使用
* include地獄にならないように、WPテンプレート構成は極力シンプルに
* テーマ独自でHTMLをminifyする設定を実装

---

### Use

`/dist/`フォルダ以下を`/wp-content/theme/futu-no/`へ格納してください。

#### Option : Color Customize

テーマカスタマイズ画面から簡単に配色の編集が可能です。デモブログも気分で色が変わります。
futu-noでは色を考えるのに疲れてしまわないように設定できる色数を5色に絞りました。
アイコンは全てSVGでデザインされており、カラーカスタマイズと動的に連動します。

#### Option : SNS Profile

プロフィール管理画面にSNSのマイページURLを入力できるフィールドを拡張します。
入力のある項目はサイドバーのプロフィール欄へリンク付きで反映します。

---

### Library

* ress : [https://github.com/filipelinhares/ress](https://github.com/filipelinhares/ress){:target="_blank"}
* sweet-scroll : [https://github.com/tsuyoshiwada/sweet-scroll](https://github.com/tsuyoshiwada/sweet-scroll){:target="_blank"}
