const event = {
  1: {
    title: "Monday Prayer",
    print: "#",
    contact: "#",
    share: "#",
    image: "#",
    date: " Monday | 6th March, 2025",
    time: " 7:00 AM - 1:00 PM",
    address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    number: " +234 803 419 8048",
    attendants: "14",
    members: "4",
    description: "Paragraph 1",
    caption: "Paragraph 2",
  },
  2: {
    title: "Monday Prayer",
    print: "#",
    contact: "#",
    share: "#",
    image: "#",
    date: " Monday | 6th March, 2025",
    time: " 7:00 AM - 1:00 PM",
    address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    number: " +234 803 419 8048",
    attendants: "14",
    members: "4",
    description: "Paragraph 1",
    caption: "Paragraph 2",
  },
  3: {
    title: "Monday Prayer",
    print: "#",
    contact: "#",
    share: "#",
    image: "#",
    date: " Monday | 6th March, 2025",
    time: " 7:00 AM - 1:00 PM",
    address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    number: " +234 803 419 8048",
    attendants: "14",
    members: "4",
    description: "Paragraph 1",
    caption: "Paragraph 2",
  },
  4: {
    title: "Monday Prayer",
    print: "#",
    contact: "#",
    share: "#",
    image: "#",
    date: " Monday | 6th March, 2025",
    time: " 7:00 AM - 1:00 PM",
    address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    number: " +234 803 419 8048",
    attendants: "14",
    members: "4",
    description: "Paragraph 1",
    caption: "Paragraph 2",
  },
  5: {
    title: "Monday Prayer",
    print: "#",
    contact: "#",
    share: "#",
    image: "#",
    date: " Monday | 6th March, 2025",
    time: " 7:00 AM - 1:00 PM",
    address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    number: " +234 803 419 8048",
    attendants: "14",
    members: "4",
    description: "Paragraph 1",
    caption: "Paragraph 2",
  },
  6: {
    title: "Monday Prayer",
    print: "#",
    contact: "#",
    share: "#",
    image: "#",
    date: " Monday | 6th March, 2025",
    time: " 7:00 AM - 1:00 PM",
    address: " OFF AKINJAGUNLA, AGIODO-OJOJO ROAD, IMOLE OLORUN TAN, OKE-AYO STREET, ONDO TOWN, ONDO STATE, NIGERIA",
    number: " +234 803 419 8048",
    attendants: "14",
    members: "4",
    description: "Paragraph 1",
    caption: "Paragraph 2",
  },
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const eventId = Number(urlParams.get('id')) || 1;
  const e = event[eventId];

  if (!e) return;

  const breadcrumb = document.querySelector('.breadcrumb li.active');
  if (breadcrumb) {
    breadcrumb.textContent = e.title;
  }

  const eventDetailsDiv = document.getElementById('event-details');
  if (!eventDetailsDiv) return;

  eventDetailsDiv.innerHTML = `
    <header class="single-post-header clearfix">
      <nav class="btn-toolbar pull-right">
        <a href="${e.print}" class="btn btn-default" data-placement="bottom" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></a>
        <a href="${e.contact}" class="btn btn-default" data-placement="bottom" data-toggle="tooltip" data-original-title="Contact us"><i class="fa fa-envelope"></i></a>
        <a href="${e.share}" class="btn btn-default" data-placement="bottom" data-toggle="tooltip" data-original-title="Share event"><i class="fa fa-location-arrow"></i></a>
      </nav>
      <h2 class="post-title">${e.title}</h2>
    </header>
    <article class="post-content">
      <div class="event-description">
        <img src="${e.image !== '#' ? e.image : 'https://i.ytimg.com/vi/qYdDhesoi0E/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLC_xCa4umFYIE7ZU5HbW9GvEMI4zg'}" class="img-responsive">
        <div class="spacer-20"></div>
        <div class="row">
          <div class="col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Event details</h3>
              </div>
              <div class="panel-body">
                <ul class="info-table">
                  <li><i class="fa fa-calendar"></i> ${e.date}</li>
                  <li><i class="fa fa-clock-o"></i> ${e.time}</li>
                  <li><i class="fa fa-map-marker"></i> ${e.address}</li>
                  <li><i class="fa fa-phone"></i> ${e.number}</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <ul class="list-group">
              <li class="list-group-item"> <span class="badge">${e.attendants}</span> Attendees </li>
              <li class="list-group-item"> <span class="badge">${e.members}</span> Staff members </li>
            </ul>
          </div>
        </div>
        <p>${e.description}</p>
        <p>${e.caption}</p>
      </div>
    </article>
  `;
});