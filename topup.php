<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
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
<link href="https://cdn.sellix.io/static/css/embed.css" rel="stylesheet"/>
</head>
<script src="https://cdn.sellix.io/static/js/embed.js"></script>
<body>
<main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>
				<?php if(@$_GET['select'] == "") { ?>				
					<?php
if (isset($_POST['payment-truewallet'])) {
	require_once("tw.class.php");
	$value = $_POST['link'];
	$truewallet = $website['truewallet'];
	$tc = new rb_gift();
	$vc = (object) $tc->RedeemVoucher("$value","$truewallet"); 
	if($vc->status['code'] != 'ERROR'){
		
                    echo "
					<script>
						Swal.fire(
						  'พบสิ่งผิดผลาด!',
						  'ไม่พบซองนี้ โปรดลองเช็คใหม่อีกครั้ง',
						  'warning'
						)
					</script>
					";
	}
	if($vc->status['code'] != 'SUCCESS'){
                    echo "
					<script>
						Swal.fire(
						  'พบสิ่งผิดผลาด!',
						  '$vc->status['code']',
						  'warning'
						)
					</script>
					";
	}else{
	if($vc->data['voucher']['member'] != "1"){
                    echo "
					<script>
						Swal.fire(
						  'พบสิ่งผิดผลาด!',
						  'กรุณาตั้งผู้รับเงิน 1 คนเท่านั้น',
						  'warning'
						)
					</script>
					";
	}else{
		$amount = $vc->data['voucher']['amount_baht'];
		$username = $_SESSION['username'];
		$test = $_POST['link'];
		$time = date("Y-m-d H:i:s");
		//$q2 = query("INSERT INTO `log_topup` (`id`, `value`, `transaction`, `time`, `point`, `amount`, `username`, `status`) VALUES (NULL, 'Truewallet', '$value', '".date("Y-m-d H:i:s")."', '$amount', '$amount', '$username', 'success'); ");
		$q2 = Query("INSERT INTO `log_topup` (`id`, `transaction`, `point`, `username`, `time`, `status`) VALUES (NULL, 'เติมเงินด้วยอังเปา', '$amount', '$username', '$time', 'success'); ");
		if (!$q2) {
							echo "
							<script>
								Swal.fire(
								  'พบสิ่งผิดผลาด!',
								  'โปรดติดต่อผู้ดูแลระบบ',
								  'warning'
								)
							</script>
							";
				}
		$topup = Query("UPDATE `clients` SET `coins` = coins+ '$amount' WHERE username = '$username'");
		if (!$topup) {
                    echo "
					<script>
						Swal.fire(
						  'พบสิ่งผิดผลาด!',
						  'โปรดติดต่อผู้ดูแลระบบ',
						  'warning'
						)
					</script>
					";
		}else{
						echo "
						<script>
						Swal.fire({
						  title: ':3',
						  text: 'เติมเงินสำเร็จ เป็นจำนวน $amount เครดิต',
						  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
						  imageWidth: 400,
						  imageHeight: 200,
						  imageAlt: 'Custom image',
						})
						</script>
						<meta http-equiv='refresh' content='2;URL=shop'>
						";
		}

      }


}




}
?>
<div class="col-xl-3 mt-15 container">
	<form class="form fv-plugins-bootstrap5 fv-plugins-framework " method="post" action="">
		<div class="mb-13 text-center">
			<h1 class="mb-3">TrueWallet อังเปา</h1>
		</div>
		<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
			<label class="d-flex align-items-center fs-6 fw-bold mb-2">
				<span class="required">ลิงก์ซองอังเปา</span>
			</label>
			<input type="text" name="link" class="form-control form-control-solid" placeholder="กรอกลิงก์ซองอังเปา" value="">
			<p class="text-danger">* กรุณาใส่ผู้รับเงิน 1 คนเท่านั้น</p>
			<p class="text-primary">* นี้คือระบบอัตโนมัติเงินจะเข้าภายในไม่กี่นาที</p>
			<div class="fv-plugins-message-container invalid-feedback"></div>
		</div>
		<div class="text-center">
			<button name="payment-truewallet" class="btn btn-primary">เติมเครดิต</button>
		</div>
	</form>
</div>	
<br />
<br />
<div class="container">
<br />
</div>
<br />
<div class="container">
<?php
if (isset($_POST['payment-key'])) {
	$key = $_POST['key'];
	if($key == "") {
		
		echo "
		<script>
			Swal.fire(
			  'พบสิ่งผิดผลาด!',
			  'กรุณากรอกคีย์',
			  'warning'
			)
		</script>
		";
	}else{

		$keytopup = Query("SELECT * FROM key_topup where keytext = '$key'");

		if(!$keytopup){
			echo "
			<script>
				Swal.fire(
				  'พบสิ่งผิดผลาด!',
				  'ไม่พบคีย์นี้',
				  'warning'
				)
			</script>
			";						
		}		
		foreach($keytopup as $data) {
			if($data['keytext'] == "$key") {

				if($data['status'] == NULL) {
					$amount = $data['amount'];
					$username = $_SESSION['username'];
					$time = date("Y-m-d H:i:s");
					$update1 = Query("UPDATE `key_topup` SET `date` = '$time' WHERE keytext = '$key'");
					$update2 = Query("UPDATE `key_topup` SET `owner` = '$username' WHERE keytext = '$key'");
					$update3 = Query("UPDATE `key_topup` SET `status` = 'success' WHERE keytext = '$key'");
					$q2 = Query("INSERT INTO `log_topup` (`id`, `transaction`, `point`, `username`, `time`, `status`) VALUES (NULL, 'เติมเงินด้วยคีย์', '$amount', '$username', '$time', 'success'); ");
					$topup = Query("UPDATE `clients` SET `coins` = coins+ '$amount' WHERE username = '$username'");
					if (!$topup) {
						echo "
						<script>
							Swal.fire(
							  'พบสิ่งผิดผลาด!',
							  'โปรดติดต่อผู้ดูแลระบบ',
							  'warning'
							)
						</script>
						";
					}else{
									echo "
									<script>
									Swal.fire({
									title: 'เติมคีย์สำเร็จ!',
									text: 'คุณได้รับ $amount เครดิต',
									imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
									imageWidth: 400,
									imageHeight: 200,
									imageAlt: 'Custom image',
									})
									</script>
									<meta http-equiv='refresh' content='2;URL=topup'>
									";
					}
	
	
				}else{
					echo "
					<script>
						Swal.fire(
						  'พบสิ่งผิดผลาด!',
						  'คีย์นี้ถูกใช้งานไปแล้ว',
						  'warning'
						)
					</script>
					";						
				}

			}else{
				echo "
				<script>
					Swal.fire(
					  'พบสิ่งผิดผลาด!',
					  'ไม่พบคีย์นี้',
					  'warning'
					)
				</script>
				";				
			}
		}

	}
}
?>

<div class="col-sm-6 mx-auto">
  <div class="card">
	<div class="card-body">
   		<h5 class="card-title">เติมเครดิตด้วยคีย์</h5>
    	<h6 class="card-subtitle mb-2 text-muted">สามารถซื้อคีย์ได้จากการติดต่อแอดมินเท่านั้น (Truemoney wallet) >3<br><i style="color:red;font-size:20px;font-family:calibri ;">
      (หากไม่สะดวกอั่งเปา)</i></h6>
		<form class="form fv-plugins-bootstrap5 fv-plugins-framework " method="post" action="">
			<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
				<br />
				<label class="d-flex align-items-center fs-6 fw-bold mb-2">
					<span class="required">คีย์</span>
				</label>
				<input type="text" name="key" class="form-control form-control-solid" placeholder="htr-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="">
				<p class="text-primary">* นี้คือระบบอัตโนมัติเงินจะเข้าภายในไม่กี่นาที</p>
				<div class="fv-plugins-message-container invalid-feedback"></div>
			</div>
		<div class="text-center">
			<button name="payment-key" class="btn btn-primary">เติมเครดิต</button>
		</div>
		</form>
  </div>
</div>
</div>

</div>
				<?php } ?>

</div>
</div>
</div>
 
    </main>

<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
</body>
</html>