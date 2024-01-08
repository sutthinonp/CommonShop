
<?php
if(@$_GET['deleteid']) {
	$q1 = query('DELETE FROM key_topup WHERE id= :id', array(':id'=>$_GET['deleteid']));
    if ($q1) {
						echo "
						<script>
						Swal.fire({
						  title: ':3',
						  text: 'ลบสำเร็จแล้วจ้า',
						  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
						  imageWidth: 400,
						  imageHeight: 200,
						  imageAlt: 'Custom image',
						})
						</script>
						";
    }
}

?>
<?php 
if(isset($_GET['add'])) { ?>
<?php
if (isset($_POST['btn-addstock'])) {
				$keytext = $_POST['keytext'];
				$amount = $_POST['amount'];

				if($keytext == "") {
                    echo "
					<script>
						Swal.fire(
						  'ไม่พบข้อมูลที่กรอก!',
						  'กรุณาใส่ข้อมูลให้ครบถ้วน',
						  'question'
						)
					</script>
					";
				}else{
					if($amount == "") {
						echo "
						<script>
							Swal.fire(
							  'ไม่พบข้อมูลที่กรอก!',
							  'กรุณาใส่ข้อมูลให้ครบถ้วน',
							  'question'
							)
						</script>
						";
					}else{

						$q1 = query("INSERT INTO key_topup (id, keytext, amount, date, owner, status) VALUES (NULL, '$keytext', '$amount', NULL, NULL, NULL)");
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
								  text: 'เพิ่มสต็อกเสร็จแบ้ว!',
								  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
								  imageWidth: 400,
								  imageHeight: 200,
								  imageAlt: 'Custom image',
								})
								</script>
								";
						}


					}
				}


 
}
?>
<?php
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
	?>
<div class="col-xl-6 container">
	<div class="table-responsive">
		<form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="">
			<div class="mb-13 text-center">
				<h1 class="mb-3">เพิ่มสต็อก</h1>
			</div>
			
            <label>คีย์ (random อัตโนมัติ)</label>
			<input type="text" class="form-control form-control-solid" value="htr-<?php echo random_str(32); ?>" name="keytext">
			<br>
            <label>จำนวนเครดิตที่ได้รับ</label>
			<input type="text" class="form-control form-control-solid" name="amount">
			<br>
			<div class="text-center mt-5">
				<a onclick="location.href='backend?key'"  class="btn btn-light me-3">Cancel</a>
				<button type="submit" name="btn-addstock" class="btn btn-primary">Save</button>
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
<div class="card mb-5 mb-xl-8">
								<!--begin::Header-->
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">จัดการคีย์</span>
									</h3>
									<div class="card-toolbar">
									<a href="?key&add" class="btn btn-primary"><i class="fas fa-plus-circle"></i> เพิ่มสต็อก</a>
									</div>
								</div>
								<div class="card-body py-3">
									<div class="table-responsive">
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
											<thead>
												<tr class="fw-bolder text-muted">
													<th class="w-25px">
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-13-check">
														</div>
													</th>
													<th class="min-w-150px">Key Id</th>
													<th class="min-w-140px">Key</th>
													<th class="min-w-140px">Copy</th>
													<th class="min-w-140px">Amount</th>
													<th class="min-w-120px">Date</th>
													<th class="min-w-120px">Owner</th>
													<th class="min-w-120px">Status</th>
													<th class="min-w-100px text-end">Actions</th>
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
                          $q = query('SELECT * FROM key_topup');
                          $result = $q->fetchAll();
                          foreach($result as $row) {
                            
                                                     							
?>						  
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<p class="text-light" sytle="" type="hidden" id="key<?php echo $row['id']; ?>"><?php echo $row['keytext']; ?></p>
						  </ul>
												<tr>
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input widget-13-check" type="checkbox" value="1">
														</div>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary fs-6"><?php echo $row['id']; ?></a>
													</td>
													<td>

														<a href="backend?key&id=<?php echo $row['id']; ?>" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo substr($row['keytext'], 0 ,10); ?>************<?php echo substr($row['keytext'], -10); ?></a>
													</td>
													<td>
													<button class="btn btn-primary" onclick="copyToClipboard('#key<?php echo $row['id']; ?>')">Copy</button>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['amount']; ?></a>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['date']; ?></a>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['owner']; ?></a>
													</td>
													<td>
														<a class="text-dark fw-bolder text-primary d-block mb-1 fs-6"><?php echo $row['status']; ?></a>
													</td>
													<td class="text-end">
														<a href="backend?key&deleteid=<?php echo $row['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
															<span class="svg-icon svg-icon-3">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
																	<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
																	<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
																</svg>
															</span>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Table container-->
								</div>
								<!--begin::Body-->
							</div>