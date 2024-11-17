<?php
//require modules;
require 'require/modules.php';
require 'require/web-modules.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home : <?php echo APP_NAME; ?></title>
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
  <?php include 'include/web/header_files.php'; ?>
</head>

<body>

  <loader id="loader">
    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/loader.gif" class="img-fluid">
  </loader>

  <div class="banner-top container-fluid" id="home">
    <?php
    include 'include/web/header.php';
    include 'include/web/slider.php';
    ?>
  </div>

  <section class="banner-bottom-wthreelayouts py-lg-4 py-3">
    <div class="container-fluid">
      <!-- /clients-sec -->
      <div class="testimonials p-lg-5 p-3 mt-0">
        <div class="row last-section">
          <?php
          $FetchOrderHights = FetchConvertIntoArray("SELECT * FROM orderhighlights ORDER BY OrderHiglightsId ASC", true);
          if ($FetchOrderHights != null) {
            foreach ($FetchOrderHights as $Data) { ?>
              <div class="col footer-top-w3layouts-grid-sec">
                <div class="mail-grid-icon text-center">
                  <i class="fas <?php echo $Data->OrderHighLighIcons; ?>"></i>
                </div>
                <div class="mail-grid-text-info">
                  <h3><?php echo SECURE($Data->OrderHighlightsTitle, "d"); ?></h3>
                  <?php echo html_entity_decode(SECURE($Data->OrderHighLightDesc, "d")); ?>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="inner-sec-shop px-lg-4 px-3">
        <h3 class="tittle-w3layouts my-lg-4 my-4 text-center">Latest WallPaper</h3>
        <div class="row">
          <?php
          $FetchWallPapers = FetchConvertIntoArray("SELECT * FROM wallpapers ORDER BY WallPapersId DESC LIMIT 8", true);
          if ($FetchWallPapers != null) {
            foreach ($FetchWallPapers as $WallPaper) {
              $WallPaperImageFile = FETCH("SELECT * FROM wallpaper_images where  WallPaperMainId='" . $WallPaper->WallPapersId . "'", "WallPaperImageFile"); ?>
              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6 col-6">
                <div class="wallpaper-list-tab">
                  <a href="<?php echo WEB_URL; ?>/wallpapers/details/?wallpaperid=<?php echo SECURE($WallPaper->WallPapersId, "e"); ?>">
                    <img src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPaper->WallPapersId; ?>/<?php echo $WallPaperImageFile; ?>" loading="lazy">
                    <?php
                    tags(
                      "h5",
                      $WallPaper->WallPaperName,
                      [
                        "class" => "bold"
                      ]
                    );
                    tags(
                      "p",
                      "" . FETCH("SELECT * FROM wallpaper_category where WallPaperCategoryId='" . $WallPaper->WallPaperCategoryId . "'", "WallPaperCategoryName") . "",
                      [
                        "class" => "text-grey"
                      ]
                    );
                    Price($WallPaper->WallPaperStartPrice, "text-danger h4");
                    ?>
                  </a>
                </div>
              </div>
          <?php }
          } ?>
        </div>
        <?php $CountCategories = TOTAL("SELECT * FROM pro_categories where ProCategoryStatus='1'");
        if ($CountCategories >= 8) { ?>
          <div class="col-md-12 text-center">
            <a href="<?php echo DOMAIN; ?>/web/wallpapers/" class="app-text view-more">View More <i class="fas fa-angle-right"></i></a>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="container">
      <div class="inner-sec-shop px-lg-4 px-3">
        <h3 class="tittle-w3layouts my-lg-4 my-4 text-center">WallArt Collections</h3>
        <div class="row">
          <?php
          $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC Limit 0, 8", true);
          if ($FetchCategories !=  null) {
            foreach ($FetchCategories as $Data) {
              include 'include/web/section/common/category-tab.php';
            }
          } ?>
        </div>
        <?php $CountCategories = TOTAL("SELECT * FROM pro_categories where ProCategoryStatus='1'");
        if ($CountCategories >= 8) { ?>
          <div class="col-md-12 text-center">
            <a href="<?php echo DOMAIN; ?>/web/collection/" class="app-text view-more">View More <i class="fas fa-angle-right"></i></a>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'include/web/section/new-arrival.php'; ?>

    <section class="container mt-5 mb-3">
      <div class="row">
        <div class="col-lg-5 col-md-5">
          <div class="p-3">
            <?php $PageAccess = "AboutUs"; ?>
            <img src="<?php echo STORAGE_URL; ?>/pages/<?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageFeatureImage"); ?>" class="img-fluid" loading="lazy">
          </div>
        </div>
        <div class="col-lg-7 col-md-7">
          <div class="p-3">
            <h3><b><?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageDisplayName"); ?></b></h3>
            <hr>
            <div class="about-us-home-page-text-limitation">
              <?php echo SECURE(FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageContent"), "d"); ?>
            </div>
            <a href="<?php echo WEB_URL; ?>/about-us/" class="app-btn btn-md btn">Know More</a>
          </div>
        </div>
      </div>
    </section>

    <div class="container">
      <!--/slide-->
      <div class="slider-img mid-sec mt-lg-5 mt-2 px-lg-5 px-3">
        <!--//banner-sec-->
        <h3 class="tittle-w3layouts text-center my-lg-4 my-3">Our Blogs</h3>
        <div class="mid-slider">
          <div class="owl-carousel new owl-theme row">

            <?php
            $FetchListings = FetchConvertIntoArray("SELECT * FROM blogs ORDER BY BlogsId ASC", true);
            if ($FetchListings != null) {
              $Sno = 0;
              foreach ($FetchListings as $Fields) {
                $Sno++; ?>
                <div class="item">
                  <div class="gd-box-info text-center">
                    <div class="product-men women_two bot-gd">
                      <div class="product-googles-info slide-img googles">
                        <div class="men-pro-item">
                          <div class="men-thumb-item">
                            <a href="web/blogs/details/?blogid=<?php echo SECURE($Fields->BlogsId, "e"); ?>">
                              <img loading="lazy" src="<?php echo STORAGE_URL; ?>/blogs/<?php echo $Fields->BlogsFeatureImage; ?>" class="img-fluid" alt="">
                            </a>
                          </div>
                          <div class="item-info-product">
                            <div class="info-product-price">
                              <div class="grid_meta">
                                <div class="product_price">
                                  <h4 class="mt-3 mb-2">
                                    <a href="web/blogs/details/?blogid=<?php echo SECURE($Fields->BlogsId, "e"); ?>"><?php echo SECURE($Fields->BlogsTitle, "d"); ?></a><br>
                                    <span class="flex-s-b mt-3">
                                      <span class="fs-12"><i class="fa fa-user"></i>
                                        <?php echo FETCH("SELECT * FROM users where UserId='" . $Fields->BlogsPostedBy . "'", "UserName"); ?></span>
                                      <span class="fs-12"><i class="fa fa-calendar"></i>
                                        <?php echo DATE_FORMATE2("d M, Y", $Fields->BlogsCreatedAt); ?></span>
                                    </span>
                                  </h4>
                                  <div class="blog-details">
                                    <?php echo html_entity_decode(SECURE($Fields->BlogsDescriptions, "d")); ?>
                                  </div>
                                  <a href="web/blogs/details/?blogid=<?php echo SECURE($Fields->BlogsId, "e"); ?>" class="btn btn-sm app-btn">Read More</a>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            }
            ?>



          </div>
        </div>
      </div>
      <!--//slider-->
    </div>
  </section>
  <!-- about -->

  <?php
  $FetchListings = FetchConvertIntoArray("SELECT * FROM offers where OfferStatus='1' ORDER BY OffersId ASC", true);
  if ($FetchListings != null) {
    $Sno = 0; ?>
    <section class="welcome-offer" style="display:none;" id="offerbox">
      <div class="content-box">
        <a href="#" onclick="Databar('offerbox')"><i class="fa fa-times"></i></a>
        <?php foreach ($FetchListings as $Fields) {
          $Sno++;
          if ($Fields->OfferDiscountType == "Percentage") {
            $OfferDiscountValue = "" . $Fields->OfferDiscountValue . "%";
          } else {
            $OfferDiscountValue = "Rs. " . $Fields->OfferDiscountValue;
          } ?>
          <img loading="lazy" src="<?php echo STORAGE_URL; ?>/offers/<?php echo $Fields->OfferImage; ?>" class="img-fluid">
        <?php } ?>
      </div>
    </section>
  <?php } ?>

  <?php include 'include/web/footer.php'; ?>

  <script>
    setTimeout(function() {
      document.getElementById("offerbox").style.display = "block";
    }, 5000); //run this after 5 seconds
  </script>
  <script>
    window.onload = function() {
      document.getElementById("loader").style.display = "none";
    };
  </script>

  <!-- // modal -->
  <?php include 'include/web/footer_files.php'; ?>

</body>

</html>