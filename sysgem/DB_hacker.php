<?php
define("DB_HOST", "localhost");
define("DB_NAME", "simple_blog");
define("DB_USER", "root");
define("DB_PASS", "");

function dbconnect()
{
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Database connection Error!";
    } else {
        return $db;
    }
}

function userLogin($email, $password)
{
    $password = encodePass($password);
    $db = dbconnect();
    $qry = "SELECT name FROM members where email='$email' AND password='$password'";
    $result = mysqli_query($db, $qry);
    if ($result) {
        $username = "";
        foreach ($result as $str) {
            $username = $str["name"];
        }
        setSession('username', $username);
        setSession('email', $email);

        return 'login Success';
    } else {
        return "Login Fail";
    }

}

function insertUser($name, $email, $password)
{
    $password = encodePass($password);
    $curTime = getTimeNow();
    $db = dbconnect();
    $qry = "SELECT * FROM members WHERE email='$email'";
    $result = mysqli_query($db, $qry);
    if (mysqli_num_rows($result) > 0) {
        return "email is already in use";
    } else {
        $qry = "INSERT INTO members (name,email,password,created_at,updated_at)
            VALUES
             ('$name','$email','$password','$curTime','$curTime')";
        $result = mysqli_query($db, $qry);
        if ($result == 1) {
            return "Register Success";
        } else {
            return "Register Failed";
        }

    }

}

function encodePass($pass)
{
    $pass = md5($pass);
    $pass = sha1($pass);
    $pass = crypt($pass, $pass);
    return $pass;
}

function getTimeNow()
{
    return date("Y-m-d H:m:s", time());
}