<?php

//page varibale
$PageName  = "My Account";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

$PageSqls = "SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo GET_DATA("CustomerName") ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>

  <?php
  include $AccessLevel . "include/web/header.php";
  ?>
  <section class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 col-12">
        <h3 class="account-header"><i class="fa fa-user text-color"></i> My Account <i class="fa fa-angle-double-right"></i> My Orders</h3>
        <a href="<?php echo DOMAIN; ?>/web/account/" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Account</a>
      </div>
    </div>
  </section>

  <section class="container">
    <div class="row">
      <div class="col-md-12">
      </div>
    </div>
  </section>

  <section class="container section">
    <div class="row">
      <?php
      $Orders = FetchConvertIntoArray("SELECT * FROM orders where CustomerId='" . LOGIN_CustomerId . "' ORDER BY OrderId DESC", true);
      if ($Orders == null) {
        NoData("No Order Found!");
      } else {
        foreach ($Orders as $Order) {
          $OrderProductImage = FETCH("SELECT * FROM ordered_products where OrderOrderId='" . $Order->OrderId . "'", "OrderProductImage");
          $OrderStatus = FETCH("SELECT * FROM orderstatus where OrderStatusOrderId='" . $Order->OrderId . "' ORDER BY OrderStatusid DESC", "OrderStatus") ?>
          <div class="col-md-6">
            <a href="<?php echo DOMAIN; ?>/web/account/orders/details.php?orderid=<?php echo SECURE($Order->OrderId, "e"); ?>">
              <div class="account-section">
                <div class="image-2">
                  <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $OrderProductImage; ?>">
                </div>
                <div class="details">
                  <h5><?php echo $Order->CustomOrderId; ?></h5>
                  <span class="fs-14 text-grey">#<?php echo $Order->OrderReferenceid; ?></span> |
                  <span class="fs-14 text-grey"> <i class="fa fa-calendar"></i> <?php echo $Order->OrderCreateDate; ?></span>
                  <p>
                    <span class="order-status text-danger"><i class="fa fa-shopping-cart"></i> <?php echo $OrderStatus; ?></span>
                    <span class="order-price">Rs.<?php echo $Order->NetPayableAmount; ?></span>
                  </p>
                </div>
              </div>
            </a>
          </div>
      <?php }
      } ?>


    </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>