<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Church Template - Cedar Crest Style</title>
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

        /* --- TOP UTILITY BAR (NEW) --- */
        .top-utility-bar {
            background-color: var(--primary-dark);
            padding: 8px 0;
            font-size: 0.8em;
        }
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

        /* --- HERO --- */
        .hero {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--text-light);
            background-color: var(--primary-dark);
        }
        .hero-video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }
        .hero-content {
            position: relative;
            z-index: 3;
        }
        .hero-content h1 {
            font-family: 'poynter-new', 'Georgia', serif;
            font-size: 5em;
            font-weight: 700;
            line-height: 1.1;
            margin: 0 0 30px 0;
        }
        .hero-content .btn {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-light);
            border: 2px solid var(--text-light);
            background: transparent;
            padding: 15px 35px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            transition: all 0.3s ease;
        }
        .hero-content .btn:hover {
            background-color: var(--text-light);
            color: var(--primary-dark);
            transform: translateY(-3px);
        }

        /* --- CONTENT SECTIONS --- */
        .content-section {
            padding: 10vh 0;
        }
        .split-section {
            display: flex;
            align-items: center;
            gap: 50px; /* Restore gap for other sections */
        }
        .split-section > div {
            flex: 1; /* Default flex behavior */
        }
        .split-section img {
            width: 100%;
            border-radius: 5px;
        }
        
        /* Service Times Section */
        .service-times {
            padding: 10vh 0;
        }
        .service-times .split-section {
            gap: 0;
            justify-content: flex-start;
            align-items: flex-start;
        }
        .service-times .split-section > div:first-child {
            flex: 0 0 65%;
            padding-right: 50px;
        }
        .service-times .split-section > div:last-child {
            flex: 0 0 35%;
        }
        .service-times h2 {
            font-family: 'Playfair Display', serif;
            font-size: 7.2em;
            font-weight: 900;
            text-transform: lowercase;
            line-height: 0.95;
            letter-spacing: -3px;
            margin: 0;
            color: #000000;
        }
        .service-times h3 {
            font-size: 1.8em;
            font-weight: 700;
            color: #000000;
            text-transform: lowercase;
            letter-spacing: 0px;
            margin: 0 0 10px 0;
            font-family: 'Lato', sans-serif;
        }
        .service-times p:not(.times) {
            font-size: 1em;
            color: #666666;
            line-height: 1.6;
            margin: 0 0 15px 0;
            font-family: 'Lato', sans-serif;
        }
        .service-times .times {
            font-size: 1.5em;
            font-weight: 900;
            color: #000000;
            text-transform: lowercase;
            line-height: 1.3;
            margin: 0 0 25px 0;
            font-family: 'Lato', sans-serif;
        }
        .service-times .btn {
            display: inline-block;
            margin-top: 0;
            background-color: #000000;
            color: var(--text-light);
            padding: 12px 25px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s ease;
            font-family: 'Lato', sans-serif;
        }
        .service-times .btn:hover {
            background-color: #333333;
            transform: translateY(-2px);
        }

        /* Welcome Section */
        .welcome-section {
            background-color: var(--primary-dark);
            color: var(--text-light);
        }
        .welcome-section h2 {
            font-size: 2.5em;
            font-weight: 700;
            line-height: 1.2;
            margin: 0 0 20px 0;
            text-transform: lowercase;
            font-family: 'Lato', sans-serif;
        }
        .welcome-section p {
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 15px;
            font-size: 1em;
            font-family: 'Lato', sans-serif;
        }
        .welcome-section p:first-of-type {
            font-size: 0.85em;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }
        .welcome-section .btn {
            background: transparent;
            color: var(--text-light);
            border: 2px solid var(--text-light);
            padding: 12px 28px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .welcome-section .btn:hover {
            background: var(--text-light);
            color: var(--primary-dark);
        }

        /* Ministries Grid Section */
        .ministries-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 250px 250px;
            gap: 20px;
        }
        .ministry-card {
            position: relative;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 2em;
            font-weight: 900;
            overflow: hidden;
        }
        .ministry-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.35);
            z-index: 1;
        }
        .ministry-card h2 {
            position: relative;
            z-index: 2;
        }
        .ministry-card#groups {
            grid-row: 1 / 3;
        }
        
        /* Coming Up Section */
        .coming-up-section {
            background-color: var(--primary-dark);
            color: var(--text-light);
        }
        .coming-up-section h2, .coming-up-section h3 {
            margin: 0 0 20px 0;
            line-height: 1.2;
        }
        .coming-up-section h3 { font-size: 1.5em; }
        .coming-up-section h2 { font-size: 2.5em; }
        .coming-up-section p { color: var(--text-muted); }
        .coming-up-section .btn {
            display: inline-block;
            margin-right: 15px;
            border: 2px solid var(--text-light);
            padding: 12px 28px;
            border-radius: 5px;
            color: var(--primary-dark);
            background-color: var(--text-light);
        }
        .coming-up-section .btn:hover {
            background-color: transparent;
            color: var(--text-light);
        }
        .coming-up-section .btn.secondary {
             background-color: transparent;
             color: var(--text-light);
        }
         .coming-up-section .btn.secondary:hover {
            background-color: var(--text-light);
            color: var(--primary-dark);
        }

        /* --- NEXT STEPS SECTION (NEW) --- */
        .next-steps-section {
            background-color: var(--bg-light);
            text-align: center;
        }
        .next-steps-section h2 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .next-steps-section .intro-text {
            max-width: 800px;
            margin: 0 auto 40px auto;
            color: var(--text-muted);
            line-height: 1.6;
        }
        .next-steps-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            text-align: left;
        }
        .step-card {
            background: var(--text-light);
            padding: 30px;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            display: block;
        }
        .step-card:hover {
            border-color: var(--accent-teal);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .step-card .fa {
            font-size: 2em;
            color: var(--accent-teal);
            margin-bottom: 15px;
        }
        .step-card h4 {
            font-size: 1.2em;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            font-weight: 900;
        }
        .step-card p {
            font-size: 0.9em;
            color: var(--text-muted);
            line-height: 1.5;
            margin: 0;
        }
        
        /* Parallax Events Section */
        .parallax-section {
            padding: 15vh 0;
            background-image: url('images/join-us-text.png');
            background-color: var(--primary-dark);
            background-attachment: fixed;
            background-position: 95% 85%;
            background-repeat: no-repeat;
            background-size: 40% auto;
            color: var(--text-light);
        }
        .parallax-section h3 { font-size: 1.5em; }
        .parallax-section h2 { font-size: 2.5em; margin-bottom: 30px;}
        .parallax-section .btn {
            background-color: var(--text-light);
            color: var(--primary-dark);
            padding: 12px 28px;
            border-radius: 5px;
        }
        .parallax-section .btn:hover {
            background-color: var(--text-muted);
        }

        /* --- MAP SECTION --- */
        .map-section {
            padding: 0;
            line-height: 0; /* Removes potential whitespace under the iframe */
        }
        .map-section iframe {
            width: 100%;
            height: 450px;
            border: 0;
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
            <a href="#" class="header-logo"><img src="images/logo-white.png" alt="Logo"></a>
            <nav class="navigation">
              <ul class="sf-menu">
                <li><a href="about.php">About</a></li>
                <li><a href="connect.php">Connect</a></li>
                <li><a href="next-steps.php">Next Steps</a></li>
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
                <a href="php/login.php" class="btn">Log In</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <video class="hero-video-bg" poster="https://picsum.photos/1920/1080" playsinline autoplay muted loop>
            <source src="https://cedarcrestchurch.com/wp-content/uploads/2024/01/WebsiteHeaderHTML2024.mov" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>God is for you,<br>and so are we.</h1>
            <a href="newhere.php" class="btn">I'm New</a>
            
        </div>
        
    </section>

    <section class="content-section service-times">
      <div class="container split-section">
          <div>
              <h2>join us for church this sunday!</h2>
          </div>
          <div>
              <h3>service times</h3>
              <p>Our weekend services last one hour.</p>
              <p class="times">sundays at 8 am, 9:30 am, and 11 am</p>
              <a href="#" class="btn">Plan Your Visit</a>
          </div>
      </div>
    </section>

    <section class="content-section welcome-section">
      <div class="container split-section">
          <div>
              <img src="https://cedarcrestchurch.com/wp-content/uploads/2024/11/CedarcrestSunday-18327.jpg" alt="Church Welcome">
          </div>
          <div>
              <p>Welcome</p>
              <h2>we are a Jesus church.</h2>
              <p>We live this out in our 4 key vision words, Encounter, Disciple, Serve, and Impact. We want our church to encounter the living God, be a place of discipleship, serve the local community and the world creating impact through the name of Jesus Christ.</p>
              <a href="#" class="btn">About Us</a>
          </div>
      </div>
    </section>

    <style>
/* Interactive Grid Styles */
.interactive-grid {
    display: grid;
    grid-template-columns: 2fr 1fr; /* Left column is twice as wide as the right */
    grid-template-rows: auto;
    gap: 20px;
}

.right-column {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.grid-item {
    position: relative;
    background-size: cover;
    background-position: center;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 250px;
    cursor: pointer;
    overflow: hidden;
}

.grid-item::after { /* Dark overlay for text readability */
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    transition: background-color 0.3s ease;
}

.grid-item:hover::after {
    background: rgba(0,0,0,0.5);
}

.grid-item h2 {
    position: relative;
    z-index: 2;
    font-size: 2.5em;
    font-weight: 900;
    text-transform: lowercase;
}

.featured-item {
    min-height: 520px; /* 250px + 250px + 20px gap */
}

.description-pane {
    background-color: var(--bg-light);
    padding: 25px;
    color: var(--text-dark);
}

.description-pane h4 {
    margin-top: 0;
    font-size: 1.2em;
    font-weight: 900;
}

.description-pane p {
    font-size: 0.9em;
    color: var(--text-muted);
    line-height: 1.6;
}

.description-content {
    display: none; /* Hide all descriptions by default */
}

.description-content.active {
    display: block; /* Show only the active one */
}
</style>
<section class="content-section">
    <div class="container">
        <div class="interactive-grid">
            
            <div class="grid-item featured-item" id="featured-item" data-item="groups" style="background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/home-groups_1200xx800.jpg');">
                <h2 id="featured-title">small groups</h2>
            </div>

            <div class="right-column">

                <div class="grid-item thumbnail-item" id="thumbnail-1" data-item="kids" style="background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/home-kids_1200x800.jpg');">
                    <h2 id="thumbnail-1-title">kids</h2>
                </div>

                <div class="grid-item thumbnail-item" id="thumbnail-2" data-item="students" style="background-image: url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/home-students_1200x800.jpg');">
                    <h2 id="thumbnail-2-title">students</h2>
                </div>

                <div class="description-pane" id="description-pane">
                    <div class="description-content active" data-item="groups">
                        <h4>About Manifestation Groups</h4>
                        <p>This is the description for small groups. Here we can talk about community, connection, and growing together in faith. Small Groups are where we turn rows on a Sunday morning, to circles in a home.</p>
                    </div>
                    <div class="description-content" data-item="kids">
                        <h4>About Manifestation Kids</h4>
                        <p>This is the description for the kids' ministry. Talk about the fun, safe, and engaging environment we create for children to learn about Jesus on their level.</p>
                    </div>
                    <div class="description-content" data-item="students">
                        <h4>About Manifestation Students</h4>
                        <p>This is the description for the students' ministry. Discuss the exciting events, relevant teachings, and powerful community we build for middle and high school students.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    const itemData = {
        groups: { title: 'small groups', image: 'https://cedarcrestchurch.com/wp-content/uploads/2022/07/home-groups_1200xx800.jpg' },
        kids: { title: 'kids', image: 'https://cedarcrestchurch.com/wp-content/uploads/2022/07/home-kids_1200x800.jpg' },
        students: { title: 'students', image: 'https://cedarcrestchurch.com/wp-content/uploads/2022/07/home-students_1200x800.jpg' }
    };

    const featuredItem = document.getElementById('featured-item');
    const thumb1 = document.getElementById('thumbnail-1');
    const thumb2 = document.getElementById('thumbnail-2');
    const allDescriptions = document.querySelectorAll('.description-content');
    const clickableItems = document.querySelectorAll('.grid-item[data-item]');

    function updateGrid(featuredId) {
        // Get the data for the featured item and the two thumbnails
        const featuredData = itemData[featuredId];
        const thumbnailIds = Object.keys(itemData).filter(id => id !== featuredId);
        
        // Update the Featured Item (Box A)
        featuredItem.style.backgroundImage = `url(${featuredData.image})`;
        featuredItem.querySelector('h2').textContent = featuredData.title;
        featuredItem.dataset.item = featuredId;
        
        // Update the first Thumbnail (Box B)
        const thumb1Data = itemData[thumbnailIds[0]];
        thumb1.style.backgroundImage = `url(${thumb1Data.image})`;
        thumb1.querySelector('h2').textContent = thumb1Data.title;
        thumb1.dataset.item = thumbnailIds[0];
        
        // Update the second Thumbnail (Box C)
        const thumb2Data = itemData[thumbnailIds[1]];
        thumb2.style.backgroundImage = `url(${thumb2Data.image})`;
        thumb2.querySelector('h2').textContent = thumb2Data.title;
        thumb2.dataset.item = thumbnailIds[1];
        
        // Update the Description Pane (Box D)
        allDescriptions.forEach(desc => {
            desc.classList.remove('active');
            if (desc.dataset.item === featuredId) {
                desc.classList.add('active');
            }
        });
    }

    clickableItems.forEach(item => {
        item.addEventListener('click', () => {
            const clickedId = item.dataset.item;
            updateGrid(clickedId);
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        updateGrid('groups'); // Set 'groups' as the default featured item
    });
</script>

    <section class="content-section coming-up-section">
        <div class="container split-section">
             <div>
                <h3>Coming up at Manifestation city church:</h3>
                <img src="https://cedarcrestchurch.com/wp-content/uploads/2025/09/James-slide.jpg" alt="Sermon Series">
            </div>
            <div>
                <h3>Watch</h3>
                <h2>now you can watch anytime, anywhere.</h2>
                <p>Relevant, engaging messages that will encourage you wherever you are. Catch up on our previous sermons, or watch us live online at 8 AM, 9:30 AM, and 11 AM every Sunday morning!</p>
                <a href="#" class="btn">Previous Messages</a>
                <a href="#" class="btn secondary">Watch On-Demand</a>
            </div>
        </div>
    </section>

    <section class="content-section next-steps-section">
        <div class="container">
            <h2>Next Steps</h2>
            <p class="intro-text">No matter where you find yourself in your faith journey, there is a NEXT step for you. We want to help you grow in your relationship with Jesus and connect with others while you do it!</p>
            <div class="next-steps-grid">
                <a href="#" class="step-card">
                    <i class="fa fa-map-o"></i>
                    <h4>Growth Track</h4>
                    <p>Discover your purpose and live the life you were created for. Growth Track invites you to become a member, discover your design, and join the team.</p>
                </a>
                <a href="#" class="step-card">
                    <i class="fa fa-users"></i>
                    <h4>Find a Small Group</h4>
                    <p>Church is lived out in Small Group. A place where you can meet new people, pray for one another, and grow together.</p>
                </a>
                <a href="#" class="step-card">
                    <i class="fa fa-handshake-o"></i>
                    <h4>Serve Team</h4>
                    <p>Use your God-given gifts to build our local church. We have opportunities all across our campus for you to serve!</p>
                </a>
                <a href="#" class="step-card">
                    <i class="fa fa-heart"></i>
                    <h4>Impact Opportunities</h4>
                    <p>Be the hands and feet of Jesus in our community and in the nations. We have opportunities locally and globally for you to partner with us.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="parallax-section">
        <div class="container">
            <div class="parallax-content">
                <h3>Events</h3>
                <h2>here's what's happening next at Manifestation city church.</h2>
                <a href="#" class="btn">Upcoming Events</a>
            </div>
        </div>
    </section>

    <section class="map-section">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.747190122949!2d-84.62955188478637!3d34.0000289806208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f53c1c7a8f309d%3A0x9559ead355345633!2sCedarcrest%20Church!5e0!3m2!1sen!2sus!4v1663593997123!5m2!1sen!2sus" 
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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