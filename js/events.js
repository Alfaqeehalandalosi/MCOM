const events = {
  1: [
    {
      link: "event.html?id=1",
      title: "Morning Prayer",
      description: "Paragraph 1",
      time: " Monday | 7:00 AM - 1:00 PM",
      address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    },
    {
      link: "event.html?id=2",
      title: "Morning Prayer",
      description: "Paragraph 1",
      time: " Monday | 7:00 AM - 1:00 PM",
      address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    },
    {
      link: "event.html?id=3",
      title: "Morning Prayer",
      description: "Paragraph 1",
      time: " Monday | 7:00 AM - 1:00 PM",
      address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    },
    {
      link: "event.html?id=4",
      title: "Morning Prayer",
      description: "Paragraph 1",
      time: " Monday | 7:00 AM - 1:00 PM",
      address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    },
    {
      link: "event.html?id=5",
      title: "Morning Prayer",
      description: "Paragraph 1",
      time: " Monday | 7:00 AM - 1:00 PM",
      address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    },
    {
      link: "event.html?id=6",
      title: "Morning Prayer",
      description: "Paragraph 1",
      time: " Monday | 7:00 AM - 1:00 PM",
      address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    },
  ],
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const eventId = Number(urlParams.get('events')) || 1;
  const eventList = events[eventId] || [];

  const eventsListDiv = document.getElementById('events-list');
  if (!eventsListDiv) return;

  eventsListDiv.innerHTML = `
    <ul class="grid-holder col-3 events-grid">
      ${eventList.map(event => `
        <li class="grid-item format-standard">
          <div class="grid-item-inner">
            <a href="${event.link}" class="media-box">
              <img src="http://placehold.it/600x600&amp;text=IMAGE+PLACEHOLDER" alt="">
            </a>
            <div class="grid-content">
              <h3><a href="${event.link}">${event.title}</a></h3>
              <p>${event.description}</p>
            </div>
            <ul class="info-table">
              <li><i class="fa fa-calendar"></i>${event.time}</li>
              <li><i class="fa fa-map-marker"></i>${event.address}</li>
            </ul>
          </div>
        </li>
      `).join('')}
    </ul>
  `;

  // Highlight the active pagination button
  const paginationLinks = document.querySelectorAll('.pagination li a');
  paginationLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href && href.includes('events=')) {
      const pageNum = Number(new URLSearchParams(href.split('?')[1]).get('events'));
      if (pageNum === eventId) {
        link.parentElement.classList.add('active');
      } else {
        link.parentElement.classList.remove('active');
      }
    }
  });
});