<?php

//require files
require '../require/modules.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
 die();
} else {
 $access_url = $_REQUEST['access_url'];
}


//save new exhibitions 
if (isset($_POST['CreateExhibitions'])) {
 $ExhibitionsName = $_POST['ExhibitionsName'];
 $ExhibitionsCategory = $_POST['ExhibitionsCategory'];
 $ExhibitionsDescriptions = POST("ExhibitionsDescriptions");
 $ExhibitionsFeatureImage = UPLOAD_FILES("../storage/exhibitions", "ExhibitionsFeatureImage", "$ExhibitionsName", "$ExhibitionsCategory", "ExhibitionsFeatureImage");
 $ExhibitionsStatus = $_POST['ExhibitionsStatus'];
 $ExhibitionsCreatedAt = date("d M, Y");
 $ExhibitionDate = $_POST['ExhibitionDate'];

 $save = SAVE("exhibitions", ["ExhibitionsName", "ExhibitionsCategory", "ExhibitionsDescriptions", "ExhibitionsFeatureImage", "ExhibitionsStatus", "ExhibitionsCreatedAt", "ExhibitionDate"]);
 RESPONSE($save, "Exhibitions " . $ExhibitionsName . "is created successfully!", "unable to save exhibitions!");

 //delete exhibitions records
} elseif (isset($_GET['delete_exhibitions_records'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_exhibitions_records = SECURE($_GET['delete_exhibitions_records'], "d");

 if ($delete_exhibitions_records == true) {
  $ExhibitionsId = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("exhibitions", "ExhibitionsId='$ExhibitionsId'");
  RESPONSE($delete, "Exhibitions is deleted successfully!", "Unable to delete exhibitions!");
 } else {
  RESPONSE(false, "Exhibitions delete query is completed", "Unable to delete exhibitions at the moment!");
 }

 //update exhibitions records
} elseif (isset($_POST['UpdateExhitions'])) {
 $ExhibitionsId = SECURE($_POST['UpdateExhitions'], "d");
 $ExhibitionsName = $_POST['ExhibitionsName'];
 $ExhibitionsCategory = $_POST['ExhibitionsCategory'];
 $ExhibitionsDescriptions = POST("ExhibitionsDescriptions");
 $ExhibitionsStatus = $_POST['ExhibitionsStatus'];
 $ExhibtionsUpdatedAt = date("d M, Y");
 $ExhibitionDate = $_POST['ExhibitionDate'];

 if ($_FILES['ExhibitionsFeatureImage']['name'] == "null" || $_FILES['ExhibitionsFeatureImage']['name'] == "" || $_FILES['ExhibitionsFeatureImage']['name'] == null || $_FILES['ExhibitionsFeatureImage']['name'] == "undefined") {
  $update = UPDATE_TABLE("exhibitions", ["ExhibitionsName", "ExhibitionsCategory", "ExhibitionsDescriptions", "ExhibitionsStatus", "ExhibtionsUpdatedAt", "ExhibitionDate"], "ExhibitionsId='$ExhibitionsId'");
 } else {
  $ExhibitionsFeatureImage = UPLOAD_FILES("../storage/exhibitions", "ExhibitionsFeatureImage", "$ExhibitionsName", "$ExhibitionsCategory", "ExhibitionsFeatureImage");
  $update = UPDATE_TABLE("exhibitions", ["ExhibitionsName", "ExhibitionsCategory", "ExhibitionsDescriptions", "ExhibitionsFeatureImage", "ExhibitionsStatus", "ExhibtionsUpdatedAt", "ExhibitionDate"], "ExhibitionsId='$ExhibitionsId'");
 }

 RESPONSE($update, "Exhibitions " . $ExhibitionsName . "is updated successfully!", "unable to update exhibitions!");
}
