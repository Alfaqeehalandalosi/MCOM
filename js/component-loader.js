// js/component-loader.js
(function() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';

    const headerHTML = `
        <header class="site-header" id="site-header">
            <div class="container header-content">
                <a href="index.html" class="header-logo"><img src="images/logo-white.png" alt="Manifestation Outreach Logo"></a>
                <nav class="navigation">
                    <ul class="sf-menu">
                        <li${currentPage === 'about.html' ? ' class="current-menu-item"' : ''}><a href="about.html">About</a></li>
                        <li${currentPage === 'connect.html' ? ' class="current-menu-item"' : ''}><a href="connect.html">Connect</a></li>
                        <li${currentPage === 'nextsteps.html' ? ' class="current-menu-item"' : ''}><a href="nextsteps.html">Next Steps</a></li>
                        <li${currentPage === 'events.html' ? ' class="current-menu-item"' : ''}><a href="events.html">Events</a></li>
                        <li${currentPage === 'sermons.html' ? ' class="current-menu-item"' : ''}><a href="sermons.html">Sermons</a></li>
                        <li${currentPage === 'impact.html' ? ' class="current-menu-item"' : ''}><a href="impact.html">Impact</a></li>
                        <li${currentPage === 'give.html' ? ' class="current-menu-item"' : ''}><a href="give.html">Give</a></li>
                    </ul>
                </nav>
                <div class="header-button">
                    <a href="#" class="btn">Log In</a>
                </div>
            </div>
        </header>
    `;

    const footerHTML = `
        <style>
            .x-colophon {
                font-family: "Open Sans", sans-serif;
                background-color: #000;
                color: #fff;
            }
            .x-colophon a {
                text-decoration: none;
                color: #fff;
            }
            .x-colophon a:hover {
                color: #bbb;
            }
            .x-bar {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                padding: 0 2.5em;
            }
            .x-bar-content {
                width: 100%;
                max-width: 1200px;
                display: flex;
                align-items: center;
            }
            .x-bar[data-x-bar*='"height":"150px"'] { padding: 50px 2.5em; }
            .x-bar[data-x-bar*='"height":"65px"'] { height: 65px; }
            .x-bar[data-x-bar*='"height":"40px"'] { height: 40px; }

            .x-bar-content-top-1, .x-bar-content-top-2 {
                display: flex;
                width: 100%;
                justify-content: center;
            }
            .x-bar-content-top-2 {
                border-top: 1px solid #333;
                margin-top: 2em;
                padding-top: 2em;
            }
            .x-row-inner {
                display: flex;
                justify-content: space-between;
                width: 100%;
                gap: 2em;
            }
            .x-col {
                display: flex;
                flex-direction: column;
                gap: 0.5em;
            }
            .x-text, .x-anchor-menu-item {
                font-size: 11px;
                letter-spacing: 0.1em;
                line-height: 1.6;
                text-transform: uppercase;
                font-weight: 400;
            }
            .x-text-content-text-primary {
                margin: 0;
            }
            .x-text.e508-e5, .x-text.e508-e8, .x-menu .menu-item:first-child .x-anchor-text-primary {
                font-weight: 700;
            }
            .x-menu { list-style: none; margin: 0; padding: 0; }
            .x-menu li { padding-bottom: 0.5em; }
            .x-anchor-sub-indicator { display: none; }

            .x-bar-middle .x-bar-content { position: relative; }
            .x-bar-middle .x-line { flex: 1; border: 0; border-top: 1px solid #333; }
            .x-bar-middle .x-image { margin: 0 2em; }
            .x-bar-middle .x-image img {
                height: 50px; /* Large logo */
                border-radius: 50%;
                border: 1px solid #fff;
            }
            .x-bar-middle::before {
                content: '';
                position: absolute;
                bottom: 50%;
                left: 50%;
                transform: translateX(-50%);
                width: 1px;
                height: 80px; /* Vertical line height */
                background: #333;
            }

            .x-bar-bottom .x-bar-content {
                justify-content: space-between;
            }
            .x-bar-bottom-left, .x-bar-bottom-right {
                display: flex;
                align-items: center;
                gap: 1.5em;
                font-size: 10px;
            }
            .x-bar-bottom-right a {
                letter-spacing: 0.2em;
            }
            .x-to-top {
                width: 30px; height: 30px; border-radius: 50%; border: 1px solid #888;
                display: flex; align-items: center; justify-content: center;
            }
            @media (max-width: 979px) {
                .x-row-inner { flex-direction: column; text-align: center; align-items: center; gap: 2em; }
                .x-col { align-items: center; }
                .x-bar[data-x-bar*='"height":"150px"'] { height: auto !important; }
                .x-bar-middle::before { display: none; }
            }
            @media (max-width: 767px) {
                .x-bar-bottom .x-bar-content { flex-direction: column-reverse; gap: 1.5em; height: auto !important; padding: 2em 0; }
            }
        </style>
        
        <footer class="x-colophon" role="contentinfo">
            <div class="x-bar x-bar-footer" data-x-bar='{"id":"e508-e1","region":"footer","height":"150px"}'>
                <div class="x-bar-content x-bar-top-content">
                    <div class="x-container x-bar-content-top-1">
                        <div class="x-row-inner">
                            <div class="x-col">
                                <a href="#" class="x-text e508-e5"><div class="x-text-content"><p class="x-text-content-text-primary">Manifestation Outreach</p></div></a>
                                <a href="#" class="x-text"><div class="x-text-content"><p class="x-text-content-text-primary">OFF AKINJAGUNLA, AGIODO-OJOJO ROAD<br>ONDO TOWN, NIGERIA</p></div></a>
                            </div>
                            <div class="x-col">
                                <div class="x-text e508-e8"><p class="x-text-content-text-primary">Sundays at 8 AM, 9:30 AM, and 11 AM</p></div>
                                <a href="tel:2345554603500" class="x-text"><div class="x-text-content"><p class="x-text-content-text-primary">(234) 555-460-3500</p></div></a>
                                <a href="mailto:info@manifestationoutreach.com" class="x-text"><div class="x-text-content"><p class="x-text-content-text-primary">info@manifestationoutreach.com</p></div></a>
                            </div>
                        </div>
                    </div>
                    <div class="x-container x-bar-content-top-2">
                        <div class="x-row-inner">
                            <div class="x-col">
                                <ul class="x-menu">
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="about.html"><span class="x-anchor-text-primary">New Here?</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="connect.html"><span class="x-anchor-text-primary">Kids</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="connect.html"><span class="x-anchor-text-primary">Students</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="#"><span class="x-anchor-text-primary">Jobs</span></a></li>
                                </ul>
                            </div>
                            <div class="x-col">
                                <ul class="x-menu">
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="nextsteps.html"><span class="x-anchor-text-primary">Growth Track</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="nextsteps.html"><span class="x-anchor-text-primary">Small Groups</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="nextsteps.html"><span class="x-anchor-text-primary">Discipleship School</span></a></li>
                                </ul>
                            </div>
                            <div class="x-col">
                                <ul class="x-menu">
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="sermons.html"><span class="x-anchor-text-primary">Watch</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="sermons.html"><span class="x-anchor-text-primary">Sermons</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="events.html"><span class="x-anchor-text-primary">Calendar</span></a></li>
                                    <li class="menu-item"><a class="x-anchor x-anchor-menu-item" href="#"><span class="x-anchor-text-primary">Church Portal Login</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="x-bar x-bar-footer x-bar-middle" data-x-bar='{"id":"e508-e22","region":"footer","height":"65px"}'>
                <div class="x-bar-content">
                    <hr class="x-line">
                    <a class="x-image" href="index.html"><img src="images/logo-white.png" alt="Logo"></a>
                    <hr class="x-line">
                </div>
            </div>
            <div class="x-bar x-bar-footer x-bar-bottom" data-x-bar='{"id":"e508-e27","region":"footer","height":"40px"}'>
                <div class="x-bar-content">
                    <div class="x-bar-bottom-left">
                        <a href="#" class="x-text"><p class="x-text-content-text-primary">Made with love by REACHRIGHT</p></a>
                    </div>
                    <div class="x-bar-bottom-right">
                        <a href="#" class="x-text">FACEBOOK</a>
                        <a href="#" class="x-text">INSTAGRAM</a>
                        <a href="#" class="x-text">YOUTUBE</a>
                        <a href="#" class="x-text">NEWSLETTER</a>
                        <a href="#" class="x-to-top">↑</a>
                    </div>
                </div>
            </div>
        </footer>
    `;

    // Find the placeholder elements in the document
    const headerContainer = document.getElementById('header-container');
    const footerContainer = document.getElementById('footer-container');

    // Inject the HTML components into their placeholders
    if (headerContainer) {
        headerContainer.innerHTML = headerHTML;
    }
    if (footerContainer) {
        footerContainer.innerHTML = footerHTML;
    }

    // --- Unified Header Scroll Behavior ---
    const header = document.getElementById('site-header');
    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }
})();