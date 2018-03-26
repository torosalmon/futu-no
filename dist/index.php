<?php get_header(); ?>
        <nav class="toplevel-list" itemscope="itemscope" itemtype="http://schema.org/Article">
<?php

  // ===================
  // 最新記事（最新1件）
  // ===================

  $args = array(
    'order'          => 'DESC',
    'orderby'        => 'date',
    'posts_per_page' => 1,
  );
  $wq_query = new WP_Query($args);
  if($wq_query->have_posts()) {
?>
          <article class="latest-1">
<?php
    while($wq_query->have_posts()) {
      $wq_query->the_post();
?>
            <section>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="eyecatch">
<?php
      if(has_post_thumbnail()) {
?>
                  <?php the_post_thumbnail('1280px'); ?>
<?php
      }
?>
                </div>
                <div class="meta">
                  <time itemprop="datePublished"><?php the_time('Y.m.d'); ?></time>
                  <h2><?php the_title(); ?></h2>
                </div>
              </a>
            </section>
<?php
    }
?>
          </article>
<?php
    wp_reset_query();

    // =====================
    // 最新記事（2件目以降）
    // =====================

    $args = array(
      'order'   => 'DESC',
      'orderby' => 'date',
      'offset'  => 1,
    );
    $wq_query = new WP_Query($args);
?>
          <article class="latest-2">
<?php
    while($wq_query->have_posts()) {
      $wq_query->the_post();
?>
            <section>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="eyecatch">
<?php
      if(has_post_thumbnail()) {
?>
                  <?php the_post_thumbnail('640px'); ?>
<?php
      } else {
?>
                  <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php the_title(); ?>">
<?php
      }
?>
                </div>
                <div class="meta">
                  <time itemprop="datePublished"><?php the_time('Y.m.d'); ?></time>
                  <h2><?php the_title(); ?></h2>
                </div>
              </a>
            </section>
<?php
    }
?>
          </article>
<?php
  }
  else {
?>
          <nav class="error">
            <h2>New Blog</h2>
            <p>まだ記事はありません。</p>
          </nav>
<?php
  }
  wp_reset_query();
?>
          <nav class="dir-map">
            <section>
              <h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path class="color--border--fill" d="M 4 2 L 4 22 L 20 22 L 20 10 L 19 10 L 19 21 L 5 21 L 5 3 L 12 3 L 12 2 L 4 2 Z" />
                  <path class="color--accent--fill" d="M 12 2 L 12 10 L 20 10 L 12 2 Z" />
                </svg>
                Pages
              </h6>
<!-- page list -->
<ul>
<?php
  $args = array(
    'title_li'    => '',
    'sort_column' => 'menu_order',
    'sort_order'  => 'ASC',
  );
  wp_list_pages($args);
?>
</ul>
<!-- /page list -->
            </section>
            <section>
              <h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path class="color--border--stroke" d="M 1 6 L 3 6 L 4 4 L 10 4 L 11 6 L 18 6 L 18 18 L 1 18 L 1 6 Z" stroke-width="1" fill="none" />
                  <path class="color--accent--fill" d="M 3 8 L 20 8 L 20 18 L 3 18 L 3 8 Z" />
                  <path class="color--border--stroke color--background--fill" d="M 6 10 L 23 10 L 19 20 L 2 20 L 6 10 Z" stroke-width="1" />
                </svg>
                Categories
              </h6>
<!-- category list -->
<ul>
<?php
  $args = array(
    'title_li' => '',
  );
  wp_list_categories($args);
?>
</ul>
<!-- /category list -->
            </section>
            <section>
              <h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path class="color--border--fill" d="M 4 3 L 20 3 C 20.5523 3 21 3.4477 21 4 L 21 20 C 21 20.5523 20.5523 21 20 21 L 4 21 C 3.4477 21 3 20.5523 3 20 L 3 4 C 3 3.4477 3.4477 3 4 3 ZM 2 4 L 2 20 C 2 21.1046 2.8954 22 4 22 L 20 22 C 21.1046 22 22 21.1046 22 20 L 22 4 C 22 2.8954 21.1046 2 20 2 L 4 2 C 2.8954 2 2 2.8954 2 4 Z" />
                  <path class="color--border--fill" d="M 18 12 L 20 12 L 20 13 L 18 13 L 18 12 Z" />
                  <path class="color--border--fill" d="M 11 18 L 12 18 L 12 20 L 11 20 L 11 18 Z" />
                  <path class="color--border--fill" d="M 4 12 L 6 12 L 6 13 L 4 13 L 4 12 Z" />
                  <path class="color--accent--fill" d="M 11 4 L 11 11 L 6 11 L 6 13 L 13 13 L 13 4 L 11 4 Z" />
                </svg>
                Archives
              </h6>
<!-- archive list -->
<ul>
<?php
  $args = array(
    'limit' => '12',
  );
  wp_get_archives($args);
?>
</ul>
<!-- /archive list -->
            </section>
          </nav>
        </nav>
<?php get_footer(); ?>
