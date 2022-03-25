<?php
//require modules;
require '../../require/modules.php';
require '../../require/web-modules.php';

//page variable and activity
if (isset($_GET['categoryid'])) {
  $ProCategoriesId = SECURE($_GET['categoryid'], "d");
  $PageName = FETCH("SELECT * FROM pro_categories where ProCategoriesId='$ProCategoriesId'", "ProCategoryName");
  $Pagesubname = "Collection of $PageName by " . APP_NAME;
} elseif (isset($_GET['subcategoryid'])) {
  $ProSubCategoriesId = SECURE($_GET['subcategoryid'], "d");
  $PageName = FETCH("SELECT * FROM pro_sub_categories where ProSubCategoriesId='$ProSubCategoriesId'", "ProSubCategoryName");
  $Pagesubname = "Collection of $PageName by " . APP_NAME;
} else {
  $PageName = "All Painting";
  $Pagesubname = "Collection of " . APP_NAME;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $PageName; ?> By <?php echo APP_NAME; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <script>
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <?php include '../../include/web/header_files.php'; ?>
</head>

<body>
  <div class="banner-top container-fluid" id="home">
    <?php
    include '../../include/web/header.php';
    ?>
  </div>
  <section class="banner-bottom-wthreelayouts">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="page-heading">
          <h3 class="tittle-w3layouts text-center"><?php echo $PageName; ?></h3>
          <p><?php echo $Pagesubname; ?></p>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="inner-sec-shop px-lg-4 px-3">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="row">
              <!-- product left -->
              <div class="side-bar col-lg-12">
                <div class="search-hotel">
                  <h3 class="agileits-sear-head">Search Here..</h3>
                  <form action="#" method="post">
                    <input class="form-control" type="search" name="search" placeholder="Search here..." required="" />
                    <button class="btn1">
                      <i class="fas fa-search"></i>
                    </button>
                    <div class="clearfix"></div>
                  </form>
                </div>
                <!-- price range -->
                <div class="range">
                  <h3 class="agileits-sear-head">Price range</h3>
                  <ul class="dropdown-menu6">
                    <li>
                      <div id="slider-range"></div>
                      <input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
                    </li>
                  </ul>
                </div>
                <!-- //price range -->
                <!--preference -->
                <div class="left-side">
                  <h3 class="agileits-sear-head">Deal Offer On</h3>
                  <ul>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">Backpack</span>
                    </li>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">Phone Pocket</span>
                    </li>
                  </ul>
                </div>
                <!-- // preference -->
                <!-- discounts -->
                <div class="left-side">
                  <h3 class="agileits-sear-head">Discount</h3>
                  <ul>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">5% or More</span>
                    </li>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">10% or More</span>
                    </li>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">20% or More</span>
                    </li>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">30% or More</span>
                    </li>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">50% or More</span>
                    </li>
                    <li>
                      <input type="checkbox" class="checked" />
                      <span class="span">60% or More</span>
                    </li>
                  </ul>
                </div>
                <!-- //discounts -->
                <!-- reviews -->
                <div class="customer-rev left-side">
                  <h3 class="agileits-sear-head">Customer Review</h3>
                  <ul>
                    <li>
                      <a href="#">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span>5.0</span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <span>4.0</span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <span>3.5</span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <span>3.0</span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <span>2.5</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- //reviews -->
                <!-- deals -->
                <div class="deal-leftmk left-side">
                  <h3 class="agileits-sear-head">Special Deals</h3>
                  <div class="special-sec1">
                    <div class="img-deals">
                      <img src="images\s1.jpg" alt="" />
                    </div>
                    <div class="img-deal1">
                      <h3>Farenheit (Grey)</h3>
                      <a href="single.html">$575.00</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="special-sec1">
                    <div class="col-xs-4 img-deals">
                      <img src="images\s2.jpg" alt="" />
                    </div>
                    <div class="col-xs-8 img-deal1">
                      <h3>Opium (Grey)</h3>
                      <a href="single.html">$325.00</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="special-sec1">
                    <div class="col-xs-4 img-deals">
                      <img src="images\m2.jpg" alt="" />
                    </div>
                    <div class="col-xs-8 img-deal1">
                      <h3>Azmani Round</h3>
                      <a href="single.html">$725.00</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="special-sec1">
                    <div class="col-xs-4 img-deals">
                      <img src="images\m4.jpg" alt="" />
                    </div>
                    <div class="col-xs-8 img-deal1">
                      <h3>Farenheit Oval</h3>
                      <a href="single.html">$325.00</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <!-- //deals -->
              </div>
              <!-- //product left -->
            </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
              <?php
              //fetch conditions
              if (isset($_GET['categoryid'])) {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductCategoryId='$ProCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId  ORDER BY products.ProductStatus DESC");
              } elseif (isset($_GET['subcategoryid'])) {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId='$ProSubCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId  ORDER BY products.ProductStatus DESC");
              } else {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId  ORDER BY products.ProductStatus DESC");
              }
              //product fetch loops
              while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
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
                $ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "e");
                $ProductWeight = $fetchpro_brands['ProductWeight'];
                $ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
                $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
                $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
                $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
                $ProductId = $fetchpro_brands['ProductId'];
                $ProductAvailibility = $fetchpro_brands['ProductStatus'];

                //product tabs
                include __DIR__ . "/../../include/web/section/common/product-tab.php";
                //end of product listing loop
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    if (isset($_GET['categoryid'])) { ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center px-2 py-2">
            <a href="<?php echo DOMAIN; ?>/web/products/" class="app-text view-more">View All Paintings</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
  <!-- about -->


  <?php include '../../include/web/footer.php'; ?>

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

  <?php include '../../include/web/footer_files.php'; ?>

</body>

</html>