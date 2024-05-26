<?php
    // Check if the username cookie is set
    $isLoggedIn = isset($_COOKIE['username']);
?>

<html>
  <head>

    <link href="style.css" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
  </head>
  <body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="only logo.png" alt="Logo">
            <div class="navbar-center">
                Find Me Safe
            </div>
        </div>
        <div class="navbar-right">
            <a href="/">Home</a>
            <a href="/AboutUs">About Us</a>
            <?php if ($isLoggedIn): ?>
                <a href="/RegisterChild">Register Child</a>
                <a href="/logout">Log Out</a>
            <?php else: ?>
                <a href="/login">Log In</a>
            <?php endif; ?>
        </div>
    </nav>

    <div id="carouselExampleDark" class="carousel carousel-dark slide">
      
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="https://imgs.search.brave.com/DK-hVdj5PTlF32NWrXUgatSmBFn9tk_jmf8x1GHMiaQ/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTMz/ODM0NDMxOS9waG90/by9oYXBweS1kaXZl/cnNlLWp1bmlvci1z/Y2hvb2wtc3R1ZGVu/dHMtY2hpbGRyZW4t/bG9va2luZy1hdC1j/YW1lcmEtaW4tY2xh/c3Nyb29tLndlYnA_/Yj0xJnM9NjEyeDYx/MiZ3PTAmaz0yMCZj/PUh3X3BTRERCeDdj/QXVCMVN1VzRET0xk/ZUVoSUtHbWZGbE9M/RU5zZjMzenc9" style="width: auto; height: 700px;" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h11 style="font-size:50px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">About Us</h11>
           
          </div>
        </div></div>

        <section class="image-text-section clearfix">
            <img src="hack_the_league-removebg-preview.png" alt="Example Image">
            <div class="text-content">
                <h1>Our Initiative
</h1><br><br>
                <p>At FindMeSafe, our initiative revolves around leveraging technology to enhance child safety and security in our communities. With a profound understanding of the alarming prevalence of child abduction and trafficking, particularly in densely populated areas, we've embarked on a mission to provide a robust solution that empowers parents and guardians. Through our platform, parents can proactively create digital identities for their children, equipping them with essential biometric data like facial recognition profiles. This proactive approach not only aids in expediting the identification process in the event of a child going missing but also serves as a powerful deterrent against potential abductors.
</p>
            </div>
        </section>


      <div class="team-sector">
          <h1 class="team-heading">Our Team</h1>
          <div class="team-members">
              <div class="team-member">
                  <img src="atharv.png" alt="Atharv Baluja">
                  <p class="team-member-para">I'm Atharv Baluja,  I am passionate about programming and AI. </p>
              </div>
              <div class="team-member">
                  <img src="arihant.jpg" alt="Arihant Surana">
                  <p class="team-member-para">I'm Arihant Surana, a 12-year-old front-end developer from Jaipur, India.  </p>
              </div>
          </div>
      </div>


      <!DOCTYPE html>
      <html lang="en">
      <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Contact Us</title>
      <style>
          body {
              font-family: Arial, sans-serif;
              margin: 0;
              padding: 0;
              background-color: #f8f9fa;
          }
          .contact-sector {
              text-align: center;
              padding: 50px 20px;
          }
          .contact-heading {
              font-size: 36px;
              font-weight: bold;
              margin-bottom: 30px;
              color: #333;
          }
          .contact-form {
              max-width: 600px;
              margin: 0 auto;
          }
          .form-group {
              margin-bottom: 20px;
          }
          .form-group label {
              display: block;
              font-size: 18px;
              margin-bottom: 5px;
              color: #666;
              text-align: left;
          }
          .form-group input[type="text"],
          .form-group input[type="email"],
          .form-group textarea {
              width: 100%;
              padding: 10px;
              font-size: 16px;
              border: 1px solid #ccc;
              border-radius: 5px;
              box-sizing: border-box;
          }
          .form-group textarea {
              height: 150px;
          }
          .form-group button {
              padding: 12px 24px;
              font-size: 16px;
              background-color: #007bff;
              color: #fff;
              border: none;
              border-radius: 5px;
              cursor: pointer;
              transition: background-color 0.3s ease;
          }
          .form-group button:hover {
              background-color: #0056b3;
          }
      </style>
      </head>
      <body>

      <div class="contact-sector">
          <h2 class="contact-heading">Contact Us</h2>
          <div class="contact-form">
              <form action="#" method="post">
                  <div class="form-group">
                      <label for="name">Your Name:</label>
                      <input type="text" id="name" name="name" required>
                  </div>
                  <div class="form-group">
                      <label for="email">Your Email:</label>
                      <input type="email" id="email" name="email" required>
                  </div>
                  <div class="form-group">
                      <label for="message">Your Message:</label>
                      <textarea id="message" name="message" required></textarea>
                  </div>
                  <div class="form-group">
                      <button type="submit">Send Message</button>
                  </div>
              </form>
          </div>
      </div>


        <div class="bottom-bar">
           &copy; 2024 Find Me Safe. All rights reserved.
         </div>

      
  </body>
</html>