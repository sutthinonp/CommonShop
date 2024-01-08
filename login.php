<?php 
error_reporting(0);
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
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
<?php echo MinifyTemplate(__DIR__ . 'template/navbar.php'); ?>
<body id="kt_body" class="bg-body">


		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<a href="" class="mb-12">
						<img alt="Logo" src="https://cdn.discordapp.com/attachments/856050861283999754/1087044369024045147/New_Project_1.jpg" class="h-50px" />
					</a>
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<form class="form w-100" method="post" action="">
							<div class="text-center mb-10">
								<h1 class="text-dark mb-3">เข้าสู่ระบบ</h1>
								<div class="text-gray-400 fw-bold fs-4">พึ่งเข้ามาครั่งแรกงั้นหรอ
								<a href="register" class="link-primary fw-bolder">สร้างบัญชี</a></div>
							</div>
							<?php
if (isset($_POST['btn-login'])) {
    if (!empty(rtrim($_POST['username'])) && !empty(rtrim($_POST['password']))) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        
        if (!empty($_SESSION['username'])) {
            $obj->status = 'error';
            $obj->info = 'คุณเข้าสู่ระบบอยู่แล้ว!';
            CreateJsonResponse();
        }
        
        if(!preg_match('/^[a-zA-Z0-9_-]+$/', $user)) {
                    echo "
					<script>
						Swal.fire(
						  'ชื่อผิดพลาด!',
						  'ต้องประกอบไปด้วย /^[a-zA-Z0-9_-]+$/',
						  'question'
						)
					</script>
					";
        }else{
            $q = Query('SELECT password FROM clients where username = :user', array(':user'=>$user));
            if ($q->rowCount() == 1) {
                $hash = $q->fetch()[0];
                if(password_verify($pass, $hash)) {
                    $_SESSION['username'] = $user;
						echo "
						<script>
						Swal.fire({
						  title: ':3',
						  text: 'เข้าสู่ระบบสำเร็จ ระบบกำลังโยนคุณไปหน้าหลัก',
						  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
						  imageWidth: 400,
						  imageHeight: 200,
						  imageAlt: 'Custom image',
						})
						</script>
						<meta http-equiv='refresh' content='2;URL=home'>
						
						";
                }else{
                    echo "
					<script>
						Swal.fire(
						  'ลืมข้อมูลหรือป่าว?',
						  'ดูเหมือนรหัสผ่านของคุณจะผิดนะ',
						  'question'
						)
					</script>
					";
                }
            }else{
                    echo "
					<script>
						Swal.fire(
						  'ไม่พบข้อมูล!',
						  'กรุณาตรวจสอบชื้อผู้ใช้ใหม่อีกครั้ง และลองใหม่นะ',
						  'question'
						)
					</script>
					";
            }
        }
    }else{
                    echo "
					<script>
						Swal.fire(
						  'ไม่พบข้อมูลที่กรอก!',
						  'กรุณาใส่ข้อมูลให้ครบถ้วน',
						  'question'
						)
					</script>
					";
    }
}
?>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">ชื่อผู้ใช้</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
							</div>
							<div class="fv-row mb-10">
								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-dark fs-6 mb-0">รหัสผ่าน</label>
									<a href="" class="link-primary fs-6 fw-bolder">ลืมรหัสผ่านงั้นหรอ?</a>
								</div>
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
							</div>
							<div class="text-center">
								<div class="form-group" data-bs-hover-animate="pulse">
								<button type="submit" name="btn-login" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">เข้าสู่ระบบ</button>
								</div>
								<a class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
								<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Comming Soon..</a>
								<a class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
								<img alt="Logo" src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3" />Comming Soon..</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
	</body>
</html>