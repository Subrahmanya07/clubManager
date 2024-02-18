<?php
session_start();

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT username, password FROM login WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;

        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $username, $hashed_password);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        // Redirect user to welcome page
                        header("location: welcome.php");
                    } else {
                        // Password is incorrect
                        $login_err = "Invalid username or password.";
                    }
                }
            } else {
                // Username not found
                $login_err = "Invalid username or password.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
