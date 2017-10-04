<?php
/**
 * The template for displaying single post
 *
 * This is the template that displays all single post of any post type by default.
 *
 * @package theScript
 * @subpackage Single Template
 * @since v2017.01
 */

get_header(); ?>

        <div class="mh-wrapper clearfix">
            <div class="mh-main clearfix">
                <div id="main-content" class="mh-content" role="main" itemprop="mainContentOfPage">

                    <!--Breadcrumb-->
                    <nav class="mh-breadcrumb"><span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.php" itemprop="url"><span itemprop="title">Home</span></a>
                        </span><span class="mh-breadcrumb-delimiter"><i class="fa fa-angle-right"></i></span><span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                         <?php
                            $category = get_the_category(); 
                            $category_link = get_category_link($category[0]->cat_ID);
                            $category_name = $category[0]->cat_name;
                        ?>

                        <a href="<?php echo $category_link ?>" itemprop="url">
                        <span itemprop="title"><?php echo $category_name?></span>
                        </a>
                        </span><span class="mh-breadcrumb-delimiter"><i class="fa fa-angle-right"></i></span><?php echo get_the_title(); ?>
                    </nav>


                    <article>
                        <header class="entry-header clearfix">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <div class="mh-subheading-top"></div>
                            <!--<h2 class="mh-subheading">This is a custom subheading for your article</h2>-->
                            <div class="mh-meta entry-meta"> 
                                <span class="entry-meta-date updated">
                                    <i class="fa fa-clock-o"></i><a href="#"><?php echo get_post_time('F j, Y')?></a>
                                </span>
                                <span class="entry-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="<?php echo get_the_author_link() ?>"><?php get_the_author(); ?></a></span>
                                <span class="entry-meta-categories"><i class="fa fa-folder-open-o"></i><a href="#" rel="category tag">Politics</a></span>
                                <span class="entry-meta-comments"><i class="fa fa-comment-o"></i><a href="#" class="mh-comment-count-link" ><?php echo wp_count_comments()->total_comments ?></a></span></div>
                        </header>

                        <div id="text-3" class="mh-widget mh-posts-1 widget_text">
                            <div class="textwidget">
                                <div class="mh-ad-label">Advertisement</div>
                                <div class="mh-ad-area">
                                    <div style="font-size: 13px; padding: 0.5em; background: #f5f5f5; border: 1px solid #ebebeb; text-align: center;">
                                        <a target="_blank" href="#" title="Purchase MH Magazine Premium">Here you can place more advertisements and banners</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-content clearfix">

                            <!--<div class="bg-content" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>-->


                            <figure class="entry-thumbnail"> <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title() ?>" title="<?php echo get_the_title() ?>" />
                                <!--<figcaption class="wp-caption-text">Image Credit: The Script Photography</figcaption>-->
                            </figure>

                            <?php the_content(); ?>
                            
                            <!-- TODO: Implement Social Plugin as a template -->
                            <div class="mh-social-bottom">
                                <div class="mh-share-buttons clearfix">
                                    <a class="mh-facebook" href="#" onclick="window.open('https://www.facebook.com/sharer.php?u='<?php echo urlencode(get_permalink()); ?>, 'facebookShare', 'width=626,height=436'); return false;"
                                        title="Share on Facebook"> <span class="mh-share-button"><i class="fa fa-facebook"></i></span> </a>
                                    <a class="mh-twitter" href="#" onclick="window.open('https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>', 'twitterShare', 'width=626,height=436'); return false;"
                                        title="Tweet This Post"> <span class="mh-share-button"><i class="fa fa-twitter"></i></span> </a>
                                    <a class="mh-pinterest" href="#" onclick="window.open('https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>', 'pinterestShare', 'width=750,height=350'); return false;"
                                        title="Pin This Post"> <span class="mh-share-button"><i class="fa fa-pinterest"></i></span> </a>
                                    <a class="mh-googleplus" href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php echo urlencode(get_permalink()); ?>', 'googleShare', 'width=626,height=436'); return false;"
                                        title="Share on Google+" target="_blank"> <span class="mh-share-button"><i class="fa fa-google-plus"></i></span> </a>
                                    <a class="mh-email" href="#" title="Send this article to a friend" target="_blank"> <span class="mh-share-button"><i class="fa fa-envelope-o"></i></span> </a>
                                </div>
                                <!--<p>This current post has been shared 100 times click above to share also:</p>-->
                            </div>
                        </div>
                        <div class="entry-tags clearfix"><i class="fa fa-tag"></i>
                            <?php 
                                if(get_the_tag_list()) {
                                    echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
                                }
                            ?>
                        </div>

                    </article>
                    <div class="mh-author-box clearfix">
                        Copyright 2017 TheScript. Permission to use quotations from this article is granted subject to appropriate credit being given
                        to www.thescript.com.ng as the source.
                    </div>

                    <!--Ad Section-->
                    <div id="text-4" class="mh-widget mh-posts-2 widget_text">
                        <div class="textwidget">
                            <div class="mh-ad-label">Advertisement</div>
                            <div class="mh-ad-area">
                                <div style="font-size: 13px; padding: 0.5em; background: #f5f5f5; border: 1px solid #ebebeb; text-align: center;">
                                    <a target="_blank" href="#" title="Purchase MH Magazine Premium">Here you can place more advertisements and banners</a></div>
                            </div>
                        </div>
                    </div>
                    <!--Ad Section Ends-->

                    <div id="comments" class="mh-comments-wrap">
                        <!-- TODO: Implement Disqus -->
                        <?php 
                            // If comments are open or we have at least one comment, load up the comment template.
                             comments_template( '', true );
                        ?>
                    </div>

                    <!-- Quick Links to Next and Previous Post -->
                    <nav class="mh-post-nav mh-row clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                        <?php 
                            $prevPost = get_previous_post(true); 
                            if($prevPost):
                                $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(80,60) );
                        ?>
                            <div class="mh-col-1-2 mh-post-nav-item mh-post-nav-prev">
                                <?php previous_post_link('%link',"$prevthumbnail  <p>%title</p>", TRUE); ?>
                            </div>
                        <?php 
                            endif; 
                            $nextPost = get_next_post(true); 
                            if($nextPost) :
                                $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(80,60) );
                        ?>
                            <div class="mh-col-1-2 mh-post-nav-item mh-post-nav-next">
                                <?php next_post_link('%link',"$nextthumbnail  <p>%title</p>", TRUE); ?>
                            </div>
                        <?php endif; ?>
                    </nav>
                    <!-- Quick Links to Next and Previous Post Ends -->

                    
                </div>

                <!-- Sidebar starts here -->
                <aside class="mh-widget-col-1 mh-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                    
                    
                    <div id="text-2" class="mh-widget widget_text">
                        <div class="textwidget">
                            <div class="mh-ad-spot">
                                <a href="#" target="_blank">
                                    <img alt="Advertisment" width="300" height="250" src="<?php echo get_stylesheet_directory_uri()?>/images/ad-banner/Top Sidebar - side-top-300x250.png"> 
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- News in Pictures Section -->
                    <div id="mh_magazine_nip-2" class="mh-widget mh_magazine_nip">
                        <h4 class="mh-widget-title"><span class="mh-widget-title-inner">News in Pictures</span></h4>
                        <ul class="mh-nip-widget clearfix">

                            <?php 
                                $args = array( 'posts_per_page' => 9 );
                                $the_query = new WP_Query( $args );
                                
                                if($the_query->have_posts() ) : 
                                while ( $the_query->have_posts() ) : $the_query->the_post();
                            ?>

                            <li class="mh-nip-item">
                                <a class="mh-thumb-icon mh-thumb-icon-small" href="<?php get_permalink() ?>" title="<?php echo get_the_title(); ?>">
                                    <!--<img width="80" height="60" src="" class="attachment-mh-magazine-small size-mh-magazine-small wp-post-image" alt="Wallet"  sizes="(max-width: 80px) 100vw, 80px" />-->
                                    <div style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>'); width: 80px; height: 60px; background-position: cover;"></div>
                                    <div class="mh-nip-overlay"></div>
                                </a>
                            </li>

                            <?php endwhile; else: ?>
                                <p>No News</p>
                            <?php endif; wp_reset_postdata(); ?>

                        </ul>
                    </div>

                   <!-- Sidebar -->
                    <?php get_sidebar(); ?>

                    <!-- Ad Section -->
                    <div id="text-2" class="mh-widget widget_text">
                        <div class="textwidget">
                            <div class="mh-ad-spot">
                                <a href="#" target="_blank">
                                    <img alt="Advertisment" width="300" height="250" src="<?php echo get_stylesheet_directory_uri()?>/images/ad-banner/Bottom Sidebar - side-bottom-300x250.png"> 
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Ad Section -->

                </aside>

                <!--Sidebar ends here-->
            </div>
        </div>
        
<?php get_footer() ?>
