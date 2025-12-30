<?php
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connect_customer_db();
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required.');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO customers (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password_hashed);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
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
            <h1 class="page-title">Register</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.php">Home /</a>
              </span>
              <span class="item">Register</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="register-form" class="padding-large">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form class="register-form" method="post">
                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address *</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
