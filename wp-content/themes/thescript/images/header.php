<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/style.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/font-awesome/css/font-awesome.min.css" />

    <script src="<?php echo get_stylesheet_directory_uri()?>/js/jq0.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri()?>/js/jq1.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri()?>/js/jq2.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Script</title>
    <link rel="canonical" href="https://www.mhthemes.com/themes/mh/magazine/" />

</head>

<?php wp_head(); ?>

<body id="mh-mobile" class="home page-template page-template-template-homepage page-template-template-homepage-php page page-id-6 custom-background wp-custom-logo mh-boxed-layout mh-right-sb mh-loop-layout1 mh-widget-layout1 mh-loop-hide-caption">
    <div class="mh-container mh-container-outer">
        <div class="mh-header-nav-mobile clearfix"></div>
        <div class="mh-preheader">
            <div class="mh-container mh-container-inner mh-row clearfix">
                <div class="mh-header-bar-content mh-header-bar-top-left mh-col-2-3 clearfix">
                    <nav class="mh-navigation mh-header-nav mh-header-nav-top clearfix">
                        <div class="menu-header-container">
                            <ul id="menu-header" class="menu social-links">
                                <li><?php echo date("D F j, Y"); ?></li>
                                <li><a href="https://www.facebook.com/TheScript-286746578461474/" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
                                <li><a href="https://twitter.com/thescriptng" target="_blank"><i class="fa fa-twitter fa-2x"></i></a></li>
                                <li><a  href="https://plus.google.com/109624128027931178146" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube fa-2x"></i></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="mh-header-bar-content mh-header-bar-bottom-right mh-col-1-3 clearfix">
                    <aside class="mh-header-search mh-header-search-bottom">
                        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                            <input type="text" placeholder="Search" value="" name="s"/>
                            <input type="submit" value="Search" id="search-btn" />
                        </form>

                    </aside>
                </div>

                <style>
                    #search-btn {
                        background-color: #666;
                        margin-left: -3px;
                        color: white;
                        padding: 3px 3px 4px 3px
                    }

                    #search-btn::after{
                        font-family: "FontAwesome";
                        content: "\f002";
                    }

                    .custom-logo {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                    }
                </style>
            </div>
        </div>
        <header class="mh-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
            <div class="mh-container mh-container-inner" style=" border-bottom:2px groove red;">
                <div class="mh-custom-header clearfix">
                    <div class="mh-header-columns mh-row clearfix">
                        <div class="mh-col-1-1 mh-site-identity">
                            <div class="mh-site-logo" role="banner" itemscope="itemscope" itemtype="http://schema.org/Brand">
                                <a href="<?php echo get_home_url()?>" class="custom-logo-link" rel="home" itemprop="url">
                <img width="300" height="100" src="<?php echo get_stylesheet_directory_uri()?>/images/The script logo.png" class="custom-logo" alt="" itemprop="logo" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="textwidget">
                <div class="mh-ad-spot">
          <a target="_blank" href="https://www.firstbanknigeria.com/894-2/">
          <img width="1080" height="120" src="<?php echo get_stylesheet_directory_uri()?>/images/ad-banner/top-1128x120.gif" />
          </a>
          <a href="">
            <img src="<?php echo get_stylesheet_directory_uri()?>/images/ad-banner/Bottom - bottom-680x130.png" style="width:1080px;" alt="">
          </a>
                </div>
            </div>

            <div class="mh-main-nav-wrap">
                <nav class="mh-navigation mh-main-nav mh-container mh-container-inner clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

                        <?php
                        $defaults = array(
                        'theme_location'  => 'primary',
                        'menu'            => 'default',
                        'container_class' => 'menu-navigation-container',
                        'menu_class'      => 'menu',
                        'menu_id'         => 'menu-navigation',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'depth'           => 0,
                        );

                        wp_nav_menu( $defaults );
                        ?>
                </nav>

                <style>
                    .sub-menu:after {
                        content: "\f0d7";
                        font-family: FontAwesome;
                        left:-5px;
                        position:absolute;
                        top:0;
                    }
                </style>
            </div>
        </header>

        <div class="mh-subheader">
            <div class="mh-container mh-container-inner mh-row clearfix">
                <div class="mh-header-bar-content mh-header-bar-bottom-left mh-col-2-3 clearfix">
                    <div class="mh-header-ticker mh-header-ticker-bottom">
                        <div class="mh-ticker-bottom">
                            <div class="mh-ticker-title mh-ticker-title-bottom"> BREAKING NEWS<i class="fa fa-chevron-right"></i></div>
                            <div class="mh-ticker-content mh-ticker-content-bottom">
                                <ul id="mh-ticker-loop-bottom">

                                    <?php
                                        $args = array('post_type' => 'post','posts_per_page' => '4');
                                        $the_query = new WP_Query( $args );

                                    if ($the_query->have_posts()) :
                                        while ($the_query->have_posts()) :
                                            $the_query->the_post();
                                    ?>

                                    <?php
                                        $category = get_the_category();
                                        $category_link = get_category_link($category[0]->cat_ID);
                                        $category_name = $category[0]->cat_name;
                                    ?>

                                    <li class="mh-ticker-item mh-ticker-item-bottom">
                                        <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_content()  ?>">
                                            <span class="mh-ticker-item-date mh-ticker-item-date-bottom"> [ <?php echo get_post_time('F j, Y')?> ] </span>
                                            <span class="mh-ticker-item-title mh-ticker-item-title-bottom"> <?php echo substr(get_the_content(), 15); ?> </span>
                                            <span class="mh-ticker-item-cat mh-ticker-item-cat-bottom"> <i class="fa fa-caret-right"></i> <?php echo $category_name ?> </span>
                                        </a>
                                    </li>

                                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 endwhile;
                                    else : ?>
                                        <p>No Breaking News</p>
                                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 endif;
                                    wp_reset_postdata(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
