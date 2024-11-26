<?php
    include '../php/db.php';
    include '../php.dashboard/dashboard-admin-utils.php';

    $data = [];
    $originalStartDate = date_create('2024-10-01'); // Original start date
    $currentDate = date_create();                  // Current date

    // Calculate the difference in months between original start date and current date
    $diff = date_diff($originalStartDate, $currentDate);
    $totalMonths = $diff->m + ($diff->y * 12); // Total months difference

    // Determine the adjusted start date for the last 6 months
    if ($totalMonths > 6) {
        $startDate = date_modify(clone $currentDate, '-6 months'); // Dynamically adjust start date
    } else {
        $startDate = $originalStartDate; // Use the original start date if within 6 months
    }

    // Recalculate the offset (number of months to loop through)
    $offset = date_diff($startDate, $currentDate)->m + (date_diff($startDate, $currentDate)->y * 12);

    for ($i = 0; $i <= $offset; $i++) { 
        $formatDate = date_format($startDate, 'M Y'); // Format the current iteration date (e.g., Oct 2024)
        
        // Fetch data for the current month
        $item = mysqli_fetch_array(Fetch_GraphCustomData(date_format($startDate, 'Y-m-d')));
        
        // Prepare the data array
        $temp = [
            'total_habits' => $item['total_habits'] ?? 0,
            'total_completed_habits' => $item['total_completed_habits'] ?? 0,
            'registered_users' => $item['registered_users'] ?? 0,
            'date' => $formatDate
        ];
        array_push($data, $temp);
        
        // Increment startDate by one month
        $startDate = date_modify($startDate, "+1 Month");
    }

    echo json_encode($data);
?>
