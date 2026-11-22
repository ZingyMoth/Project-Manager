<?php
// 
session_start();
include 'connectdb.php';

// 
$project = false;
if (isset($_GET['pid'])) {
    // 
    $stmt = $db->prepare("SELECT projects.pid, projects.uid, projects.title, projects.start_date, projects.end_date, projects.short_description, projects.phase, users.email
                          FROM projects
                          INNER JOIN users ON projects.uid = users.uid
                          WHERE projects.pid = ?");
    $stmt->execute([$_GET['pid']]);
    $project = $stmt->fetch();
}

$page_title = "Project Details";
include 'header.php';
?>
    <!--'Main' is the main content area for the site-->
    <main>
        <?php if (!$project): ?>
            <!-- -->
            <p>Project not found.</p>
            <a href="project-list.php">Back to all projects</a>
        <?php else: ?>
            <!-- -->
            <article class="project project-details">
                <h1><?php echo htmlspecialchars($project['title']); ?></h1>
                <p><?php echo htmlspecialchars($project['short_description']); ?></p>
                <!-- -->
                <dl>
                    <dt>Start date</dt>
                    <dd><?php echo htmlspecialchars($project['start_date']); ?></dd>
                    <dt>End date</dt>
                    <dd><?php echo $project['end_date'] ? htmlspecialchars($project['end_date']) : 'Not set'; ?></dd>
                    <dt>Phase</dt>
                    <dd><span class="phase"><?php echo htmlspecialchars($project['phase']); ?></span></dd>
                    <dt>Project owner</dt>
                    <dd><a href="mailto:<?php echo htmlspecialchars($project['email']); ?>"><?php echo htmlspecialchars($project['email']); ?></a></dd>
                </dl>
                <!-- -->
                <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] == $project['uid']): ?>
                    <a href="edit-project.php?pid=<?php echo $project['pid']; ?>" class="button">Edit project</a>
                    <!-- -->
                        <form class="delete-form" action="delete-project.php" method="post" onsubmit="return confirm('Are you sure you want to delete this project?')">
                        <input type="hidden" name="pid" value="<?php echo $project['pid']; ?>">
                        <button type="submit" class="button button-outline">Delete project</button>
                    </form>
                <?php endif; ?>
                <a href="project-list.php">Back to all projects</a>
            </article>
        <?php endif; ?>
    </main>
<?php include 'footer.php'; ?>