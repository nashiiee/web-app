const feedbackData = [
  {
    id: 1,
    sectionText: "Food",
    icon: "fa-solid fa-mug-hot",
    color: "#9DA5B1",
    rightSectionText: 'Overall Satisfaction with Food:',
    options: [
      { icon: "fa-regular fa-face-angry", label: "Very Bad" },
      { icon: "fa-regular fa-face-frown", label: "Bad" },
      { icon: "fa-regular fa-face-meh", label: "Okay" },
      { icon: "fa-regular fa-face-smile", label: "Good" },
      { icon: "fa-regular fa-face-laugh-beam", label: "Excellent" }
    ]
  },
  {
    id: 2,
    sectionText: "Staff",
    icon: "fa-solid fa-clipboard-user",
    color: "#9DA5B1",
    rightSectionText: 'Friendliness of Staff:',
    options: [
      { icon: "fa-regular fa-face-angry", label: "Very Unfriendly" },
      { icon: "fa-regular fa-face-frown", label: "Unfriendly" },
      { icon: "fa-regular fa-face-meh", label: "Neutral" },
      { icon: "fa-regular fa-face-smile", label: "Friendly" },
      { icon: "fa-regular fa-face-laugh-beam", label: "Very Friendly" }
    ]
  },
  {
    id: 3,
    sectionText: "Speed",
    icon: "fa-solid fa-gauge",
    color: "#9DA5B1",
    rightSectionText: 'Speed of Service:',
    options: [
      { icon: "fa-regular fa-face-angry", label: "Very Slow" },
      { icon: "fa-regular fa-face-frown", label: "Slow" },
      { icon: "fa-regular fa-face-meh", label: "Average" },
      { icon: "fa-regular fa-face-smile", label: "Fast" },
      { icon: "fa-regular fa-face-laugh-beam", label: "Very Fast" }
    ]
  },
  {
    id: 4,
    sectionText: "Service",
    icon: "fa-solid fa-utensils",
    color: "#9DA5B1",
    rightSectionText: 'Overall Satisfaction with Service:',
    options: [
      { icon: "fa-regular fa-face-angry", label: "Very Poor" },
      { icon: "fa-regular fa-face-frown", label: "Poor" },
      { icon: "fa-regular fa-face-meh", label: "Okay" },
      { icon: "fa-regular fa-face-smile", label: "Good" },
      { icon: "fa-regular fa-face-laugh-beam", label: "Excellent" }
    ]
  },
  {
    id: 5,
    sectionText: "Comments",
    icon: "fa-solid fa-comment",
    color: "#9DA5B1",
    rightSectionText: 'Specific Service Feedback:',
    isTextarea: true
  }
];

let currentIndex = 0;

const feedbackAnswers = {
  nickname: '',
  food: '',
  staff: '',
  speed: '',
  service: '',
  comments: ''
};

function sectionText() {
  let html = '';
  feedbackData.forEach(data => {
    html += `<a href="#" class="section-link" data-id="${data.id}">${data.sectionText}</a>`;
  });
  document.querySelector('.js-left-section-text').innerHTML = html;
}

function icons() {
  let html = '';
  feedbackData.forEach(data => {
    html += `
      <div class="cylinder" data-id="${data.id}">
        <i class="${data.icon}" style="color: ${data.color};"></i>
      </div>
      <hr class="cylinder-hr-1">
    `;
  });
  document.querySelector('.icons').innerHTML = html;
}

function renderCurrentFeedback(index) {
  const data = feedbackData[index];

  // Update cylinder and link states
  document.querySelectorAll('.cylinder').forEach(c => {
    const id = parseInt(c.dataset.id);
    c.classList.toggle('active-cylinder', id === data.id);
    c.style.background = id === data.id ? "#0077b6" : "#9DA5B1";
    c.querySelector('i').style.color = id === data.id ? "#FAFFAF" : "#fff";
  });

  document.querySelectorAll('.section-link').forEach(link => {
    const id = parseInt(link.dataset.id);
    link.classList.toggle('active-section-link', id === data.id);
    link.style.color = id === data.id ? "#0077b6" : "#222";
  });

  // Build content
  let boxesHTML = '';
  if (data.isTextarea) {
    boxesHTML = `
      <textarea class="comment-textarea" placeholder="Type your thoughts here..."></textarea>
      <button class="next-btn" type="button">Next</button>
    `;
  } else {
    data.options.forEach(option => {
      boxesHTML += `
        <div class="right-section-box">
          <i class="${option.icon}"></i>
          <p>${option.label}</p>
        </div>
      `;
    });
  }

  document.querySelector('.right-section').innerHTML = `
    <h3>${data.rightSectionText}</h3>
    <hr class="right-section-hr">
    <div class="right-section-content">
      ${boxesHTML}
    </div>
  `;

  // Handle click logic
  if (data.isTextarea) {
    document.querySelector('.next-btn').addEventListener('click', () => {
      const comment = document.querySelector('.comment-textarea').value.trim();
      feedbackAnswers.comments = comment || 'No comment';
      currentIndex++;
      renderSubmitButton();
    });
  } else {
    document.querySelectorAll('.right-section-box').forEach(box => {
      box.addEventListener('click', () => {
        const selectedValue = box.querySelector('p').textContent;
        const category = data.sectionText.toLowerCase();
        feedbackAnswers[category] = selectedValue;

        currentIndex++;
        if (currentIndex < feedbackData.length) {
          renderCurrentFeedback(currentIndex);
        } else {
          renderSubmitButton();
        }
      });
    });
  }
}

function renderCylinders() {
  document.querySelectorAll('.cylinder').forEach(cylinder => {
    cylinder.addEventListener('click', function () {
      const dataId = parseInt(this.dataset.id);
      const index = feedbackData.findIndex(d => d.id === dataId);
      currentIndex = index;
      renderCurrentFeedback(currentIndex);
    });
  });
}

function renderSubmitButton() {
  document.querySelector('.right-section').innerHTML += `
    <div style="text-align:center; margin-top: 2rem;">
      <button class="submit-btn" type="button" id="submitFeedback">Submit</button>
    </div>
  `;

  document.getElementById("submitFeedback").addEventListener("click", () => {
    submitToBackend();
  });
}

function submitToBackend() {
  const form = document.getElementById('feedback-form');

  for (const key in feedbackAnswers) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = key;
    input.value = feedbackAnswers[key];
    form.appendChild(input);
  }

  form.submit();
}

document.getElementById('start-feedback-btn')?.addEventListener('click', () => {
  const nickname = document.querySelector('.anonymous-input')?.value.trim();
  feedbackAnswers.nickname = nickname === '' ? 'Anonymous' : nickname;
  document.querySelector('.hero-section').style.display = 'flex';
  document.querySelector('.name-section').style.display = 'none';
  renderCurrentFeedback(currentIndex);
});

sectionText();
icons();
renderCylinders();