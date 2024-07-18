<?php
//On my honor, I have neither received nor given any unauthorized assistance on this assignment.Natalie Montesino

// Start the session to store and retrieve session variables
session_start();

// Check if the user just submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data and store in session
    $_SESSION['firstName'] = htmlspecialchars($_POST['firstName']);
    $_SESSION['lastName'] = htmlspecialchars($_POST['lastName']);
    $_SESSION['email'] = htmlspecialchars($_POST['email']);
    $_SESSION['phone'] = htmlspecialchars($_POST['phone']);
    $_SESSION['publication'] = htmlspecialchars($_POST['publication']);
    $_SESSION['os'] = htmlspecialchars($_POST['os']);  // Operating system
}
?>

<!DOCTYPE html>
<html lang="en"><!-- Define the document type as HTML5 and set the language to English -->
<head>
    <meta charset="UTF-8"><!-- Specify the character encoding for the document as UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Ensure proper rendering and touch zooming on mobile devices -->
    <title>Confirmation Page</title><!-- Set the title of the webpage to "Confirmation Page" -->
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 14px; /* Default font size for all text */
        }
        .greeting {
            font-size: 14px; /* Specific font size for the greeting */
        }
        .info {
            font-weight: bold; /* Bold for section headings */
        }
        .data {
            font-weight: normal; /* Normal font weight for user data */
        }
    </style>
</head>
<body>
        <!-- Greeting message displaying the user's first name and selected publication -->

    <p class="greeting">Hi <?php echo $_SESSION['firstName']; ?>, thank you for completing the survey. You have been added to the <?php echo $_SESSION['publication']; ?> mailing list.</p>
    <div>
                <!-- Information saved message -->

        <p class="info">The following information has been saved in our database:</p>
                <!-- Display the user's full name -->

        <p class="data">Name: <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></p>
                <!-- Display the user's email address -->

        <p class="data">Email: <?php echo $_SESSION['email']; ?></p>
                <!-- Display the user's phone number -->

        <p class="data">Phone: <?php echo $_SESSION['phone']; ?></p>
                <!-- Display the user's selected operating system -->

        <p class="data">OS: <?php echo $_SESSION['os']; ?></p>
                <!-- Link to view the entire database -->

        <p><a href="view_database.php">Click here to view the entire database.</a></p>
    </div>
</body>
</html>
