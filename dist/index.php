<?php global_meta(); ?>
<?php get_header(); ?>
      <div class="container--s">
        <nav class="latest-article" itemscope="itemscope" itemtype="http://schema.org/Article">
          <?php
            // =============================================================================
            // 最新記事（最新1件）
            // =============================================================================
          ?>
          <?php
            $args = array(
              'order' => 'DESC',
              'orderby' => 'date',
              'no_found_rows' => true,
              'posts_per_page' => 1
            );
            $wq_query = new WP_Query($args);
          ?>
          <?php if ($wq_query->have_posts()): ?>
            <?php while ($wq_query->have_posts()): ?>
              <?php
                $wq_query->the_post();
                $post_title = get_the_title();
              ?>
              <section>
                <a href="<?= get_the_permalink(); ?>" title="<?= $post_title; ?>">
                  <?php if (has_post_thumbnail()): ?>
                    <div class="eyecatch">
                      <?php the_post_thumbnail('1280px'); ?>
                    </div>
                  <?php endif; ?>
                  <div class="meta">
                    <time itemprop="datePublished"><?= get_the_time('Y.m.d'); ?></time>
                    <h2><?= $post_title; ?></h2>
                  </div>
                </a>
              </section>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
          <?php
            // =============================================================================
            // 最新記事（2件目以降）
            // =============================================================================
          ?>
          <?php
            $args = array(
              'order' => 'DESC',
              'orderby' => 'date',
              'no_found_rows' => true,
              'offset' => 1
            );
            $wq_query = new WP_Query($args);
          ?>
          <?php if ($wq_query->have_posts()): ?>
            <?php while ($wq_query->have_posts()): ?>
              <?php
                $wq_query->the_post();
                $post_title = get_the_title();
              ?>
              <section>
                <a href="<?= get_the_permalink(); ?>" title="<?= $post_title; ?>">
                  <?php if (has_post_thumbnail()): ?>
                    <div class="eyecatch">
                      <?php $thumnbnail_320px_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '320px'); ?>
                      <img src="<?= $thumnbnail_320px_url[0]; ?>" alt="<?= $post_title; ?>" loading="lazy">
                    </div>
                  <?php endif; ?>
                  <div class="meta">
                    <time itemprop="datePublished"><?= get_the_time('Y.m.d'); ?></time>
                    <h2><?= $post_title; ?></h2>
                  </div>
                </a>
              </section>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
        </nav>
      </div>
<?php get_footer(); ?>
