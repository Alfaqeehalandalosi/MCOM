// header-loader.js — fetches canonical header and injects it into the page
(function(){
  function initHeader(html){
    try{
      var existing = document.querySelector('header.site-header');
      if(existing){
        // Replace existing header but preserve its id
        var parent = existing.parentNode;
        var wrapper = document.createElement('div');
        wrapper.innerHTML = html;
        parent.replaceChild(wrapper.firstElementChild, existing);
      } else {
        // Insert at top of body
        document.body.insertAdjacentHTML('afterbegin', html);
      }
      // initialize scroll toggling
      var header = document.getElementById('site-header');
      if(!header) header = document.querySelector('header.site-header');
      if(!header) console.warn('header-loader: inserted header not found in DOM after inject');
      else {
        // Force positioning and a high z-index to avoid being hidden by legacy markup
        try{
          header.style.position = header.style.position || 'fixed';
          header.style.top = header.style.top || '0';
          header.style.left = header.style.left || '0';
          header.style.width = header.style.width || '100%';
          header.style.zIndex = '100000';
        }catch(e){}
      }
      // mark active nav item based on current path
      try{
        var links = header.querySelectorAll('nav a');
        var path = window.location.pathname.split('/').pop() || 'index.html';
        links.forEach(function(a){
          var href = a.getAttribute('href');
          if(!href) return;
          var hrefPage = href.split('/').pop();
          if(hrefPage === path) {
            a.classList.add('active');
            a.setAttribute('aria-current','page');
          }
        });
      }catch(e){}
      function update(){
        if(window.scrollY > 50) header.classList.add('scrolled'); else header.classList.remove('scrolled');
      }
      update();
      window.addEventListener('scroll', update, {passive:true});
      // small visibility diagnostic
      setTimeout(function(){
        try{
          if(header && header.offsetHeight === 0) console.warn('header-loader: header exists but has zero height — check CSS that may hide or set display:none');
        }catch(e){}
      }, 250);
    }catch(e){ console.error('header-loader init error', e); }
  }

  // fetch header markup
  document.addEventListener('DOMContentLoaded', function(){
    fetch('assets/header.html', {cache: 'no-store'}).then(function(r){
      if(!r.ok) throw new Error('failed to fetch header');
      return r.text();
    }).then(function(html){ initHeader(html); }).catch(function(err){ console.error('Could not load header:', err); });
  });
})();
