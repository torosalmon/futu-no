<?php
/*!
 * *****************************************************************************
 * [futu-no]
 * @Template Name : Archives List
 * @URL           : http://trs.mn/blog/futu-no/
 * @License       : MIT License
 * *****************************************************************************
!*/
?>
<?php get_header(); ?>
        <article class="archive-list" itemscope="itemscope" itemtype="http://schema.org/Article">
<?php
  if(have_posts()) {
    while(have_posts()) {
      the_post();
      $post_id    = get_the_ID();
      $date_year  = get_post_time('Y', $post_id);
      $date_month = get_post_time('m', $post_id);
      $date_day   = get_post_time('d', $post_id);
?>
          <section>
            <h3 class="heading">
              <a href="<?php the_permalink(); ?>">
<?php
      if(has_post_thumbnail()) {
?>
                <div class="eyecatch"><?php the_post_thumbnail('640px'); ?></div>
<?php
      }
?>
                <strong><?php the_title(); ?></strong>
              </a>
            </h3>
            <dl class="meta">
              <dt class="date">Date</dt>
              <dd><time itemprop="datePublished"><a href="<?php echo get_year_link($date_year); ?>"><?php echo $date_year; ?></a>.<a href="<?php echo get_month_link($date_year, $date_month); ?>"><?php echo $date_month; ?></a>.<?php echo $date_day; ?></time></dd>
<?php
      if(has_category()) {
?>
              <dt class="category">Category</dt>
              <dd><?php the_category(' '); ?></dd>
<?php
      }
?>
            </dl>
          </section>
<?php
    }
  }
  wp_reset_query();
?>
        </article>
<?php custom_pagination(); ?>
<?php get_footer(); ?>
