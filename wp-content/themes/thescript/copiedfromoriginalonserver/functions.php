<?php 


// Aboki Fx 
    require __DIR__.'/vendor/autoload.php';
    
    use Goutte\Client;
    use GuzzleHttp\Client as GuzzleClient;

add_theme_support( 'post-thumbnails' );


// Post View Count 

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Track Number of Views for post
function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');


// Gets number of views for post
function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

// Hook CSS
function hook_css() {
    ?>
        <style>
           
        </style>
    <?php
}
add_action('wp_head', 'hook_css');

// add_action('wp', 'abokiInit');

function abokiInit(){
    
        date_default_timezone_set('Africa/Lagos');
    $conn = mysqli_connect("localhost", "thescrip_cms", "Available247?", "thescrip_cmsdb");
    //$conn = mysqli_connect("localhost", "root", "kini419,247", "thescript");
    $cheki = "SELECT time from exchange WHERE confirm='yes'";
    $res = mysqli_query($conn, $cheki);
    $dp = mysqli_fetch_assoc($res);
    $ok = $dp['time'];
    $current_time = date("Y-m-j h:i:s");
    
    $str = strtotime($ok);
    $str2 = strtotime($current_time);
    $db_date_time = date('h', $str);
    $curent_date_time = date('h', $str2);
    
    $tao = (int)$db_date_time;
    $fik = (int)$curent_date_time;
    
    if ($tao !== $fik) {
            $html ="";
            $GLOBALS['data'] = array();
        try {
            
            $client = new Client();
            $guzzleClient = new GuzzleClient(array('timeout'=>60));
            $client->setClient ($guzzleClient);
            $crawler = $client->request('GET', 'http://www.abokifx.com');
            
            $i=1;
            $crawler->filter('.grid-table .table-line')->each(function ($node) use(&$i) {
                if($i<=4){
                    $_current = '<tr>'. $node->html(). '</tr>';
                    array_push($GLOBALS['data'], $_current);
                }
            $i++;
            });
            foreach ($GLOBALS['data'] as $x) {
            $html .= $x;
            }
            $conn = mysqli_connect("localhost", "thescrip_cms", "Available247?", "thescrip_cmsdb");
            //$conn = mysqli_connect("localhost", "root", "kini419,247", "thescript");
            if ($html !=="") {
            $insexchange = "UPDATE exchange SET body='$html', time=now() WHERE confirm='yes'";
                $res = mysqli_query($conn, $insexchange);
                
            }  
        } 
        catch(Exception $e){
            echo $e;
        }
    }
    
}



// Pagination 

function pagination_bar() {
    global $wp_query;
 
    $total_pages = $wp_query->max_num_pages;
 
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
 
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}


/*
**  Excerpt 
*/

// Add read-more link to post
// Changing excerpt more
function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Excerpt Limit word count
function custom_excerpt_length( $length ) {
    return 80;
}
// add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Get Excerpt of specified limit
// source = content, excerpt
function get_excerpt($limit, $source = null){

    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">more</a>';
    return $excerpt;
}


// Truncate at word for specified width

function tokenTruncate($string, $your_desired_width) {
    $parts = preg_split('/([\s\n\r]+)/u', $string, null, PREG_SPLIT_DELIM_CAPTURE);
    $parts_count = count($parts);

    $length = 0;
    $last_part = 0;
    for (; $last_part < $parts_count; ++$last_part) {
        $length += strlen($parts[$last_part]);
        if ($length > $your_desired_width) { break; }
    }

    return implode(array_slice($parts, 0, $last_part));
}