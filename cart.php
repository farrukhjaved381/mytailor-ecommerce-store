<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/inc/header/homepage-headscripts.php");
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/inc/header/homepage-navbar.php");
?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
      </div>
      <div class="table-responsive mt-2">
        <table class="table table-bordered table-striped text-center">
          <thead>
            <tr>
              <td colspan="7">
                <h4 class="text-center text-info m-0">Products in your cart!</h4>
              </td>
            </tr>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Product</th>
              <th>Price</th>
              <th>Stiched With us</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>
                <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
              require 'db_conn.php';
              $stmt = $conn->prepare('SELECT * FROM tbl_cart');
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;
              while ($row = $result->fetch_assoc()):
            ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <input type="hidden" class="pid" value="<?= $row['id'] ?>">
              <td><img src="<?= $row['product_image'] ?>" width="50"></td>
              <td><?= $row['product_name'] ?></td>
              <td>
                Rs.&nbsp;<span class="price"><?= number_format($row['product_price'],2); ?></span>
              </td>
              <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
              <td>
                <input type="checkbox" class="is_stiched" data-id="<?= $row['id'] ?>" <?= $row['is_stiched'] ? 'checked' : '' ?>>
              </td>
              <td>
                <input type="number" class="itemQty" min="1" value="<?= $row['quantity'] ?>" data-id="<?= $row['id'] ?>">
              </td>
              <td>Rs.&nbsp;<span id="total_price_<?php echo $row['id']; ?>" class="total_price"><?= number_format($row['total_price'],2); ?></span></td>
              <td>
                <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
            <?php $grand_total += $row['total_price']; ?>
            <?php endwhile; ?>
            <tr>
              <td colspan="3">
                <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                  Shopping</a>
              </td>
              <td colspan="2"><b>Grand Total</b></td>
              <td><b>Rs.&nbsp;<span id="grand_total"><?= number_format($grand_total,2); ?></span></b></td>
              <td>
                <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {
  $('.is_stiched').change(function() {
    var checkboxValue = $(this).is(':checked') ? 1 : 0;
    var id = $(this).data('id');
    var $el = $(this).closest('tr');
    var priceElement = $el.find('.price');
    var totalPriceElement = $el.find('.total_price');

    $.ajax({
      url: 'helper.php',
      type: 'POST',
      data: { checkbox_value: checkboxValue, id: id },
      success: function(response) {
        var data = JSON.parse(response);
        console.log(data);
        priceElement.text(data.new_price.toFixed(2));
        totalPriceElement.text(data.new_total_price.toFixed(2));
        $('#grand_total').text(data.grand_total.toFixed(2));
      }
    });
  });

  $('.itemQty').change(function() {
    var quantity = $(this).val();
    var id = $(this).data('id');
    var $el = $(this).closest('tr');
    var priceElement = $el.find('.price');
    var totalPriceElement = $el.find('.total_price');

    $.ajax({
      url: 'helper.php',
      type: 'POST',
      data: { quantity: quantity, id: id },
      success: function(response) {
        var data = JSON.parse(response);
        totalPriceElement.text(data.new_total_price.toFixed(2));
        $('#grand_total').text(data.grand_total.toFixed(2));
        $('#total_price_'+id).text(data.new_total_price.toFixed(2));
        
      }
    });
  });

  // Load total no.of items added in the cart and display in the navbar
  load_cart_item_number();

  function load_cart_item_number() {
    $.ajax({
      url: 'action.php',
      method: 'get',
      data: {
        cartItem: "cart_item"
      },
      success: function(response) {
        $("#cart-item").html(response);
      }
    });
  }
});
</script>
<?php
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/inc/footer/homepage-footer-section.php");
