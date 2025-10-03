const causes = {
  1: [
    {
      link: "single-cause.html?id=1",
      title: "Refugee's Restoration Hope",
      amount: "$2000000",
      collected: "$1800000",
      deadline: "45 Days",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=2",
      title: "Green Revolution",
      amount: "$20000",
      collected: "$12000",
      deadline: "2 Months",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=3",
      title: "Education for Masai Children",
      amount: "$200000",
      collected: "$160000",
      deadline: "15 Days",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=4",
      title: "Africa's thirst",
      amount: "$6200000",
      collected: "$3410000",
      deadline: "27 Days",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=5",
      title: "Stop Child Labour",
      amount: "$110000",
      collected: "$33000",
      deadline: "3 Months",
      description: "Paragraph 1"
    },
    {
      link: "single-cause.html?id=6",
      title: "Food to Africa",
      amount: "$100000",
      collected: "$65000",
      deadline: "25 Days",
      description: "Paragraph 1"
    },
  ],
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const causeId = Number(urlParams.get('causes')) || 1; // Use 'causes' to match your pagination links
  const causeList = causes[causeId] || [];

  const causesListDiv = document.getElementById('causes-list');
  if (!causesListDiv) return;

  causesListDiv.innerHTML = causeList.map(cause => {
    // Calculate percent donated
    const amount = Number(cause.amount.replace(/[^0-9.-]+/g,""));
    const collected = Number(cause.collected.replace(/[^0-9.-]+/g,""));
    const percentNum = Math.round((collected / amount) * 100);

    // Determine progress bar class
    let progressClass = "progress-bar-success";
    if (percentNum <= 30) progressClass = "progress-bar-danger";
    else if (percentNum <= 70) progressClass = "progress-bar-warning";

    // Deadline label
    let deadlineLabel = cause.deadline + " to go";

    return `
      <li class="grid-item cause-item format-standard">
        <div class="grid-item-inner">
          <a href="${cause.link}" class="media-box">
            <img src="http://placehold.it/600x700&amp;text=IMAGE+PLACEHOLDER" alt="">
          </a>
          <div class="grid-content">
            <h3><a href="${cause.link}">${cause.title}</a></h3>
            <div class="progress-label">
              ${percentNum}% Donated of <span>${cause.amount}</span>
              <label class="cause-days-togo label label-default pull-right">${deadlineLabel}</label>
            </div>
            <div class="progress">
              <div class="progress-bar ${progressClass}" data-appear-progress-animation="${percentNum}%" data-appear-animation-delay="0"></div>
            </div>
            <p>${cause.description}</p>
            <a href="#" class="btn btn-default donate-paypal" data-toggle="modal" data-target="#PaymentModal">Donate Now</a>
          </div>
        </div>
      </li>
    `;
  }).join('');

  setTimeout(() => {
    document.querySelectorAll('.progress-bar').forEach(bar => {
      const target = bar.getAttribute('data-appear-progress-animation') || '0%';
      bar.style.transition = 'width 1s';
      bar.style.width = target;
    });
  }, 200);

  // Highlight the active pagination button
  const paginationLinks = document.querySelectorAll('.pagination li a');
  paginationLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href && href.includes('causes=')) {
      const pageNum = Number(new URLSearchParams(href.split('?')[1]).get('causes'));
      if (pageNum === causeId) {
        link.parentElement.classList.add('active');
      } else {
        link.parentElement.classList.remove('active');
      }
    }
  });
});