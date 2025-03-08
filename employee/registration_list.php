<?php

include('../employee/assets/inc/header.php');


?>



<!-- QR code Scanner Modal -->
<div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Scan QR Code</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <script src="../employee/assets/js/html5-qrcode.min.js"></script>
                <style>
                    #qrcodeModal .result {

                        color: #007bff;
                        padding: 15px;
                        border-radius: 8px;
                        font-weight: bold;
                    }

                    #qrcodeModal .row {
                        display: flex;
                        gap: 20px;
                    }

                    #qrcodeModal .col {
                        flex: 1;
                    }

                    #qrcodeModal #reader {
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                        overflow: hidden;
                    }

                    #qrcodeModal h4 {
                        font-size: 1.25rem;
                        margin-bottom: 10px;
                    }

                    #qrcodeModal #result {
                        font-size: 1rem;
                        padding: 15px;
                        background-color: #f5f5f5;
                        border-radius: 8px;
                        border: 1px solid #ddd;
                        margin-top: 10px;
                        word-wrap: break-word;
                    }

                    #qrcodeModal table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 15px;
                    }

                    #qrcodeModal th,
                    #qrcodeModal td {
                        padding: 12px;
                        text-align: left;
                    }

                    #qrcodeModal th {
                        background-color: #f1f1f1;
                        font-weight: bold;
                    }

                    #qrcodeModal td {
                        background-color: #fff;
                    }

                    #qrcodeModal .modal-footer {
                        border-top: 1px solid #ddd;
                    }

                    #qrcodeModal .btn-primary {
                        background-color: #007bff;
                        border-color: #007bff;
                    }

                    #qrcodeModal .btn-primary:hover {
                        background-color: #0056b3;
                        border-color: #0056b3;
                    }

                    #qrcodeModal .btn-secondary {
                        background-color: #6c757d;
                        border-color: #6c757d;
                    }

                    #qrcodeModal .btn-secondary:hover {
                        background-color: #5a6268;
                        border-color: #545b62;
                    }
                </style>
                <div class="row">
                    <div class="col">
                        <div id="reader" style="width: 100%; max-width: 470px;"></div>
                    </div>
                    <div class="col">
                        <h4>SCAN RESULT</h4>
                        <div id="result">Result will appear here</div>
                    </div>
                </div>

                <script type="text/javascript">
                    function onScanSuccess(qrCodeMessage) {
                        const ApplicationIDMatch = qrCodeMessage.match(/(APP-\d{12})/);
                        if (ApplicationIDMatch) {
                            const application_id = ApplicationIDMatch[1];
                            fetchDataFromServer(application_id);
                        } else {
                            document.getElementById('result').innerHTML = '<span class="result">QR code does not contain a valid application ID</span>';
                        }
                    }

                    function onScanError(errorMessage) {
                        console.error('Scan error:', errorMessage);
                    }

                    function fetchDataFromServer(application_id) {
                        fetch('fetch_data.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams({
                                    'application_id': application_id
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Check the status in the response
                                if (data.status === "success") {
                                    // Call renderDataInTable if data is found
                                    renderDataInTable(data);
                                } else if (data.status === "error") {
                                    // Show the error message if no data is found
                                    document.getElementById('result').innerHTML = '<span class="result">' + data.message + '</span>';
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }

                    function renderDataInTable(data) {
                        // Check if data is valid
                        if (data.status === "success" && data.data) {
                            const application = data.data;
                            let tableHtml = `
            <table border="1">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Application Number</td><td>${application.application_number}</td></tr>
                    <tr><td>Full Name</td><td>${application.fname} ${application.mname} ${application.lname}</td></tr>
                    <tr><td>Address</td><td>${application.address}</td></tr>
                    <tr><td>Business Address</td><td>${application.business_address}</td></tr>
                    <tr><td>Business Name</td><td>${application.business_name}</td></tr>
                    <tr><td>Business Type</td><td>${application.business_type}</td></tr>
                    <tr><td>Date of Application</td><td>${application.date_application}</td></tr>
                    <tr><td>Document Status</td><td>${application.document_status}</td></tr>
                    <tr><td>Email</td><td>${application.email}</td></tr>
                    <tr><td>Phone</td><td>${application.phone}</td></tr>
                    <tr><td>Status</td><td>${application.application_status}</td></tr>
                </tbody>
            </table> `;
                            // Insert the table into your page (e.g., a div with id 'result')
                            document.getElementById('result').innerHTML = tableHtml;
                        } else {
                            document.getElementById('result').innerHTML = '<span class="result">Invalid data received from the server.</span>';
                        }
                    }


                    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
                        fps: 10,
                        qrbox: 250
                    });
                    html5QrcodeScanner.render(onScanSuccess, onScanError);
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="qrcode()">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End QR code Modal -->


