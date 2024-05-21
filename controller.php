<?php
$host="localhost";
$username="id22192501_pascualilloelglande";
$password="a1B2@c34";
$bdname="id22192501_mamemimomulavacaeshonorio";

$connect=mysqli_connect($host,$username,$password,$bdname);

if ($connect->connect_error){
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $email = $data['email'];

    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$name', '$email')";

    if ($connect->query($sql) === TRUE){
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }
} else {
    $sql = "SELECT * FROM usuarios";
    $result = $connect -> query($sql)
    $users = array();

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            $users[] = array("name" => $row["nombre"], "email" => $row["email"]);
        }
    }
    echo json_encode($users);
}

$connect-> close();
?>