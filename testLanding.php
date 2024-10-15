<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/landing.css?v=<?php echo time(); ?>"> 
    <title>habere | Welcome</title>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <h2></h2>
        <a href="testSignup.php">Sign Up</a>
        <a href="testLogin.php">Log In</a>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <img src="resource/application-icon.png" alt="Habere logo" width="200">
        <h1>Welcome to habere!</h1>
        <p class="tagline">Your ultimate habit tracker to build a better you!</p>
        <button onclick="location.href='testSignup.php'">Get Started</button>
    </div>

    <div class="container">
        <h1>MEET THE TEAM</h1>
        <div class="creators">
            <div class="creator">
                <img src="resource/cont-gyles-profile.jpg" alt="gyles">
                <h2>Gyles Perez</h2>
                <p>(Designer)</p>
            </div>
            <div class="creator">
                <img src="resource/cont-prince-profile.jpg" alt="prince">
                <h2>Prince Marco Guerrero</h2>
                <p>(Project Lead and Backend Developer) </p> 
            </div>
            <div class="creator">
                <img src="resource/cont-ian-profile.jpg" alt="ian">
                <h2>Hi, this is ian carlo</h2>
                <p>(Frontend Developer)</p>
            </div>
        </div>
    </div>
</body>
</html>