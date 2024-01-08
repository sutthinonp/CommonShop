<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login');
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
$websites = Query('SELECT * FROM settings');
$website = $websites->fetch();
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
					<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
						<div id="kt_toolbar_container" class="container-xxl py-5">
							<div class="row gy-0 gx-10">
								<div class="col-xl-12">
									<div class="card card-xl-stretch bg-body border-0 mb-5 mb-xl-0">
										<div class="card-body d-flex flex-column flex-lg-row flex-stack p-lg-15">
											<div class="d-flex flex-column justify-content-center align-items-center align-items-lg-start me-10 text-center text-lg-start">
												<h3 class="fs-2hx line-height-lg mb-5">
													<span class="fw-bolder">ยินดีต้อนรับ</span>
													<br />
													<span class="fw-bold"><?php echo $_SESSION['username']; ?></span>
													
												</h3>
												<div class="fs-4 text-muted mb-7"><?php echo $website['description']; ?></div>
												<a href='shop' class="btn btn-success fw-bold px-6 py-3">เลือกซื้อสินค้าเลย</a>
											</div>
											<img src="" alt="" class="mw-300px mw-lg-350px mt-lg-n10" />
										</div>
									</div>
								</div>
							</div>							
						</div>
					</div>

					
					<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
					
						<div class="content flex-row-fluid" id="kt_content">
							<div class="row gy-0 gx-10">
							
								<div class="col-xl-8">
									<div class="card mb-10">
										<div class="card-header align-items-center border-0 mt-4">
											<h3 class="card-title align-items-start flex-column">
												<span class="fw-bolder mb-2 text-dark">ยินดีต้อนรับนะครับ ><</span>
												<span class="text-muted fw-bold fs-7">(Thx for Support Me.)</span>
												
											</h3>
										</div>								
									</div>
								</div>
								
								<div class="col-xl-4">
									<div class="card">
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">การเติมเงินล่าสุด</span>
											</h3>
										</div>
										<?php
										$tops = Query('SELECT * FROM log_topup where status = "success" ORDER BY id DESC LIMIT 5');

										?>
										<div class="card-body pt-5">

										<?php foreach($tops as $data) { ?>

											<div class="d-flex align-items-sm-center mb-7">
												<div class="symbol symbol-50px me-5">
												<span class="symbol-label">
														<img src="https://minotar.net/helm/<?php echo $data['username']; ?>" class="h-50 align-self-center" alt="" />
										</span>
												</div>
												<div class="d-flex align-items-center flex-row-fluid flex-wrap">
													<div class="flex-grow-1 me-2">
														<a class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?php echo $data['username']; ?></a>
														<span class="text-muted fw-bold d-block fs-7"><?php echo $data['transaction']; ?></span>
													</div>
													<span class="badge badge-light fw-bolder my-2">+<?php echo $data['point']; ?> เครดิต</span>
												</div>
											</div>
										<?php } ?>
										</div>
									</div>								
								</div>
								
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

    </main>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
<div id="modalContainer"></div>
</body>
</html>