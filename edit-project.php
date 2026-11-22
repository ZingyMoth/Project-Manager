<?php
// 
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
include 'connectdb.php';

// 
$error = "";
$success = "";
$phases = array("design", "development", "testing", "deployment", "complete");

// 
$pid = "";
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
} elseif (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
}

// 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $short_description = $_POST['short_description'];
    $phase = $_POST['phase'];

    // 
    if (empty($title) || empty($start_date) || empty($short_description) || empty($phase)) {
        $error = "Please fill in all required fields.";
    } elseif (!empty($end_date) && $end_date < $start_date) {
        $error = "The end date cannot be before the start date.";
    } else {
        if (empty($end_date)) {
            $end_date = null;
        }

        // 
        try {
            $stmt = $db->prepare("UPDATE projects SET title = ?, start_date = ?, end_date = ?, short_description = ?, phase = ? WHERE pid = ? AND uid = ?");
            $stmt->execute([$title, $start_date, $end_date, $short_description, $phase, $pid, $_SESSION['uid']]);
            $success = "Project updated.";
        } catch (PDOException $e) {
            $error = "Sorry, the project could not be updated.";
        }
    }
}

// 
$stmt = $db->prepare("SELECT * FROM projects WHERE pid = ? AND uid = ?");
$stmt->execute([$pid, $_SESSION['uid']]);
$project = $stmt->fetch();

$page_title = "Edit Project";
include 'header.php';
?>
    <!--'Main' is the main content area for the site-->
    <main>
        <?php if (!$project): ?>
            <!-- -->
            <p>Project not found, or you do not have permission to edit it.</p>
            <a href="project-list.php">Back to all projects</a>
        <?php else: ?>
            <!-- -->
            <section class="form-card">
                <h1>Edit project</h1>

                <!-- -->
                <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
                <?php if (!empty($success)) echo "<p class='success-message'>$success</p>"; ?>

                <form class="site-form" action="edit-project.php" method="post" onsubmit="return validateProject()" novalidate>
                    <!-- -->
                    <input type="hidden" name="pid" value="<?php echo $project['pid']; ?>">

                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>

                    <label for="start_date">Start date</label>
                    <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($project['start_date']); ?>" required>

                    <label for="end_date">End date (optional)</label>
                    <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($project['end_date']); ?>">

                    <label for="short_description">Short description</label>
                    <textarea id="short_description" name="short_description" rows="4" required><?php echo htmlspecialchars($project['short_description']); ?></textarea>

                    <label for="phase">Phase</label>
                    <select id="phase" name="phase" required>
                        <?php foreach ($phases as $option): ?>
                            <option value="<?php echo $option; ?>" <?php if ($project['phase'] == $option) echo "selected"; ?>><?php echo ucfirst($option); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Save changes</button>
                </form>
                <p><a href="project-details.php?pid=<?php echo $project['pid']; ?>">Back to project</a></p>
            </section>
        <?php endif; ?>
    </main>
<?php include 'footer.php'; ?>