					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">2022©</span>
								<a href="https://www.facebook.com/CommonSh0p/" target="_blank" class="text-gray-800 text-hover-primary">COMMON SHOP</a>
							</div>
							<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
								<li class="menu-item">
									<a href="shop" target="_blank" class="menu-link px-2">ซื้อสินค้า</a>
								</li>
								<li class="menu-item">
									<a href="https://www.facebook.com/CommonSh0p/" target="_blank" class="menu-link px-2">ติดต่อแจ้งปัญหา</a>
								</li>
							</ul>
						</div>
					</div>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/modals/create-app.js"></script>
		<script src="assets/js/custom/modals/upgrade-plan.js"></script>
<?php 
error_reporting(0);

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
	
return <<<EOD

<script type="text/javascript">
var ddData = [
    {
        text: "  Wallet  ",
        value: "tw",
        selected: false,
        description: "     โอนเงินผ่านแอพพลิเคชั่นทรูมันนี่วอเล็ท  ",
        imageSrc: "assets/img/payment/wallet.png"
    },
    {
        text: "  Truemoney  ",
        value: "tm",
        selected: false,
        description: "     บัตรเงินสดทรูมันนี่  ",
        imageSrc: "assets/img/payment/truemoney.png"
    }
];
$('#x-method').ddslick({
    data: ddData,
    width: 550,
    imagePosition: "left",
    selectText: "โปรดเลือกช่องทางการชำระเงิน",
    onSelected: function (data) {
        PaymentMethodChange(data);
        $('#x-method-hide').val(data.selectedData.value);
    }
});
</script>
EOD;
?>
