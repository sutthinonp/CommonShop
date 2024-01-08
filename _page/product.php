									<?php
	$q = query('SELECT * FROM products');
	$result = $q->fetchAll();
	foreach($result as $row){
		
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_desc = $row['description'];
        $product_img = $row['image'];
        $product_price = $row['price'];
        $product_help = $row['help'];
        $product_patt = $row['pattern'];
?>									
<?php if(@$_GET['id'] == $product_id) { ?>
<?php
if (isset($_POST['btn-edit'])) {
    if (!empty(rtrim($_POST['inputProductId'])) && !empty(rtrim($_POST['inputProductName'])) && !empty(rtrim($_POST['inputProductPrice'])) && !empty(rtrim($_POST['inputProductDesc'])) && !empty(rtrim($_POST['inputProductHelp'])) && !empty(rtrim($_POST['inputProductImg'])) && !empty(rtrim($_POST['inputProductPattern']))) {
        $allowed_pattern = array("normaltext","code","eml:psw","usr:psw","usr:eml:psw");
        if (is_numeric($_POST['inputProductId']) && is_numeric($_POST['inputProductPrice']) && in_array($_POST['inputProductPattern'], $allowed_pattern)) {
            $id = $_POST['inputProductId'];
            $req_name = $_POST['inputProductName'];
            $req_price = floor($_POST['inputProductPrice']);
            $req_desc = $_POST['inputProductDesc'];
            $req_help = $_POST['inputProductHelp'];
            $req_img = $_POST['inputProductImg'];
            $req_patt = $_POST['inputProductPattern'];
            
            $q1 = query('UPDATE products SET name= :name, description= :desc, price= :price, pattern= :patt, help= :inst, image= :img WHERE id= :id', array(':name'=>$req_name,':desc'=>$req_desc,':price'=>$req_price,':patt'=>$req_patt,':inst'=>$req_help,':img'=>$req_img,':id'=>$id));
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
						<meta http-equiv='refresh' content='2;URL=backend?product'>
						";
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
<div class="col-xl-6 container">
<form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="">
												<div class="mb-13 text-center">
													<h1 class="mb-3">แก้ไขสินค้า</h1>
													<div class="text-muted fw-bold fs-5"><?php echo $product_name; ?></div>
												</div>
												<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
													<label class="d-flex align-items-center fs-6 fw-bold mb-2">
														<span class="required">ชื่อสินค้า</span>
														<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="ชื่อสินค้าทำให้ผู้คนนั้นเข้าใจสินค้าที่เราขาย ห้ามเว้นว่าง ห้ามยาวเกินไป" aria-label="ชื่อสินค้าทำให้ผู้คนนั้นเข้าใจสินค้าที่เราขาย ห้ามเว้นว่าง ห้ามยาวเกินไป"></i>
													</label>
													<input type="text" class="form-control form-control-solid" placeholder="กรอกชื่อสินค้า" value="<?php echo $product_name; ?>" name="inputProductName">
												<div class="fv-plugins-message-container invalid-feedback"></div>
												</div>
												<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
												
													<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="<?php echo $row['image']; ?>">
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('<?php echo $row['image']; ?>')"></div>
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-2x text-white"></i>
														</div>
													</a>
													<br>
													<label class="d-flex align-items-center fs-6 fw-bold mb-2">
														<span class="required">รูปสินค้า</span>
													</label>
													<input type="text" class="form-control form-control-solid" placeholder="รูปสินค้า" value="<?php echo $product_img; ?>" name="inputProductImg">
												<div class="fv-plugins-message-container invalid-feedback"></div>
												</div>
												<div class="row g-9 mb-8">
													<div class="col-md-6 fv-row fv-plugins-icon-container">
														<label class="required fs-6 fw-bold mb-2">รูปแบบสินค้า</label>
														<select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" value="<?php echo $row['pattern']; ?>" name="inputProductPattern" tabindex="-1" aria-hidden="true">
															<option value="none" selected disabled>โปรดเลือกวิธีการจัดส่ง</option>
															<option value="normaltext"<?php if($product_patt == 'normaltext') { echo 'selected';} ?>>&middot; ข้อความธรรมดา &middot; (เหมาะสำหรับการส่ง URL หรือข้อความต่างๆ)</option>
															<option value="code"<?php if($product_patt == 'code') { echo 'selected';} ?>>&middot; Gift Code / Redeem Code &middot; (เหมาะสำหรับคีย์เกมทั่วๆไป)</option>
															<option value="eml:psw"<?php if($product_patt == 'eml:psw') { echo 'selected';} ?>>&middot; Email:Password &middot; (เหมาะสำหรับ Account บนเว็บส่วนใหญ่)</option>
															<option value="usr:psw"<?php if($product_patt == 'usr:psw') { echo 'selected';} ?>>&middot; Username:Password &middot; (เหมาะสำหรับ Platform เกมต่างๆเช่น Steam, Garena)</option>
															<option value="usr:eml:psw"<?php if($product_patt == 'usr:eml:psw') { echo 'selected';} ?>>&middot; Username:Email:Password &middot; (เหมาะสำหรับ ID Minecraft Migrate)</option>
														</select>
													<div class="fv-plugins-message-container invalid-feedback"></div></div>

													<div class="col-md-6 fv-row">
														<label class="d-flex align-items-center fs-6 fw-bold mb-2">
														<span class="required">ราคา</span>
														</label>
														<input type="text" class="form-control form-control-solid" placeholder="กรอกชื่อสินค้า" value="<?php echo $row['price']; ?>" name="inputProductPrice">

													</div>
												</div>
												
												<div class="d-flex flex-column mb-8">
													<label class="fs-6 fw-bold mb-2">คำอธิบายสินค้า</label>
													<textarea class="form-control form-control-solid" rows="10" name="inputProductDesc" ><?php echo $product_desc; ?></textarea>
												</div>
												
												<div class="d-flex flex-column mb-8">
													<label class="fs-6 fw-bold mb-2">วิธีการใช้งาน</label>
													<textarea class="form-control form-control-solid" rows="5" name="inputProductHelp" ><?php echo $product_help; ?></textarea>
												</div>
												
												<div class="text-center">
													<a onclick="location.href='backend?product'"  class="btn btn-light me-3">Cancel</a>
													 <input type="hidden" name="inputProductId" value="<?php echo $product_id; ?>"></input>
													<a onclick="deleteProduct(<?php echo $product_id; ?>);"  class="btn btn-danger me-3">Delete</a>
													<button type="submit" name="btn-edit" class="btn btn-primary">Save</button>
												</div>
											<div></div></form>
</div>			

								
<?php } ?>
<script>
function deleteProduct(id) {
    swalx({
      title: 'แน่ใจหรือไม่ที่จะลบสินค้านี้',
      text: "หากลบไปแล้วท่านจะไม่สามารถกู้คืนได้",
      type: 'question',
      showCancelButton: true,
      confirmButtonText: 'ดำเนินการต่อ',
      cancelButtonText: 'ยกเลิก',
      reverseButtons: true,
      allowEscapeKey: false,
      allowEnterKey: false,
      allowOutsideClick: false
    }).then((result) => {
      if (result.value) {
        $.get("ajax/b_delete_item.php?id="+id, function(data, status){
            if (data == "OK") {
                swalx({
                    title: 'Success!', 
                    text: 'ทำการลบสำเร็จ!', 
                    type: 'success',
                    timer: 1500,
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(
                    function() { window.location.href = 'backend?product'; }
                );
            }else{
                ezSwal("เกิดข้อผิดพลาด","ไม่สามารถลบได้","error");
            }
        });
      } else if (
        result.dismiss === swal.DismissReason.cancel
      ) {
        swal.close();
      }
    })
}
</script>
<?php } ?>
<?php 
if(isset($_GET['add'])) { ?>
<?php
if (isset($_POST['btn-add'])) {
    if (!empty(rtrim($_POST['inputProductName'])) && !empty(rtrim($_POST['inputProductPrice'])) && !empty(rtrim($_POST['inputProductDesc'])) && !empty(rtrim($_POST['inputProductHelp'])) && !empty(rtrim($_POST['inputProductImg'])) && !empty(rtrim($_POST['inputProductPattern']))) {
        $allowed_pattern = array("normaltext","code","eml:psw","usr:psw","usr:eml:psw");
        if (is_numeric($_POST['inputProductPrice']) && in_array($_POST['inputProductPattern'], $allowed_pattern)) {
            $req_name = $_POST['inputProductName'];
            $req_price = floor($_POST['inputProductPrice']);
            $req_desc = $_POST['inputProductDesc'];
            $req_help = $_POST['inputProductHelp'];
            $req_img = $_POST['inputProductImg'];
            $req_patt = $_POST['inputProductPattern'];
            
            $q1 = query('INSERT INTO products (name, description, price, pattern, help, image) VALUES (:name, :desc, :price, :patt, :inst, :img)', array(':name'=>$req_name,':desc'=>$req_desc,':price'=>$req_price,':patt'=>$req_patt,':inst'=>$req_help,':img'=>$req_img));
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
						  text: 'เพิ่มสินค้าแบ้วว',
						  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
						  imageWidth: 400,
						  imageHeight: 200,
						  imageAlt: 'Custom image',
						})
						</script>
						<meta http-equiv='refresh' content='2;URL=backend?product'>
						";
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

<div class="col-xl-6 container">
	<div class="table-responsive">
		<form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="">
			<div class="mb-13 text-center">
				<h1 class="mb-3">เพิ่มสินค้า</h1>
			</div>

			<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
				<label class="d-flex align-items-center fs-6 fw-bold mb-2">
					<span class="required">ชื่อสินค้า</span>
					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="ชื่อสินค้าทำให้ผู้คนนั้นเข้าใจสินค้าที่เราขาย ห้ามเว้นว่าง ห้ามยาวเกินไป" aria-label="ชื่อสินค้าทำให้ผู้คนนั้นเข้าใจสินค้าที่เราขาย ห้ามเว้นว่าง ห้ามยาวเกินไป"></i>
				</label>
				<input type="text" class="form-control form-control-solid" placeholder="กรอกชื่อสินค้า" value="" name="inputProductName">
			<div class="fv-plugins-message-container invalid-feedback"></div>
			</div>
			
			<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
				<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="">
					<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px" style="background-image:url('https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif?')"></div>
						<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
							<i class="bi bi-eye-fill fs-2x text-white"></i>
						</div>
				</a>
				<br>
				<label class="d-flex align-items-center fs-6 fw-bold mb-2">
					<span class="required">รูปสินค้า</span>
				</label>
				<input type="text" class="form-control form-control-solid" placeholder="รูปสินค้า" value=""  id="inputProductImg" name="inputProductImg">
				<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>		

				
						<label class="required fs-6 fw-bold mb-2">รูปแบบสินค้า</label>
							<select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" name="inputProductPattern" tabindex="-1" aria-hidden="true">
								<option value="none" selected disabled>โปรดเลือกวิธีการจัดส่ง</option>
								<option value="normaltext">&middot; ข้อความธรรมดา &middot; (เหมาะสำหรับการส่ง URL หรือข้อความต่างๆ)</option>
								<option value="code">&middot; Gift Code / Redeem Code &middot; (เหมาะสำหรับคีย์เกมทั่วๆไป)</option>
								<option value="eml:psw">&middot; Email:Password &middot; (เหมาะสำหรับ Account บนเว็บส่วนใหญ่)</option>
								<option value="usr:psw">&middot; Username:Password &middot; (เหมาะสำหรับ Platform เกมต่างๆเช่น Steam, Garena)</option>
								<option value="usr:eml:psw">&middot; Username:Email:Password &middot; (เหมาะสำหรับ ID Minecraft Migrate)</option>
							</select>
						<label class="d-flex align-items-center fs-6 fw-bold mb-2">
							<span class="required">ราคา</span>
						</label>
						<input type="text" class="form-control form-control-solid" placeholder="กรอกชื่อสินค้า" name="inputProductPrice">
							

<div class="d-flex flex-column mb-8">
													<label class="fs-6 fw-bold mb-2">คำอธิบายสินค้า</label>
													<textarea class="form-control form-control-solid" rows="10" name="inputProductDesc" ></textarea>
												</div>
												
												<div class="d-flex flex-column mb-8">
													<label class="fs-6 fw-bold mb-2">วิธีการใช้งาน</label>
													<textarea class="form-control form-control-solid" rows="5" name="inputProductHelp" ></textarea>
												</div>
				
			<div class="text-center mt-5">
				<a onclick="location.href='backend?stock'"  class="btn btn-light me-3">Cancel</a>
				<button type="submit" name="btn-add" class="btn btn-primary">Save</button>
			</div>		
		</form>

	</div>
</div>
<br />												
<br />												
<br />	
<?php
}
?>
									<div class="mb-17">
										<div class="d-flex flex-stack mb-5">
											<h3 class="text-black">จัดการสินค้า</h3>
											
									<div class="card-toolbar">
									<a href="?product&add" class="btn btn-primary"><i class="fas fa-plus-circle"></i> เพิ่มสต็อก</a>
									</div>
										</div>
										
										<div class="separator separator-dashed mb-9"></div>
										<div class="row g-10">
											<?php
												$q = query('SELECT * FROM products');
												$result = $q->fetchAll();
												foreach($result as $row){
											?>
											<div class="col-md-4">
												<div class="card-xl-stretch me-md-6">
													<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="<?php echo $row['image']; ?>">
														<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('<?php echo $row['image']; ?>')"></div>
														<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
															<i class="bi bi-eye-fill fs-2x text-white"></i>
														</div>
													</a>
													<div class="mt-5">
														<a href="#" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base"><?php echo $row['name']; ?></a>
														<div class="fw-bold fs-5 text-gray-600 text-dark mt-3 text-center"><?php echo $row['pattern']; ?></div>
														<div class="fs-6 fw-bolder mt-5 d-flex flex-stack">
															<span class="badge border-dashed fs-2 fw-bolder text-dark p-2">
															<span class="fs-6 fw-bold text-gray-400">฿ </span><?php echo $row['price']; ?></span>
															<a href="?product&id=<?php echo $row['id']; ?>" class="btn btn-primary">แก้ไขสินค้า</a>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										</div>
									</div>
