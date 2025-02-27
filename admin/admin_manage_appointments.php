<?php
include '../admin/assets/inc/header.php';
include '../admin/assets/config/dbconn.php';
?>

<!-- Include FullCalendar CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<!-- Page Content -->
<div class="table-container-form">
    <div class="table-container table-form">
        <div class="table-body">
            <h4>Manage Appointments</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Service Type</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT a.*, u.username FROM appointments a JOIN users u ON a.user_id = u.id";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['username']}</td>
                                <td>{$row['service_type']}</td>
                                <td>{$row['appointment_date']} {$row['appointment_time']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <button class='btn btn-sm btn-primary' onclick='updateAppointmentStatus({$row['id']}, \"approved\")'>Approve</button>
                                    <button class='btn btn-sm btn-danger' onclick='updateAppointmentStatus({$row['id']}, \"rejected\")'>Reject</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Appointment Status Updates -->
<script>
function updateAppointmentStatus(appointmentId, status) {
    if (confirm("Are you sure you want to " + status + " this appointment?")) {
        $.ajax({
            url: '/admin/manage-appointment-backend/update_appointment_status.php',
            type: 'POST',
            data: { id: appointmentId, status: status },
            success: function (response) {
                if (response.status === 'success') {
                    alert('Appointment status updated successfully!');
                    location.reload(); // Refresh the page
                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    }
}
</script>

<?php
include '../admin/assets/inc/footer.php';
?>