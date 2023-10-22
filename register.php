<?php
include_once('views/top.php');
include_once('views/nav.php');
require_once "sysgem/membership.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $ret = registerUser($username, $email, $password);
    $message = "";
    switch ($ret) {
        case "Register Success":
            $message = "Register Success";
            setSession('username', $username);
            setSession('email', $email);
            header('location:admin.php');
            break;
        case 'email is already in use':
            $message = "email is already in use";
            break;
        case "Register Failed":
            $message = "Register Failed";;
            break;
        default:
            break;
    }
    echo " <div class='container'><div class='alert alert-primary' role='alert'>
  " . $message . "
</div>";

}

?>
<div class="container">
    <div class="col-md-8 offset-md-2">

        <form action="register.php" method="post" class="form d-flex flex-column border border-1 p-4 m-3">
            <h1 class="text-danger text-center english">Register to be a Member!</h1>
            <div class="form-group">
                <label for="username" class="english">Username</label>
                <input type="text" class="form-control english rounded-0" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="email" class="english">Email</label>
                <input type="email" class="form-control english rounded-0" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password" class="english">Password</label>
                <input type="password" class="form-control english rounded-0" name="password" id="password">
            </div>
            <button class="btn btn-secondary align-self-center mt-3" name="submit" type="submit"
                    value="submit">Register
            </button>

        </form>
    </div>
</div>

<?php
include_once('views/footer.php');
include_once('views/base.php');
?>

