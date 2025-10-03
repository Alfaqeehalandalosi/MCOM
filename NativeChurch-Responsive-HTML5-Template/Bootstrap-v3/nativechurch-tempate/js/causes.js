const causes = {
  1: [
    {
      link: "single-cause.html?id=1",
      image: "#",
      title: "Education for Masai Children",
      date: "28th Jan, 2025",
      tags: ["Education", "Africa"],
      percent: "80% Donated of",
      amount: "$200000",
      deadline: "15 Days",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=2",
      image: "#",
      title: "Stop Child Labour",
      date: "28th Jan, 2025",
      tags: ["Child", "India"],
      percent: "30% Donated of",
      amount: "$110000",
      deadline: "3 Months",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=3",
      image: "#",
      title: "Africa's thirst",
      date: "28th Jan, 2025",
      tags: ["Africa", "Water"],
      percent: "55% Donated of",
      amount: "$6200000",
      collected: "$3410000",
      deadline: "27 Days",
      description: "Paragraph 1"
    }
  ],
  2: [
    {
      link: "single-cause.html?id=4",
      image: "#",
      title: "Refugee's Restoration Hope",
      date: "28th Jan, 2025",
      tags: ["Education", "Africa"],
      percent: "90% Donated of",
      amount: "$2000000",
      collected: "$1800000",
      deadline: "45 Days",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=5",
      image: "#",
      title: "Green Revolution",
      date: "28th Jan, 2025",
      tags: ["Education", "Africa"],
      percent: "60% Donated of",
      amount: "$200000",
      collected: "$160000",
      deadline: "2 Months",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=6",
      image: "#",
      title: "Food to Africa",
      date: "28th Jan, 2025",
      tags: ["Education", "Africa"],
      percent: "65% Donated of",
      amount: "$100000",
      collected: "$65000",
      deadline: "25 Days",
      description: "Paragraph 1"
    }
  ]
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const causeId = Number(urlParams.get('cause')) || 1;
  const causeList = causes[causeId] || [];

});