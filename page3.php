<?php 
include_once('header.php');

if(!empty($_POST)) {
  $_SESSION['interests'] = $_POST['interests'];
}
?>

<section id="form">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form-container">
          <h3 class="heading">Step 3</h3>
          <form action="page4.php" method="POST">
            <?php
            text('address', 'address', 'Address', 'Enter your address');
            text('city', 'city', 'City', 'Enter your city');
            text('state', 'state', 'Province', 'Enter your province');
            submit('Go To Step 4 &raquo;');
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('footer.php'); ?>