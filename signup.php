<?php
    session_start();
    require_once('inc/dbc.php');

    if(isset($_POST['signup'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['pass']);
        $password2 = $conn->real_escape_string($_POST['repeat_pass']);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }
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
    <title>Sign Up</title>
</head>
<body>
    <div class="container-fluid bg-dark text-center text-light py-3">
        <h1 class="text-icon"> Sign Up</h1>
        <nav>
            <ul class="d-flex list-unstyled justify-content-center mt-3">
                <li class="mx-3"><a class="text-decoration-none" href="./index.php">Home</a></li>
                <li class="mx-3"><a class="text-decoration-none" href="./login.php">Login</a></li>
                <li class="mx-3"><a class="text-decoration-none" href="./signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </div>

    <!-- PHP Form Validate -->
    <!-- Check for Empty Fields -->
    <?php
        if(isset($_POST['signup'])) {
            if(empty($username) || empty($email) || empty($password) || empty($password2)) {
                echo '<div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Error!</strong> All fields are required. Please fill all information.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } // Check for password length
            else if(strlen($password) < 8) {
                echo '<div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Error!</strong> Password cannot be less than 8 characters.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } // Check for password match
            else if($password != $password2) {
                echo '<div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Error!</strong> Passwords does not match!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } // Check for not allow numbers in "Username" field
            else if (preg_match("/[0-9]+/", $username)) {
                echo '<div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Error!</strong> Username cannot contain any numbers. Please use only letters.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else {
                // Database register user
                $sql = "INSERT INTO users(username, email, password)
                VALUES(?,?,?)";
                $stmt= $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $hashed_password);
                $stmt->execute();
                $stmt->close();
                $conn->close();

                // Message for success
                echo '<div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">
                <strong>Congratulations!</strong> You have successfully registered. You can now login.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>

    <!-- Sign Up Form -->
    <div class="container mt-3 text-center">
        <form action="" method="POST">
            <div class="form-group">
                <label for="username"><i class="bi bi-person-fill"></i> Username:</label>
                <input class="form-control input" type="text" name="username" placeholder="Please Enter Your Username" autocomplete="off">
                <label for="email"><i class="bi bi-envelope-fill"></i> Email:</label>
                <input class="form-control input" type="email" name="email" placeholder="Please Enter Your Email Address" autocomplete="off">
                <label for="pass"><i class="bi bi-key-fill"></i> Password:</i></label>
                <input class="form-control input" type="password" name="pass" placeholder="Please Enter Your Password">
                <label for="r_pass"><i class="bi bi-key-fill"></i> Repeat Password:</label>
                <input class="form-control input" type="password" name="repeat_pass" placeholder="Confirm Password">
            </div>
            <button class="btn btn-primary mt-3" type="submit" name="signup">Sign Up</button>
        </form>
        <p class="mt-3">
            <a class="text-decoration-none" href="./login.php">Have an account? Please Login!</a>
        </p>
    </div>

    <!-- Bootstrap JS -->
   <script src="./BS/bootstrap.bundle.min.js"></script>
</body>
</html>