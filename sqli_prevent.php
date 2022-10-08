// User ID must not be empty, must be numeric and must be less than 5 characters long
if((!empty($_GET['user_id'])) && (is_numeric($_GET['user_id'])) && (mb_strlen($_GET['user_id'])<5)) {

  $servername = "localhost";
  $username = "username";
  $password = "password";
  $database = "dbname"; 

  // Establish a new connection to the SQL server using PDO
  try { 
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 

    // Assign user input to the $user_id variable 
    $user_id = $_GET['user_id']; 

    // Prepare the query and set a placeholder for user_id 
    $sth = $conn->prepare('SELECT user_name, user_surname FROM users WHERE user_id=?');

    // Execute the query by providing the user_id parameter in an array
    $sth->execute(array($user_id));

    // Fetch all matching rows
    $user = $sth->fetch();

    // If there is a matching user, display their info
    if(!empty($user)) {
      echo "Welcome ".$user['user_name']." ".$user['user_surname']; 
    } else {
      echo "No user found"; 
    }

    // Close the connection
    $dbh = null; 
  } catch(PDOException $e) {
    echo "Connection failed."; 
  }
} else {
  echo "User ID not specified or invalid."; 
}
