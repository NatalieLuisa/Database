
<?php
//On my honor, I have neither received nor given any unauthorized assistance on this assignment.Natalie Montesino
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start(); // Start the session at the beginning

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $publication = htmlspecialchars($_POST['publication']);
    $os = htmlspecialchars($_POST['os']);  // Operating system

    // Store data in session for use in confirmation.php
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['publication'] = $publication;
    $_SESSION['os'] = $os;

    // Database connection variables
    $servername = "localhost";//server
    $username = "root";//username
    $password = "";//password
    $dbname = "Mailinglist";//database name 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL and bind parameters
    $stmt = $conn->prepare("INSERT INTO Contacts (FirstName, LastName, Email, Phone, Publication, OS) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $publication, $os);

    // Execute the prepared statement and check for errors
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect to confirmation page without parameters
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en"><!-- Define the document type as HTML5 and set the language to English -->
<head>
    <meta charset="UTF-8"><!-- Specify the character encoding for the document as UTF-8, translate any Unicode character to a matching unique binary string -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Ensure proper rendering and touch zooming on mobile devices -->
    <title>Registration Form</title><!-- Set the title of the webpage to "Registration Form" -->
    <script>
        // JavaScript to format the phone number input
        window.onload = function() {// Function to be executed when the window is fully loaded
            var phoneInput = document.getElementById('phone');// Get the phone input element by its ID
            phoneInput.addEventListener('input', function(e) {// Add an event listener for the input event on the phone input element
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);// Remove non-digit characters and match the resulting string into groups

                e.target.value = !x[2] ? x[1] : '(' + x[1] + ')' + x[2] + (x[3] ? '-' + x[3] : '');// Format the input as (xxx)xxx-xxxx or partial formats based on the input
            });
        };
    </script><!-- Close the script tag -->

    <style>
        body {
            /* Set the font style and size for the body, and remove default margin and padding */
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        h2 {
             /* Set the font size and left margin for h2 elements */
            font-size: 30px;
            margin-left: 10px;
        }
        /* Set the left margin for elements with classes .user-info, .section, and form */
        .user-info, .section, form {
            margin-left: 1px;
        }
        /* Make label elements block-level and add right margin */
        label {
            display: block;
            margin-right: 10px;
        }
            /* Add bottom margin for elements with the class .section */

        .section {
            margin-bottom: 10px;
        }
            /* Set width, text alignment, and bottom margin for text, email, tel inputs, and select elements */

        input[type="text"], input[type="email"], input[type="tel"], select {
            width: 200px;
            text-align: left;
            margin-bottom: 5px;
        }
            /* Set display, font size, bottom margin, and font weight for strong elements */

        strong {
            display: block;
            font-size: 22px;
            margin-bottom: 10px;
            font-weight: bold;
        }
            /* Align items to the left and set text alignment for .user-info elements with the class .section */

        .user-info .section {
            display: flex;
            align-items: left;
            text-align: left;
        }
            /* Set width, text alignment, and display style for labels within .user-info */

        .user-info label {
            width: 120px;
            text-align: right;
            display: inline-block;
        }
        .options-inline {
                /* Display elements with the class .options-inline inline */

            display: inline;
        }
        form {
                /* Set the left margin for form elements */

            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h2>Registration Form</h2><!-- Display the heading "Registration Form" -->
    <p> *Please fill in all fields and click Register.</p><!-- Instructional text for the user -->
    <form method="POST" action="dynamicForm.php"> <!-- Form submission method and action -->
        <strong>User Information:</strong><!-- Section title for user information -->
        <div class="user-info">
            <div class="section">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required><!-- Input field for first name, required for form submission -->
            </div>
            <div class="section">
                <label for="lastName">Last Name:</label><!-- Label for the flast input field -->
                <input type="text" id="lastName" name="lastName" required><!-- Input field for last name, required for form submission -->
            </div>
            <div class="section">
                <label for="email">Email:</label><!-- Label for the email input field -->
                <input type="email" id="email" name="email" required><!-- Input field for email, required for form submission -->
            </div>
            <div class="section">
                <label for="phone">Phone:</label><!-- Label for the phone input field -->
                <input type="tel" id="phone" name="phone" required pattern="\(\d{3}\)\d{3}-\d{4}" title="(xxx)xxx-xxxx"><!-- Input field for phone, required for form submission, with a specific pattern and title for formatting -->
            </div>
            </div>
        </div>
        <strong>Publications:</strong><!-- Section title for publication information -->
        <div class="section">
            <label for="publication">Which book would you like more information about?</label>
            <select id="publication" name="publication">
                
                <?php
                                // PHP code to generate options for the publication select field

                $booklist = array("Internet and WWW How to Program", "C++ How to Program", "Java How to Program", "Visual Basic How to Program");
                foreach ($booklist as $book) {
                    echo "<option value='" . htmlspecialchars($book) . "'>" . htmlspecialchars($book) . "</option>";// Generate an option for each book in the list
                    
                }
                ?>
            </select>
        </div>
        <strong>Operating System:</strong><!-- Section title for operating system information -->
        <div class="section">
                        <!-- Radio buttons for operating system selection -->

            <label class="options-inline"><input type="radio" name="os" value="Windows"> Windows</label>
            <label class="options-inline"><input type="radio" name="os" value="Mac OS X"> Mac OS X</label>
            <label class="options-inline"><input type="radio" name="os" value="Linux"> Linux</label>
            <label class="options-inline"><input type="radio" name="os" value="Other"> Other</label>
        </div>
        <input type="submit" value="Register"><!-- Submit button for the form -->
    </form>
    </form>
</body>
</html>
