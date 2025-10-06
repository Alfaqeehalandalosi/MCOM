<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give - Manifestation Outreach</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'poynter-new';
            src: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/PoynterText-Bold_new.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        /* UPDATED COLOR PALETTE */
        :root {
            --bg-light: #F8F7F3;
            --accent-teal: #027368;
            --text-light: #FFFFFF;
            --text-muted: #8C8C8C;
            --primary-dark: #262626;
            --border-color: #E0E0E0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            font-family: 'Lato', sans-serif;
            background-color: var(--bg-light); /* Use light background */
            color: var(--primary-dark);
            scroll-behavior: smooth;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        a { text-decoration: none; transition: all 0.3s ease; }

        /* --- Header styles (Unchanged) --- */
        .site-header {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
            padding: 20px 0; background-color: transparent;
            transition: background-color 0.4s ease, padding 0.4s ease;
        }
        .site-header.scrolled {
            background-color: rgba(38, 38, 38, 0.9); backdrop-filter: blur(5px);
            padding: 10px 0; border-bottom: 1px solid #333;
        }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .header-logo img { max-height: 50px; transition: max-height 0.4s ease; }
        .site-header.scrolled .header-logo img { max-height: 40px; }
        .navigation .sf-menu { list-style: none; margin: 0; padding: 0; display: flex; gap: 35px; }
        .navigation .sf-menu > li > a {
            color: var(--text-light); font-family: 'Open Sans', sans-serif; text-transform: uppercase;
            font-size: 0.85em; letter-spacing: 0.2em; font-weight: 400; padding-bottom: 5px;
            border-bottom: 2px solid transparent;
        }
        .navigation .sf-menu > li > a:hover, .navigation .sf-menu > li > a.active {
            color: var(--accent-teal); border-bottom-color: var(--accent-teal);
        }
        .header-button .btn {
            color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px;
            border-radius: 5px; font-size: 0.85em; text-transform: uppercase;
        }
        .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }
        
        
        /* --- Styles for Give Page Content --- */
        .page-section { padding: 5rem 0; }
        
        /* FIX: REMOVED PADDING-TOP FROM MAIN */
        main { position: relative; }

        .hero-section { 
            position: relative; 
            /* FIX: ADDED PADDING TO TOP TO PUSH CONTENT DOWN */
            padding: calc(20vh + 90px) 0 20vh 0;
            text-align: center; 
        }
        .hero-bg-layer { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('https://cedarcrestchurch.com/wp-content/uploads/2024/07/ccphotos616-1519.jpg') no-repeat center bottom/cover; }
        .hero-overlay-layer { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(38, 38, 38, 0.25); }
        .hero-content { position: relative; }
        .hero-title { font-family: 'poynter-new', serif; font-size: 3.5em; font-weight: 700; color: var(--text-light); line-height: 1; }
        
        .section-light { background-color: var(--bg-light); }
        .section-dark { background-color: var(--primary-dark); color: var(--text-light); }
        .section-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: flex-start; }
        .grid-col img { width: 100%; border-radius: 5px; }
        
        .headline-group .pre-title { font-size: 1em; color: var(--text-muted); font-weight: 400; margin-bottom: 0.35em; }
        .headline-group .main-title { font-family: 'poynter-new', serif; font-size: 3em; line-height: 1.1; margin-bottom: 0.5em; color: var(--primary-dark); }
        .content-text { line-height: 1.7; margin-top: 1.5em; color: var(--text-muted); }
        .btn {
            display: inline-block; padding: 0.855em 1.05em; font-family: 'Open Sans', sans-serif;
            font-size: 1em; font-weight: 400; letter-spacing: 0.25em; text-transform: uppercase;
            border-radius: 5px; margin-top: 1em;
            background-color: var(--primary-dark); color: var(--text-light);
        }
        .btn:hover { background-color: var(--accent-teal); transform: translateY(-2px); }
        hr.divider { border: 0; height: 1px; background-color: var(--border-color); margin: 1.5em 0; }

        .ways-to-give-intro { text-align: center; max-width: 900px; margin: 0 auto; }
        .ways-to-give-intro .pre-title { color: var(--text-muted); }
        .ways-to-give-intro .main-title { font-family: 'poynter-new', serif; font-size: 3em; color: var(--text-light); }
        .cards-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px; margin-top: 3em; }
        .card { text-align: center; }
        .card .icon { font-size: 4em; color: var(--accent-teal); margin-bottom: 0.5em; }
        .card h4 { font-family: 'Open Sans', sans-serif; font-size: 1.15em; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-light); }
        .card p { font-size: 1em; line-height: 1.4; color: var(--text-muted); margin-top: 0.5em; } /* Text color changed to muted */
        .card p a { color: var(--text-light); border-bottom: 1px dotted var(--accent-teal); }
        .card p a:hover { color: var(--accent-teal); }

        /* --- START: RECREATED FOOTER STYLES --- */
        .x-colophon {
            background-color: var(--primary-dark);
            color: var(--text-muted);
        }
        .x-colophon .x-bar-top-content {
            padding: 80px 0;
            border-top: 1px solid #333;
        }
        .x-colophon .footer-row-inner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
        }
        .x-colophon .footer-col h4 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 1em;
            margin-bottom: 20px;
            color: var(--text-light);
            letter-spacing: 0.1em;
        }
        .x-colophon .footer-col p, .x-colophon .footer-col a {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-muted);
            line-height: 1.6;
            text-decoration: none;
            font-size: 0.9em;
        }
        .x-colophon .footer-col a:hover {
            color: var(--accent-teal);
        }
        .x-colophon .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .x-colophon .footer-col ul li {
            margin-bottom: 10px;
        }
        .x-colophon .x-bar-middle-logo {
            padding: 20px 0;
            box-shadow: 0 3px 25px rgba(0, 0, 0, 0.15);
        }
        .x-colophon .footer-bar-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .x-colophon .footer-bar-content .x-line {
            height: 1px;
            flex-grow: 1;
            background-color: #333;
        }
        .x-colophon .footer-bar-content img {
            max-height: 40px;
            margin: 0 30px;
        }
        .x-colophon .x-bar-bottom-bar {
            padding: 20px 0;
        }
        .x-colophon .footer-bottom-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .x-colophon .footer-bottom-container p, .x-colophon .footer-bottom-container a {
             font-family: 'Open Sans', sans-serif;
             font-size: 0.8em;
             text-transform: uppercase;
             letter-spacing: 0.1em;
             color: var(--text-muted);
             text-decoration: none;
        }
        .x-colophon .footer-social-links a {
             margin-left: 1.2em;
        }
        .x-colophon .footer-social-links a:hover {
            color: var(--accent-teal);
        }
        /* --- END: RECREATED FOOTER STYLES --- */
        
        /* Responsive */
        @media (max-width: 992px) {
            .navigation, .header-button { display: none; }
            .section-grid { grid-template-columns: 1fr; }
            .cards-grid { grid-template-columns: 1fr 1fr; }
            .hero-title, .ways-to-give-intro h3, .headline-group .main-title { font-size: 2.2em; }
            .footer-row-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 767px) {
            .cards-grid { grid-template-columns: 1fr; }
            .footer-row-inner { grid-template-columns: 1fr; }
            .footer-bottom-container { justify-content: center; }
        }
    </style>
