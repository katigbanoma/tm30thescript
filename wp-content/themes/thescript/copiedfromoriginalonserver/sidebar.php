    <div class="mh-tabbed-widget">
        <div class="mh-tab-buttons clearfix">
            <a class="mh-tab-button" href="#tab-mh_magazine_tabbed-2-1">
                <span><i class="fa fa-bar-chart" aria-hidden="true"></i></span>Polls
            </a>
            <a class="mh-tab-button" href="#tab-mh_magazine_tabbed-2-2">
                <span><i class="fa fa-comments-o" aria-hidden="true"></i></span>Comment
            </a>
        </div>


        <div id="tab-mh_magazine_tabbed-2-1" class="mh-tab-content mh-tab-posts">
            <div class="mh-custom-posts-header">
                <?php
                    // poll short code goes here 
                    echo do_shortcode('[Total_Soft_Poll id="2"]');
                ?>
            </div>
            <script language="javascript" type="text/javascript">
            // to create cookie cname as name cvalue is value exdays is expire date
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            // to get cookie set on the computer
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
                }
                return "";
            }
            // to check a cookie
            function checkCookie() {
            var username = getCookie("username");
                if (username != "") {
                    alert("Welcome again " + username);
                    } else {
                    username = prompt("Please enter your name:", "");
                if (username != "" && username != null) {
                    setCookie("username", username, 365);
                        }
                    }
            }
            </script>
        </div>
        <div id="tab-mh_magazine_tabbed-2-2" class="mh-tab-content mh-tab-posts">
            <div class="mh-custom-posts-header">
                <div class="mh-custom-posts-small-title">
                    <a href="#" title="Vulputate velit esse molestie consequat vel illum">
                    Maitama Sule: Osinbajo Visits Kano, Condoles With Residents
                    </a>
                </div>
                <div class="mh-meta entry-meta">
                    <span class="entry-meta-date updated">
                        <i class="fa fa-clock-o"></i><a href="#">Mar 10, 2015</a>
                    </span>
                    <span class="entry-meta-comments">
                        <i class="fa fa-comment-o"></i><a href="#" class="mh-comment-count-link" >2</a>
                    </span>
                </div>
            </div>
            <div class="mh-custom-posts-header">
                <div class="mh-custom-posts-small-title">
                    <a href="#"> Man United agree £75m deal with Everton for Romelu Lukaku </a>
                </div>
                <div class="mh-meta entry-meta">
                    <span class="entry-meta-date updated">
                        <i class="fa fa-clock-o"></i><a href="#">Mar 10, 2015</a>
                    </span>
                    <span class="entry-meta-comments">
                        <i class="fa fa-comment-o"></i><a href="#" class="mh-comment-count-link" >2</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    

    <div class="mh-tab-buttons clearfix">
        <a class="mh-tab-button" href="#">Exchange Rates </a>
    </div>

    <div class="mv-tab-content mv-tab-posts">
        <?php
            $display = '<table class="exchange-table" cellspacing="15px">
            <thead>
            <tr>
                <th></th>
                <th><img src="'. get_stylesheet_directory_uri(). '/images/uslogo.png" width="30px" /><br>BUY/SELL</th>
                <th><img src="'. get_stylesheet_directory_uri(). '/images/ukthumb" width="30px" /><br>BUY/SELL</th>
                <th><img src="'. get_stylesheet_directory_uri(). '/images/eurologo.jpg" width="30px" /><br>BUY/SELL</th>
            </tr>
            </thead><tbody>';
            $conn = mysqli_connect("localhost", "thescrip_cms", "Available247?", "thescrip_cmsdb");
            //$conn = mysqli_connect("localhost", "root", "kini419,247", "thescript");
            $select = "SELECT * FROM exchange";
            $res = mysqli_query($conn, $select);
            $dp = mysqli_fetch_assoc($res);
            $display .=$dp['body'];
            $display .= '</tbody></table>';
            echo $display;
        ?>
    </div>

    <div class="mh-tab-buttons clearfix">
        <a class="mh-tab-button" href="#"> Most Read </a>
    </div>

    <!-- TODO: Make image stay side by side -->
    <div class="" style="marign-top:20px;">
        <div id="mh_magazine_custom_posts-2" class="mh-widget mh-home-6 mh_magazine_custom_posts">
            <ul class="mh-custom-posts-widget clearfix">

                <?php
                    $args = array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  );
                    $the_query = new WP_Query( $args );

                    if($the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                ?>

                <?php if (has_post_thumbnail()) : ?>
                                
                    <li class="mh-custom-posts-item mh-custom-posts-small clearfix">
                        <div class="mh-custom-posts-thumb" style="width: 100px; height: 100px; background-size: cover;background-image: url(<?php echo get_the_post_thumbnail_url() ?>)"></div>
                        <div class="mh-custom-posts-header" style="font-size:13px;">
                            <h5 class="mh-custom-posts-small-title"> 
                                <a href="#" title="<?php echo get_the_title(); ?>"><?php echo tokenTruncate(get_the_title(), 50) ?> </a>
                            </h5>
                            <?php echo tokenTruncate(get_the_content(), 50) . '...<a href="'. get_permalink() .'"> Read More</a>'; ?>
                            <div class="mh-meta entry-meta"> <span class="entry-meta-date updated"><i class="fa fa-clock-o"></i><a href="#"><?php echo get_post_time('F j, Y');?></a></span>
                                <span class="entry-meta-comments"><i class="fa fa-comment-o"></i><a href="#" class="mh-comment-count-link" ><?php echo wp_count_comments()->total_comments ?></a></span></div>
                        </div>
                    </li>

                <?php endif; ?>

                <?php endwhile; else: ?>

                    <p>No News Today</p>

                <?php endif; wp_reset_postdata(); ?>

            </ul>
        </div>
    </div>
