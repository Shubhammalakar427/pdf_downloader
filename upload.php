<?php
include 'db.php';

if (isset($_POST['upload'])) {
    $fileName = $_FILES['pdf']['name'];
    $fileTmp = $_FILES['pdf']['tmp_name'];
    $folder = 'uploads/'. $fileName;

    if (move_uploaded_file($fileTmp, $folder)) {
        $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $fileName, $folder);
        $stmt->execute();
        header("Location: index.php?success=1");
    } else {
        echo "Failed to upload file.";
    }
}
?>
