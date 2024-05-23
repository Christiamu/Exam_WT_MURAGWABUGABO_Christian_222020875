<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Appointments Page</title>
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
   <h1><u>Appointments Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">

    <label for="appointment_id">Appointment_id:</label>
    <input type="number" id="Event_ID" name="Event_ID" required><br><br>

    <label for="therapist_id">therapist_id:</label>
    <input type="number" id="Event_Name" name="Event_Name" required><br><br>

    <label for="client_id">client_id:</label>
    <input type="number" id="Description" name="Description" required><br><br>

    <label for="appointment_time">appointment_time:</label>
    <input type="time" id="Start_Date" name="Start_Date" required><br><br>

    <label for="status">status:</label>
    <input type="text" id="End_Date" name="End_Date" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>


<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO appointments(appointment_id, therapist_id, client_id, appointment_time, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $appointment_id, $therapist_id, $client_id, $appointment_time, $Parent_ID, $status);

    // Set parameters and execute
    $appointment_id = $_POST['Event_ID'];
    $therapist_id = $_POST['Event_Name'];
    $client_id = $_POST['Description'];
    $appointment_time = $_POST['Start_Date'];
    $status = $_POST['End_Date'];
    
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
    <title>appointments details</title>
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
    <center><h2>appointments Table</h2></center>
    <table border="3">
        <tr>
            <th>appointment_id</th>
            <th>therapist_id</th>
            <th>client_id</th>
            <th>appointment_time</th>
            <th>status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all appointments
$sql = "SELECT * FROM appointments";
$result = $connection->query($sql);

// Check if there are any appointments
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $appointment_id = $row['appointment_id']; // Fetch the appointment_id
        echo "<tr>
            <td>" . $row['appointment_id'] . "</td>
            <td>" . $row['therapist_id'] . "</td>
            <td>" . $row['client_id'] . "</td>
            <td>" . $row['appointment_time'] . "</td>
            <td>" . $row['status'] . "</td>
            

            <td><a style='padding:4px' href='delete_appointments.php?appointment_id=$appointment_id'>Delete</a></td> 
            <td><a style='padding:4px' href='update_appointments.php?appointment_id=$appointment_id'>Update</a></td> 
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

