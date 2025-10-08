<?php
require_once 'admin_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCOM Admin Panel</title>
    <link rel="stylesheet" href="css/admin_style.css">
    
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
            <li class="nav-item"><a href="manage_donors.php" class="ajax-link">Donors</a></li>
            <li class="nav-item"><a href="manage_events.php" class="ajax-link">Events</a></li>
            <li class="nav-item"><a href="campaigns.php" class="ajax-link">Donations</a></li>
            <li class="nav-item"><a href="manage_forms.php" class="ajax-link">Forms</a></li>
            <li class="nav-item"><a href="admins_hub.php" class="ajax-link">Admins</a></li>
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
    
    // This is the simple, reliable function for loading basic pages
    function loadContent(url) {
        fetch(url)
            .then(response => {
                if (!response.ok) { throw new Error('Network response was not ok'); }
                return response.text();
            })
            .then(html => {
                mainContent.innerHTML = html;
            })
            .catch(error => { 
                mainContent.innerHTML = '<p style="color:red;">Error: Content could not be loaded. Please check the file exists and has no PHP errors.</p>'; 
                console.error('Fetch Error:', error); 
            });
    }

    // This part loads the initial page
    const urlParams = new URLSearchParams(window.location.search);
    const pageToLoad = urlParams.get('load') || 'dashboard_content.php';
    loadContent(pageToLoad);
    document.querySelectorAll('.sidebar-nav .nav-item').forEach(nav => {
        const link = nav.querySelector('a');
        nav.classList.toggle('active', link && link.getAttribute('href') === pageToLoad);
    });
    
    // This handles all link clicks
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

    // This handles all simple form submissions
    mainContent.addEventListener('submit', function(event) {
        const form = event.target;
        if (form.matches('#addUserForm, #eventForm, #editUserForm, #addNoteForm, #campaignForm, #createAdminForm, #changePasswordForm, #editAdminForm')) {
            event.preventDefault();
            const formData = new FormData(form);
            const messageDiv = document.getElementById('form-message');

            fetch(form.action, { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if(messageDiv) messageDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
                        
                        let returnPage;
                        if (form.matches('#addUserForm') || form.matches('#editUserForm')) returnPage = 'manage_users.php';
                        if (form.matches('#eventForm')) returnPage = 'manage_events.php';
                        if (form.matches('#campaignForm')) returnPage = 'campaigns.php';
                        if (form.matches('#createAdminForm') || form.matches('#editAdminForm')) returnPage = 'manage_admins.php';
                        if (form.matches('#changePasswordForm')) { form.reset(); return; }
                        if (form.matches('#addNoteForm')) {
                            const userIdInput = form.querySelector('input[name="user_id"]');
                            if(userIdInput) returnPage = `details.php?user_id=${userIdInput.value}`;
                        }
                        setTimeout(() => { if(returnPage) loadContent(returnPage); }, 1500);
                    } else {
                        if(messageDiv) messageDiv.innerHTML = `<p style="color: red;">${data.message}</p>`;
                    }
                });
        }
    });
});
</script>

</body>
</html>