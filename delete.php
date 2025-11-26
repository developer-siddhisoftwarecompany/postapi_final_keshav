<?php require 'db.php'; ?>
<?php
header("Content-Type: application/json");

$id = $_POST["id"] ?? null;

if(!$id){
    echo json_encode(["status"=>"error","message"=>"ID is required"]);
    exit;
}

$data = json_decode(file_get_contents("data.json"), true);
$newData = [];
$deleted = false;

foreach($data as $user){
    if($user["id"] != $id){
        $newData[] = $user;
    } else {
        $deleted = true;
    }
}

if(!$deleted){
    echo json_encode(["status"=>"error","message"=>"ID not found"]);
    exit;
}

file_put_contents("data.json", json_encode($newData, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"success","message"=>"User deleted"]);
?>
