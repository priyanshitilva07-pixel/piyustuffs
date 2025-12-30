<?php
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connect_customer_db();
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('Username and password are required.');</script>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row['id'];
                echo "<script>alert('Login successful!'); window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Invalid username or password');</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

    <section class="site-banner jarallax min-height300 padding-large" style="background: url(images/hero-image.jpg) no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Login</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Login</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="login-form" class="padding-large">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form class="login-form" method="post">
                        <div class="form-group">
                            <label for="username">Username or email address *</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Log in</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
