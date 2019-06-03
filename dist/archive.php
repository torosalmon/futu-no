<?php global_meta(); ?>
<?php get_header(); ?>
      <?php
        // =============================================================================
        // 一覧表示
        // =============================================================================
      ?>
      <?php if (have_posts()): ?>
        <div class="container--l">
          <nav class="archive-list" itemscope="itemscope" itemtype="http://schema.org/Article">
            <?php while (have_posts()): ?>
              <?php
                the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $date_year = get_post_time('Y', $post_id);
                $date_month = get_post_time('m', $post_id);
                $date_day = get_post_time('d', $post_id);
              ?>
              <section>
                <h3 class="heading">
                  <a href="<?= get_the_permalink(); ?>">
                    <div class="eyecatch">
                      <?php if (has_post_thumbnail()): ?>
                        <?php
                          $post_thumbnail_id = get_post_thumbnail_id();
                          $thumnbnail_320px_url = wp_get_attachment_image_src($post_thumbnail_id, '320px');
                          $thumnbnail_640px_url = wp_get_attachment_image_src($post_thumbnail_id, '640px');
                        ?>
                        <picture>
                          <source media="(max-width: 768px)" data-srcset="<?= $thumnbnail_320px_url[0]; ?>">
                          <img src="<?= $thumnbnail_640px_url[0]; ?>" alt="<?= $post_title; ?>" loading="lazy">
                        </picture>
                      <?php else: ?>
                        <img src="<?= $meta['template_directory_uri'] ?>/img/spacer.gif" alt="<?= $post_title; ?>" loading="lazy">
                      <?php endif; ?>
                    </div>
                    <strong><?= $post_title; ?></strong>
                  </a>
                </h3>
                <dl class="meta">
                  <dt class="date">Date</dt>
                  <dd><time itemprop="datePublished"><a href="<?= get_year_link($date_year); ?>"><?= $date_year; ?></a>.<a href="<?= get_month_link($date_year, $date_month); ?>"><?= $date_month; ?></a>.<?= $date_day; ?></time></dd>
                  <?php if (has_category()): ?>
                    <dt class="category">Category</dt>
                    <dd><?php the_category(', '); ?></dd>
                  <?php endif; ?>
                </dl>
              </section>
            <?php endwhile; ?>
          </nav>
          <?php custom_pagination(); ?>
        </div>
      <?php
        // =============================================================================
        // 0件表示
        // =============================================================================
      ?>
      <?php else: ?>
        <div class="container--s">
          <nav class="error">
            <h2>Not Found</h2>
            <p>見つかりませんでしたよ。</p>
          </nav>
        </div>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
<?php get_footer(); ?>
