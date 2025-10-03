const singles = {
  1: {
    title: "Post Title",
    commentcount: "12",
    date: "28th Jan, 2025",
    tag: "Uncategorized",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    opening: "?",
    bold: "?",
    description: [
            "Paragraph 1",
            
            "Paragraph 2"
        ] ,
    quote: "Something to think about",
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
    title: "Post Title",
    commentcount: "12",
    date: "28th Jan, 2025",
    tag: "Uncategorized",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    opening: "?",
    bold: "?",
    description: [
            "Paragraph 1",
            
            "Paragraph 2"
        ] ,
    quote: "Something to think about",
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
    title: "Post Title",
    commentcount: "12",
    date: "28th Jan, 2025",
    tag: "Uncategorized",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    opening: "?",
    bold: "?",
    description: [
            "Paragraph 1",
            
            "Paragraph 2"
        ] ,
    quote: "Something to think about",
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
  const urlParams    = new URLSearchParams(window.location.search);
  const singleId      = Number(urlParams.get('single'));
  const single        = singles[singleId];

  if (!single) {
    console.error("Single not found:", singleId);
    return;
  }

  // Update the content
  document.querySelector('single-title').innerText  = single.title;
});