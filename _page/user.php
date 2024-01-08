
<?php 

    $q = query('SELECT * FROM clients WHERE id = :id', array(':id'=>$_GET['id']));
    $result = $q->fetchAll();
    foreach($result as $row) {
        $id = $row['id'];
        $user = $row['username'];
        $point = $row['coins'];
        $email = $row['email'];
        $type = $row['type'];
    
	?>
<?php if($_GET['id'] == $id) { ?>
<?php
if (isset($_POST['btn-delete'])) {
	$q1 = query('DELETE FROM clients WHERE id= :id', array(':id'=>$id));
    if ($q1) {

						echo "
						<script>
						Swal.fire({
						  title: ':3',
						  text: 'ลบเสร้จแล้วว',
						  imageUrl: 'https://c.tenor.com/jXMFX8GNgXwAAAAC/good-anime.gif',
						  imageWidth: 400,
						  imageHeight: 200,
						  imageAlt: 'Custom image',
						})
						</script>
						<meta http-equiv='refresh' content='2;URL=backend?user'>
						";
    }
}
if (isset($_POST['btn-edit'])) {
    if (!empty(rtrim($_POST['inputid'])) && !empty(rtrim($_POST['inputpoint']))) {
            $id = $_POST['inputid'];
            $coins = $_POST['inputpoint'];
            $users = $_POST['user'];
            $emails = $_POST['email'];
            $types = $_POST['type'];
            
            $q1 = query('UPDATE clients SET username= :name, coins= :coins, email= :email, type= :type WHERE id= :id', array(':name'=>$users,':coins'=>$coins,':email'=>$emails,':type'=>$types,':id'=>$id));
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
						<meta http-equiv='refresh' content='2;URL=backend?user'>
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
													<h1 class="mb-3">แก้ไขผู้ใช้</h1>
													<div class="text-muted fw-bold fs-5"><?php echo $user; ?></div>
												</div>
												
												<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
													<label class="d-flex align-items-center fs-6 fw-bold mb-2">
														<span class="required">ชื่อของผู้ใช้</span>
													</label>
													<input type="text" class="form-control form-control-solid" placeholder="ชื่อของผู้ใช้" value="<?php echo $user; ?>" name="user">
												<div class="fv-plugins-message-container invalid-feedback"></div>
												</div>
												
												<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
													<label class="d-flex align-items-center fs-6 fw-bold mb-2">
														<span class="required">พ้อย</span>
													</label>
													<input type="number" class="form-control form-control-solid" placeholder="พ้อย" value="<?php echo $point; ?>" name="inputpoint">
												<div class="fv-plugins-message-container invalid-feedback"></div>
												</div>
												
												<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
													<label class="d-flex align-items-center fs-6 fw-bold mb-2">
														<span class="required">อีเมล</span>
													</label>
													<input type="email" class="form-control form-control-solid" placeholder="อีเมลของผู้ใช้" value="<?php echo $email; ?>" name="email">
												<div class="fv-plugins-message-container invalid-feedback"></div>
												</div>
												
												<div class="col-md-12 fv-row fv-plugins-icon-container">
														<label class="required fs-12 fw-bold mb-2">สถานะผู้ใช้</label>
														<select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" name="type" tabindex="-1" aria-hidden="true">
															<option value="none" selected disabled>โปรดเลือกสถานะผู้ใช้</option>
															<option value="normal"<?php if($type == 'normal') { echo 'selected';} ?>>🙍  ผู้ใช้บริการ </option>
															<option value="blacklist"<?php if($type == 'blacklist') { echo 'selected';} ?>>🔐  ระงับผู้ใช้ </option>
															<option value="manager"<?php if($type == 'manager') { echo 'selected';} ?>>🔑  ผู้จัดการ </option>
														</select>
													<div class="fv-plugins-message-container invalid-feedback"></div>
												</div>

												<br />
												<div class="text-center">
													<a onclick="location.href='backend?user'"  class="btn btn-light me-3">Cancel</a>
													<input type="hidden" name="inputid" value="<?php echo $id; ?>"></input>
													<button name="btn-delete"  class="btn btn-danger me-3">Delete</button>
													<button type="submit" name="btn-edit" class="btn btn-primary">Save</button>
												</div>
											</form>
</div>			
<br />
<br />
<br />
<?php } } ?>
<div class="card mb-5 mb-xl-8">
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">จัดการสต็อก</span>
										<span class="text-muted mt-1 fw-bold fs-7">สต็อก</span>
									</h3>
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
													<th class="min-w-150px">#</th>
													<th class="min-w-140px">Username</th>
													<th class="min-w-120px">Email</th>
													<th class="min-w-120px">Amount</th>
													<th class="min-w-100px text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
					  <?php
                          $q = query('SELECT * FROM clients');
                          if ($q->rowCount() == 0) {
                          }else{
                              $result = $q->fetchAll();
                              foreach($result as $row) {
                                $qUserMeta = query('SELECT * FROM clients WHERE id= :id', array(':id'=>$row['id']));
                                $resultUserMeta = $qUserMeta->fetchAll();
                                foreach($resultUserMeta as $data)
                                {
                                    $user = $data['username'];
                                }
								?>

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
														<a href="backend?user&id=<?php echo $row['id']; ?>" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $user; ?></a>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['email']; ?></a>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><span class="badge badge-light-primary"><?php echo $row['coins']; ?></span></a>
													</td>
													<td class="text-end">
														<a href="backend?user&id=<?php echo $row['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
															<span class="svg-icon svg-icon-3">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
																	<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
																</svg>
															</span>
														</a>
														<a href="backend?user&id=<?php echo $row['id']; ?>&deletestock=<?php echo $row['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
								<?php 
                              }
                          }
            ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>