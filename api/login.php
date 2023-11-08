<?php
require_once "database/database.php";

if (isset($_POST["username"]) && $_POST["password"]) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username like '$username'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {

                $data[] = $row;
            } else {
                echo "false";
                return false;
            }
        }
    } else {
        echo "false";
    }
    session_start();
    $_SESSION["username"] = $username;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
?>