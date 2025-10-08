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
                background-color: #000;
                color: #fff;
                font-family: 'Open Sans', sans-serif;
            }
            .x-bar {
                padding: 35px 2.5em;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .x-bar-content {
                width: 100%;
                max-width: 1200px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .x-bar-top-row, .x-bar-links-row {
                width: 100%;
                display: flex;
                justify-content: center;
            }
            .x-bar-links-row {
                padding-top: 2em;
                border-top: 1px solid #2c2c2c;
                margin-top: 2em;
            }
            .x-row-inner {
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
            .x-col {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 1em;
            }
            .x-col .x-text, .x-col .x-anchor-menu-item {
                font-size: 11px;
                font-weight: 300;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                text-decoration: none;
                color: #fff;
                line-height: 1.6;
            }
            .x-col .x-text p { margin: 0; }
            .x-col .x-text:first-child p, .x-col .x-anchor-menu-item:first-child {
                font-weight: 700;
            }
            .x-col .x-anchor-menu-item {
                padding: 0;
            }
            .x-col ul {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                gap: 1em;
            }
            .x-bar-middle {
                height: 65px;
                padding: 0 2.5em;
            }
            .x-bar-middle .x-bar-content {
                flex-direction: row;
                position: relative;
            }
            .x-bar-middle .x-line {
                flex-grow: 1;
                border: 0;
                border-top: 1px solid #2c2c2c;
            }
            .x-bar-middle .x-image {
                margin: 0 2em;
                height: 45px;
                width: 45px;
                border: 1px solid #fff;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .x-bar-middle .x-image img {
                height: 35px;
                width: auto;
            }
            .x-bar-middle::before {
                content: '';
                position: absolute;
                top: -30px; /* Pulls the line up into the section above */
                left: 50%;
                transform: translateX(-50%);
                height: 30px;
                width: 1px;
                background-color: #2c2c2c;
            }
            .x-bar-bottom {
                height: 40px;
                padding: 0 2.5em;
            }
            .x-bar-bottom .x-bar-content {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                font-size: 10px;
            }
            .x-bar-bottom .x-socials a {
                margin: 0 1em;
                letter-spacing: 0.2em;
            }
            .x-bar-bottom .x-to-top {
                width: 30px; height: 30px;
                border: 1px solid #888;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            @media(max-width: 979px) {
                .x-row-inner { flex-direction: column; align-items: center; text-align: center; gap: 2em; }
                .x-col { align-items: center; }
            }
        </style>

        <footer class="x-colophon" role="contentinfo">
            <div class="x-bar x-bar-top">
                <div class="x-bar-content">
                    <div class="x-bar-top-row">
                        <div class="x-row-inner">
                            <div class="x-col">
                                <div class="x-text"><p>Manifestation Outreach</p></div>
                                <div class="x-text"><p>OFF AKINJAGUNLA, AGIODO-OJOJO ROAD,<br>ONDO TOWN, NIGERIA</p></div>
                            </div>
                            <div class="x-col">
                                <div class="x-text"><p>Sundays at 8 AM, 9:30 AM, and 11 AM</p></div>
                                <div class="x-text"><p>(234) 555-460-3500</p></div>
                                <div class="x-text"><p>info@manifestationoutreach.com</p></div>
                            </div>
                            <div class="x-col">
                                <ul>
                                    <li><a class="x-anchor-menu-item" href="about.html">New Here?</a></li>
                                    <li><a class="x-anchor-menu-item" href="connect.html">Kids</a></li>
                                    <li><a class="x-anchor-menu-item" href="connect.html">Students</a></li>
                                    <li><a class="x-anchor-menu-item" href="#">Jobs</a></li>
                                </ul>
                            </div>
                            <div class="x-col">
                                <ul>
                                    <li><a class="x-anchor-menu-item" href="nextsteps.html">Growth Track</a></li>
                                    <li><a class="x-anchor-menu-item" href="nextsteps.html">Small Groups</a></li>
                                    <li><a class="x-anchor-menu-item" href="nextsteps.html">Discipleship School</a></li>
                                </ul>
                            </div>
                            <div class="x-col">
                                <ul>
                                    <li><a class="x-anchor-menu-item" href="sermons.html">Watch</a></li>
                                    <li><a class="x-anchor-menu-item" href="sermons.html">Sermons</a></li>
                                    <li><a class="x-anchor-menu-item" href="events.html">Calendar</a></li>
                                    <li><a class="x-anchor-menu-item" href="#">Church Portal Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="x-bar x-bar-middle">
                <div class="x-bar-content">
                    <hr class="x-line">
                    <a class="x-image" href="index.html"><img src="images/logo-white.png" alt="Logo"></a>
                    <hr class="x-line">
                </div>
            </div>
            <div class="x-bar x-bar-bottom">
                <div class="x-bar-content">
                    <div class="x-text"><p>Made with love by REACHRIGHT</p></div>
                    <div class="x-socials">
                        <a href="#">FACEBOOK</a>
                        <a href="#">INSTAGRAM</a>
                        <a href="#">YOUTUBE</a>
                        <a href="#">NEWSLETTER</a>
                    </div>
                    <a href="#" class="x-to-top">↑</a>
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
        
        // Add event listener
        window.addEventListener('scroll', handleScroll, { passive: true });
        
        // Check scroll position on page load in case the page is reloaded mid-scroll
        handleScroll();
    }
})();