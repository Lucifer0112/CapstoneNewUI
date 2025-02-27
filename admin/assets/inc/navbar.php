<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control bg-transparent border-0 pl-4" type="search" placeholder="Type something....." aria-label="Search">
    </form>

    <ul class="nav">
        <li class="nav-item">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-message-circle fe-16"></span>
            </section>
        </li>

        <!-- 🔔 Notifications Dropdown -->
        <li class="nav-item dropdown nav-notif">
            <a class="nav-link text-muted my-2 circle-icon dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fe fe-bell fe-16"></span>
                <span id="notification-count" class="notification-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
                <ul id="notificationList" class="list-group">
                    <li class="list-group-item text-center">Loading...</li>
                </ul>
            </div>
        </li>

        <li class="nav-item dropdown">
            <span class="nav-link text-muted pr-0 avatar-icon" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <div class="avatar-img rounded-circle avatar-initials-min text-center position-relative">
                        <img src="assets/image/profile.png" style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;">
                    </div>
                </span>
            </span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="profile.php"><i class="fe fe-user"></i>&nbsp;&nbsp;&nbsp;Profile</a>
                <a class="dropdown-item" href="settings.php"><i class="fe fe-settings"></i>&nbsp;&nbsp;&nbsp;Settings</a>
                <a class="dropdown-log-out" href="/logout.php"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Log Out</a>
            </div>
        </li>
    </ul>
</nav>

<!-- 🔥 Add the Notification Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    fetchNotifications();
    setInterval(fetchNotifications, 5000); // Refresh notifications every 5 sec
});

function fetchNotifications() {
    fetch('/admin/notification/fetch_notifications.php')
        .then(response => response.json())
        .then(data => {
            let notificationContainer = document.getElementById('notificationList');
            let notificationCount = document.getElementById('notification-count');

            notificationContainer.innerHTML = '';

            if (data.length > 0) {
                notificationCount.textContent = data.length;
                notificationCount.style.display = "inline"; // Show badge

                data.forEach(notification => {
                    let item = document.createElement('li');
                    item.classList.add('list-group-item', 'notification-item');

                    let icon = "";
                    switch (notification.type) {
                        case "success":
                            icon = "✅";
                            break;
                        case "warning":
                            icon = "⚠️";
                            break;
                        case "error":
                            icon = "❌";
                            break;
                        default:
                            icon = "🔔";
                    }

                    item.innerHTML = `${icon} ${notification.message} <small class="text-muted">${notification.created_at}</small>`;

                    // Mark as read when clicked
                    item.onclick = function () {
                        markAsRead(notification.id, item);
                    };

                    if (notification.status === "unread") {
                        item.style.fontWeight = "bold";
                    }

                    notificationContainer.appendChild(item);
                });
            } else {
                notificationCount.style.display = "none"; // Hide badge
                notificationContainer.innerHTML = '<li class="list-group-item text-center">No new notifications</li>';
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

function markAsRead(notificationId, element) {
    fetch('/admin/notification/mark_as_read.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `notification_id=${notificationId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            element.style.fontWeight = "normal";
            fetchNotifications(); // Refresh list
        } else {
            console.error('Failed to mark as read');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>

<!--  Add CSS for better styling -->
<style>
.notification-badge {
    position: absolute;
    top: 8px;
    right: 10px;
    background: red;
    color: white;
    font-size: 12px;
    border-radius: 50%;
    padding: 3px 6px;
    display: none; /* Hide initially */
}
.list-group-item {
    cursor: pointer;
    transition: background 0.3s;
}
.list-group-item:hover {
    background: #f1f1f1;
}
</style>
