<?php
// 
session_start();
include 'connectdb.php';

// 
if (!empty($_GET['title'])) {
    // 
    $stmt = $db->prepare("SELECT pid, title, start_date, short_description FROM projects WHERE title LIKE ?");
    $stmt->execute(['%' . $_GET['title'] . '%']);
} elseif (!empty($_GET['start_date'])) {
    // 
    $stmt = $db->prepare("SELECT pid, title, start_date, short_description FROM projects WHERE start_date = ?");
    $stmt->execute([$_GET['start_date']]);
} else {
    // 
    $stmt = $db->query("SELECT pid, title, start_date, short_description FROM projects");
}
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = "Projects";
include 'header.php';
?>

    <!--'Main' is the main content area for the site-->
    <main>
        <h1>All Projects</h1>

        <!-- -->
        <form class="search-form" action="project-list.php" method="get">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Customer Portal">
            <label for="start_date">Start date</label>
            <input type="date" id="start_date" name="start_date">
            <button type="submit">Search</button>
        </form>

        <!-- -->
        <section class="project-list">
            <?php if (empty($projects)): ?>
                <p>No projects found.</p>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <article class="project">
                        <h2><?php echo htmlspecialchars($project['title']); ?></h2>
                        <p class="project-date">Start date: <?php echo htmlspecialchars($project['start_date']); ?></p>
                        <p><?php echo htmlspecialchars($project['short_description']); ?></p>
                        <a href="project-details.php?pid=<?php echo $project['pid']; ?>">View details</a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
<?php include 'footer.php'; ?>