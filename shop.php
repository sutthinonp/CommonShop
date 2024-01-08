<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: home');
}
require_once(__DIR__ . '/include/Core.php'); 
require_once(__DIR__ . '/include/Config.php');
require_once(__DIR__ . '/include/PDOQuery.php');

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
<body>
    <main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
<?php MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>

			<div class="container">
				<h1>สินค้า<span class="d-inline-block position-relative ms-2"><span class="d-inline-block mb-2">ทั้งหมด</span><span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-success translate rounded"></span></span></h1>
				<div class="alert alert-success d-flex align-items-center p-5 mb-10">
					<span class="svg-icon svg-icon-2hx svg-icon-success me-4">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
							<path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
						</svg>
					</span>
					<div class="d-flex flex-column">
						<h4 class="mb-1 text-success">คำเตือน!</h4>
						<span>หากซื้อสินค้าผิดทางเราจะไม่คืนเครดิตหรือสินค้าใด ๆ ทั้งสิ้น</span>
					</div>
				</div>			
                <div class="row">
				<?php
                    $q = Query('SELECT * FROM products');
                    $result = $q->fetchAll();
                    foreach($result as $row) {
                        $product_id = $row['id'];
                        $product_name = $row['name'];
                        $product_desc = $row['description'];
                        $product_img = $row['image'];
                        $product_price = $row['price'];
                        $product_help = $row['help'];
                        $product_patt = $row['pattern'];
                        
                        $button_text = '??';
                        $stock_text = '??';
                        $q = Query('SELECT count(*) FROM stock WHERE type = :id AND owner = ""', array(':id'=>$product_id));
                        $result = $q->fetchColumn();
                        if ($result > 0) {
                            $stock_text = "$result $lang[instock]";
                        }else{
                            $stock_text = "⛔ สินค้าหมดแล้ว 📦";
                        }
                        if ($result > 0) {
                            $stock_button_text = "<i class='fas fa-shopping-cart text-white'></i> $lang[purchase] ฿$product_price";
                        }else{
                            $stock_button_text = $lang['outofstock'];
                        }
                        if ($result > 0) {
                            $stock_button = "";
                        }else{
                            $stock_button = "disabled";
                        }
                        if ($result > 0) {
                            $stock_button_disabled = "btn btn-lg w-100 btn-bg-primary text-white";
                        }else{
                            $stock_button_disabled = "btn btn-lg w-100 mb-5 btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger disabled";
                        }
                        
                        echo <<<EOD
                    <div class="col-md-6 col-lg-4 mt-10">
                        <div class="card border-0 shadow"><a><img src="$product_img" alt="$product_name" class="card-img-top"></a>
                            <div class="card-body">
                                <h5 class="text-center"><a href="">$product_name</a></h5>
                                <p class="text-muted card-text text-center">$stock_text</p><br/><button class="$stock_button_disabled" onclick="PurchaseModal($product_id)" type="button" data-bs-hover-animate="pulse" $stock_button>$stock_button_text</button></div>
                        </div>
                    </div>
EOD;
                    }
                ?></div>
            </div>
            </div>
            </div>



        </section>
    </main>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
<div id="modalContainer"></div>
</body>
</html>