<!-- Update Registration Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="updateId" name="id">
                    <div class="mb-3">
                        <label for="updateFirstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="updateFirstname" name="fname">
                    </div>
                    <div class="mb-3">
                        <label for="updateMiddlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="updateMiddlename" name="mname">
                    </div>
                    <div class="mb-3">
                        <label for="updateLastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="updateLastname" name="lname">
                    </div>
                    <div class="mb-3">
                        <label for="updateEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="updatePhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="updatePhone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="updateAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="updateAddress" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="updateZip" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="updateZip" name="zip" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateBusinessName" class="form-label">Business Name</label>
                        <input type="text" class="form-control" id="updateBusinessName" name="business_name">
                    </div>
                    <div class="mb-3">
                        <label for="updateBusinessAddress" class="form-label">Business Address</label>
                        <input type="text" class="form-control" id="updateBusinessAddress" name="business_address">
                    </div>
                    <div class="mb-3">
                        <label for="updateBuildingName" class="form-label">Building Name</label>
                        <input type="text" class="form-control" id="updateBuildingName" name="building_name">
                    </div>
                    <div class="mb-3">
                        <label for="updateBuildingNo" class="form-label">Building No</label>
                        <input type="text" class="form-control" id="updateBuildingNo" name="building_no">
                    </div>
                    <div class="mb-3">
                        <label for="updateStreet" class="form-label">Street</label>
                        <input type="text" class="form-control" id="updateStreet" name="street">
                    </div>
                    <div class="mb-3">
                        <label for="updateBarangay" class="form-label">Barangay</label>
                        <input type="text" class="form-control" id="updateBarangay" name="barangay">
                    </div>
                    <div class="mb-3">
                        <label for="updateBusinessType" class="form-label">Business Type</label>
                        <input type="text" class="form-control" id="updateBusinessType" name="business_type">
                    </div>
                    <div class="mb-3">
                        <label for="updateRentPerMonth" class="form-label">Rent Per Month</label>
                        <input type="text" class="form-control" id="updateRentPerMonth" name="rent_per_month">
                    </div>
                    <div class="mb-3">
                        <label for="updateDateofApplication" class="form-label">Date of Application</label>
                        <input type="date" class="form-control" id="updateDateofApplication" name="date_application">
                    </div>
                    <div class="mb-3">
                        <label for="updateApplicationNumber" class="form-label">Application Number</label>
                        <input type="text" class="form-control" id="updateApplicationNumber" name="application_number" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="updateDocumentStatus" class="form-label">Document Status</label>
                        <select class="form-control" id="updateDocumentStatus" name="document_status" disabled>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                        </select>
                        <!-- Hidden input to include document_status in form submission -->
                        <input type="hidden" name="document_status" id="hiddenDocumentStatus">
                    </div>
                    <!-- File upload fields here -->
                                   <!-- DTI Document -->
                    <div class="mb-3">
                        <label for="updateUploadDti" class="form-label">Upload DTI</label>
                        <input type="file" class="form-control" id="updateUploadDti" name="upload_dti" accept=".pdf,.jpg,.jpeg,.png">
                        <div id="currentDti" class="mt-2">
                            <strong>Current DTI:</strong>
                            <img id="currentDtiImage" src="" alt="Current DTI" style="max-width: 100px; display: none;">
                            <span id="currentDtiFileName"></span>
                        </div>
                    </div>

                    <!-- Store Picture -->
                    <div class="mb-3">
                        <label for="updateUploadStorePicture" class="form-label">Upload Store Picture</label>
                        <input type="file" class="form-control" id="updateUploadStorePicture" name="upload_store_picture" accept=".jpg,.jpeg,.png">
                        <div id="currentStorePicture" class="mt-2">
                            <strong>Current Store Picture:</strong>
                            <img id="currentStorePictureImage" src="" alt="Current Store Picture" style="max-width: 100px;">
                        </div>
                    </div>

                    <!-- Food Security Clearance -->
                    <div class="mb-3">
                        <label for="updateFoodSecurityClearance" class="form-label">Food Security Clearance</label>
                        <input type="file" class="form-control" id="updateFoodSecurityClearance" name="food_security_clearance" accept=".pdf,.jpg,.jpeg,.png">
                        <div id="currentFoodSecurityClearance" class="mt-2">
                            <strong>Current Food Security Clearance:</strong>
                            <img id="currentFoodSecurityClearanceImage" src="" alt="Current Food Security Clearance" style="max-width: 100px; display: none;">
                            <span id="currentFoodSecurityClearanceFileName"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Update Renewal Modal -->


