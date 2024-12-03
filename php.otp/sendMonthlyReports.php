<?php
    // Include PHPMailer Library
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'vendor/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/src/SMTP.php';

    include '../php/db.php';

    $otpmail = new PHPMailer(true);
    // Setup the PHPMailer address and app passkey
    $otpmail->isSMTP();
    $otpmail->Host = 'smtp.gmail.com';
    $otpmail->SMTPAuth = true;
    $otpmail->Username = 'web.habere@gmail.com';
    $otpmail->Password = 'qgvnwqbhfejqklih';
    $otpmail->SMTPSecure = 'ssl';
    $otpmail->Port = 465;
    
    $otpmail->setFrom('web.habere@gmail.com');
    
    
    $query = "
        SELECT 
            u.id AS user_id,
            u.user_name,
            u.email,
            COUNT(h.id) AS total_habits,
            COUNT(DISTINCT hl.log_id) AS total_habits_completed,
            COUNT(DISTINCT CASE 
                WHEN MONTH(hl.created_at) = MONTH(CURRENT_DATE) 
                    AND YEAR(hl.created_at) = YEAR(CURRENT_DATE) 
                THEN hl.log_id 
            END) AS habits_completed_this_month,
            ROUND(
                (COUNT(DISTINCT CASE 
                    WHEN MONTH(hl.created_at) = MONTH(CURRENT_DATE) 
                        AND YEAR(hl.created_at) = YEAR(CURRENT_DATE) 
                    THEN hl.log_id 
                END) / COUNT(h.id)) * 100, 
                2
            ) AS completion_rate_percentage
        FROM 
            users u
        JOIN 
            habit_board hb ON u.id = hb.user_id
        JOIN 
            habits h ON hb.id = h.board_id
        LEFT JOIN 
            habit_logs hl ON h.id = hl.habit_id
        WHERE 
            u.user_type = 'client'
            AND u.deleted_at IS NULL
            AND hb.receive_report = 'true'
            AND h.deleted_at IS NULL
        GROUP BY 
            u.id, u.user_name
        LIMIT 100
    ";
    $executedQuery = mysqli_query($conn, $query);

    // Iterate every users
    while($row = mysqli_fetch_assoc($executedQuery)){
        // Recepient
        $user_name = $row['user_name'];
        $email = $row['email'];
        // Stats
        $total_habits = $row['total_habits'];
        $completed_habits = $row['total_habits_completed'];
        $rate = $row['completion_rate_percentage'];
        
        // Compile the mail details
        $message = 
        "<html>
            <body style='font-family: sans-serif;'>
                <div class='mail' style='width: 480px; background-color: #FFFFFF;'>
                    <header style='
                        background-color: #2ECC40;
                        padding: 5px;
                        color: #FFFFFF;

                        display: flex;
                        align-items: center;
                        gap: 10px;
                        '>
                        <h3 style='margin: 0; padding-left: 10px;'>Habere</h3>
                    </header>
                    <div class='body' style='padding: 5px; color: #122023'>
                        <p>Hi $user_name,</p>
                        <p style='color: #122023;'>Congratulations on another productive month! Here's a quick summary of your habits in Habere:</p>
                        <div>
                            <ul style='font-weight: 600; color: #2ECC40;'>
                                <li>Total Habits: $total_habits</li>
                                <li>Habits Completed: $completed_habits</li>
                                <li>Completion Rate: $rate%</li>
                            </ul>
                        </div>
                        <p style='color: #122023; margin: 0;'>Keep up the great work, and let's make next month even better!</p>
                        <div style='margin: 10px 0 30px 0;'>
                            <p style='color: #122023; margin: 0; font-size: 13px;'>Cheers,</p>
                            <p style='color: #122023; margin: 0; font-size: 13px'>The Habere Team</p>
                        </div>
                    </div>
                    <footer style='
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                        color: #122023;
                        '>
                        <p style='margin: 0px 10px; font-size: 10px;'>Copyright © Habere. ILYSBU, Inc., Lipa, Batangas</p>
                        <p style='margin: 0px 10px; font-size: 10px;'>This message was sent to $email and intended for $user_name.</p>
                    </footer>
                </div>
            </body>
        </html>";
        
        // Add an address, for this matter, use the preceeding email
        $otpmail->addAddress($email);
        $otpmail->isHTML(true);
        
        // Add a subject
        $otpmail->Subject = 'Habere Monthly Report';
        // Add a message body, for this use OTP
        $otpmail->Body = $message;
        
        // Send the mail
        $otpmail->send();
    
        // Clear the address
        $otpmail->clearAddresses();
        
        // Prevent Overload, delay emails by 1 seconds
        sleep(5);
    }

    echo 'Monthly Report Sent to all users!';
?>