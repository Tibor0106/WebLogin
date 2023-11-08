<?php
require_once "database.php";
if (isset($_POST["username"]) && $_POST["password"]) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM username WHERE like '$username'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        return loginerr();
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);


}
function loginerr()
{
    echo "false";
}
?>