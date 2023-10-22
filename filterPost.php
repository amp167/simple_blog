<?php
include_once('views/top.php');
include_once('views/nav.php');
include_once('views/header.php');
include_once ('sysgem/postgenerator.php')

?>
<div class="container">
    <div class="row">
        <?php include_once('views/sideBar.php'); ?>
        <article class="col-md-9">
            <div class="row">
                <?php
                $sid="";
                if (isset($_GET['sid'])){
                    $sid = $_GET['sid'];
                }
                $result ="";
                if (checkSession('username')){
                    $result = getFilterPost($sid,2);
                }else{
                    $result = getFilterPost($sid,1);


                }
                foreach ($result as $post){
                    $pid = $post["id"];
                    echo '<div class="col-md-6 mb-3">
                        <div class="card p-4 ">
                            <div class="card-block">
                                <h1>'.$post["title"].'</h1>
                                <p>'.$post["content"].'</p>
                                <a href="postDetail.php?pid='.$pid.'" class="btn btn-info btn-sm text-white float-end">Details..</a>
                            </div>
                        </div>
                    </div>';
                }
                ?>

            </div>
        </article>

    </div>
</div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>

