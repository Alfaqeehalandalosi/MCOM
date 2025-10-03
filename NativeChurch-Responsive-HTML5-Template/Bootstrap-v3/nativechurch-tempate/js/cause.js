const cause = {
  1: {
    title: "Education for Masai Children",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$200000",
    collected: "$160000",
    percent: "",
    deadline: "15 Days",
    description: [
        "Paragraph 1",

        "Paragraph 2"
    ],
  },
  2: {
    title: "Stop Child Labour",
    date: "28th Jan, 2025",
    tags: ["Child", "India"],
    image: "#",
    amount: "$110000",
    collected: "$33000",
    percent: "",
    deadline: "3 Months",
    description: [
        "Paragraph 1",

        "Paragraph 2"
    ],
  },
  3: {
    title: "Africa's thirst",
    date: "28th Jan, 2025",
    tags: ["Africa", "Water"],
    image: "#",
    amount: "$6200000",
    collected: "$3410000",
    percent: "",
    deadline: "27 Days",
    description: [
        "Paragraph 1",

        "Paragraph 2"
    ],
  },
  4: {
    title: "Refugee's Restoration Hope",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$2000000",
    collected: "$1800000",
    percent: "",
    deadline: "45 Days",
    description: [
        "Paragraph 1",

        "Paragraph 2"
    ],
  },
  5: {
    title: "Green Revolution",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$200000",
    collected: "$160000",
    percent: "",
    deadline: "2 Months",
    description: [
        "Paragraph 1",

        "Paragraph 2"
    ],
  },
  6: {
    title: "Food to Africa",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$100000",
    collected: "$65000",
    percent: "",
    deadline: "25 Days",
    description: [
        "Paragraph 1",

        "Paragraph 2"
    ],
  },
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const causeId = Number(urlParams.get('cause')) || 1;
  const cause = causes[causeId];

  if (!cause) return;

  const amountNum = Number(cause.amount.replace(/[^0-9.-]+/g,""));
  const collectedNum = Number(cause.collected.replace(/[^0-9.-]+/g,""));
  const percent = amountNum > 0 ? Math.round((collectedNum / amountNum) * 100) : 0;

  document.getElementById('cause-title').textContent = cause.title;
  document.getElementById('cause-date').textContent = cause.date;
  document.getElementById('cause-tags').textContent = cause.tags.join(', ');
  document.getElementById('cause-image').src = cause.image;
  document.getElementById('cause-amount').textContent = cause.amount;
  document.getElementById('cause-collected').textContent = cause.collected;
  document.getElementById('cause-deadline').textContent = cause.deadline;
  document.getElementById('cause-description').innerHTML = cause.description.map(p => `<p>${p}</p>`).join('');
  document.getElementById('cause-percent').textContent = percent + "%";
});