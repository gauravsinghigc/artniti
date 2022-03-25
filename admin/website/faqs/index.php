<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "All FAQs";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
                <div class="col-md-12">
                  <div class="btn-group btn-group-sm">
                    <a href="<?php echo DOMAIN; ?>/admin/website/faqs/add.php" class="btn btn-sm btn-danger square">ADD FAQs</a>
                  </div>
                </div>
                <?php
                $FetchListings = FetchConvertIntoArray("SELECT * FROM faqs ORDER BY FaqsId ASC", true);
                if ($FetchListings != null) {
                  foreach ($FetchListings as $Fields) { ?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                      <div class="shadow-lg br10 p-1">
                        <a class="faqs-section" onclick="Databar('Faqs_<?php echo $Fields->FaqsId; ?>')">
                          <h3 class="faqs-title app-sub-heading"><?php echo SECURE($Fields->FAQsName, "d"); ?></h4>
                        </a>
                        <div class="p-1" id="Faqs_<?php echo $Fields->FaqsId; ?>" style="display:none;">
                          <?php echo SECURE($Fields->FAQSDescriptions, "d"); ?>
                        </div>
                        <div class="details p-1r">
                          <a href="edit.php?id=<?php echo SECURE($Fields->FaqsId, "e"); ?>" class="btn btn-default btn-md">Edit</a>

                        </div>
                      </div>
                    </div>
                <?php }
                }
                ?>
              </div>

            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../../include/admin/footer.php'; ?>
    </div>

    <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>