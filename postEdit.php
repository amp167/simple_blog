<?php
include_once('views/top.php');
include_once('views/nav.php');
include_once('views/header.php');
include_once ("sysgem/postgenerator.php");

if (isset($_GET["pid"])){
    $pid = $_GET["pid"];
    $result = getPostDetail($pid);
}
if (isset($_POST['submit'])){
    $imgname = "";
    if ($_FILES['file']['name'] != null ){
        $imgname = mt_rand(time(),time()). "_". $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'],'assets/upload/'.$imgname);
    }else {
        $imgname = $_POST['oldimg'];
    }
    $postitle = $_POST['postitle'];
    $postype = $_POST['postype'];
    $postwriter = $_POST['postwriter'];
    $postcontent = $_POST['postcontent'];
    $imglink = $imgname;
    $pid = $_GET['pid'];
    updatePost($postitle,$postype,$postwriter,$postcontent,$imglink,$pid);
}

?>
    <div class="container">
        <div class="row">
            <?php include_once('views/sideBar.php'); ?>
            <?php
            foreach ($result as $post) : ?>

            <div class="col-9">
                <form method="post" enctype="multipart/form-data" action="postEdit.php?pid=<?= $pid ?>"
                      class="border
                p-3 english
                mb-5 d-flex
                flex-column">
                    <h3 class="text-center text-danger">Post Edit Form</h3>
                    <div class="form-group mb-4">
                        <label for="postitle">Post Title</label>
                        <input type="text" class="form-control" id="postitle" name="postitle" aria-describedby="emailHelp"
                               placeholder="Enter Title" value="<?= $post['title'] ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="postype">Post Type</label>
                        <select class="form-control" id="postype" name="postype">
                            <option value="1">Free Post</option>
                            <option value="2">Paid Post</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="postwriter">Post Writer</label>
                        <input type="text" name="postwriter" class="form-control" value="<?= $post['writer'] ?>" id="postwriter" placeholder="name">
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile"></label>
                            <input type="file"  class="custom-file-input" name="file" id="customFile">
                            <input type="hidden" name="oldimg" value="<?= $post['imglink'] ?>">

                        </div>
                    </div>
                    <img width="200px" src="assets/upload/<?= $post['imglink'] ?>" alt="" class="mb-3">
                    <div class="form-group mb-4">
                        <label for="postcontent">Content</label>
                        <textarea class="form-control"  name="postcontent" id="postcontent" cols="30" rows="10"><?= $post['content'] ?></textarea>
                    </div>
                    <div class="align-self-end">
                        <button type="submit" class="btn btn-outline-primary me-2">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
            <?php endforeach ?>

        </div>
    </div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>