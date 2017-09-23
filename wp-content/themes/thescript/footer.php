<footer class="mh-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
  <div class="mh-container mh-container-inner mh-footer-widgets mh-row clearfix">
    <div class="mh-col-1-4 mh-widget-col-1 mh-footer-4-cols  mh-footer-area mh-footer-1">
      <div id="mh_magazine_author_bio-2" class="mh-footer-widget mh_magazine_author_bio">
        <div class="mh-author-bio-widget">
          <h4 class="mh-author-bio-title"><a href="http://thescript.com.ng/about-us" style="color: #000;">About us</a></h4>
          <figure class="mh-author-bio-avatar mh-author-bio-image-frame">
            <a href="http://thescript.com.ng/about-us"> 
            <img src="<?php echo get_stylesheet_directory_uri()?>/images/thescriptlogo.jpg" width="120" height="120" alt="MH Themes" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 alignnone photo" /> 
            </a>
          </figure>
          <div class="mh-author-bio-text" style="font-size:11px; text-align: justify;">
              The Script is a provider of news and information that 
              improves the quality of life of its readers 
              with focus on relevant topics.
          </div>
        </div>
      </div>
    </div>

    <div class="mh-col-1-4 mh-widget-col-1 mh-footer-4-cols  mh-footer-area mh-footer-2">
      <div id="nav_menu-2" class="mh-footer-widget widget_nav_menu">
       <h6 class="mh-widget-title mh-footer-widget-title">
          <span class="mh-widget-title-inner mh-footer-widget-title-inner">
            <?php echo get_cat_name(1);?>
          </span>
        </h6>
        <div class="menu-theme-information-container">
          <?php $catquery = new WP_Query( 'cat=1&posts_per_page=5' ); ?>
            <ul id="menu-theme-information" class="menu">

            <?php while($catquery->have_posts()) : $catquery->the_post(); ?>

            <li id="menu-item-245" class="">
              <a target="_blank" href="<?php the_permalink() ?>" rel="bookmark">
                <?php the_title(); ?>
              </a>
            </li>
            
            <?php endwhile;
            wp_reset_postdata();
            ?>
        </div>
      </div>
    </div>

    <div class="mh-col-1-4 newsletter" id="newsletter">
      <div class="container">
        <h5>NEWSLETTER</h5>
          <div class="widget_wysija_cont html_wysija">
          <div id="msg-form-wysija-html597a2022c2696-2" class="wysija-msg ajax"></div>
          <form id="form-wysija-html597a2022c2696-2" method="post" action="#wysija" class="widget_wysija html_wysija">
          <p class="wysija-paragraph">
          <input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="Email" placeholder="Email" value="" />
          <span class="abs-req">
          <input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
          </span>
          </p>
          <input class="wysija-submit wysija-submit-field" type="submit" value="Subscribe!" />
          <input type="hidden" name="form_id" value="2" />
          <input type="hidden" name="action" value="save" />
          <input type="hidden" name="controller" value="subscribers" />
          <input type="hidden" value="1" name="wysija-page" />
          <input type="hidden" name="wysija[user_list][list_ids]" value="3" />
          </form>
          </div>
      </div>
    </div>
  </div>
</footer>

<style>
  .newsletter{
      border-bottom:1px solid #fff; 
      background-color:#E5E7E9; 
  }

  .newsletter h5{
    border-bottom:2px solid red; style:color:#2C3E50;
  }

  .newsletter p{
    padding-top:5px; color:#212F3D;
  }

  .container{
    width:90%; 
    margin:20px 10px;
  }

</style>

<div class="mh-footer-nav-mobile"></div>
<nav class="mh-navigation mh-footer-nav">
  <div class="mh-container mh-container-inner clearfix">
    <div class="menu-footer-container">
      <ul id="menu-footer" class="menu">
        <li id="menu-item-251" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-251">
          <a href="<?php echo get_home_url()?>">Home</a>
        </li>
        <li id="menu-item-252" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-252">
          <a href="http://thescript.com.ng/about-us">About us</a>
        </li>
        <li id="menu-item-253" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-253">
          <a href="http://thescript.com.ng/contact-us/">Contact us</a>
        </li>
        <li id="menu-item-254" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-254">
          <a href="http://thescript.com.ng/terms-of-use/">Terms of Use</a>
        </li>
        <li id="menu-item-255" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-255">
          <a href="http://thescript.com.ng/privacy-policy/">Privacy Policy</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="mh-copyright-wrap">
  <a class="mh-copyright" >&copy; <?php echo date('Y');?> The Script All Right Received</a>
</div>
<a href="#" class="mh-back-to-top"><i class="fa fa-chevron-up"></i></a>

</body>
</html>
