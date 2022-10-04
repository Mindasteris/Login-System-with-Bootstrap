<?php
    session_start();
    require_once('inc/dbc.php');
    $hs_password = "";
    $loggedUser = "";
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
    <title>Login</title>
</head>
<body>
    <div class="container-fluid bg-dark text-center text-light py-3">
        <h1 class="text-icon"> Login</h1>
        <nav>
            <ul class="d-flex list-unstyled justify-content-center mt-3">
                <li class="mx-3"><a class="text-decoration-none" href="./index.php">Home</a></li>
                <li class="mx-3"><a class="text-decoration-none" href="./login.php">Login</a></li>
                <li class="mx-3"><a class="text-decoration-none" href="./signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </div>

    <!-- Login PHP Session -->
    <?php
        if(isset($_POST['login'])) {
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['pass']);

            if(empty($email) || empty($password)) {
                echo '<div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Error!</strong> All fields are required. Please fill all information.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else {
                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                // Get results from DB
                while($row = $result->fetch_assoc()) {
                    $username = $row['username'];
                    $hs_password = $row['password'];
                }
                // Check if input password match DB hashed password
                if(password_verify($password, $hs_password)) {
                    $_SESSION['user'] = $username;
                    header("location: index.php");
                    // echo "pass ok!";
                    // echo $password;
                    // echo $hs_password;
                }
                else {
                echo '<div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Error!</strong> Incorrect username or password.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            }
        }
    ?>

    <!-- Login Form -->
    <div class="container mt-3 text-center">
        <form action="" method="POST">
            <div class="form-group">
                <label for="email"><i class="bi bi-envelope-fill"></i> Email:</label>
                <input class="form-control input" type="email" name="email" placeholder="Please Enter Your Email Address" autocomplete="off">
                <label for="pass"><i class="bi bi-key-fill"></i> Password:</label>
                <input class="form-control input" type="password" name="pass" placeholder="Please Enter Your Password">
            </div>
            <button class="btn btn-primary mt-3" type="submit" name="login">Login</button>
        </form>
        <p class="mt-3">
            <a class="text-decoration-none" href="./signup.php">Don't have an account? Please Sign Up!</a>
        </p>
    </div>


    <!-- Bootstrap JS -->
   <script src="./BS/bootstrap.bundle.min.js"></script>
</body>
</html>