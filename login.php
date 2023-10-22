<?php
include_once('sysgem/mySession.php');
include_once('views/top.php');
include_once('views/nav.php');
include_once('sysgem/membership.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $ret = loginUser($email, $password);
    $message = "";
    switch ($ret) {
        case "login Success":
            $message = "login Success";
            if (getSession('username') == 'kokoaung' && getSession('email') == 'koaung@gmail.com') {
                header('location:admin.php');
            } else {
                header('location:index.php');

            }
            break;
        case "Login Fail":
            $message = "login Fail";

            break;
        case "Auth Failed":
            $message = "Username and password not in format";
            break;
        default:

    }
    echo " <div class='container mt-3'><div class='alert alert-primary' role='alert'>
  " . $message . "
</div>";

}
?>
<div class="container">
    <div class="col-md-8 offset-md-2">

        <form action="login.php" method="post" class="form d-flex flex-column border border-1 p-4 m-3">
            <h1 class="text-danger text-center english">Login to see Special Posts!</h1>
            <div class="form-group">
                <label for="email" class="english">Email</label>
                <input type="email" class="form-control english rounded-0" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password" class="english">Password</label>
                <input type="password" class="form-control english rounded-0" name="password" id="password">
            </div>
            <button class="btn btn-secondary align-self-center mt-3" type="submit" name="submit"
                    value="submit">Login
            </button>

        </form>
    </div>
</div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>

