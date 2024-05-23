<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>clients Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="dimgray">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/loggwa.jpeg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./appointments.php">Appointments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./clients.php">Clients</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./notes.php">Notes</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./profile.php">Profile</a>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./payments.php">Payments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./reviews.php">Reviews</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">Sessions</a>
  </li>
<li style="display: inline; margin-right: 10px;"><a href="./session_files.php">Session_files</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./therapist_schedule.php">therapist_schedule</a>
  </li>
   
   
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
   <h1><u>Clients Form</u></h1>



<form method="post" onsubmit="return confirmInsert();">

    <label for="client_id">Client_id:</label>
    <input type="number" id="Attachment_ID" name="Attachment_ID" required><br><br>

    <label for="user_id">user_id:</label>
    <input type="number" id="Message_ID" name="Message_ID" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>


<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO clients(client_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("is", $client_id, $user_id);

    // Set parameters and execute
    $client_id = $_POST['Attachment_ID'];
    $user_id = $_POST['Message_ID'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients DETAILS</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Clients Table</h2></center>
    <table border="3">
        <tr>
            <th>Client_id</th>
            <th>user_id</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all clients
$sql = "SELECT * FROM clients";
$result = $connection->query($sql);

// Check if there are any clients
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $Client_id = $row['client_id']; // Fetch the Client_id
        echo "<tr>
        
            <td>" . $row['client_id'] . "</td>
            <td>" . $row['user_id'] . "</td>
            <td><a style='padding:4px' href='delete_clients.php?Client_id=$Client_id'>Delete</a></td> 
            <td><a style='padding:4px' href='update_clients.php?Client_id=$Client_id'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}
// Close the database connection
$connection->close();
?>
    </table>
</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:MURAGWABUGABO CHRISTIAN</h2></b>
  </center>
</footer>
  
</body>
</html>

