<?php
  global_meta();
  global $meta;
?>
<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>" <?php body_class(); ?>>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# <?php echo $meta['og_type']; ?>: http://ogp.me/ns/<?php echo $meta['og_type']; ?>#">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no,email=no,address=no">
    <meta name="theme-color" content="#fff">
    <meta name="author" content="<?php bloginfo('name'); ?>">
    <meta name="copyright" content="Copyright © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="<?php bloginfo('name'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:domain" content="<?php echo esc_url(home_url('/')); ?>">
    <meta name="twitter:title" content="<?php echo $meta['title']; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="<?php echo $meta['image']; ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="<?php echo $meta['og_type']; ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo $meta['url']; ?>">
    <meta property="og:title" content="<?php echo $meta['title']; ?>">
    <meta property="og:description" content="<?php echo $meta['description']; ?>">
    <meta property="og:image" content="<?php echo $meta['image']; ?>">
    <link rel="dns-prefetch" href="//cdn.rawgit.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//0.gravatar.com">
    <link rel="alternate" hreflang="<?php bloginfo('language'); ?>" href="<?php echo $meta['url']; ?>">
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="RSS">
    <?php wp_head(); ?>
  </head>
  <body id="top" class="<?php echo 'theme--' . get_theme_mod('theme_customize__setting__colors__overlay_color', 'dark'); ?>" itemscope itemtype="http://schema.org/WebPage">
    <?php
      // =============================================================================
      // ヘッダー
      // =============================================================================
    ?>
    <header class="header js--header">
      <div class="page-info">
        <h1><?php echo $meta['title']; ?></h1>
        <?php if(is_home()) : ?>
          <p class="read" itemprop="description"><?php bloginfo('description'); ?></p>
        <?php else : ?>
          <?php breadcrumb(); ?>
        <?php endif; ?>
        <a href="#top" class="page-top js--scroll">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path class="color--text--fill" d="M 21 20 L 12 11 L 3 20 L 5 22 L 12 15 L 19 22 L 21 20 Z" />
            <path class="color--text--fill" d="M 21 11 L 12 2 L 3 11 L 5 13 L 12 6 L 19 13 L 21 11 Z" />
          </svg>
          <span>ページトップ</span>
        </a>
      </div>
      <nav class="tool">
        <ul>
          <?php if(is_singular() && comments_open()) : ?>
            <li>
              <a href="#comment" class="js--scroll">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path class="color--text--fill" d="M 16 9 L 18 9 L 18 11 L 16 11 L 16 9 ZM 11 9 L 13 9 L 13 11 L 11 11 L 11 9 ZM 6 9 L 8 9 L 8 11 L 6 11 L 6 9 ZM 6 4 C 3.7908 4 2 5.7908 2 8 L 2 12 C 2 14.2092 3.7908 16 6 16 L 10 16 L 14 20 L 14 16 L 18 16 C 20.2092 16 22 14.2092 22 12 L 22 8 C 22 5.7908 20.2092 4 18 4 L 6 4 Z" />
                </svg>
                <?php
                  // コメント件数分岐
                  $comment_total = get_comments_number();
                  settype($comment_total, 'integer');
                ?>
                <?php if($comment_total > 0) : ?>
                  <span class="notification"><?php echo $comment_total; ?></span>
                <?php else : ?>
                  <span>コメント</span>
                <?php endif; ?>
              </a>
            </li>
          <?php endif; ?>
          <li>
            <a href="#share" class="js--share-button">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="color--text--stroke" d="M 19 5 L 5 12 L 19 19 " stroke-width="2" fill="none" />
                <path class="color--text--fill" d="M 2 12 C 2 10.3431 3.3431 9 5 9 C 6.6569 9 8 10.3431 8 12 C 8 13.6569 6.6569 15 5 15 C 3.3431 15 2 13.6569 2 12 Z" />
                <path class="color--text--fill" d="M 16 19 C 16 17.3431 17.3431 16 19 16 C 20.6569 16 22 17.3431 22 19 C 22 20.6569 20.6569 22 19 22 C 17.3431 22 16 20.6569 16 19 Z" />
                <path class="color--text--fill" d="M 16 5 C 16 3.3431 17.3431 2 19 2 C 20.6569 2 22 3.3431 22 5 C 22 6.6569 20.6569 8 19 8 C 17.3431 8 16 6.6569 16 5 Z" />
              </svg>
              <span>共有</span>
            </a>
          </li>
          <li>
            <a href="#search" class="js--search-form-button">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="color--text--fill" d="M 14 17 L 17 14 L 23 20 L 20 23 L 14 17 Z" />
                <path class="color--text--fill" d="M 3 10 C 3 6.134 6.134 3 10 3 C 13.866 3 17 6.134 17 10 C 17 13.866 13.866 17 10 17 C 6.134 17 3 13.866 3 10 ZM 1 10 C 1 14.9706 5.0294 19 10 19 C 14.9706 19 19 14.9706 19 10 C 19 5.0294 14.9706 1 10 1 C 5.0294 1 1 5.0294 1 10 Z" />
              </svg>
              <span>検索</span>
            </a>
          </li>
        </ul>
      </nav>
      <nav class="drawer-icon js--drawer-button">
        <div>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
    </header>
    <?php
      // =============================================================================
      // 検索フォーム
      // =============================================================================
    ?>
    <nav id="search" class="search-form">
      <form name="search" action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">
        <div><input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="検索ワードを入力" required aria-required="true"></div>
        <div><input type="submit" value="🏄"></div>
        <div><span class="close js--search-form-button"></span></div>
      </form>
    </nav>
    <?php
      // =============================================================================
      // メイン
      // =============================================================================
    ?>
    <main class="main">
