<?php
include_once('views/top.php');
include_once('views/nav.php');
include_once('views/header.php');
include_once ('sysgem/postgenerator.php');
$start = 0;
if (isset($_GET['start'])){
    $start = $_GET['start'];
}
?>
<div class="container">
    <div class="row">
        <?php include_once('views/sideBar.php'); ?>
        <article class="col-md-9">
            <div class="row">
                <?php
                $result ="";
                if (checkSession('username')){
                    $result = getAllPost($start,2);
                }else{
                    $result = getAllPost($start,1);

                }
                foreach ($result as $post){
                    $pid = $post["id"];
                    echo '<div class="col-md-6 mb-3">
                        <div class="card p-4 ">
                            <div class="card-block">
                                <h1>'.substr($post["title"],0,20).'</h1>
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
<div class="container">
    <div class="col-md-4 offset-md-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                $rows = getPostCount();
                for ($i=0;$i<$rows;$i+=10) : ?>
                    <li class="page-item"><a class="page-link" href="index.php?start=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor;
                 ?>
        </nav>
    </div>
</div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>

