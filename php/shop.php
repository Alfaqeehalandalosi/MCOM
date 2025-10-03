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
// This entire block remains unchanged as the order processing is the same.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = findOrCreateUser($conn, $_POST['full_name'], $_POST['email'], $_POST['contact_number']);
    if (isset($_POST['remember_me']) && $user_id) {
        $token = bin2hex(random_bytes(32));
        $stmt = $conn->prepare("UPDATE users SET persistent_token = ? WHERE id = ?");
        $stmt->bind_param("si", $token, $user_id);
        $stmt->execute();
        setcookie('mcom_user_token', $token, time() + (86400 * 365), "/");
    }
    if (empty($_POST['product_ids'])) {
        header('location: shop.php?error=no_products');
        exit;
    }
    $product_ids = $_POST['product_ids'];
    $quantities = $_POST['quantities'];
    $total_amount = 0;
    $total_items = 0;
    $last_item_name = '';
    $conn->begin_transaction();
    try {
        $product_prices = [];
        $sql_prices = "SELECT id, name, price FROM products WHERE id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")";
        $stmt_prices = $conn->prepare($sql_prices);
        $stmt_prices->bind_param(str_repeat('s', count($product_ids)), ...$product_ids);
        $stmt_prices->execute();
        $result_prices = $stmt_prices->get_result();
        while($row = $result_prices->fetch_assoc()) {
            $product_prices[$row['id']] = ['price' => $row['price'], 'name' => $row['name']];
        }
        foreach ($product_ids as $index => $pid) {
            $total_amount += $product_prices[$pid]['price'] * $quantities[$index];
            $total_items += $quantities[$index];
            $last_item_name = $product_prices[$pid]['name'];
        }
        $stmt_order = $conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'Pending')");
        $stmt_order->bind_param("id", $user_id, $total_amount);
        $stmt_order->execute();
        $order_id = $stmt_order->insert_id;
        $stmt_items = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_per_item) VALUES (?, ?, ?, ?)");
        $stmt_stock = $conn->prepare("UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ?");
        foreach ($product_ids as $index => $pid) {
            $qty = $quantities[$index];
            $price = $product_prices[$pid]['price'];
            $stmt_items->bind_param("isid", $order_id, $pid, $qty, $price);
            $stmt_items->execute();
            $stmt_stock->bind_param("is", $qty, $pid);
            $stmt_stock->execute();
        }
        $update_sql = "UPDATE users SET total_item_purchased = total_item_purchased + ?, last_purchased_item = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("isi", $total_items, $last_item_name, $user_id);
        $update_stmt->execute();
        $conn->commit();
        header("location: order_success.php");
        exit;
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        header("location: shop.php?error=db_error");
        exit;
    }
}

