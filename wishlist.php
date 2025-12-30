<<?php
include 'header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$conn_customer = connect_customer_db();
$customer_id = $_SESSION['id'];

$stmt = $conn_customer->prepare("SELECT p.id, p.name, p.price, p.image FROM wishlists w JOIN ultras_admin.products p ON w.product_id = p.id WHERE w.customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Wishlist</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Wishlist</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="wishlist" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                </tr>
              </thead>
              <tbody id="wishlist-items">
                <?php
                // Handle Add to Cart
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    $conn_customer = connect_customer_db();
                    $customer_id = $_SESSION['id'];
                    $product_id = $_POST['product_id'];
                    $size = isset($_POST['size']) ? $_POST['size'] : 'M';
                    $stmt = $conn_customer->prepare("INSERT INTO carts (customer_id, product_id, quantity, size) VALUES (?, ?, 1, ?)");
                    $stmt->bind_param("iis", $customer_id, $product_id, $size);
                    if ($stmt->execute()) {
                      echo "<script>alert('Product added to cart successfully!');</script>";
                    } else {
                      echo "<script>alert('Error: " . $stmt->error . "');</script>";
                    }
                    $stmt->close();
                    $conn_customer->close();
                  } else {
                    echo "<script>alert('Please login to add items to your cart.'); window.location.href = 'login.php';</script>";
                  }
                }

                // Handle Remove from Wishlist
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_wishlist'])) {
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    $conn_customer = connect_customer_db();
                    $customer_id = $_SESSION['id'];
                    $product_id = $_POST['product_id'];
                    $stmt = $conn_customer->prepare("DELETE FROM wishlists WHERE customer_id = ? AND product_id = ?");
                    $stmt->bind_param("ii", $customer_id, $product_id);
                    if ($stmt->execute()) {
                      echo "<script>alert('Product removed from wishlist!'); window.location.href = 'wishlist.php';</script>";
                      exit;
                    } else {
                      echo "<script>alert('Error: " . $stmt->error . "');</script>";
                    }
                    $stmt->close();
                    $conn_customer->close();
                  } else {
                    echo "<script>alert('Please login to remove items from your wishlist.'); window.location.href = 'login.php';</script>";
                  }
                }

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>';
                    echo '<div class="d-flex align-items-center">';
                    echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '" style="width: 50px; height: 50px; margin-right: 10px;">';
                    // Remove button
                    echo '<form method="POST" style="display:inline; margin-right:10px;">';
                    echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" name="remove_wishlist" class="btn btn-danger btn-sm" style="margin-right:5px;">Remove</button>';
                    echo '</form>';
                    echo '<a href="#">' . $row["name"] . '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>₹ ' . $row["price"] . '</td>';
                    echo '<td>';
                    echo '<form method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                    // Optionally add size selection if needed
                    // echo '<select name="size"><option value="M">M</option><option value="L">L</option></select>';
                    echo '<button type="submit" name="add_to_cart" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i></button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                  }
                } else {
                  echo "<tr><td colspan='3'>Your wishlist is empty</td></tr>";
                }
                $conn_customer->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>

