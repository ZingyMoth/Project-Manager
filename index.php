<?php
// Starts up the session, sets the tab title to 'Home' and adds the header.
session_start();
$page_title = "Home";
include 'header.php';
?>
    <!--'Main' is the main content area for the site-->
    <main>
        <!--Introduction section for the site-->
        <section id="hero">
            <p class="eyebrow">Company project tracker</p>
            <h1>Project Manager</h1>
            <p>Software project manager application, showing all projects in one place.</p>
            <?php if (isset($_SESSION['uid'])): ?>
   <!--Once logged in, the home page shows 'Welcome back' with the user's name, along with the 'Add Project' and 'Browse Projects' buttons-->
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>
                <a href="add-project.php" class="button">Add Project</a>
                <a href="project-list.php" class="button button-outline">Browse Projects</a>
            <?php else: ?>
                <!--If the user has not logged in, the home page shows the 'Log In' and 'Browse Projects' buttons-->
                <a href="login.php" class="button">Log In</a>
                <a href="project-list.php" class="button button-outline">Browse Projects</a>
            <?php endif; ?>
        </section>
    </main>
<?php include 'footer.php'; ?>