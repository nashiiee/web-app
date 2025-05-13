<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nash Portfolio</title>
  <link rel="stylesheet" href="styles/portfolio.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <?php
    // Define variables for dynamic content
    $greetings = 'Hi,';
    $firstName = 'Nash.';
    $myName = 'Nash Claracay';
    $profession = 'Aspiring Full Stack Developer';
    $aboutIntro = 'INTRODUCTION';
    $aboutHeading = 'Overview.';
    $aboutDescription = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus ipsam omnis veniam, iste officiis molestias. In officia expedita soluta? Sed temporibus vero reprehenderit qui magnam esse, minus consequuntur rem consequatur.';
    $caseStudy = 'Case Studies';
    $projectsHeading = 'Projects.';
    $projectsDescription = 'These projects demonstrate my expertise with practical examples of some of my work, including brief descriptions and links to code repositories. They showcase my ability to tackle intricate challenges, adapt to various technologies, and efficiently oversee projects.';
    $contactHeading = 'Contact.';
    $myIntroduction = $greetings . " I'm " . $myName;
  ?>

  <div id="home-section">
    <header class="header">
      <a href="#" class="logo"><?= $firstName; ?></a>
  
      <nav class="navbar">
        <a href="#home-section" class="active">Home</a>
        <a href="#about-section" class="nav-link">About</a>
        <a href="#project-section" class="nav-link">Projects</a>
        <a href="#contact-section" class="nav-link">Contact</a>
      </nav>
    </header>
  
    <section class="home">
      <div class="home-content">
        <h1><?= $myIntroduction; ?></h1>
        <h3><?= $profession; ?></h3>
        <p><?= $aboutDescription; ?></p>
        <div class="socials">
          <a href="https://github.com/nashiiee" target="_blank"><i class="fa-brands fa-github"></i></a>
          <a href="https://www.facebook.com/nash.claracay" target="_blank"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.instagram.com/_clrksnash/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><img src="images/onlyfans-logo-15222.svg" alt="onlyfans" id="onlyfans"></a>
        </div>
      </div>
      <div class="home-card"></div>
    </section>
  </div>
  

  <section id="about-section">
    <div class="section-descriptions">
      <h2 class="section-title"><?= $aboutIntro; ?></h2>
      <h1 class="main-heading"><?= $aboutHeading; ?></h1>
      <p class="description"><?= $aboutDescription; ?></p>
    </div>
    
    <div class="cards-container">
      <div class="card">
        <i class="fa-solid fa-code"></i>
        <h3>Frontend Developer</h3>
      </div>
      <div class="card">
        <i class="fa-solid fa-database"></i>
        <h3>Backend Developer</h3>
      </div>
      <div class="card">
        <i class="fa-solid fa-pencil-ruler"></i>
        <h3>UI/UX Design</h3>
      </div>
      <div class="card">
        <i class="fa-solid fa-diagram-project"></i>
        <h3>Software Prototyping</h3>
      </div>
    </div>
  </section>

  <div class="bg-pj-section">
    <section id="project-section">
      <p id="case-study"><?= $caseStudy; ?></p>
      <h2><?= $projectsHeading; ?></h2>
      <p class="project-description"><?= $projectsDescription; ?></p>
      <div class="cards-container">
        <div class="cards pjs-card-1"></div>
        <div class="cards pjs-card-2"></div>
        <div class="cards pjs-card-3"></div>
        <div class="cards pjs-card-4"></div>
      </div>
    </section>
  </div>
  
  <div id="ct-bg-section">
    <section id="contact-section">
      <div id="contact-container">
        <div id="contact-descriptions">
          <p><?= $contactDescription; ?></p>
          <h3><?= $contactHeading; ?></h3>
        </div>
        <div id="inputs-container">
          <label for="name">Your Name</label>
          <input type="text" name="name" id="name" placeholder="What's your name?">
          <label for="email">Your Email</label>
          <input type="email" name="email" id="email" placeholder="What's your email?">
          <label for="message">Your Message</label>
          <input id="message" type="text" name="message" placeholder="What's your message?">
          <button id="inputBtn">Send</button>
        </div>
      </div>
    </section>
  </div>
</body>
</html>