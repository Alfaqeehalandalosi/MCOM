<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impact - Cedarcrest Church | Acworth GA</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Custom Font Face from original source */
        @font-face {
            font-family: 'poynter-new';
            src: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/PoynterText-Bold_new.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        /* CSS Variables */
        :root {
            --primary-dark: #000000;
            --accent-teal: #47ab9d;
            --accent-teal-hover: #348b7f;
            --brand-grey-hover: #b2aeaa;
            --dark-grey-text: #272727;
            --body-text-grey: #999999;
            --light-grey-bg: rgb(250, 250, 250);
            --brand-red: #dd4537;
            --text-light: #ffffff;
            --text-dark: #272727;
            --text-muted: #999999;
            --bg-light: #f8f9fa;
            --border-color: #e0e0e0;
            --font-lato: 'Lato', sans-serif;
            --font-open-sans: 'Open Sans', sans-serif;
            --font-poynter: 'poynter-new', serif;
        }

        /* Base & Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-lato);
            font-size: 16px;
            font-weight: 400;
            color: var(--body-text-grey);
            background-color: #fff;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-lato);
            font-weight: 700;
            color: var(--dark-grey-text);
            letter-spacing: -0.035em;
        }

        p {
            line-height: 1.6;
            margin-bottom: 1.5em;
        }
        p:last-child {
            margin-bottom: 0;
        }
        
        a {
            text-decoration: none;
            transition: color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
        }

        /* Header from index.html */
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
        .navigation .sf-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 35px;
        }
        .navigation .sf-menu > li > a {
            color: var(--text-light);
            font-family: var(--font-open-sans);
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.2em;
            font-weight: 400;
            padding-bottom: 5px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .navigation .sf-menu > li > a:hover {
            color: var(--accent-teal);
            border-bottom-color: var(--accent-teal);
        }
        .header-button .btn {
            color: var(--text-light);
            border: 2px solid var(--text-light);
            padding: 8px 20px;
            border-radius: 5px;
            font-size: 0.85em;
            text-transform: uppercase;
        }
        .header-button .btn:hover {
            background-color: var(--text-light);
            color: var(--primary-dark);
        }

        /* Dropdown styles */
        .navigation .dropdown {
            display: none;
            position: absolute;
            background-color: #222;
            padding: 15px;
            border-top: 3px solid var(--accent-teal);
            list-style: none;
            width: 220px;
        }
        .navigation li:hover > .dropdown {
            display: block;
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
        
        /* Main Content Wrapper */
        main { padding-top: 80px; }

        /* Hero Section */
        .section-hero {
            padding: 20vh 0;
            background: url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/279A1137.jpg') no-repeat center center/cover;
            position: relative; text-align: center;
        }
        .section-hero::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.25);
        }
        .hero-content { position: relative; z-index: 2; }
        .hero-content .subtitle {
            font-family: var(--font-open-sans); font-size: 1.15em; line-height: 1.6;
            font-weight: 400; letter-spacing: 0.25em; text-transform: uppercase;
            color: hsl(0,0%,100%);
        }
        .hero-content .title {
            font-family: var(--font-poynter); font-size: 3.5em; font-weight: 700;
            line-height: 1; letter-spacing: 0em; text-transform: none; color: hsl(0,0%,100%);
        }
        
        /* General Content Section Styles */
        .section { padding: 10vh 0; }
        .grid-2-col { display: flex; gap: 40px; align-items: center; }
        .grid-2-col.reverse { flex-direction: row-reverse; }
        .grid-2-col > div { flex: 1; }
        .content-col { display: flex; flex-direction: column; justify-content: center; align-items: flex-start; }
        .img-col img { border-radius: 5px; width: 100%; }
        .content-col .super-title {
            font-family: var(--font-open-sans); font-size: 1em; line-height: 1.1;
            font-weight: 400; color: #b2aeaa; text-transform: none; margin-bottom: 0.35em;
        }
        .content-col .title {
            font-family: var(--font-poynter); font-size: 3em; line-height: 1.1;
            letter-spacing: 0em; text-transform: none; margin: 0; padding-bottom: 0.5em;
        }
        .content-col p { font-family: var(--font-open-sans); font-weight: 400; margin-top: 1em; }
        .bg-red { background-color: var(--brand-red); }
        .bg-red .title, .bg-red .super-title, .bg-red p { color: #fff; }
        .bg-black { background-color: rgb(0,0,0); }
        .bg-black .title, .bg-black .super-title, .bg-black p { color: #fff; }
        .bg-black .title.local-impact { letter-spacing: 0.035em; line-height: .85;}
        .bg-light-grey { background-color: var(--light-grey-bg); }
        
        /* Buttons */
        .btn {
            padding: 0.855em 1.05em; font-family: var(--font-open-sans);
            font-size: 1em; font-weight: 400; line-height: 1;
            letter-spacing: 0.25em; text-transform: uppercase;
            border-radius: 5px; display: inline-block;
            transition: all 0.3s ease; margin-top: 1em;
        }
        .btn-white { background-color: rgb(255,255,255); color: rgb(0,0,0); }
        .btn-black { background-color: rgb(0,0,0); color: rgb(255,255,255); }
        .btn:hover {
            background-color: var(--brand-grey-hover); color: rgb(255,255,255);
            transform: scale(1.05);
        }

        /* Image Collage */
        .image-collage-grid {
            display: grid; grid-template-columns: repeat(9, 1fr);
            grid-template-rows: repeat(9, 1fr); height: 500px; width: 100%;
        }
        .collage-cell {
            border: 3px solid #fff; border-radius: 5px; overflow: hidden;
        }
        .collage-cell img { width: 100%; height: 100%; object-fit: cover; }
        .cell-1 { grid-column: 1 / 6; grid-row: 1 / 6; }
        .cell-2 { grid-column: 5 / 10; grid-row: 2 / 8; }
        .cell-3 { grid-column: 2 / 7; grid-row: 5 / 10; }

        /* Backpack Section */
        .section-backpack { padding: 65px 0; text-align: center; }
        .section-backpack .super-title { color: var(--dark-grey-text); }
        .section-backpack .title { line-height: 0.85; padding-bottom: 1em; }
        .section-backpack hr {
            border: none; border-bottom: 2px solid var(--body-text-grey);
            width: 100px; margin: auto; margin-bottom: 1em; opacity: 0.4;
        }
        .section-backpack .content { max-width: 600px; margin: 1em auto; text-align: left; }
        .section-backpack .content h5 { text-align: center; }
        .section-backpack .content ul { margin: 1em 0 1em 20px; }
        .section-backpack .btn { margin-top: 0.85em; }

        /* Embed Placeholder */
        .embed-placeholder {
            width: 100%; height: 430px; background-color: #f0f0f0;
            display: flex; align-items: center; justify-content: center;
            border: 1px dashed #ccc; color: #888; font-family: sans-serif; margin-top: 2em;
        }

        /* Footer from index.html */
        .site-footer { color: var(--text-light); }
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
        
        /* Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(2rem);
            transition: opacity 1000ms cubic-bezier(0.4, 0, 0.2, 1), transform 1000ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        .animate-on-scroll.delay-1 { transition-delay: 500ms; }
        .animate-on-scroll.delay-2 { transition-delay: 1000ms; }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .navigation, .header-button { display: none; }
            .grid-2-col { flex-direction: column !important; }
            .grid-2-col .img-col { order: -1; }
            .content-col { align-items: center; text-align: center; }
            .image-collage-grid { height: 400px; margin-bottom: 2em; }
            .footer-grid { grid-template-columns: 1fr; gap: 1em; }
            .footer-bottom .container { flex-direction: column; height: auto; padding: 10px 0; gap: 10px; }
        }
        @media (max-width: 767px) {
            .hero-content .title { font-size: 2.5em; }
            .content-col .title { font-size: 2.2em; }
        }

    </style>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="section-hero">
            <div class="hero-content container">
                <h2 class="subtitle">Impact</h2>
                <h1 class="title">being the hands and feet of Jesus.</h1>
            </div>
        </section>

        <section class="section bg-red">
            <div class="container grid-2-col reverse">
                <div class="img-col">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2025/06/Slide.jpg" alt="Serve Saturday volunteers">
                </div>
                <div class="content-col">
                    <h3 class="super-title">Saturday July 12</h3>
                    <h2 class="title">join us for serve saturday</h2>
                    <p>Serve Saturday is July 12th! Serve Saturday is an opportunity for Cedarcrest Church to make a Kingdom impact across our community through 50 different serve projects in a single day! We have opportunities for you and your family to serve at together!</p>
                    <a href="#" class="btn btn-white">serve with us!</a>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container grid-2-col reverse">
                <div class="content-col">
                    <h3 class="super-title">Saturday, July 12</h3>
                    <h2 class="title">backpack drive 2025</h2>
                    <p>Cedarcrest Church is hosting a Backpack Drive during Serve Saturday for your Kindergarten- 5th Grader! If your kiddo is in need of a backpack filled with a school supply starter kit, click the link below to request a backpack!</p>
                    <a href="#" class="btn btn-black">RECEIVE A BACKPACK</a>
                </div>
                <div class="img-col">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/backpackslide-1536x861-1.png" alt="Backpacks for kids">
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container grid-2-col">
                 <div class="img-col">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2025/03/ServeSaturday-2-7.jpg" alt="Volunteers making a difference">
                </div>
                <div class="content-col">
                    <h2 class="title">make a difference</h2>
                    <p>Make an Impact with us! Check out our upcoming opportunities below:</p>
                    <a href="#" class="btn btn-black">serve with us</a>
                </div>
            </div>
        </section>

        <section class="section bg-light-grey section-backpack">
            <div class="container">
                <h3 class="super-title">July 12, 2025</h3>
                <h2 class="title">backpack drive</h2>
                <hr>
                <div class="content">
                    <h5>Help us resource families as we get ready for back to school!</h5>
                    <p>Every backpack a kiddo receives comes with a school supply "starter kit". We are collecting:</p>
                    <ul>
                        <li>New backpacks</li>
                        <li>Dry erase markers</li>
                        <li>Glue sticks</li>
                        <li>Sanitizer wipes</li>
                    </ul>
                    <p><strong>Donation drop off is Sunday July, 23rd at the Welcome Desk</strong></p>
                    <h5><strong>Serve with us:</strong></h5>
                    <p>Serve at our backpack packing event on <strong>Monday morning, July 24th</strong><br>Serve at the distribution event on <strong>Thursday evening, July 27th</strong></p>
                </div>
                <a href="#" class="btn btn-black">SERVE WITH US</a>
            </div>
        </section>
        
        <section class="section bg-light-grey section-backpack">
             <div class="container">
                <h3 class="super-title">Impact Opportunities</h3>
                <h2 class="title">upcoming impact opportunities</h2>
                <div class="embed-placeholder">
                    Embedded Content Area (from subsplash.com)
                </div>
            </div>
        </section>

        <section class="section bg-black">
            <div class="container grid-2-col reverse">
                 <div class="img-col animate-on-scroll">
                    <div class="image-collage-grid">
                        <div class="collage-cell cell-1"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/IMG_1403-1536x1024-1.jpeg" alt="Local Impact 1"></div>
                        <div class="collage-cell cell-2"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/fooddrive2-1536x1536-1.jpeg" alt="Local Impact 2"></div>
                        <div class="collage-cell cell-3"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/sendrelief.jpeg" alt="Local Impact 3"></div>
                    </div>
                </div>
                <div class="content-col animate-on-scroll delay-1">
                    <h3 class="super-title">Local Impact</h3>
                    <h2 class="title local-impact">loving our neighbors well</h2>
                    <p>— Our Disaster Relief team provides generators and manual labor to restore damage from natural disasters in our local area — affectionately known as our "chainsaw ministry."</p>
                    <p>— We serve meals to front-line workers and educators weekly to encourage and keep them motivated as they work to support our local community.</p>
                    <a href="#" class="btn btn-white">Get Connected</a>
                </div>
            </div>
        </section>

    </main>
    
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

    <script>
        // Scroll animations (header handled by shared loader)
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        animatedElements.forEach(el => observer.observe(el));
    </script>
    
</body>
</html>