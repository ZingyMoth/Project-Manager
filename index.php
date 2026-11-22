<?php
// 
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
            <p>Every software project in one place: what it is, what phase it is in, and who is in charge of it.</p>
            <a href="login.php" class="button">Log In</a>
            <a href="project-list.php" class="button button-outline">Browse Projects</a>
        </section>
    </main>
<?php include 'footer.php'; ?>