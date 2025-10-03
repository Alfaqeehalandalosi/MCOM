const albums = {
  1: [
    {
    logo: "https://upload.wikimedia.org/wikipedia/en/f/fa/The_Sermon%21.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  {
    logo: "https://www.dustygroove.com/images/products/e/ericksermon_music~~~~_101b.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  {
    logo: "https://concord.com/wp-content/uploads/2018/01/SPCD-7041-2.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  ],
  2: [
    {
    logo: "https://upload.wikimedia.org/wikipedia/en/f/fa/The_Sermon%21.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  {
    logo: "https://www.dustygroove.com/images/products/e/ericksermon_music~~~~_101b.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  {
    logo: "https://concord.com/wp-content/uploads/2018/01/SPCD-7041-2.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  ],
  3: [
    {
    logo: "https://upload.wikimedia.org/wikipedia/en/f/fa/The_Sermon%21.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  {
    logo: "https://www.dustygroove.com/images/products/e/ericksermon_music~~~~_101b.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  {
    logo: "https://concord.com/wp-content/uploads/2018/01/SPCD-7041-2.jpg",
    videocount: "3 videos",
    audiocount: "3 audios",
    title: "Prayers Collection",
    description: "a",
    link: "sermon-archive.html",
    play: "single-sermon.html",
  },
  ]
};
    
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const albumId = Number(urlParams.get('album')) || 1;
  const albumList = albums[albumId];

  if (!albumList) {
    console.error("Album not found:", albumId);
    return;
  }

  const albumsListDiv = document.getElementById('albums-list');
  albumsListDiv.innerHTML = '';

  albumList.forEach(album => {
    albumsListDiv.innerHTML += `
      <div class="post">
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <a href="${album.link}" class="album-cover">
              <span class="album-image"><img src="${album.logo}" alt=""></span>
            </a>
            <div class="label label-default album-count">${album.videocount}</div>
            <div class="label label-default album-count">${album.audiocount}</div>
          </div>
          <div class="col-md-8 col-sm-8">
            <h3><a href="${album.link}">${album.title}</a></h3>
            <p>${album.description}</p>
            <p><a href="${album.play}" class="btn btn-primary">Play <i class="fa fa-play"></i></a></p>
          </div>
        </div>
      </div>
    `;
  });

  // Highlight the active pagination button
  const paginationLinks = document.querySelectorAll('.pagination li a');
  paginationLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href && href.includes('album=')) {
      const pageNum = Number(new URLSearchParams(href.split('?')[1]).get('album'));
      if (pageNum === albumId) {
        link.parentElement.classList.add('active');
      } else {
        link.parentElement.classList.remove('active');
      }
    }
  });
});