<?php
// 
session_start();
include 'connectdb.php';

// 
$error = "";
$success = "";

// 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif ($password != $confirm_password) {
        $error = "The passwords do not match.";
    } else {
        // 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 
        try {
            $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->execute([$username, $hashed_password, $email]);
            $success = "Account created. You can now log in.";
        } catch (PDOException $e) {
            $error = "That username or email is already in use.";
        }
    }
}

$page_title = "Register";
include 'header.php';
?>
    <!--'Main' is the main content area for the site-->
    <main>
        <!-- -->
        <section class="form-card">
            <h1>Create an account</h1>

            <!-- -->
            <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
            <?php if (!empty($success)) echo "<p class='success-message'>$success</p>"; ?>

            <form class="site-form" action="register.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit">Create account</button>
            </form>
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </section>
    </main>
<?php include 'footer.php'; ?>