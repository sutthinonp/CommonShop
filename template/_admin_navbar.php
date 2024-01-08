<?php
if (isset($_SESSION['username'])) {
$qss = Query('SELECT coins FROM clients where username = :user', array(':user'=>$_SESSION['username']));
$e = Query('SELECT email FROM clients where username = :user', array(':user'=>$_SESSION['username']));
$historysm = Query('SELECT * FROM stock where owner = :user', array(':user'=>$_SESSION['username']));
$history_n = $historysm->fetchColumn();
$pointss = $qss->fetchColumn();
$emails = $e->fetchColumn();

?>	

					<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						<div class="container-xxl d-flex flex-grow-1 flex-stack">
							<div class="d-flex align-items-center me-5">
								<div class="d-lg-none btn btn-icon btn-active-color-primary w-30px h-30px ms-n2 me-3" id="kt_header_menu_toggle">
									<span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
								</div>
								<a href="home">
									<img alt="Logo" class="img-fluid" src="https://cdn.discordapp.com/attachments/856050861283999754/1087044369024045147/New_Project_1.jpg" class="h-150px h-lg-50px" />
								</a>
							</div>
							<div class="d-flex align-items-center">
								<div class="d-flex align-items-center flex-shrink-0">
									<div id="kt_header_search" class="d-flex align-items-center w-lg-225px" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-search-responsive="lg" data-kt-menu-trigger="auto" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
										<div data-kt-search-element="toggle" class="d-flex d-lg-none align-items-center">
											<div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary w-30px h-30px">
												<span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black" />
														<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black" />
													</svg>
												</span>
											</div>
										</div>
										<form data-kt-search-element="form" class="d-none d-lg-block w-100 mb-5 mb-lg-0 position-relative" autocomplete="off">
											<input type="hidden" />
											<span class="svg-icon svg-icon-2 svg-icon-gray-700 position-absolute top-50 translate-middle-y ms-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black" />
													<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black" />
												</svg>
											</span>
											<input type="text" class="form-control bg-transparent ps-13 fs-7 h-40px" name="search" value="" placeholder="ค้นหา" data-kt-search-element="input" />
											<span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
												<span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
											</span>
											<span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
												<span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
													</svg>
												</span>
											</span>
										</form>
										<div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown w-300px w-md-350px py-7 px-7 overflow-hidden">
											<div data-kt-search-element="wrapper">
												<div data-kt-search-element="main">
													<div class="d-flex flex-stack fw-bold mb-5">
														<span class="text-muted fs-6 me-2">คำค้นหาที่พบบ่อย</span>
														<div class="d-flex" data-kt-search-element="toolbar">
															<div data-kt-search-element="preferences-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-2 data-bs-toggle=" title="Show search preferences">
																<span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
																		<path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
																	</svg>
																</span>
															</div>
															<div data-kt-search-element="advanced-options-form-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-n1" data-bs-toggle="tooltip" title="Show more search options">
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
																	</svg>
																</span>
															</div>
														</div>
													</div>
													<div class="scroll-y mh-200px mh-lg-325px">
														<div class="d-flex align-items-center mb-5">
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z" fill="black" />
																			<path opacity="0.3" d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z" fill="black" />
																			<path opacity="0.3" d="M15 17H9V20H15V17Z" fill="black" />
																		</svg>
																	</span>
																</span>
															</div>
															<div class="d-flex flex-column">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">ประวัติการสั่งซื้อ</a>
																<span class="fs-7 text-muted fw-bold">#1</span>
															</div>
														</div>
														
													</div>
												</div>
												<div data-kt-search-element="empty" class="text-center d-none">
													<div class="pt-10 pb-10">
														<span class="svg-icon svg-icon-4x opacity-50">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black" />
																<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black" />
																<rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black" />
																<path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black" />
															</svg>
														</span>
													</div>
													<div class="pb-15 fw-bold">
														<h3 class="text-gray-600 fs-5 mb-2">ไม่พบคำค้นหานี้</h3>
														<div class="text-muted fs-7">โปรดใช้คำที่กว่างกว่านี้ หรือลองใหม่อีกครั้ง</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="d-flex align-items-center ms-3 ms-lg-4">
										<div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary btn-active-bg-light w-30px h-30px w-lg-40px h-lg-40px" id="kt_activities_toggle">
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
													<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
													<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
													<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
												</svg>
											</span>
										</div>
									</div>
										</div>
								<div class="d-flex align-items-center ms-3 ms-lg-4" id="kt_header_user_menu_toggle">
										<div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary w-30px h-30px w-lg-40px h-lg-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>									
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
											<div class="menu-item px-3">
												<div class="menu-content d-flex align-items-center px-3">
													<div class="symbol symbol-50px me-5">
														<img alt="Logo" src="https://minotar.net/helm/<?php echo $_SESSION['username']; ?>/150" />
													</div>
													<div class="d-flex flex-column">
														<div class="fw-bolder d-flex align-items-center fs-5"><?php echo $_SESSION['username']; ?>
														<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"><?php echo $pointss; ?> เครดิต</span></div>
														<a class="fw-bold text-muted text-hover-primary fs-7"><?php echo $emails; ?></a>
													</div>
												</div>
											</div>
											<div class="separator my-2"></div>
											<div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
												<a class="menu-link px-5">
													<span class="menu-title position-relative">ภาษา
													<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">ไทย
													<img class="w-15px h-15px rounded-1 ms-2" src="assets/media/flags/thailand.svg" alt="" /></span></span>
												</a>
												<div class="menu-sub menu-sub-dropdown w-175px py-4">
													<div class="menu-item px-3">
														<a class="menu-link d-flex px-5 active">
														<span class="symbol symbol-20px me-4">
															<img class="rounded-1" src="assets/media/flags/thailand.svg" alt="" />
														</span>ไทย</a>
													</div>
												</div>
											</div>
											<div class="menu-item px-5">
												<a onclick="location.href='home'" class="menu-link px-5">ไปหน้าหลัก</a>
											</div>
										</div>

									</div>
									
								</div>
							</div>
						</div>
						<div class="separator"></div>
						<div class="header-menu-container container-xxl d-flex flex-stack h-lg-75px" id="kt_header_nav">
							<div class="header-menu flex-column flex-lg-row" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
								<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch flex-grow-1" id="#kt_header_menu" data-kt-menu="true">
									
									
									
									<a href="?home" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link active py-3">
											<span class="menu-title">ภาพรวม</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>

									<a href="?product" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">จัดการสินค้า</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>
									<a href="?stock" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">จัดการสต็อก</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>

									<a href="?user" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">จัดการผู้ใช้</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>

									<a href="?key" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">จัดการคีย์</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>

									<a href="?user" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">จัดการโพส</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>

									<a href="?settings" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">จัดการเว็บไซต์</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</a>

								</div>
								<div class="flex-shrink-0 p-4 p-lg-0 me-lg-2">
									<a href=" class="btn btn-sm btn-light-primary fw-bolder w-100 w-lg-auto" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="ติดต่อเราได้เลยที่นี้ ทางทีมงานจะตอบกลับภายใน 1 - 2 วัน">แจ้งปัญหา & ติดต่อเรา</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v9.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="-"
  theme_color="#0A7CFF"
  logged_in_greeting="มีข้อสงสัยอะไร หรือต้องการเคลมสินค้า ติดต่อเราได้เลยที่นี้ ไม่ต้องเดี่ยว !"
  logged_out_greeting="มีข้อสงสัยอะไร หรือต้องการเคลมสินค้า ติดต่อเราได้เลยที่นี้ ไม่ต้องเดี่ยว !">
      </div>