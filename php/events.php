<?php
// Core files
require_once 'db_connect.php';

// Fetch all upcoming events from the database
$stmt = $conn->prepare("SELECT id, title, description, event_date, location, image_path FROM events WHERE status = 'Upcoming' AND event_date >= NOW() ORDER BY event_date ASC");
$stmt->execute();
$result = $stmt->get_result();
$events = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Events - Manifestation City Outreach</title>
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
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: var(--text-light); color: var(--text-dark); scroll-behavior: smooth; }
        .container { width: 90%; max-width: 1200px; margin: 0 auto; }
        a { text-decoration: none; transition: color 0.3s ease; color: inherit; }
        @font-face { font-family: "poynter-new"; src: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/PoynterText-Bold_new.woff2') format('woff2'); font-weight: 700; font-style: normal; }
        .site-header { position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; padding: 20px 0; background-color: transparent; transition: background-color 0.4s ease, padding 0.4s ease; }
        .site-header.scrolled { background-color: rgba(0, 0, 0, 0.9); backdrop-filter: blur(5px); padding: 10px 0; border-bottom: 1px solid #333; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .header-logo img { max-height: 50px; transition: max-height 0.4s ease; }
        .site-header.scrolled .header-logo img { max-height: 40px; }
        .navigation .sf-menu { display: flex; list-style: none; margin: 0; padding: 0; align-items: center; gap: 35px; }
        .site-header .navigation .sf-menu > li > a { color: var(--text-light); font-family: 'Open Sans', sans-serif; text-transform: uppercase; font-size: 0.85em; letter-spacing: 0.2em; }
        .header-button .btn { color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px; border-radius: 5px; text-decoration:none; }
        .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }
        .hero-section { padding-top: 25vh; padding-bottom: 20vh; text-align: center; position: relative; background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/events-header_1920x1080.jpg'); background-size: cover; background-position: center center; }
        .hero-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.25); }
        .hero-content { position: relative; z-index: 2; }
        .hero-title { font-family: 'poynter-new', serif; font-size: 3.5em; color: #fff; margin-top: 0.25em; }
        .content-section { padding: 10vh 0; }
        .event-list-container { display: flex; flex-direction: column; gap: 40px; }
        .event-list-item { display: flex; flex-direction: column; gap: 20px; }
        @media (min-width: 768px) { .event-list-item { flex-direction: row; gap: 30px; align-items: flex-start; } }
        .event-image-wrap { position: relative; flex-shrink: 0; width: 100%; }
        @media (min-width: 768px) { .event-image-wrap { width: 320px; } }
        .event-image { padding-top: 56.25%; background-color: #ccc; border-radius: 3px; background-size: cover; background-position: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .date-overlay { position: absolute; top: 12px; left: 12px; background-color: rgba(0, 0, 0, 0.6); color: white; border-radius: 3px; text-align: center; font-weight: 700; line-height: 1.1; width: 60px; overflow: hidden; }
        .date-overlay-month { background-color: #333; padding: 4px; font-size: 0.8em; text-transform: uppercase; }
        .date-overlay-date { padding: 8px 4px; font-size: 1.8em; }
        .event-text-wrap { flex-grow: 1; }
        .event-title { font-family: 'Playfair Display', serif; font-size: 1.8em; margin: 0 0 5px 0; font-weight: 900; color: var(--text-dark); }
        .event-subtitle { font-family: 'Open Sans', sans-serif; font-size: 1em; color: #777; margin: 0 0 15px 0; }
        .event-summary { font-family: 'Open Sans', sans-serif; font-size: 1em; line-height: 1.7; color: var(--text-muted); margin: 0; }
        .no-events { text-align: center; padding: 50px; background-color: var(--bg-light); border-radius: 8px; }
        .no-events h2 { font-family: 'Playfair Display', serif; }
        .site-footer { color: var(--text-light); }
        .footer-main { background-color: var(--primary-dark); padding: 80px 0; border-top: 1px solid #333; }
        .footer-bottom { background-color: var(--primary-dark); padding: 20px 0; font-size: 0.8em; text-align: center; }
    </style>
</head>
<body>
    <header class="site-header" id="site-header">
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
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <h1 class="hero-title">Upcoming Events</h1>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="event-list-container">
                <?php if (empty($events)): ?>
                    <div class="no-events">
                        <h2>No Upcoming Events</h2>
                        <p>Please check back soon for our next event!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                    <a href="event_details.php?id=<?php echo $event['id']; ?>" class="event-list-item">
                        <div class="event-image-wrap">
                            <div class="event-image" style="background-image: url('<?php echo htmlspecialchars($event['image_path']); ?>');"></div>
                            <div class="date-overlay">
                                <div class="date-overlay-month"><?php echo date('M', strtotime($event['event_date'])); ?></div>
                                <div class="date-overlay-date"><?php echo date('d', strtotime($event['event_date'])); ?></div>
                            </div>
                        </div>
                        <div class="event-text-wrap">
                            <h2 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h2>
                            <h3 class="event-subtitle"><?php echo date('l, F j, Y \a\t g:i A', strtotime($event['event_date'])); ?> &bull; <?php echo htmlspecialchars($event['location']); ?></h3>
                            <p class="event-summary"><?php echo htmlspecialchars($event['description']); ?></p>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="site-footer">
        <div class="footer-bottom">
             <p>© <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p>
        </div>
    </footer>

    <script>
        const header = document.getElementById('site-header');
        window.onscroll = function() {
            if (window.scrollY > 50) { header.classList.add('scrolled'); } 
            else { header.classList.remove('scrolled'); }
        };
    </script>
</body>
</html>