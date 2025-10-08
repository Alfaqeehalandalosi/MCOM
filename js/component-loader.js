// js/component-loader.js
(function() {
    // Determine the current page to highlight the active navigation link
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';

    // --- Reusable Header HTML Component ---
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

    // --- Reusable Footer HTML Component ---
    const footerHTML = `
        <footer class="x-colophon" role="contentinfo">
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
                                <li><a href="nextsteps.html">Growth Track</a></li>
                                <li><a href="nextsteps.html">Small Groups</a></li>
                                <li><a href="nextsteps.html">Discipleship School</a></li>
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
                    </div>
                </div>
            </div>
            <div class="x-bar-middle-logo">
                <div class="container">
                    <div class="footer-bar-content">
                        <hr class="x-line">
                        <img src="images/logo-white.png" alt="Footer Logo">
                        <hr class="x-line">
                    </div>
                </div>
            </div>
            <div class="x-bar-bottom-bar">
                <div class="container">
                    <div class="footer-bottom-container">
                        <div class="footer-copyright">
                            <p>&copy; ${new Date().getFullYear()} Manifestation. All Rights Reserved</p>
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