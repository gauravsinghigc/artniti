<div class="col-lg-3 col-md-3 col-sm-12 col-12 product-men women_two">
 <div class="product-googles-info googles">
  <div class="men-pro-item">
   <div class="men-thumb-item">
    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class=" img-fluid" alt="">
    <div class="men-cart-pro">
     <div class="inner-men-cart-pro">
      <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>" class="link-product-add-cart">View Details</a>
     </div>
    </div>
    <span class="product-new-top">New</span>
   </div>
   <div class="item-info-product">
    <div class="info-product-price">
     <div class="grid_meta">
      <div class="product_price">
       <h4 class="mt-2">
        <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>"><?php echo $ProductName; ?></a><br>
        <span class="category-name"><?php echo $ProCategoryName; ?></span>
       </h4>
       <div class="grid-price mt-2">
        <span class="money"><?php echo Price($ProductSellPrice); ?></span>
       </div>
      </div>
      <ul class="stars">
       <li>
        <a href="#">
         <i class="fa fa-star" aria-hidden="true"></i>
        </a>
       </li>
       <li>
        <a href="#">
         <i class="fa fa-star" aria-hidden="true"></i>
        </a>
       </li>
       <li>
        <a href="#">
         <i class="fa fa-star" aria-hidden="true"></i>
        </a>
       </li>
       <li>
        <a href="#">
         <i class="fa fa-star" aria-hidden="true"></i>
        </a>
       </li>
       <li>
        <a href="#">
         <i class="fa fa-star-half-o" aria-hidden="true"></i>
        </a>
       </li>
      </ul>
     </div>
     <div class="googles single-item hvr-outline-out">
      <form action="#" method="post">
       <input type="hidden" name="cmd" value="_cart">
       <input type="hidden" name="add" value="1">
       <input type="hidden" name="googles_item" value="Farenheit">
       <input type="hidden" name="amount" value="575.00">
       <button type="submit" class="googles-cart pgoogles-cart">
        <i class="fas fa-cart-plus"></i>
       </button>
      </form>
     </div>
    </div>
    <div class="clearfix"></div>
   </div>
  </div>
 </div>
</div>