<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

require_once(__DIR__ . '/../include/Core.php'); 
require_once(__DIR__ . '/../include/Config.php');
require_once(__DIR__ . '/../include/PDOQuery.php');

if($_GET['lang']){
    $_SESSION['lang'] = $_GET['lang'];
    header('Location:'.$_SERVER['PHP_SELF']);
    exit();
}

switch($_SESSION['lang']){
    case "th":
        require('../lang/th.php');
    break;
    case "en":
        require('../lang/en.php');
    break;
    default:
        require('../lang/th.php');
    }

if (!empty($_GET) && !empty($_GET['id'])) {
    $q = query('SELECT * FROM products WHERE id = :id LIMIT 1', array(':id'=>$_GET['id']));
    if ($q->rowCount() > 0) {
        $result = $q->fetchAll();
        foreach($result as $row){
            $product_id = $row['id'];
            $product_name = $row['name'];
            $product_desc = $row['description'];
            $product_img = $row['image'];
            $product_price = $row['price'];
            $product_help = $row['help'];
            $product_patt = $row['pattern'];
            $q = Query('SELECT count(*) FROM stock WHERE type = :id AND owner = ""', array(':id'=>$product_id));
            $result = $q->fetchColumn();
            $stock = $result;
        }
    }else{
        $product_id = 0;
        $product_name = 'ไม่พบสินค้า';
        $product_desc = 'ไม่พบสินค้านี้ในระบบ';
        $stock = 0;
    }
}else{
    header('Location: ../index.php');
}
?>
<div id="modalPurchase" class="modal fade animated slideIn faster" id="additem" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $product_name; ?></h5>
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    X
                </div>
        </div>
		<img src="<?=$product_img?>" alt="<?=$product_name?>" class="card-img-top">
      <div class="modal-body">
        <?php echo nl2br($product_desc); ?>
      </div>
      <div class="modal-footer">
        <span class="mr-auto text-muted"><?php echo $stock; ?> <?=$lang['instock']?></span>
        <?php if ($stock > 0) { echo '<button type="button" class="btn btn-dark" onclick="ProcessPurchase('.$product_id.')">'.$lang['purchase'].' ฿'.$product_price.'</button>';
        } else { echo '<button type="button" class="btn btn-dark disabled" disabled>'.$lang['outofstock'].'</button>'; } ?>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=$lang['close']?></button>
      </div>
    </div>
  </div>
</div>