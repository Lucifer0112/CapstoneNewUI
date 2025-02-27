<?php
include('../assets/config/dbconn.php');

$query = "SELECT id, service_type AS title, CONCAT(appointment_date, 'T', appointment_time) AS start, status FROM appointments";
$result = mysqli_query($conn, $query);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start'],
        'color' => $row['status'] === 'approved' ? 'green' : ($row['status'] === 'pending' ? 'orange' : 'red')
    ];
}

echo json_encode($events);
?>