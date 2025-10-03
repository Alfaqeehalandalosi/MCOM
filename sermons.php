<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Church Template - Cedar Crest Style</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/header.css">
    <style>
        .top-utility-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-utility-bar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .top-utility-bar a {
            color: var(--text-muted);
            text-decoration: none;
        }
        .top-utility-bar a:hover {
            color: var(--text-light);
        }
        
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
            transition: color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
        }
        
        /* --- HEADER --- */
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
        .main-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 35px;
        }
        .main-nav a {
            color: var(--text-light);
            font-family: 'Open Sans', sans-serif;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.2em;
            font-weight: 400;
            padding-bottom: 5px;
            border-bottom: 2px solid transparent;
        }
        .main-nav a:hover {
            color: var(--accent-teal);
            border-bottom-color: var(--accent-teal);
        }
        .site-header .header-button .btn {
            color: var(--text-light);
            border: 2px solid var(--text-light);
            padding: 8px 20px;
            border-radius: 5px;
            font-size: 0.85em;
            text-transform: uppercase;
            /* Add these to ensure no other styles leak in */
            background-color: transparent;
            font-weight: normal; 
        }
        .header-button .btn:hover {
            background-color: var(--text-light);
            color: var(--primary-dark);
        }

        /* --- HERO --- */
        .hero {
            background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/Feb2-11-18.jpg');
            background-size: cover;
            background-position: center;
            padding: 20vh 0;
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.25);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .hero h2 {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.15em;
            font-weight: 400;
            line-height: 1.6;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #FFFFFF !important;
            margin-bottom: 20px;
        }
        
        .hero h1 {
            font-family: 'poynter-new', 'Georgia', serif;
            font-size: 3.5em;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 0;
            text-transform: none;
            color: #FFFFFF !important;
        }
        
        /* Watch Live Section */
        .watch-live {
            padding: 6% 0;
            text-align: center;
        }
        
        .watch-live h2 {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.5em;
            font-weight: 400;
            letter-spacing: 0.2em;
            color: var(--black);
            margin-bottom: 10px;
        }
        
        .watch-live .subtitle {
            font-family: 'poynter-new', sans-serif;
            font-size: 3em;
            font-weight: 700;
            line-height: 0.85;
            letter-spacing: 0;
            text-transform: none;
            color: var(--black);
            margin-bottom: 30px;
        }
        
        .divider {
            height: 10px;
            max-height: none;
            border-left: 1px solid var(--white);
            margin: 20px auto;
            width: 1px;
        }
        
        .video-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            margin-top: 30px;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        /* Previous Messages Section */
        .previous-messages {
            background-color: rgb(251, 249, 247);
            padding: 0;
        }
        
        .messages-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }
        
        .messages-image {
            height: 400px;
            background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2022/11/AS7A1262-2-scaled.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 150px 4em 4em;
        }
        
        .messages-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(3, 3, 3, 0.5);
        }
        
        .messages-image-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        
        .messages-image h3 {
            font-family: 'poynter-new', sans-serif;
            font-size: 3em;
            font-weight: 700;
            letter-spacing: 0;
            text-transform: none;
            color: #FFFFFF !important;
        }
        
        .messages-content {
            padding: 150px 4em 4em;
            text-align: center;
        }
        
        .messages-content h2 {
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            font-weight: 400;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--black);
            margin-bottom: 30px;
        }
        
        .previous-messages .btn {
            display: inline-block;
            margin-top: 30px;
            background-color: #222222;
            color: var(--text-light);
            padding: 16px 35px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background-color: var(--primary-color);
        }

        /* --- FOOTER --- */
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
            .main-nav, .header-button { display: none; } /* Simplified for example */
            .hero-content h1 { font-size: 3em; }
            .split-section { flex-direction: column; }
            .split-section > div { width: 100%; }
            .split-section img { margin-top: 40px; }
            .welcome-section .split-section { flex-direction: column-reverse; }
            .ministries-grid { grid-template-columns: 1fr; grid-template-rows: repeat(3, 200px);}
            .ministry-card#groups { grid-row: auto; }
            .parallax-section { background-size: 80% auto; }
            .next-steps-grid { grid-template-columns: 1fr; }
        }

/* Styling for the new navigation structure */
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

/* Base styling for all dropdowns */
.navigation .dropdown {
    display: none; /* Handled by JS, but good for base */
    position: absolute;
    background-color: #222;
    padding: 15px;
    border-top: 3px solid var(--accent-teal);
    list-style: none;
    width: 220px;
}
.navigation li:hover > .dropdown {
    display: block; /* Simple CSS hover fallback */
}
.navigation .dropdown li {
    padding: 5px 0;
}
.navigation .dropdown a {
    color: #cccccc;
    font-size: 0.9em;
    text-transform: none;
    letter-spacing: normal;
}
.navigation .dropdown a:hover {
    color: var(--text-light);
}

/* Mega Menu Specifics */
.navigation .megamenu > .dropdown {
    width: 100%;
    max-width: 800px;
    left: 50%;
    transform: translateX(-50%);
}
.megamenu-container {
    display: flex;
    gap: 20px;
}
.megamenu-container > div {
    flex: 1;
}
.megamenu-sub-title {
    display: block;
    color: var(--accent-teal);
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 15px;
    font-size: 0.9em;
}
.megamenu .sub-menu {
    list-style: none;
    padding: 0;
}

