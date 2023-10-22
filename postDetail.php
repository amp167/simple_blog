<?php
include_once('views/top.php');
include_once('views/nav.php');
include_once('views/header.php');
include_once ('sysgem/postgenerator.php');
$pid = "";
if (isset($_GET["pid"])){
    $pid =  $_GET["pid"];
}
?>
<div class="container">
    <div class="row">
        <?php
        $result = getPostDetail($pid);
        foreach ($result as $post){
            echo '<h4>'.$post["title"].'</h4>';
            echo '<p>'.$post["writer"].'</p>';
            echo '<p>'.$post["created_at"].'</p>';
            echo '<img src="assets/upload/'.$post["imglink"].'"/>';
            echo '<p>'.$post["content"].'</p>';
        }
        ?>

    </div>
</div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>

