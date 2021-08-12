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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE cat_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        //echo $row['cat_id'];
        $cat = $row['cat_name'];
        $dis = $row['cat_discp'];
    }
    ?>
    <?php
    $req = $_SERVER['REQUEST_METHOD'];
    $alert = false;
    if ($req == 'POST') {
        $tit = $_POST['title'];
        $tit = str_replace("<", "&lt", $tit);
        $tit = str_replace(">", "&gt", $tit);
        $dise = $_POST['desc'];
        $dise = str_replace("<", "&lt", $dise);
        $dise = str_replace(">", "&gt", $dise);
        $sno = $_POST['srno'];
        $sql = "INSERT INTO `thread` (`thread_title`, `thread_dis`, `thread_cat_id`, `threa_user_id`, `thread_time`) VALUES ('$tit', '$dise', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $alert = true;
        if ($alert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been posted Please wait for response.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>
    <div class="container my-3">
        <div class="container-fluid text-sm-left p-5 bg-secondary text-white ">
            <h1 class="display-4">Welcome to <?php echo $cat; ?> forum</h1>
            <p class="lead"><?php echo $dis; ?></p>
            <hr class="my-4">
            <p>Here you can share your knowledge about the topic with eachother.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
    <div class="container">
        <h1>Start a discussion</h1>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Elobrate your problem</label>
                <input type="hidden" name="srno" value="' . $_SESSION['srno'] . '">
            </div>
            <div id="emailHelp" class="form-text">Keep your problem discription as crisp as possible.</div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    } else {
        echo '
        <div class="container">
        <h1 class="py-2">Start a Discussion</h1> 
           <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
        </div>
        ';
    }
    ?>
    <div class="container">
        <h1 class="py-2">Browse questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $nores = true;
        while ($row = mysqli_fetch_assoc($result)) {
            //echo $row['cat_id'];
            $id1 = $row['thread_id'];
            $nores = false;
            $title = $row['thread_title'];
            $dis = $row['thread_dis'];
            $time = $row['thread_time'];
            $thread_id = $row['threa_user_id'];
            $sql2 = "SELECT user_id FROM `login1` WHERE srno=$thread_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            echo '<div class="d-flex">
          <div class="img"><img src="img/user-alt-512.png" width="34px" class="mr-3" alt="..."></div>
          <div class="media-body flex">
          <p class="fw-bold">' . $row2['user_id'] . ' ' . $time . '</p>
              <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id1 . '">' . $title . '</a></h5>
              <p>' . $dis . '</p>
          </div>
      </div>';
        }
        if ($nores) {
            echo '<div class="container my-3">
            <div class="container-fluid text-sm-left p-5 bg-Light text-dark ">
                <h1 class="display-4">No Threads found</h1>
                <p>Be the first person to ask question</p> 
            </div>
        </div>';
        }
        ?>
    </div>
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