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
        // 
        if (empty($end_date)) {
            $end_date = null;
        }

        // 
        try {
            $stmt = $db->prepare("INSERT INTO projects (title, start_date, end_date, short_description, phase, uid) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $start_date, $end_date, $short_description, $phase, $_SESSION['uid']]);
            $success = "Project added.";
        } catch (PDOException $e) {
            $error = "Sorry, the project could not be saved.";
        }
    }
}

$page_title = "Add Project";
include 'header.php';
?>
    <!--'Main' is the main content area for the site-->
    <main>
        <!-- -->
        <section class="form-card">
            <h1>Add a project</h1>

            <!-- -->
            <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
            <?php if (!empty($success)) echo "<p class='success-message'>$success</p>"; ?>

            <form class="site-form" action="add-project.php" method="post">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>

                <label for="start_date">Start date</label>
                <input type="date" id="start_date" name="start_date" required>

                <label for="end_date">End date (optional)</label>
                <input type="date" id="end_date" name="end_date">

                <label for="short_description">Short description</label>
                <textarea id="short_description" name="short_description" rows="4" required></textarea>

                <label for="phase">Phase</label>
                <select id="phase" name="phase" required>
                    <option value="design">Design</option>
                    <option value="development">Development</option>
                    <option value="testing">Testing</option>
                    <option value="deployment">Deployment</option>
                    <option value="complete">Complete</option>
                </select>

                <button type="submit">Add project</button>
            </form>
        </section>
    </main>
<?php include 'footer.php'; ?>