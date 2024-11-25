<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    
    <!-- Load  -->
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/landing.css?v=<?php echo time(); ?>"> 
    <title>habere | Welcome</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    <!-- Navbar -->
    <nav>
        <a href="">
            <img src="resource/application-icon.png" alt="">
            habere
        </a>
        <a href=""></a>
        <a href=""></a>
        <a href="login.php">SIGN IN</a>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h2>HABIT TRACKER FOR ALL</h2>
        <h1>Welcome to habere!</h1>
        <p>
            Your ultimate habit tracker to build a better you! <br>
            habere is a habit tracking webapp, where you can manage <br>
            your habits.
        </p>
        <button onclick="location.href='signup.php'">Get Started</button>
    </div>
</body> 
</html>