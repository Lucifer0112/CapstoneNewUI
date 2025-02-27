<?php
include('../assets/config/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['date'])) {
    $date = $_GET['date'];

    // Define working hours
    $workingHours = [
        'start' => '09:00:00',
        'end' => '17:00:00',
        'interval' => '01:00:00' // 1-hour intervals
    ];

    // Fetch booked appointments for the selected date
    $query = "SELECT time_slot FROM appointments WHERE appointment_date = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $bookedSlots = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bookedSlots[] = $row['time_slot'];
    }

    // Generate available time slots
    $availableSlots = [];
    $currentTime = strtotime($workingHours['start']);
    $endTime = strtotime($workingHours['end']);

    while ($currentTime < $endTime) {
        $slot = date('H:i:s', $currentTime);
        if (!in_array($slot, $bookedSlots)) {
            $availableSlots[] = $slot;
        }
        $currentTime = strtotime('+' . $workingHours['interval'], $currentTime);
    }

    echo json_encode($availableSlots);
}
?>