<!-- View Registration Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Registration Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <h5>Store Picture</h5>
                            <img id="viewStorePicture" src="default_store_picture.jpg" alt="Store Picture" class="img-fluid rounded">
                        </div>
                        <div class="text-center">
                            <h5>Food Security Clearance</h5>
                            <img id="viewFoodSecurityClearance" src="default_food_security.jpg" alt="Food Security Clearance" class="img-fluid rounded">
                        </div>
                        <div class="text-center">
                            <h5>DTI Document</h5>
                            <img id="viewUploadDti" src="default_dti.jpg" alt="DTI Document" class="img-fluid rounded">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p><strong>First Name:</strong> <span id="viewFirstname"></span></p>
                        <p><strong>Middle Name:</strong> <span id="viewMiddlename"></span></p>
                        <p><strong>Last Name:</strong> <span id="viewLastname"></span></p>
                        <p><strong>Email:</strong> <span id="viewEmail"></span></p>
                        <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
                        <p><strong>Address:</strong> <span id="viewAddress"></span></p>
                        <p><strong>Zip Code:</strong> <span id="viewZip"></span></p>
                        <p><strong>Business Name:</strong> <span id="viewBusinessName"></span></p>
                        <p><strong>Business Address:</strong> <span id="viewBusinessAddress"></span></p>
                        <p><strong>Building Name:</strong> <span id="viewBuildingName"></span></p>
                        <p><strong>Building No:</strong> <span id="viewBuildingNo"></span></p>
                        <p><strong>Street:</strong> <span id="viewStreet"></span></p>
                        <p><strong>Barangay:</strong> <span id="viewBarangay"></span></p>
                        <p><strong>Business Type:</strong> <span id="viewBusinessType"></span></p>
                        <p><strong>Rent per Month:</strong> <span id="viewRentPerMonth"></span></p>
                        <p><strong>Date of Application:</strong> <span id="viewDateofApplication"></span></p>
                        <p><strong>application_number:</strong> <span id="viewapplication_number"></span></p>
                        <p><strong>Expiration Date:</strong> <span id="viewExpirationDate"></span></p>
                        <p><strong>Status:</strong> <span id="viewDocumentStatus"></span></p> <!-- Added Status -->
                    </div>
                </div>
            </div>
            <input type="hidden" id="hiddendata" value="">
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="updateApplicationStatus('Approved')">Approve</button>
                <button type="button" class="btn btn-danger" onclick="updateApplicationStatus('Need Correction')">Notify</button>
                <button type="button" class="btn btn-primary" id="releaseButton" onclick="releaseApplication()" disabled>Release</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- View Registration Modal end  -->

<!-- Image View Modal -->
<div class="modal fade" id="imageViewModal" tabindex="-1" aria-labelledby="imageViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageViewModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="imagePreview" src="" alt="Image Preview" class="img-fluid">
            </div>
        </div>
    </div>
</div>




<!--YOUR CONTENTHERE-->
<div class="fix-table-header">
    <h4>Regsitration List</h4>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#qrcodeModal">
        <i class="fa-solid fa-qrcode"></i>
    </button>
</div>
<div class="table-container-form">
    <div class="table-container table-form">
        <div class="table-body ">
            <table id="myTable">
                <tbody>
                <ul class="nav nav-tabs" id="statusTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#all" onclick="filterData('All')">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#approved" onclick="filterData('Approved')">Approved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#pending" onclick="filterData('Pending')">Pending</a>
                    </li>
                   
                </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all">
                            <div id="displayDataTableAll"></div>
                        </div>
                        <div class="tab-pane fade" id="approved">
                            <div id="displayDataTableApproved"></div>
                        </div>
                        <div class="tab-pane fade" id="pending">
                            <div id="displayDataTablePending"></div>
                        </div>
                        
                    </div>

                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Send Email Modal -->