// --- PART 2: Data Fetching for the Form ---
$categories = $conn->query("SELECT * FROM product_categories ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$products_result = $conn->query("SELECT * FROM products WHERE stock_quantity > 0 ORDER BY category_id, name ASC")->fetch_all(MYSQLI_ASSOC);
$category_descriptions = array_column($categories, 'description', 'id');
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop - Manifestation City Outreach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">

    <style>
        /* All CSS from previous version is the same */
        :root {
            --primary-dark: #000000; --accent-teal: #47ab9d; --accent-teal-hover: #348b7f;
            --text-light: #ffffff; --text-dark: #272727; --text-muted: #999999;
            --bg-light: #f8f9fa; --border-color: #e0e0e0;
        }
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: var(--bg-light); color: var(--text-dark); }
        .container { width: 90%; max-width: 800px; margin: 0 auto; }
        .site-header { position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; padding: 20px 0; background-color: #000; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .header-logo img { max-height: 50px; }
        .navigation .sf-menu { display: flex; list-style: none; margin: 0; padding: 0; align-items: center; gap: 35px; }
        .navigation .sf-menu > li > a { color: var(--text-light); font-family: 'Open Sans', sans-serif; text-transform: uppercase; font-size: 0.85em; letter-spacing: 0.2em; text-decoration:none; }
        .header-button .btn { color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px; border-radius: 5px; text-decoration: none; }
        .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }
        main { padding-top: 120px; padding-bottom: 60px; }
        .form-container { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 40px; }
        h2 { font-family: 'Playfair Display', serif; font-size: 2.2em; text-align: center; margin-top: 0; margin-bottom: 30px; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 1.5em; margin-bottom: 20px; border-bottom: 2px solid var(--accent-teal); padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        /* New styles for the right-aligned filter */
        .filter-group {
            display: flex;
            justify-content: flex-end; /* Aligns items to the right */
            align-items: center;
        }
        .filter-group label {
            margin-bottom: 0; /* Removes the space below the label */
            margin-right: 10px; /* Adds space between the label and the dropdown */
        }
        .filter-group select {
            width: auto; /* Overrides the default 100% width */
            min-width: 250px; /* Ensures the dropdown isn't too small */
        }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"], input[type="email"], input[type="tel"], select { width:100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1em; font-family: 'Open Sans', sans-serif; box-sizing: border-box; }
        .description-box { background-color: #eef7f6; border-left: 4px solid var(--accent-teal); padding: 15px; margin: 20px 0; color: #333; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px; margin-top: 20px; }
        .product-card { border: 1px solid #ddd; border-radius: 8px; text-align: center; padding: 10px; cursor: pointer; transition: box-shadow 0.2s, transform 0.2s; background-color: #fff; }
        .product-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); transform: translateY(-2px); }
        .product-card img { max-width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; }
        .product-card .product-name { font-weight: bold; font-size: 0.9em; }
        #order-summary { margin-top: 30px; padding: 20px; background-color: #f9f9f9; border-radius: 5px; border: 1px solid var(--border-color); }
        #order-summary h3 { margin-top: 0; font-family: 'Playfair Display', serif; }
        #order-summary table { width: 100%; }
        #order-summary table td { padding: 8px 4px; }
        .total-row { font-weight: bold; border-top: 2px solid #ddd; }
        .remove-from-cart-btn { background: none; border: none; color: #dc3545; font-weight: bold; cursor: pointer; }
        .submit-btn { width: 100%; padding: 15px; background-color: var(--accent-teal); color: var(--text-light); border: none; border-radius: 5px; font-size: 1.2em; font-weight: 700; cursor: pointer; margin-top: 30px; }
        .submit-btn:hover { background-color: var(--accent-teal-hover); }
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
                <h2>Our Shop</h2>
                <form id="shop-form" action="shop.php" method="post">
                    <h3 class="section-title">Your Information</h3>
                    <div class="form-group"><label for="full_name">Full Name</label><input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($user_details['full_name'] ?? ''); ?>" required></div>
                    <div class="form-group"><label for="email">Email Address</label><input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user_details['email'] ?? ''); ?>" required></div>
                    <div class="form-group"><label for="contact_number">Contact Number</label><input type="tel" name="contact_number" id="contact_number" value="<?php echo htmlspecialchars($user_details['contact_number'] ?? ''); ?>"></div>
                    <div class="form-group"><input type="checkbox" name="remember_me" id="remember_me" value="1" <?php if(isset($_COOKIE['mcom_user_token'])) echo 'checked'; ?> style="width: auto; margin-right: 10px;"><label for="remember_me" style="display: inline; font-weight: normal;">Remember me for next time.</label></div>

                    <h3 class="section-title">Select Products</h3>
                    <div class="form-group filter-group">
                        <label for="category-select">Filter by Category</label>
                        <select id="category-select">
                            <option value="">-- Show All --</option> <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="category-description"></div>

                    <div id="product-list" class="product-grid">
                        <?php foreach ($products_result as $product): ?>
                            <div class="product-card" 
                                 data-id="<?php echo htmlspecialchars($product['id']); ?>"
                                 data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                 data-price="<?php echo htmlspecialchars($product['price']); ?>"
                                 data-category-id="<?php echo htmlspecialchars($product['category_id']); ?>">
                                <img src="images/products/<?php echo htmlspecialchars($product['sku']); ?>.jpg" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                                     onerror="this.onerror=null;this.src='images/placeholder.png';">
                                <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div id="order-summary" style="display: none;">
                        <h3>Order Summary</h3>
                        <table id="cart-table"></table>
                        <div id="hidden-inputs"></div>
                    </div>
                    
                    <button type="submit" class="submit-btn">Place Order</button>
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
    // The cart logic is mostly the same, but the category filter is new.
    const categoryDescriptions = <?php echo json_encode($category_descriptions); ?>;
    let cart = []; 
    const categorySelect = document.getElementById('category-select');
    const productListDiv = document.getElementById('product-list');
    const categoryDescriptionDiv = document.getElementById('category-description');
    const orderSummaryDiv = document.getElementById('order-summary');
    const cartTable = document.getElementById('cart-table');
    const hiddenInputsDiv = document.getElementById('hidden-inputs');

    // ** CHANGE 2: Updated JavaScript for filtering **
    categorySelect.addEventListener('change', function() {
        const selectedCategoryId = this.value;
        const allProductCards = document.querySelectorAll('#product-list .product-card');

        // Show category description if a category is selected
        categoryDescriptionDiv.innerHTML = '';
        if (selectedCategoryId && categoryDescriptions[selectedCategoryId]) {
            categoryDescriptionDiv.innerHTML = `<div class="description-box">${categoryDescriptions[selectedCategoryId]}</div>`;
        }

        // Loop through all product cards and hide or show them
        allProductCards.forEach(card => {
            const cardCategoryId = card.dataset.categoryId;
            
            if (!selectedCategoryId || cardCategoryId === selectedCategoryId) {
                card.style.display = 'block'; // Show if 'Show All' is selected or if categories match
            } else {
                card.style.display = 'none'; // Hide if it doesn't match
            }
        });
    });

    // The rest of the JavaScript for adding to cart and rendering the summary is unchanged.
    productListDiv.addEventListener('click', function(e) {
        const productCard = e.target.closest('.product-card');
        if (!productCard) { return; }
        const productId = productCard.dataset.id;
        const productName = productCard.dataset.name;
        const productPrice = parseFloat(productCard.dataset.price);
        const existingItem = cart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
        }
        renderCart();
    });

    function renderCart() {
        if (cart.length === 0) {
            orderSummaryDiv.style.display = 'none';
            return;
        }
        orderSummaryDiv.style.display = 'block';
        cartTable.innerHTML = '';
        hiddenInputsDiv.innerHTML = '';
        let total = 0;
        cart.forEach((item, index) => {
            const subtotal = item.price * item.quantity;
            total += subtotal;
            const rowHTML = `<tr><td>${item.name} (x${item.quantity})</td><td>$${subtotal.toFixed(2)}</td><td><button type="button" class="remove-from-cart-btn" data-index="${index}">X</button></td></tr>`;
            cartTable.insertAdjacentHTML('beforeend', rowHTML);
            hiddenInputsDiv.insertAdjacentHTML('beforeend', `<input type="hidden" name="product_ids[]" value="${item.id}">`);
            hiddenInputsDiv.insertAdjacentHTML('beforeend', `<input type="hidden" name="quantities[]" value="${item.quantity}">`);
        });
        const totalRowHTML = `<tr class="total-row"><td>Total</td><td>$${total.toFixed(2)}</td><td></td></tr>`;
        cartTable.insertAdjacentHTML('beforeend', totalRowHTML);
    }

    orderSummaryDiv.addEventListener('click', function(e){
        if (e.target.classList.contains('remove-from-cart-btn')) {
            const itemIndex = parseInt(e.target.dataset.index);
            cart.splice(itemIndex, 1); 
            renderCart();
        }
    });
</script>

</body>
</html>