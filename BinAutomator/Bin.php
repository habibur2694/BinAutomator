<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BinAutomator</title>
<style>
  /* Your CSS styles here */
</style>
</head>
<body>
  <!-- Your HTML content here -->
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
    <a href="DataHistory.php?month=1">January</a>
    <a href="DataHistory.php?month=2">February</a>
    <!-- Add more month links as needed -->
  </div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Metal</th>
        <th>Organic</th>
        <th>Plastic</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
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

      // Get the selected month from the query string
      $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('n');

      // Fetch data from the data table for the selected month
      $query = "SELECT * FROM `data` WHERE MONTH(`Date`) = $selectedMonth";
      $result = $connection->query($query);

      // Create an array to store the fetched data
      $data = array();

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
      }

      // Close the result set
      $result->close();

      // Close the database connection
      $connection->close();

      foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $row['Id'] . "</td>";
        echo "<td>" . $row['Metal'] . " times</td>";
        echo "<td>" . $row['Organic'] . " times</td>";
        echo "<td>" . $row['Plastic'] . " times</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Your footer section here -->

  <script>
    // Your JavaScript code here
  </script>
</body>
</html>
