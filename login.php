<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Client Login - SparkleClean</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container section">
        <div class="form-container auth-form">
            <h1 class="page-title">Client Login</h1>

            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'registered_successfully') {
                echo '<div class="alert alert-success">Registration successful! Please log in.</div>';
            }
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger">Invalid email or password.</div>';
            }
            ?>

            <form action="api/login.php" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
            <p class="auth-switch">Don't have an account? <a href="registration.php">Register here</a></p>
        </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> SparkleClean Services. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>