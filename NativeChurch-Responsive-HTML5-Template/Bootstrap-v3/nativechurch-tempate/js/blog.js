const singles = {
  1: {
    title: "Post Title",
    commentcount: "23",
    date: "20th Jan, 2025",
    categories: "Uncategorized",
    logo: "http://placehold.it/800x600&amp;text=IMAGE+PLACEHOLDER",
    description: "a",
  },
  2: {
    title: "Prayers Collection",
    video: "?",
    audio: "?",
    read: "?",
    pdf: "?",
    description: "a",
  },
  3: {
    title: "Prayers Collection",
    video: "?",
    audio: "?",
    read: "?",
    pdf: "?",
    description: "a",
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