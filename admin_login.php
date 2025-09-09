<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Login - SparkleClean</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>SparkleClean - Admin Panel</h1>
        </div>
    </header>
    <main class="container section">
        <div class="form-container auth-form">
            <h1 class="page-title">Administrator Login</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger">Invalid username or password.</div>';
            }
            ?>
            <form action="api/admin_login_handler.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>
    </main>
</body>

</html>