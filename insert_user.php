<?php
header("Content-Type: application/json");

include 'db_config.php';
// Get the posted data
$data = json_decode(file_get_contents("php://input"));

// Validate the data
if (!isset($data->id) || !isset($data->name) || !isset($data->email)  || !isset($data->nim) || !isset($data->alamat)) {
    die(json_encode(["error" => "Invalid input"]));
}

$id = $koneksi->real_escape_string($data->id);
$name = $koneksi->real_escape_string($data->name);
$email = $koneksi->real_escape_string($data->email);
$nim = $koneksi->real_escape_string($data->nim);
$alamat = $koneksi->real_escape_string($data->alamat);

$sql = "INSERT INTO users (id, name, email, nim, alamat) VALUES ('$id','$name', '$email', '$nim', '$alamat')";

if ($koneksi->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $koneksi->error]);
}

$koneksi->close();