.sf-menu {
    display: flex;
    gap: 35px;
}

    </style>
</head>
<body>
    <header class="site-header" id="site-header">
        <div class="container header-content">
            <a href="index.php" class="header-logo"><img src="images/logo-white.png" alt="Logo"></a>

            <nav class="navigation">
              <ul class="sf-menu">
                <li><a href="about.php">About</a></li>
                <li class="current-menu-item"><a href="connect.php">Connect</a></li>
                <li><a href="nextsteps.php">Next Steps</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="sermons.php">Sermons</a></li>
                <li><a href="impact.php">Impact</a></li>
                <li><a href="give.php">Give</a></li>
                <li class="megamenu"><a href="shortcodes.php">Mega Menu</a>
                  <ul class="dropdown">
                    <li>
                      <div class="megamenu-container container">
                        <div class="row">
                          <div class="col-md-3 hidden-sm hidden-xs"> <span class="megamenu-sub-title"><i class="fa fa-bell"></i> Today's Prayer</span>
                            <iframe width="200" height="150" src="http://player.vimeo.com/video/19564018?title=0&byline=0&color=007F7B"></iframe>
                          </div>
                          <div class="col-md-3"> <span class="megamenu-sub-title"><i class="fa fa-pagelines"></i> Our Ministries</span>
                            <ul class="sub-menu">
                              <li><a href="ministry.php">Women's Ministry</a></li>
                              <li><a href="ministry.php">Men's Ministry</a></li>
                              <li><a href="ministry.php">Children's Ministry</a></li>
                              <li><a href="ministry.php">Youth Ministry</a></li>
                              <li><a href="ministry.php">Prayer Requests</a></li>
                            </ul>
                          </div>
                          <div class="col-md-3"> <span class="megamenu-sub-title"><i class="fa fa-clock-o"></i> Upcoming Events</span>
                            <ul class="sub-menu">
                              <li><a href="single-event.php">Monday Prayer</a> <span class="meta-data">Monday | 06:00 PM</span> </li>
                              <li><a href="single-event.php">Staff members meet</a> <span class="meta-data">Tuesday | 08:00 AM</span> </li>
                              <li><a href="single-event.php">Evening Prayer</a> <span class="meta-data">Friday | 07:00 PM</span> </li>
                            </ul>
                          </div>
                          <div class="col-md-3"> <span class="megamenu-sub-title"><i class="fa fa-cog"></i> Features</span>
                            <ul class="sub-menu">
                              <li><a href="shortcodes.php">Shortcodes</a></li>
                              <li><a href="typography.php">Typography</a></li>
                              <li><a href="shop.php">Shop <span class="label label-danger">New</span></a></li>
                              <li><a href="shop-sidebar.php">Shop Sidebar <span class="label label-danger">New</span></a></li>
                              <li><a href="shop-product.php">Single Product <span class="label label-danger">New</span></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>

            <div class="header-button">
                <a href="#" class="btn">Log In</a>
            </div>
        </div>
    </header>

    <script>
        (function(){
            const header = document.getElementById('site-header');
            if(!header) return;
            window.addEventListener('scroll', function(){
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }, { passive: true });
            if (window.scrollY > 50) header.classList.add('scrolled');
        })();
    </script>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2 style="color: #FFFFFF !important;">Watch</h2>
                <h1 style="color: #FFFFFF !important;">let's come together and worship</h1>
            </div>
        </div>
    </section>

    <!-- Watch Live Section -->
    <section class="watch-live">
        <div class="container">
            <h2>Watch Live</h2>
            <div class="subtitle">sundays at 8 AM, 9:30 AM, and 11 AM</div>
            <div class="divider"></div>
            <div class="video-container">
                <iframe allow="autoplay; fullscreen" allowfullscreen="true" src="https://control.resi.io/webplayer/video.php?id=0d64add9-1c08-406a-8709-277e57f59c59"></iframe>
            </div>
        </div>
    </section>

    <!-- Previous Messages Section -->
    <section class="previous-messages" id="messages">
        <div class="messages-grid">
            <div class="messages-image">
                <div class="messages-image-content">
                    <h3 style="color: #FFFFFF !important;">looking for a previous message?</h3>
                </div>
            </div>
            <div class="messages-content">
                <h2>Watch or listen to some of our Previous Messages</h2>
                <div class="divider"></div>
                <a href="sermon-archive copy.php" class="btn">previous messages</a>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="footer-main">
            <div class="container footer-grid">
                <div class="footer-col">
                    <h4 class="footer-widget-title">About our Church</h4>
                    <img src="images/logo-white.png" alt="Logo" style="max-width: 200px; margin-bottom: 20px;">
                    <p>OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA</p>
                </div>
                <div class="footer-col">
                    <h4>Blogroll</h4>
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
                <img src="images/logo-white.png" alt="Footer Logo">
                <div class="line"></div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-copyright">
                    <p>&copy; <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p>
                </div>
                <div class="footer-social">
                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-rss"></i></a>
                </div>
            </div>
        </div>
    </footer>
        <script src="js/header-loader.js"></script>
    </body>
    </html>