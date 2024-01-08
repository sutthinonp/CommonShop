<?php
$usercol = Query('SELECT COUNT(id) FROM clients');
$usercols = $usercol->fetchColumn();
$products = Query('SELECT COUNT(id) FROM products');
$productn = $products->fetchColumn();
$stocksrequrd = Query('SELECT COUNT(id) FROM stock');
$stockidforshow = $stocksrequrd->fetchColumn();
$log_topups = Query('SELECT SUM(point) as point FROM log_topup');
$log_topupn = $log_topups->fetchColumn();
?>
<div class="row g-5 g-xl-8">
								<div class="col-xl-4">
									<div class="card bg-light-success card-xl-stretch mb-xl-8">
										<div class="card-body my-3">
											<a href="#" class="card-title fw-bolder text-success fs-5 mb-3 d-block">สมาชิก</a>
											<div class="py-1">
												<span class="text-dark fs-1 fw-bolder me-2"><?php echo $usercols; ?></span>
												<span class="fw-bold text-muted fs-7">ผู้ใช้</span>
											</div>
											<div class="progress h-7px bg-success bg-opacity-50 mt-7">
												<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $usercols; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="card bg-light-warning card-xl-stretch mb-xl-8">
										<div class="card-body my-3">
											<a href="#" class="card-title fw-bolder text-warning fs-5 mb-3 d-block">สินค้า</a>
											<div class="py-1">
												<span class="text-dark fs-1 fw-bolder me-2"><?php echo $productn; ?></span>
												<span class="fw-bold text-muted fs-7">สินค้า</span>
											</div>
											<div class="progress h-7px bg-warning bg-opacity-50 mt-7">
												<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $productn; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="card bg-light-primary card-xl-stretch mb-5 mb-xl-8">
										<div class="card-body my-3">
											<a href="#" class="card-title fw-bolder text-primary fs-5 mb-3 d-block">สต็อก</a>
											<div class="py-1">
												<span class="text-dark fs-1 fw-bolder me-2"><?php echo $stockidforshow; ?></span>
												<span class="fw-bold text-muted fs-7">สต็อก</span>
											</div>
											<div class="progress h-7px bg-primary bg-opacity-50 mt-7">
												<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $stockidforshow; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
<div class="col-xl-6 container">
									<!--begin::Mixed Widget 1-->
									<div class="card card-xl-stretch mb-xl-8 mx-auto">
										<!--begin::Body-->
										<div class="card-body p-0">
											<!--begin::Header-->
											<div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
												<!--begin::Heading-->
												<div class="d-flex flex-stack">
													<h3 class="m-0 text-white fw-bolder fs-3">ยอดเงินเหลือ</h3>
												</div>
												<!--end::Heading-->
												<!--begin::Balance-->
												<div class="d-flex text-center flex-column text-white pt-8">
													<span class="fw-bold fs-7">ยอดเงินคงเหลือในระบบ</span>
													<span class="fw-bolder fs-2x pt-1">฿<?php echo $log_topupn; ?></span>
													<i class="text-danger">(โดยปกติเงินจะเข้าบัญชีของคุณทันที)</i>
													<p></p>
													<div class="col-xl-8 container">
													<a href="#" class="btn btn-white">ถอนเงิน</a>
													</div>
												</div>
												<!--end::Balance-->
												
											</div>
<br/>
<br/>
											<!--begin::Items-->
											<div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
												<!--begin::Item-->
<?php
										$tops = Query('SELECT * FROM log_topup where status = "success" ORDER BY id DESC LIMIT 5');

										?>			
<?php foreach($tops as $data) { ?>										
												<div class="d-flex align-items-center mb-6">
													<!--begin::Symbol-->
													<div class="symbol symbol-45px w-40px me-5">
														<span class="symbol-label bg-lighten">
															<!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
															<span class="svg-icon svg-icon-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="black"></path>
																	<path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="black"></path>
																</svg>
															</span>
															<!--end::Svg Icon-->
														</span>
													</div>

										
													<div class="d-flex align-items-center flex-wrap w-100">
														<!--begin::Title-->
														<div class="mb-1 pe-3 flex-grow-1">
															<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">เติมเงินเข้าระบบ</a>
															<div class="text-gray-400 fw-bold fs-7"><?php echo $data['username']; ?></div>
														</div>
														<!--end::Title-->
														<!--begin::Label-->
														<div class="d-flex align-items-center">
															<div class="fw-bolder fs-5 text-gray-800 pe-1"><?php echo $data['point']; ?>฿</div>
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-success ms-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
																	<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"></path>
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Label-->
													</div>
												
												</div>
												<?php } ?>
												<!--end::Item-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Mixed Widget 1-->
								</div>
							
				