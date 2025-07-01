const options = [{
  id: 1,
  label: 'Food',
  circleIcon: 'fa-solid fa-mug-hot',
  rightSectionText: 'Overall Satisfaction with food',
  optionsBox: [
    { icon: "fa-regular fa-face-angry", label: "Very Bad" },
    { icon: "fa-regular fa-face-frown", label: "Bad" },
    { icon: "fa-regular fa-face-meh", label: "Okay" },
    { icon: "fa-regular fa-face-smile", label: "Good" },
    { icon: "fa-regular fa-face-laugh-beam", label: "Excellent" }
  ]
}, {
  id: 2,
  label: 'Staff',
  circleIcon: 'fa-solid fa-bell-concierge',
  rightSectionText: 'Friendliness of the staff',
  optionsBox: [
    { icon: "fa-regular fa-face-angry", label: "Very Bad" },
    { icon: "fa-regular fa-face-frown", label: "Bad" },
    { icon: "fa-regular fa-face-meh", label: "Okay" },
    { icon: "fa-regular fa-face-smile", label: "Good" },
    { icon: "fa-regular fa-face-laugh-beam", label: "Excellent" }
  ]
}, {
  id: 3,
  label: 'Speed',
  circleIcon: 'fa-solid fa-gauge',
  rightSectionText: 'Speed of Service',
  optionsBox: [
    { icon: "fa-regular fa-face-angry", label: "Very Bad" },
    { icon: "fa-regular fa-face-frown", label: "Bad" },
    { icon: "fa-regular fa-face-meh", label: "Okay" },
    { icon: "fa-regular fa-face-smile", label: "Good" },
    { icon: "fa-regular fa-face-laugh-beam", label: "Excellent" }
  ]
}, {
  id: 4,
  label: 'Service',
  circleIcon: 'fa-solid fa-utensils',
  rightSectionText: 'Overall Satisfaction with Service',
  optionsBox: [
    { icon: "fa-regular fa-face-angry", label: "Very Bad" },
    { icon: "fa-regular fa-face-frown", label: "Bad" },
    { icon: "fa-regular fa-face-meh", label: "Okay" },
    { icon: "fa-regular fa-face-smile", label: "Good" },
    { icon: "fa-regular fa-face-laugh-beam", label: "Excellent" }
  ]
}, {
  id: 5,
  label: 'Comments',
  circleIcon: 'fa-solid fa-coins',
  rightSectionText: 'Specific Service Feedback',
  isTextarea: true
}];

let currentIndex = 0;
let feedbackAnswers = {};

const boxFeedback = document.querySelector('.box-feedback');
const leftSection = document.querySelector('.left-section');
const rightSectionHeader = document.querySelector('.right-section-header h2');

function renderLeftSection() {
  let optionRowHTML = '';

  options.forEach((option, index) => {
    optionRowHTML +=`
      <div class="option-row">
        <div class="${index === currentIndex ? 'label active-label' : 'label'}">${option.label}</div>
        <div class="${index === currentIndex ? 'circle active' : 'circle'}"><i class="${option.circleIcon}"></i></div>
      </div>
    `;
  });

  return `<div class="feedback-options">${optionRowHTML}</div>`;
}

function renderRightSection() {
  const option = options[currentIndex];
  rightSectionHeader.textContent = option.rightSectionText;

  if (option.isTextarea) {
    boxFeedback.innerHTML = `
      <div class="feedback-textarea-container">
        <textarea class="feedback-textarea" placeholder="Please provide your feedback here..."></textarea>
        <div class="button-group">
          <button type="reset" class="reset-button">Cancel</button>
          <button type="submit" class="submit-button">Submit</button>
        </div>
      </div>
    `;


    const submitBtn = document.querySelector('.submit-button');
    submitBtn.addEventListener('click', () => {
      const textarea = document.querySelector('.feedback-textarea').value.trim();
      feedbackAnswers['comments'] = textarea;
      submitToPHP(feedbackAnswers);
    })
    
    return;
  }

  let html = '';
  option.optionsBox.forEach((box) => {
    html += `
      <div class="box">
        <i class="${box.icon}"></i>
        <span class="label">${box.label}</span>
      </div>
    `;
  });
  boxFeedback.innerHTML = html;

  document.querySelectorAll('.box').forEach((box) => {
    box.addEventListener('click', () => {
      const selectedLabel = box.querySelector('.label').textContent;
      feedbackAnswers[option.label.toLowerCase()] = selectedLabel;
      if (currentIndex < options.length - 1) {
        currentIndex++;
        renderEverything();
      }
    });
  });
}

function renderEverything() {
  leftSection.innerHTML = renderLeftSection();

  document.querySelectorAll('.circle').forEach((circle, index) => {
    circle.addEventListener('click', () => {
      document.querySelectorAll('.circle').forEach((c) => {
        c.classList.remove('active');
      });
      document.querySelectorAll('.label').forEach((l) => l.classList.remove('active-label'));

      circle.classList.toggle('active');
      circle.parentElement.querySelector('.label').classList.add('active-label');

      currentIndex = index;
      renderEverything();
    })
  });

  renderRightSection();
}

function submitToPHP(data) {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '../feedbacksphp/submit.php';

  for (const key in data) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = key;
    input.value = data[key];
    form.appendChild(input);
  }

  document.body.appendChild(form);
  form.submit();
}

renderEverything();