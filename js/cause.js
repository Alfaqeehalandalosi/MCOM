const cause = {
  1: {
    title: "Refugee's Restoration Hope",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$2000000",
    collected: "$1800000",
    deadline: "45 Days",
    description: [
      "Paragraph 1",
      "Paragraph 2"
    ],
  },
  2: {
    title: "Green Revolution",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$20000",
    collected: "$12000",
    deadline: "2 Months",
    description: [
      "Paragraph 1",
      "Paragraph 2"
    ],
  },
  3: {
    title: "Education for Masai Children",
    date: "28th Jan, 2025",
    tags: ["Education", "Africa"],
    image: "#",
    amount: "$200000",
    collected: "$160000",
    deadline: "15 Days",
    description: [
      "Paragraph 1",
      "Paragraph 2"
    ],
  },
  4: {
    title: "Africa's thirst",
    date: "28th Jan, 2025",
    tags: ["Africa", "Water"],
    image: "#",
    amount: "$6200000",
    collected: "$3410000",
    deadline: "27 Days",
    description: [
      "Paragraph 1",
      "Paragraph 2"
    ],
  },
  5: {
    title: "Stop Child Labour",
    date: "28th Jan, 2025",
    tags: ["Child", "India"],
    image: "#",
    amount: "$110000",
    collected: "$33000",
    deadline: "3 Months",
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
    deadline: "25 Days",
    description: [
      "Paragraph 1",
      "Paragraph 2"
    ],
  },
};

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const causeId = Number(urlParams.get('id')) || 1;
  const c = cause[causeId];
  if (!c) return;

  const breadcrumb = document.querySelector('.breadcrumb li.active');
  if (breadcrumb) {
    breadcrumb.textContent = c.title;
  }

  const amount = Number(c.amount.replace(/[^0-9.-]+/g,""));
  const collected = Number(c.collected.replace(/[^0-9.-]+/g,""));
  const percentNum = Math.round((collected / amount) * 100);

  // Determine progress bar class
  let progressClass = "progress-bar-success";
  if (percentNum <= 30) progressClass = "progress-bar-danger";
  else if (percentNum <= 70) progressClass = "progress-bar-warning";

  const tagsHtml = c.tags.map(tag => `<a href="#">${tag}</a>`).join(', ');
  const descriptionHtml = c.description.map(p => `<p>${p}</p>`).join('');

  document.getElementById('cause-details').innerHTML = `
    <header class="single-post-header clearfix">
      <h2 class="post-title">${c.title}</h2>
    </header>
    <article class="post-content cause-item">
      <span class="post-meta meta-data">
        <span><i class="fa fa-calendar"></i> ${c.date}</span>
        <span><i class="fa fa-archive"></i> ${tagsHtml}</span>
      </span>
      <div class="spacer-20"></div>
      <div class="row">
        <div class="col-md-7">
          <img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" class="img-responsive">
        </div>
        <div class="col-md-5">
          <ul class="list-group">
            <li class="list-group-item">
              <h4>Cause Progress</h4>
              <div class="progress">
                <div id="cause-progress-bar" class="progress-bar ${progressClass}" data-appear-progress-animation="${percentNum}%" data-appear-animation-delay="0"></div>
              </div>
            </li>
            <li class="list-group-item"> <span class="badge">${c.amount}</span> Amount Needed </li>
            <li class="list-group-item"> <span class="badge">${c.collected}</span> Collected yet </li>
            <li class="list-group-item"> <span class="badge accent-bg">${percentNum}%</span> Percentile </li>
            <li class="list-group-item"> <span class="badge">${c.deadline}</span> Deadline</li>
          </ul>
          <a href="#" class="btn btn-primary btn-lg btn-block donate-paypal" data-toggle="modal" data-target="#PaymentModal">Donate Now</a>
        </div>
      </div>
      <div class="spacer-30"></div>
      ${descriptionHtml}
    </article>
  `;

  // Animate progress bar like causes.js
  setTimeout(() => {
    const progressBar = document.getElementById('cause-progress-bar');
    if (progressBar) {
      const target = progressBar.getAttribute('data-appear-progress-animation') || '0%';
      progressBar.style.transition = 'width 1s';
      progressBar.style.width = target;
    }
  }, 200);
});