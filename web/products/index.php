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
                  <form action="#" method="get">
                    <input class="form-control" onchange="form.submit()" list="productname" type="search" name="product_name" placeholder="Search here..." required="" />
                    <datalist id="productname">
                      <?php echo SelectOptions("SELECT * FROM products ORDER BY ProductName ASC", "ProductName", null); ?>
                    </datalist>
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
                      <div class="price-slider">
                        <span>
                          <span>From
                            <span id="from">Rs.100</span>
                            <input type="number" hidden="" value="100" min="100" max="230000" />
                          </span>
                          <span>To
                            <span id="to">Rs.500</span>
                            <input type="number" hidden="" value="500" min="500" max="230000" />
                          </span>
                        </span>
                        <input value="100" min="100" max="230000" step="250" type="range" />
                        <input value="500" min="500" max="230000" step="250" type="range" />
                        <svg width="100%" height="24">
                          <line x1="4" y1="0" x2="300" y2="0" stroke="#212121" stroke-width="12" stroke-dasharray="1 28"></line>
                        </svg>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- //price range -->
                <!-- deals -->
                <div class="deal-leftmk left-side">
                  <h3 class="agileits-sear-head">Trending Designs</h3>
                  <?php
                  $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductNewArrivalStatus='Yes' ORDER BY products.ProductId DESC LIMIT 0, 5");
                  while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
                    $ProductName = $fetchpro_brands['ProductName'];
                    $ProCategoryName = $fetchpro_brands['ProCategoryName'];
                    $ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
                    $ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
                    $ProductImage = $fetchpro_brands['ProductImage'];
                    $ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
                    $ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
                    $ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
                    $ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
                    $ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "e");
                    $ProductWeight = $fetchpro_brands['ProductWeight'];
                    $ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
                    $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
                    $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
                    $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
                    $ProductId3 = $fetchpro_brands['ProductId'];
                    $ProductAvailibility = $fetchpro_brands['ProductStatus'];
                    $ProductImage2 = $fetchpro_brands['ProductImage2'];

                    $ProductSellPrice = FETCH("SELECT MIN(ProOptionCharges) AS ProOptionCharges FROM pro_options where ProOptionProductId='$ProductId3' and ProOptionCharges!='0'", "ProOptionCharges");
                    //product tabs
                  ?>
                    <div class="special-sec1">
                      <div class="img-deals">
                        <a href="<?php echo WEB_URL; ?>/products/details/?productid=<?php echo SECURE($ProductId3, "e"); ?>">
                          <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" />
                        </a>
                      </div>
                      <div class="img-deal1">
                        <a href="<?php echo WEB_URL; ?>/products/details/?productid=<?php echo SECURE($ProductId3, "e"); ?>">
                          <h3 class="mb-0 m-b-0"><?php echo $ProductName; ?></h3>
                          <span class="category-name"><?php echo $ProCategoryName; ?></span><br>
                          <?php if ($ProductSellPrice == "0" || $ProductSellPrice == 0) { ?>
                            <a href="https://wa.me/<?php echo PRIMARY_PHONE; ?>?text=Hello <?php echo APP_NAME; ?>, I want to know the price and details of <?php echo $ProductName; ?> having Item Code : *<?php echo $ProductRefernceCode; ?>*. Item link is : <?php echo WEB_URL; ?>/products/details/?productid=<?php echo SECURE($ProductId3, "e"); ?>" target="_blank" class="btn btn-sm app-btn mt-0 mb-2 fs-12"> Request Price <i class='fa fa-whatsapp text-success'></i></a>

                          <?php } else { ?>
                            <span class="price">
                            <?php
                            echo Price($ProductSellPrice);
                          } ?>
                            </span>
                        </a>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  <?php
                    //end of product listing loop
                  } ?>
                </div>
                <!-- //deals -->
              </div>
              <!-- //product left -->
            </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <?php if (isset($_GET['product_name'])) { ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <h5><i class="fa fa-search"></i> <b>Search Results for :</b> <span><?php echo $_GET['product_name']; ?></span>
                    </h5>
                    <a href="<?php echo WEB_URL; ?>/products/" class="btn btn-sm btn-danger"> Clear Search <i class="fa fa-times text-white"></i></a>
                  </div>
                  <hr>
                </div>
              </div>
            <?php } ?>
            <div class="row">
              <?php
              //fetch conditions
              if (isset($_GET['categoryid'])) {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductCategoryId='$ProCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              } elseif (isset($_GET['subcategoryid'])) {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId='$ProSubCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              } elseif (isset($_GET['product_name'])) {
                $product_name = $_GET['product_name'];
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductName LIKE '%$product_name%' and products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              } else {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              }
              //product fetch loops
              while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
                $ProductName = $fetchpro_brands['ProductName'];
                $ProCategoryName = $fetchpro_brands['ProCategoryName'];
                $ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
                $ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
                $ProductImage = $fetchpro_brands['ProductImage'];
                $ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
                $ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
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
                $ProductImage2 = $fetchpro_brands['ProductImage2'];
                $ProductSize = $fetchpro_brands['ProductSize'];
                $ProductMedium = $fetchpro_brands['ProductMedium'];

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
  <script>
    (function() {

      var parent = document.querySelector(".price-slider");
      if (!parent) return;

      var
        rangeS = parent.querySelectorAll("input[type=range]"),
        numberS = parent.querySelectorAll("input[type=number]");

      rangeS.forEach(function(el) {
        el.oninput = function() {
          var slide1 = parseFloat(rangeS[0].value),
            slide2 = parseFloat(rangeS[1].value);

          if (slide1 > slide2) {
            [slide1, slide2] = [slide2, slide1];
          }

          numberS[0].value = slide1;
          numberS[1].value = slide2;

          document.getElementById("from").innerHTML = "Rs." + slide1;
          document.getElementById("to").innerHTML = "Rs." + slide2;
        }
      });

      numberS.forEach(function(el) {
        el.oninput = function() {
          var number1 = parseFloat(numberS[0].value),
            number2 = parseFloat(numberS[1].value);

          if (number1 > number2) {
            var tmp = number1;
            numberS[0].value = number2;
            numberS[1].value = tmp;

            document.getElementById("from").innerHTML = "Rs." + number2;
            document.getElementById("to").innerHTML = "Rs." + number1;
          }

          rangeS[0].value = number1;
          rangeS[1].value = number2;

          document.getElementById("from").innerHTML = "Rs." + number1;
          document.getElementById("to").innerHTML = "Rs." + number2;

        }
      });

    })();
  </script>
  <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-ui.js"></script>
  <?php include '../../include/web/footer_files.php'; ?>

</body>

</html>