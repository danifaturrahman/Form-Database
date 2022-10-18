<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="webproDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Insert table
// =========== Static ===============
// $sql = "INSERT INTO user (email, name, password, role, date_created, date_modified)
// VALUES ('dani15@gmail.com', 'Dani Faturrahman', 'ABCD', 'Admin', '12-12-22', '12-12-22')";
// =========== Variable ===============
$sql = "INSERT INTO user (email, name, password, role, date_created, date_modified)
        VALUES ('$email', '$name', '$pass', '$role', '$dcreated', '$dmodif')";

if ($conn->query($sql) === TRUE) {
  echo "<br>";
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>