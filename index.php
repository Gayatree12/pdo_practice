<?php

/*Done by Gayatree Tamuli (gt86@njit.edu)
  Title: PDO Practice */


//html table styling
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>id</th><th>email</th><th>fname</th><th>lname</th><th>phone</th><th>birthday</th><th>gender</th><th>password</th></tr>";

class table extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); //default:list only leaves in iteration
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$my_servername = "sql2.njit.edu";
$username = "gt86";
$password = "0rNBRXnf3";
$dbname = "gt86";   //database name

try {
    $conn = new PDO("mysql:host=$my_servername;dbname=$dbname", $username, $password); //create connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //error reporting; 
    echo '<p>Connected Successfully</p>' . '<br>'; 
    $stmt = $conn->prepare("SELECT * FROM accounts where id<6");  //select records where id is less than 6
    $stmt->execute(); //execute select statement
    $count_rec =$stmt->rowCount();  //count the number of records where id is less than 6
    echo '<br>';
    echo "Number of rows affected: $count_rec" . '<br>' . '<br>'; //output number of rows affected   

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //fetch all the records in the result set 
    foreach(new table(new RecursiveArrayIterator($stmt->fetchAll())) as $key=>$value) {   
        echo $value;
    }
}
catch(PDOException $e) {
    $error_message = $e -> getMessage();
    echo "<p>An error occurred while connecting to the database: $error_message</p>" . '<br>'; 
}
$conn = null; //close connection
echo "</table>";
?> 


