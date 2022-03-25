<?php
//require modules;
require '../../../require/modules.php';
require '../../../require/web-modules.php';

if (isset($_GET['productid'])) {
  $ProductId = SECURE($_GET['productid'], "d");
  $_SESSION['productid'] = $ProductId;
} else {
  $ProductId = $_SESSION['productid'];
}

$SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and products.ProductId='$ProductId'  ORDER BY products.ProductStatus DESC");
$fetchpro_brands = mysqli_fetch_array($SQLproducts);
$ProductName = $fetchpro_brands['ProductName'];
$ProBrandName = $fetchpro_brands['ProBrandName'];
$ProCategoryName = $fetchpro_brands['ProCategoryName'];
$ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
$ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
$ProductImage = $fetchpro_brands['ProductImage'];
$ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
$ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
$ProductBrandId = $fetchpro_brands['ProductBrandId'];
$ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
$ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
$ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "d");
$ProductWeight = $fetchpro_brands['ProductWeight'];
$ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
$ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
$ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
$ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
$ProductId = $fetchpro_brands['ProductId'];
$ProductAvailibility = $fetchpro_brands['ProductStatus'];


//run filter options for paper options
if (isset($_GET['selected-options']) == "13") {
  if ($_GET['selected-options'] == "13") {

    $_SESSION['PAPER_OPTION'] = $_GET['selected-value'];
    $_SESSION['PAPER-OPTION-VALUE'] = $_GET['option-value'];
  } else {
    $_SESSION['PAPER_OPTION'] = $_SESSION['PAPER_OPTION'];
    $_SESSION['PAPER-OPTION-VALUE'] = $_SESSION['PAPER-OPTION-VALUE'];
  }
}

