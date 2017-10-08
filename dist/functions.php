<?php
/*!
 * *****************************************************************************
 * [futu-no]
 * @URL     : http://trs.mn/blog/futu-no/
 * @License : MIT License
 * *****************************************************************************
!*/
?>
<?php

  // =============================================================================
  // [管理 > 投稿]
  // アイキャッチ設定
  // =============================================================================

  add_theme_support('post-thumbnails');
  add_image_size('640px', 640, 640, true);
  add_image_size('960px', 960, 960, true);

  // =============================================================================
  // [管理 > メディア]
  // メディアアップローダーにSVGを追加
  // =============================================================================

  function set_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'set_mime_types');

  // =============================================================================
  // [管理 > 外観]
  // テーマカスタマイザー
  // =============================================================================

  // ====================
  // カスタマイズ項目登録
  // ====================

  function theme_customize_register($wp_customize){

    // サイト基本情報 - HTMLを圧縮する
    $wp_customize->add_setting('theme_customize__setting__title_tagline__html_minify', array(
      'type'    => 'theme_mod',
      'default' => 'checked',
    ));
    $wp_customize->add_control('control_html_minify', array(
      'section'     => 'title_tagline',
      'settings'    => 'theme_customize__setting__title_tagline__html_minify',
      'type'        => 'checkbox',
      'label'       => 'HTMLを圧縮する (HTML minify)',
      'description' => '【有効の場合】<br>出力HTMLをminifyします。<br>【無効の場合】<br>インデントされたHTMLを出力します。',
    ));

    // 色 - 動的CSS出力の有効化
    $wp_customize->add_setting('theme_customize__setting__colors__dynamic_css_output', array(
      'type'    => 'theme_mod',
      'default' => 'checked',
    ));
    $wp_customize->add_control('control_dynamic_css_output', array(
      'section'     => 'colors',
      'settings'    => 'theme_customize__setting__colors__dynamic_css_output',
      'type'        => 'checkbox',
      'label'       => '動的CSS出力の有効化 (dynamic CSS output)',
      'description' => '【有効の場合】<br>wp_head()に動的CSSとして出力します。このページのカラーカスタマイズを反映するにはチェックを有効にする必要があります。<br>【無効の場合】<br>テーマディレクトリの「/css/_mixin.scss」で定義されたSCSS変数の色指定を反映します。静的CSS管理となり若干サイトパフォーマンスが向上しますが、SCSSコンパイル環境が必要になります。',
    ));

    // 色 - バックグラウンド
    $wp_customize->add_setting('theme_customize__setting__colors__background', array(
      'type'              => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
      'default'           => '#ffffff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'control_background', array(
      'section'  => 'colors',
      'settings' => 'theme_customize__setting__colors__background',
      'label'    => 'バックグラウンド (background)',
    )));

    // 色 - ボーダー
    $wp_customize->add_setting('theme_customize__setting__colors__border', array(
      'type'              => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
      'default'           => '#dddddd',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'control_border', array(
      'section'  => 'colors',
      'settings' => 'theme_customize__setting__colors__border',
      'label'    => 'ボーダー (border)',
    )));

    // 色 - テキスト
    $wp_customize->add_setting('theme_customize__setting__colors__text', array(
      'type'              => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
      'default'           => '#444444',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'control_text', array(
      'section'  => 'colors',
      'settings' => 'theme_customize__setting__colors__text',
      'label'    => 'テキスト (text)',
    )));

    // 色 - アクセントカラー
    $wp_customize->add_setting('theme_customize__setting__colors__accent', array(
      'type'              => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
      'default'           => '#b5fc49',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'control_accent', array(
      'section'  => 'colors',
      'settings' => 'theme_customize__setting__colors__accent',
      'label'    => 'アクセントカラー (accent)',
    )));

    // 色 - サブカラー
    $wp_customize->add_setting('theme_customize__setting__colors__sub', array(
      'type'              => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
      'default'           => '#6a7375',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'control_sub', array(
      'section'  => 'colors',
      'settings' => 'theme_customize__setting__colors__sub',
      'label'    => 'サブカラー (sub)',
    )));

    // 色 - オーバーレイ配色
    $wp_customize->add_setting('theme_customize__setting__colors__overlay_color', array(
      'type'    => 'theme_mod',
      'default' => 'dark',
    ));
    $wp_customize->add_control('control_overlay_color', array(
      'section'     => 'colors',
      'settings'    => 'theme_customize__setting__colors__overlay_color',
      'type'        => 'radio',
      'choices'     => array(
        'dark'    => 'ダーク (Darken) … 黒背景白文字',
        'light'   => 'ライト (Lighten) … 白背景黒文字',
      ),
      'label'       => 'オーバーレイ配色 (Overlay color)',
      'description' => '共有メニューを開いた際のオーバーレイの色設定です。サイトカラーに合わせて読みやすい方を選択してください。',
    ));
  }
  add_action('customize_register', 'theme_customize_register');

  // ======================
  // テーマカスタマイズ出力
  // ======================

  function theme_customize_css() {
    $theme_customize__setting__colors__background = get_theme_mod('theme_customize__setting__colors__background', '#ffffff');
    $theme_customize__setting__colors__border     = get_theme_mod('theme_customize__setting__colors__border', '#dddddd');
    $theme_customize__setting__colors__text       = get_theme_mod('theme_customize__setting__colors__text', '#444444');
    $theme_customize__setting__colors__accent     = get_theme_mod('theme_customize__setting__colors__accent', '#2dcec9');
    $theme_customize__setting__colors__sub        = get_theme_mod('theme_customize__setting__colors__sub', '#6a7375');

echo <<< EOM
    <style>

      /* ============================= */
      /* WordPress Theme Customize API */
      /* ============================= */

      /* background color */
      header { background-color: {$theme_customize__setting__colors__background}; }
      header .page-info .page-top { background-color: {$theme_customize__setting__colors__background}; }
      .search-form { background-color: {$theme_customize__setting__colors__background}; }
      main { background-color: {$theme_customize__setting__colors__background}; }
      main .contents .article-detail .article-comment .comment-respond .comment-form .form-submit input[type='submit'] { color: {$theme_customize__setting__colors__background}; }
      main footer { color: {$theme_customize__setting__colors__background}; }
      .drawer .author .name { color: {$theme_customize__setting__colors__background}; }
      .drawer .author .comment { color: {$theme_customize__setting__colors__background}; }
      .drawer .author .links a { color: {$theme_customize__setting__colors__background}; }
      .drawer .dir-map h6 { color: {$theme_customize__setting__colors__background}; }
      .drawer .dir-map li { color: {$theme_customize__setting__colors__background}; }
      .drawer .dir-map a { color: {$theme_customize__setting__colors__background}; }

      /* border color */
      input[type='text'], input[type='search'], input[type='tel'], input[type='url'], input[type='email'], input[type='password'], input[type='datetime'], input[type='datetime-local'], input[type='date'], input[type='month'], input[type='week'], input[type='time'], input[type='number'], textarea, select { border-color: {$theme_customize__setting__colors__border}; }
      input[type='submit'], input[type='reset'], input[type='button'], button { background-color: {$theme_customize__setting__colors__border}; }
      header { border-bottom-color: {$theme_customize__setting__colors__border}; }
      header .tool li { border-left-color: {$theme_customize__setting__colors__border}; }
      .search-form { border-bottom-color: {$theme_customize__setting__colors__border}; }
      .search-form .flex-item:nth-of-type(2)::before { border-left-color: {$theme_customize__setting__colors__border}; }
      .search-form .flex-item:nth-of-type(2) input[type='submit'] { border-left-color: {$theme_customize__setting__colors__border}; }
      .search-form .flex-item:nth-of-type(3) .close { border-left-color: {$theme_customize__setting__colors__border}; }
      main .contents .pagenation ul { border-bottom-color: {$theme_customize__setting__colors__border}; }
      html.home main .contents .latest-1 { border-bottom-color: {$theme_customize__setting__colors__border}; }
      html.home main .contents .latest-1 section a::after { border-top-color: {$theme_customize__setting__colors__border}; border-right-color: {$theme_customize__setting__colors__border}; }
      html.home main .contents .latest-2 section:not(:nth-of-type(1)) { border-top-color: {$theme_customize__setting__colors__border}; }
      html.home main .contents .latest-2 section a::after { border-top-color: {$theme_customize__setting__colors__border}; border-right-color: {$theme_customize__setting__colors__border}; }
      html.home main .contents .dir-map section ul { border-left-color: {$theme_customize__setting__colors__border}; }
      main .contents .archive-list section .heading a strong::before { background-color: {$theme_customize__setting__colors__border}; }
      main .contents .archive-list section .meta dd:not(:nth-of-type(1)) { border-left-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .meta { border-top-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .meta dd::before { border-left-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .content pre { border-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .content hr { background-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .sign dl dt, main .contents .article-detail .sign dl dd { border-bottom-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .article-comment .comment-list ul article { border-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .article-comment .comment-list ul.parent article::before { border-right-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .article-comment .comment-list ul.children article::before { border-right-color: transparent; border-left-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .article-comment .comment-respond::before { border-bottom-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .article-comment .comment-respond .comment-form .flex { border-left-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .adjacent-links ul { border-color: {$theme_customize__setting__colors__border}; }
      main .contents .article-detail .adjacent-links li:not(:first-child) { border-left-color: {$theme_customize__setting__colors__border}; }

      /* text color */
      body { color: {$theme_customize__setting__colors__text}; }
      header .drawer-icon span { background-color: {$theme_customize__setting__colors__text}; }
      header .page-info .breadcrumb li:not(:first-child)::before { border-top-color: {$theme_customize__setting__colors__text}; border-right-color: {$theme_customize__setting__colors__text}; }
      .search-form .flex-item:nth-of-type(3) .close::before, .search-form .flex-item:nth-of-type(3) .close::after { background-color: {$theme_customize__setting__colors__text}; }
      html.home main .contents .latest-1 section a:hover::after { border-top-color: {$theme_customize__setting__colors__text}; border-right-color: {$theme_customize__setting__colors__text}; }
      html.home main .contents .latest-2 section a:hover::after { border-top-color: {$theme_customize__setting__colors__text}; border-right-color: {$theme_customize__setting__colors__text}; }
      main .contents .archive-list section .heading a strong::after { background-color: {$theme_customize__setting__colors__text}; }
      main footer { background-color: {$theme_customize__setting__colors__text}; }

      /* accent color */
      header { border-top-color: {$theme_customize__setting__colors__accent}; }
      header .tool span.notification { background-color: {$theme_customize__setting__colors__accent}; }
      .search-form .flex-item:nth-of-type(1) input[type='search']:focus { border-bottom-color: {$theme_customize__setting__colors__accent}; }
      main .contents .pagenation li.current { border-bottom-color: {$theme_customize__setting__colors__accent}; }
      .drawer .author .name::before { background: {$theme_customize__setting__colors__accent}; }

      /* sub color */
      .search-form { border-top-color: {$theme_customize__setting__colors__sub}; }
      main .contents .article-detail .article-comment .comment-respond .comment-form .form-submit input[type='submit'] { background-color: {$theme_customize__setting__colors__sub}; }
      .drawer { background-color: {$theme_customize__setting__colors__sub}; }
      .drawer .author .avatar { border-color: {$theme_customize__setting__colors__sub}; }
      .drawer .author .name { border-color: {$theme_customize__setting__colors__sub}; }
      .drawer .author .comment { border-color: {$theme_customize__setting__colors__sub}; }
      .drawer .author .links li { border-color: {$theme_customize__setting__colors__sub}; }

      /* SVG */
      .svg-icon .fill-color-background { fill: {$theme_customize__setting__colors__background}; }
      .svg-icon .stroke-color-background { stroke: {$theme_customize__setting__colors__background}; }
      .svg-icon .fill-color-border { fill: {$theme_customize__setting__colors__border}; }
      .svg-icon .stroke-color-border { stroke: {$theme_customize__setting__colors__border}; }
      .svg-icon .fill-color-text { fill: {$theme_customize__setting__colors__text}; }
      .svg-icon .stroke-color-text { stroke: {$theme_customize__setting__colors__text}; }
      .svg-icon .fill-color-accent { fill: {$theme_customize__setting__colors__accent}; }
      .svg-icon .stroke-color-accent { stroke: {$theme_customize__setting__colors__accent}; }
      .svg-icon .fill-color-sub { fill: {$theme_customize__setting__colors__sub}; }
      .svg-icon .stroke-color-sub { stroke: {$theme_customize__setting__colors__sub}; }
    </style>

EOM;
  }

  // 動的CSS出力オプションが有効の場合に実行
  if(get_theme_mod('theme_customize__setting__colors__dynamic_css_output')) {
    add_action('wp_head', 'theme_customize_css');
  }

  // =============================================================================
  // [管理 > 外観 > テーマ]
  // 固定ページのテンプレートを個別投稿テンプレートに統一
  // =============================================================================

  function page_to_single($template) {
    if($template === '') {
      $template = locate_template(array('single.php'));
      return $template;
    }
  }
  add_filter('page_template', 'page_to_single');

  // =============================================================================
  // [管理 > ユーザー]
  // SNSマイページ入力欄拡張
  // =============================================================================

  function update_profile_fields($contactmethods) {
    $contactmethods['skype']       = 'Skype';
    $contactmethods['facebook']    = 'Facebook';
    $contactmethods['twitter']     = 'Twitter';
    $contactmethods['google_plus'] = 'Google +';
    $contactmethods['mastodon']    = 'Mastodon';
    $contactmethods['mixi']        = 'mixi';
    $contactmethods['tumblr']      = 'Tumblr';
    $contactmethods['instagram']   = 'Instagram';
    $contactmethods['flickr']      = 'Flickr';
    $contactmethods['photohito']   = 'PHOTOHITO';
    $contactmethods['pixiv']       = 'pixiv';
    $contactmethods['github']      = 'GitHub';
    $contactmethods['qiita']       = 'Qiita';

    return $contactmethods;
  }
  add_filter('user_contactmethods', 'update_profile_fields', 10, 1);

  // =============================================================================
  // [管理 > ユーザー]
  // プロフィール欄のHTMLを許可
  // =============================================================================

  remove_filter('pre_user_description', 'wp_filter_kses');

  // =============================================================================
  // [フロントサイト]
  // 構文をXHTMLからHTMLフォーマットへ変更
  // =============================================================================

  remove_filter('the_content', 'convert_chars');

  // =============================================================================
  // [フロントサイト]
  // 記事抜粋設定
  // =============================================================================

  // 文字数
  function new_excerpt_mblength($length) {
    return 100;
  }
  add_filter('excerpt_mblength', 'new_excerpt_mblength');

  // 末尾に付加する文字列
  function new_excerpt_more($more) {
    return '...';
  }
  add_filter('excerpt_more', 'new_excerpt_more');

  // #moreハッシュを削除
  // http://webdesignrecipes.com/wordpress-functions-php-snipets/
  function remove_more_jump_link($link) {
    $offset = strpos($link, '#more-');
    if($offset) {
      $end = strpos($link, '"', $offset);
    }
    if($end) {
      $link = substr_replace($link, '', $offset, $end-$offset);
    }
    return $link;
  }
  add_filter('the_content_more_link', 'remove_more_jump_link');

  // =============================================================================
  // [フロントサイト]
  // wp_head(), wp_footer()設定
  // =============================================================================

  // ===============
  // <title>自動生成
  // ===============

  function nendebcom_theme_slug_setup() {
    add_theme_support('title-tag');
  }
  add_action('after_setup_theme', 'nendebcom_theme_slug_setup');

  // 区切り文字の変更
  function nendebcom_title_separator($sep) {
    $sep = '|';
    return $sep;
  }
  add_filter('document_title_separator', 'nendebcom_title_separator');

  // ================
  // 不要なタグを削除
  // ================

  // WordPressバージョン
  // <meta name="generator">
  remove_action('wp_head', 'wp_generator');

  // ============
  // 静的リソース
  // ============

  function add_files() {

    // [CSS]
    // $handle : スタイルシート識別名
    // $src    : URL
    // $deps   : 依存スタイルシート識別名の配列（オプション）
    // $ver    : バージョン文字列。クエリーストリングに付加される。（オプション）
    // $media  : スタイルシートのメディア指定（オプション）
    wp_enqueue_style('theme', get_template_directory_uri() . '/css/style.css', array(), false, '');

    // [JS]
    // $handle    : スクリプト識別名
    // $src       : URL
    // $deps      : 依存スクリプト識別名の配列（オプション）
    // $ver       : バージョン文字列。クエリーストリングに付加される。（オプション）
    // $in_footer : trueで</body>前で読み込まれる。デフォルトはfalseで</head>の前のエリアで読み込まれる。（オプション）
    wp_enqueue_script('sweet-scroll', 'https://unpkg.com/sweet-scroll@2.2.1/sweet-scroll.min.js', array(), false, true);
    wp_enqueue_script('theme', get_template_directory_uri() . '/js/script.js', array('sweet-scroll'), false, true);

    // コメントフォーム移動処理
    if(is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }
  }
  add_action('wp_enqueue_scripts', 'add_files');

  // =============================================================================
  // [フロントサイト]
  // RSSにサムネイルを登録
  // =============================================================================

  function rss_post_thumbnail($content) {
    global $post;
    if(has_post_thumbnail($post->ID)) {
      $content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . $content;
    }
    return $content;
  }
  add_filter('the_excerpt_rss', 'rss_post_thumbnail');
  add_filter('the_content_feed', 'rss_post_thumbnail');

  // =============================================================================
  // [フロントサイト]
  // meta情報生成
  // =============================================================================

  function global_meta() {
    global $meta;

    $meta['url']         = esc_url(home_url('/'));
    $meta['title']       = get_bloginfo('name');
    $meta['description'] = get_bloginfo('description');

    // ヘッダーイメージがある場合
    if(get_header_image()) {
      $meta['image'] = get_header_image();
    }

    // ヘッダーイメージが無ければテーマ画像をセット
    else {
      $meta['image'] = get_template_directory_uri() . '/screenshot.png';
    }

    // ============
    // ホームページ
    // ============

    if(is_home()) {
      $meta['og_type'] = 'blog';
    }
    else {
      $meta['og_type'] = 'article';
    }

    // ==============
    // シングルページ
    // ==============

    if(is_singular()) {
      $meta['url']   = get_permalink();
      $meta['title'] = get_the_title();

      if(have_posts()) {
        while(have_posts()) {
          the_post();
          $meta['description'] = mb_substr(get_the_excerpt(), 0, 100);

          // 投稿に画像があるか調べる
          $str           = $post->post_content;
          $searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>i';

          // アイキャッチがある場合
          if(has_post_thumbnail()) {
            $image_id      = get_post_thumbnail_id();
            $image         = wp_get_attachment_image_src($image_id, 'full');
            $meta['image'] = $image[0];
          }

          // アイキャッチは無いが記事に画像がある場合
          else if(preg_match($searchPattern, $str, $imgurl) && !is_archive()) {
            $meta['image'] = $imgurl[2];
          }
        }
      }
      wp_reset_query();
    }

    // ====================================
    // カテゴリ & タグ & タクソノミーページ
    // ====================================

    if(is_category() || is_tag() || is_tax()) {
      $query         = get_queried_object();
      $meta['url']   = esc_url(get_term_link($query->term_id));
      $meta['title'] = $query->name . 'の記事一覧';
      if($query->description) {
        $meta['description'] = $query->description;
      }
    }

    // ================
    // アーカイブページ
    // ================

    else if(is_archive()) {
      $meta['url'] = esc_url(get_year_link(false, false));

      // 年別アーカイブ
      if(is_year()) {
        $meta['title'] = get_query_var('year') . '年の記事一覧';
      }

      // 月別アーカイブ
      else if(is_month()) {
        $meta['title'] = get_query_var('year') . '年' . get_query_var('monthnum') . '月の記事一覧';
      }
    }
  }

  // =============================================================================
  // [フロントサイト]
  // パンくずリスト
  // =============================================================================

  function breadcrumb() {
    $html = '';

    $html .= '        <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' . "\n";
    $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="' . home_url('/') . '" itemprop="url"><span itemprop="name">ホーム</span></a></li>' . "\n";

    // ==============
    // シングルページ
    // ==============

    if(is_single()) {
      $cat = get_the_category();

      // 親カテゴリが存在（親が無ければ0）
      if($cat[0]->parent != 0) {
        $ancestors = array_reverse(get_ancestors($cat[0]->term_id, 'category'));
        foreach($ancestors as $ancestor) {
          $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="' . esc_url(get_category_link($ancestor)) . '" itemprop="url"><span itemprop="name">' . get_cat_name($ancestor) . '</span></a></li>' . "\n";
        }
      }

      // 現在のページカテゴリ
      $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="' . esc_url(get_category_link($cat[0]->term_id)) . '" itemprop="url"><span itemprop="name">' . $cat[0]->name . '</span></a></li>' . "\n";
    }

    // ==============
    // カテゴリページ
    // ==============

    else if(is_category()) {
      $cat = get_the_category();

      // 親カテゴリが存在（親が無ければ0）
      if($cat[0]->parent != 0) {
        $ancestors = array_reverse(get_ancestors($cat[0]->term_id, 'category'));
        foreach($ancestors as $ancestor) {
          $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="' . esc_url(get_category_link($ancestor)) . '" itemprop="url"><span itemprop="name">' . get_cat_name($ancestor) . '</span></a></li>' . "\n";
        }
      }

      // 現在のページカテゴリ
      $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="' . esc_url(get_category_link($cat[0]->term_id)) . '" itemprop="url"><span itemprop="name">' . $cat[0]->name . '</span></a></li>' . "\n";
    }

    // ==========
    // タグページ
    // ==========

    else if(is_tag()) {
      $tags = get_the_tags();

      $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="' . esc_url(get_tag_link($tags[0]->term_id)) . '" itemprop="url"><span itemprop="name">' . $tags[0]->name . '</span></a></li>' . "\n";
    }

    // ================
    // アーカイブページ
    // ================

    else if(is_archive()) {

      // 年別アーカイブ
      if(is_year()) {
        $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('year') . '</span></li>' . "\n";
      }

      // 月別アーカイブ
      else if(is_month()) {
        $html .= '          <li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('year') . '</span>.<span itemprop="title">' . get_query_var('monthnum') . '</span></li>' . "\n";
      }
    }

    $html .= '        </ul>' . "\n";
    echo $html;
  }

  // =============================================================================
  // [フロントサイト]
  // ページネーション
  // =============================================================================

  // [WordPress Post Pagination without plugin]
  // @author : Kriesi
  // @URL    : http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin

  function custom_pagination($pages = '', $range = 2) {
    global $paged;

    $showitems = ($range * 2) + 1;
    if(empty($paged)) $paged = 1;
    if($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if(!$pages) {
        $pages = 1;
      }
    }
    if(1 != $pages) {
      echo '        <nav class="pagenation">' . "\n";
      echo '          <ul>' . "\n";
      if($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
        echo '            <li><a href="' . get_pagenum_link(1) . '">&laquo;</a></li>' . "\n";
      }
      if($paged > 1 && $showitems < $pages) {
        echo '            <li><a href="' . get_pagenum_link($paged - 1) . '">&lsaquo;</a>' . "\n";
      }
      for($i = 1; $i <= $pages; ++ $i) {
        if(1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
          echo ($paged === $i) ? '            <li class="current">' . $i . '</li>' . "\n" : '           <li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>' . "\n";
        }
      }
      if($paged < $pages && $showitems < $pages) {
        echo '            <li><a href="' . get_pagenum_link($paged + 1) . '">&rsaquo;</a>' . "\n";
      }
      if($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages) {
        echo '            <li><a href="' . get_pagenum_link($pages) . '">&raquo;</a>' . "\n";
      }
      echo '          </ul>' . "\n";
      echo '        </nav>' . "\n";
    }
  }

  // =============================================================================
  // [フロントサイト]
  // コメント一覧
  // =============================================================================

  function theme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    // 承認判定
    if($comment->comment_approved == '1') {
?>
<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
  <div class="comment-avatar"><?php echo get_avatar($comment, 320, get_template_directory_uri() . '/img/avatar-default.png', 'commenter'); ?></div>
  <article>
    <div class="comment-content">
      <?php comment_text(); ?>
    </div>
    <div class="comment-info">
      <span class="name">by <?php comment_author_link(); ?></span>
      <time><?php comment_date(); ?> <?php comment_time(); ?></time>
      <span class="reply"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
    </div>
  </article>
<?php
    }
  }

  // =============================================================================
  // [フロントサイト]
  // HTML圧縮
  // =============================================================================

  // [wordpress-snippets-html-minify.php]
  // @author : ingozoell
  // @URL    : https://gist.github.com/ingozoell/8376125

  class WP_HTML_Compression {
    protected $compress_css    = true;
    protected $compress_js     = true;
    protected $info_comment    = true;
    protected $remove_comments = true;

    protected $html;
    public function __construct($html) {
      if(!empty($html)) {
        $this->parseHTML($html);
      }
    }
    public function __toString() {
      return $this->html;
    }
    protected function bottomComment($raw, $compressed) {
      $raw        = strlen($raw);
      $compressed = strlen($compressed);
      $savings    = ($raw - $compressed) / $raw * 100;
      $savings    = round($savings, 2);
    }
    protected function minifyHTML($html) {
      $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
      preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
      $overriding = false;
      $raw_tag    = false;
      $html       = '';
      foreach($matches as $token) {
        $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
        $content = $token[0];
        if(is_null($tag)) {
          if(!empty($token['script'])) {
            $strip = $this->compress_js;
          }
          else if(!empty($token['style'])) {
            $strip = $this->compress_css;
          }
          else if ($content == '<!--wp-html-compression no compression-->') {
            $overriding = !$overriding;
            continue;
          }
          else if($this->remove_comments) {
            if(!$overriding && $raw_tag != 'textarea') {
              $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
            }
          }
        }
        else {
          if($tag == 'pre' || $tag == 'textarea') {
            $raw_tag = $tag;
          }
          else if($tag == '/pre' || $tag == '/textarea') {
            $raw_tag = false;
          }
          else {
            if($raw_tag || $overriding) {
              $strip = false;
            }
            else {
              $strip = true;
              $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
              $content = str_replace(' />', '/>', $content);
            }
          }
        }
        if($strip) {
          $content = $this->removeWhiteSpace($content);
        }
        $html .= $content;
      }
      return $html;
    }
    public function parseHTML($html) {
      $this->html = $this->minifyHTML($html);
      if($this->info_comment) {
        $this->html .= "\n" . $this->bottomComment($html, $this->html);
      }
    }
    protected function removeWhiteSpace($str) {
      $str = str_replace("\t", ' ', $str);
      $str = str_replace("\n",  '', $str);
      $str = str_replace("\r",  '', $str);
      while(stristr($str, '  ')) {
        $str = str_replace('  ', ' ', $str);
      }
      return $str;
    }
  }
  function wp_html_compression_finish($html) {
    return new WP_HTML_Compression($html);
  }
  function wp_html_compression_start() {
    ob_start('wp_html_compression_finish');
  }

  // HTML圧縮オプションが有効の場合に実行
  if(get_theme_mod('theme_customize__setting__title_tagline__html_minify')) {
    add_action('get_header', 'wp_html_compression_start');
  }

?>
