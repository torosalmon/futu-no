              <aside id="comment" class="article-comment">
                <?php if(have_comments()) : ?>
                  <h6>Comments</h6>
                  <div class="comment-list">
                    <ul class="parent">
                      <?php
                        $args = array(
                          'format'    => 'html5',
                          'type'      => 'comment',
                          'max_depth' => 2,
                          'callback'  => 'theme_comment',
                        );
                        wp_list_comments($args);
                      ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <?php
                  $args = array(
                    'comment_notes_before' => '',
                    'comment_notes_after'  => '',
                    'comment_field'        => '<div class="flex">' . "\n" .
                                              '  <div class="flex-item"><label for="comment-form-comment">' . _x('Comment', 'noun') . ' <span>(required)</span></label></div>' . "\n" .
                                              '  <div class="flex-item"><textarea id="comment-form-comment" name="comment" placeholder=":)" required aria-required="true"></textarea></div>' . "\n" .
                                              '</div>' . "\n",
                    'fields'               => array(
                      'author'             => '<div class="flex">' . "\n" .
                                              '  <div class="flex-item"><label for="comment-form-author">' . __('Name') . ($req ? ' <span>(required)</span>' : '') . '</label></div>' . "\n" .
                                              '  <div class="flex-item"><input type="text" id="comment-form-author" name="author" value="' . esc_attr($commenter['comment_author']) . '" placeholder="You"' . ($req ? ' required aria-required="true"' : '') . '></div>' . "\n" .
                                              '</div>',
                      'email'              => '<div class="flex">' . "\n" .
                                              '  <div class="flex-item"><label for="comment-form-email">' . __('Email') . ($req ? ' <span>(required)</span>' : '') . '</label></div>' . "\n" .
                                              '  <div class="flex-item"><input type="email" id="comment-form-email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="mail@domain.com"' . ($req ? ' required aria-required="true"' : '') . '></div>' . "\n" .
                                              '</div>',
                      'url'                => '<div class="flex">' . "\n" .
                                              '  <div class="flex-item"><label for="comment-form-url">' . __('Website', 'domainreference') . '</label></div>' . "\n" .
                                              '  <div class="flex-item"><input type="url" id="comment-form-url" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="http://"></div>' . "\n" .
                                              '</div>',
                    )
                  );
                  comment_form($args);
                ?>
              </aside>
