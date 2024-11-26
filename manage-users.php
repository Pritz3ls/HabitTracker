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
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <title>habere | Manage Users</title>
 
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
            <img src="resource/application-icon.png" alt="Application Icon">
        </div>

        <div class="navbar_items">
            <a href="admin-dashboard.php">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
            <button onclick='showSubMenu("mis",this)'>
                <i class="material-icons" style="vertical-align: middle;">keyboard_arrow_down</i>
                <p>Manage</p>
            </button>
            <div class="submenu" id="mis">
                <a href="manage-users.php">
                    <i class="material-icons" style="vertical-align: middle;">group</i>
                    <p>Manage Users</p>
                </a>
                <a href="manage-activity.php">
                    <i class="material-icons" style="vertical-align: middle;">event</i>
                    <p>Manage Activity</p>
                </a>
            </div>
            <a href="generate-report.php">
                <i class="material-icons">summarize</i>
                <p>Generate Report</p>
            </a>
            <a href="admin-account-settings.php">
                <i class="material-icons">settings</i>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <i class="material-icons">logout</i>
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
                    <option value="user_type">Account Type</option>
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
                        <th>Account Type</th>
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