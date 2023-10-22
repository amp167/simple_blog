<?php
require_once "sysgem/DB_hacker.php";
function insertPost($title,$type,$subject,$writer,$content,$imglink){
    $created_at = getTimeNow();
    $db = dbconnect();
    $qry = "INSERT INTO post (title,type,subject,writer,content,imglink,created_at)
            VALUES 
                ('$title',$type,'$subject','$writer','$content','$imglink','$created_at')";
    $result = mysqli_query($db,$qry);
    return $result;
}
function updatePost($title,$type,$writer,$content,$imglink,$id){
    $db = dbconnect();
    $qry = "update post set title='$title',type=$type,writer='$writer',content='$content',imglink='$imglink'
            where id=$id";
    $result = mysqli_query($db,$qry);
    if ($result){
        header('Location:showAllPost.php');
    }else{
        echo "<script>alert('Post edit failed')</script";
    };
}
function getAllPost($start,$type){
    $db = dbconnect();
    if ($type == 1){
        $qry = "SELECT * FROM post Where type=$type LIMIT $start,10";
    }else{
        $qry = "SELECT * FROM post LIMIT $start,10";
    }
    $result = mysqli_query($db,$qry);
    return $result;
}
function getPostDetail($pid){
    $db = dbconnect();
    $qry = "SELECT * FROM post where id=$pid";
    $result = mysqli_query($db,$qry);
    return $result;
}
function getSubject(){
    $db=dbconnect();
    $qry='select * from subject';
    $result = mysqli_query($db,$qry);
    return $result;
}
function getFilterPost($sid,$type){
    $db = dbconnect();
    $qry = "select * from post where subject='$sid' and type=$type";
    $result = mysqli_query($db,$qry);
    return $result;
}
function getPostCount(){
    $db=dbconnect();
    $qry = 'select * from post';
    $result = mysqli_query($db,$qry);
    return mysqli_num_rows($result);
}