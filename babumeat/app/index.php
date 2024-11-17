<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo APP_NAME; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo DOMAIN; ?>/assets/app/css/app.css">
</head>

<body>
  <section class="container">
    <div class="row">
      <div class="col-md-12 mt-2">
        <img src="<?php echo APP_LOGO; ?>" class="w-50 img-bdr">
      </div>
      <div class="col-md-12 mt-5">
        <h4>Enter your Phone Number</h4>
      </div>
      <div class="col-md-12">
        <form action='otp.php'>
          <div>
            <span>+91</span>
            <input type='tel' name='phone' class="form-control form-control-lg app-form-control" placeholder="000000000">
          </div>
          <div class="fixed-bottom mb-3 bg-white">
            <p><i class='fa fa-check text-success'></i> By continue this you agrees our <a href=''>Privacy Policy</a> and <a href="">Terms and conditions</a></p>
            <button class="btn btn-sm app-btn mb-3">Continue <i class="fa fa-angle-right"></i></button><br>
            <a href="home.php" class="bold h6 mt-3">Skip & Browse App</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>