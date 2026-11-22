<?php
// 
session_start();
include 'connectdb.php';

// 
$error = "";

// 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // 
    if ($user && password_verify($password, $user['password'])) {
        // 
        session_regenerate_id(true);
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['username'] = $user['username'];

        // 
        header("Location: project-list.php");
        exit();
    } else {
        $error = "Wrong username or password.";
    }
}

$page_title = "Log In";
include 'header.php';
?>
    <!--'Main' is the main content area for the site-->
    <main>
        <!-- -->
        <section class="form-card">
            <h1>Log in</h1>

            <!-- -->
            <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>

            <form class="site-form" action="login.php" method="post" onsubmit="return validateLogin()" novalidate>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php if (!empty($error)) echo htmlspecialchars($_POST['username']); ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Log in</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </section>
    </main>
<?php include 'footer.php'; ?>