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
	<main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>
<?php 
    $q = query('SELECT * FROM stock WHERE owner = :user AND id = :id', array(':user'=>strtolower($_SESSION['username']), ':id'=>$_GET['id']));
    $result = $q->fetchAll();
    foreach($result as $row) {
        $item_id = $row['id'];
        $item_type = $row['type'];
        $item_contents = $row['contents'];
        $item_date = $row['date'];
        $item_owner = $row['owner'];    
	?>
<?php if($_GET['id'] == $item_id) { ?>
<?php
   $q = query('SELECT * FROM products WHERE id = :id', array(':id'=>$item_type));
    $result = $q->fetchAll();
    foreach($result as $row) {
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_help = $row['help'];
        $product_patt = $row['pattern'];
    }
    
    if ($product_patt == 'usr:eml:psw') {
        $order_preset = $item_contents;
        $array =  explode(':', $order_preset);
        $order['user'] = array_values($array)[0];
        $order['email'] = array_values($array)[1];
        $order['pass'] = array_values($array)[2];
        $order_contents = '<b>Email</b>: '.$order['email'].'<br>';
        $order_contents .= '<b>Username</b>: '.$order['user'].'<br>';
        $order_contents .= '<b>Password</b>: '.$order['pass'];
    }elseif ($product_patt == 'usr:psw') {
        $order_preset = $item_contents;
        $array =  explode(':', $order_preset);
        $order['user'] = array_values($array)[0];
        $order['pass'] = array_values($array)[1];
        $order_contents = '<b>Username</b>: '.$order['user'].'<br>';
        $order_contents .= '<b>Password</b>: '.$order['pass'];
    }elseif ($product_patt == 'eml:psw') {
        $order_preset = $item_contents;
        $array =  explode(':', $order_preset);
        $order['email'] = array_values($array)[0];
        $order['pass'] = array_values($array)[1];
        $order_contents = '<b>Email</b>: '.$order['email'].'<br>';
        $order_contents .= '<b>Password</b>: '.$order['pass'];
    }elseif ($product_patt == 'code') {
        $order_contents = '<b>Code</b>: ' . $item_contents;
    }elseif ($product_patt == 'normaltext') {
        $order_contents = $item_contents;
    }
?>

				<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
						<div class="content flex-row-fluid" id="kt_content">
							<div class="card">
								<div class="card-body p-lg-20">
									<div class="d-flex flex-column flex-xl-row">
										<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
											<div class="mt-n1">
												<div class="d-flex flex-stack pb-10">
													<a href="#">
														<img alt="Logo" src="https://cdn.discordapp.com/attachments/944250091735236659/1085445784926957578/New_Project.gif
														">
													</a>
													<a href="<?php echo $website['discord']; ?>" class="btn btn-sm btn-success">แจ้งปัญหาสินค้า</a>
												</div>
												<div class="m-0">
													<div class="fw-bolder fs-3 text-gray-800 mb-8">Order #<?php echo $item_id; ?></div>
													<div class="row g-5 mb-11">
														<div class="col-sm-6">
															<div class="fw-bold fs-7 text-gray-600 mb-1">สั่งซื้อเมื่อ:</div>
															<div class="fw-bolder fs-6 text-gray-800"><?php echo $item_date; ?></div>
														</div>
													</div>
													<div class="row g-5 mb-12">
														<div class="col-sm-6">
															<div class="fw-bold fs-7 text-gray-600 mb-1">สั่งซื้อที่:</div>
															<div class="fw-bolder fs-6 text-gray-800"><?php echo $website['title']; ?></div>
														</div>
														<div class="col-sm-6">
															<div class="fw-bold fs-7 text-gray-600 mb-1">รับรองโดย:</div>
															<div class="fw-bolder fs-6 text-gray-800">LEGENDSALMON SHOP</div>
														</div>
														<!--end::Col-->
													</div>
													<!--end::Row-->
													<!--begin::Content-->
													<div class="flex-grow-1">
														<!--begin::Table-->
														<div class="table-responsive border-bottom mb-9">
															<table class="table mb-3">
																<thead>
																	<tr class="border-bottom fs-6 fw-bolder text-muted">
																		<th class="min-w-175px pb-2">Product</th>
																		<th class="min-w-100px text-end pb-2">Amount</th>
																	</tr>
																</thead>
																<tbody>
																	<tr class="fw-bolder text-gray-700 fs-5 text-end">
																		<td class="d-flex align-items-center">
																		<i class="fa fa-genderless text-primary fs-2 me-2"></i><?php echo $product_name; ?></td>
																		<td class="fs-5 text-dark fw-boldest">฿ <?php echo $product_price; ?></td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class="d-flex justify-content-end">
															<div class="mw-300px">
																<div class="d-flex flex-stack mb-3">
																	<div class="fw-bold pe-10 text-gray-600 fs-7">รวม:</div>
																	<div class="text-end fw-bolder fs-6 text-gray-800">฿ <?php echo $product_price; ?></div>
																</div>
																<div class="d-flex flex-stack mb-3">
																	<div class="fw-bold pe-10 text-gray-600 fs-7">ภาษีมูลค่าเพิ่ม 0%</div>
																	<div class="text-end fw-bolder fs-6 text-gray-800">฿ 0.00</div>
																</div>
																<div class="d-flex flex-stack mb-3">
																	<div class="fw-bold pe-10 text-gray-600 fs-7">ราคารวม + ภาษีมูลค่าเพิ่ม</div>
																	<div class="text-end fw-bolder fs-6 text-gray-800">฿ <?php echo $product_price; ?></div>
																</div>
																<div class="d-flex flex-stack">
																	<div class="fw-bold pe-10 text-gray-600 fs-7">ผลรวม</div>
																	<div class="text-end fw-bolder fs-6 text-gray-800">฿ <?php echo $product_price; ?></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="m-0">
											<div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
												<div class="mb-8">
													<span class="badge badge-light-primary me-2">จ่ายแล้ว</span>
												</div>
												
												<h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">รายละเอียดการชําระเงิน</h6>
												
												<div class="mb-6">
													<div class="fw-bold text-gray-600 fs-7">เครดิตในระบบ:</div>
													<div class="fw-bolder text-gray-800 fs-6"><?php echo $website['title']; ?></div>
												</div>
												
												<div class="mb-6">
													<div class="fw-bold text-gray-600 fs-7">ข้อมูลบัญชี:</div>
													<div class="fw-bolder text-gray-800 fs-6"><?php echo $order_contents; ?>
												</div>
												<br />
												<div class="mb-6">
													<div class="fw-bold text-gray-600 fs-7">วิธีการใช้งาน:</div>
													<div class="fw-bolder text-gray-800 fs-6"><?php echo $product_help; ?>
												</div>
												<br />
												<div class="mb-15">
													<div class="fw-bold text-gray-600 fs-7">ประกันโดยรวม:</div>
													<div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center">1 วัน
													<span class="fs-7 text-danger d-flex align-items-center">
													<span class="bullet bullet-dot bg-danger mx-2"></span>แล้วแต่สินค้าที่ท่านสั่งซื้อ</span></div>
												</div>
												<h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">ข้อมูลเบื้องต้น</h6>
												<div class="mb-6">
													<div class="fw-bold text-gray-600 fs-7">หากมีปัญหา หรือ จะเคลมสินค้า</div>
													<p> <a href="https://www.facebook.com/phuttawat.pot/" class="link-primary">click</a></div>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } } ?>
				</div>
			</div>
		</div>

    </main>

<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>					