if (isset($_GET['selected-options'])) {
  //withframe Options
  if ($_GET['selected-options'] == "14") {
    $_SESSION['WITHFRAME_OPTION'] = "With Frame";
    $_SESSION['WITHFRAME-OPTION-VALUE'] = $_GET['option-value'];
    $_SESSION['FRAME-SIZE'] = $_GET['selected-value'];
  } elseif ($_GET['selected-options'] == "15") {
    $_SESSION['WITHFRAME_OPTION'] = "Without Frame";
    $_SESSION['WITHFRAME-OPTION-VALUE'] = $_GET['option-value'];
    $_SESSION['FRAME-SIZE'] = $_GET['selected-value'];
  } else {
    $_SESSION['WITHFRAME_OPTION'] = $_SESSION['WITHFRAME_OPTION'];
    $_SESSION['WITHFRAME-OPTION-VALUE'] = $_SESSION['WITHFRAME-OPTION-VALUE'];
    $_SESSION['FRAME-SIZE'] = $_SESSION['FRAME-SIZE'];
  }
} elseif (isset($_SESSION['PAPER_OPTION']) && isset($_SESSION['WITHFRAME_OPTION'])) {
  $_SESSION['WITHFRAME_OPTION'] = $_SESSION['WITHFRAME_OPTION'];
  $_SESSION['WITHFRAME-OPTION-VALUE'] = $_SESSION['WITHFRAME-OPTION-VALUE'];
  $_SESSION['FRAME-SIZE'] = $_SESSION['FRAME-SIZE'];
} else {
  $_SESSION['WITHFRAME_OPTION'] = "";
  $_SESSION['WITHFRAME-OPTION-VALUE'] = "";
  $_SESSION['FRAME-SIZE'] = "";
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <title><?php echo $ProductName; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/login_overlay.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/style6.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/shop.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/owl.carousel.css" type="text/css" media="all" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/owl.theme.css" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>/web/css/jquery-ui1.css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/flexslider.css" type="text/css" media="screen" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/app.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include '../../../include/web/header.php'; ?>

  <!--//banner -->
  <!--/shop-->
  <section class="banner-bottom-wthreelayouts py-lg-3 py-3">
    <div class="container-fluid">
      <div class="inner-sec-shop pt-lg-1 pt-3">
        <div class="row">
          <div class="col-lg-6 single-right-left ">
            <div class="grid images_3_of_2">
              <div class="flexslider1">
                <ul class="slides">

                  <li data-thumb="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>">
                    <div class="thumb-image"> <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" data-imagezoom="true" class="img-fluid" alt=" "> </div>
                  </li>
                  <?php
                  //check images and update images
                  $CheckImages = FetchConvertIntoArray("SELECT * FROM pro_images where ProImageProductId='$ProductId' ORDER BY ProImagesId DESC", true);
                  if ($CheckImages != null) {
                    foreach ($CheckImages as $Data) { ?>
                      <li data-thumb="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>">
                        <div class="thumb-image"> <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>" data-imagezoom="true" class="img-fluid" alt=" "> </div>
                      </li>
                  <?php
                    }
                  } ?>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 single-right-left simpleCart_shelfItem">
            <h3><?php echo $ProductName; ?></h3>
            <p class="provider-name">By <?php echo $ProBrandName; ?></p>
            <p><span class="item_price"><i class="fa fa-inr"></i><?php echo $ProductSellPrice; ?></span>
              <del><i class="fa fa-inr"></i><?php echo $ProductMrpPrice; ?></del><br>

              <?php
              if (isset($_GET['selected-options'])) {
                $ItemDescriptions = "Item Price : Rs." . $ProductSellPrice . "<br>";
                if ($_SESSION['PAPER_OPTION'] != null) {
                  echo $ItemDescriptions2 = "Print Type : " . $_SESSION['PAPER_OPTION'] . " @ Rs." . $_SESSION['PAPER-OPTION-VALUE'] . "<br>";
                  $ItemDescriptions .= $ItemDescriptions2;
                }
                if ($_SESSION['WITHFRAME_OPTION'] != null) {
                  echo $ItemDescriptions3 = $_SESSION['WITHFRAME_OPTION'] . " (" . $_SESSION['FRAME-SIZE'] . ") : @ Rs." . $_SESSION['WITHFRAME-OPTION-VALUE'] . "<br>";
                  $ItemDescriptions .= $ItemDescriptions3;
                }
              ?>
                Final Price: <i class="fa fa-inr"></i><?php echo $NetItemCost = $ProductSellPrice + $_SESSION['PAPER-OPTION-VALUE'] + $_SESSION['WITHFRAME-OPTION-VALUE']; ?>
              <?php
                $ItemDescriptions .= "Net Item Cost : Rs." . $NetItemCost;
                $ItemMrpPrice = ($NetItemCost - $ProductSellPrice) + $ProductMrpPrice;
              } else {
                $ItemDescriptions = "Item Cost : Rs." . $ProductSellPrice . "<br>";
                $NetItemCost = $ProductSellPrice;
              } ?>
              <br>
              <span class="tax-options">All Taxes & Charges are included.</span><br>
              <span class="rating-star">
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <span class="review-text">24 Reviews</span>
              </span>
            </p>
            <ul class="footer-social text-left mt-lg-4 mt-3">
              <li>Share Design : </li>
              <li class="mx-2">
                <a href="#">
                  <i class="fa fa-copy"></i> Copy Link
                </a>
              </li>
            </ul>
            <hr>
            <?php if (isset($_GET['selected-options'])) { ?>
              <a href="<?php echo DOMAIN; ?>/web/products/details/" class="btn btn-md btn-danger pull-right"><i class="fa fa-times text-white"></i> Remove Options</a>
            <?php } ?>

            <?php $GetOptionsValues = FetchConvertIntoArray("SELECT * FROM pro_options_categories where ProOptionCategoryId='13'", true);
            if ($GetOptionsValues != null) {
              foreach ($GetOptionsValues as $Request) { ?>
                <div class="occasional">
                  <h5><?php echo $Request->ProOptionCategoryName; ?>:</h5>
                  <div class="option-list">
                    <?php
                    $FetchOptions = FetchConvertIntoArray("SELECT * FROM pro_options where ProOptionCategoryId='" . $Request->ProOptionCategoryId . "'", true);
                    if ($FetchOptions != null) {
                      foreach ($FetchOptions as $Request2) { ?>
                        <form action="" method="GET" onclick="form.submit()">
                          <input type="text" name="selected-options" value="<?php echo $Request->ProOptionCategoryId; ?>" hidden="">
                          <input type="text" name="selected-value" value="<?php echo LowerCase(RemoveSpace($Request2->ProOptionName)); ?>" hidden="">
                          <input type="text" name="option-value" value="<?php echo $Request2->ProOptionCharges; ?>" hidden="">
                          <div class="options">
                            <button class="option-value" name="filter-options" value="<?php echo $Request2->ProOptionsId; ?>">
                              <?php echo $Request2->ProOptionName; ?>
                              <span class="option-price">@ <?php echo Price($Request2->ProOptionCharges); ?></span>
                            </button>
                          </div>
                        </form>
                    <?php }
                    } ?>
                    <?php ?>
                  </div>
                  <div class="clearfix"></div>
                </div>
            <?php }
            } ?>
            <div class="border-p">
              <div class="row">
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <button onclick="frameoptions('withframes')" class="btn btn-md btn-primary w-50">With Frame</button>
                    <button onclick="frameoptions('withoutframes')" class="btn btn-md btn-info w-50">Without Frame</button>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-lg-12" id="withframes">
                  <?php $GetOptionsValues = FetchConvertIntoArray("SELECT * FROM pro_options_categories where ProOptionCategoryId='14'", true);
                  if ($GetOptionsValues != null) {
                    foreach ($GetOptionsValues as $Request) { ?>
                      <div class="occasional">
                        <h5><?php echo $Request->ProOptionCategoryName; ?>:</h5>
                        <div class="option-list">
                          <?php
                          $FetchOptions = FetchConvertIntoArray("SELECT * FROM pro_options where ProOptionCategoryId='" . $Request->ProOptionCategoryId . "'", true);
                          if ($FetchOptions != null) {
                            foreach ($FetchOptions as $Request2) { ?>
                              <form action="" method="GET" onclick="form.submit()">
                                <input type="text" name="selected-options" value="<?php echo $Request->ProOptionCategoryId; ?>" hidden="">
                                <input type="text" name="selected-value" value="<?php echo LowerCase(RemoveSpace($Request2->ProOptionName)); ?>" hidden="">
                                <input type="text" name="option-value" value="<?php echo $Request2->ProOptionCharges; ?>" hidden="">
                                <div class="options">
                                  <button class="option-value" name="filter-options" value="<?php echo $Request2->ProOptionsId; ?>">
                                    <?php echo $Request2->ProOptionName; ?>
                                    <span class="option-price">@ <?php echo Price($Request2->ProOptionCharges); ?></span>
                                  </button>
                                </div>
                              </form>
                          <?php }
                          } ?>
                          <?php ?>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                  <?php }
                  } ?>
                </div>

                <div class="col-md-12 col-lg-12" style="display:none;" id="withoutframes">
                  <?php $GetOptionsValues = FetchConvertIntoArray("SELECT * FROM pro_options_categories where ProOptionCategoryId='15'", true);
                  if ($GetOptionsValues != null) {
                    foreach ($GetOptionsValues as $Request) { ?>
                      <div class="occasional">
                        <h5><?php echo $Request->ProOptionCategoryName; ?>:</h5>
                        <div class="option-list">
                          <?php
                          $FetchOptions = FetchConvertIntoArray("SELECT * FROM pro_options where ProOptionCategoryId='" . $Request->ProOptionCategoryId . "'", true);
                          if ($FetchOptions != null) {
                            foreach ($FetchOptions as $Request2) { ?>
                              <form action="" method="GET" onclick="form.submit()">
                                <input type="text" name="selected-options" value="<?php echo $Request->ProOptionCategoryId; ?>" hidden="">
                                <input type="text" name="selected-value" value="<?php echo LowerCase(RemoveSpace($Request2->ProOptionName)); ?>" hidden="">
                                <input type="text" name="option-value" value="<?php echo $Request2->ProOptionCharges; ?>" hidden="">
                                <div class="options">
                                  <button class="option-value" name="filter-options" value="<?php echo $Request2->ProOptionsId; ?>">
                                    <?php echo $Request2->ProOptionName; ?>
                                    <span class="option-price">@ <?php echo Price($Request2->ProOptionCharges); ?></span>
                                  </button>
                                </div>
                              </form>
                          <?php }
                          } ?>
                          <?php ?>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                  <?php }
                  } ?>
                </div>

              </div>
            </div>


            <div class="color-quality">
              <div class="color-quality-right">
                <h5>Quantity :</h5>
                <div class="item-quantity-button">
                  <button type="button" id="increase" onclick="Increase()"><i class="fa fa-plus"></i></button>
                  <input type="number" id="qty" min="<?php echo MIN_ORDER_QTY; ?>" VALUE="1" max="<?php echo MAX_ORDER_QTY; ?>">
                  <button type="button" id="decrease" onclick="Decrease()"><i class="fa fa-minus"></i></button>
                </div>
              </div>
            </div>

            <div class="occasion-cart">
              <div class="googles single-item singlepage flex-start">
                <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="post">
                  <?php FormPrimaryInputs(true); ?>
                  <input type="hidden" name="CartProductId" value="<?php echo SECURE($ProductId, "e"); ?>">
                  <input type="hidden" name="CartProductSellPrice" value="<?php echo $NetItemCost; ?>">
                  <input type="hidden" name="CartProductMrpPrice" value="<?php echo $ItemMrpPrice; ?>">
                  <input type="hidden" name="CartProductWeight" value="<?php echo $ProductWeight; ?>">
                  <input type="hidden" name="CartProductQty" value="" id="qtyinput">
                  <input type="hidden" name="CartFinalPrice" value="<?php echo $NetItemCost; ?>">
                  <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                  <input type="hidden" name="CartItemDescriptions" value="<?php echo SECURE($ItemDescriptions, "e"); ?>">
                  <button onmouseover="GetCartDetails()" name="AddItemsToCart" type="submit" class="googles-cart pgoogles-cart">
                    Add to Cart
                  </button>
                </form>

                <form class="ml-4" action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="post">
                  <?php FormPrimaryInputs(WEB_URL . "/checkout"); ?>
                  <input type="hidden" name="CartProductId" value="<?php echo SECURE($ProductId, "e"); ?>">
                  <input type="hidden" name="CartProductSellPrice" value="<?php echo $NetItemCost; ?>">
                  <input type="hidden" name="CartProductMrpPrice" value="<?php echo $ItemMrpPrice; ?>">
                  <input type="hidden" name="CartProductWeight" value="<?php echo $ProductWeight; ?>">
                  <input type="hidden" name="CartProductQty" value="" id="qtyinput2">
                  <input type="hidden" name="CartFinalPrice" value="<?php echo $NetItemCost; ?>">
                  <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                  <input type="hidden" name="CartItemDescriptions" value="<?php echo SECURE($ItemDescriptions, "e"); ?>">
                  <button onmouseover="GetCartDetails2()" name="AddItemsToCart" type="submit" class="googles-cart pgoogles-cart buy-now-btn">
                    Buy Now
                  </button>
                </form>

              </div>
            </div>


          </div>
          <div class="clearfix"> </div>
          <!--/tabs-->
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="responsive_tabs">
            <div id="horizontalTab">
              <ul class="resp-tabs-list">
                <li>Description</li>
                <li>Reviews</li>
                <li>Information</li>
              </ul>
              <div class="resp-tabs-container">
                <!--/tab_one-->
                <div class="tab1">

                  <div class="single_page">
                    <h6><?php echo $ProductName; ?></h6>
                    <table class="table table-striped">
                      <?php
                      $ViewProductId = $ProductId;
                      $FetchSpecifications = FetchConvertIntoArray("SELECT * FROM pro_specifications where ProdProductId='$ViewProductId' ORDER BY ProSpecificationId ASC", true);
                      if ($FetchSpecifications != null) {
                        $CountNo = 0;
                        foreach ($FetchSpecifications as $Data) {
                          $CountNo++;
                      ?>
                          <tr>
                            <th><?php echo $Data->ProSpecificationName; ?></th>
                            <td><?php echo SECURE($Data->ProSpecificationValue, "d"); ?></td>
                          </tr>
                      <?php
                        }
                      } ?>
                    </table>
                  </div>
                </div>
                <!--//tab_one-->
                <div class="tab2">

                  <div class="single_page">
                    <div class="bootstrap-tab-text-grids">
                      <div class="bootstrap-tab-text-grid">
                        <div class="bootstrap-tab-text-grid-left">
                          <img src="images/team1.jpg" alt=" " class="img-fluid">
                        </div>
                        <div class="bootstrap-tab-text-grid-right">
                          <ul>
                            <li><a href="#">Admin</a></li>
                            <li><a href="#"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a></li>
                          </ul>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget.Ut enim ad minima veniam,
                            quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis
                            autem vel eum iure reprehenderit.</p>
                        </div>
                        <div class="clearfix"> </div>
                      </div>
                      <div class="add-review">
                        <h4>add a review</h4>
                        <form action="#" method="post">
                          <input class="form-control" type="text" name="Name" placeholder="Enter your email..." required="">
                          <input class="form-control" type="email" name="Email" placeholder="Enter your email..." required="">
                          <textarea name="Message" required=""></textarea>
                          <input type="submit" value="SEND">
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="tab3">

                  <div class="single_page">
                    <h6>Irayz Butterfly Sunglasses (Black)</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget nisl ullamcorper, molestie
                      blandit ipsum auctor. Mauris volutpat augue dolor.Consectetur adipisicing elit, sed do eiusmod tempor incididunt
                      ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. labore et dolore
                      magna aliqua.</p>
                    <p class="para">Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget nisl ullamcorper, molestie
                      blandit ipsum auctor. Mauris volutpat augue dolor.Consectetur adipisicing elit, sed do eiusmod tempor incididunt
                      ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. labore et dolore
                      magna aliqua.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--//tabs-->

        </div>
      </div>
    </div>
    <div class="container-fluid">

      <!--/slide-->
      <div class="slider-img mid-sec mt-lg-5 mt-2 px-lg-5 px-3">
        <!--//banner-sec-->
        <h3 class="tittle-w3layouts text-left my-lg-4 my-3">Related Products</h3>
        <div class="mid-slider">
          <div class="owl-carousel owl-theme row">


            <div class="item">
              <div class="gd-box-info text-center">
                <div class="product-men women_two bot-gd">
                  <div class="product-googles-info slide-img googles">
                    <div class="men-pro-item">
                      <div class="men-thumb-item">
                        <img src="images/s5.jpg" class="img-fluid" alt="">
                        <div class="men-cart-pro">
                          <div class="inner-men-cart-pro">
                            <a href="single.html" class="link-product-add-cart">Quick View</a>
                          </div>
                        </div>
                        <span class="product-new-top">New</span>
                      </div>
                      <div class="item-info-product">

                        <div class="info-product-price">
                          <div class="grid_meta">
                            <div class="product_price">
                              <h4>
                                <a href="single.html">Fastrack Aviator </a>
                              </h4>
                              <div class="grid-price mt-2">
                                <span class="money ">$325.00</span>
                              </div>
                            </div>
                            <ul class="stars">
                              <li>
                                <a href="#">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#">
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#">
                                  <i class="fa fa-star-o" aria-hidden="true"></i>
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="googles single-item hvr-outline-out">
                            <form action="#" method="post">
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="googles_item" value="Fastrack Aviator">
                              <input type="hidden" name="amount" value="325.00">
                              <button type="submit" class="googles-cart pgoogles-cart">
                                <i class="fas fa-cart-plus"></i>
                              </button>
                            </form>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--//slider-->
    </div>
  </section>
  <!--footer -->

  <?php include '../../../include/web/message.php'; ?>
  <script>
    function GetCartDetails() {
      var getitemqty = document.getElementById("qty").value;
      document.getElementById("qtyinput").value = getitemqty;
      document.getElementById("qtyinput2").value = getitemqty;
    }
  </script>
  <script>
    function GetCartDetails2() {
      var getitemqty = document.getElementById("qty").value;
      document.getElementById("qtyinput").value = getitemqty;
      document.getElementById("qtyinput2").value = getitemqty;
    }
  </script>
  <script>
    function Increase() {
      var qty = document.getElementById("qty");

      //run increament
      if (qty.value < <?php echo MAX_ORDER_QTY; ?>) {
        qty.value++;
        document.getElementById("qty").value = qty.value;
      } else if (qty == <?php echo MAX_ORDER_QTY; ?>) {
        document.getElementById("qty").value = <?php echo MAX_ORDER_QTY; ?>;
      }
    }
  </script>

  <script>
    function Decrease() {
      var qty = document.getElementById("qty");

      //run increament
      if (qty.value > <?php echo MIN_ORDER_QTY; ?>) {
        qty.value--;
        document.getElementById("qty").value = qty.value;
      } else if (qty == <?php echo MIN_ORDER_QTY; ?>) {
        document.getElementById("qty").value = <?php echo MIN_ORDER_QTY; ?>;
      }
    }
  </script>

  <script>
    function frameoptions(data) {
      if (data === "withframes") {
        document.getElementById("withframes").style.display = "block";
        document.getElementById("withoutframes").style.display = "none";
      } else {
        document.getElementById("withframes").style.display = "none";
        document.getElementById("withoutframes").style.display = "block";
      }
    }
  </script>

  <?php include '../../../include/web/footer.php'; ?>

  <!--jQuery-->
  <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-2.2.3.min.js"></script>
  <!-- newsletter modal -->
  <!--search jQuery-->
  <script src="<?php echo ASSETS_URL; ?>/web/js/modernizr-2.6.2.min.js"></script>
  <script src="<?php echo ASSETS_URL; ?>/web/js/classie-search.js"></script>
  <script src="<?php echo ASSETS_URL; ?>/web/js/demo1-search.js"></script>
  <!--//search jQuery-->
  <!-- cart-js -->
  <script src="<?php echo ASSETS_URL; ?>/web/js/minicart.js"></script>
  <script>
    googles.render();

    googles.cart.on("googles_checkout", function(evt) {
      var items, len, i;

      if (this.subtotal() > 0) {
        items = this.items();

        for (i = 0, len = items.length; i < len; i++) {}
      }
    });
  </script>
  <!-- //cart-js -->
  <script>
    $(document).ready(function() {
      $(".button-log a").click(function() {
        $(".overlay-login").fadeToggle(200);
        $(this).toggleClass("btn-open").toggleClass("btn-close");
      });
    });
    $(".overlay-close1").on("click", function() {
      $(".overlay-login").fadeToggle(200);
      $(".button-log a").toggleClass("btn-open").toggleClass("btn-close");
      open = false;
    });
  </script>
  <!-- carousel -->
  <!-- price range (top products) -->
  <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-ui.js"></script>
  <script>
    //<![CDATA[
    $(window).load(function() {
      $("#slider-range").slider({
        range: true,
        min: 0,
        max: 9000,
        values: [50, 6000],
        slide: function(event, ui) {
          $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        },
      });
      $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
    }); //]]>
  </script>
  <!-- //price range (top products) -->

  <script src="<?php echo ASSETS_URL; ?>/web/js/owl.carousel.js"></script>
  <script>
    $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true,
          },
          600: {
            items: 2,
            nav: true,
          },
          900: {
            items: 3,
            nav: true,
          },
          1000: {
            items: 3,
            nav: true,
            loop: true,
            margin: 20,
          },
        },
      });
    });
  </script>

  <!-- //end-smooth-scrolling -->

  <!-- single -->
  <script src="<?php echo ASSETS_URL; ?>/web/js/imagezoom.js"></script>
  <!-- single -->
  <!-- script for responsive tabs -->
  <script src="<?php echo ASSETS_URL; ?>/web/js/easy-responsive-tabs.js"></script>
  <script>
    $(document).ready(function() {
      $("#horizontalTab").easyResponsiveTabs({
        type: "default", //Types: default, vertical, accordion
        width: "auto", //auto or any width like 600px
        fit: true, // 100% fit in a container
        closed: "accordion", // Start closed if in accordion view
        activate: function(event) {
          // Callback function if tab is switched
          var $tab = $(this);
          var $info = $("#tabInfo");
          var $name = $("span", $info);
          $name.text($tab.text());
          $info.show();
        },
      });
      $("#verticalTab").easyResponsiveTabs({
        type: "vertical",
        width: "auto",
        fit: true,
      });
    });
  </script>
  <!-- FlexSlider -->
  <script src="<?php echo ASSETS_URL; ?>/web/js/jquery.flexslider.js"></script>
  <script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
      $(".flexslider1").flexslider({
        animation: "slide",
        controlNav: "thumbnails",
      });
    });
  </script>
  <!-- //FlexSlider-->

  <!-- dropdown nav -->
  <script>
    $(document).ready(function() {
      $(".dropdown").hover(
        function() {
          $(".dropdown-menu", this).stop(true, true).slideDown("fast");
          $(this).toggleClass("open");
        },
        function() {
          $(".dropdown-menu", this).stop(true, true).slideUp("fast");
          $(this).toggleClass("open");
        }
      );
    });
  </script>
  <!-- //dropdown nav -->
  <script src="<?php echo ASSETS_URL; ?>/web/js/move-top.js"></script>
  <script src="<?php echo ASSETS_URL; ?>/web/js/easing.js"></script>
  <script>
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event) {
        event.preventDefault();
        $("html,body").animate({
            scrollTop: $(this.hash).offset().top,
          },
          500
        );
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
      };
      $().UItoTop({
        easingType: "easeOutQuart",
      });
    });
  </script>
  <!--// end-smoth-scrolling -->

  <script src="<?php echo ASSETS_URL; ?>/web/js/bootstrap.js"></script>
  <!-- js file -->

  <script>
    function Databar(data) {
      databar = document.getElementById("" + data + "");
      if (databar.style.display === "block") {
        databar.style.display = "none";
      } else {
        databar.style.display = "block";
      }
    }
  </script>

  <script>
    function AuthAccess() {
      var SignupArea = document.getElementById("SignupArea");
      var LoginArea = document.getElementById("LoginArea");
      if (LoginArea.style.display === "none") {
        LoginArea.style.display = "block";
        SignupArea.style.display = "none";
      } else {
        LoginArea.style.display = "none";
        SignupArea.style.display = "block";
      }
    }
  </script>
  <script>
    function checkpass() {
      var pass1 = document.getElementById("pass1");
      var pass2 = document.getElementById("pass2");
      if (pass1.value === "") {

      } else {
        if (pass1.value === pass2.value) {
          document.getElementById("passbtn").classList.remove("disabled");
          document.getElementById("passmsg").classList.add("text-success");
          document.getElementById("passmsg").classList.remove("text-danger");
          document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
        } else {
          document.getElementById("passmsg").classList.remove("text-success");
          document.getElementById("passmsg").classList.add("text-danger");
          document.getElementById("passbtn").classList.add("disabled");
          document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
        }
      }
    }
  </script>
</body>

</html>