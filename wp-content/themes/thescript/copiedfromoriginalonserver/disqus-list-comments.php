<?php
$apikey = 'cqmOmdT53KUYmkyrgE6CoXVC8VS9GZegZgTYzuzBQYxMckJxs77kJxQVo8hEvkrY'; // get keys at http://disqus.com/api/ — can be public or secret for this endpoint
$shortname = 'thescript'; // defined in the var disqus_shortname = '...';
$thread = 'link:<URL of thread>'; // IMPORTANT the URL that you're viewing isn't necessarily the one stored with the thread of comments
//$thread = 'ident:<identifier of thread>'; Use this if 'link:' has no results. Defined in 'var disqus_identifier = '...';
$limit = '100'; // max is 100 for this endpoint. 25 is default

$endpoint = 'https://disqus.com/api/3.0/threads/listPosts.json?api_key='.$apikey.'&forum='.$shortname.'&limit='.$limit.'&cursor='.$cursor;

$j=0;
listcomments($endpoint,$cursor,$j);

function listcomments($endpoint,$cursor,$j) {

    // Standard CURL
    $session = curl_init($endpoint.$cursor);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, 1); // instead of just returning true on success, return the result on success
    $data = curl_exec($session);
    curl_close($session);

    // Decode JSON data
    $results = json_decode($data);
    if ($results === NULL) die('Error parsing json');

    // Comment response
    $comments = $results->response;

    // Cursor for pagination
    $cursor = $results->cursor;

    $i=0;
    foreach ($comments as $comment) {
        $name = $comment->author->name;
        $comment = $comment->message;
        $created = $comment->createdAt;
        // Get more data...

        echo "<p>".$name." wrote:<br/>";
        echo $comment."<br/>";
        echo $created."</p>";
        $i++;
    }

    // cursor through until today
    if ($i == 100) {
        $cursor = $cursor->next;
        $i = 0;
        listcomments($endpoint,$cursor);
        /* uncomment to only run $j number of iterations
        $j++;
        if ($j < 10) {
            listcomments($endpoint,$cursor,$j);
        }*/
    }
}

?>