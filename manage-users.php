<?php
    require 'php/db.php';
    include "php.utils/activity-logging.php";
    include "php.mis/mis-user-utils.php";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
 
    <!-- Load  -->
    <script defer src="js/navbar.js"></script>
    <script defer src="js/spinner.js"></script>
    <script src="js/showdeactpanel.js"></script>

    <link rel="stylesheet" href="css/spinner.css">
    
    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/mis.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
    <!-- Burger Button -->
    <div class="header">
        <!-- Burger Button -->
        <button type="button" onclick="burgir();" class="burgir">=</button>
    </div>

    <!-- Navigation Bar -->
    <div class="navbar" id="navbar">
        <div class="navbar_logo">
            <img src="resource/application-icon.png" alt="">
        </div>
        <div class="navbar_items">
            <a href="admin-dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h240v-560H200v560Zm320 0h240v-280H520v280Zm0-360h240v-200H520v200Z"/></svg>
                <p>Dashboard</p>
            </a>
            <div>
                <p>Manage</p>
                <a href="manage-users.php">Manage Users</a>
                <a href="manage-activity.php">Manage Activity</a>
            </div>
            <a href="admin-account-settings.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                <p>Logout</p>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <form action="" method="post" class="filter">
            <!-- Search -->
            <div class="field">
                <input name="username" type="text" placeholder="Search Username" value=<?php echo !empty($_SESSION['mis_user_name']) ? $_SESSION['mis_user_name'] : ""?>>
            </div>
            <div>
                <select name="sortBy" id="">
                    <option value="" hidden selected>Sort by</option>
                    <option value="user_name">Username</option>
                    <option value="created_at">Account Creation</option>
                </select>
            </div>
            <input name="filter" type="submit" value="Filter">
            <input name="reset" type="submit" value="Reset">
        </form>
        <div class="wrapper">
            <table>
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Phonenumber</th>
                        <th>Created at</th>
                        <th>Operation</th>
                    </tr>
                    <?php
                        FetchTableData();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        $cur_page = empty($_GET['page-nr']) ? 1 : $_GET['page-nr'];
    ?>
    <div class="navigation">
        <p>Showing page <?php echo $cur_page." of " . $num_pages?></p>
        <div class='page-buttons'>
            <!-- First page -->
            <a href="?page-nr=1">First</a>
            
            <a href="?page-nr=<?php echo $cur_page == 1 ? 1 : ($cur_page-1)?>">Prev</a>
            <a href="?page-nr=<?php echo $cur_page == $num_pages ? $num_pages : ($cur_page+1)?>">Next</a>

            <!-- Last page -->
            <a href="?page-nr=<?php echo $num_pages?>">Last</a>
        </div>
    </div>
    <!-- View Panel -->
    <div class="view" id="view">
    </div>
</body>
</html>