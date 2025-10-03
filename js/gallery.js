

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const galleryId = Number(urlParams.get('gallery')) || 1;

  // Highlight the active pagination button
  const paginationLinks = document.querySelectorAll('.pagination li a');
  paginationLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href && href.includes('gallery=')) {
      const pageNum = Number(new URLSearchParams(href.split('?')[1]).get('gallery'));
      if (pageNum === galleryId) {
        link.parentElement.classList.add('active');
      } else {
        link.parentElement.classList.remove('active');
      }
    }
  });
});