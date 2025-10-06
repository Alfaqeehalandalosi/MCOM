<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Steps - Manifestation Outreach</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        /* --- EXPANDED COLOR PALETTE --- */
        :root {
            --accent-teal: #027368;        /* Primary Accent */
            --primary-dark: #262626;      /* Primary Text / Dark BG */
            --accent-warm: #BF5A36;       /* Warm Accent / CTA */
            --accent-secondary: #D9A443;  /* Secondary Accent */
            --text-muted: #8C8C8C;        /* Muted Text / Gray */
            --border-color: #E0E0E0;      /* Subtle Border / Line */
            --bg-accent-light: #D9E9E7;   /* Light Accent BG */
            --bg-light: #F8F7F3;          /* Primary Light BG */
            --text-light: #FFFFFF;        /* Highlight */
            --font-lato: 'Lato', sans-serif;
            --font-open-sans: 'Open Sans', sans-serif;
        }

        @font-face {
            font-family: "poynter-new";
            src: url('https://cedarcrestchurch.com/wp-content/uploads/2025/02/PoynterText-Bold_new.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }
        
        /* Reset and Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            color: var(--text-muted);
            background-color: var(--text-light);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lato', sans-serif;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 1rem;
        }
        
        p { margin-bottom: 1.5rem; }
        a { color: var(--accent-teal); text-decoration: none; transition: color 0.3s ease; }
        a:hover { color: var(--accent-warm); }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        /* --- STABILIZED HEADER --- */
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
        /* This ensures the header content is always centered within the same container width */
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
            border-bottom: 2px solid transparent; transition: all 0.3s ease;
        }
        .navigation .sf-menu > li > a:hover,
        .navigation .sf-menu > li.current-menu-item > a {
            color: var(--accent-teal);
            border-bottom-color: var(--accent-teal);
        }
        .site-header .header-button .btn {
            color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px;
            border-radius: 5px; font-size: 0.85em; text-transform: uppercase; background-color: transparent;
            transition: all 0.3s ease;
        }
        .header-button .btn:hover { background-color: var(--text-light); color: var(--primary-dark); }
        
        /* Main */
        main { position: relative; } /* Fix for header */

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(38,38,38,0.25), rgba(38,38,38,0.25)), url('https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-steps-header_1920x1080.jpg');
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: calc(20vh + 80px) 0 20vh 0; /* Fix for header */
            text-align: center; color: var(--text-light);
        }
        .hero h2 {
            color: var(--text-light); font-family: 'Open Sans', sans-serif; font-weight: 400;
            font-size: 1.15em; text-transform: uppercase; letter-spacing: 0.25em; margin-bottom: 1.5rem;
            opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards;
        }
        .hero h1 {
            color: var(--text-light); font-family: "poynter-new", serif; font-size: 3.5em;
            font-weight: 700; line-height: 1.1; opacity: 0; transform: translateY(30px);
            animation: fadeInUp 0.8s ease 0.3s forwards;
        }
        
        /* Section Styles */
        .section { padding: 10vh 0; opacity: 0; transform: translateY(50px); transition: all 0.8s ease; }
        .section.visible { opacity: 1; transform: translateY(0); }
        .section-light { background-color: var(--bg-light); }
        .section-dark { background-color: var(--primary-dark); color: var(--text-light); }
        .section-dark h2, .section-dark h3, .section-dark .section-heading, .section-dark .section-title { color: var(--text-light); }
        .section-content { display: flex; align-items: center; gap: 40px; }
        .section-content.reverse { flex-direction: row-reverse; }
        .section-text, .section-image { flex: 1; }
        .section-image img { width: 100%; height: auto; border-radius: 5px; transition: transform 0.5s ease; }
        .section-image:hover img { transform: scale(1.05); }
        
        .section-title { font-family: 'Open Sans', sans-serif; font-weight: 400; font-size: 1.15em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.5rem; opacity: 0; transform: translateY(20px); transition: all 0.6s ease 0.2s; }
        .section-heading { font-family: "poynter-new", serif; font-size: 3em; font-weight: 700; line-height: 1; margin-bottom: 1.5rem; opacity: 0; transform: translateY(20px); transition: all 0.6s ease 0.4s; }
        .section-text p { opacity: 0; transform: translateY(20px); transition: all 0.6s ease 0.6s; }
        .section-text .btn { opacity: 0; transform: translateY(20px); transition: all 0.6s ease 0.8s; }
        
        .section.visible .section-title, .section.visible .section-heading, .section.visible .section-text p, .section.visible .section-text .btn { opacity: 1; transform: translateY(0); }
        
        .btn { display: inline-block; padding: 12px 24px; border-radius: 5px; font-family: 'Open Sans', sans-serif; font-size: 1em; font-weight: 400; text-transform: uppercase; letter-spacing: 0.25em; transition: all 0.3s ease; cursor: pointer; margin-right: 10px; margin-bottom: 10px; }
        .btn-primary { background-color: var(--primary-dark); color: var(--text-light); }
        .btn-primary:hover { background-color: var(--accent-teal); }
        .btn-secondary { background-color: var(--text-light); color: var(--primary-dark); border: 2px solid var(--text-light); }
        .btn-secondary:hover { background-color: var(--accent-warm); color: var(--text-light); border-color: var(--accent-warm); }
        
        /* Image Grid & Service Grid */
        .image-grid { display: grid; grid-template-columns: repeat(3, 1fr); grid-template-rows: repeat(3, 1fr); gap: 20px; height: 500px; }
        .grid-image { border-radius: 5px; overflow: hidden; border: 3px solid var(--text-light); opacity: 0; transform: scale(0.9); transition: all 0.8s ease; }
        .grid-image.visible { opacity: 1; transform: scale(1); }
        .grid-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .grid-image:hover img { transform: scale(1.1); }
        .grid-image-1 { grid-column: 1 / 4; grid-row: 1 / 3; transition-delay: 0.1s; }
        .grid-image-2 { grid-column: 2 / 5; grid-row: 2 / 4; transition-delay: 0.3s; }
        .grid-image-3 { grid-column: 1 / 4; grid-row: 3 / 5; transition-delay: 0.5s; }
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; margin-top: 40px; }
        .service-item { text-align: center; padding: 40px 20px; opacity: 0; transform: translateY(30px); transition: all 0.6s ease; }
        .service-item.visible { opacity: 1; transform: translateY(0); }
        .service-icon { font-size: 3.5em; color: var(--primary-dark); margin-bottom: 20px; transition: all 0.3s ease; width: 80px; height: 80px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; }
        .service-item:hover .service-icon { transform: scale(1.1); color: var(--accent-teal); }
        .service-title { font-family: 'Open Sans', sans-serif; font-weight: 400; font-size: 1.15em; text-transform: uppercase; letter-spacing: 0.2em; color: var(--primary-dark); margin-bottom: 20px; }
        
        /* --- START: RECREATED FOOTER STYLES --- */
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
        /* --- END: RECREATED FOOTER STYLES --- */

        /* Scroll to Top Button */
        .scroll-top { position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px; background-color: var(--accent-warm); color: var(--text-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 99; }
        .scroll-top.active { opacity: 1; visibility: visible; }
        .scroll-top:hover { background-color: var(--accent-teal); transform: translateY(-5px); }
        
        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Responsive Styles */
        @media (max-width: 978px) {
            .section-content, .section-content.reverse { flex-direction: column; }
            .services-grid, .footer-grid { grid-template-columns: 1fr 1fr; }
            .navigation, .header-button { display: none; }
        }
        
        @media (max-width: 766px) {
            .services-grid, .footer-grid { grid-template-columns: 1fr; }
            .image-grid { height: 300px; }
            .hero h1, .section-heading { font-size: 2.5em; }
            .footer-bottom-container { justify-content: center; }
        }
    </style>
</head>
<body>
    <header class="site-header" id="site-header">
        <div class="header-content">
            <a href="index.html" class="header-logo"><img src="images/logo-white.png" alt="Logo"></a>
            <nav class="navigation">
                <ul class="sf-menu">
                    <li><a href="about.html">About</a></li>
                    <li><a href="connect.html">Connect</a></li>
                    <li class="current-menu-item"><a href="nextsteps.html">Next Steps</a></li>
                    <li><a href="events.html">Events</a></li>
                    <li><a href="sermons.html">Sermons</a></li>
                    <li><a href="impact.html">Impact</a></li>
                    <li><a href="give.html">Give</a></li>
                </ul>
            </nav>
            <div class="header-button">
                <a href="#" target="_blank" class="btn">Log In</a>
            </div>
        </div>
    </header>

<<<<<<< HEAD:nextsteps.html
    <main>
        <!-- Hero Section -->
        <section class="hero">
=======
    <!-- Hero Section -->
    <section class="hero" style="margin-top: 80px;">
        <div class="container">
            <h2>Next Steps</h2>
            <h1>life-change begins with a next step.</h1>
        </div>
    </section>
    
    <!-- Growth Track Section -->
    <section class="section section-light">
        <div class="container">
            <div class="section-content reverse">
                <div class="section-image">
                    <div class="image-grid">
                        <div class="grid-image grid-image-1">
                            <img src="https://rrcedarcrest.wpengine.com/wp-content/uploads/2017/01/coworking-desk-learning-7093.jpg" alt="Growth Track">
                        </div>
                        <div class="grid-image grid-image-2">
                            <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-growth-01_1200x800.jpg" alt="Growth Track">
                        </div>
                        <div class="grid-image grid-image-3">
                            <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-growth-02_1200x800.jpg" alt="Growth Track">
                        </div>
                    </div>
                </div>
                
                <div class="section-text">
                    <div class="section-title">Growth Track</div>
                    <h2 class="section-heading">where you can discover the right next steps for you and your family.</h2>
                    <p>Growth Track is where you can discover your purpose and live the life you were created for! With three steps, Growth Track invites you in to a 3 week experience to learn about who we are as a church and how you can get involved!</p>
                    <a href="/growth-track/" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Baptism Section -->
    <section class="section section-dark">
        <div class="container">
            <div class="section-content">
                <div class="section-image">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-baptism_1200x800.jpg" alt="Baptism">
                </div>
                
                <div class="section-text">
                    <div class="section-title">Baptism</div>
                    <h2 class="section-heading">take your commitment to the next level.</h2>
                    <p>We believe that Baptism is the next best step you can take after you accept Jesus as your Savior! Baptism is a way to go public with your faith to show others that you commit to follow Jesus the rest of your life.</p>
                    <p>We would love to help you take your next step through believer's baptism! Fill out the form below to get the conversation started.</p>
                    <a href="https://cedarcrestchurch.ccbchurch.com/goto/forms/24/responses/new" target="_blank" class="btn btn-secondary">Adult/Student baptism</a>
                    <a href="https://cedarcrestchurch.ccbchurch.com/goto/forms/493/responses/new" target="_blank" class="btn btn-secondary">Kids baptism</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Small Groups Section -->
    <section class="section section-dark">
        <div class="container">
            <div class="section-content">
                <div class="section-image">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/connect-header_1920x1080.jpg" alt="Small Groups">
                </div>
                
                <div class="section-text">
                    <div class="section-title">Small Groups</div>
                    <h2 class="section-heading">let us help you find a place where you can grow.</h2>
                    <p>Small Groups are the backbone of Cedarcrest Church. We want people to do life together like Jesus did with his disciples. They went to weddings, they worked and they ate together. Small Group is where we grow in our faith, get encouraged, and create community.</p>
                    <a href="/groups" target="_blank" class="btn btn-secondary">register for a group</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Serve Team Section -->
    <section class="section section-light" id="serve">
        <div class="container">
            <div class="section-content reverse">
                <div class="section-image">
                    <div class="image-grid">
                        <div class="grid-image grid-image-1">
                            <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-serve-01_1200x800.jpg" alt="Serve Team">
                        </div>
                        <div class="grid-image grid-image-2">
                            <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/05/home-next-steps-02.jpg" alt="Serve Team">
                        </div>
                        <div class="grid-image grid-image-3">
                            <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-serve-02_1200x800.jpg" alt="Serve Team">
                        </div>
                    </div>
                </div>
                
                <div class="section-text">
                    <div class="section-title">Serve Team</div>
                    <h2 class="section-heading">one of the best ways to get connected is to serve.</h2>
                    <p>God calls us to build the local church. Regardless of your skillset or where you are on your journey, there is a place for you at Cedarcrest Church. We can't wait to have you on the team! The first step to serving at Cedarcrest is attending Growth Track! Click below to learn more and get registered!</p>
                    <a href="/growth-track" target="_blank" class="btn btn-primary">Get Connected</a>
                </div>
            </div>
            
            <!-- Service Areas -->
            <div class="services-grid">
                <div class="service-item">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M598.1 139.4C608.8 131.6 611.2 116.6 603.4 105.9C595.6 95.2 580.6 92.8 569.9 100.6L495.4 154.8L485.5 148.2C465.8 135 442.6 128 418.9 128L359.7 128L359.3 128L215.7 128C189 128 163.2 136.9 142.3 153.1L70.1 100.6C59.4 92.8 44.4 95.2 36.6 105.9C28.8 116.6 31.2 131.6 41.9 139.4L129.9 203.4C139.5 210.3 152.6 209.3 161 201L164.9 197.1C178.4 183.6 196.7 176 215.8 176L262.1 176L170.4 267.7C154.8 283.3 154.8 308.6 170.4 324.3L171.2 325.1C218 372 294 372 340.9 325.1L368 298L465.8 395.8C481.4 411.4 481.4 436.7 465.8 452.4L456 462.2L425 431.2C415.6 421.8 400.4 421.8 391.1 431.2C381.8 440.6 381.7 455.8 391.1 465.1L419.1 493.1C401.6 503.5 381.9 509.8 361.5 511.6L313 463C303.6 453.6 288.4 453.6 279.1 463C269.8 472.4 269.7 487.6 279.1 496.9L294.1 511.9L290.3 511.9C254.2 511.9 219.6 497.6 194.1 472.1L65 343C55.6 333.6 40.4 333.6 31.1 343C21.8 352.4 21.7 367.6 31.1 376.9L160.2 506.1C194.7 540.6 241.5 560 290.3 560L342.1 560L343.1 561L344.1 560L349.8 560C398.6 560 445.4 540.6 479.9 506.1L499.8 486.2C501 485 502.1 483.9 503.2 482.7C503.9 482.2 504.5 481.6 505.1 481L609 377C618.4 367.6 618.4 352.4 609 343.1C599.6 333.8 584.4 333.7 575.1 343.1L521.3 396.9C517.1 384.1 510 372 499.8 361.8L385 247C375.6 237.6 360.4 237.6 351.1 247L307 291.1C280.5 317.6 238.5 319.1 210.3 295.7L309 197C322.4 183.6 340.6 176 359.6 175.9L368.1 175.9L368.3 175.9L419.1 175.9C433.3 175.9 447.2 180.1 459 188L482.7 204C491.1 209.6 502 209.3 510.1 203.4L598.1 139.4z"/></svg>
                    </div>
                    <h3 class="service-title">Guest Services</h3>
                    <p>On the Guest Services Team, we know that everything speaks: from the cleanliness of the building, to the friendliness of the greeters, and to the clarity of the signage on the walls. We are the door-holders, mom-assisters, and guest-reassurers of Sunday mornings.</p>
                </div>
                
                <div class="service-item">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M376 88C376 57.1 350.9 32 320 32C289.1 32 264 57.1 264 88C264 118.9 289.1 144 320 144C350.9 144 376 118.9 376 88zM400 300.7L446.3 363.1C456.8 377.3 476.9 380.3 491.1 369.7C505.3 359.1 508.3 339.1 497.7 324.9L427.2 229.9C402 196 362.3 176 320 176C277.7 176 238 196 212.8 229.9L142.3 324.9C131.8 339.1 134.7 359.1 148.9 369.7C163.1 380.3 183.1 377.3 193.7 363.1L240 300.7L240 576C240 593.7 254.3 608 272 608C289.7 608 304 593.7 304 576L304 416C304 407.2 311.2 400 320 400C328.8 400 336 407.2 336 416L336 576C336 593.7 350.3 608 368 608C385.7 608 400 593.7 400 576L400 300.7z"/></svg>
                    </div>
                    <h3 class="service-title">Cedarcrest Kids</h3>
                    <p>Cedarcrest Kids exists to provide a dynamic and FUN environment where kids can encounter Jesus, be discipled, and learn to live on mission. Our Team Members are KEY in making this happen! Every Sunday, you'll see our Team Members arriving ready to serve.</p>
                </div>
                
                <div class="service-item">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M528 320C528 205.1 434.9 112 320 112C205.1 112 112 205.1 112 320C112 434.9 205.1 528 320 528C434.9 528 528 434.9 528 320zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM241.3 383.4C256.3 399 282.4 416 320 416C357.6 416 383.7 399 398.7 383.4C407.9 373.8 423.1 373.5 432.6 382.7C442.1 391.9 442.5 407.1 433.3 416.6C411.2 439.6 373.3 464 320 464C266.7 464 228.8 439.6 206.7 416.6C197.5 407 197.8 391.8 207.4 382.7C217 373.6 232.2 373.8 241.3 383.4zM208 272C208 254.3 222.3 240 240 240C257.7 240 272 254.3 272 272C272 289.7 257.7 304 240 304C222.3 304 208 289.7 208 272zM372 280C372 291 363 300 352 300C341 300 332 291 332 280C332 246.9 358.9 220 392 220L408 220C441.1 220 468 246.9 468 280C468 291 459 300 448 300C437 300 428 291 428 280C428 269 419 260 408 260L392 260C381 260 372 269 372 280z"/></svg>
                    </div>
                    <h3 class="service-title">Cedarcrest Students</h3>
                    <p>We believe God is moving in the next generation. In Cedarcrest Students, we want to provide a place for middle and high school students to have fun, find community, and encounter Jesus in the most transformative years of their lives.</p>
                </div>
                
                <div class="service-item">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M96 160C96 124.7 124.7 96 160 96L480 96C515.3 96 544 124.7 544 160L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 160zM144 432L144 464C144 472.8 151.2 480 160 480L192 480C200.8 480 208 472.8 208 464L208 432C208 423.2 200.8 416 192 416L160 416C151.2 416 144 423.2 144 432zM448 416C439.2 416 432 423.2 432 432L432 464C432 472.8 439.2 480 448 480L480 480C488.8 480 496 472.8 496 464L496 432C496 423.2 488.8 416 480 416L448 416zM144 304L144 336C144 344.8 151.2 352 160 352L192 352C200.8 352 208 344.8 208 336L208 304C208 295.2 200.8 288 192 288L160 288C151.2 288 144 295.2 144 304zM448 288C439.2 288 432 295.2 432 304L432 336C432 344.8 439.2 352 448 352L480 352C488.8 352 496 344.8 496 336L496 304C496 295.2 488.8 288 480 288L448 288zM144 176L144 208C144 216.8 151.2 224 160 224L192 224C200.8 224 208 216.8 208 208L208 176C208 167.2 200.8 160 192 160L160 160C151.2 160 144 167.2 144 176zM448 160C439.2 160 432 167.2 432 176L432 208C432 216.8 439.2 224 448 224L480 224C488.8 224 496 216.8 496 208L496 176C496 167.2 488.8 160 480 160L448 160z"/></svg>
                    </div>
                    <h3 class="service-title">Production</h3>
                    <p>The production team has the opportunity to create a unique worship experience for not only in person attenders, but our online community as well. You can find our production team members leading worship through running cameras, lights, sound, slides, and more!</p>
                </div>
                
                <div class="service-item">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M224 360C224 373.3 213.3 384 200 384C186.7 384 176 373.3 176 360L176 247.4L264.2 127.7C277.3 109.9 273.5 84.9 255.7 71.8C237.9 58.7 212.9 62.5 199.8 80.3L106.5 206.9C89.3 230.2 80 258.5 80 287.6L80 398.3L21.9 417.7C8.8 422 0 434.2 0 448L0 544C0 554 4.7 563.5 12.7 569.5C20.7 575.5 31.1 577.5 40.8 574.7L195.2 530.6C250.2 514.9 288 464.7 288 407.5L288 288C288 270.3 273.7 256 256 256C238.3 256 224 270.3 224 288L224 360zM416 360L416 288C416 270.3 401.7 256 384 256C366.3 256 352 270.3 352 288L352 407.6C352 464.8 389.9 515 444.8 530.7L599.2 574.8C608.9 577.6 619.2 575.6 627.3 569.6C635.4 563.6 640 554 640 544L640 448C640 434.2 631.2 422 618.1 417.6L560 398.2L560 287.5C560 258.5 550.7 230.2 533.5 206.8L440.2 80.3C427.1 62.5 402.1 58.7 384.3 71.8C366.5 84.9 362.7 109.9 375.8 127.7L464 247.4L464 360C464 373.3 453.3 384 440 384C426.7 384 416 373.3 416 360z"/></svg>
                    </div>
                    <h3 class="service-title">Worship</h3>
                    <p>The Cedarcrest worship team exists to create a distraction free environment that allows people to have an encounter with the living God. We sing and play songs about who Jesus is, what He's done and what He will do in and through us.</p>
                </div>
                
                <div class="service-item">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M96 192C96 130.1 146.1 80 208 80C269.9 80 320 130.1 320 192C320 253.9 269.9 304 208 304C146.1 304 96 253.9 96 192zM32 528C32 430.8 110.8 352 208 352C305.2 352 384 430.8 384 528L384 534C384 557.2 365.2 576 342 576L74 576C50.8 576 32 557.2 32 534L32 528zM464 128C517 128 560 171 560 224C560 277 517 320 464 320C411 320 368 277 368 224C368 171 411 128 464 128zM464 368C543.5 368 608 432.5 608 512L608 534.4C608 557.4 589.4 576 566.4 576L421.6 576C428.2 563.5 432 549.2 432 534L432 528C432 476.5 414.6 429.1 385.5 391.3C408.1 376.6 435.1 368 464 368z"/></svg>
                    </div>
                    <h3 class="service-title">Legacy Team</h3>
                    <p>For those who have the gift of generosity, you're invited to serve on the legacy team. Legacy Team members are committed to strategically invest their financial resources over and above the tithe to accelerate the vision of Cedarcrest Church.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Impact Teams Section -->
    <section class="section section-dark" id="impact">
        <div class="container">
            <div class="section-content">
                <div class="section-image">
                    <img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/sendrelief.jpeg" alt="Impact Teams">
                </div>
                
                <div class="section-text">
                    <div class="section-title">Impact Teams</div>
                    <h2 class="section-heading">loving God and loving people.</h2>
                    <p>We desire to be a Jesus church. We are able to be the hands and feet of Jesus locally and globally because of the faithful giving of our local church.</p>
                    <a href="/impact/" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
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
>>>>>>> c75c0b7f9c1042bfc91e63391b95b8b64a9a2f7f:nextsteps.php
            <div class="container">
                <h2>Next Steps</h2>
                <h1>life-change begins with a next step.</h1>
            </div>
        </section>
        
        <!-- Growth Track Section -->
        <section class="section section-light">
            <div class="container">
                <div class="section-content reverse">
                    <div class="section-image">
                        <div class="image-grid">
                            <div class="grid-image grid-image-1"><img src="https://rrcedarcrest.wpengine.com/wp-content/uploads/2017/01/coworking-desk-learning-7093.jpg" alt="Growth Track"></div>
                            <div class="grid-image grid-image-2"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-growth-01_1200x800.jpg" alt="Growth Track"></div>
                            <div class="grid-image grid-image-3"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-growth-02_1200x800.jpg" alt="Growth Track"></div>
                        </div>
                    </div>
                    <div class="section-text">
                        <div class="section-title">Growth Track</div>
                        <h2 class="section-heading">where you can discover the right next steps for you and your family.</h2>
                        <p>Growth Track is where you can discover your purpose and live the life you were created for! With three steps, Growth Track invites you in to a 3 week experience to learn about who we are as a church and how you can get involved!</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Baptism Section -->
        <section class="section section-dark">
            <div class="container">
                <div class="section-content">
                    <div class="section-image"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-baptism_1200x800.jpg" alt="Baptism"></div>
                    <div class="section-text">
                        <div class="section-title">Baptism</div>
                        <h2 class="section-heading">take your commitment to the next level.</h2>
                        <p>We believe that Baptism is the next best step you can take after you accept Jesus as your Savior! Baptism is a way to go public with your faith to show others that you commit to follow Jesus the rest of your life.</p>
                        <p>We would love to help you take your next step through believer's baptism! Fill out the form below to get the conversation started.</p>
                        <a href="#" target="_blank" class="btn btn-secondary">Adult/Student baptism</a>
                        <a href="#" target="_blank" class="btn btn-secondary">Kids baptism</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Small Groups Section -->
        <section class="section section-dark">
            <div class="container">
                <div class="section-content reverse">
                    <div class="section-image"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/connect-header_1920x1080.jpg" alt="Small Groups"></div>
                    <div class="section-text">
                        <div class="section-title">Small Groups</div>
                        <h2 class="section-heading">let us help you find a place where you can grow.</h2>
                        <p>Small Groups are the backbone of our Church. We want people to do life together like Jesus did with his disciples. They went to weddings, they worked and they ate together. Small Group is where we grow in our faith, get encouraged, and create community.</p>
                        <a href="#" target="_blank" class="btn btn-secondary">register for a group</a>
                    </div>
                </div>
            </section>
        
        <!-- Serve Team Section -->
        <section class="section section-light" id="serve">
            <div class="container">
                <div class="section-content">
                    <div class="section-image">
                        <div class="image-grid">
                            <div class="grid-image grid-image-1"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-serve-01_1200x800.jpg" alt="Serve Team"></div>
                            <div class="grid-image grid-image-2"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/05/home-next-steps-02.jpg" alt="Serve Team"></div>
                            <div class="grid-image grid-image-3"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/next-serve-02_1200x800.jpg" alt="Serve Team"></div>
                        </div>
                    </div>
                    <div class="section-text">
                        <div class="section-title">Serve Team</div>
                        <h2 class="section-heading">one of the best ways to get connected is to serve.</h2>
                        <p>God calls us to build the local church. Regardless of your skillset or where you are on your journey, there is a place for you at our Church. We can't wait to have you on the team! The first step to serving is attending Growth Track! Click below to learn more and get registered!</p>
                        <a href="#" target="_blank" class="btn btn-primary">Get Connected</a>
                    </div>
                </div>
                
                <div class="services-grid">
                    <div class="service-item"><div class="service-icon"><i class="fa fa-handshake-o"></i></div><h3 class="service-title">Guest Services</h3><p>On the Guest Services Team, we know that everything speaks: from the cleanliness of the building, to the friendliness of the greeters, and to the clarity of the signage on the walls.</p></div>
                    <div class="service-item"><div class="service-icon"><i class="fa fa-child"></i></div><h3 class="service-title">Kids</h3><p>Our Kids ministry exists to provide a dynamic and FUN environment where kids can encounter Jesus, be discipled, and learn to live on mission. Our Team Members are KEY in making this happen!</p></div>
                    <div class="service-item"><div class="service-icon"><i class="fa fa-users"></i></div><h3 class="service-title">Students</h3><p>We believe God is moving in the next generation. We want to provide a place for middle and high school students to have fun, find community, and encounter Jesus in the most transformative years of their lives.</p></div>
                    <div class="service-item"><div class="service-icon"><i class="fa fa-cogs"></i></div><h3 class="service-title">Production</h3><p>The production team has the opportunity to create a unique worship experience for not only in person attenders, but our online community as well.</p></div>
                    <div class="service-item"><div class="service-icon"><i class="fa fa-music"></i></div><h3 class="service-title">Worship</h3><p>The worship team exists to create a distraction free environment that allows people to have an encounter with the living God.</p></div>
                    <div class="service-item"><div class="service-icon"><i class="fa fa-heart"></i></div><h3 class="service-title">Legacy Team</h3><p>For those who have the gift of generosity, you're invited to serve on the legacy team. Legacy Team members are committed to strategically invest their financial resources over and above the tithe.</p></div>
                </div>
            </div>
        </section>
        
        <section class="section section-dark" id="impact">
            <div class="container">
                <div class="section-content">
                    <div class="section-image"><img src="https://cedarcrestchurch.com/wp-content/uploads/2022/07/sendrelief.jpeg" alt="Impact Teams"></div>
                    <div class="section-text">
                        <div class="section-title">Impact Teams</div>
                        <h2 class="section-heading">loving God and loving people.</h2>
                        <p>We desire to be a Jesus church. We are able to be the hands and feet of Jesus locally and globally because of the faithful giving of our local church.</p>
                        <a href="/impact/" class="btn btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- START: RECREATED FOOTER -->
    <footer class="x-colophon" role="contentinfo">
        <div class="x-bar-top-content"><div class="container"><div class="footer-row-inner"><div class="footer-col"><h4>Manifestation Outreach</h4><p>OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA</p></div><div class="footer-col"><h4>Quick Links</h4><ul><li><a href="index.html">Church Home</a></li><li><a href="about.html">About Us</a></li><li><a href="events.html">All Events</a></li><li><a href="sermons.html">Sermons Archive</a></li></ul></div><div class="footer-col"><h4>Next Steps</h4><ul><li><a href="#">Growth Track</a></li><li><a href="#">Small Groups</a></li><li><a href="#">Discipleship School</a></li></ul></div><div class="footer-col"><h4>Connect With Us</h4><ul><li><a href="#">Contact Us</a></li><li><a href="#">Jobs</a></li><li><a href="#">Newsletter</a></li></ul></div></div></div></div>
        <div class="x-bar-middle-logo"><div class="container"><div class="footer-bar-content"><hr class="x-line"><img src="images/logo-white.png" alt="Footer Logo"><hr class="x-line"></div></div></div>
        <div class="x-bar-bottom-bar"><div class="container"><div class="footer-bottom-container"><div class="footer-copyright"><p>&copy; <script>document.write(new Date().getFullYear());</script> Manifestation. All Rights Reserved</p></div><div class="footer-social-links"><a href="#">FACEBOOK</a><a href="#">INSTAGRAM</a><a href="#">YOUTUBE</a><a href="#">NEWSLETTER</a></div></div></div></div>
    </footer>
    <!-- END: RECREATED FOOTER -->
    
    <div class="scroll-top"><i class="fa fa-arrow-up"></i></div>
    
    <script>
        const header = document.getElementById('site-header');
        const scrollTopBtn = document.querySelector('.scroll-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) { header.classList.add('scrolled'); } else { header.classList.remove('scrolled'); }
            if (window.scrollY > 500) { scrollTopBtn.classList.add('active'); } else { scrollTopBtn.classList.remove('active'); }
        }, { passive: true });
        if (window.scrollY > 50) header.classList.add('scrolled');
        if (window.scrollY > 500) scrollTopBtn.classList.add('active');
        scrollTopBtn.addEventListener('click', () => { window.scrollTo({ top: 0, behavior: 'smooth' }); });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.section, .grid-image, .service-item').forEach(el => { observer.observe(el); });
    </script>
</body>
</html>