<?php
    // URL of the script you want to trigger
    $url = "http://habere.42web.io/php.otp/sendMonthlyReports.php";

    // Set the `__test` cookie value (replace with your actual cookie)
    $cookie = "__test=be56c1ecc744b3139762513c8aab34bf";

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Set custom headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Cookie: $cookie",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
        "Referer: http://habere.42web.io/somepreviouspage",
        "Accept-Language: en-US,en;q=0.9"
    ]);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        echo "Response from sendMonthlyReports.php: " . $response;
    }

    // Close cURL
    curl_close($ch);
?>