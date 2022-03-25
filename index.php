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
          <div class="col-lg-3 footer-top-w3layouts-grid-sec">
            <div class="mail-grid-icon text-center">
              <i class="fas fa-gift"></i>
            </div>
            <div class="mail-grid-text-info">
              <h3>Genuine Product</h3>
              <p>Lorem ipsum dolor sit amet, consectetur</p>
            </div>
          </div>
          <div class="col-lg-3 footer-top-w3layouts-grid-sec">
            <div class="mail-grid-icon text-center">
              <i class="fas fa-shield-alt"></i>
            </div>
            <div class="mail-grid-text-info">
              <h3>Secure Products</h3>
              <p>Lorem ipsum dolor sit amet, consectetur</p>
            </div>
          </div>
          <div class="col-lg-3 footer-top-w3layouts-grid-sec">
            <div class="mail-grid-icon text-center">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="mail-grid-text-info">
              <h3>Cash on Delivery</h3>
              <p>Lorem ipsum dolor sit amet, consectetur</p>
            </div>
          </div>
          <div class="col-lg-3 footer-top-w3layouts-grid-sec">
            <div class="mail-grid-icon text-center">
              <i class="fas fa-truck"></i>
            </div>
            <div class="mail-grid-text-info">
              <h3>Easy Delivery</h3>
              <p>Lorem ipsum dolor sit amet, consectetur</p>
            </div>
          </div>
        </div>
      </div>
      <!-- //clients-sec -->
      <div class="inner-sec-shop px-lg-4 px-3">
        <h3 class="tittle-w3layouts my-lg-4 my-4 text-center">Shop By Categories</h3>
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
            <a href="<?php echo DOMAIN; ?>/web/collection/" class="app-text view-more">View All Categories <i class="fas fa-angle-right"></i></a>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'include/web/section/new-arrival.php'; ?>

    <div class="container-fluid">
      <div class="inner-sec-shop px-lg-4 px-3">

        <div class="testimonials py-lg-4 py-3 mt-4">
          <div class="testimonials-inner py-lg-4 py-3">
            <h3 class="tittle-w3layouts text-center my-lg-4 my-4">Tesimonials</h3>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <div class="testimonials_grid text-center">
                    <h3>Anamaria
                      <span>Customer</span>
                    </h3>
                    <label>United States</label>
                    <p>Maecenas interdum, metus vitae tincidunt porttitor, magna quam egestas sem, ac scelerisque nisl nibh vel lacus.
                      Proin eget gravida odio. Donec ullamcorper est eu accumsan cursus.</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonials_grid text-center">
                    <h3>Esmeralda
                      <span>Customer</span>
                    </h3>
                    <label>United States</label>
                    <p>Maecenas interdum, metus vitae tincidunt porttitor, magna quam egestas sem, ac scelerisque nisl nibh vel lacus.
                      Proin eget gravida odio. Donec ullamcorper est eu accumsan cursus.</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonials_grid text-center">
                    <h3>Gretchen
                      <span>Customer</span>
                    </h3>
                    <label>United States</label>
                    <p>Maecenas interdum, metus vitae tincidunt porttitor, magna quam egestas sem, ac scelerisque nisl nibh vel lacus.
                      Proin eget gravida odio. Donec ullamcorper est eu accumsan cursus.</p>
                  </div>
                </div>
                <a class="carousel-control-prev test" href="#carouselExampleControls" role="button" data-slide="prev">
                  <i class="fas fa-long-arrow-alt-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next test" href="#carouselExampleControls" role="button" data-slide="next">
                  <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                  <span class="sr-only">Next</span>

                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- //testimonials -->
        <div class="row galsses-grids pt-lg-5 pt-3">
          <div class="col-lg-6 galsses-grid-left">
            <figure class="effect-lexi">
              <img src="images/banner4.jpg" alt="" class="img-fluid">
              <figcaption>
                <h3>Editor's
                  <span>Pick</span>
                </h3>
                <p> Express your style now.</p>
              </figcaption>
            </figure>
          </div>
          <div class="col-lg-6 galsses-grid-left">
            <figure class="effect-lexi">
              <img src="images/banner1.jpg" alt="" class="img-fluid">
              <figcaption>
                <h3>Editor's
                  <span>Pick</span>
                </h3>
                <p>Express your style now.</p>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about -->


  <?php include 'include/web/footer.php'; ?>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center p-5 mx-auto mw-100">
          <h6>Join our newsletter and get</h6>
          <h3>50% Off for your first Pair of Eye wear</h3>
          <div class="login newsletter">
            <form action="#" method="post">
              <div class="form-group">
                <label class="mb-2">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="" required="">
              </div>
              <button type="submit" class="btn btn-primary submit mb-4">Get 50% Off</button>
            </form>
            <p class="text-center">
              <a href="#">No thanks I want to pay full Price</a>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $("#myModal").modal();
    });
  </script>
  <!-- // modal -->
  <?php include 'include/web/footer_files.php'; ?>

</body>

</html>