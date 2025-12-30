<?php
include 'header.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: admin_login.php");
    exit;
}

$conn_admin = connect_admin_db();
$sql = "SELECT * FROM products";
$result = $conn_admin->query($sql);
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Admin Panel</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Admin Panel</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="admin-panel" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Products</h2>
            <a href="add_product.php" class="btn btn-dark">Add New Product</a>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Image</th>
                  <th scope="col">Category</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo '<tr>';
                      echo '<td>' . $row["id"] . '</td>';
                      echo '<td>' . $row["name"] . '</td>';
                      echo '<td>₹' . $row["price"] * 1  . '</td>';
                      echo '<td><img src="images/' . $row["image"] . '" alt="' . $row["name"] . '" style="width: 50px; height: 50px;"></td>';
                      echo '<td>' . $row["category"] . '</td>';
                      echo '<td>';
                      echo '<a href="edit_product.php?id=' . $row["id"] . '" class="btn btn-primary">Edit</a>';
                      echo '<a href="delete_product.php?id=' . $row["id"] . '" class="btn btn-danger">Delete</a>';
                      echo '</td>';
                      echo '</tr>';
                    }
                  } else {
                    echo "<tr><td colspan='6'>No products found</td></tr>";
                  }
                  $conn_admin->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>
