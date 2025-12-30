<?php
include 'header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$conn_customer = connect_customer_db();
$customer_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "SELECT p.price, c.quantity, c.size, c.product_id FROM carts c JOIN ultras_admin.products p ON c.product_id = p.id WHERE c.customer_id = $customer_id";
    $result = $conn_customer->query($sql);
    $total = 0;
    $items = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $total += $row['price'] * $row['quantity'];
            $items[] = $row;
        }
    }

    $sql = "INSERT INTO orders (customer_id, fname, lname, address, city, zip, phone, email, total) VALUES ('$customer_id', '$fname', '$lname', '$address', '$city', '$zip', '$phone', '$email', '$total')";
    if ($conn_customer->query($sql) === TRUE) {
        $order_id = $conn_customer->insert_id;
        foreach ($items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $size = $item['size'];
            $price = $item['price'];
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, size, price) VALUES ('$order_id', '$product_id', '$quantity', '$size', '$price')";
            $conn_customer->query($sql);
        }
        $sql = "DELETE FROM carts WHERE customer_id = $customer_id";
        $conn_customer->query($sql);
        echo "<script>alert('Order placed successfully!'); window.location.href = 'thank-you.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "\\n" . $conn_customer->error . "');</script>";
    }
}

$sql = "SELECT p.name, p.price, c.quantity FROM carts c JOIN ultras_admin.products p ON c.product_id = p.id WHERE c.customer_id = $customer_id";
$result = $conn_customer->query($sql);
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Checkout</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Checkout</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="checkout" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="checkout-form">
              <h3>Billing details</h3>
              <form method="post">
                <div class="form-group">
                  <label for="fname">First name *</label>
                  <input type="text" id="fname" name="fname" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="lname">Last name *</label>
                  <input type="text" id="lname" name="lname" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="address">Address *</label>
                  <input type="text" id="address" name="address" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="city">Town / City *</label>
                  <input type="text" id="city" name="city" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="zip">Postcode / ZIP *</label>
                  <input type="text" id="zip" name="zip" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone *</label>
                  <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">Email address *</label>
                  <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-dark">Place order</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="order-summary">
              <h3>Your order</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody id="order-items">
                  <?php
                    $subtotal = 0;
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        $item_total = $row["price"] * $row["quantity"];
                        $subtotal += $item_total;
                        echo '<tr>';
                        echo '<td>' . $row["name"] . ' x ' . $row["quantity"] . '</td>';
                        echo '<td>₹' . number_format($item_total, 2) . '</td>';
                        echo '</tr>';
                      }
                    }
                  ?>
                  <tr>
                    <td><strong>Subtotal</strong></td>
                    <td><strong>₹<?php echo number_format($subtotal, 2); ?></strong></td>
                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>₹<?php echo number_format($subtotal, 2); ?></strong></td>
                  </tr>
                </tbody>
              </table>

              <div class="payment-method">
                <h3>Payment method</h3>


                <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" checked>
                  <label class="form-check-label" for="cod">
                    Cash on delivery
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>
