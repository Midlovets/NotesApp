<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NotesApp - Tame your work, organize your life</title>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Ubuntu', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: url('/images/figure.png') no-repeat center center fixed;
        background-size: cover;
        background-color: #111111; 
        color: #ffffff;
        height: 100vh;
        overflow: hidden;
        position: relative;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 3rem;
    }
    
    .logo {
      display: flex;
      align-items: center;
      gap: 0.2em;
      font-size: 2.1rem;
      font-weight: bold;
      text-decoration: none;
    }

    .logo-notes {
      background: linear-gradient(to right, #AD6000, #FFD924);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .logo-app {
      color: #ffffff;
    }

    .nav-links {
      display: flex;
    }

    .nav-links a {
      color: #ffffff;
      text-decoration: none;
      margin: 0 1.5rem;
      font-size: 1rem;
      transition: color 0.3s;
    }

    .nav-links a:hover {
      color: #f0a500;
    }

    .cta-buttons {
      display: flex;
      gap: 1rem;
    }

    .btn {
      padding: 0.6rem 1.5rem;
      border-radius: 50px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
      font-weight: 500;
    }

    .btn-outline {
      background-color: transparent;
      border: 2px solid transparent;
      border-image: linear-gradient(to right, #AD6000, #FFD924);
      border-image-slice: 1;
      background: linear-gradient(to right, #AD6000, #FFD924);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .btn-outline:hover {
      background-color: rgba(255, 217, 36, 0.1);
    }

    .btn-primary {
      background: linear-gradient(to right, #AD6000, #FFD924);
      border: none;
      color: #111111;
      position: relative;
      z-index: 1;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #925200, #FFCF00);
    }

    .hero {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 10rem 1rem 1rem;
      position: relative;
      z-index: 2;
    }

    .hero h1 {
    font-size: 4rem; /* великий */
    font-weight: 400; /* тонкий */
    line-height: 1.2; /* трохи ближче один до одного */
    margin-bottom: 1rem;
    background: linear-gradient(to right, #AD6000, #FFD924);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .hero-subtitle {
    font-size: 1.8rem; /* великий текст під заголовком */
    font-weight: 400; /* тонкий */
    opacity: 0.9;
    margin-bottom: 2rem;
    max-width: 800px;
  }



    .hero p {
      font-size: 1.2rem;
      max-width: 600px;
      margin-bottom: 1.5rem;
      opacity: 0.9;
      font-weight: 500;
    }

    .hero-cta {
      margin: 0.5rem 0 1rem;
      z-index: 2;
    }

    .hero-cta .btn {
      padding: 0.8rem 1.5rem;
      font-size: 1rem;
    }

    .visual-elements {
      position: relative;
      width: 100%;
      height: 40vh;
      margin-top: -2rem;
    }

    .figure-left {
      position: absolute;
      left: -2%;
      top: 21%;
      transform: translateY(-50%);
      z-index: -1;
    }

    .figure-right {
      position: absolute;
      right: -2%;
      top: 21%;
      transform: translateY(-50%);
      z-index: -1;
    }

    .figure-center {
      position: absolute;
      left: 50%;
      top: -30%;
      transform: translate(-50%, -50%);
      z-index: 1;
    }

    .pencil-img {
  position: absolute;
  left: -0.5%;
  top: 20%;
  transform: translateY(-50%) rotate(-2deg); /* Більший або менший наклон */
  z-index: 1;
}

.book-img {
  position: absolute;
  right: 0.5%;
  top: 40%;
  transform: translateY(-50%) rotate(0deg); /* Більший або менший наклон */
  z-index: 1;
}

    @media (max-width: 768px) {
      .navbar {
        padding: 0.5rem 1rem;
        flex-wrap: wrap;
      }

      .nav-links {
        margin: 0.5rem 0;
        justify-content: center;
        width: 100%;
      }

      .nav-links a {
        margin: 0 0.5rem;
        font-size: 0.9rem;
      }

      .cta-buttons {
        width: 100%;
        justify-content: center;
        margin-top: 0.5rem;
      }

      .hero {
        padding: 8rem 1rem 0.5rem;
      }

      .hero h1 {
        font-size: 2rem;
      }

      .hero h2 {
        font-size: 1.5rem;
      }

      .hero p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <a href="#" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
    <div class="cta-buttons">
      <a href="/public/login.php" class="btn btn-outline">Login</a>
      <a href="/public/user.php" class="btn btn-primary">Sign Up</a>
    </div>
  </nav>

  <section class="hero">
    <h1>
      Організуйте свої нотатки<br>
      Просто та швидко
    </h1>
    <p class="hero-subtitle">
      Всі ідеї та записи — в одному місці.
    </p>
    <div class="hero-cta">
      <a href="/public/login.php" class="btn btn-primary">Почати</a>
    </div>
    <div class="visual-elements">
      <img src="/images/figure-left.png" alt="Left figure" class="figure-left">
      <img src="/images/figure-right.png" alt="Right figure" class="figure-right">
      <img src="/images/figure-center.png" alt="Center figure" class="figure-center">
      <img src="/images/pencil.png" alt="Pencil illustration" class="pencil-img">
      <img src="/images/book.png" alt="Notebook illustration" class="book-img">
    </div>
  </section>
  
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
          });
        });
      });
    });
  </script>
</body>
</html>