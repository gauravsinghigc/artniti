<div class="col-lg-3 col-ms-3 col-sm-4 col-6 col-xs-6">
 <a href="<?php echo DOMAIN; ?>/web/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>">
  <div class="category-box">
   <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $Data->ProCategoryImage; ?>" class="category-img lazyload">
   <h4><?php echo $Data->ProCategoryName;  ?></h4>
  </div>
 </a>
</div>