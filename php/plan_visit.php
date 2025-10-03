<?php
// Core files, including our user functions toolbox
require_once 'db_connect.php';
require_once 'user_functions.php';

// Check for user details in cookie for form pre-population
$user_details = [];
if (isset($_COOKIE['mcom_user_token'])) {
    $token = $_COOKIE['mcom_user_token'];
    $user_details = getUserByToken($conn, $token);
}

// --- PART 1: PHP PROCESSING LOGIC (When form is submitted) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- Find or Create User using our central function ---
    $user_id = findOrCreateUser($conn, $_POST['full_name'], $_POST['email'], $_POST['contact_number']);

    // --- Set Cookie if "Remember Me" is checked ---
    if (isset($_POST['remember_me']) && $user_id) {
        $token = bin2hex(random_bytes(32));
        $stmt = $conn->prepare("UPDATE users SET persistent_token = ? WHERE id = ?");
        $stmt->bind_param("si", $token, $user_id);
        $stmt->execute();
        setcookie('mcom_user_token', $token, time() + (86400 * 365), "/");
    }

    // --- Insert the Visit ---
    $visit_date = $_POST['visit_date'];
    $members_joining = $_POST['members_joining'] ?: 'User only';

    $stmt = $conn->prepare("INSERT INTO visiting_now (user_id, visit_date, members_joining) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $visit_date, $members_joining);
    $stmt->execute();
    
    // Redirect to a success page
    header("Location: visit_success.php");
    exit();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plan Your Visit - Manifestation City Outreach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #000000; --accent-teal: #47ab9d; --accent-teal-hover: #348b7f;
            --text-light: #ffffff; --text-dark: #272722; --text-muted: #999999;
            --bg-light: #f8f9fa; --border-color: #e0e0e0;
        }
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: var(--bg-light); color: var(--text-dark); }
        .container { width: 90%; max-width: 800px; margin: 0 auto; }
        
        /* Header Styles */
        .site-header { position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; padding: 20px 0; background-color: #000; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .header-logo img { max-height: 50px; }
        .navigation .sf-menu { display: flex; list-style: none; margin: 0; padding: 0; align-items: center; gap: 35px; }
        .navigation .sf-menu > li > a { color: var(--text-light); font-family: 'Open Sans', sans-serif; text-transform: uppercase; font-size: 0.85em; letter-spacing: 0.2em; text-decoration:none; }
        .header-button .btn { color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px; border-radius: 5px; text-decoration: none; }
        .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }

        /* Main Content Styles */
        main { padding-top: 120px; padding-bottom: 60px; }
        .form-container { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 40px; }
        h2 { font-family: 'Playfair Display', serif; font-size: 2.2em; text-align: center; margin-top: 0; margin-bottom: 30px; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 1.5em; margin-bottom: 20px; border-bottom: 2px solid var(--accent-teal); padding-bottom: 10px; }
        
        /* Form Element Styles */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"], input[type="email"], input[type="tel"], input[type="datetime-local"], textarea { 
            width:100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 5px; 
            font-size: 1em; font-family: 'Open Sans', sans-serif; box-sizing: border-box; 
        }
        textarea { min-height: 100px; }
        .submit-btn { width: 100%; padding: 15px; background-color: var(--accent-teal); color: var(--text-light); border: none; border-radius: 5px; font-size: 1.2em; font-weight: 700; cursor: pointer; margin-top: 30px; }
        .submit-btn:hover { background-color: var(--accent-teal-hover); }

        /* Footer Styles */
        .site-footer { background-color: var(--primary-dark); color: var(--text-light); padding: 20px 0; text-align: center; font-size: 0.9em; }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="container header-content">
             <a href="#" class="header-logo"><img src="https://via.placeholder.com/200x50/FFFFFF/000000?text=Your+Logo" alt="Logo"></a>
            <nav class="navigation">
                 <ul class="sf-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="donate.php">Donate</a></li>
                    <li><a href="plan_visit.php">Visit</a></li>
                </ul>
            </nav>
            <div class="header-button">
                <a href="login.php" class="btn">Log In</a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="form-container">
                <h2>Plan Your Visit</h2>
                <form action="plan_visit.php" method="post">
                    <h3 class="section-title">Your Information</h3>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($user_details['full_name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user_details['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="tel" name="contact_number" id="contact_number" value="<?php echo htmlspecialchars($user_details['contact_number'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" id="remember_me" value="1" <?php if(isset($_COOKIE['mcom_user_token'])) echo 'checked'; ?> style="width: auto; margin-right: 10px;">
                        <label for="remember_me" style="display: inline; font-weight: normal;">Remember me for next time.</label>
                    </div>

                    <h3 class="section-title">Schedule Your Visit</h3>
                    <div class="form-group">
                        <label for="visit_date">Choose Date and Time</label>
                        <small style="display: block; margin-top: -5px; margin-bottom: 10px; color: var(--text-muted);">Visits are available on Sundays.</small>
                        <input type="datetime-local" id="visit_date" name="visit_date" required>
                    </div>
                    <div class="form-group">
                        <label for="members_joining">Who is coming with you? (Optional)</label>
                        <textarea id="members_joining" name="members_joining" placeholder="e.g., my spouse and two children"></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Schedule Visit</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>© <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p>
        </div>
    </footer>

    <script>
        // New JavaScript to guide users to select a Sunday
        const visitDateInput = document.getElementById('visit_date');

        // Set the minimum date to today to prevent booking in the past
        const now = new Date();
        const year = now.getFullYear();
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const day = now.getDate().toString().padStart(2, '0');
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        visitDateInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;
        
        // Add a check when the user selects a date
        visitDateInput.addEventListener('input', function() {
            const selectedDate = new Date(this.value);
            // In JavaScript, Sunday is 0, Monday is 1, etc.
            if (selectedDate.getDay() !== 0) {
                alert('Please select a Sunday for your visit.');
                this.value = ''; // Clear the invalid date
            }
        });
    </script>
</body>
</html>