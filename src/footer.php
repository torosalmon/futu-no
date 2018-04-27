<?php global $meta; ?>
      <?php
        // =============================================================================
        // フッター
        // =============================================================================
      ?>
      <footer class="footer">
        <p><small>Copyright © <?= date('Y'); ?> <?= $meta['name']; ?></small></p>
        <ul>
          <li><a href="https://ja.wordpress.org/" target="_blank">WordPress</a></li>
          <li><a href="http://trs.mn/blog/" target="_blank">futu-no</a></li>
        </ul>
        <?php if(get_option('users_can_register')): ?>
          <p class="register"><a href="<?= $meta['home_url']; ?>wp-login.php?action=register" target="_blank">ブログにユーザー登録</a></p>
        <?php endif; ?>
      </footer>
    </main>
    <?php
      // =============================================================================
      // ドロワー
      // =============================================================================
    ?>
    <aside class="drawer">
      <div class="scroll">
        <?php if(!is_search()): ?>
          <?php if(have_posts()): ?>
            <?php while(have_posts()): ?>
              <?php
                the_post();
                $author_id = $post->post_author;
              ?>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
          <div class="author">
            <div class="avatar"><?= get_avatar($author_id, 160, $meta['template_directory_uri'] . '/img/avatar-default.png', 'Author'); ?></div>
            <div class="name"><?= get_the_author_meta('display_name', $author_id); ?></div>
            <?php if(get_the_author_meta('description') != ''): ?>
              <div class="comment"><?= get_the_author_meta('description', $author_id); ?></div>
            <?php endif; ?>
            <ul class="links">
              <?php if(get_the_author_meta('user_url') != ''): ?>
                <li><a class="home" href="<?= get_the_author_meta('user_url', $author_id); ?>" target="_blank">Home</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('skype') != ''): ?>
                <li><a href="skype:<?= get_the_author_meta('skype', $author_id); ?>">Skype</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('facebook') != ''): ?>
                <li><a href="<?= get_the_author_meta('facebook', $author_id); ?>" target="_blank">Facebook</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('twitter') != ''): ?>
                <li><a href="<?= get_the_author_meta('twitter', $author_id); ?>" target="_blank">Twitter</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('google_plus') != ''): ?>
                <li><a href="<?= get_the_author_meta('google_plus', $author_id); ?>" target="_blank">Google +</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('mixi') != ''): ?>
                <li><a href="<?= get_the_author_meta('mixi', $author_id); ?>" target="_blank">mixi</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('tumblr') != ''): ?>
                <li><a href="<?= get_the_author_meta('tumblr', $author_id); ?>" target="_blank">Tumblr</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('instagram') != ''): ?>
                <li><a href="<?= get_the_author_meta('instagram', $author_id); ?>" target="_blank">Instagram</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('flickr') != ''): ?>
                <li><a href="<?= get_the_author_meta('flickr', $author_id); ?>" target="_blank">Flickr</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('photohito') != ''): ?>
                <li><a href="<?= get_the_author_meta('photohito', $author_id); ?>" target="_blank">PHOTOHITO</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('pixiv') != ''): ?>
                <li><a href="<?= get_the_author_meta('pixiv', $author_id); ?>" target="_blank">pixiv</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('pawoo') != ''): ?>
                <li><a href="<?= get_the_author_meta('pawoo', $author_id); ?>" target="_blank">Pawoo</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('github') != ''): ?>
                <li><a href="<?= get_the_author_meta('github', $author_id); ?>" target="_blank">GitHub</a></li>
              <?php endif; ?>
              <?php if(get_the_author_meta('qiita') != ''): ?>
                <li><a href="<?= get_the_author_meta('qiita', $author_id); ?>" target="_blank">Qiita</a></li>
              <?php endif; ?>
            </ul>
          </div>
        <?php endif; ?>
        <nav class="dir-map">
          <h6>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path class="color--border--fill" d="M 4 2 L 4 22 L 20 22 L 20 10 L 19 10 L 19 21 L 5 21 L 5 3 L 12 3 L 12 2 L 4 2 Z" />
              <path class="color--accent--fill" d="M 12 2 L 12 10 L 20 10 L 12 2 Z" />
            </svg>
            Pages
          </h6>
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
          <h6>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path class="color--border--stroke" d="M 1 6 L 3 6 L 4 4 L 10 4 L 11 6 L 18 6 L 18 18 L 1 18 L 1 6 Z" stroke-width="1" fill="none" />
              <path class="color--accent--fill" d="M 3 8 L 20 8 L 20 18 L 3 18 L 3 8 Z" />
              <path class="color--border--stroke color--sub--fill" d="M 6 10 L 23 10 L 19 20 L 2 20 L 6 10 Z" stroke-width="1" />
            </svg>
            Categories
          </h6>
          <ul>
            <?php
              $args = array(
                'title_li' => '',
              );
              wp_list_categories($args);
            ?>
          </ul>
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
          <ul>
            <?php
              $args = array(
                'limit' => '12',
              );
              wp_get_archives($args);
            ?>
          </ul>
        </nav>
        <nav class="feed">
          <a href="<?= $meta['rss2_url']; ?>" title="RSS" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path class="color--accent--fill" d="M 0 21 C 0 19.3431 1.3431 18 3 18 C 4.6569 18 6 19.3431 6 21 C 6 22.6569 4.6569 24 3 24 C 1.3431 24 0 22.6569 0 21 Z" />
              <path class="color--accent--fill" d="M 16 24 C 16 15.1633 8.8367 8 0 8 L 0 11 C 7.1798 11 13 16.8202 13 24 L 16 24 Z" />
              <path class="color--accent--fill" d="M 24 24 C 24 10.745 13.255 0 0 0 L 0 4 C 11.0458 4 20 12.9542 20 24 L 24 24 Z" />
            </svg>
            RSS
          </a>
        </nav>
      </div>
    </aside>
    <?php
      // =============================================================================
      // 共有
      // =============================================================================
    ?>
    <aside id="share" class="share">
      <div class="scroll">
        <div class="description">
          <h6>
            Share
            <strong><?= $meta['title']; ?></strong>
          </h6>
        </div>
        <ul class="service-list">
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a class="google-plus" href="https://plus.google.com/share?url=<?= $meta['current_url']; ?>" target="_blank">Google+</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $meta['current_url']; ?>" target="_blank">Facebook</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a class="twitter" href="https://twitter.com/share?url=<?= $meta['current_url']; ?>&amp;text=<?= $meta['title']; ?>" target="_blank">Twitter</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a class="line" href="http://line.me/R/msg/text/?<?= $meta['title']; ?><?= $meta['current_url']; ?>" target="_blank">LINE</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a class="feedly" href="https://feedly.com/i/subscription/feed/<?= urlencode($meta['home_url']); ?>" target="_blank">Feedly</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a class="hatena" href="http://b.hatena.ne.jp/entry/<?= $meta['current_url']; ?>" data-hatena-bookmark-title="<?= $meta['title']; ?>" target="_blank">はてなブックマーク</a>
          </li>
        </ul>
        <div class="close js--share-button"></div>
      </div>
    </aside>
    <div class="overlay js--overlay"></div>
    <?php wp_footer(); ?>
  </body>
</html>
