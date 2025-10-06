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
            --primary-dark: #000000;
            --accent-teal: #47ab9d;
            --accent-teal-hover: #348b7f;
            --text-light: #ffffff;
            --text-dark: #272727;
            --text-muted: #999999;
            --bg-light: #f8f9fa;
            --border-color: #e0e0e0;
        }

        /* --- GLOBAL & RESET STYLES --- */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Lato', sans-serif;
            background-color: var(--text-light);
            color: var(--text-dark);
            scroll-behavior: smooth;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        a {
            text-decoration: none;
            transition: color 0.3s ease, border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            color: inherit;
        }
        
        /* Custom Font for Hero Title */
        @font-face {
            font-family: "poynter-new";
            src: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/PoynterText-Bold_new.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        /* --- HEADER STYLES from Manifestation Template --- */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            background-color: transparent;
            transition: background-color 0.4s ease, padding 0.4s ease;
        }
        .site-header.scrolled {
            background-color: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(5px);
            padding: 10px 0;
            border-bottom: 1px solid #333;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-logo img {
            max-height: 50px;
            transition: max-height 0.4s ease;
        }
        .site-header.scrolled .header-logo img {
            max-height: 40px;
        }
        .navigation {
            position: relative;
        }
        .navigation .sf-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
            gap: 35px;
        }
        .site-header .navigation .sf-menu > li > a {
            color: var(--text-light);
            font-family: 'Open Sans', sans-serif;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.2em;
            font-weight: 400;
            padding-bottom: 5px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .site-header .navigation .sf-menu > li > a:hover {
            color: var(--accent-teal);
            border-bottom-color: var(--accent-teal);
        }
        .navigation ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        .navigation li {
            position: relative;
        }
        .navigation .dropdown { display: none; position: absolute; background-color: #222; padding: 15px; border-top: 3px solid var(--accent-teal); list-style: none; width: 220px; z-index: 1001; }
        .navigation li:hover > .dropdown { display: block; }
        .navigation .dropdown li { padding: 5px 0; }
        .navigation .dropdown a { color: #cccccc; font-size: 0.9em; text-transform: none; letter-spacing: normal; }
        .navigation .dropdown a:hover { color: var(--text-light); }
        .navigation .dropdown .dropdown { top: 0; left: 100%; } /* For nested dropdowns */
        .navigation .megamenu > .dropdown { width: 100%; max-width: 800px; left: 50%; transform: translateX(-50%); }
        .megamenu-container { display: flex; gap: 20px; }
        .megamenu-container > div { flex: 1; }
        .megamenu-sub-title { display: block; color: var(--accent-teal); font-weight: 700; text-transform: uppercase; margin-bottom: 15px; font-size: 0.9em; }
        .megamenu .sub-menu { list-style: none; padding: 0; }
        .header-button .btn { color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px; border-radius: 5px; font-size: 0.85em; text-transform: uppercase; background-color: transparent; font-weight: normal; }
        .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }
        
        /* --- HERO SECTION for Events Page --- */
        .hero-section {
            padding-top: 25vh; /* More padding to account for fixed header */
            padding-bottom: 20vh;
            text-align: center;
            position: relative;
            background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/events-header_1920x1080.jpg');
            background-size: cover;
            background-position: center center;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.25);
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .hero-title {
            font-family: 'poynter-new', serif;
            font-size: 3.5em;
            color: #fff;
            margin-top: 0.25em;
        }
        
        /* --- MAIN CONTENT: Hard-coded Event List --- */
        .content-section {
            padding: 10vh 0;
        }
        .event-list-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        .event-list-item {
            display: flex;
            flex-direction: column; 
            gap: 20px;
        }
        @media (min-width: 768px) {
            .event-list-item {
                flex-direction: row; 
                gap: 30px;
                align-items: flex-start;
            }
        }
        .event-image-wrap {
            position: relative;
            flex-shrink: 0;
            width: 100%;
        }
        @media (min-width: 768px) {
            .event-image-wrap {
                width: 320px; 
            }
        }
        .event-image {
            padding-top: 56.25%; 
            background-color: #ccc; 
            border-radius: 3px;
            background-size: cover;
            background-position: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .date-overlay {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border-radius: 3px;
            text-align: center;
            font-weight: 700;
            line-height: 1.1;
            width: 60px;
            overflow: hidden;
        }
        .date-overlay-month {
            background-color: #333;
            padding: 4px;
            font-size: 0.8em;
            text-transform: uppercase;
        }
        .date-overlay-date {
            padding: 8px 4px;
            font-size: 1.8em;
        }
        .event-text-wrap {
            flex-grow: 1;
        }
        .event-title {
            /* FONT UPDATED AS REQUESTED */
            font-family: 'Playfair Display', serif;
            font-size: 1.8em;
            margin: 0 0 5px 0;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.2;
        }
        .event-subtitle {
            /* FONT UPDATED AS REQUESTED */
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            color: #777;
            margin: 0 0 15px 0;
        }
        .event-summary {
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            line-height: 1.7;
            color: var(--text-muted);
            margin: 0;
        }
        
        /* --- FOOTER STYLES from Manifestation Template --- */
        .site-footer {
            color: var(--text-light);
        }
        .footer-main {
            background-color: var(--primary-dark);
            padding: 80px 0;
            border-top: 1px solid #333;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        .footer-col h4 {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 1em;
            margin-bottom: 20px;
        }
        .footer-col p, .footer-col a {
            color: var(--text-muted);
            font-size: 0.9em;
            line-height: 1.6;
        }
        .footer-col a:hover { color: var(--text-light); }
        .footer-col ul { list-style: none; padding: 0; margin: 0;}
        .footer-col ul li { margin-bottom: 10px; }
        .footer-bar {
            background-color: var(--primary-dark);
            padding: 20px 0;
            box-shadow: 0 -3px 25px rgba(0,0,0,0.15);
        }
        .footer-bar .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .footer-bar img { max-height: 40px; margin: 0 30px;}
        .footer-bar .line {
            height: 1px;
            flex-grow: 1;
            background-color: #333;
        }
        .footer-bottom {
            background-color: var(--primary-dark);
            padding: 20px 0;
            font-size: 0.8em;
        }
        .footer-bottom .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .footer-social a {
            color: var(--text-muted);
            margin-left: 15px;
        }
        .footer-social a:hover { color: var(--text-light); }

        /* Responsive */
        @media (max-width: 992px) {
            .navigation, .header-button { display: none; } /* Mobile menu would need to be implemented separately */
            .hero-title { font-size: 2.5em; }
        }

    </style>
</head>
<body>

    <header class="site-header" id="site-header">
        <div class="container header-content">
            <a href="#" class="header-logo"><img src="https://via.placeholder.com/200x50/FFFFFF/000000?text=Your+Logo" alt="Logo"></a>
            <nav class="navigation">
              <ul class="sf-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li> 
                <li><a href="events-fixed.php">Events</a>
                  <ul class="dropdown">
                    <li><a href="events-timeline.php">Events Timeline</a></li>
                    <li><a href="google-calendar.php">Google Calender</a></li>
                    <li><a href="events-calendar.php">Events Calender</a></li>
                  </ul>
                </li>
                <li><a href="sermons.php">Sermons</a></li>
                <li><a href="gallery-2cols-pagination.html">Gallery</a>
                  <ul class="dropdown">
                    <li><a href="gallery-2cols-pagination.html">With Pagination</a>
                        <ul class="dropdown">
                            <li><a href="gallery-2cols-pagination.html">2 Columns</a></li>
                            <li><a href="gallery-3cols-pagination.html">3 Columns</a></li>
                        </ul>
                    </li>
                    <li><a href="gallery-2cols-filter.php">With Filter</a>
                        <ul class="dropdown">
                            <li><a href="gallery-2cols-filter.php">2 Columns</a></li>
                            <li><a href="gallery-3cols-filter.php">3 Columns</a></li>
                        </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="blog-masonry.php">Blog</a>
                  <ul class="dropdown">
                    <li><a href="blog-masonry.php">Masonry Blog</a></li>
                    <li><a href="blog-full-width.php">Full Width Blog</a></li>
                  </ul>
                </li>
                <li><a href="causes.php">Causes</a></li>
              </ul>
            </nav>
            <div class="header-button">
                <a href="#" class="btn">Log In</a>
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

                    <a href="php/event_details.php?id=<?php echo $event['id']; ?>" class="event-list-item">
                        <div class="event-image-wrap">
                            <div class="event-image" style="background-image: url('https://images.subsplash.com/image.jpg?id=8f19b6aa-08c7-4ddb-b013-387c3c5a4016&w=400&h=225');"></div>
                            <div class="date-overlay">
                                <div class="date-overlay-month">Sep</div>
                                <div class="date-overlay-date">28</div>
                            </div>
                        </div>
                        <div class="event-text-wrap">
                            <h2 class="event-title">Baptism Sunday</h2>
                            <h3 class="event-subtitle">September 28, 2025 from 8:00am - 12:00pm</h3>
                            <p class="event-summary">Go public with your faith in Jesus through believer's baptism! Every 4th Sunday of the month.</p>
                        </div>
                    </a>

                    <a href="php/event_details.php?id=<?php echo $event['id']; ?>" class="event-list-item">
                        <div class="event-image-wrap">
                            <div class="event-image" style="background-image: url('https://images.subsplash.com/image.jpg?id=58b1ab4d-bbe4-4935-8a42-8d86c0823071&w=400&h=225');"></div>
                            <div class="date-overlay">
                                <div class="date-overlay-month">Oct</div>
                                <div class="date-overlay-date">5</div>
                            </div>
                        </div>
                        <div class="event-text-wrap">
                            <h2 class="event-title">Growth Track</h2>
                            <h3 class="event-subtitle">October 5, 9:30am - October 19, 2025 10:30am</h3>
                            <p class="event-summary">Growth Track at our church is an opportunity to help you discover your purpose. With three steps, Growth Track invites you in Step 1 to learn our vision and values, Step 2 to discover your design, and Step 3 to join a serve team.</p>
                        </div>
                    </a>

                    <a href="php/event_details.php?id=<?php echo $event['id']; ?>" class="event-list-item">
                        <div class="event-image-wrap">
                            <div class="event-image" style="background-image: url('https://images.subsplash.com/image.jpg?id=b20cfadc-6bb3-4db6-8f7a-e8a303c54ace&w=400&h=225');"></div>
                            <div class="date-overlay">
                                <div class="date-overlay-month">Oct</div>
                                <div class="date-overlay-date">17</div>
                            </div>
                        </div>
                        <div class="event-text-wrap">
                            <h2 class="event-title">Gather Weekend</h2>
                            <h3 class="event-subtitle">October 17, 6:30pm - October 18, 2025 2:00pm</h3>
                            <p class="event-summary">The women of our church are gathering! This weekend will be full of worship, prayer, delicious food, and intentional connection! Your admission price includes admission for two days, dessert party, lunch on Saturday, a swag bag, and more.</p>
                        </div>
                    </a>

                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="footer-main">
            <div class="container footer-grid">
                <div class="footer-col">
                    <h4 class="footer-widget-title">About our Church</h4>
                    <img src="https://via.placeholder.com/200x50/FFFFFF/000000?text=Your+Logo" alt="Logo" style="max-width: 200px; margin-bottom: 20px;">
                    <p>OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA</p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Church Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="events.php">All Events</a></li>
                        <li><a href="sermons.php">Sermons Archive</a></li>
                        <li><a href="blog-masonry.php">Our Blog</a></li>
                    </ul>
                </div>
                 <div class="footer-col">
                    <h4>Our Church on Twitter</h4>
                    <p>Follow us on Twitter for the latest updates and inspiration.</p>
                    <a href="#">@YourTwitterHandle</a>
                </div>
            </div>
        </div>
        <div class="footer-bar">
            <div class="container">
                <div class="line"></div>
                <img src="https://via.placeholder.com/150x40/FFFFFF/000000?text=Logo" alt="Footer Logo">
                <div class="line"></div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-copyright">
                    <p>© <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p>
                </div>
                <div class="footer-social">
                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple script to handle header style change on scroll
        const header = document.getElementById('site-header');
        window.onscroll = function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
    </script>
</body>
</html> 