</head>
<body>
    <header class="site-header" id="site-header">
        <div class="container header-content">
          <a href="index.html" class="header-logo"><img src="images/logo-white.png" alt="Logo"></a>
          <nav class="navigation">
            <ul class="sf-menu">
              <li><a href="about.html">About</a></li>
              <li><a href="connect.html">Connect</a></li>
              <li><a href="nextsteps.html">Next Steps</a></li>
              <li><a href="events.html">Events</a></li>
              <li><a href="sermons.html">Sermons</a></li>
              <li><a href="impact.html">Impact</a></li>
              <li><a href="give.html" class="active">Give</a></li>
            </ul>
          </nav>
          <div class="header-button">
            <a href="#" class="btn">Log In</a>
          </div>
        </div>
      </header>

    <main>
        <section class="hero-section">
            <div class="hero-bg-layer"></div>
            <div class="hero-overlay-layer"></div>
            <div class="hero-content container">
                <h1 class="hero-title">we worship God through our giving</h1>
            </div>
        </section>

        <section class="page-section section-light">
            <div class="container section-grid">
                <div class="grid-col">
                    <div class="headline-group">
                        <h2 class="pre-title">Why We Give</h2>
                        <h3 class="main-title">why is it important that we give?</h3>
                    </div>
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2024/07/ccphotos616-1519.jpg" alt="Worship service with hands raised">
                    <div class="content-text">
                        <p>At Manifestation, it is our desire to serve our community and the Nations by sharing the life-changing message of hope and truth in Jesus. We see giving as another way we can worship God, by generously and joyfully giving toward the ministry and mission he has called us to together.</p>
                    </div>
                </div>
                <div class="grid-col">
                    <div class="headline-group" style="margin-top: 2.3em;">
                         <h3 class="main-title">give securely online with stripe</h3>
                    </div>
                     <hr class="divider">
                     <a href="#" class="btn" target="_blank" rel="noopener noreferrer">Give With Stripe</a>
                </div>
            </div>
        </section>

        <section class="page-section section-dark">
            <div class="container">
                <div class="ways-to-give-intro">
                    <h2 class="pre-title">Ways to Give</h2>
                    <h3 class="main-title">we have multiple safe ways for you to give.</h3>
                </div>

                <div class="cards-grid">
                    <div class="card">
                        <div class="icon"><i class="fa fa-desktop"></i></div>
                        <h4>Give Online</h4>
                        <p>Using our safe, secure online giving platform, you can feel safe about your gift.</p>
                    </div>
                    <div class="card">
                        <div class="icon"><i class="fa fa-envelope"></i></div>
                        <h4>Give By Mail</h4>
                        <p><a href="#">Manifestation Church<br>4600 Cobb Pkwy NW<br>Acworth, GA 30101</a></p>
                    </div>
                    <div class="card">
                        <div class="icon"><i class="fa fa-apple"></i></div>
                        <h4>Give via App</h4>
                        <p>Download the Manifestation Church App in the Apple App Store or Google Play Store.</p>
                    </div>
                    <div class="card">
                        <div class="icon"><i class="fa fa-line-chart"></i></div>
                        <h4>Give Stock</h4>
                        <p>You can also donate stock. To do so, please contact our business office at (678) 460-3500.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="page-section section-light">
            <div class="container section-grid">
                <div class="grid-col">
                    <div class="headline-group">
                        <h2 class="pre-title">Legacy Team</h2>
                        <h3 class="main-title">accelerate the vision of our church</h3>
                    </div>
                    <p class="content-text">Legacy Team members are committed to strategically invest their financial resources over and above the tithe to accelerate the vision of Manifestation Church. We like to say it this way: God has given us a vision and the legacy team determines the speed of that vision.</p>
                    <a href="#" class="btn">Join the Legacy Team</a>
                </div>
                <div class="grid-col">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2024/07/ccphotos616-0080.jpg" alt="A group of people praying together">
                </div>
            </div>
        </section>
    </main>

