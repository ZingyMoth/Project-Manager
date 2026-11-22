<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> | Project Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--Main header for the site-->
    <header id="main-header">
        <a href="index.php">Project Manager</a>
        <nav>
            <!--Below are the navigation links for the corresponding sections-->
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="project-list.php">Projects</a></li>
                <?php if (isset($_SESSION['uid'])): ?>
                    <!--When logged in, provides a 'Add Project' and 'Log Out' button-->
                    <li><a href="add-project.php">Add Project</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php else: ?>
                    <!--If the user has not logged in, the menu shows the 'Log in' and 'Register' buttons-->
                    <li><a href="login.php">Log In</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>