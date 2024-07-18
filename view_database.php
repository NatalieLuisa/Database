<?php
//On my honor, I have neither received nor given any unauthorized assistance on this assignment.Natalie Montesino

// Enable error reporting for debugging
ini_set('display_errors', 1);// Set the display_errors directive to 1 to enable error reporting
error_reporting(E_ALL);// Report all PHP errors

// Database connection variables
$servername = "localhost";// Database server name
$username = "root";// Database username
$password = "";// Database password
$dbname = "Mailinglist";// Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); // Establish a new connection to the database using mysqli

// Check connection
if ($conn->connect_error) {// Check if the connection failed
    die("Connection failed: " . $conn->connect_error);// If the connection failed, output an error message and stop the script
}

// Retrieve data from the Contacts table
$sql = "SELECT ID, FirstName, LastName, Email, Phone, Publication, OS FROM Contacts";// SQL query to select all columns from the Contacts table
$result = $conn->query($sql);// Execute the query and store the result

?>

<!DOCTYPE html>
<html lang="en"><!-- Define the document type as HTML5 and set the language to English -->
<head>
    <meta charset="UTF-8"><!-- Specify the character encoding for the document as UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Ensure proper rendering and touch zooming on mobile devices -->
    <title>Mailing List Contacts</title> <!-- Set the title of the webpage to "Mailing List Contacts" -->
    <style>
        /* Set the font style, size, margin, and padding for the body */
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }
        h1 {
            /* Set the font size, weight, and alignment for h1 elements */
            font-size: 36px;
            font-weight: bold;
            text-align: center;
        }
        h2 {
            /* Set the font size, color, alignment, and weight for h2 elements */
            font-size: 16px;
            color: black;
            text-align: center;
            font-weight: normal;
        }
        table {
            /* Set the width, border collapse, and margin for table elements */
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            /* Set the border, padding, and alignment for table header and data cells */
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        th {
                    /* Set the background color and text color for table header cells */

            background-color: #c7e2ba;
            color: black;
        }
        tr:nth-child(even) {
                    /* Set the background color for even table rows */

            background-color: #f3f6f4;
        }
        tr:nth-child(odd) {
                    /* Set the background color for odd table rows */

            background-color: #cfe2f3;
        }
    </style>
</head>
<body>
    <h1>Mailing List Contacts</h1><!-- Display the heading "Mailing List Contacts" -->
    <h2>Contacts Stored in Database</h2><!-- Display the subheading "Contacts Stored in Database" -->
    <table>
        <tr>
                        <!-- Define table headers -->

            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Book</th>
            <th>OS</th>
        </tr>
        <?php
                // Check if there are rows returned from the query

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {// Fetch associative array of the result & diplays the following 
                echo "<tr>
                        <td>" . $row["ID"] . "</td> 
                        <td>" . $row["FirstName"] . "</td>
                        <td>" . $row["LastName"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $row["Phone"] . "</td>
                        <td>" . $row["Publication"] . "</td>
                        <td>" . $row["OS"] . "</td>  
                      </tr>";
            }
        } else {
                        // If no rows are returned, display a message in a single table row

            echo "<tr><td colspan='7'>No contacts found</td></tr>";
        }
        $conn->close();// Close the database connection
        ?>
    </table>
</body>
</html>
