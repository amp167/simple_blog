<?php
include_once ('sysgem/postgenerator.php');
$json = file_get_contents('assets/posts.json');
$posts = json_decode($json);

$types = [1,2];
$i=0;
$subjects = [1,2,3,4];
$writers = ['Aung Myo Oo','Pann Nu','PC','Baby'];
$imglink = '1697383737_anonymus-hacker.jpg';
foreach ($posts as $post){
    $i++;
    $title = $post->text;
    $content = $post->text1;
    $subject = $subjects[$i%4];
    $writer = $writers[$i%4];
    $type = $types[$i%2];
    insertPost($title,$type,$subject,$writer,$content,$imglink);

}