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
  <style>
    table tr td,
    table tr td h5 {
      font-size: 0.8rem !important;
    }
  </style>
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
            <span>Review</span>
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
          $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
        } else {
          $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
        }
        if ($CartItems ==  null) {
          NoCartItems("Empty Shopping Cart!");
        } else { ?>

          <table class="table table-striped cart-table">
            <?php
            $CartItemsCount = 0;
            $CartItemTotalAmount = 0;
            $CartItemTaxAmount = 0;
            $CartTotalCartProductSellPrice = 0;
            $CartItemNetPayableAmount = 0;
            foreach ($CartItems as $CartProducts) {
              $CartItemsCount++;
              $CartTotalCartProductSellPrice += (int)$CartProducts->CartProductSellPrice;
              $CartItemTotalAmount += (int)$CartProducts->CartFinalPrice;
              $CartItemTaxAmount += round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes);
              $CartItemNetPayableAmount += (int)$CartProducts->CartFinalPrice + round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes);
            ?>
              <tr>
                <td>
                  <span class="cart-sno"><?php echo $CartItemsCount; ?></span>
                </td>
                <td style="width:10%;">
                  <a href="<?php echo DOMAIN; ?>/web/products/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                  </a>
                </td>
                <td>
                  <h5><b><?php echo $CartProducts->ProductName; ?></b></h5>
                  <p class="fs-14">
                    <span><?php echo $CartProducts->ProCategoryName; ?></span>
                    <span><?php echo $CartProducts->CartProductWeight; ?></span><br>
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
                  <span>
                    <span>Rs.<?php echo $CartProducts->CartFinalPrice; ?></span>
                  </span>
                </td>
                <td>
                  <span>+ Rs.<?php echo  round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes); ?></span><br>
                  <span>GST <?php echo $CartProducts->ProductApplicableTaxes; ?> % </span>
                </td>
                <td>
                  <span>
                    <b>Rs.<?php echo (int)$CartProducts->CartFinalPrice + round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes); ?></b>
                  </span>
                </td>
                <td>
                  <a onmouseover="Display()" href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-danger text-center"><i class="fa fa-times text-white"></i></a>
                </td>
              </tr>
            <?php }
            $CartItemTotalAmount = $CartItemNetPayableAmount;
            if ($CartItemTotalAmount < $dccartamount) {
              $CartItemNetPayableAmount = (int)$CartItemTotalAmount + (int)$dcchargeamount;
            } elseif ($CartItemTotalAmount > $dccartamount) {
              $CartItemNetPayableAmount = $CartItemTotalAmount;
            } else {
              $CartItemNetPayableAmount = $CartItemTotalAmount;
            }
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
              <span class="cart-price"><b>Rs.<?php echo $CartItemTotalAmount; ?></b></span>
            </td>
          </tr>
          <tr align="right">
            <td align="right" class="">
              <span class="cart-details"><?php echo $Dcchargename; ?> : </span>
              <span class="cart-price"><?php echo ChargesCartAmount($dccartamount, $dcchargeamount, $CartTotalCartProductSellPrice); ?></span>
            </td>
          </tr>
          <?php
          if (isset($_POST['CheckCoupon'])) {
            $SubmittedCoupon = strtoupper($_POST['CouponCode']);
            $CheckAvailability = CHECK("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'");

            if ($CheckAvailability == null) {
              $_SESSION['COUPON_MODE'] = "disabled";
              $Class = "text-danger";
              $Text = "<i class='fa fa-warning'></i> Entered Coupon Code is Invalid! (<code>$SubmittedCoupon</code>).
              Please Try Again!. <a href='' class='btn btn-sm app-btn'>Try Again</a>";
              $DiscountedAmount = 0;
            } else {
              $Class = "text-success";
              $OfferDiscountType = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountType");
              $OfferDiscountValue = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountValue");

              if ($OfferDiscountType == "Percentage") {
                $DiscountedAmount = round((FinalCartAmount() * $OfferDiscountValue) / 100);
              } else {
                $DiscountedAmount = $OfferDiscountValue;
              }

              //order detaisl with coupons
              $_SESSION['COUPON_MODE'] = "enabled";
              $_SESSION['COUPON_CODE'] = $SubmittedCoupon;
              $_SESSION['COUPON_CODE_DETAILS'] = "Coupon Code : <code>$SubmittedCoupon</code> <br> Discounted Amount : Rs." . $DiscountedAmount;
              $_SESSION['COUPON_DISCOUNT_AMOUNT'] = $DiscountedAmount;
              $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount - $DiscountedAmount;
              $CartItemNetPayableAmount = $CartItemNetPayableAmount - $DiscountedAmount;

              $Text = "Congratulation <i class='text-success fa fa-check-circle-o'></i>. You Save Rs." . $DiscountedAmount . " On this Purchase by using Coupon Code <code class='code'>$SubmittedCoupon</code>.
              <a href='?coupon_remove=true' class='btn btn-sm app-btn'> Remove <i class='fa fa-times'></i></a>";
            }  ?>
            <?php if (isset($_SESSION['COUPON_MODE']) == true) { ?>
              <tr align="right">
                <td align="right" class="">
                  <span class="cart-details net-price">Coupon Applied (<?php echo $SubmittedCoupon; ?>) :</span>
                  <span class="cart-price net-price">- Rs.<?php echo $DiscountedAmount; ?></span>
                </td>
              </tr>
              <tr align="right">
                <td align="right" class="">
                  <span class="cart-details net-price">Order Amount :</span>
                  <span class="cart-price net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
                </td>
              </tr>
            <?php } ?>
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details text-success net-price">Net Payable Amount :</span>
                <span class="cart-price text-success net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
              </td>
            </tr>
            <tr align="right">
              <td align="right" class="flex-end">
                <span class="cart-details mr-2 <?php echo $Class; ?>"><?php echo $Text; ?></span>
              </td>
            </tr>
          <?php } else {
            $_SESSION['COUPON_MODE'] = "disabled";
            $DiscountedAmount = 0;
            $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount;
            $_SESSION['COUPON_CODE_DETAILS'] = "No Coupon Applied"; ?>
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details text-success net-price">Net Payable :</span>
                <span class="cart-price text-success net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
              </td>
            </tr>
            <tr align="right">
              <td align="right" class="flex-end">
                <span class="cart-details mr-2 p-1">Enter Coupon/Offer Code :</span>
                <span class="cart-price">
                  <form action="" method="POST">
                    <input type="text" name="CouponCode" class="form-control-2 text-uppercase" placeholder="Enter Coupon Code">
                    <button name="CheckCoupon" value="true" class="btn btn-sm btn-success">Check</button>
                  </form>
                </span>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="col-md-12 text-right p-t-10">

        <?php if (isset($_GET['coupon_remove']) == true) {
            $_SESSION['COUPON_MODE'] = "disabled";
            $DiscountedAmount = 0;
            $_SESSION['COUPON_DISCOUNT_AMOUNT'] = 0;
            $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount;
            $_SESSION['COUPON_CODE_DETAILS'] = "No Coupon Applied";
          } ?>

        <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
          <form class="form bg-white" action="../../controller/ordercontroller.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <input type="text" name="NetPayableAmount" value="<?php echo $CartItemNetPayableAmount - $DiscountedAmount; ?>" hidden="">
            <input type="text" name="TotalcartAmount" value="<?php echo $CartItemTotalAmount; ?>" hidden="">
            <input type="text" name="chargename" value="<?php echo $Dcchargename; ?>" hidden="">
            <input type="text" name="TotalTaxAmount" value="<?php echo $CartItemTaxAmount; ?>" hidden="">
            <input type="text" name="DeliveryCharges" value="<?php echo ChargesCartAmount($dccartamount, $dcchargeamount, $CartItemNetPayableAmount); ?>" hidden="">
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