<<<<<<< HEAD:give.html
    <!-- START: RECREATED FOOTER -->
    <footer class="x-colophon" role="contentinfo">
        <!-- Top Content Bar -->
        <div class="x-bar-top-content">
            <div class="container">
                <div class="footer-row-inner">
                    <div class="footer-col">
                        <h4>Manifestation Outreach</h4>
                        <p>OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA</p>
                    </div>
                    <div class="footer-col">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="index.html">Church Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="events.html">All Events</a></li>
                            <li><a href="sermons.html">Sermons Archive</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Next Steps</h4>
                         <ul>
                            <li><a href="#">Growth Track</a></li>
                            <li><a href="#">Small Groups</a></li>
                            <li><a href="#">Discipleship School</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Connect With Us</h4>
                         <ul>
                             <li><a href="#">Contact Us</a></li>
                             <li><a href="#">Jobs</a></li>
                             <li><a href="#">Newsletter</a></li>
                         </ul>
                    </div>
=======
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
>>>>>>> c75c0b7f9c1042bfc91e63391b95b8b64a9a2f7f:give.php
                </div>
            </div>
        </div>
        <!-- Middle Logo Bar -->
        <div class="x-bar-middle-logo">
            <div class="container">
                <div class="footer-bar-content">
                    <hr class="x-line">
                    <img src="images/logo-white.png" alt="Footer Logo">
                    <hr class="x-line">
                </div>
            </div>
        </div>
        <!-- Bottom Social Bar -->
        <div class="x-bar-bottom-bar">
            <div class="container">
                <div class="footer-bottom-container">
                    <div class="footer-copyright">
                        <p>&copy; <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p>
                    </div>
                    <div class="footer-social-links">
                        <a href="#">FACEBOOK</a>
                        <a href="#">INSTAGRAM</a>
                        <a href="#">YOUTUBE</a>
                        <a href="#">NEWSLETTER</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END: RECREATED FOOTER -->

    <script>
        const header = document.getElementById('site-header');
        window.onscroll = function() {
            if (header) {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        };
    </script>

</body>
</html>