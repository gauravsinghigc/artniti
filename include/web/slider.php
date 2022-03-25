<!-- banner -->
<div class="banner">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <?php
      $FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders where SliderStatus='1' and SliderType='Website' and SliderLocations='HomePageWebsite' ORDER BY SliderId ASC", true);
      if ($FetchSliders != null) {
        $ActiveSlider = 0;
        foreach ($FetchSliders as $data) {
          $ActiveSlider++;
          if ($ActiveSlider == 1) {
            $active = "active";
          } else {
            $active = "";
          }
          if ($data->SliderOpenAt == "Same Page") {
            $target = "";
          } else {
            $target = "target='_blank'";
          } ?>
          <div class="carousel-item <?php echo $active; ?>" style="background-image: url('<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderImage; ?>');background-size:cover;">
            <div class="carousel-caption text-center">
              <h3 style="display:none;"><?php echo $data->SliderName; ?>
                <span><?php echo $data->SliderOfferText; ?></span>
              </h3>
              <br>
              <br>
              <a href="<?php echo $data->SliderTargetUrl; ?>" <?php echo $target; ?> class="btn btn-sm animated-button gibson-three mt-6">Shop Now</a>
            </div>
          </div>
      <?php
        }
      } ?>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!--//banner -->
</div>
<!--//banner-sec-->