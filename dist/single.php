<?php get_header(); ?>
        <article class="article-detail" itemscope="itemscope" itemtype="http://schema.org/Article">
<?php
  if(have_posts()) {
    while(have_posts()) {
      the_post();
      $post_id    = get_the_ID();
      $date_year  = get_post_time('Y', $post_id);
      $date_month = get_post_time('m', $post_id);
      $date_day   = get_post_time('d', $post_id);
?>
<?php
      if(has_post_thumbnail()) {
        $thumnbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '1280px');
?>
          <div class="eyecatch">
            <div class="background" style="background-image: url(<?php echo $thumnbnail_url[0]; ?>);"></div>
            <div class="img"><?php the_post_thumbnail('1280px'); ?></div>
          </div>
<?php
      }
?>
          <h2 class="heading"><strong><?php the_title(); ?></strong></h2>
          <dl class="meta">
<?php
      if(has_category()) {
?>
            <dt>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="color--border--stroke" d="M 1 6 L 3 6 L 4 4 L 10 4 L 11 6 L 18 6 L 18 18 L 1 18 L 1 6 Z" stroke-width="1" fill="none" />
                <path class="color--accent--fill" d="M 3 8 L 20 8 L 20 18 L 3 18 L 3 8 Z" />
                <path class="color--background--fill color--border--stroke" d="M 6 10 L 23 10 L 19 20 L 2 20 L 6 10 Z" stroke-width="1" />
              </svg>
            </dt>
            <dd><?php the_category(' / '); ?></dd>
<?php
      }
?>
            <dt>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="color--border--fill" d="M 4 3 L 20 3 C 20.5523 3 21 3.4477 21 4 L 21 20 C 21 20.5523 20.5523 21 20 21 L 4 21 C 3.4477 21 3 20.5523 3 20 L 3 4 C 3 3.4477 3.4477 3 4 3 ZM 2 4 L 2 20 C 2 21.1046 2.8954 22 4 22 L 20 22 C 21.1046 22 22 21.1046 22 20 L 22 4 C 22 2.8954 21.1046 2 20 2 L 4 2 C 2.8954 2 2 2.8954 2 4 Z" />
                <path class="color--border--fill" d="M 18 12 L 20 12 L 20 13 L 18 13 L 18 12 Z" />
                <path class="color--border--fill" d="M 11 18 L 12 18 L 12 20 L 11 20 L 11 18 Z" />
                <path class="color--border--fill" d="M 4 12 L 6 12 L 6 13 L 4 13 L 4 12 Z" />
                <path class="color--accent--fill" d="M 11 4 L 11 11 L 6 11 L 6 13 L 13 13 L 13 4 L 11 4 Z" />
              </svg>
            </dt>
            <dd><time itemprop="datePublished"><a href="<?php echo get_year_link($date_year); ?>"><?php echo $date_year; ?></a>.<a href="<?php echo get_month_link($date_year, $date_month); ?>"><?php echo $date_month; ?></a>.<?php echo $date_day; ?></time></dd>
          </dl>
<!-- content -->
<div class="content">
<?php the_content(); ?>
</div>
<!-- /content -->
<?php
    }
?>
          <div class="node">
            <dl>
              <dt>Writer</dt>
              <dd><?php the_author(); ?></dd>
              <dt>Date</dt>
              <dd><time itemprop="datePublished"><a href="<?php echo get_year_link($date_year); ?>"><?php echo $date_year; ?></a>.<a href="<?php echo get_month_link($date_year, $date_month); ?>"><?php echo $date_month; ?></a>.<?php echo $date_day; ?></time></dd>
<?php
    if(has_category()) {
?>
              <dt>Categories</dt>
              <dd><?php the_category(' / '); ?></dd>
<?php
    }
?>
<?php
    if(has_tag()) {
?>
              <dt>Tags</dt>
              <dd><?php the_tags('', ' / '); ?></dd>
<?php
    }
?>
            </dl>
          </div>
<?php
    $next_post = get_next_post();
    $prev_post = get_previous_post();

    if($next_post || $prev_post) {
?>
          <nav class="adjacent-links">
            <ul>
              <li>
<?php
      if($prev_post) {
?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev"><?php echo get_the_post_thumbnail($prev_post->ID, '640px'); ?><?php echo esc_attr($prev_post->post_title); ?></a>
<?php
      }
?>
              </li>
              <li>
<?php
      if($next_post) {
?>
                <a href="<?php echo get_permalink($next_post->ID); ?>" class="next"><?php echo get_the_post_thumbnail($next_post->ID, '640px'); ?><?php echo esc_attr($next_post->post_title); ?></a>
<?php
      }
?>
              </li>
            </ul>
          </nav>
<?php
    }
?>
<?php
    // コメント許可
    if(comments_open()) {
      comments_template();
    }
?>
<?php
  }
  wp_reset_query();
?>
        </article>
<?php get_footer(); ?>
