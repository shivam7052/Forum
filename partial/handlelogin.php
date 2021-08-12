<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "forum";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $user = $_POST["mail1"];
    $passwr = $_POST["pass1"];
    $exist = "SELECT * FROM `login1` where user_id ='$user'";
    $result = mysqli_query($conn, $exist);
    $numrt = mysqli_num_rows($result);
    if ($numrt == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($passwr, $row['user_pass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $user;
            $_SESSION['srno'] = $row['srno'];
            $alert = "You are logged in";
            header("location:/forum/index.php?loginsuccess=true&logged=true&use=$user&msg=$alert");
        } else {
            $error = "Wrong password";
            header("location:/forum/index.php?loginsuccess=false&msg=$error");
        }
    } else {
        $error = "Invalid email";
        header("location:/forum/index.php?loginsuccess=false&msg=$error");
    }
}
