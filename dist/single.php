<?php global_meta(); ?>
<?php get_header(); ?>
      <?php if(have_posts()): ?>
        <?php while(have_posts()): ?>
          <?php
            the_post();
            $post_id    = get_the_ID();
            $date_year  = get_post_time('Y', $post_id);
            $date_month = get_post_time('m', $post_id);
            $date_day   = get_post_time('d', $post_id);
          ?>
          <article class="article-detail" itemscope="itemscope" itemtype="http://schema.org/Article">
            <?php
              // =============================================================================
              // アイキャッチ
              // =============================================================================
            ?>
            <?php if(has_post_thumbnail()): ?>
              <div class="eyecatch">
                <div class="background">
                  <?php $thumnbnail_1280px_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '1280px'); ?>
                  <div class="background-image js--parallax" data-parallax-friction="4" style="background-image: url(<?= $thumnbnail_1280px_url[0]; ?>);"></div>
                </div>
                <div class="container--l">
                  <div class="img"><?php the_post_thumbnail('1280px'); ?></div>
                </div>
              </div>
            <?php endif; ?>
            <div class="container--s">
              <?php
                // =============================================================================
                // 見出し
                // =============================================================================
              ?>
              <h2 class="heading"><strong><?= get_the_title(); ?></strong></h2>
              <dl class="meta">
                <div>
                  <dt>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                      <path class="color--border--fill" d="M 4 3 L 20 3 C 20.5523 3 21 3.4477 21 4 L 21 20 C 21 20.5523 20.5523 21 20 21 L 4 21 C 3.4477 21 3 20.5523 3 20 L 3 4 C 3 3.4477 3.4477 3 4 3 ZM 2 4 L 2 20 C 2 21.1046 2.8954 22 4 22 L 20 22 C 21.1046 22 22 21.1046 22 20 L 22 4 C 22 2.8954 21.1046 2 20 2 L 4 2 C 2.8954 2 2 2.8954 2 4 Z" />
                      <path class="color--border--fill" d="M 18 12 L 20 12 L 20 13 L 18 13 L 18 12 Z" />
                      <path class="color--border--fill" d="M 11 18 L 12 18 L 12 20 L 11 20 L 11 18 Z" />
                      <path class="color--border--fill" d="M 4 12 L 6 12 L 6 13 L 4 13 L 4 12 Z" />
                      <path class="color--accent--fill" d="M 11 4 L 11 11 L 6 11 L 6 13 L 13 13 L 13 4 L 11 4 Z" />
                    </svg>
                  </dt>
                  <dd><time itemprop="datePublished"><a href="<?= get_year_link($date_year); ?>"><?= $date_year; ?></a>.<a href="<?= get_month_link($date_year, $date_month); ?>"><?= $date_month; ?></a>.<?= $date_day; ?></time></dd>
                </div>
                <?php if(has_category()): ?>
                  <div>
                    <dt>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path class="color--border--stroke" d="M 1 6 L 3 6 L 4 4 L 10 4 L 11 6 L 18 6 L 18 18 L 1 18 L 1 6 Z" stroke-width="1" fill="none" />
                        <path class="color--accent--fill" d="M 3 8 L 20 8 L 20 18 L 3 18 L 3 8 Z" />
                        <path class="color--background--fill color--border--stroke" d="M 6 10 L 23 10 L 19 20 L 2 20 L 6 10 Z" stroke-width="1" />
                      </svg>
                    </dt>
                    <dd><?php the_category(', '); ?></dd>
                  </div>
                <?php endif; ?>
                <?php if(has_tag()): ?>
                  <div>
                    <dt>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path class="color--border--stroke" d="M 4 2 L 19 2 L 19 21 L 4 21 L 4 2 ZM 3 1 L 3 21 L 5 23 L 21 23 L 21 3 L 19 1 L 3 1 Z" fill="none" />
                        <path class="color--accent--fill" d="M 6 1 L 12 1 L 12 16 L 9 13 L 6 16 L 6 1 Z" />
                      </svg>
                    </dt>
                    <dd><?php the_tags('', ', '); ?></dd>
                  </div>
                <?php endif; ?>
              </dl>
              <?php
                // =============================================================================
                // 本文
                // =============================================================================
              ?>
              <div class="content">
                <?php the_content(); ?>
              </div>
              <div class="node">
                <table>
                  <tbody>
                    <tr>
                      <th>Writer</th>
                      <td><?= get_the_author(); ?></td>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <td><time itemprop="datePublished"><a href="<?= get_year_link($date_year); ?>"><?= $date_year; ?></a>.<a href="<?= get_month_link($date_year, $date_month); ?>"><?= $date_month; ?></a>.<?= $date_day; ?></time></td>
                    </tr>
                    <?php if(has_category()): ?>
                      <tr>
                        <th>Categories</th>
                        <td><?php the_category(', '); ?></td>
                      </tr>
                    <?php endif; ?>
                    <?php if(has_tag()): ?>
                      <tr>
                        <th>Tags</th>
                        <td><?php the_tags('', ', '); ?></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <?php
                // =============================================================================
                // 隣接リンク
                // =============================================================================
              ?>
              <?php
                $next_post = get_next_post();
                $prev_post = get_previous_post();
              ?>
              <?php if($next_post || $prev_post): ?>
                <nav class="adjacent-links">
                  <ul>
                    <?php if($prev_post): ?>
                      <li>
                        <a class="prev" href="<?= get_permalink($prev_post->ID); ?>">
                          <?php if(has_post_thumbnail($prev_post->ID)): ?>
                            <?php $thumnbnail_320px_url = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), '320px'); ?>
                            <img src="<?= $thumnbnail_320px_url[0]; ?>" alt="<?= esc_attr($prev_post->post_title); ?>">
                          <?php endif; ?>
                          <?= esc_attr($prev_post->post_title); ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if($next_post): ?>
                      <li>
                        <a class="next" href="<?= get_permalink($next_post->ID); ?>">
                          <?php if(has_post_thumbnail($next_post->ID)): ?>
                            <?php $thumnbnail_320px_url = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), '320px'); ?>
                            <img src="<?= $thumnbnail_320px_url[0]; ?>" alt="<?= esc_attr($next_post->post_title); ?>">
                          <?php endif; ?>
                          <?= esc_attr($next_post->post_title); ?>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </nav>
              <?php endif; ?>
              <?php
                // =============================================================================
                // コメント
                // =============================================================================
              ?>
              <?php if(comments_open()): ?>
                <?php comments_template(); ?>
              <?php endif; ?>
            </div>
          </article>
        <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
<?php get_footer(); ?>
