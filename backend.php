<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /login');
}
require_once(__DIR__ . '/include/Core.php'); 
require_once(__DIR__ . '/include/Config.php');
require_once(__DIR__ . '/include/PDOQuery.php');
$q = Query('SELECT type FROM clients where username = :user', array(':user'=>$_SESSION['username']));
$status = $q->fetchColumn();
if ($status !== 'manager') {
    header('Location: home');
}

if($_GET['lang']){
    $_SESSION['lang'] = $_GET['lang'];
    header('Location:'.$_SERVER['PHP_SELF']);
    exit();
}

switch($_SESSION['lang']){
    case "th":
        require('lang/th.php');
    break;
    case "en":
        require('lang/en.php');
    break;
    default:
        require('lang/th.php');
    }
?>

<!DOCTYPE html>
<html><head>
<?php echo MinifyTemplate(__DIR__ . '/template/header.php'); ?>
</head>
    <main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php MinifyTemplate(__DIR__ . '/template/_admin_navbar.php'); ?>
				<div class="container">
		<?php
			if(isset($_GET['home'])) {
				require('_page/home.php');
			}
			if(isset($_GET['product'])) {
				require('_page/product.php');
			}
			if(isset($_GET['stock'])) {
				require('_page/stock.php');
			}
			if(isset($_GET['user'])) {
				require('_page/user.php');
			}
			if(isset($_GET['key'])) {
				require('_page/key.php');
			}
			if(isset($_GET['post'])) {
				require('_page/post.php');
			}
			if(isset($_GET['settings'])) {
				require('_page/settings.php');
			}
		?>
				</div>
			</div>
		</div>
	</main>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>

</body>
</html>