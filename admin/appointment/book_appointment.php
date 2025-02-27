<?php
include('../assets/config/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $serviceType = $_POST['serviceType'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $notes = $_POST['notes'];
    $userId = 1; // Replace with actual user ID from session

    $query = "INSERT INTO appointments (user_id, service_type, appointment_date, appointment_time, notes, status) 
              VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "issss", $userId, $serviceType, $appointmentDate, $appointmentTime, $notes);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Appointment booked successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error booking appointment: " . mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>