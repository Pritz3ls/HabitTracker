<?php include "php/db.php"?>
<?php include "php/user-creation.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SignUp.css">
    <title>Test SignUp</title>
    
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="phonenumber" method="post">Phone Number</label>
            <input type="text" name="phonenumber" required>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <input type="text" name="password" required>
        </div>
        <div class="captcha">
            <label for="captchaInput">Enter Captcha:</label><br>
            <span id="captcha"></span><br>
            <input type="text" id="captchaInput" name="captchaInput" required><br>
            <button type="button" onclick="generateCaptcha()">Refresh</button>
            <input type="hidden" id="hiddenCaptcha" name="hiddenCaptcha">
        </div>
        <div>
            <a href="testLogin.php">Already have an account?</a>
        </div>
        <div>
            <select name="user_type" id="" method="post">
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div>
            <input type="submit" value="SignUp" name="create">
        </div>
    </form>
    <!-- This is temporary for captcha authentication -->
    <script>
        // Generate captcha function
        function generateCaptcha() {
            let captchaText = "";
            const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (let i = 0; i < 6; i++) {
                captchaText += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById("captcha").innerText = captchaText;
            document.getElementById("hiddenCaptcha").value = captchaText; 
        }
        // Call the function
        generateCaptcha();
    </script>
</body>
</html>