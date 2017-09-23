<?php include 'header.php'; ?>

        <div class="mh-header-nav-mobile clearfix"></div>
          <div class="mh-wrapper clearfix">
            <div class="mh-main clearfix">
                <div id="main-content" class="mh-loop mh-content" role="main">

                    <!-- Breadcrumb  TODO-generate programmatically -->
                    <nav class="mh-breadcrumb">
                      <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="<?php echo get_home_url() ?>" itemprop="url">
                          <span itemprop="title">Home</span>
                        </a>
                        </span>
                        <span class="mh-breadcrumb-delimiter">
                          <i class="fa fa-angle-right"></i>
                        </span>
                        <?php the_archive_title(); ?>
                      </nav>

                    <header class="page-header">
                        <?php the_archive_title('<h1 class="page-title">', '</h1>' ); ?>
                    </header>

                    <?php if ( have_posts()): ?>
                        <?php
                            while ( have_posts() ) : the_post();
                                $background_image = has_post_thumbnail() ?  'style="background-size: cover;width: 326px; height:245px; background-image: url(' . get_the_post_thumbnail_url() . ')"' : '';
                            ?>

                            <article class="mh-posts-list-item clearfix">
                              <figure class="mh-posts-list-thumb" >
                                  <a class="mh-thumb-icon mh-thumb-icon-small-mobile" href="<?php echo get_permalink(); ?>" <?php echo $background_image; ?>>
                                    <!--<img width="326" height="245" src="<?php echo get_the_post_thumbnail_url(); ?>" class="attachment-mh-magazine-medium size-mh-magazine-medium wp-post-image" alt="Army" sizes="(max-width: 326px) 100vw, 326px" />-->
                                    </a>
                                  <div class="mh-image-caption mh-posts-list-caption"><?php the_archive_title(); ?></div>
                              </figure>
                              <div class="mh-posts-list-content clearfix">
                                  <header class="mh-posts-list-header">
                                      <h3 class="entry-title mh-posts-list-title"> <a href="<?php echo get_permalink(); ?>"> <?php echo get_the_title(); ?> </a></h3>
                                      <div class="mh-meta entry-meta">
                                        <span class="entry-meta-date updated"><i class="fa fa-clock-o"></i><a href="<?php echo get_permalink() ?>"><?php echo get_post_time('F j, Y')?></a></span>
                                        <span class="entry-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="<?php echo get_the_author_link() ?>"><?php get_the_author(); ?></a></span>
                                        <span class="entry-meta-comments"><i class="fa fa-comment-o"></i><a href="<?php echo get_permalink(); ?>" class="mh-comment-count-link" ><?php echo wp_count_comments()->total_comments ?></a></span>
                                      </div>
                                  </header>
                                  <div class="mh-posts-list-excerpt clearfix">
                                      <div class="mh-excerpt">
                                          <?php the_excerpt(); ?>
                                      </div>
                                  </div>

                                  <style>
                                    .mh-excerpt{
                                      overflow: hidden;
                                    }
                                  </style>
                              </div>
                          </article>

                        <?php endwhile; // end of the loop. ?>
                    <?php else: ?>
                        <div> No <?php the_archive_title(); ?> created yet </div>
                    <?php endif; ?>


                    <div class="mh-loop-pagination clearfix">
                        <nav class="navigation pagination" role="navigation">
                            <h2 class="screen-reader-text">Posts navigation</h2>
                            <div class="nav-links">
                              <?php pagination_bar(); ?>
<!--
                              <span class='page-numbers current'>1</span>
                              <a class='page-numbers' href='page/2/index.html'>2</a>
                              <a class="next page-numbers" href="page/2/index.html">&raquo;</a>-->
                            </div>
                        </nav>
                    </div>
                </div>


                <!--Sidebar Starts here-->

                <!--Ad-->
                <aside class="mh-widget-col-1 mh-sidebar">
                  <div id="text-2" class="mh-widget widget_text">
                    <div class="textwidget">
                      <div class="mh-ad-spot">
                        <a href="#" target="_blank">
                          <img alt="MH Themes" src="<?php echo get_stylesheet_directory_uri()?>/images/ad-banner/Top Sidebar - side-top-300x250.png"> </a>
                        </div>
                      </div>
                    </div>

                      <?php include 'sidebar.php'; ?>

                      <!--Ad -->
                  <div id="text-2" class="mh-widget widget_text">
                    <div class="textwidget">
                      <div class="mh-ad-spot">
                        <a href="#" target="_blank">
                          <img alt="MH Themes" src="<?php echo get_stylesheet_directory_uri()?>/images/ad-banner/Bottom Sidebar - side-bottom-300x250.png"> </a>
                        </div>
                      </div>
                    </div>
                  </aside>

                <!--Sidebar ends here-->

            </div>
        </div>

        <?php include 'footer.php'; ?>
