<?php
include 'header.php';

$product = null;
if (isset($_GET['id'])) {
    $conn_admin = connect_admin_db();
    $product_id = $_GET['id'];
    
    $stmt = $conn_admin->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    $conn_admin->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $conn_customer = connect_customer_db();
        $customer_id = $_SESSION['id'];
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];

        if (isset($_POST['add_to_cart']) || isset($_POST['buy_now'])) {
            $stmt = $conn_customer->prepare("INSERT INTO carts (customer_id, product_id, quantity, size) VALUES (?, ?, 1, ?)");
            $stmt->bind_param("iis", $customer_id, $product_id, $size);

            if ($stmt->execute()) {
                if (isset($_POST['buy_now'])) {
                    header("location: checkout.php");
                } else {
                    echo "<script>alert('Product added to cart!');</script>";
                }
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } elseif (isset($_POST['add_to_wishlist'])) {
            $stmt = $conn_customer->prepare("INSERT INTO wishlists (customer_id, product_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $customer_id, $product_id);
            if ($stmt->execute()) {
                echo "<script>alert('Product added to wishlist!');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        }
        $conn_customer->close();
    } else {
        echo "<script>alert('Please login to perform this action.'); window.location.href = 'login.php';</script>";
    }
}
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Single Product</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Single Product</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="single-product" class="padding-large">
      <div class="container">
        <?php if ($product): ?>
        <div class="row">
          <div class="col-md-6">
            <div class="image-holder">
              <img src="images/<?php echo $product['image']; ?>" alt="Product Image" class="product-image">
            </div>
          </div>
          <div class="col-md-6">
            <div class="product-detail">
              <h2 class="product-title"><?php echo $product['name']; ?></h2>
              <p class="product-price">$<?php echo $product['price']; ?></p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac.</p>
              <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="form-group">
                  <label for="size">Size</label>
                  <div class="input-group">
                    <select class="form-select" name="size" aria-label="Default select example">
                      <option selected>Select Size</option>
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="XXL">XXL</option>
                    </select>
                    <button type="submit" name="add_to_wishlist" class="btn btn-dark"><i class="icon icon-heart"></i></button>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 1rem;">
                  <button type="submit" name="add_to_cart" class="btn btn-dark" style="margin-right: 10px;">Add to Cart</button>
                  <button type="submit" name="buy_now" class="btn btn-primary">Buy Now</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <p>Product not found.</p>
            </div>
        </div>
        <?php endif; ?>
      </div>
    </section>

<?php include 'footer.php'; ?>
