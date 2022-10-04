<?php
    session_start();
    require_once('inc/dbc.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mindaugas Šunokas">
    <meta name="description" content="This is a Login System">
    <meta name="keywords" content="HTML, CSS, PHP, BootStrap">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./BS/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./style.css">
    <!-- Webpage's Tab Icon -->
    <link rel="icon" href="./icon.webp">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- BS Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Home</title>
</head>
<body>

    <!-- PHP user login and check for links -->
    <?php if(!isset($_SESSION['user'])) {?>
        <div class="container-fluid bg-dark text-center text-light py-3">
            <h1 class="text-icon"> Home</h1>
            <nav>
                <ul class="d-flex list-unstyled justify-content-center mt-3">
                    <li class="mx-3"><a class="text-decoration-none" href="./index.php">Home</a></li>
                    <li class="mx-3"><a class="text-decoration-none" href="./login.php">Login</a></li>
                    <li class="mx-3"><a class="text-decoration-none" href="./signup.php">Sign Up</a></li>
                </ul>
            </nav>
         </div>

    <h1 class="text-center mt-3">HOMEPAGE</h1>

    <h6 class="text-center">Please Login or Signup!</h6>

    <?php } else { ?>
        <div class="container-fluid bg-dark text-center text-light py-3">
            <h1 class="text-icon"> Home</h1>
            <nav>
                <ul class="d-flex list-unstyled justify-content-center mt-3">
                    <li class="mx-3"><a class="text-decoration-none" href="./index.php">Home</a></li>
                </ul>
            </nav>
         </div>

        <h1 class="text-center mt-3">HOMEPAGE</h1>

        <!-- Welcome user -->
        <h2 class="text-center mt-3">Welcome: <?php echo $_SESSION['user']; ?></h2>
        <!-- Logout link -->
        <p class="mt-3 text-center">
            <a class="text-decoration-none" href="./logout.php">Logout</a>
        </p>
    <?php } ?>
    

    <!-- Bootstrap JS -->
   <script src="./BS/bootstrap.bundle.min.js"></script>
</body>
</html>