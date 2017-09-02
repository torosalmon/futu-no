<?php
/*!
 * *****************************************************************************
 * [futu-no]
 * @Template Name : HTML Footer
 * @URL           : http://trs.mn/blog/futu-no/
 * @License       : MIT License
 * *****************************************************************************
!*/
?>
<?php global $meta; ?>
      </article>
      <!-- /コンテンツ -->

      <!-- フッター -->
      <footer>
        <p><small>Copyright © <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small></p>
        <ul>
          <li><a href="https://ja.wordpress.org/" target="_blank">WordPress</a></li>
          <li><a href="http://trs.mn/blog/" target="_blank">futu-no</a></li>
        </ul>
<?php
  // 「誰でもユーザー登録ができるようにする」判定
  if(get_option('users_can_register')) {
?>
        <p class="register"><a href="<?php echo esc_url(home_url('/')); ?>wp-login.php?action=register" target="_blank">ブログにユーザー登録</a></p>
<?php
  }
?>
      </footer>
      <!-- /フッター -->

    </main>

    <!-- ======= -->
    <!-- /メイン -->
    <!-- ======= -->

    <!-- ======== -->
    <!-- ドロワー -->
    <!-- ======== -->

    <aside class="drawer">
      <div class="scroll">
<?php
  // 検索ページでは情報が取得できないので非表示
  if(!is_search()) {
    if(have_posts()) {
      while(have_posts()) {
        the_post();
        $author_id = $post->post_author;
      }
    }
    wp_reset_query();
?>
        <div class="author">
          <div class="avatar"><?php echo get_avatar($author_id, 320, get_template_directory_uri() . '/img/avatar-default.png', 'Author'); ?></div>
          <div class="name"><?php echo get_the_author_meta('display_name', $author_id); ?></div>
<?php
    if(get_the_author_meta('description') != '') {
      echo '          <p class="comment">' . get_the_author_meta('description', $author_id) . '</p>' . "\n";
    }
?>
          <ul class="links">
<?php
    if(get_the_author_meta('user_url') != '') {
      echo '            <li><a href="' . get_the_author_meta('user_url', $author_id) . '" target="_blank" class="home">Home</a></li>' . "\n";
    }
    if(get_the_author_meta('skype') != '') {
      echo '            <li><a href="skype:' . get_the_author_meta('skype', $author_id) . '">Skype</a></li>' . "\n";
    }
    if(get_the_author_meta('facebook') != '') {
      echo '            <li><a href="' . get_the_author_meta('facebook', $author_id) . '" target="_blank">Facebook</a></li>' . "\n";
    }
    if(get_the_author_meta('twitter') != '') {
      echo '            <li><a href="' . get_the_author_meta('twitter', $author_id) . '" target="_blank">Twitter</a></li>' . "\n";
    }
    if(get_the_author_meta('google_plus') != '') {
      echo '            <li><a href="' . get_the_author_meta('google_plus', $author_id) . '" target="_blank">Google +</a></li>' . "\n";
    }
    if(get_the_author_meta('mastodon') != '') {
      echo '            <li><a href="' . get_the_author_meta('mastodon', $author_id) . '" target="_blank">Mastodon</a></li>' . "\n";
    }
    if(get_the_author_meta('mixi') != '') {
      echo '            <li><a href="' . get_the_author_meta('mixi', $author_id) . '" target="_blank">mixi</a></li>' . "\n";
    }
    if(get_the_author_meta('tumblr') != '') {
      echo '            <li><a href="' . get_the_author_meta('tumblr', $author_id) . '" target="_blank">Tumblr</a></li>' . "\n";
    }
    if(get_the_author_meta('instagram') != '') {
      echo '            <li><a href="' . get_the_author_meta('instagram', $author_id) . '" target="_blank">Instagram</a></li>' . "\n";
    }
    if(get_the_author_meta('flickr') != '') {
      echo '            <li><a href="' . get_the_author_meta('flickr', $author_id) . '" target="_blank">Flickr</a></li>' . "\n";
    }
    if(get_the_author_meta('photohito') != '') {
      echo '            <li><a href="' . get_the_author_meta('photohito', $author_id) . '" target="_blank">PHOTOHITO</a></li>' . "\n";
    }
    if(get_the_author_meta('pixiv') != '') {
      echo '            <li><a href="' . get_the_author_meta('pixiv', $author_id) . '" target="_blank">pixiv</a></li>' . "\n";
    }
    if(get_the_author_meta('github') != '') {
      echo '            <li><a href="' . get_the_author_meta('github', $author_id) . '" target="_blank">GitHub</a></li>' . "\n";
    }
    if(get_the_author_meta('qiita') != '') {
      echo '            <li><a href="' . get_the_author_meta('qiita', $author_id) . '" target="_blank">Qiita</a></li>' . "\n";
    }
?>
          </ul>
        </div>
<?php
  }
?>
        <nav class="dir-map">
          <h6>Pages</h6>
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
          <h6>Categories</h6>
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
          <h6>Archives</h6>
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
        </nav>
      </div>
    </aside>

    <!-- ========= -->
    <!-- /ドロワー -->
    <!-- ========= -->

    <!-- ================ -->
    <!-- 共有オーバーレイ -->
    <!-- ================ -->

    <aside id="share" class="share-overlay">
      <div class="scroll">
        <div class="description">
          <h6>
            外部サービスへ共有
            <strong><?php echo $meta['title']; ?></strong>
          </h6>
        </div>
        <ul class="service-list">
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a href="https://plus.google.com/share?url=<?php echo $meta['url']; ?>" target="_blank" class="google-plus">Google+</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a href="https://www.facebook.com/sharer.php?t=<?php echo $meta['title']; ?>&amp;u=<?php echo $meta['url']; ?>" target="_blank" class="facebook">Facebook</a>
          </li>
          <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
              <path d="M 2 20 C 2 10.0587 10.0587 2 20 2 C 29.9413 2 38 10.0587 38 20 C 38 29.9413 29.9413 38 20 38 C 10.0587 38 2 29.9413 2 20 Z" />
            </svg>
            <a href="https://twitter.com/share?text=<?php echo $meta['title']; ?>&amp;url=<?php echo $meta['url']; ?>" target="_blank" class="twitter">Twitter</a>
          </li>
        </ul>
        <div class="close js-share-overlay-close"></div>
      </div>
    </aside>

    <!-- ================= -->
    <!-- /共有オーバーレイ -->
    <!-- ================= -->

    <?php wp_footer(); ?>
  </body>
</html>