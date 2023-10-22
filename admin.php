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
        <div class="col-9">
            <form method="post" enctype="multipart/form-data" action="" class="border p-3 english mb-5 d-flex flex-column">
                <h3 class="text-center text-danger">Post Insert Form</h3>
                <div class="form-group mb-4">
                    <label for="postitle">Post Title</label>
                    <input type="text" class="form-control" id="postitle" name="postitle" aria-describedby="emailHelp"
                           placeholder="Enter Title">
                </div>
                <div class="form-group mb-4">
                    <label for="postype">Post Type</label>
                    <select class="form-control" id="postype" name="postype">
                        <option value="1">Free Post</option>
                        <option value="2">Paid Post</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="subject">Post Subject</label>
                    <select class="form-control" id="postype" name="postype">
                        <?php
                        $result = getSubject();
                        foreach ($result as $subject) : ?>
                            <option value="<?= $subject['id'] ?>"><?= $subject['subject'] ?></option>
                        <?php endforeach;?>

                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="postwriter">Post Writer</label>
                    <input type="text" name="postwriter" class="form-control" id="postwriter" placeholder="name">
                </div>
                <div class="form-group mb-4">
                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile"></label>
                        <input type="file" class="custom-file-input" name="file" id="customFile">

                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="postcontent">Content</label>
                    <textarea class="form-control" name="postcontent" id="postcontent" cols="30" rows="10"></textarea>
                </div>
                <div class="align-self-end">
                    <button type="submit" class="btn btn-outline-primary me-2">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Post</button>
                </div>
            </form>

        </div>

    </div>
</div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>