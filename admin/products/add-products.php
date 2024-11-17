<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "ADD Products";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>
  <style>
    table.table tr th,
    table.table tr td {
      font-size: 0.9rem !important;
      padding: 0.2rem !important;
    }
  </style>
</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                <?php FormPrimaryInputs(true); ?>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="app-heading"><i class="fa fa-plus"></i> <?php echo $PageName; ?></h4>
                  </div>
                  <div class="col-md-12 m-t-10">
                    <div class="flex-s-b">
                      <?php include 'common.php'; ?>
                    </div>
                  </div>
                  <div class="col-md-12 m-t-10">
                    <h4 class="app-sub-heading">Product Details</h4>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter Painting Name</label>
                    <input type="text" name="ProductName" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select Collection Name</label>
                    <select name="ProductCategoryId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                      while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) { ?>
                        <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>"><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select Category</label>
                    <select name="ProductSubCategoryId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $SqlSubcategory = SELECT("SELECT * FROM pro_sub_categories ORDER BY ProSubCategoryName ASC");
                      while ($fetchsubcategory = mysqli_fetch_array($SqlSubcategory)) { ?>
                        <option value="<?php echo $fetchsubcategory['ProSubCategoriesId']; ?>"><?php echo $fetchsubcategory['ProSubCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Item MRP</label>
                    <input type="number" min="0" name="ProductMrpPrice" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Work Type</label>
                    <input type="text" name="ProductWorkType" list="ProductWorkType" class="form-control-2" required="" />
                    <?php SUGGEST("products", "ProductWorkType", "ASC") ?>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Painting Medium</label>
                    <input type="text" name="ProductMedium" list="ProductMedium" class="form-control-2" required="" />
                    <?php SUGGEST("products", "ProductMedium", "ASC") ?>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Sort By Order</label>
                    <input type="number" min="0" name="ProductPageOrder" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Size</label>
                    <input type="text" name="ProductSize" list="ProductSize" class="form-control-2" required="" />
                    <?php SUGGEST("products", "ProductSize", "ASC") ?>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>ITEM CODE</label>
                    <input type="text" name="ProductRefernceCode" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>New Arrival ?</label>
                    <div class="flex-s">
                      <span class="m-l-5">
                        <input type="radio" name="ProductNewArrivalStatus" value="Yes" checked="" required="" /> Yes
                      </span>
                      <span class="m-l-30">
                        <input type="radio" name="ProductNewArrivalStatus" value="No" required="" /> No
                      </span>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-6 m-t-10">
                    <h4 class="app-sub-heading">Paper Options</h4>
                    <div class="flex-start col-md-6 col-lg-6 col-sm-6">
                      <?php
                      $PaperOptions = array("Canvas", "Paper");
                      foreach ($PaperOptions as $key => $value) {
                        if ($key == 0) {
                          $checked = "checked";
                        } else {
                          $checked = "";
                        } ?>
                        <div class="form-group btn btn-md btn-default option-btn">
                          <label class="m-0 mt-0 mb-3">
                            <input type="checkbox" name="PaperOption[]" value="<?php echo $value; ?>" <?php echo $checked;  ?>> <?php echo $value; ?>
                          </label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="col-md-6 m-t-10">
                    <h4 class="app-sub-heading">Frame Color Options</h4>
                    <div class="flex-start col-md-6 col-lg-6 col-sm-6">
                      <?php
                      $PaperOptions = array("Black", "Brown", "Gold");
                      foreach ($PaperOptions as $key => $value) {
                        if ($key == 0) {
                          $checked = "checked";
                        } else {
                          $checked = "";
                        } ?>
                        <div class="form-group btn btn-md btn-default option-btn">
                          <label class="m-0 mt-0 mb-3">
                            <input type="checkbox" name="ColorOptions[]" value="<?php echo $value; ?>" <?php echo $checked;  ?>> <?php echo $value; ?>
                            <span class="color-box" style="background-color:<?php echo $value; ?> !important;"></span>
                          </label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-10">
                    <h4 class="app-sub-heading">With Frame Price</h4>
                    <table class="table">
                      <tr>
                        <th>Frame Size (In inches)</th>
                        <th>Applicable Price (without GST)</th>
                      </tr>
                      <?php
                      $WithFrameSizes = array("10x13 inch", "14x18 inch", "18x24 inch", "24x30 inch", "27x37 inch");
                      foreach ($WithFrameSizes as $Framesizes) { ?>
                        <tr>
                          <td><span class="btn btn-md"><?php echo $Framesizes; ?></span></td>
                          <td>
                            <input type="text" name="WITHFRAMEPRICE[]" class="form-control-2 fs-12" required="" placeholder="Rs.">
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-10">
                    <h4 class="app-sub-heading">Without Frame Price</h4>
                    <table class="table">
                      <tr>
                        <th>Unframed Size (In inches)</th>
                        <th>Applicable Price (without GST)</th>
                      </tr>
                      <?php
                      $WithOutFrameSizes = array("10x13 inch", "14x18 inch", "18x24 inch", "24x30 inch", "27x37 inch", "30x45 inch", "36x54 inch");
                      foreach ($WithOutFrameSizes as $Framesizes) { ?>
                        <tr>
                          <td><span class="btn btn-md"><?php echo $Framesizes; ?></span></td>
                          <td>
                            <input type="text" name="WITHOUTFRAMEPRICE[]" class="form-control-2 fs-12" required="" placeholder="Rs.">
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                  <div class="col-md-12 m-t-10">
                    <h4 class="app-heading">Applicable GST or Tax</h4>
                    <div class="form-group col-md-6 col-lg-6">
                      <label>Applicable GST in % (For All Prices)</label>
                      <select name="ProductApplicableTaxes" class="form-control-2" required="">
                        <?php echo InputOptions(["0", "5", "7", "10", "12", "15", "18", "20"]); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12 m-t-10">
                    <h4 class="app-heading">More Details About Product</h4>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                    <label>Enter Something About Painting</label>
                    <textarea type="text" id="editor" name="ProductDescriptions" style="height:100% !important;" row="3" class="form-control-2"></textarea>
                  </div>

                  <div class="col-md-12 m-t-10">
                    <h4 class="app-heading">Upload Primary Images</h4>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Upload Primary Image (1024x1280 pixels)</label>
                        <input type="FILE" name="ProductImage" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
                        <div class="flex-c mb-2-pr">
                          <img src="" id="ImgPreview">
                        </div>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Upload Secondary Image (1024x1280 pixels)</label>
                        <input type="FILE" name="ProductImage2" id="uploadimage2" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
                        <div class="flex-c mb-2-pr">
                          <img src="" id="ImgPreview2">
                        </div>
                      </div>
                      <div class="form-group col-lg-4 col-md- 4col-ms-4 col-12">
                        <label>Upload Additional Image (1024x1280 pixels)</label>
                        <input type="FILE" name="ProImageName[]" multiple="" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <br>
                    <h4 class="app-sub-heading">Enter Product SEO Data</h4>
                  </div>

                  <div class="form-group col-md-12 m-t-10">
                    <label>Meta Title</label>
                    <input type="text" name="ProductMetaTitle" class="form-control-2">
                  </div>
                  <div class="form-group col-md-12 m-t-10">
                    <label>Meta Keywords</label>
                    <input type="text" name="ProductMetaKeywords" class="form-control-2">
                  </div>
                  <div class="form-group col-md-12 m-t-10">
                    <label>Meta Descriptions</label>
                    <textarea name="ProductMetaDescriptions" class="form-control-2" style="height:100% !important;" rows="3"></textarea>
                  </div>
                  <div class="col-md-12 m-t-20">
                    <button type="Submit" name="CreateProducts" class="btn btn-md app-btn">Save Products</button>
                    <a href="<?php echo DOMAIN; ?>/admin/products/" class="btn btn-md btn-danger">Cancel</a>
                    <br><br>
                  </div>
                </div>
            </div>
          </div>
          </form>
        </div>

        <!--End page content-->
      </div>

      <?php include '../../include/admin/sidebar.php'; ?>
    </div>
    <?php include '../../include/admin/footer.php'; ?>
  </div>
  <script>
    function EnableOfferAmount() {
      var offerstatus = document.getElementById("offerstatus");
      if (offerstatus.value == "Yes") {
        document.getElementById("enableofferinput").style.display = "block";
      } else {
        document.getElementById("enableofferinput").style.display = "none";
      }
    }
  </script>
  <script>
    uploadimage2.onchange = evt => {
      const [file] = uploadimage2.files
      if (file) {
        ImgPreview2.src = URL.createObjectURL(file);
      }
    }
  </script>
  <script>
    uploadimage.onchange = evt => {
      const [file] = uploadimage.files
      if (file) {
        ImgPreview.src = URL.createObjectURL(file);
      }
    }
  </script>
  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>