<?php
include 'header.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: admin_login.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn_admin = connect_admin_db();
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    $stmt = $conn_admin->prepare("INSERT INTO products (name, price, image, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $image, $category);

    if ($stmt->execute()) {
        $success = "Product added successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn_admin->close();
}
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Add Product</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">
                <a href="admin.php">Admin Panel /</a>
              </span>
              <span class="item">Add Product</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="login-tabs padding-large">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form method="post">
              <h2>Add New Product</h2>
              <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>
              <?php if($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
              <?php endif; ?>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="image">Image Filename</label>
                <input type="text" name="image" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-dark">Add Product</button>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>
