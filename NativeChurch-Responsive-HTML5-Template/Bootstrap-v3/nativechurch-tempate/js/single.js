const singles = {
  1: {
    title: "Sermon Title",
    video: "https://vimeo.com/19564018",
    audio: "http://player.vimeo.com/video/19564018?title=0&amp;byline=0&autoplay=0&amp;color=007F7B",
    read: "#",
    pdf: "#",
    description: "a",
    tags: ["Faith", "Heart", "Love", "Praise", "Sin", "Soul"],
    commentcount: "Comments (4)",
    comments: [
		{
			avatar: "https://cdn-icons-png.flaticon.com/128/1077/1077114.png",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		}
		],
  },
  2: {
    title: "Sermon Title",
    video: "https://vimeo.com/19564018",
    audio: "http://player.vimeo.com/video/19564018?title=0&amp;byline=0&autoplay=0&amp;color=007F7B",
    read: "#",
    pdf: "#",
    description: "a",
    tags: ["Faith", "Heart", "Love", "Praise", "Sin", "Soul"],
    commentcount: "Comments (4)",
    comments: [
		{
			avatar: "https://cdn-icons-png.flaticon.com/128/1077/1077114.png",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		}
		],
  },
  3: {
    title: "Sermon Title",
    video: "https://vimeo.com/19564018",
    audio: "http://player.vimeo.com/video/19564018?title=0&amp;byline=0&autoplay=0&amp;color=007F7B",
    read: "#",
    pdf: "#",
    description: "a",
    tags: ["Faith", "Heart", "Love", "Praise", "Sin", "Soul"],
    commentcount: "Comments (4)",
    comments: [
		{
			avatar: "https://cdn-icons-png.flaticon.com/128/1077/1077114.png",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		},
    {
			avatar: "http://placehold.it/40x40&amp;text=IMAGE+PLACEHOLDER",
			name: "John Doe",
			time: "Nov 23, 2025 at 7:58 pm",
			content: "Can't wait to participate!"
		}
		],
  },
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const singleId = Number(urlParams.get('single')) || 1;
  const single = singles[singleId];

  if (!single) {
    console.error("Single not found:", singleId);
    return;
  }

  // Title and Description
  document.getElementById('single-title').innerText = single.title;
  document.getElementById('single-description').innerText = single.description;

  // Action Links
  document.getElementById('single-video').setAttribute('href', single.video);
  document.getElementById('single-audio').setAttribute('href', single.audio);
  document.getElementById('single-read').setAttribute('href', single.read);
  document.getElementById('single-pdf').setAttribute('href', single.pdf);

  // Tags
  document.getElementById('single-tags').innerHTML = single.tags.map(tag => `<a href="#">${tag}</a>`).join(', ');

  // Comment Count
  document.getElementById('single-commentcount').innerText = single.commentcount;

  // Comments
  const commentsOl = document.getElementById('single-comments');
  commentsOl.innerHTML = single.comments.map(comment => `
    <li>
      <div class="post-comment-block">
        <div class="img-thumbnail"><img src="${comment.avatar}" alt="avatar"></div>
        <a href="#" class="btn btn-primary btn-xs pull-right">Reply</a>
        <h5>${comment.name} says</h5>
        <span class="meta-data">${comment.time}</span>
        <p>${comment.content}</p>
      </div>
    </li>
  `).join('');
});