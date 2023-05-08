<?php
include "../models/functions/functions.php";
$pageTitle = 'Bug Tracking';
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {

    if ($_SESSION['userType'] != 2) {
        header("location: login.php");
    }
    // include "../views/includes/navbar.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php getTitle(); ?>
    </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- <link href="../views/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="../views/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
    <link href="../views/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/all.min.css">
    <link rel="stylesheet" href="../views/css/util.css">
    <link rel="stylesheet" href="../views/css/main.css">
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/css/style.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <nav class="navbar bg-body-secondary fixed-top na" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="../views/customer.php">BugTracking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menubar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="raise-bug.php">Raise bug</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chat.php">Message</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="showMyBug.php">View bugs</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                </div>
            </div>
        </div>
    </nav>
    <!-- ------------------------------- start html ------------------------------- -->

    <main>
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active main-photo">
                    <img src="../views/images/c-1.jpg" class="d-block w-100 main-photo__img" alt="..." id="home">
                    <div class="main-photo__color"></div>
                </div>
                <div class="carousel-item main-photo">
                    <img src="../views/images/c-2.jpg" class="d-block w-100 main-photo__img" alt="...">
                    <div class="main-photo__color"></div>
                </div>
                <div class="carousel-item main-photo">
                    <img src="../views/images/c-3.jpg" class="d-block w-100 main-photo__img" alt="...">
                    <div class="main-photo__color"></div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <section class="team">
            <div class="container">
                <div class="team-header" id="team">
                    <h2 class="team-header__text">our team</h2>
                    <div>
                        <span class="team-header__line"></span>
                        <span class="team-header__line"></span>
                    </div>
                    <p class="team-header__paragraph">اللهم ال 20 درجة</p>
                </div>
                <div class="team-content">
                    <div class="w-33">
                        <div class="team-player">
                            <img src="../views/images/us/migo.jpg" alt="Migo-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">Mohamed</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">full stack developer</p>

                            </div>
                        </div>
                    </div>
                    <div class="w-33">
                        <div class="team-player">
                            <img src="../views/images/us/moheb.jpg" alt="moheb-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">Omar moheb</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">full stack developer</p>

                            </div>
                        </div>
                    </div>
                    <div class="w-33">
                        <div class="team-player">
                            <img src="../views/images/us/kahrba.jpg" alt="kahrba-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">Ziad Mohamed</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">full stack developer</p>

                            </div>
                        </div>
                    </div>
                    <div class="w-33">
                        <div class="team-player">
                            <img src="../views/images/us/andel.jpg" alt="andel-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">Mohamed andel</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">full stack developer</p>

                            </div>
                        </div>
                    </div>
                    <div class="w-33">
                        <div class="team-player">
                            <img src="images/women/salma.png" alt="salma-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">salma osama</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">wadi degla</p>
                                <a href="salma.html"><button type="button"
                                        class="btn btn-outline-primary team-player__button">read more</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="w-33">
                        <div class="team-player">
                            <img src="images/men/ehab.png" alt="AhmedEhab-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">ahmed ehab</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">wadi degla</p>
                                <a href="ahmed-ehab.html"><button type="button"
                                        class="btn btn-outline-primary team-player__button">read more</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="w-33">
                        <div class="team-player">
                            <img src="../views/images/us/me.jpg" alt="mariam-photo" class="team-player__img">
                            <div class="team-player__content">
                                <h3 class="team-player__name">Abdallah samy</h3>
                                <span class="team-player__line"></span>
                                <p class="team-player__club">full stack developer</p>

                            </div>
                        </div>
                    </div>


                    <div class="player-hidden" id="another-players">
                        <div class="team-content">
                            <div class="w-33">
                                <div class="team-player">
                                    <img src="images/men/omar.png" alt="omar-photo" class="team-player__img">
                                    <div class="team-player__content">
                                        <h3 class="team-player__name">omar mohamed</h3>
                                        <span class="team-player__line"></span>
                                        <p class="team-player__club">elghaba club</p>
                                        <a href="haneen.html"><button type="button"
                                                class="btn btn-outline-primary team-player__button">read
                                                more</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-33">
                                <div class="team-player">
                                    <img src="images/women/hanna.png" alt="hana-photo" class="team-player__img">
                                    <div class="team-player__content">
                                        <h3 class="team-player__name">hana mohamed</h3>
                                        <span class="team-player__line"></span>
                                        <p class="team-player__club">Tagamoa Heights</p>
                                        <a href="momen.html"><button type="button"
                                                class="btn btn-outline-primary team-player__button">read
                                                more</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-33">
                                <div class="team-player">
                                    <img src="images/women/nada.png" alt="nada-photo" class="team-player__img">
                                    <div class="team-player__content">
                                        <h3 class="team-player__name">nada gamal</h3>
                                        <span class="team-player__line"></span>
                                        <p class="team-player__club">mokatam club</p>
                                        <a href="elfeky.html"><button type="button"
                                                class="btn btn-outline-primary team-player__button">read
                                                more</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-more">
                                <button type="button" class="btn btn-outline-primary team-more__button">show all
                                    players
                                </button>
                                <button type="button" class="btn btn-outline-primary team-more__button" id="less">show
                                    less
                                    <i class="fa-solid fa-chevron-up"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about" id="about">
            <div class="about-background">
                <div class="about-color">
                    <div class="container">
                        <div class="about-content">
                            <div class="about-title">
                                <h2 class="about-title__head">about us</h2>
                                <div>
                                    <span class="about-title__line"></span>
                                    <span class="about-title__line"></span>
                                </div>
                                <p class="about-title__text">Lorem ipsum dolor, sit amet consectetur adipisicing
                                    elit. Corrupti earum architecto sequi quae tempore sunt pariatur recusandae est
                                    repellat omnis molestias cumque iste molestiae nobis quo nam, harum quas
                                    blanditiis?</p>
                            </div>
                            <div class="about-img">
                                <!-- <img src="../views/images/background.jpg" alt="all players photo"
                                    class="about-img__photo"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <footer>
        <div class="container">
            <div class="row footer-row">
                <div class="useful-links col-lg-3 col-md-4 col-sm-6 col-12">
                    <h2 class="footer-content__header">useful links</h2>
                    <span class="footer-line"></span>
                    <ul class="footer-list">
                        <li class="footer-list__element"><a href="#" class="footer-list__link">home</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">team</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">about us</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">contact us</a></li>
                    </ul>
                </div>
                <div class="useful-links col-lg-3 col-md-4 col-sm-6 col-12">
                    <h2 class="footer-content__header">get help</h2>
                    <span class="footer-line"></span>
                    <ul class="footer-list">
                        <li class="footer-list__element"><a href="#" class="footer-list__link">home</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">team</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">about us</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">contact us</a></li>
                    </ul>
                </div>
                <div class="our-team col-lg-3 col-md-4 col-sm-6 col-12">
                    <h2 class="footer-content__header">our team</h2>
                    <span class="footer-line"></span>
                    <ul class="footer-list">
                        <li class="footer-list__element"><a href="#" class="footer-list__link">seniors</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">juniors</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">pre-team</a></li>
                        <li class="footer-list__element"><a href="#" class="footer-list__link">swim school</a></li>
                    </ul>
                </div>
                <div class="follow-us col-lg-3 col-md-4 col-sm-6 col-12">
                    <h2 class="footer-content__header">follow us</h2>
                    <span class="footer-line"></span>
                    <ul class="footer-list footer-follow">
                        <li class="follow-list"><a href="#" class="follow-list__link"><span
                                    class="follow-list__circle"><i
                                        class="fa-brands fa-whatsapp footer-icon"></i></span></a></li>
                        <li class="follow-list"><a href="#" class="follow-list__link"><span
                                    class="follow-list__circle"><i
                                        class="fa-brands fa-facebook-f footer-icon"></i></span></a></li>
                        <li class="follow-list"><a href="#" class="follow-list__link"><span
                                    class="follow-list__circle"><i
                                        class="fa-brands fa-instagram footer-icon"></i></span></a></li>
                        <li class="follow-list"><a href="#" class="follow-list__link"><span
                                    class="follow-list__circle"><i
                                        class="fa-brands fa-facebook-messenger footer-icon"></i></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- ------------------------------- end html ------------------------------- -->
    <script src="../views/admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../views/admin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../views/admin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="../views/admin/assets/vendor/quill/quill.min.js"></script>
    <script src="../views/admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../views/admin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../views/admin/assets/vendor/php-email-form/validate.js"></script>
    <script src="../views/js/bootstrap.bundle.min.js"></script>
    <script src="../views/js/main.js"></script>

    <!-- Template Main JS File -->
    <script src="../views/admin/assets/js/main.js"></script>

</body>

</html>
<?php //include "../views/includes/footer.php"; ?>