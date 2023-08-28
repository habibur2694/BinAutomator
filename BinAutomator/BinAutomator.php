<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BinAutomator</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #ccc;
    margin: 0;
    padding: 0;
  }
  .header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem;
  }
  .navbar {
    background-color: #444;
    overflow: hidden;
  }
  .navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  .navbar a:hover {
    background-color: #ddd;
    color: black;
  }
  .date {
    background-color: #666;
    color: white;
    text-align: right;
    padding: 5px 15px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0px;
  }
  th, td {
    border: 1px solid #ccc;
    padding: 0.5rem;
    text-align: center;
  }
  th {
    background-color: #009879; /* Green */
    color: white;
  }
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  tr:nth-child(odd) {
    background-color: #ffffff;
  }
  .footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 0px;
    position: absolute;
    bottom: 0;
    width: 100%;
  }
</style>
</head>
<body>
  <div class="header">
    <h1>BinAutomator</h1>
    <p>Welcome to our BinAutomator</p>
  </div>
  <div class="date">
    <p>
      <span id="greeting"></span>, Today's: <span id="currentDateTime"></span>
    </p>
  </div>
  <div class="navbar">
    <a href="BinAutomator.php">Home</a>
    <a href="About.php">About</a>
    <a href="Service.php">Services</a>
    <a href="Contact.php">Contact</a>
  </div>
  <table>
    <tr>
      <th>ID</th>
      <th>Metal</th>
      <th>Organic</th>
      <th>Plastic</th>
      <th>Date</th>
      <th>Delete</th>
    </tr>
    <?php
    // Database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbName = "binautomator";

    // Establish database connection
    $connection = new mysqli($host, $username, $password, $dbName);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Handle delete functionality
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_btn"])) {
        $recordId = $_POST["record_id"];

        // Prepare and execute the delete query
        $deleteQuery = "DELETE FROM `BinAutomator` WHERE `Id` = ?";
        $stmt = $connection->prepare($deleteQuery);
        $stmt->bind_param("i", $recordId);
        $stmt->execute();

        // Redirect back to the current page after deleting
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    // Fetch data from the data table
    $query = "SELECT * FROM `BinAutomator`";
    $result = $connection->query($query);

    // Create an array to store the fetched data
    $BinAutomator = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $BinAutomator[] = $row;
        }
    }

    // Close the result set
    $result->close();

    // Close the database connection
    $connection->close();

    foreach ($BinAutomator as $row) {
      echo "<tr>";
      echo "<td>" . $row['ID'] . "</td>";
      echo "<td>" . $row['Metal'] . " times</td>";
      echo "<td>" . $row['Organic'] . " times</td>";
      echo "<td>" . $row['Plastic'] . " times</td>";
      echo "<td>" . $row['Date'] . "</td>";
      echo "<td>";
      echo '<form method="post">';
      echo '<input type="hidden" name="record_id" value="' . $row['ID'] . '">';
      echo '<button type="submit" name="delete_btn">Delete</button>';
      echo '</form>';
      echo "</td>";
      echo "</tr>";
    }
    ?>
  </table>
  <footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> BinAutomator. All rights reserved.</p>
  </footer>
  <script>
    var d = new Date();
    var hour = d.getHours();
    var greeting = "";

    if (hour >= 5 && hour < 12) {
      greeting = "Good morning";
    } else if (hour >= 12 && hour < 18) {
      greeting = "Good afternoon";
    } else {
      greeting = "Good night";
    }

    document.getElementById("greeting").textContent = greeting;

    const options = { year: 'numeric', month: 'long', day: 'numeric', hour12: true, hour: 'numeric', minute: 'numeric', timeZoneName: 'short' };
    document.getElementById("currentDateTime").textContent = d.toLocaleDateString("en-US", options);
  </script>
</body>
</html>
