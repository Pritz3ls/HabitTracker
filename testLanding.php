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
    <!-- preloader -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
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
                <p>Designer</p>
            </div>
            <div class="creator">
                <img src="resource/cont-prince-profile.jpg" alt="prince">
                <h2>Prince Marco Guerrero</h2>
                <p>Backend Developer</p> 
            </div>
            <div class="creator">
                <img src="resource/cont-ian-profile.jpg" alt="ian">
                <h2>Ian Carlo Zara</h2>
                <p>Frontend Developer</p>
            </div>
        </div>
    </div>
    <script>
        console.log('JavaScript code executed'); 
        window.onload = function() {
            console.log('Page fully loaded'); // Check if page is fully loaded
            setTimeout(function() {
                const loading = document.getElementById('loading');
                loading.style.display = 'none'; // Hide the loading animation
            }, 500); // Add a .5 second delay to simulate a slower page for the loading animation
        };
    </script>
</body>
</html>