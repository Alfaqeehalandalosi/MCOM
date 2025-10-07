document.addEventListener("DOMContentLoaded", function() {
    const loadComponent = (url, placeholderId, callback) => {
        const placeholder = document.getElementById(placeholderId);
        if (placeholder) {
            fetch(url)
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error(`Could not load ${url}. File not found.`);
                })
                .then(data => {
                    placeholder.outerHTML = data;
                    if (callback) callback(); // Run callback after loading
                })
                .catch(error => {
                    console.error(error);
                    placeholder.innerHTML = `<p style="color:red; text-align:center; padding: 20px;">Error: Could not load ${placeholderId.replace('-placeholder','')}. Ensure ${url} exists.</p>`;
                });
        }
    };

    // Load Header, then initialize its script
    loadComponent('header.html', 'header-placeholder', () => {
        const header = document.getElementById('site-header');
        if (!header) return;

        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Check on load
    });

    // Load Footer
    loadComponent('footer.html', 'footer-placeholder');
});