<?php
include_once('views/top.php');
include_once('views/nav.php');
include_once('views/header.php');
include_once ("sysgem/postgenerator.php");

if (checkSession('username')) {
    if (getSession('username') != 'kokoaung') {
        header('location:index.php');
    }
} else {
    header('location:index.php');
}
if (isset($_POST['submit'])){
    $postitle = $_POST['postitle'];
    $postype = $_POST['postype'];
    $postwriter = $_POST['postwriter'];
    $postcontent = $_POST['postcontent'];
    $imglink = mt_rand(time(),time()). "_" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],'assets/upload/'.$imglink);
    $bol = insertPost($postitle,$postype,$postwriter,$postcontent,$imglink);
    if ($bol){
        echo " <div class='container mt-3'><div class='alert alert-primary' role='alert'>
  POST INSERT Successfully 
</div>";
    }else{
        echo " <div class='container mt-3'><div class='alert alert-primary' role='alert'>
   POST INSERT Failed! 
</div>";
    }


}
?>
    <div class="container">
        <div class="row">
            <?php include_once('views/sideBar.php'); ?>
            <section class="col-md-9">
                <?php
                $result = getAllPost(2);
                foreach ($result as $post){
                    echo '<div class="card mb-3">
                            <div class="card-body">
                                <h5 class="text-start text-black">'.$post["title"].'</h5>
                                <p>'.$post["content"].'</p>
                                <a href="postedit.php?pid='.$post["id"].'" class="btn btn-sm text-white btn-info float-end">Edit</a>
                            </div>
                          </div>';
                }
                ?>
            </section>

        </div>
    </div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>