<?php
include 'header.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: admin_login.php");
    exit;
}

$conn_admin = connect_admin_db();
$error = '';
$success = '';
$product = null;

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn_admin->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $error = "Product not found.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    $stmt = $conn_admin->prepare("UPDATE products SET name = ?, price = ?, image = ?, category = ? WHERE id = ?");
    $stmt->bind_param("sdssi", $name, $price, $image, $category, $product_id);

    if ($stmt->execute()) {
        $success = "Product updated successfully!";
        // Re-fetch the product to show updated data
        $stmt_refetch = $conn_admin->prepare("SELECT * FROM products WHERE id = ?");
        $stmt_refetch->bind_param("i", $product_id);
        $stmt_refetch->execute();
        $result_refetch = $stmt_refetch->get_result();
        $product = $result_refetch->fetch_assoc();
        $stmt_refetch->close();
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn_admin->close();
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Edit Product</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">
                <a href="admin.php">Admin Panel /</a>
              </span>
              <span class="item">Edit Product</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="login-tabs padding-large">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <?php if($product): ?>
            <form method="post">
              <h2>Edit Product</h2>
              <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>
              <?php if($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
              <?php endif; ?>
              <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
              </div>
              <div class="form-group">
                <label for="image">Image Filename</label>
                <input type="text" name="image" class="form-control" value="<?php echo $product['image']; ?>" required>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo $product['category']; ?>" required>
              </div>
              <button type="submit" class="btn btn-dark">Update Product</button>
            </form>
            <?php else: ?>
              <div class="alert alert-danger">Product not found.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>
