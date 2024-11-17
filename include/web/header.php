<?php
$VisitorsIP = IP_ADDRESS;
$VisitorDeviceType = DEVICE_TYPE;
$VisitorDeviceDetails = SECURE(SYSTEM_INFO, "e");
$VisitorVisitingDate = date("d-m-Y");
if (isset($_SESSION['LOGIN_CustomerId'])) {
  $VisitorCustomerId = $_SESSION['LOGIN_CustomerId'];
} else {
  $VisitorCustomerId = 0;
}

//check visitors type 
$VisitorIsComing = CHECK("SELECT * FROM visitors where VisitorsIP='$VisitorsIP'");
if ($VisitorIsComing == null) {
  $VisitorsType = "New";
} else {
  $VisitorsType = "Re-visits";
}

$SAVE = SAVE("visitors", ["VisitorsIP", "VisitorDeviceType", "VisitorsType", "VisitorDeviceDetails", "VisitorVisitingDate", "VisitorCustomerId"], false);
?>

<!-- header -->
<section class="container-fluid">
  <div class="row">
    <div class="col-md-12 text-center app-bg pt-1">
      <p class="text-white mb-0">
        <?php
        $FetchListings = FetchConvertIntoArray("SELECT * FROM offers where OfferStatus='1' ORDER BY OffersId ASC", true);
        if ($FetchListings != null) {
          $Sno = 0;
          foreach ($FetchListings as $Fields) {
            $Sno++;
            if ($Fields->OfferDiscountType == "Percentage") {
              $OfferDiscountValue = "" . $Fields->OfferDiscountValue . "%";
            } else {
              $OfferDiscountValue = "Rs. " . $Fields->OfferDiscountValue;
            } ?>
            <?php echo $Fields->OffersName; ?> - <?php echo $Fields->OfferCouponCode; ?> and get
            <?php echo $OfferDiscountValue; ?> off on your purchase.
        <?php }
        }
        ?>
      </p>
    </div>
  </div>
</section>
<header>
  <div class="row">
    <div class="col-md-4 top-info text-left mt-lg-4">
      <ul class="footer-social text-center mt-1">
        <li class="mx-2">
          <a href="tel:<?php echo PRIMARY_PHONE; ?>" target="_blank" alt="Call @ <?php echo APP_NAME; ?>" title="Call @ <?php echo APP_NAME; ?>"> <?php echo PRIMARY_PHONE; ?></i>
            |
          </a>
        </li>
        <?php echo SocialAccounts(); ?>
      </ul>
    </div>
    <div class="col-md-4 logo-w3layouts text-center">
      <h1 class="logo-w3layouts">
        <a class="navbar-brand" href="<?php echo DOMAIN; ?>">
          <img src="<?php echo MAIN_LOGO; ?>" loading="lazy" class="app-logo lazyload">
        </a>
      </h1>
    </div>

    <div class="col-md-4 top-info-cart text-center mt-lg-4">
      <ul class="cart-inner-info">
        <li class="button-log">
          <button id="trigger-overlay" type="button">
            <i class="fa fa-search"></i>
          </button>
          <div class="overlay overlay-door">
            <button type="button" class="overlay-close">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            <form action="<?php echo WEB_URL; ?>/products/" method="get" class="d-flex">
              <input class="form-control" list="productname" onchange="form.submit()" type="text" name="product_name" placeholder="Search here..." required="">
              <datalist id="productname">
                <?php echo SelectOptions("SELECT * FROM products ORDER BY ProductName ASC", "ProductName", "ProductName", null); ?>
              </datalist>
              <button type="submit" class="mt-0 mb-0 btn app-btn btn-lg submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
        </li>
        <li class="button-log">
          <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
            <a href="<?php echo WEB_URL; ?>/account/">
              <i class="fa fa-user"></i>
              My Account
            </a>
            <a href="<?php echo DOMAIN; ?>/logout.php" class="ml-2">
              Logout <i class="fa fa-sign-out"></i>
            </a>
          <?php } else { ?>
            <a href="<?php echo DOMAIN; ?>/auth/web/">
              <i class="fa fa-user"></i>
              Login / Signup
            </a>
          <?php  } ?>
        </li>
        <li class="galssescart galssescart2 cart cart box_1">
          <a href="<?php echo DOMAIN; ?>/web/cart/">
            <button class="top_googles_cart" type="button">
              <i class="fa fa-cart-arrow-down"></i>
              <span class="cart-item-count"><?php echo CartItems(); ?></span>
            </button>
          </a>
        </li>
      </ul>
      <!---->
    </div>
  </div>

  <label class="top-log mx-auto"></label>
  <nav class="navbar navbar-expand-lg navbar-light bg-light top-header mb-2" id="app-top-header">

    <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">

      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-mega mx-auto">
        <li class="nav-item active">
          <a class="nav-link ml-lg-0" href="<?php echo DOMAIN; ?>"><i class="fa fa-home home-icon"></i>
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Wall Art
          </a>
          <ul class="dropdown-menu mega-menu ">
            <li>
              <div class="row">
                <div class="col-md-6 media-list span4 text-left">
                  <h5 class="tittle-w3layouts-sub mb-2"> Available Collection </h5>
                  <ul>
                    <?php
                    $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC", true);
                    if ($FetchCategories !=  null) {
                      foreach ($FetchCategories as $Data) { ?>
                        <li>
                          <a href="<?php echo DOMAIN; ?>/web/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>">
                            <?php echo $Data->ProCategoryName; ?></a>
                        </li>
                    <?php
                      }
                    } ?>
                  </ul>
                </div>
                <div class="col-md-6 media-list span4 text-left">
                  <h5 class="tittle-w3layouts-sub mb-2"> <?php echo APP_NAME; ?> Categories </h5>
                  <ul>
                    <?php
                    $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_sub_categories where ProSubCategoryStatus='1' ORDER BY ProSubCategoriesId DESC", true);
                    if ($FetchCategories !=  null) {
                      foreach ($FetchCategories as $Data) { ?>
                        <li>
                          <a href="<?php echo DOMAIN; ?>/web/products/?subcategoryid=<?php echo SECURE($Data->ProSubCategoriesId, "e"); ?>">
                            <?php echo $Data->ProSubCategoryName; ?></a>
                        </li>
                    <?php
                      }
                    } ?>
                  </ul>
                </div>
              </div>
              <hr>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/wallpapers/">Wall Papers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/products/">All Collection</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/offers/">Offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/about-us/">About <?php echo APP_NAME; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/blogs/">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/reviews/">Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DOMAIN; ?>/web/contact-us/">Contact</a>
        </li>
      </ul>

    </div>
  </nav>
</header>
<!-- //header -->