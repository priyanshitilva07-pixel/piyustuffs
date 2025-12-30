<?php
include 'header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$conn_customer = connect_customer_db();
$customer_id = $_SESSION['id'];

$stmt = $conn_customer->prepare("SELECT p.name, p.price, p.image, c.quantity, c.size, c.id as cart_id FROM carts c JOIN ultras_admin.products p ON c.product_id = p.id WHERE c.customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_item'])) {
    $cart_id = $_POST['cart_id'];
    $stmt_delete = $conn_customer->prepare("DELETE FROM carts WHERE id = ? AND customer_id = ?");
    $stmt_delete->bind_param("ii", $cart_id, $customer_id);
    if ($stmt_delete->execute()) {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            exit();
        }
        header("location: cart.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn_customer->error;
    }
    $stmt_delete->close();
}
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Cart</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Cart</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="cart" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody id="cart-items">
                <?php
                  $subtotal = 0;
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $item_total = $row["price"] * $row["quantity"];
                      $subtotal += $item_total;
                      echo '<tr>';
                      echo '<td>';
                      echo '<div class="d-flex align-items-center">';
                      echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '" style="width: 50px; height: 50px; margin-right: 10px;">';
                      echo '<div style="min-width: 150px;"><a href="#">' . $row["name"] . ' (' . $row["size"] . ')</a></div>';
                      echo '</div>';
                      echo '</td>';
                      echo '<td>₹' . $row["price"] . '</td>';
                      echo '<td><input type="number" class="form-control quantity-input" value="' . $row["quantity"] . '" min="1" data-price="' . $row["price"] . '"></td>';
                      echo '<td class="item-total">₹' . number_format($item_total, 2) . '</td>';
                      echo '<td><form method="post"><input type="hidden" name="cart_id" value="' . $row["cart_id"] . '"><button type="submit" name="remove_item" class="btn btn-danger">Remove</button></form></td>';
                      echo '</tr>';
                    }
                  } else {
                    echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="cart-totals">
              <h3>Cart totals</h3>
              <table class="table">
                <tbody>
                  <tr>
                    <td>Subtotal</td>
                    <td id="subtotal">₹<?php echo number_format($subtotal, 2); ?></td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td id="total">₹<?php echo number_format($subtotal, 2); ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="checkout.php" class="btn btn-dark">Proceed to checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>
