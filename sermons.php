
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Sermons - Manifestation Outreach</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">

<style>
    /* --- EXPANDED COLOR PALETTE --- */
    :root {
        --accent-teal: #027368;        /* Primary Accent */
        --primary-dark: #262626;      /* Primary Text / Dark BG */
        --accent-warm: #BF5A36;       /* Warm Accent / CTA */
        --text-muted: #8C8C8C;        /* Muted Text / Gray */
        --border-color: #E0E0E0;      /* Subtle Border / Line */
        --bg-light: #F8F7F3;          /* Primary Light BG */
        --text-light: #FFFFFF;        /* Highlight */
    }

    @font-face {
        font-family: 'poynter-new';
        src: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/PoynterText-Bold_new.woff2') format('woff2');
        font-weight: 700;
        font-style: normal;
    }
    
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Lato', sans-serif;
        background-color: var(--bg-light);
        color: var(--primary-dark);
        scroll-behavior: smooth;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }

    a {
        text-decoration: none;
        transition: color 0.3s ease, background-color 0.3s ease, transform 0.3s ease;
    }
    
    /* --- STABILIZED HEADER STYLES --- */
    .site-header {
        position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
        padding: 20px 0; background-color: transparent;
        transition: background-color 0.4s ease, padding 0.4s ease;
    }
    .site-header.scrolled {
        background-color: rgba(38, 38, 38, 0.9);
        backdrop-filter: blur(5px);
        padding: 10px 0;
        border-bottom: 1px solid #333;
    }
    .header-content {
        display: flex; justify-content: space-between; align-items: center;
        width: 90%; max-width: 1200px; margin: 0 auto;
    }
    .header-logo img { max-height: 50px; transition: max-height 0.4s ease; }
    .site-header.scrolled .header-logo img { max-height: 40px; }
    .navigation .sf-menu { list-style: none; margin: 0; padding: 0; display: flex; gap: 35px; }
    .navigation .sf-menu > li > a {
        color: var(--text-light); font-family: 'Open Sans', sans-serif; text-transform: uppercase;
        font-size: 0.85em; letter-spacing: 0.2em; font-weight: 400; padding-bottom: 5px;
        border-bottom: 2px solid transparent;
    }
    .navigation .sf-menu > li > a:hover,
    .navigation .sf-menu > li.current-menu-item > a {
        color: var(--accent-teal);
        border-bottom-color: var(--accent-teal);
    }
    .site-header .header-button .btn {
        color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px;
        border-radius: 5px; font-size: 0.85em; text-transform: uppercase; background-color: transparent;
    }
    .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }
    
    /* --- MAIN CONTENT & HERO --- */
    main { position: relative; }

    .hero {
        background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/Feb2-11-18.jpg');
        background-size: cover;
        background-position: center;
        padding: calc(20vh + 80px) 0 20vh 0;
        position: relative;
    }
    
    .hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(38, 38, 38, 0.25);
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
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--text-light);
        margin-bottom: 20px;
    }
    
    .hero h1 {
        font-family: 'poynter-new', 'Georgia', serif;
        font-size: 3.5em;
        line-height: 1;
        color: var(--text-light);
    }
    
    /* Watch Live Section */
    .watch-live {
        padding: 6% 0;
        text-align: center;
        background-color: var(--text-light);
    }
    
    .watch-live h2 {
        font-family: 'Open Sans', sans-serif;
        font-size: 1.5em;
        letter-spacing: 0.2em;
        color: var(--primary-dark);
        margin-bottom: 10px;
    }
    
    .watch-live .subtitle {
        font-family: 'poynter-new', sans-serif;
        font-size: 3em;
        line-height: 0.85;
        color: var(--primary-dark);
        margin-bottom: 30px;
    }
    
    .divider {
        height: 10px;
        max-height: none;
        border-left: 1px solid var(--border-color);
        margin: 20px auto;
        width: 1px;
    }
    
    .video-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%;
        margin-top: 30px;
    }
    .video-container iframe {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%; border: none;
    }
    
    /* Previous Messages Section */
    .previous-messages {
        background-color: var(--bg-light);
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
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(38, 38, 38, 0.5);
    }
    
    .messages-image-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }
    
    .messages-image h3 {
        font-family: 'poynter-new', sans-serif;
        font-size: 3em;
        color: var(--text-light);
    }
    
    .messages-content {
        padding: 150px 4em 4em;
        text-align: center;
    }
    
    .messages-content h2 {
        font-family: 'Open Sans', sans-serif;
        font-size: 1em;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--primary-dark);
        margin-bottom: 30px;
    }
    
    .previous-messages .btn {
        display: inline-block;
        margin-top: 30px;
        background-color: var(--primary-dark);
        color: var(--text-light);
        padding: 16px 35px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.85em;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .previous-messages .btn:hover {
        background-color: var(--accent-teal);
    }

    /* --- RECREATED FOOTER STYLES --- */
    .x-colophon { background-color: var(--primary-dark); color: var(--text-muted); }
    .x-colophon .x-bar-top-content { padding: 80px 0; border-top: 1px solid #333; }
    .x-colophon .footer-row-inner { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; }
    .x-colophon .footer-col h4 { font-family: 'Open Sans', sans-serif; font-weight: 600; text-transform: uppercase; font-size: 1em; margin-bottom: 20px; color: var(--text-light); letter-spacing: 0.1em; }
    .x-colophon .footer-col p, .x-colophon .footer-col a { font-family: 'Open Sans', sans-serif; color: var(--text-muted); line-height: 1.6; text-decoration: none; font-size: 0.9em; }
    .x-colophon .footer-col a:hover { color: var(--accent-teal); }
    .x-colophon .footer-col ul { list-style: none; padding: 0; margin: 0; }
    .x-colophon .footer-col ul li { margin-bottom: 10px; }
    .x-colophon .x-bar-middle-logo { padding: 20px 0; box-shadow: 0 3px 25px rgba(0, 0, 0, 0.15); }
    .x-colophon .footer-bar-content { display: flex; justify-content: center; align-items: center; }
    .x-colophon .footer-bar-content .x-line { height: 1px; flex-grow: 1; background-color: #333; }
    .x-colophon .footer-bar-content img { max-height: 40px; margin: 0 30px; }
    .x-colophon .x-bar-bottom-bar { padding: 20px 0; }
    .x-colophon .footer-bottom-container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
    .x-colophon .footer-bottom-container p, .x-colophon .footer-bottom-container a { font-family: 'Open Sans', sans-serif; font-size: 0.8em; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); text-decoration: none; }
    .x-colophon .footer-social-links a { margin-left: 1.2em; }
    .x-colophon .footer-social-links a:hover { color: var(--accent-teal); }

    /* Responsive */
    @media (max-width: 992px) {
        .navigation, .header-button { display: none; }
        .hero-content h1 { font-size: 3em; }
        .messages-grid { grid-template-columns: 1fr; }
        .messages-image, .messages-content { padding: 4em; }
        .footer-row-inner { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 767px) {
        .footer-row-inner { grid-template-columns: 1fr; }
        .footer-bottom-container { justify-content: center; }
    }

</style>
</head>
<body>
<<<<<<< HEAD:sermons.html
    <header class="site-header" id="site-header">
    <div class="header-content">
        <a href="index.html" class="header-logo"><img src="images/logo-white.png" alt="Logo"></a>
        <nav class="navigation">
          <ul class="sf-menu">
            <li><a href="about.html">About</a></li>
            <li><a href="connect.html">Connect</a></li>
            <li><a href="nextsteps.html">Next Steps</a></li>
            <li><a href="events.html">Events</a></li>
            <li class="current-menu-item"><a href="sermons.html">Sermons</a></li>
            <li><a href="impact.html">Impact</a></li>
            <li><a href="give.html">Give</a></li>
          </ul>
        </nav>
        <div class="header-button">
            <a href="#" class="btn">Log In</a>
        </div>
    </div>
</header>
=======
    <?php include 'header.php'; ?>
>>>>>>> c75c0b7f9c1042bfc91e63391b95b8b64a9a2f7f:sermons.php

<main>
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Watch</h2>
                <h1>let's come together and worship</h1>
            </div>
        </div>
    </section>

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

    <section class="previous-messages" id="messages">
        <div class="messages-grid">
            <div class="messages-image">
                <div class="messages-image-content">
                    <h3>looking for a previous message?</h3>
                </div>
            </div>
            <div class="messages-content">
                <h2>Watch or listen to some of our Previous Messages</h2>
                <div class="divider"></div>
<<<<<<< HEAD:sermons.html
                <a href="#" class="btn">previous messages</a>
=======
                <a href="sermon-archive copy.php" class="btn">previous messages</a>
>>>>>>> c75c0b7f9c1042bfc91e63391b95b8b64a9a2f7f:sermons.php
            </div>
        </div>
    </section>
</main>

<<<<<<< HEAD:sermons.html
<footer class="x-colophon" role="contentinfo">
    <div class="x-bar-top-content"><div class="container"><div class="footer-row-inner"><div class="footer-col"><h4>Manifestation Outreach</h4><p>OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA</p></div><div class="footer-col"><h4>Quick Links</h4><ul><li><a href="index.html">Church Home</a></li><li><a href="about.html">About Us</a></li><li><a href="events.html">All Events</a></li><li><a href="sermons.html">Sermons Archive</a></li></ul></div><div class="footer-col"><h4>Next Steps</h4><ul><li><a href="#">Growth Track</a></li><li><a href="#">Small Groups</a></li><li><a href="#">Discipleship School</a></li></ul></div><div class="footer-col"><h4>Connect With Us</h4><ul><li><a href="#">Contact Us</a></li><li><a href="#">Jobs</a></li><li><a href="#">Newsletter</a></li></ul></div></div></div></div>
    <div class="x-bar-middle-logo"><div class="container"><div class="footer-bar-content"><hr class="x-line"><img src="images/logo-white.png" alt="Footer Logo"><hr class="x-line"></div></div></div>
    <div class="x-bar-bottom-bar"><div class="container"><div class="footer-bottom-container"><div class="footer-copyright"><p>&copy; <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p></div><div class="footer-social-links"><a href="#">FACEBOOK</a><a href="#">INSTAGRAM</a><a href="#">YOUTUBE</a><a href="#">NEWSLETTER</a></div></div></div></div>
</footer>

<script>
    (function(){
        const header = document.getElementById('site-header');
        if(!header) return;
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Check on load
    })();
</script>
</body>
</html>
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
        
    </body>
    </html>
>>>>>>> c75c0b7f9c1042bfc91e63391b95b8b64a9a2f7f:sermons.php
