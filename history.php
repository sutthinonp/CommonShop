<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
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
<main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>
				
				<div class="container">
<div class="card mb-5 mb-xl-8">
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">ประวัติการสั่งซื้อ</span>
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
													<th class="min-w-140px">Product</th>
													<th class="min-w-120px">Date</th>
													<th class="min-w-100px text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
<?php
                          $q = query('SELECT * FROM stock WHERE owner = :user', array(':user'=>strtolower($_SESSION['username'])));
                          if ($q->rowCount() == 0) {
                          }else{
                              $result = $q->fetchAll();
                              foreach($result as $row) {
                                $qProductMeta = query('SELECT * FROM products WHERE id= :id', array(':id'=>$row['type']));
                                $resultProductMeta = $qProductMeta->fetchAll();
                                foreach($resultProductMeta as $data)
                                {
                                    $product_name = $data['name'];
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
														<a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $data['name']; ?></a>
													</td>
													<td>
														<a href="" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $row['date']; ?></a>
													</td>
													<td class="text-end">
														<a href="order?id=<?php echo $row['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
															<span class="svg-icon svg-icon-3">
																<!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil001.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="19" viewBox="0 0 16 19" fill="none">
																	<path d="M12 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V2.40002C0 3.00002 0.4 3.40002 1 3.40002H12C12.6 3.40002 13 3.00002 13 2.40002V1.40002C13 0.800024 12.6 0.400024 12 0.400024Z" fill="black"/>
																	<path opacity="0.3" d="M15 8.40002H1C0.4 8.40002 0 8.00002 0 7.40002C0 6.80002 0.4 6.40002 1 6.40002H15C15.6 6.40002 16 6.80002 16 7.40002C16 8.00002 15.6 8.40002 15 8.40002ZM16 12.4C16 11.8 15.6 11.4 15 11.4H1C0.4 11.4 0 11.8 0 12.4C0 13 0.4 13.4 1 13.4H15C15.6 13.4 16 13 16 12.4ZM12 17.4C12 16.8 11.6 16.4 11 16.4H1C0.4 16.4 0 16.8 0 17.4C0 18 0.4 18.4 1 18.4H11C11.6 18.4 12 18 12 17.4Z" fill="black"/>
																</svg>
																<!--end::Svg Icon-->
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
        </section>
		</div>
</div>
</div>
</div>
</div>
    </main>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>

<div id="modalContainer"></div>
</body>
</html>