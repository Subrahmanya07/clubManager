<?php
  if(!isset($_SESSION)){session_start();}

  require_once "config.php";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST["username"];
      $password = $_POST["password"];
  
      $sql = "SELECT username, password FROM login WHERE username = ? ";
      
      if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("s", $param_username);
          $param_username = $username;
          
          if ($stmt->execute()) {
              $stmt->store_result();
              if ($stmt->num_rows == 1) {
                  $stmt->bind_result($username, $hashed_password);
                  if ($stmt->fetch()) {
               
                      if ($password==$hashed_password) {
                          // Password is correct, start a new session
                         // session_start();
                          $_SESSION["loggedin"] = true;
                        
                          $_SESSION["username"] = $username;
                         
                          // Redirect user to welcome page
                          header("location: ../html/home.html");
                          exit;
                      } else {
                          // Password is incorrect
                          $login_err = "Invalid username or password.";
                          //echo $login_err;
                      }
                  }
              } else {
                  // Username not found
                  $login_err = "Invalid username or password.";
                 // echo $login_err;
              }
          } else {
              echo "Oops! Something went wrong. Please try again later.";
          }
  
          $stmt->close();
      }
  }
  header('location:../html/');
  ?>