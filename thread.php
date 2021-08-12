<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>forum</title>
</head>

<body>
    <?php include 'partial/header.php'; ?>
    <?php include 'partial/connect.php'; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        //echo $row['cat_id'];
        $cat = $row['thread_title'];
        $dis = $row['thread_dis'];
        $posted = $row['threa_user_id'];
        $sql2 = "SELECT user_id FROM `login1` WHERE srno=$posted";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user = $row2['user_id'];
    }
    ?>
    <?php
    $req = $_SERVER['REQUEST_METHOD'];
    $alert = false;
    if ($req == 'POST') {
        $comm = $_POST['comment'];
        $comm = str_replace("<", "&lt", $comm);
        $comm = str_replace(">", "&gt", $comm);
        $sno = $_POST['srno'];
        $sql = "INSERT INTO `comments` (`com_cont`, `thread_id`, `com_by`, `com_time`) VALUES ('$comm', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $alert = true;
    }
    ?>
    <div class="container my-3">
        <div class="container-fluid text-sm-left p-5 bg-secondary text-white ">
            <h1 class="display-4"><?php echo $cat; ?></h1>
            <p class="lead"><?php echo $dis; ?></p>
            <hr class="my-4">
            <p>Here you can share your knowledge about the topic with eachother.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <p>Posted by: <em><?php echo $user; ?></em></p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
    <div class="container">
        <h1>Post your comment</h1>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Write comment here</label>
                <input type="hidden" name="srno" value="' . $_SESSION['srno'] . '">
            </div>
            <button type="submit" class="btn btn-success mt-1">Submit</button>
        </form>
    </div>';
    } else {
        echo '   
        <div class="container">
        <h1 class="py-2">Post a Comment</h1> 
           <p class="lead">You are not logged in. Please login to be able to post comments.</p>
        </div>
        ';
    }
    ?>
    <div class="container">
        <h1 class="py-2">All comments</h1>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $nores = true;
        while ($row = mysqli_fetch_assoc($result)) {
            //echo $row['cat_id'];
            $nores = false;
            $title = $row['com_id'];
            $dis = $row['com_cont'];
            $time = $row['com_time'];
            $com = $row['com_by'];
            $sql2 = "SELECT user_id FROM `login1` WHERE srno=$com";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2['user_id'];
            echo '<div class="d-flex">
          <div class="img"><img src="img/user-alt-512.png" width="34px" class="mr-3" alt="..."></div>
          <div class="media-body">
          <p class="fw-bold">' . $row2['user_id'] . ' ' . $time . '</p>
              <p>' . $dis . '</p>
          </div>
      </div>';
        }
        if ($nores) {
            echo '<div class="container my-3">
            <div class="container-fluid text-sm-left p-5 bg-Light text-dark ">
                <h1 class="display-4">No Comments found</h1>
                <p>Be the first person to ask question</p> 
            </div>
        </div>';
        }
        ?>
        <?php include 'partial/footer.php'; ?>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
</body>

</html>