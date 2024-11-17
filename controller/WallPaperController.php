<?php
//require files
require '../require/modules.php';
require '../require/admin/sessionvariables.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
 die();
} else {
 $access_url = $_REQUEST['access_url'];
}

//start
if (isset($_POST['CreateWallPapers'])) {

 if ($_POST['WallPaperCategoryId'] == "NEW") {
  $WallPaperCategoryName = $_POST['WallPaperCategoryName'];
  $WallPaperCategoryCreatedAt = date("Y-m-d");
  $WallPaperCategoryUpdatedAt = date("Y-m-d");
  $WallPaperCategoryUpdatedBy = LOGIN_UserId;
  $SAVE = SAVE("wallpaper_category", ["WallPaperCategoryName", "WallPaperCategoryCreatedAt", "WallPaperCategoryUpdatedAt", "WallPaperCategoryUpdatedBy"]);
  $WallPaperCategoryId = FETCH("SELECT * FROM wallpaper_category order by WallPaperCategoryId  DESC limit 1", "WallPaperCategoryId");
 } else {
  $WallPaperCategoryId = $_POST['WallPaperCategoryId'];
 }

 if ($_POST['WallPaperBrandId'] == "NEW") {
  $WallPaperBrandName = $_POST['WallPaperBrandName'];
  $WallPaperBrandCreatedAt = date("Y-m-d");
  $WallPaperBrandUpdatedAt = date("Y-m-d");
  $WallPaperBrandUpdatedBy = LOGIN_UserId;
  $SAVE = SAVE("wallpaper_brands", ["WallPaperBrandName", "WallPaperBrandCreatedAt", "WallPaperBrandUpdatedAt", "WallPaperBrandUpdatedBy"]);
  $WallPaperBrandId = FETCH("SELECT * FROM wallpaper_brands ORDER by WallPaperBrandId  DESC limit 1", "WallPaperBrandId");
 } else {
  $WallPaperBrandId = $_POST['WallPaperBrandId'];
 }

 $data = array(
  "WallPaperName" => $_POST['WallPaperName'],
  "WallPaperCode" => $_POST['WallPaperCode'],
  "WallPaperCategoryId" => $WallPaperCategoryId,
  "WallPaperBrandId" => $WallPaperBrandId,
  "WallPaperStartPrice" => $_POST['WallPaperStartPrice'],
  "WallPaperDescriptions" => SECURE($_POST['WallPaperDescriptions'], "e"),
  "WallPaperCreatedAt" => Date("Y-m-d"),
  "WallPaperUpdatedAt" => date("Y-m-d"),
  "WallPaperStatus" => $_POST['WallPaperStatus'],
 );

 $Save = INSERT("wallpapers", $data, false);
 $WallPapersId = FETCH("SELECT * FROM wallpapers ORDER BY WallPapersId DESC limit 1", "WallPapersId");
 $WallPaperMainId = $WallPapersId;

 //save images
 //products images
 $total_count = count($_FILES['WallPaperImageFile']['name']);
 for ($i = 0; $i < $total_count; $i++) {
  $UploadDir = "../storage/wallpapers/pro-img/$WallPapersId/";
  $WallPaperImageFile = $_FILES['WallPaperImageFile']['name'][$i];
  $ProImageType = $_FILES['WallPaperImageFile']['type'][$i];
  $ProImageSize = $_FILES['WallPaperImageFile']['size'][$i];
  $ProImageTmpName = $_FILES['WallPaperImageFile']['tmp_name'][$i];
  $ProImageError = $_FILES['WallPaperImageFile']['error'][$i];
  $ProImageExt = pathinfo($WallPaperImageFile, PATHINFO_EXTENSION);

  $ProductName = $_POST['WallPaperName'];
  $ProductRefernceCode = $_POST['WallPaperCode'];
  $ProductName = str_replace(" ", "_", $ProductName);
  $WallPaperImageFile = $ProductName . "_" . $ProductRefernceCode . "_" . $i . date("d_m_Y_h_m_s_a_") . "." . $ProImageExt;
  $ProImagePath = $UploadDir . $WallPaperImageFile;
  $ProImageStatus = 1;

  if ($ProImageExt == 'jpg' || $ProImageExt == 'jpeg' || $ProImageExt == 'png' || $ProImageExt == 'gif') {
   if (!file_exists("$UploadDir/")) {
    mkdir("$UploadDir/", 0777, true);
   }
   move_uploaded_file($ProImageTmpName, $ProImagePath);
   $SaveImages = SAVE("wallpaper_images", ["WallPaperMainId", "WallPaperImageFile"]);
  } else {
   RESPONSE(false, "Product Image is not valid!", "Uploaded File is not Image");
   $SaveImages = false;
  }
 }
 RESPONSE($Save, "Wallpaper created successfully!", "Unable to create wallpapers at the moment!");

 //remove wallpapers
} elseif (isset($_GET['delete_wallpapers'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_wallpapers = SECURE($_GET['delete_wallpapers'], "d");

 if ($delete_wallpapers == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $DELETE = DELETE_FROM("wallpapers", "WallPapersId='$control_id'");
  if ($DELETE == true) {
   $Images = FetchConvertIntoArray("SELECT * FROM wallpaper_images where WallPaperMainId='$control_id'", true);
   if ($Images != null) {
    foreach ($Images as $Image) {
     unlink("../storage/wallpapers/pro-img/$control_id/" . $Image->WallPaperImageFile . "");
     DELETE_FROM("wallpaper_images", "WallPaperMainId='$control_id'");
    }
   }
  }
 } else {
  $DELETE = false;
 }
 RESPONSE($DELETE, "Wallpaper Remove Successfully!", "Unable to remove wallpapers!");

 //update wallpapers
} elseif (isset($_POST['UpdateWallPapers'])) {
 $WallPapersId = SECURE($_POST['UpdateWallPapers'], "d");

 if ($_POST['WallPaperCategoryId'] == "NEW") {
  $WallPaperCategoryName = $_POST['WallPaperCategoryName'];
  $WallPaperCategoryCreatedAt = date("Y-m-d");
  $WallPaperCategoryUpdatedAt = date("Y-m-d");
  $WallPaperCategoryUpdatedBy = LOGIN_UserId;
  $SAVE = SAVE("wallpaper_category", ["WallPaperCategoryName", "WallPaperCategoryCreatedAt", "WallPaperCategoryUpdatedAt", "WallPaperCategoryUpdatedBy"]);
  $WallPaperCategoryId = FETCH("SELECT * FROM wallpaper_category order by WallPaperCategoryId  DESC limit 1", "WallPaperCategoryId");
 } else {
  $WallPaperCategoryId = $_POST['WallPaperCategoryId'];
 }

 if ($_POST['WallPaperBrandId'] == "NEW") {
  $WallPaperBrandName = $_POST['WallPaperBrandName'];
  $WallPaperBrandCreatedAt = date("Y-m-d");
  $WallPaperBrandUpdatedAt = date("Y-m-d");
  $WallPaperBrandUpdatedBy = LOGIN_UserId;
  $SAVE = SAVE("wallpaper_brands", ["WallPaperBrandName", "WallPaperBrandCreatedAt", "WallPaperBrandUpdatedAt", "WallPaperBrandUpdatedBy"]);
  $WallPaperBrandId = FETCH("SELECT * FROM wallpaper_brands ORDER by WallPaperBrandId  DESC limit 1", "WallPaperBrandId");
 } else {
  $WallPaperBrandId = $_POST['WallPaperBrandId'];
 }

 $data = array(
  "WallPaperName" => $_POST['WallPaperName'],
  "WallPaperCode" => $_POST['WallPaperCode'],
  "WallPaperCategoryId" => $WallPaperCategoryId,
  "WallPaperBrandId" => $WallPaperBrandId,
  "WallPaperStartPrice" => $_POST['WallPaperStartPrice'],
  "WallPaperDescriptions" => SECURE($_POST['WallPaperDescriptions'], "e"),
  "WallPaperCreatedAt" => Date("Y-m-d"),
  "WallPaperUpdatedAt" => date("Y-m-d"),
  "WallPaperStatus" => $_POST['WallPaperStatus'],
 );

 $Update = UPDATE_DATA("wallpapers", $data, "WallPapersId='$WallPapersId'");
 RESPONSE($Update, "WallPaper Details Updated successfully!", "Unable to update wallpaper details at the moment!");

 //delete wallpapers images
} elseif (isset($_GET['delete_wallpaper_images'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_wallpaper_images = SECURE($_GET['delete_wallpaper_images'], "d");

 if ($delete_wallpaper_images == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Images = FetchConvertIntoArray("SELECT * FROM wallpaper_images where WallPaperImagesId='$control_id'", true);
  if ($Images != null) {
   foreach ($Images as $Image) {
    unlink("../storage/wallpapers/pro-img/$control_id/" . $Image->WallPaperImageFile . "");
    $Response = DELETE_FROM("wallpaper_images", "WallPaperImagesId='$control_id'");
   }
  } else {
   $Response = false;
  }

  RESPONSE($Response, "Wallpaper images deleted successfully!", "Unable to delete wallpaper images at the momemt!");
 }

 //upload more images
} elseif (isset($_POST['UploadImages'])) {
 $WallPapersId = $_POST['UploadImages'];
 $WallPaperMainId = $WallPapersId;

 $total_count = count($_FILES['WallPaperImageFile']['name']);
 for ($i = 0; $i < $total_count; $i++) {
  $UploadDir = "../storage/wallpapers/pro-img/$WallPapersId/";
  $WallPaperImageFile = $_FILES['WallPaperImageFile']['name'][$i];
  $ProImageType = $_FILES['WallPaperImageFile']['type'][$i];
  $ProImageSize = $_FILES['WallPaperImageFile']['size'][$i];
  $ProImageTmpName = $_FILES['WallPaperImageFile']['tmp_name'][$i];
  $ProImageError = $_FILES['WallPaperImageFile']['error'][$i];
  $ProImageExt = pathinfo($WallPaperImageFile, PATHINFO_EXTENSION);


  $ProductName = FETCH("SELECT * FROM wallpapers where WallPapersId='$WallPapersId'", "WallPaperName");
  $ProductRefernceCode = FETCH("SELECT * FROM wallpapers where WallPapersId='$WallPapersId'", "WallPaperCode");
  $ProductName = str_replace(" ", "_", $ProductName);
  $WallPaperImageFile = $ProductName . "_" . $ProductRefernceCode . "_" . $i . date("d_m_Y_h_m_s_a_") . "." . $ProImageExt;
  $ProImagePath = $UploadDir . $WallPaperImageFile;
  $ProImageStatus = 1;

  if ($ProImageExt == 'jpg' || $ProImageExt == 'jpeg' || $ProImageExt == 'png' || $ProImageExt == 'gif') {
   if (!file_exists("$UploadDir/")) {
    mkdir("$UploadDir/", 0777, true);
   }
   move_uploaded_file($ProImageTmpName, $ProImagePath);
   $SaveImages = SAVE("wallpaper_images", ["WallPaperMainId", "WallPaperImageFile"]);
  } else {
   RESPONSE(false, "Product Image is not valid!", "Uploaded File is not Image");
   $SaveImages = false;
  }
 }
 RESPONSE($Save, "Wallpaper Image Uploaded successfully!", "Unable to upload wallpapers images at the moment!");


 //update standard roll details
} else if (isset($_POST['UpdateStandardOptionDetails'])) {
 $WallPaperCustomOptionId = $_POST['UpdateStandardOptionDetails'];

 $data = array(
  "WallPaperCustomOptionName" => $_POST['WallPaperCustomOptionName'],
  "WallPaperCustomOptionPrice" => $_POST['WallPaperCustomOptionPrice'],
  "WallPaperCustomOptionSize" => $_POST['WallPaperCustomOptionSize'],
  "WallPaperCustomOptionDesc" => SECURE($_POST['WallPaperCustomOptionDesc'], "e"),
 );

 $Update = UPDATE_DATA("wallpaper_customise_options", $data, "WallPaperCustomOptionId='$WallPaperCustomOptionId'");
 RESPONSE($Update, "Standard Roll details are updated!", "Unable to update Standard Roll Details!");

 //update custom roll size option
} else if (isset($_POST['UpdateCustomOptionDetails'])) {
 $WallPaperCustomOptionId = $_POST['UpdateCustomOptionDetails'];

 $data = array(
  "WallPaperCustomOptionName" => $_POST['WallPaperCustomOptionName'],
  "WallPaperCustomOptionPrice" => $_POST['WallPaperCustomOptionPrice'],
  "WallPaperCustomOptionSize" => $_POST['WallPaperCustomOptionSize'],
  "WallPaperCustomOptionDesc" => SECURE($_POST['WallPaperCustomOptionDesc'], "e"),
 );


 if ($_POST['RESIZING_FEE']) {
  $checkResize = CHECK("SELECT * FROM configurations where configurationname='RESIZING_FEE'");
  if ($checkResize == true) {
   $RESIZING_FEE = $_POST['RESIZING_FEE'];
   $Update = UPDATE("UPDATE configurations SET configurationvalue='$RESIZING_FEE' where configurationname='RESIZING_FEE'");
  } else {
   $configurationname = 'RESIZING_FEE';
   $configurationvalue = $_POST['RESIZING_FEE'];
   $Save = SAVE("configurations", ["configurationname", "configurationvalue"]);
  }
 }

 $Update = UPDATE_DATA("wallpaper_customise_options", $data, "WallPaperCustomOptionId='$WallPaperCustomOptionId'");
 RESPONSE($Update, "Custom Roll details are updated!", "Unable to update Custom Roll Details!");


 //update sample roll size option
} else if (isset($_POST['UpdateSampleOptionDetails'])) {
 $WallPaperCustomOptionId = $_POST['UpdateSampleOptionDetails'];

 $data = array(
  "WallPaperCustomOptionName" => $_POST['WallPaperCustomOptionName'],
  "WallPaperCustomOptionPrice" => $_POST['WallPaperCustomOptionPrice'],
  "WallPaperCustomOptionSize" => $_POST['WallPaperCustomOptionSize'],
  "WallPaperCustomOptionDesc" => SECURE($_POST['WallPaperCustomOptionDesc'], "e"),
 );

 $Update = UPDATE_DATA("wallpaper_customise_options", $data, "WallPaperCustomOptionId='$WallPaperCustomOptionId'");
 RESPONSE($Update, "Sample Roll details are updated!", "Unable to update Sample Roll Details!");

 //create wallpaper options
} elseif (isset($_POST['UploadPaperOptions'])) {

 $data = array(
  "WallPaperPaperName" => $_POST['WallPaperPaperName'],
  "WallPaperPaperPrice" => $_POST['WallPaperPaperPrice'],
  "WallPaperImage" => UPLOAD_FILES("../storage/wallpapers/paper-options", null, $_POST['WallPaperPaperName'], $_POST['WallPaperPaperPrice'], "WallPaperImage"),
 );

 $Save = INSERT("wallpaper_paper_options", $data, false);
 RESPONSE($Save, "Wallpaper Paper options are saved!", "Unable to save Paper Options!");

 //remove wallpapers paper options
} elseif (isset($_GET['delete_paper_options'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_paper_options = SECURE($_GET['delete_paper_options'], "d");

 if ($delete_paper_options == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Delete = DELETE_FROM("wallpaper_paper_options", "WallPaperOptionId='$control_id'");
 } else {
  $Delete = false;
 }
 RESPONSE($Delete, "WallPaper Option is Removed successfully!", "Unable to remove wallpapers paper options!");

 //update wall paper option
} elseif (isset($_POST['UpdateWallPaperPaperOptions'])) {
 $WallPaperOptionId = $_POST['UpdateWallPaperPaperOptions'];
 if ($_FILES['WallPaperImage']['name'] ==  null || $_FILES['WallPaperImage']['name'] == "null" || $_FILES['WallPaperImage']['name'] == " " || $_FILES['WallPaperImage']['name'] == "") {
  $WallPaperImage = SECURE($_POST['CurrentFile'], "d");
 } else {
  $WallPaperImage = UPLOAD_FILES("../storage/wallpapers/paper-options", null, $_POST['WallPaperPaperName'], $_POST['WallPaperPaperPrice'], "WallPaperImage");
 }
 $data = array(
  "WallPaperPaperName" => $_POST['WallPaperPaperName'],
  "WallPaperPaperPrice" => $_POST['WallPaperPaperPrice'],
  "WallPaperImage" => $WallPaperImage,
 );

 $Save = UPDATE_DATA("wallpaper_paper_options", $data, "WallPaperOptionId='$WallPaperOptionId'", false);
 RESPONSE($Save, "Wall Paper Paper Option is Update successfully!", "Unable to update wallpapers paper option at the moment!");

 //save faqs
} elseif (isset($_POST['CreateFaqs'])) {

 $data = array(
  "WallPaperFaqQuestions" => $_POST['WallPaperFaqQuestions'],
  "WallPaperFaqAnswer" => $_POST['WallPaperFaqAnswer'],
  "WallPaperFaqQuestonCreatedAt" => date("Y-m-d"),
  "WallPaperFaqUpdatedAt" => date("Y-m-d"),
 );

 $save = INSERT("wallpaper_faqs", $data);
 RESPONSE($save, "FAQs <b>" . $_POST['WallPaperFaqQuestions'] . "</b> are saved successfully!", "Unable to save FAQs!");

 //remove wallpapers faqs
} elseif (isset($_GET['remove_faq_record'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $remove_faq_record = SECURE($_GET['remove_faq_record'], "d");

 if ($remove_faq_record == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Delete = DELETE_FROM("wallpaper_faqs", "WallPaperFaqsId='$control_id'");
 } else {
  $Delete = false;
 }
 RESPONSE($Delete, "FAQ is removed successfully!", "Unable to remove wallpapers faqs!");

 //update wallpapers faqs
} elseif (isset($_POST['UpdateFaqs'])) {
 $WallPaperFaqsId = $_POST['WallPaperFaqsId'];

 $data = array(
  "WallPaperFaqQuestions" => $_POST['WallPaperFaqQuestions'],
  "WallPaperFaqAnswer" => $_POST['WallPaperFaqAnswer'],
  "WallPaperFaqUpdatedAt" => date("Y-m-d"),
 );

 $save = UPDATE_DATA("wallpaper_faqs", $data, "WallPaperFaqsId='$WallPaperFaqsId'", false);
 RESPONSE($save, "FAQs <b>" . $_POST['WallPaperFaqQuestions'] . "</b> are Updated successfully!", "Unable to Update FAQs!");
}
