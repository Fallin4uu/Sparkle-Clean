<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register - SparkleClean</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container section">
        <div class="form-container auth-form">
            <h1 class="page-title">Create an Account</h1>
            <p class="page-subtitle">Register to easily schedule and manage your cleaning appointments.</p>
            
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'email_exists') {
                echo '<div class="alert alert-danger">This email address is already registered. Please <a href="login.php">login</a>.</div>';
            }
            ?>

            <form action="api/register.php" method="POST">
                <!-- Form fields remain the same -->
                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                 <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone_number" required>
                </div>
                 <div class="input-group">
                    <label for="nid_number">National ID (NID) Number</label>
                    <input type="text" id="nid_number" name="nid_number" required>
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>
            <p class="auth-switch">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> SparkleClean Services. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

