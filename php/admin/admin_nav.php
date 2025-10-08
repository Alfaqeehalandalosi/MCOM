<style>
    /* Main navigation container */
    .admin-nav {
        display: flex; /* Aligns items in a row */
        align-items: center; /* Vertically centers the items */
        background-color: #333;
        padding: 5px 10px;
        border-radius: 5px;
        flex-wrap: wrap; /* Allows items to wrap on smaller screens if needed */
    }

    /* Styles for all navigation links */
    .admin-nav a {
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.2s ease-in-out;
    }

    /* Hover effect for links */
    .admin-nav a:hover {
        background-color: #555;
    }

    /* Special style for the logout link */
    .admin-nav .logout-link {
        margin-left: auto; /* Pushes the link to the far right */
    }
</style>

<nav class="admin-nav">
    <a href="admin_panel.php">Admin Panel</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="overview_campaigns.php">Campaign Overview</a>
    <a href="campaigns.php">Manage Campaigns</a>
    <a href="overview_events.php">Events Overview</a>
    <a href="manage_events.php">Manage Events</a>
    <a href="manage_forms.php">Manage Forms</a>
    <a href="../logout.php" class="logout-link">Logout</a>
</nav>