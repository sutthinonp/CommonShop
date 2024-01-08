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
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<script src="https://cdn.sellix.io/static/js/embed.js"></script>
<body>
<main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>
				<?php
	function rmtxt($FileName) {
	$text = array();
	$open = fopen($FileName, 'r+');
	if($open)
	{
		while(!feof($open))
		{
			$file = fgets($open, 4096);
			array_push($text, str_replace("\n", "", $file));
		}
		fclose($open);
		if(count($text) <= 1)
			return "Stock";
		else
		{
			$Buy = $text[rand(0, count($text)-1)];
			$text = null;
			$text = array();
			$open = fopen($FileName, 'r+');
			while(!feof($open))
			{
				$file = fgets($open, 1024);
				if(str_replace("\n", "", $file) != $Buy)
					array_push($text, str_replace("\n", "", $file));
			}
			fclose($open);
			$open = fopen($FileName, 'w');
			for($i = 0; $i <= count($text)-1; $i++)
			{
				if($i == count($text)-1)
					$t[$i] = $text[$i];
				else
					$t[$i] = $text[$i].'
';
				fwrite($open, $t[$i]); 
			}
			if($open) 
			{
				return $Buy;
			}
			else
			{
				return "Error";
			}
			fclose($open);
		}
	}
	else
	{
		return "Error";
	}
}
?>
<?php
$lastclickcooldowns = Query('SELECT cooldown FROM clients where username = :user', array(':user'=>$_SESSION['username']));
$lastclickcooldown = $lastclickcooldowns->fetchColumn();

function cooldown()
	{
		global $lastclickcooldown;
		if($lastclickcooldown > time()-(0)) //ตัวเลขคือจำนวนวินาที
		{
			return false;
		}else{
			return true;
		}
	}
if (isset($_POST['random'])) {
	if(cooldown() == true or $lastclickcooldown > time())
		{	
			$username = $_SESSION['username'];
			$time = date("Y-m-d H:i:s");
			$updatecooldown = Query("UPDATE `clients` SET `cooldown` = '".time()."' WHERE username = '$username' LIMIT 1;");
			$filename =  ''; //ชื่อไฟล์ที่ใส่ไอดีแท้ไว้ email:pass
			$data = rmtxt($filename);
			if($data == "Stock" || $data == "Error") {
			   echo "<script>
					Swal.fire(
					'Error!',
					'Sold!',
					'error'
					).then(function(isConfirm) {
						if (isConfirm === true) {
						}else {
						}
						});
					</script>";
	 			 exit();
				}else{
				$lib = explode(":",$data);
				$email = $lib[0];
				$password = $lib[1];
				$infoid = "$email:$password";
				$time = date("Y-m-d H:i:s");
				$q2 = Query("INSERT INTO `log_random` (`id`, `info`, `date`, `owner`, `type`) VALUES (NULL, '$infoid', '$time', '$username', 'mc')"); //ฐานข้อมูล
				echo "
				<script>
				Swal.fire(
				'Genarator!',
				'คุณได้รับมันแล้ววว Enjoy!',
				'success'
				).then(function(isConfirm) {
					if (isConfirm === true) {
						window.location = '/random';
					}else {
						window.location = '/random';
					}
					});
				</script>
							";
				}	
		}else{
			echo "<script>
			Swal.fire(
			  'Error!',
			  'กรุณารออีก 1 นาที!',
			  'error'
			);
			  </script>";
		}
}
?>
<style>
.imgphone {
    width: 100%;
    height: auto;
}
</style>
<div class="row">
<div class="col-sm-6 mx-auto">
  <div class="card">
	<div class="card-body">
	<form class="form fv-plugins-bootstrap5 fv-plugins-framework " method="post" action="">
	<img class="imgphone" src="https://lzd-img-global.slatic.net/g/ff/kf/S28bdb21feff24ffd9669f46641ca7c7dS.jpg_720x720q80.jpg_.webp">	
	
	<center>	
	  <br />
	  
	  <button 
      type=""
	  name=""
	  id=""
	  class="btn btn-block btn-info me-3 w-100 mb-5 text-center">
	  ปิดปรับปรุง.....
	  </button>		
	</center>	
</form>
	</div>
  </div>
</div>

</div>
<br />
<div class="row">
	<div class="col-sm-6 mx-auto">
		<div class="card">
			<div class="card-body">
			<div class="table-responsive">
				<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
														<thead>
															<tr class="fw-bolder text-muted">
																<th class="min-w-150px">#</th>
																<th class="min-w-140px">Email:Password</th>
																<th class="min-w-140px">Copy</th>
																<th class="min-w-120px">Date</th>
															</tr>
														</thead>
														<tbody>
														<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>															
			<?php					
									$username = $_SESSION['username'];
									$q = query("SELECT * FROM log_random WHERE owner = '$username' AND type = 'mc' ORDER BY id DESC");
									if ($q->rowCount() == 0) {
									}else{
										$result = $q->fetchAll();
										foreach($result as $row) {

						?>
															<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																<p class="text-light" sytle="" type="hidden" id="key<?php echo $row['id']; ?>"><?php echo $row['info']; ?></p>
															</ul>						
															<tr>
																<td>
																	<a href="" class="text-dark fw-bolder text-hover-primary fs-6"><?php echo $row['id']; ?></a>
																</td>
																<td>
																	<a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['info']; ?></a>
																</td>
																<td>
																	<a class="text-dark text-hover-primary fs-2 fw-bolder" onclick="copyToClipboard('#key<?php echo $row['id']; ?>')"><i class="far fa-clone"></i></a>
																</td>
																<td>
																	<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['date']; ?></a>
																</td>
															</tr>
											<?php 
										}
									}
						?>
														</tbody>
					</table>
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
</body>
</html>