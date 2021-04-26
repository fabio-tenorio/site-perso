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
            <a class="navbar-brand" id="moilogo" href="#">FT</a>
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
            <h2 class="section-title section-about-me">Qui suis-je?</h2>
            <div class="about__container bd-grid">
                <div class="about__data">
                    <p class="about__description">
                        Pendant 15 ans, j'ai exercé avec enthousiasme le métier d'enseignant et de chercheur au Brésil,
                        mon pays d'origine. En France depuis septembre 2019, j'ai décidé de rélier deux anciennes passions
                        - l'éducation et l'informatique - afin de faire converger mes compétences vers un nouvel objectif
                        professionnel: contribuer aux avancées technologiques dans le secteur des EdTech's.
                    </p>
                </div>
                <div class="about__badge">
                    <div class="about__information">
                        <h3 class="about__information-title">Profil</h3>
                        <div class="about__information-data">
                            <img id="moi2" src="assets/images/moi2.jpg" alt="Fabio Tenorio de Carvalho">
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
            <h2 class="section-title">Ma formation</h2>
            <div class="education__container bd-grid">
                <div class="education__content">
                    <div>
                        <h3 class="education__year">2020 - 2021</h3>
                        <a target="blank" href="https://laplateforme.io/" class="education__university">La Plateforme_</a>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">développeur</h3>
                        <span class="education__specialty">web & mobile</span>
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
                        <h3 class="education__year">2004-2008</h3>
                        <span class="education__university">Université Fédérale de Minas Gerais</span>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">Master</h3>
                        <span class="education__specialty">Philosophy</span>
                    </div>
                </div>

                <div class="education__content">
                    <div>
                        <h3 class="education__year">1998-2002</h3>
                        <span class="education__university">Université Fédérale de Pernambouc</span>
                    </div>

                    <div class="education__time">
                        <span class="education__rounder"></span>
                        <span class="education__line"></span>
                    </div>

                    <div>
                        <h3 class="education__race">Licence</h3>
                        <span class="education__specialty">École de Journalisme et de Communication</span>
                    </div>
                </div>

            </div>
        </section>
        <section class="works section" id="portfolio">
        <!-- <div class="controls">
            <h1>Animations, Transitions and 3D Transforms</h1>
            <p>This demo shows some more interesting content using 3D transforms, animations and transitions.
            Note that you can still select the text on the the elements, even while they are rotating. Transforms elements remain
                fully interactive.</p>
            <p>Click Toggle Shape to switch between nested cubes and one big ring. Note how the planes move smoothly to their new locations,
            even while the whole shape is rotating. You can even interrupt this transition by clicking again, and they move back smoothly.</p>
            <p>Toggle the Backfaces Visible checkbox to turn backfaces on and off using <code>-webkit-backface-visibility</code>.</p>
            <div><button onclick="toggleShape()">Toggle Shape</button></div>
            <div><input type="checkbox" id="backfaces" onclick="toggleBackfaces()" checked><label for="backfaces">Backfaces visible</label></div>
        </div>

        <div id="container">
            <div id="stage">
                <div id="shape" class="cube backfaces">
                    <div class="plane one">
                        <a target="blank" href="assets/projets/livre-or/index.php">un livre d'or</a>
                        <h3>Un livre d'or dédié à Spinoza</h3>
                        <h4>l'un de mes premiers projets en PHP</h4>
                    </div>
                    <div class="plane two">
                        <a target="blank" href="assets/projets/app-favorites/app-favorites.html">site sur mes app favorites</a>
                    </div>
                    <div class="plane three">
                        <a target="blank" href="assets/projets/voyages/voyages.html">un site de voyages</a>
                    </div>
                    <div class="plane four">
                        <a target="blank" href="assets/projets/discussion/index.php">un espace de discussion</a>
                    </div>
                    <div class="plane five">
                        <img class="works__prt" src="assets/images/forum.png" alt="">
                    </div>
                    <div class="plane six">6</div>
                    <div class="plane seven">7</div>
                    <div class="plane eight">8</div>
                    <div class="plane nine">9</div>
                    <div class="plane ten">10</div>
                    <div class="plane eleven">11</div>
                    <div class="plane twelve">12</div>
                </div>
            </div>
        </div> -->
        <h2 class="section-title">Mes projets</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 my-3 works__img">
                    <img class="works__prt" src="assets/images/forum.png" alt="">
                    <div class="works__data">
                        <a target="_blank" href="assets/projets/forum/index.php" class="works__link"><i class="bi bi-link-45deg"></i></a>
                        <span class="works__title">un forum sur l'informatique</span>
                        <p>en collaboration avec Emmanuel Cabassot et Olivier Puche</p>
                    </div>
                </div>
                <div class="col-sm-6 my-3 works__img">
                    <img class="works__prt" src="assets/images/boutique.png" alt="">
                    <div class="works__data">
                        <a target="_blank" href="assets/projets/boutique/index.php" class="works__link"><i class="bi bi-link-45deg"></i></a>
                        <span class="works__title">une boutique en ligne</span>
                        <p>en collaboration avec Olivier Puche</p>
                    </div>
                </div>
                <div class="col-sm-6 my-3 works__img">
                    <img class="works__prt" src="assets/images/discussion.png" alt="">
                    <div class="works__data">
                        <a target="_blank" href="assets/projets/discussion/index.php" class="works__link"><i class="bi bi-link-45deg"></i></a>
                        <span class="works__title">un espace de discussion</span>
                        <p>projet réalisé en PHP, MySQL, HTML et CSS</p>
                    </div>
                </div>
                <div class="col-sm-6 my-3 works__img">
                    <img class="works__prt" src="assets/images/livre-or.png" alt="">
                    <div class="works__data">
                        <a target="_blank" href="assets/projets/livre-or/index.php" class="works__link"><i class="bi bi-link-45deg"></i></a>
                        <span class="works__title">Un livre d'or dédié à Spinoza</span>
                        <p>l'un de mes premiers projets en PHP</p>
                    </div>
                </div>
                <div class="col-sm-6 my-3 works__img">
                    <img class="works__prt" src="assets/images/app-favorites.png" alt="">
                    <div class="works__data">
                        <a target="_blank" href="assets/projets/app-favorites/app-favorites.html" class="works__link"><i class="bi bi-link-45deg"></i></a>
                        <span class="works__title">mes applications favorites</span>
                        <p>histoire de pratiquer un peu du CSS</p>
                    </div>
                </div>
                <div class="col-sm-6 my-3 works__img">
                    <img class="works__prt" src="assets/images/voyages.png" alt="">
                    <div class="works__data">
                        <a target="_blank" href="assets/projets/voyages/voyages.html" class="works__link"><i class="bi bi-link-45deg"></i></a>
                        <span class="works__title">un site de voyages</span>
                        <p>en collaboration avec Claude Rodrigues et Evan Azemard</p>
                    </div>
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
          Vous me trouverez égalément sur les réseaux sociaux
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
            <a href="#" class="btn btn-outline-light btn-floating m-1 footer__link" role="button">
                <i class="bi bi-twitter"></i></a>
        </div>
      </section>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2021 Copyright:
      <a class="text-white" href="#">Fabio Tenorio de Carvalho</a>
    </div>
  </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>