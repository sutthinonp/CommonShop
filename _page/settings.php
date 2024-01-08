<?php
$websites = Query('SELECT * FROM settings');
$website = $websites->fetch();
?>
<?php
if (isset($_POST['btn-save'])) {
            $ids = "1";
            $namesite = $_POST['namesite'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $keywords = $_POST['keywords'];
            $truewallet = $_POST['truewallet'];
            $page_id = $_POST['page_id'];
            $theme_color = $_POST['theme_color'];
            $logged_in_greeting = $_POST['logged_in_greeting'];
            $discord = $_POST['discord'];
            
            $q1 = query('UPDATE settings SET title= :namesite, description= :description, image= :image, keywords= :keywords, truewallet= :truewallet, page_id= :page_id, theme_color= :theme_color, logged_in_greeting= :logged_in_greeting, discord= :discord WHERE id= :id', array(':namesite'=>$namesite,':description'=>$description,':image'=>$image,':keywords'=>$keywords,':truewallet'=>$truewallet,':page_id'=>$page_id,':theme_color'=>$theme_color,':logged_in_greeting'=>$logged_in_greeting,':discord'=>$discord,':id'=>$ids));
            if (!$q1) {
                    echo "
					<script>
						Swal.fire(
						  'ข้อมูลผิดผลาด!',
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
						  text: 'แก้ไขสำเร็จแล้วจ้า',
						  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
						  imageWidth: 400,
						  imageHeight: 200,
						  imageAlt: 'Custom image',
						})
						</script>
						<meta http-equiv='refresh' content='2;URL=backend?settings'>
						";
            }
        }

?>
<div class="container">
<form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="">
	<div class="col-xl-12">
		<div class="card-header border-0 pt-5">
			<div class="table-responsive">
					<div class="mb-13 text-center">
						<h1 class="mb-3">ตั้งค่าหน้าเว็บไซต์</h1>
					</div>

						<!--a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="">
							<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px" style="background-image:url('<?php echo $website['image']; ?>')"></div>
								<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
									<i class="bi bi-eye-fill fs-2x text-white"></i>
								</div>
						</a>
							<br /-->
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">ชื่อร้าน</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="กรอกชื่อร้าน" value="<?php echo $website['title']; ?>" name="namesite">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">คำอธิบายร้าน (จะแสดงเมื่อส่งลิงก์)</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="กรอกคำอธิบายร้าน" value="<?php echo $website['description']; ?>" name="description">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Keyword (คำค้นหา)</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="กรอกคำค้นหา" value="<?php echo $website['keywords']; ?>" name="keywords">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">รูปร้านค้า</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="กรอกรูปร้านค้า" value="<?php echo $website['image']; ?>" name="image">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>

			</div>
		</div>
	</div>

	<div class="col-xl-12">
		<div class="card-header border-0 pt-5">
			<div class="table-responsive">
					<div class="mb-13 text-center">
						<h1 class="mb-3">ตั่งค่าการเติมเงิน</h1>
					</div>
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">เบอร์ทรูวอเล็ต</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="กรอกเบอร์ทรูวอเล็ต" value="<?php echo $website['truewallet']; ?>" name="truewallet">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span>Tmtopup UID</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="กรอก Tmtopup UID" value="" name="inputProductName" disabled>
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
						

			</div>
		</div>
	</div>
	<div class="col-xl-12">
		<div class="card-header border-0 pt-5">
			<div class="table-responsive">
					<div class="mb-13 text-center">
						<h1 class="mb-3">Overlay Facebook</h1>
					</div>
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Page id</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="Page id" value="<?php echo $website['page_id']; ?>" name="page_id">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Theme Color</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="Theme Color" value="<?php echo $website['theme_color']; ?>" name="theme_color">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">ข้อความ</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="ข้อความ" value="<?php echo $website['logged_in_greeting']; ?>" name="logged_in_greeting">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
						

			</div>
		</div>
	</div>
	<div class="col-xl-12">
		<div class="card-header border-0 pt-5">
			<div class="table-responsive">
					<div class="mb-13 text-center">
						<h1 class="mb-3">ติดต่อ</h1>
					</div>
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Link Discord/Facebook</span>
								</label>
								<input type="text" class="form-control form-control-solid" placeholder="Link" value="<?php echo $website['discord']; ?>" name="discord">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
						

			</div>
		</div>
		
												<div class="text-center">
													 <input type="hidden" name="id" value="<?php echo $website['id']; ?>"></input>
													<button type="submit" name="btn-save" class="btn btn-primary">Save</button>
												</div>
	</div>
</form>
</div>