<?php
// Secure this page
require_once 'admin_check.php';
require_once '../db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCOM Admin Panel</title>
    <link rel="stylesheet" href="css/admin_style.css">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2 class="logo">MCOM ADMIN</h2>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item"><a href="dashboard_content.php" class="ajax-link">Dashboard</a></li>
            <li class="nav-item"><a href="manage_users.php" class="ajax-link">Users</a></li>
            <li class="nav-item"><a href="manage_events.php" class="ajax-link">Events</a></li>
            <li class="nav-item"><a href="campaigns.php" class="ajax-link">Donations</a></li>
            <li class="nav-item"><a href="manage_forms.php" class="ajax-link">Forms</a></li>
            <li class="nav-item"><a href="admins_hub.php" class="ajax-link">Admins</a></li> </ul>
        </ul>
        <ul class="sidebar-nav account-nav">
            <li class="nav-item"><a href="../logout.php">Logout</a></li>
        </ul>
    </aside>

    <main class="main-content" id="main-content">
        </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainContent = document.getElementById('main-content');
    
    // --- DIAGNOSTIC STEP ---
    // This will tell us if the script can find the main content area.
    console.log(mainContent);

    function loadContent(url) {
        fetch(url)
            .then(response => {
                if (!response.ok) { throw new Error('Network response was not ok'); }
                return response.text();
            })
            .then(html => {
                if (mainContent) {
                    mainContent.innerHTML = html;
                } else {
                    console.error("Critical Error: The 'main-content' element was not found in the document.");
                }
            })
            .catch(error => { 
                if (mainContent) {
                    mainContent.innerHTML = '<p style="color:red;">Error: Content could not be loaded.</p>'; 
                }
                console.error('Fetch Error:', error); 
            });
    }

    // Load the default dashboard page
    loadContent('dashboard_content.php');
    document.querySelector('.sidebar-nav .nav-item a[href="dashboard_content.php"]').parentElement.classList.add('active');

    // --- The rest of the script for clicks and forms remains the same ---
    document.querySelector('.dashboard-container').addEventListener('click', function(event) {
        const link = event.target.closest('.ajax-link');
        if (link) {
            event.preventDefault();
            const confirmMessage = link.dataset.confirm;
            if (confirmMessage && !confirm(confirmMessage)) { return; }

            const url = link.getAttribute('href');
            const reloadUrl = link.dataset.reload;

            if (link.closest('.sidebar-nav')) {
                 document.querySelectorAll('.sidebar-nav .nav-item').forEach(nav => nav.classList.remove('active'));
                 link.parentElement.classList.add('active');
            }
            
            if (confirmMessage) {
                fetch(url).then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            loadContent(reloadUrl || 'manage_users.php');
                        } else { alert('Error: ' + data.message); }
                    });
            } else {
                loadContent(url);
            }
        }
    });

    // Form submission handler...
    mainContent.addEventListener('submit', function(event) {
        // ... (this part is the same as the simple script from before)
    });
});
</script>

</body>
</html>