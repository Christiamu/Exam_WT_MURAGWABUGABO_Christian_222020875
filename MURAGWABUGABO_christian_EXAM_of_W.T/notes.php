<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>notes Page</title>
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
   <h1><u>Notes Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">

    <label for="note_id">Note_id:</label>
    <input type="number" id="Event_ID" name="Event_ID" required><br><br>

    <label for="session_id">Session_id:</label>
    <input type="number" id="Event_Name" name="Event_Name" required><br><br>

    <label for="therapist_id">Therapist_id:</label>
    <input type="number" id="Description" name="Description" required><br><br>

    <label for="client_id">Client_id:</label>
    <input type="number" id="Start_Date" name="Start_Date" required><br><br>

    <label for="note_body">Note_body:</label>
    <input type="text" id="End_Date" name="End_Date" required><br><br>


    <label for="timestamp">timestamp:</label>
    <input type="time" id="EndDate" name="EndDate" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>


<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO notes(note_id, session_id, therapist_id, client_id, note_body,timestamp) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("isssss", $note_id, $session_id, $therapist_id, $client_id, $note_body, $timestamp);

    // Set parameters and execute
    $note_id = $_POST['Event_ID'];
    $session_id = $_POST['Event_Name'];
    $therapist_id = $_POST['Description'];
    $client_id = $_POST['Start_Date'];
    $note_body = $_POST['End_Date'];
    $timestamp = $_POST['EndDate'];
    
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
    <title>notes details</title>
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
    <center><h2>Notes Table</h2></center>
    <table border="3">
        <tr>
            <th>note_id</th>
            <th>session_id</th>
            <th>therapist_id</th>
            <th>client_id</th>
            <th>note_body</th>
            <th>timestamp</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all notes
$sql = "SELECT * FROM notes";
$result = $connection->query($sql);

// Check if there are any notes
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $note_id = $row['note_id']; // Fetch the note_id
        echo "<tr>
            <td>" . $row['note_id'] . "</td>
            <td>" . $row['session_id'] . "</td>
            <td>" . $row['therapist_id'] . "</td>
            <td>" . $row['client_id'] . "</td>
            <td>" . $row['note_body'] . "</td>
            <td>" . $row['timestamp'] . "</td>
            <td><a style='padding:4px' href='delete_notes.php?note_id=$note_id'>Delete</a></td> 
            <td><a style='padding:4px' href='update_notes.php?note_id=$note_id'>Update</a></td> 
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

