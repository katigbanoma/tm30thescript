<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage theScript
 * @since v2017.01
 */

get_header(); ?>


<div class="mh-wrapper mh-home clearfix">
    <div class="mh-main mh-home-main">
        <div class="mh-home-columns clearfix">
            <div id="main-content" class="mh-content mh-home-content">

                <div class="clearfix">
                    <?php
                        // Start the loop.
                        while ( have_posts() ) : the_post();

                            the_content();

                        // End the loop.
                        endwhile;
                    ?>
                </div>

                <div class="textwidget">
                    <div class="mh-ad-spot">
                        <a target="_blank" href="#">
                            <img width="680" height="130" style="height:130px;" src="<?php echo get_stylesheet_directory_uri()?>/images/banner1.png" />
                            </a>
                    </div>
                </div>
                
            </div>
            
            <?php get_sidebar(); ?>
        
        </div>
    </div>
</div>

		
<?php get_footer() ?>