<?php
include 'header.php';

$order_details = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn_customer = connect_customer_db();
    $order_id = $_POST['order-id'];

    $sql = "SELECT * FROM orders WHERE id = $order_id";
    $result = $conn_customer->query($sql);

    if ($result->num_rows > 0) {
        $order_details = $result->fetch_assoc();
        $sql = "SELECT p.name, oi.quantity, oi.size, oi.price FROM order_items oi JOIN ultras_admin.products p ON oi.product_id = p.id WHERE oi.order_id = $order_id";
        $items_result = $conn_customer->query($sql);
        $order_details['items'] = [];
        if ($items_result->num_rows > 0) {
            while($row = $items_result->fetch_assoc()) {
                $order_details['items'][] = $row;
            }
        }
    }
    $conn_customer->close();
}
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Order Tracking</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Order Tracking</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="order-tracking-form" class="padding-large">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form class="order-tracking-form" method="post">
                        <div class="form-group">
                            <label for="order-id">Order ID *</label>
                            <input type="text" id="order-id" name="order-id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Track Order</button>
                        </div>
                    </form>
                    <div id="order-details" class="mt-4">
                        <?php if ($order_details): ?>
                            <h3>Order Details</h3>
                            <p><strong>Order ID:</strong> <?php echo $order_details['id']; ?></p>
                            <p><strong>Name:</strong> <?php echo $order_details['fname'] . ' ' . $order_details['lname']; ?></p>
                            <p><strong>Address:</strong> <?php echo $order_details['address'] . ', ' . $order_details['city'] . ', ' . $order_details['zip']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $order_details['phone']; ?></p>
                            <p><strong>Email:</strong> <?php echo $order_details['email']; ?></p>
                            <p><strong>Total:</strong> $<?php echo $order_details['total']; ?></p>
                            <p><strong>Items:</strong></p>
                            <ul>
                                <?php foreach ($order_details['items'] as $item): ?>
                                    <li><?php echo $item['name'] . ' - ' . $item['size'] . ' - $' . $item['price']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                            <p>Order not found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
