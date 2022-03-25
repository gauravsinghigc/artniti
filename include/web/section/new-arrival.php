<div class="container-fluid">
 <div class="inner-sec-shop px-lg-4 px-3">
  <h3 class="tittle-w3layouts my-lg-4 my-4 text-center">New Arrivals for you </h3>
  <div class="row">

   <?php
   $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId  ORDER BY products.ProductStatus DESC limit 0, 8");
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
    include __DIR__ . "/common/product-tab.php";

    //end of product listing loop
   } ?>
  </div>
  <div class="row">
   <?php $CountCategories = TOTAL("SELECT * FROM products where ProductStatus='1'");
   if ($CountCategories >= 8) { ?>
    <div class="col-md-12 text-center">
     <a href="<?php echo DOMAIN; ?>/web/products/" class="app-text view-more">View All Products <i class="fas fa-angle-right"></i></a>
    </div>
   <?php } ?>
   <br><br><br>
  </div>
 </div>
</div>