<?php
if(!isset($_SESSION)){session_start();}
require 'config.php'; 
$username=$_SESSION['username'];
$sql = "select aDate,aTime from `attendance` where usn=?";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("s",$username);
   
    if ($stmt->execute()) {
        $stmt->store_result();
        
        if ($stmt->num_rows >0) {
            $stmt->bind_result($date, $time);
            echo '<table border="1" style="border-spacing:0;"><thead><tr><th>Date</th><th>Time</th></tr></thead><tbody>';
            while ($stmt->fetch()) {
                echo "<tr><td>$date</td><td>$time</td></tr>";
            }
            echo '</tbody></table>';
        }
    }
}