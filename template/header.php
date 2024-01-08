<?php
date_default_timezone_set("Asia/Bangkok");
$websites = Query('SELECT * FROM settings');
$website = $websites->fetch();

$namesite = $website['title'];
$description = $website['description'];
$keywords = $website['keywords'];
?>
<?php
$rnd = uniqid();
$url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
return <<<EOD
<!-- Meta Tag -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$namesite</title>

<link rel="canonical" href="$url" />
<meta name="robots" content="noarchive">
<meta name="author" content="HitoriShop">
<meta name="description" content="$description">
<meta name="keywords" content="$keywords">
<meta property="og:type" content="article" /> 
<meta property="og:site_name" content="$namesite"/>
<meta property="og:url" content="$url" />
<meta property="og:title" content="$namesite" />
<meta property="og:description" content="$namesite" />
<meta property="og:image" content="" />


<link rel='shortcut icon' type='image/x-icon' href='' />
<link rel="apple-touch-icon" sizes="180x180" href="">
<link rel="icon" type="image/png" sizes="32x32" href="">
<link rel="icon" type="image/png" sizes="16x16" href="">
<link rel="manifest" href="site.webmanifest?_=$rnd">
<meta name="msapplication-TileColor" content="#50cd89">
<meta name="theme-color" content="#50cd89">

<!-- CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
<link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css?_=$rnd">
<link rel="stylesheet" href="assets/fonts/ionicons.min.css?_=$rnd">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Concert+One">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.min.css" integrity="sha256-1mciy4fJXvhqkSOwLvtpsTeBJ02AgAcmNYTzRMrzloU=" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

<!-- JS -->
<script src="assets/js/jquery.min.js?_=$rnd"></script>
<script src="assets/bootstrap/js/bootstrap.min.js?_=$rnd"></script>
<script src="assets/js/bs-animation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js" integrity="sha256-8wto0QRDpHJWujPs2SQ3X45VnIv9VpULlzMjqDXFRpI=" crossorigin="anonymous"></script>
<script src="assets/js/theme.js?_=$rnd"></script>
<script src="assets/js/jquery.ddslick.min.js?_=$rnd"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="assets/js/particles.js?_=$rnd"></script>
<script data-ad-client="ca-pub-8057505053693049" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<style>

	@import url(https://fonts.googleapis.com/css?family=Prompt&display=swap);

	* {
		font-family: 'Prompt', sans-serif;
	}

</style>


<!-- CUSTOM ;) -->
<script type="text/javascript" src="ajax/minekie.js?_=$rnd"></script>
<script>const swalx = swal.mixin({ confirmButtonClass: 'btn btn-info', cancelButtonClass: 'btn btn-danger', buttonsStyling: false, allowOutsideClick: false, allowEscapeKey: false, });</script>
EOD;
?>
