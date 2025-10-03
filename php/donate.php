<?php
// Core files, now including our user functions toolbox
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
        $stmt->close();
        // Set cookie for 1 year
        setcookie('mcom_user_token', $token, time() + (86400 * 365), "/"); 
    }

    // --- Process Donations (This logic remains the same as it's specific to donations) ---
    $campaign_ids = $_POST['campaign_id'];
    $amounts = $_POST['amount'];
    $payment_method_id = $_POST['payment_method_id'];

    $donations_to_process = [];
    $total_donation_amount = 0;

    foreach ($campaign_ids as $index => $campaign_id) {
        $amount = floatval($amounts[$index]);
        if (!empty($campaign_id) && $amount > 0) {
            $donations_to_process[] = ['campaign_id' => $campaign_id, 'amount' => $amount];
            $total_donation_amount += $amount;
        }
    }

    if (empty($donations_to_process)) {
        header('location: donate.php?error=no_amount');
        exit;
    }

    $transaction_group_id = 'txn_' . uniqid();
    $conn->begin_transaction();
    try {
        $sql = "INSERT INTO donations (user_id, campaign_id, amount, payment_method_id, transaction_group_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        foreach ($donations_to_process as $donation) {
            $stmt->bind_param("isdis", $user_id, $donation['campaign_id'], $donation['amount'], $payment_method_id, $transaction_group_id);
            $stmt->execute();
        }
        
        // UPDATE USER SUMMARY COLUMNS
        $update_sql = "UPDATE users SET total_donation = total_donation + ?, last_donation = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ddi", $total_donation_amount, $total_donation_amount, $user_id);
        $update_stmt->execute();

        $conn->commit();
        header("location: donation_success.php");
        exit;

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        header("location: donate.php?error=db_error");
        exit;
    }
}

// --- PART 2: Data Fetching for the Form ---
$campaigns = $conn->query("SELECT id, name FROM donation_campaigns WHERE status = 'Active' ORDER BY name")->fetch_all(MYSQLI_ASSOC);
$payment_methods = $conn->query("SELECT id, name FROM payment_methods ORDER BY name")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Donation - Manifestation City Outreach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #000000; --accent-teal: #47ab9d; --accent-teal-hover: #348b7f;
            --text-light: #ffffff; --text-dark: #272727; --text-muted: #999999;
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
        input[type="text"], input[type="email"], input[type="tel"], input[type="number"], select { 
            width:100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 5px; 
            font-size: 1em; font-family: 'Open Sans', sans-serif; box-sizing: border-box; 
        }
        .donation-row { display: flex; gap: 15px; align-items: flex-end; margin-bottom: 15px; }
        .donation-row .campaign-col { flex-grow: 1; }
        .remove-btn, #add-donation-btn { 
            padding: 12px; color: white; border: none; border-radius: 5px; cursor: pointer;
            font-size: 1em; line-height: 1;
        }
        .remove-btn { background-color: #dc3545; }
        #add-donation-btn { background-color: #007bff; display: inline-block; margin-top: 10px; }
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
                <h2>Make a Donation</h2>
                <form action="donate.php" method="post">
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

                    <h3 class="section-title">Support Our Causes</h3>
                    <div id="donation-container"></div>
                    <button type="button" id="add-donation-btn">+ Add Cause</button>

                    <h3 class="section-title" style="margin-top: 30px;">Payment</h3>
                    <div class="form-group">
                      <label for="payment_method_id">Payment Method</label>
                      <select name="payment_method_id" id="payment_method_id" required>
                        <option value="">-- Select a Method --</option>
                        <?php foreach ($payment_methods as $method): ?>
                          <option value="<?php echo $method['id']; ?>"><?php echo htmlspecialchars($method['name']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Donation</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>© <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p>
        </div>
    </footer>

    <template id="donation-row-template">
        <div class="donation-row">
            <div class="campaign-col">
                <label>Campaign</label>
                <select name="campaign_id[]" required>
                    <option value="">-- Select a Campaign --</option>
                    <?php foreach ($campaigns as $campaign): ?>
                      <option value="<?php echo htmlspecialchars($campaign['id']); ?>"><?php echo htmlspecialchars($campaign['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Amount ($)</label>
                <input type="number" name="amount[]" min="1.00" step="0.01" required placeholder="0.00">
            </div>
            <button type="button" class="remove-btn" onclick="this.parentElement.remove();" title="Remove Cause">X</button>
        </div>
    </template>

    <script>
        // This JavaScript is the same as before and works with the new design
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-donation-btn');
            const container = document.getElementById('donation-container');
            const template = document.getElementById('donation-row-template');

            function addDonationRow() {
                const newRow = template.content.cloneNode(true);
                container.appendChild(newRow);
            }
            addDonationRow(); // Add the first row on page load
            addBtn.addEventListener('click', addDonationRow);
        });
    </script>
</body>
</html>