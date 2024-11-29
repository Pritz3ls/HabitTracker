<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    
    <!-- Load  -->
    <script defer src="js/fade.js"></script>
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

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
    
    <!-- Main Content -->
    <nav>
        <a href="">
            <img src="resource/application-icon.png" alt="">
            habere
        </a>
        <a href="#about-habere">ABOUT</a>
        <a href="#creators">TEAM</a>
        <a href="login.php">SIGN IN</a>
    </nav>

    <!-- Container -->
    <div class="container">
        <!-- Welcome -->
        <section class="welcome">
            <h2>HABIT TRACKER FOR ALL</h2>
            <h1>Welcome to habere!</h1>
            <p>
                Your ultimate habit tracker to build a better you! <br>
                habere is a habit tracking webapp, where you can manage <br>
                your habits.
            </p>
            <button onclick="location.href='signup.php'">Get Started</button>
        </section>
        
        <section id="about-habere" class="about-habere">
            <h2>About Habere</h2>
            <p>
                Habere is your ultimate habit tracker designed to make building and maintaining habits exciting and rewarding.
                Organize your goals with a personalized Habit Board, earn XP every time you complete a habit, and climb the 
                Leaderboards to showcase your progress.Whether you're aiming for personal growth or a little friendly 
                competition, Habere turns your habits into achievements!
            </p>
        </section>
        <!-- Features -->
        <section class="features">
                <h2>Features Available In Our Website</h2>
                <p>A guide to show you what habere features are.</p>
                <div class="feature-cards">
                    <div class="card-container">
                        <div class="card">
                            <h3>Progress Tracking</h3>
                            <i class="fa fa-chart-line"></i> 
                            <p class="feature-description">Track your progress in every habit you complete.</p> <!-- Description hidden by default -->
                        </div>  
                    </div>
                    <div class="card-container">
                        <div class="card">
                            <h3>Habit Creation</h3>
                            <i class="fa fa-cogs"></i> 
                            <p class="feature-description">Create and customize your own habit routine.</p> <!-- Description hidden by default -->
                        </div>
                    </div>
                    <div class="card-container">
                        <div class="card">
                            <h3>Gamification</h3>
                            <i class="fa fa-trophy"></i> 
                            <p class="feature-description">Complete your habits and earn XP points to climb the leaderboards.</p> <!-- Description hidden by default -->
                        </div>
                    </div>
                    <div class="card-container">
                        <div class="card">
                            <h3>Personalized Notification</h3>
                            <i class="fa fa-bell"></i> 
                            <p class="feature-description">Personalize your notifications to receive only what you want.</p> <!-- Description hidden by default -->
                        </div>
                    </div>
                </div>
        </section>

        <!-- Creators -->
        <section id="creators" class="creators">
            <div class="creators-title">
                <h2>Meet The</h2> 
                <h2>Team</h2>
            </div>
            <div class="creators-container"> 
                <div class="creator">
                    <img src="resource/cont-ian.jpg" alt="Ian Zara Picture" width="120" height="120"> 
                    <h2>Ian Zara</h2>
                    <p>Frontend Developer</p>   
                </div>
                <div class="creator">
                    <img src="resource/cont-prince-profile.jpg" alt="Prince Guerrero Picture" width="120" height="120"> 
                    <h2>Prince Guerrero</h2>
                    <p>Lead Developer</p>   
                </div>
                <div class="creator">
                    <img src="resource/cont-gyles.jpg" alt="Gyles Perez Picture" width="120" height="120"> 
                    <h2>Gyles Perez</h2>
                    <p>Designer</p>   
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>@2024 habere |  Privacy Policy | Terms of Service</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/yourprofile" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/yourprofile" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>

</body> 
</html>