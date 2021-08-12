<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "forum";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $usern = $_POST["mail"];
    $passw = $_POST["pass"];
    $cpassw = $_POST["cpass"];
    $exist = "SELECT * FROM `login1` where user_id ='$usern'";
    $result = mysqli_query($conn, $exist);
    $numr = mysqli_num_rows($result);
    if ($numr > 0) {
        $error = "Email already in use";
        header("location:/forum/index.php?signsuccess=false&wr=$error");
    } else {
        if ($passw == $cpassw) {
            $hash_pass = password_hash($passw, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `login1` (`user_id`, `user_pass`, `times`) VALUES ('$usern', '$hash_pass', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $alert = "You are signed up please login now";
                header("location:/forum/index.php?signsuccess=true&all=$alert");
                exit();
            }
        } else {
            $error = "Password not matched";
            header("location:/forum/index.php?signsuccess=false&wr=$error");
        }
    }
}
