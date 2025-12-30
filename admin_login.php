<?php
session_start();
include_once 'db_connect.php';

if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    header("location: admin.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn_admin = connect_admin_db();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn_admin->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_loggedin'] = true;
            $_SESSION['admin_id'] = $row['id'];
            header("location: admin.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that username.";
    }
    $stmt->close();
    $conn_admin->close();
}
?>
<?php include 'header.php'; ?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat; background-position: top;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Admin Login</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Admin Login</span>
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
              <h2>Login</h2>
              <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-dark">Login</button>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php include 'footer.php'; ?>
