<?php

//page varibale
$PageName  = "Order Review";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

//page actiti
if (isset($_POST['BillingAddress'])) {
  $_SESSION['BILLING_ADDRESS'] = SECURE($_POST['BillingAddress'], "e");
}

$Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
$dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
$dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");
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

  <?php
  //header & loader
  include $AccessLevel . "include/web/header.php";
  ?>

  <section class="container section">
    <div class="row">
      <div class="col-md-12 header-bg mt-3">
        <div class="flex-s-b checkout-process">
          <a href="<?php echo WEB_URL; ?>/cart/" class="active">
            <span class="count">1</span>
            <span>Shopping Cart</span>
          </a>
          <a href="<?php echo WEB_URL; ?>/checkout/" class="active">
            <span class="count">2</span>
            <span>Shipping</span>
          </a>
          <a href="<?php echo WEB_URL; ?>/checkout/billing" class="active">
            <span class="count">3</span>
            <span>Billing</span>
          </a>
          <a href="<?php echo WEB_URL; ?>/checkout/billing" class="active">
            <span class="count">4</span>
            <span>Order Review</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="container m-t-10 section">
    <div class="row">
      <?php if (CartItems() == 0) {
        NoCartItems("Empty Cart") . "<br><br>";
      } else { ?>
        <div class="col-lg-5 col-md-5 col-sm-6 col-12 section-div p-r-20">
          <div class="row">
            <div class="col-md-12 m-b-15 header-bg">
              <h4 class="m-l-5"><i class="fa fa-map-marker"></i> Shipping Address</h4>
            </div>
            <div class="col-md-12">
              <div class="cat-box">
                <?php echo SECURE($_SESSION['SHIPPING_ADDRESS'], "d"); ?><br><br>
                <a href="../index.php" class="btn btn-sm btn-primary">Edit Address</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 m-b-15 header-bg">
              <h4 class="m-l-5"><i class="fa fa-inr"></i> Billing Address</h4>
            </div>
            <div class="col-md-12">
              <div class="cat-box">
                <?php echo SECURE($_SESSION['BILLING_ADDRESS'], "d"); ?><br><br>
                <a href="../billing/" class="btn btn-sm btn-primary">Edit Address</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-6 col-12">
          <div class="row">
            <div class="col-md-12 header-bg m-b-10 m-l-10">
              <h4 class="m-l-5"><i class='fa fa-shopping-cart'></i> Item Details</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped cart-table">
                <?php
                if (isset($_SESSION['LOGIN_CustomerId'])) {
                  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
                  $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
                } else {
                  $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
                }
                if ($CartItems ==  null) {
                  NoCartItems("Empty Shopping Cart!");
                } else {
                  $CartItemsCount = 0;
                  $CartNetTotal = 0;
                  foreach ($CartItems as $CartProducts) {
                    $CartItemsCount++;
                ?>
                    <tr>
                      <td style="width:15%;">
                        <a href="<?php echo DOMAIN; ?>/web/store/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                          <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                        </a>
                      </td>
                      <td>
                        <h6><b><?php echo $CartProducts->ProductName; ?></b></h6>
                        <p class="fs-12">
                          <span><?php echo $CartProducts->ProSubCategoryName; ?></span>
                          <span><?php echo $CartProducts->CartProductWeight; ?></span><br>
                          <span><?php echo SECURE($CartProducts->CartItemDescriptions, "d"); ?></span>
                        </p>
                      </td>
                      <td>
                        <span class="text-black">Rs.<?php echo $CartProducts->CartProductSellPrice; ?> </span>
                      </td>
                      <td>
                        <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="POST" class="add-to-cart-options">
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
                          <?php
                          (int)$ApplicableTax = FETCH("SELECT * FROM products where ProductId='" . $CartProducts->CartProductId . "'", "ProductApplicableTaxes");
                          (int)$TaxAmount = round((int)$CartProducts->CartFinalPrice / 100 * $ApplicableTax);
                          ?>
                          <span>Rs.<?php echo $CartNetTotal += (int)$CartProducts->CartFinalPrice + $TaxAmount; ?></span>
                        </span>
                      </td>
                      <td>
                        <a onmouseover="Display()" href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-danger text-center"><i class="fa fa-times text-white"></i></a>
                      </td>
                    </tr>
                <?php }
                }
                ?>
              </table>
            </div>
          </div>
          <div class="row">
            <table class="table table-striped">
              <tr align="right">
                <td>
                  <span class="cart-details">Total Cart Amount</span>
                </td>
                <td>
                  <span class="cart-price">Rs.<?php echo $_SESSION['TOTAL_CART_AMOUNT']; ?></span>
                </td>
              </tr>
              <tr align="right">
                <td>
                  <span class="cart-details"><?php echo $_SESSION['DELIVERY_CHARGES_NAME'] ?></span>
                </td>
                <td>
                  <span class="cart-price"> <?php echo ChargesCartAmount($dccartamount, $dcchargeamount, $_SESSION['TOTAL_CART_AMOUNT']); ?></span>
                </td>
              </tr>
              <?php if (isset($_SESSION['COUPON_MODE'])) {
                if ($_SESSION['COUPON_MODE'] == "enabled") { ?>
                  <tr align="right">
                    <td>
                      <span class="cart-details">Coupon Applied (<?php echo $_SESSION['COUPON_CODE']; ?>)</span>
                    </td>
                    <td>
                      <span class="cart-price">- Rs.<?php echo $_SESSION['COUPON_DISCOUNT_AMOUNT']; ?></span>
                    </td>
                  </tr>
              <?php }
              } else {
              } ?>
              <tr align="right">
                <td>
                  <span class="cart-details text-success">Net Payable Amount</span>
                </td>
                <td>
                  <span class="cart-price text-success">Rs.<?php echo $_SESSION['FINAL_CHECKOUT_AMOUNT']; ?></span>
                </td>
              </tr>
            </table>
          </div>
          <div class="row">
            <div class="col-md-12 header-bg m-b-10 m-l-10">
              <h4 class="m-l-5"><i class="fa fa-exchange"></i> Payment Method</h4>
            </div>
            <div class="col-md-12 text-center">
              <form action="../../../controller/ordercontroller.php" method="POST">
                <?php FormPrimaryInputs(true); ?>
                <div class="row text-center">
                  <div class="col-md-6 col-lg-6 col-sm-6 col-6 form-group shadow-lg" onclick="ChangeMethod('paymethod')">
                    <label for="cashpayment">
                      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/cash.jpg" class="w-100 br10 paymethod" id="paymethod">
                    </label>
                    <input type="radio" name="PAYMENT_METHOD" required="" checked value="Cash On Delivery" id="cashpayment" hidden="">
                  </div>
                  <?php if (ONLINE_PAYMENT_OPTION == "true") { ?>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6 form-group shadow-lg" onclick="ChangeMethod('onlinemethod')">
                      <label for="onlinepayment">
                        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/online.jpg" class="w-100 br10" id="onlinemethod">
                      </label>
                      <input type="radio" name="PAYMENT_METHOD" required="" value="Online Payment" id="onlinepayment" hidden="">
                    </div>
                  <?php } ?>
                  <div class="col-md-12">
                    <span id="paymodemsg" class="text-danger"></span><br>
                    <button class="btn btn-lg btn-success" onclick="CheckMode()" id="orderbtn" name="CreateOrder">Continue & Placed Order <i class="fa fa-angle-double-right text-white"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
  <hr>
  <br><br>
  <script>
    function CheckMode() {
      var cashpayment = document.getElementById("cashpayment");
      var onlinepayment = document.getElementById("onlinepayment");
      if (cashpayment.checked == false && onlinepayment.checked == false) {
        document.getElementById("paymodemsg").innerHTML = "Please Select Pay Mode";
      } else {
        document.getElementById("paymodemsg").classList.remove("text-danger");
        document.getElementById("paymodemsg").classList.add("text-success");
        document.getElementById("paymodemsg").innerHTML = "Please wait while processing your order, it may takes 5-6sec...";

        document.getElementById("orderbtn").innerHTML = "<i class='fa fa-spinner fa-spin text-white'></i> Processing Order...";
      }
    }
  </script>
  <script>
    function ChangeMethod(data) {
      if (data === "paymethod") {
        document.getElementById("paymethod").classList.add("paymethod");
        document.getElementById("onlinemethod").classList.remove("paymethod");
      } else {
        document.getElementById("onlinemethod").classList.add("paymethod");
        document.getElementById("paymethod").classList.remove("paymethod");
      }
    }
  </script>
  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>