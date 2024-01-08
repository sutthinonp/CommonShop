<?php 
session_start();
require_once(__DIR__ . '/include/Core.php'); 
require_once(__DIR__ . '/include/Config.php');
require_once(__DIR__ . '/include/PDOQuery.php');
?>
<!DOCTYPE html>
<html><head>
<?php echo MinifyTemplate(__DIR__ . '/template/header.php'); ?>
</head><body>
<?php echo MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>
    <main class="page lanidng-page">
        <section data-aos="fade-up" data-aos-duration="1000" class="portfolio-block block-intro">
            <div class="container" data-aos="zoom-in">
                <div data-bs-hover-animate="rubberBand" class="avatar" style="background-image:url(&quot;assets/img/30265303_182950442506471_4327087990607183872_o.png&quot;);"></div>
                <div class="about-me" data-bs-hover-animate="pulse">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<a class="btn btn-dark btn-lg" role="button" href="shop.php">'.$lang['shop'].'</a></div>';
                    }else{
                        echo '<div class="btn-group" role="group"><button type="button" class="btn btn-dark btn-lg" href="login.php"><a class="btn btn-lg text-white btn-lg" href="login.php">'.$lang['login'].'</a></button><button type="button" class="btn btn-dark btn-lg" href="register.php"><a class="btn btn-lg text-white btn-lg" href="login.php">'.$lang['register'].'</a></button></div></div>';
                    }
                    ?>
            </div>
            <div class="swiper-slide" style="background-image:url(&quot;assets/img/30265303_182950442506471_4327087990607183872_o.png&quot;);"></div>
        </section>
        <section data-aos="fade-up" data-aos-duration="1000" class="portfolio-block website gradient" style="padding:50px;height:auto;">
            <div class="container text-white">
                <div class="heading">
                    <h1 style="padding:10px;"><strong><?=$lang['service']?></strong><br></h1>
                </div>
                <div class="row text-white" data-aos="zoom-in" style="width:auto;">
                    <div class="col-md-4" data-aos-duration="1000" data-aos-delay="500" data-bs-hover-animate="pulse">
                        <div class="card special-skill-item bg-transparent border-0">
                            <div class="card-header bg-transparent border-0"><i class="icon ion-ios-game-controller-a bg-dark" data-bs-hover-animate="pulse"></i></div>
                            <div class="card-body">
                                <h3 class="card-title">ID Minecraft</h3>
                                <p class="text-white"><?=$lang['first_desc']?><br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos-duration="1000" data-aos-delay="1000" data-bs-hover-animate="pulse">
                        <div class="card special-skill-item bg-transparent border-0">
                            <div class="card-header bg-transparent border-0"><i class="icon ion-android-cart bg-dark" data-bs-hover-animate="pulse"></i></div>
                            <div class="card-body">
                                <h3 class="card-title">Shop</h3>
                                <p class="text-white"><?=$lang['second_desc']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos-duration="1000" data-aos-delay="1500" data-bs-hover-animate="pulse">
                        <div class="card special-skill-item bg-transparent border-0">
                            <div class="card-header bg-transparent border-0"><i class="icon ion-settings bg-dark"></i></div>
                            <div class="card-body">
                                <h3 class="card-title">Support</h3>
                                <p class=" text-white"><?=$lang['third_desc']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="simple-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
</body>
</html>