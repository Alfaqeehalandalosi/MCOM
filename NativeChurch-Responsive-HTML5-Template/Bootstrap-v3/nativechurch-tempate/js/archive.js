const archives = {
  1: [
    {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  }
],
  2: [
    {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  }
],
  3: [
    {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  },
  {
    title: "Untitled",
    date: "Posted on 17th Dec, 2025 | Pastor:",
    pastorlink: "#",
    pastor: "Admin",
    video: "#",
    audio: "#",
    read: "#",
    pdf: "#",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
    link: "#",
  }
]
};
    
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const archiveId = Number(urlParams.get('sermon')) || 1;
  const archiveList = archives[archiveId];

  if (!archiveList) {
    console.error("Archive not found:", archiveId);
    return;
  }

  const sermonsListDiv = document.getElementById('sermons-list');
  sermonsListDiv.innerHTML = '';

  archiveList.forEach(sermon => {
    sermonsListDiv.innerHTML += `
      <article class="post sermon">
        <header class="post-title">
          <div class="row">
            <div class="col-md-9 col-sm-9">
              <h3><a href="${sermon.link}">${sermon.title}</a></h3>
              <span class="meta-data"><i class="fa fa-calendar"></i> ${sermon.date} <a href="${sermon.pastorlink}">${sermon.pastor}</a></span>
            </div>
            <div class="col-md-3 col-sm-3 sermon-actions">
              <a href="${sermon.video}" data-placement="top" data-toggle="tooltip" data-original-title="Video"><i class="fa fa-video-camera"></i></a>
              <a href="${sermon.audio}" data-placement="top" data-toggle="tooltip" data-original-title="Audio"><i class="fa fa-headphones"></i></a>
              <a href="${sermon.read}" data-placement="top" data-toggle="tooltip" data-original-title="Read online"><i class="fa fa-file-text-o"></i></a>
              <a href="${sermon.pdf}" data-placement="top" data-toggle="tooltip" data-original-title="Download PDF"><i class="fa fa-book"></i></a>
            </div>
          </div>
        </header>
        <div class="post-content">
          <div class="row">
            <div class="col-md-4">
              <a href="${sermon.link}" class="media-box">
                <img src="${sermon.logo}" alt="" class="img-thumbnail">
              </a>
            </div>
            <div class="col-md-8">
              <p>${sermon.description}</p>
              <p><a href="${sermon.link}" class="btn btn-primary">Continue reading <i class="fa fa-long-arrow-right"></i></a></p>
            </div>
          </div>
        </div>
      </article>
    `;
  });
});