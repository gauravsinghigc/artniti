<section class="fixed-bottom pb-2">
  <div class="row">
    <div class="col-md-12">
      <div class="app-menus flex-s-a">
        <a href="home.php" id='home'><i class="fa fa-home"></i>Home</a>
        <a href="shop.php" id='shop'><i class="fa fa-table"></i>Shop</a>
        <a href="orders.php" id='orders'><i class='fa fa-truck'></i>Orders</a>
        <a href="account.php" id='account'><i class='fa fa-user'></i>Accounts</a>
      </div>
    </div>
  </div>
</section>

<?php if (isset($_GET['continue'])) { ?>
  <section class="fixed-bottom cart-order">
    <div class="row">
      <div class="col-md-12 bg-white">
        <div class="flex-s-b p-2 pt-1">
          <div class="w-50 text-left">
            <small class="text-secondary text-left small"><small> Cart Total:</small></small><br>
            <h4 class="bold mb-0">Rs.349</h4>
          </div>
          <div class="w-50 text-right pt-1 mt-1">
            <a href="cart.php" class="btn btn-md btn-success text-white">Continue <i class='fa fa-angle-right btn btn-sm text-white'></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>