<div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendEmailModalLabel">Send Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <h5>Permit Details</h5>
                            <p><strong>Business Name:</strong> <span id="permitBusinessName"></span></p>
                            <p><strong>Owner:</strong> <span id="permitOwnerName"></span></p>
                            <p><strong>Permit Type:</strong> <span id="permitType"></span></p>
                        </div>
                        <div class="text-center mt-4">
                            <h5>Generated QR Code</h5>
                            <img id="permitQRCode" class="d-none" alt="Generated QR Code" style="max-width: 300px; margin-top: 20px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="releaseEmail" class="form-label"><strong>Recipient Email</strong></label>
                        <input type="email" id="releaseEmail" class="form-control" placeholder="Enter recipient email" required>

                        <label for="releaseMessage" class="form-label mt-3"><strong>Custom Message</strong></label>
                        <textarea id="releaseMessage" class="form-control" rows="4" placeholder="Enter a custom message (optional)"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="generateQRCodeBtn">Generate QR Code</button>
                <button type="button" class="btn btn-success" id="sendEmailBtn">Send Email</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Send Email Modal End -->






<?php
include('../employee/assets/inc/footer.php');
?>


<script>
    $(document).ready(function() {
        filterData('All'); // Load all data by default
    });

        function filterData(status) {
        $.ajax({
            url: "registration_list_displaydata.php",
            type: 'post',
            data: {
                displaysend: status
            },
            success: function(data) {
                if (status === 'All') {
                    $('#displayDataTableAll').html(data);
                } else if (status === 'Approved') {
                    $('#displayDataTableApproved').html(data);
                } else if (status === 'Pending') {
                    $('#displayDataTablePending').html(data);
                } else if (status === 'Pending to Released') {
                    $('#displayDataTablePendingToReleased').html(data);
                } else if (status === 'Released') {
                    $('#displayDataTableReleased').html(data);
                } 
            }
        });
    }
    //send email modal
    function sendEmail(userId) {
        // Fetch user details via an AJAX POST request
        $.post("registration_get_details.php", {
            updateid: userId
        }, function(data, status) {
            // Parse the returned JSON data
            var user = JSON.parse(data);

            // Populate the fields in the Send Email Modal
            $('#permitBusinessName').text(user.business_name);
            $('#permitOwnerName').text(user.fname + ' ' + user.mname + ' ' + user.lname);
            $('#permitType').text(user.business_type);
            $('#permitExpiration').text(user.period_date);

            // Auto-fill the recipient email
            $('#releaseEmail').val(user.email);
            // Store the application number for future use
            var applicationNumber = user.application_number;

            $(document).ready(function() {
                // When modal is closed, hide the QR code image
                $('#sendEmailModal').on('hidden.bs.modal', function() {
                    $('#permitQRCode').addClass('d-none'); // Hide QR code image
                    $('#permitQRCode').attr('src', ''); // Reset the image source
                });

                // Handle form submission to generate the QR code
                $('#generateQRCodeBtn').click(function() {
                    const email = $('#releaseEmail').val();

                    // Send the email to generate QR code
                    $.post('generate_qr.php', {
                        application_number: applicationNumber
                    }, function(response) {
                        if (response.success) {
                            $('#permitQRCode').attr('src', response.qr_code_base64).removeClass('d-none'); // Show the QR code
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }, 'json');
                });
            });

            // Handle "Send Email" button click
            $('#sendEmailBtn').click(function() {
                const recipientEmail = $('#releaseEmail').val();
                const customMessage = $('#releaseMessage').val();
                const qrCodeBase64 = $('#permitQRCode').attr('src');
                const businessName = $('#permitBusinessName').text();
                const ownerName = $('#permitOwnerName').text();
                const permitType = $('#permitType').text();

                // Validate that required fields are filled
                if (!recipientEmail || !qrCodeBase64) {
                    alert("Please provide the required information (recipient email and QR code).");
                    return;
                }

                // Prepare the data to send to the backend
                const data = {
                    recipient_email: recipientEmail,
                    qr_code_base64: qrCodeBase64,
                    custom_message: customMessage, // Optional
                    business_name: businessName,
                    owner_name: ownerName,
                    permit_type: permitType
                };

                // Send the data to the backend using AJAX (Fetch API)
                $.ajax({
                    url: 'send_email.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        if (response.success) {
                            alert("Email sent successfully!");
                            // Close the modal after successful email sending
                            $('#sendEmailModal').modal('hide');
                        } else {
                            alert("Failed to send email: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Error sending email: " + error);
                    }
                });
            });

            // Show the Send Email Modal
            $('#sendEmailModal').modal("show");
        });
    }



    //delete function
    function deleteuser(deleteid) {
        $.ajax({
            url: "registration_list_delete.php",
            type: 'post',
            data: {
                deletesend: deleteid
            },
            success: function(data, status) {
                //console.log(status);
                displayData();
            }
        });
    }


    $(document).ready(function() {
        displayData();
    });

    // Function to display user data
    function displayData() {
        var displayData = "true";
        $.ajax({
            url: "registration_list_displaydata.php",
            type: 'post',
            data: {
                displaysend: displayData
            },
            success: function(data, status) {
                $('#displayDataTable').html(data);
            }
        });
    }

    // Function to get user details and populate the update modal
    function getdetails(updateid) {
    $('#updateId').val(updateid);

    // Make an AJAX request to fetch the details for the selected user
    $.post("registration_get_details.php", {
        updateid: updateid
    }, function(data, status) {
        var user = JSON.parse(data);

        // Populate the form fields with the fetched user data
        $('#updateFirstname').val(user.fname);
        $('#updateMiddlename').val(user.mname);
        $('#updateLastname').val(user.lname);
        $('#updateEmail').val(user.email);
        $('#updatePhone').val(user.phone);
        $('#updateAddress').val(user.address);
        $('#updateZip').val(user.zip);
        $('#updateBusinessName').val(user.business_name);
        $('#updateBusinessAddress').val(user.business_address);
        $('#updateBuildingName').val(user.building_name);
        $('#updateBuildingNo').val(user.building_no);
        $('#updateStreet').val(user.street);
        $('#updateBarangay').val(user.barangay);
        $('#updateBusinessType').val(user.business_type);
        $('#updateRentPerMonth').val(user.rent_per_month);
        $('#updateDateofApplication').val(user.date_application);
        $('#updateApplicationNumber').val(user.application_number);
        $('#updateDocumentStatus').val(user.document_status);

        // Populate the hidden input for document_status
        $('#hiddenDocumentStatus').val(user.document_status);

        // Disable the Document Status dropdown
        $('#updateDocumentStatus').prop('disabled', true);

        // Disable the Application Number input
        $('#updateApplicationNumber').prop('readonly', true);

        // Display previously uploaded files
        if (user.upload_dti) {
            if (user.upload_dti.endsWith('.pdf')) {
                $('#currentDtiImage').hide();
                $('#currentDtiFileName').text(user.upload_dti);
            } else {
                $('#currentDtiImage').attr('src', '../user/assets/image/' + user.upload_dti).show();
                $('#currentDtiFileName').text('');
            }
        }

        if (user.upload_store_picture) {
            $('#currentStorePictureImage').attr('src', '../user/assets/image/' + user.upload_store_picture).show();
        }

        if (user.food_security_clearance) {
            if (user.food_security_clearance.endsWith('.pdf')) {
                $('#currentFoodSecurityClearanceImage').hide();
                $('#currentFoodSecurityClearanceFileName').text(user.food_security_clearance);
            } else {
                $('#currentFoodSecurityClearanceImage').attr('src', '../user/assets/image/' + user.food_security_clearance).show();
                $('#currentFoodSecurityClearanceFileName').text('');
            }
        }
    });

    // Show the update modal
    $('#updateModal').modal("show");
}



    // view function for displaying user details including image files
        function viewDetails(viewid) {
        $.post("registration_list_view.php", {
            viewid: viewid
        }, function(data, status) {
            var user = JSON.parse(data);

            if (user.error) {
                alert(user.error);
                return;
            }

            console.log("Document Status:", user.document_status); // Debugging

            $('#hiddendata').val(viewid);

            $('#viewFirstname').text(user.fname);
            $('#viewMiddlename').text(user.mname);
            $('#viewLastname').text(user.lname);
            $('#viewEmail').text(user.email);
            $('#viewPhone').text(user.phone);
            $('#viewAddress').text(user.address);
            $('#viewZip').text(user.zipcode);
            $('#viewBusinessName').text(user.business_name);
            $('#viewBusinessAddress').text(user.business_address);
            $('#viewBuildingName').text(user.building_name);
            $('#viewBuildingNo').text(user.building_no);
            $('#viewStreet').text(user.street);
            $('#viewBarangay').text(user.barangay);
            $('#viewBusinessType').text(user.business_type);
            $('#viewRentPerMonth').text(user.rent_per_month);
            $('#viewDateofApplication').text(user.date_application);
            $('#viewapplication_number').text(user.application_number);
            $('#viewDocumentStatus').text(user.document_status);
            $('#viewExpirationDate').text(user.expiration_date); // Display expiration date

            // Enable/Show the "Released" button if status is "Pending to Released"
            if (user.document_status === 'Pending to Released') {
                $('#releaseButton').prop('disabled', false).show(); // Enable and show the button
            } else {
                $('#releaseButton').prop('disabled', true).hide(); // Disable and hide the button
            }

            // Handle image files
            const storePicture = user.store_picture_url ? '/user/assets/image/' + user.store_picture_url : 'default_store_picture.jpg';
            const foodSecurityClearance = user.food_security_clearance_url ? '/user/assets/image/' + user.food_security_clearance_url : 'default_food_security.jpg';
            const uploadDti = user.upload_dti_url ? '/user/assets/image/' + user.upload_dti_url : 'default_dti.jpg';

            $('#viewStorePicture').attr('src', storePicture);
            $('#viewFoodSecurityClearance').attr('src', foodSecurityClearance);
            $('#viewUploadDti').attr('src', uploadDti);

            // Add click events to open the image modal for viewing full size
            $('#viewStorePicture').on('click', function() {
                showImageInModal(storePicture);
            });
            $('#viewFoodSecurityClearance').on('click', function() {
                showImageInModal(foodSecurityClearance);
            });
            $('#viewUploadDti').on('click', function() {
                showImageInModal(uploadDti);
            });

            // Show the modal
            $('#viewModal').modal('show');
        });
    }

    // Function to show the image in a larger modal
    function showImageInModal(imageUrl) {
        $('#imagePreview').attr('src', imageUrl);
        $('#imageViewModal').modal('show');
    }


 // Function to update the application status (Approved or Need Correction)
    function updateApplicationStatus(status) {
        var viewId = $('#hiddendata').val(); // Get the hidden view ID

        if (!viewId || !status) {
            alert("View ID or Application Status is missing.");
            return;
        }

        $.post("registration_list_update_status.php", {
            viewid: viewId,
            application_status: status // Update only application_status
        }, function(data) {
            console.log("Response:", data);
            if (data.success) {
                $('#viewApplicationStatus').text(status); // Update application status in UI
                alert("Application status updated to " + status);
                $('#viewModal').modal('hide');
                filterData('All'); // Refresh the list

                if (status === 'Rejected') {
                    alert("Application has been rejected. Please notify the applicant.");
                } else if (status === 'Approved') {
                    $('#releaseButton').prop('disabled', false).show(); // Enable the release button
                    alert("Application has been approved. You can now release it.");
                } else if (status === 'Need Correction') {
                    alert("Application status updated to 'Need Correction'. Please notify the applicant.");
                }
            } else {
                alert("Failed to update the application status: " + data.error);
            }
        }, "json")
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            alert("AJAX request failed: " + textStatus);
        });
    }


    // Function to release the application
        function releaseApplication() {
            var viewId = $('#hiddendata').val(); // Get the hidden view ID

            if (!viewId) {
                alert("View ID is missing.");
                return;
            }

            // Disable the button to prevent multiple clicks
            $('#releaseButton').prop('disabled', true);

            // Update document_status to "Released" and set expiration_date
            $.post("registration_list_update_status.php", {
                viewid: viewId,
                document_status: 'Released' // Update document_status to "Released"
            }, function(data) {
                console.log("Response:", data);
                if (data.success) {
                    $('#viewDocumentStatus').text('Released'); // Update document status in UI
                    alert("Application has been successfully released.");
                    $('#releaseButton').hide(); // Hide the button after releasing
                    $('#viewModal').modal('hide'); // Close the modal
                    filterData('All'); // Refresh the table
                } else {
                    alert("Failed to release the application: " + data.error);
                    $('#releaseButton').prop('disabled', false); // Re-enable the button
                }
            }, "json")
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                alert("AJAX request failed: " + textStatus);
                $('#releaseButton').prop('disabled', false); // Re-enable the button
            });
        }

    $(document).on("submit", "#updateForm", function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: "registration_list_update.php",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                alert(response.message);
                $('#updateModal').modal('hide');
                filterData('All'); // Refresh the table
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            alert("AJAX Error!\nStatus: " + status + 
                "\nError: " + error + 
                "\nServer Response: " + xhr.responseText);
        }
    });
});

</script>


</body>