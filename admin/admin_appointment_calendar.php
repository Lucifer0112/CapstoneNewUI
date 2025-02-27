<?php
include '../admin/assets/inc/header.php';
include '../admin/assets/config/dbconn.php';
?>

<!-- Include FullCalendar CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

<!-- Include jQuery & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<!-- Calendar Container -->
<div class="table-container-form">
    <div class="table-container table-form">
        <div class="table-body">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Book Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="appointmentForm">
                    <input type="hidden" id="appointmentId">
                    <div class="mb-3">
                        <label for="serviceType" class="form-label">Service Type</label>
                        <select class="form-control" id="serviceType" name="serviceType" required>
                            <option value="registration">Registration</option>
                            <option value="renewal">Renewal</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="appointmentDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="timeSlot" class="form-label">Available Time Slots</label>
                        <select class="form-control" id="timeSlot" name="timeSlot" required>
                            <option value="">Select a Time Slot</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveAppointment">Save Appointment</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    console.log('Calendar element:', calendarEl); // Debugging: Check if the calendar element exists

    // Ensure jQuery and Bootstrap are loaded properly
    if (typeof jQuery === "undefined") {
        console.error("jQuery is not loaded. Ensure jQuery is included before FullCalendar.");
    }
    
    if (!calendarEl) {
        console.error("Calendar element not found.");
        return;
    }

    // Initialize FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        dateClick: function (info) {
            console.log('Date clicked:', info.dateStr); // Debugging: Check if dateClick is triggered

            // Open modal to book an appointment
            $('#appointmentModal').modal('show');
            $('#appointmentDate').val(info.dateStr);

            // Fetch available time slots for the selected date
            $.ajax({
                url: './appointment/fetch_time_slots.php',
                type: 'GET',
                data: { date: info.dateStr },
                success: function (response) {
                    console.log('Available slots:', response); // Debugging: Check the response
                    try {
                        var timeSlots = JSON.parse(response);
                        var timeSlotSelect = $('#timeSlot');
                        timeSlotSelect.empty();
                        timeSlotSelect.append(`<option value="">Select a Time Slot</option>`);
                        timeSlots.forEach(function (slot) {
                            timeSlotSelect.append(`<option value="${slot}">${slot}</option>`);
                        });
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching time slots:', error); // Debugging: Check for AJAX errors
                }
            });
        },
        events: './appointment/fetch_appointments.php' // Fetch appointments from the server
    });

    calendar.render();
    console.log('Calendar rendered'); // Debugging: Confirm calendar is rendered

    // Handle saving appointment
    $('#saveAppointment').click(function () {
        var formData = {
            serviceType: $('#serviceType').val(),
            appointmentDate: $('#appointmentDate').val(),
            timeSlot: $('#timeSlot').val(),
            notes: $('#notes').val()
        };

        $.ajax({
            url: './appointment/book_appointment.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log('Booking response:', response); // Debugging: Check the response
                try {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('Appointment booked successfully!');
                        $('#appointmentModal').modal('hide');
                        calendar.refetchEvents(); // Refresh calendar events
                    } else {
                        alert('Error: ' + res.message);
                    }
                } catch (e) {
                    console.error("Error parsing JSON:", e);
                    alert("Unexpected error. Please try again.");
                }
            },
            error: function (xhr, status, error) {
                console.error('Error booking appointment:', error); // Debugging: Check for AJAX errors
                alert("Error booking appointment. Check console for details.");
            }
        });
    });
});
</script>

<?php
include '../admin/assets/inc/footer.php';
?>
