<?php

//page varibale
$PageName  = "My Cart";
$AccessLevel = "../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//page actiti
$Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
$dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
$dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");

//OrderReferenceid
$_SESSION['OrderReferenceid'] = date("d/m/y/") . rand(000000, 99999999);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>
  <?php include $AccessLevel . "include/web/header.php"; ?>
  <section class="container section">
    <div class="row">
      <div class="col-md-12 header-bg mt-3">
        <div class="flex-s-b checkout-process">
          <a href="<?php echo WEB_URL; ?>/cart/" class="active">
            <span class="count">1</span>
            <span>Shopping Cart</span>
          </a>
          <a href="#">
            <span class="count">2</span>
            <span>Shipping</span>
          </a>
          <a href="#">
            <span class="count">3</span>
            <span>Billing</span>
          </a>
          <a href="#">
            <span class="count">4</span>
            <span>Billing</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <br>
  <section class="container section">
    <div class="row">
      <div class="col-md-12">
        <?php
        if (isset($_SESSION['LOGIN_CustomerId'])) {
          $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
          $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
        } else {
          $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
        }
        if ($CartItems ==  null) {
          NoCartItems("Empty Shopping Cart!");
        } else { ?>

          <table class="table table-striped cart-table">
            <?php
            $CartItemsCount = 0;
            foreach ($CartItems as $CartProducts) {
              $CartItemsCount++;
            ?>
              <tr>
                <td>
                  <span class="cart-sno"><?php echo $CartItemsCount; ?></span>
                </td>
                <td style="width:15%;">
                  <a href="<?php echo DOMAIN; ?>/web/store/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                  </a>
                </td>
                <td>
                  <h5><b><?php echo $CartProducts->ProductName; ?></b></h5>
                  <p class="fs-14">
                    <span class="text-grey">By <?php echo $CartProducts->ProBrandName; ?></span><br>
                    <span><i class="fa fa-list text-danger"></i> <?php echo $CartProducts->ProSubCategoryName; ?></span><br>
                    <span><i class="fa fa-shopping-basket text-info fs-13"></i> <?php echo $CartProducts->CartProductWeight; ?></span><br>
                    <span><?php echo SECURE($CartProducts->CartItemDescriptions, "d"); ?></span>
                  </p>
                </td>
                <td>
                  <span class="text-black">Rs.<?php echo $CartProducts->CartProductSellPrice; ?> </span>
                </td>
                <td>
                  <form action="../../controller/ordercontroller.php" method="POST" class="add-to-cart-options">
                    <input type="text" name="CartItemsid" value="<?php echo $CartProducts->CartItemsid; ?>" hidden="">
                    <input type="text" name="CartProductSellPrice" value="<?php echo $CartProducts->CartProductSellPrice; ?>" hidden="">
                    <input type="text" name="UpdateCartQuantity" hidden="" value="<?php echo SECURE('true', 'e'); ?>">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="flex-space-between">
                      <select name="CartProductQty" class="form-control" required="" onchange="form.submit()">
                        <?php
                        $StartValue = MIN_ORDER_QTY;
                        while ($StartValue <= MAX_ORDER_QTY) {
                          if ($StartValue == $CartProducts->CartProductQty) {
                            $selected = "selected=''";
                          } else {
                            $selected = '';
                          } ?>
                          <option value="<?php echo $StartValue; ?>" <?php echo $selected; ?>><?php echo $StartValue; ?></option>
                        <?php $StartValue++;
                        } ?>
                      </select>
                    </div>
                  </form>
                </td>
                <td>
                  <span class="text-danger">
                    <span>Rs.<?php echo $CartProducts->CartFinalPrice; ?></span>
                  </span>
                </td>
                <td>
                  <a onmouseover="Display()" href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-danger text-center"><i class="fa fa-times text-white"></i> Remove</a>
                </td>
              </tr>
            <?php }
            ?>
          </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 header-bg text-right">
        <table class="table table-striped text-right">
          <tr align="right">
            <td align="right" class="">
              <span class="cart-details">Cart Total : </span>
              <span class="cart-price"><b>Rs.<?php echo TotalCartPrice(); ?></b></span>
            </td>
          </tr>
          <tr align="right">
            <td align="right" class="">
              <span class="cart-details"><?php echo $Dcchargename; ?> : </span>
              <span class="cart-price"><?php echo ChargesCartAmount($dccartamount, $dcchargeamount); ?></span>
            </td>
          </tr>
          <tr align="right">
            <td align="right" class="">
              <span class="cart-details text-success net-price">Net Payable :</span>
              <span class="cart-price text-success net-price">Rs.<?php echo FinalCartAmount(); ?></span>
            </td>
          </tr>
        </table>
      </div>
      <div class="col-md-12 text-right p-t-10">
        <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
          <form class="form bg-white" action="../../controller/ordercontroller.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <input type="text" name="NetPayableAmount" value="<?php echo FinalCartAmount(); ?>" hidden="">
            <input type="text" name="TotalcartAmount" value="<?php echo TotalCartPrice(); ?>" hidden="">
            <input type="text" name="chargename" value="<?php echo $Dcchargename; ?>" hidden="">
            <input type="text" name="DeliveryCharges" value="<?php echo ChargesCartAmount($dccartamount, $dcchargeamount); ?>" hidden="">
            <button class="btn btn-lg btn-primary" name="checkoutbutton">Checkout</button>
          </form>
        <?php } else { ?>
          <a href="<?php echo DOMAIN; ?>/auth/web/login/?return=<?php echo SECURE(RUNNING_URL, "e"); ?>" class="btn btn-lg btn-success text-white"> Login to Checkout <i class="fa fa-sign-in text-white"></i></a>
        <?php } ?>
      </div>
    <?php } ?>
    </div>
  </section>

  <br><br><br>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>