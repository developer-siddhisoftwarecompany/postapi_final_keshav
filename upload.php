<?php require 'db.php'; ?>
<?php
header("Content-Type: application/json");

if(!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK){
    echo json_encode(["status" => "error", "message" => "No file selected or upload error"]);
    exit;
}

$uploadDir = "uploads/";

if(!is_dir($uploadDir)){
    mkdir($uploadDir, 0777, true);
}

$fileName = time() . "-" . basename($_FILES["image"]["name"]);
$targetPath = $uploadDir . $fileName;

if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)){
    echo json_encode([
        "status" => "success",
        "message" => "Image uploaded successfully",
        "file" => $fileName
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to move file"
    ]);
}
?>
