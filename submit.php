<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "cateringdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assign POST data to variables
    $occasion = $_POST['occasion'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $budgetPerPax = $_POST['budgetPerPax'];
    $no_of_guests = $_POST['no_of_guests'];
    $eventAddress = $_POST['eventAddress'];
    $location = $_POST['location'];
    $contactName = $_POST['contactName'];
    $contactNumber = $_POST['contactNumber'];
    $contactEmail = $_POST['contactEmail'];
    $companyName = $_POST['companyName'];
    $specialRequest = $_POST['specialRequest'];
    $promoCode = $_POST['promoCode'];
    $newsletter = $_POST['newsletter'];

    // Validate required fields
    $required_fields = array($occasion, $event_date, $event_time, $budgetPerPax, $no_of_guests, $eventAddress, $location, $contactName, $contactNumber, $contactEmail, $newsletter);
    foreach($required_fields as $field) {
        if (empty($field)) {
            die("Error: Required field is missing.");
        }
    }

    // Prepare an insert statement
    $sql = "INSERT INTO orders (occasion, event_date, event_time, budgetPerPax, no_of_guests, eventAddress, location, contactName, contactNumber, contactEmail, companyName, specialRequest, promoCode, newsletter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssdississssss", $occasion, $event_date, $event_time, $budgetPerPax, $no_of_guests, $eventAddress, $location, $contactName, $contactNumber, $contactEmail, $companyName, $specialRequest, $promoCode, $newsletter);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Records inserted successfully.";
        } else {
            echo "ERROR: Could not execute query: $sql. " . $conn->error;
        }
    } else {
        echo "ERROR: Could not prepare query: $sql. " . $conn->error;
    }

    // Select data from the orders table
    $sql = "SELECT id, contactName, contactNumber, no_of_guests, event_date, location, budgetPerPax FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $totalBudget = $row["no_of_guests"] * $row["budgetPerPax"];
            echo "Order ID: " . $row["id"]. " - Contact Person: " . $row["contactName"]. " - Contact Number: " . $row["contactNumber"]. " - Number of Pax: " . $row["no_of_guests"]. " - Event Date: " . $row["event_date"]. " - Location: " . $row["location"]. " - Total Budget: " . $totalBudget . "<br>";
        }
    } else {
        echo "0 results";
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
?>