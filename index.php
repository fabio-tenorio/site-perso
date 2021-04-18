<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Fabio Tenorio | développeur web | portfolio</title>
</head>
<body>
    <header class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link lien" href="#moi">moi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lien" href="#competences">Compétences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lien" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle lien active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Plus qu'un développeur
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item lien" href="#softskills">enseignant</a>
                            <a class="dropdown-item lien" href="#softskills">chercheur</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item lien" href="#hardskills">multilingue</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="container-fluid py-5" id="accueil">
            <div id="presentation">
                <img id="img-moi" src="assets/images/moi.jpg" alt="Fabio Tenorio de Carvalho">
                <!-- faire un tooltip bootstrap sur l'image -->
                <h1 class="text-light mt-5">Fabio Tenorio</h1>
                <p class="text-light text-center">développeur web</p>
                <a class="nav-link text-center" id="email" href="mailto:fabiovalho@gmail.com">fabiovalho@gmail.com</a>
            </div>
            <div class="reseau-social">
                <a target="blank" href="https://www.linkedin.com/in/fabiotenoriodecarvalho"><img class="logo-reseau" src="assets/images/linkedin.png"></a>
                <a target="blank" href="https://github.com/fabio-tenorio"><img class="logo-reseau" src="assets/images/Octocat.png"></a>
                <a target="blank" href="https://twitter.com/fabiotapajonico"><img class="logo-reseau" src="assets/images/twitter.png"></a>
            </div>
            <a download="" href="assets/moncv.pdf" id="cv" class="btn btn-warning col-sm-6 m-auto btn-lg">télécharger mon <em>curriculum vitae</em></a>
        </section>
        <section id="moi" class="about section">
            <!-- <span class="section-subtitle">My intro</span> -->
            <h2 class="section-title section-about-me">Qui suis-je?</h2>
            <div class="about__container bd-grid">
                <div class="about__data">
                    <p class="about__description">
                        J'ai exercé passionnement, pendant 15 ans, le métier d'enseignant et de chercheur au Brésil,
                        mon pays d'origine. En France depuis septembre 2019, j'ai décidé de rélier deux anciennes passions
                        - l'éducation et l'informatique - afin de faire convergir mes compétences vers un nouveau objectif
                        professionnel: contribuer aux avancées technologiques dans le secteur des EdTech's.
                    </p>
                </div>
                <div class="about__badge">
                    <div class="about__information">
                        <h3 class="about__information-title">Information</h3>
                        <div class="about__information-data">
                            <img id="moi2" src="assets/images/moi2.jpg" alt="Fabio Tenorio de Carvalho">
                            <!-- <i class="bi bi-person about__information-icon"></i> -->
                            <span>Fabio Tenorio</span>
                        </div>
                        <div class="about__information-data">
                            <i class="bi bi-envelope about__information-icon"></i>
                            <a href="mailto:fabiovalho@gmail.com">fabiovalho@gmail.com</a>
                        </div>
                    </div>
                    <div class="about__information">
                        <h3 class="about__information-title">Expérience</h3>
                        
                        <div class="about__information-data">
                            <i class="bi bi-code-slash about__information-icon"></i>
                            <div>
                                <span class="about__information-subtitle">développeur web & web mobile</span>
                                <span class="about__information-subtitle">à La Plateforme_ (Marseille)</span>
                            </div>
                        </div>
                        <div class="about__information-data">
                            <i class="bi bi-briefcase about__information-icon"></i>
                            <div>
                                <span class="about__information-subtitle">plus de 16 projets informatiques</span>
                                <span class="about__information-subtitle">réalisés en groupe ou individuellement</span>
                            </div>
                        </div>
    
                        <div class="about__information-data">
                            <i class="bi bi-easel about__information-icon"></i>
                            <div>
                                <span class="about__information-subtitle">plusieurs conférences, cours et textes</span>
                                <span class="about__information-subtitle">en tant qu'enseignant et chercheur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="skills section" id="competences">
            <!-- <span class="section-subtitle">Why choose me</span> -->
            <article id="hardskills">
                <h2 class="section-title py-2">Mes hard skills</h2>
                <div class="container">
                    <div class="row brique-ligne">
                        <div class="col brique brique-top">
                            Symfony
                        </div>
                        <div class="col brique brique-top">
                            React
                        </div>
                    </div>
                    <div class="row brique-ligne">
                        <div class="col brique">
                        PHP
                        </div>
                        <div class="col brique">
                        MySQL
                        </div>
                        <div class="col brique">
                        Javascript
                        </div>
                    </div>
                    <div class="row">
                        <div class="col brique">
                        HTML
                        </div>
                        <div class="col brique">
                        CSS
                        </div>
                        <div class="col brique">
                        Linux
                        </div>
                        <div class="col brique">
                        Git
                        </div>
                    </div>
            </article>
            <article id="softskills">
            <h2 class="section-title py-5">Mes <em>soft skills</em></h2>
            <!-- <div class="skills__container bd-grid"> -->
                <div class="skills__content container">
                    <div class="softskills_row">
                        <div class="movingicon">
                            problem solver
                        </div>
                        <div class="movingicon">
                            Curieux
                        </div>
                        <div class="movingicon">
                            Communicatif
                        </div>
                    </div>
                    <div class="softskills_row">
                        <div class="movingicon">
                            Collaboratif
                        </div>
                        <div class="movingicon">
                            Patient
                        </div>
                        <div class="movingicon">
                            Organisé
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section class="education section">
            <span class="section-subtitle">Qualification</span>
            <h2 class="section-title">My Education</h2>
            <div class="education__container bd-grid">

                <div class="education__content">
                    <div>
                        <h3 class="education__year">2020 - 2021</h3>
                        <a href="https://laplateforme.io/" class="education__university">La Plateforme_</a>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">Web developer</h3>
                        <span class="education__specialty">fullstack</span>
                    </div>
                </div>

                <div class="education__content">
                    <div>
                        <h3 class="education__year">2009-2013</h3>
                        <span class="education__university">University Paris I</span>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">PhD</h3>
                        <span class="education__specialty">Philosophy</span>
                    </div>
                </div>

                <div class="education__content">
                    <div>
                        <h3 class="education__year">2004-2015</h3>
                        <span class="education__university">UFMG</span>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">Master Degree</h3>
                        <span class="education__specialty">Philosophy</span>
                    </div>
                </div>

                <div class="education__content">
                    <div>
                        <h3 class="education__year">1998-2002</h3>
                        <span class="education__university">UFPE</span>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">Bachelor Degree</h3>
                        <span class="education__specialty">Journalism</span>
                    </div>
                </div>

            </div>
        </section>
        <section class="services section" id="services">
            <!-- <span class="section-subtitle">What I Offer</span> -->
            <h2 class="section-title">What I do</h2>

            <div class="services__container bd-grid">
                <div class="services__content">
                    <i class="bi bi-terminal services__icon"></i>
                    <h3 class="services__title">Websites</h3>
                    <p class="services__description">I can produce from scratch well referenced statical and dynamical web sites, from landing pages to fully functional and secure e-commerce applications</p>
                </div>

                <div class="services__content">
                    <i class="bi bi-easel services__icon"></i>
                    <h3 class="services__title">Courses and Workshops</h3>
                    <p class="services__description">I'm also available to giving introductory or in-depth courses and workshops on logic, algorithmical reasoning, and programming</p>
                </div>

                <div class="services__content">
                    <i class="services__icon bi bi-pen"></i>
                    <h3 class="services__title">Content writing</h3>
                    <p class="services__description">As a journalist and philosopher, I'm able to write articles about logic, philosophy, and the history of human knowledge (either in english, in french, in portuguese, or in italian).</p>
                </div>

            </div>
        </section>
        <section class="project section">
            <div class="project__container bd-grid">
                <div class="project__data">
                    <h2 class="section-title project__title">Some EdTech project in mind?</h2>
                    <p class="project__description">As a experienced teacher, researcher, and web developer, I could collaborate to make it happen.</p>
                    <a href="#contact" class="button button__light">contact me</a>
                </div>
                <img src="assets/images/fabio.jpg" alt="" class="project__img">
            </div>
        </section>
    <section class="works section" id="portfolio">
    <span class="section-subtitle">Mon portfolio</span>
    <h2 class="section-title">Mes projets</h2>

    <div class="works__container bd-grid">
        <div class="works__img">
            <!-- <img src="assets/images/amalfitana.jpg" alt=""> -->
            <div class="works__data">
                <a href="#" class="works__link"><i class="bi bi-link-45deg"></i></a>
                <span class="works__title">work 1</span>
            </div>
        </div>

        <div class="works__img">
            <!-- <img src="assets/images/amalfitana.jpg" alt=""> -->
            <div class="works__data">
                <a href="#" class="works__link"><i class="bi bi-link-45deg"></i></a>
                <span class="works__title">work 1</span>
            </div>
        </div>

        <div class="works__img">
            <!-- <img src="assets/images/amalfitana.jpg" alt=""> -->
            <div class="works__data">
                <a href="#" class="works__link"><i class="bi bi-link-45deg"></i></a>
                <span class="works__title">work 1</span>
            </div>
        </div>
    </div>
    </section>
    <section class="contact section" id="contact">
        <span class="section-subtitle">Contact me</span>
        <h2 class="section-title">Get in touch</h2>

        <div class="contact__container bd-grid">
            <form action="" class="contact__form">
                <div class="contact__inputs">
                    <input type="text" placeholder="Name" class="contact__input">
                    <input type="mail" placeholder="Email" class="contact__input">
                </div>

                <input type="text" placeholder="Project" class="contact__input">

                <textarea name="" id="" cols="0" rows="10" placeholder="Message" class="contact__input"></textarea>

                <input type="submit" value="Send Message" class="button contact__button">

            </form>

            <div>
                <div class="contact__info">
                    <h3 class="contact__subtitle">Call me</h3>
                    <span class="contact__text">+33 6 68 61 30 31</span>
                    <span class="contact__text">+33 6 68 61 30 31</span>
                </div>

                <div class="contact__info">
                    <h3 class="contact__subtitle">E-mail</h3>
                    <span class="contact__text">fabiovalho@gmail.com</span>
                    <span class="contact__text">fabiovalho@hotmail.com</span>
                </div>

                <div class="contact__info">
                    <h3 class="contact__subtitle">Location</h3>
                    <span class="contact__text">2 rue Ferrari</span>
                    <span class="contact__text">Marseille, France</span>
                </div>
            </div>
        </div>
    </section>
    </main>
<footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
        <!-- Section: Text -->
      <section class="mb-4">
        <p>
          You can find me also in the social media
        </p>
      </section>
      <!-- Section: Text -->
      <!-- Section: Social media -->
      <section class="mb-4">
        <div class="footer__social">
            <a href="#" class="btn btn-outline-light btn-floating m-1 footer__link" role="button">
                <i class="bi bi-facebook"></i></a>
            <a href="#" class="btn btn-outline-light btn-floating m-1 footer__link" role="button">
                <i class="bi bi-instagram"></i></a>
            <a href="#" class="btn btn-outline-light btn-floating m-1 footer__link" rol3="button">
                <i class="bi bi-twitter"></i></a>
        </div>
      </section>
      <!-- Section: Social media -->
        </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2021 Copyright:
      <a class="text-white" href="#">Fabio Tenorio de Carvalho</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    <!-- <footer class="footer section">
        <div class="footer__container bd-grid">
            <h1 class="footer__title">Fabio</h1>
            <p class="footer__description">I'm Fabio Tenorio and this is my personal website, consult me</p>
            <div class="footer__social">
                <a href="#" class="footer__link"><i class="bi bi-facebook"></i></a>
                <a href="#" class="footer__link"><i class="bi bi-instagram"></i></a>
                <a href="#" class="footer__link"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
        <p class="footer__copy">All rigths reserved by Bedimcode</p>
    </footer> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>