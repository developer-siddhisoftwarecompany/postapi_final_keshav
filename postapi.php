<?php require 'db.php'; ?>
<?php
header("Content-Type: application/json");

$id    = $_POST["id"] ?? null;
$name  = $_POST["name"] ?? null;
$phone = $_POST["phone"] ?? null;

// VALIDATION
if(!$id){
    echo json_encode(["status"=>"error","message"=>"ID is required"]);
    exit;
}
if(!$name || trim($name) == ""){
    echo json_encode(["status"=>"error","message"=>"Name cannot be empty"]);
    exit;
}
if(strlen($phone) < 10){
    echo json_encode(["status"=>"error","message"=>"Phone must be at least 10 digits"]);
    exit;
}

// READ EXISTING DATA
$data = json_decode(file_get_contents("data.json"), true);

// CHECK IF ID ALREADY EXISTS
foreach($data as $user){
    if($user["id"] == $id){
        echo json_encode(["status"=>"error","message"=>"ID already exists"]);
        exit;
    }
}

$data[] = ["id"=>$id, "name"=>$name, "phone"=>$phone];
file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"success","message"=>"User created"]);
?>
