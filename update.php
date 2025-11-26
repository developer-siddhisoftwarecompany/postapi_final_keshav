<?php require 'db.php'; ?>
<?php
header("Content-Type: application/json");

$id    = $_POST["id"] ?? null;
$name  = $_POST["name"] ?? null;
$phone = $_POST["phone"] ?? null;

if(!$id){
    echo json_encode(["status"=>"error","message"=>"ID is required"]);
    exit;
}

$data = json_decode(file_get_contents("data.json"), true);
$found = false;

foreach($data as &$user){
    if($user["id"] == $id){
        if($name !== null && trim($name) !== "") $user["name"] = $name;
        if($phone !== null && strlen($phone) >= 10) $user["phone"] = $phone;
        $found = true;
        break;
    }
}

if(!$found){
    echo json_encode(["status"=>"error","message"=>"ID not found"]);
    exit;
}

file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"success","message"=>"User updated"]);
?>
