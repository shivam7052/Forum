<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="contact.php" tabindex="-1" >Contact</a>
        </li>
      </ul>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<form class="d-flex form-inline my-2 my-lg-0" method="get" action="search.php">
                <input class="form-control mr-sm-2 mx-1" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                  <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . ' </p>
                  <a href="partial/logout.php" class="btn btn-outline-success ml-2 my-1">Logout</a>
                  </form>';
} else {
  echo '
        <form class="d-flex form-inline my-2 my-lg-0" method="get" action="search.php">
                <input class="form-control mr-sm-2 mx-1" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0 mx-1" type="submit">Search</button>
                </form>
                <button class="btn btn-outline-success mx-1" data-bs-toggle="modal" data-bs-target="#loginmodal">login</button>
          <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
}
echo ' </div>
  </div>
</nav>
';
include 'partial/loginmodal.php';
include 'partial/signupmodal.php';
if (isset($_GET['signsuccess']) && $_GET['signsuccess'] == "true") {
  $res = $_GET['all'];
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  ' . $res . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if (isset($_GET['signsuccess']) && $_GET['signsuccess'] == "false") {
  $res1 = $_GET['wr'];
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  ' . $res1 . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
  $res2 = $_GET['msg'];
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  ' . $res2 . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
  $res2 = $_GET['msg'];
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  ' . $res2 . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
