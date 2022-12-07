<?php 

session_start();

require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../services/database-connector.php');

try {
    $image_data = validate_image();
    $upload_dir = __DIR__."/../images/";
    $upload_file = $upload_dir . $image_data['image_name'];
    if (move_uploaded_file($image_data['image_tmp'], $upload_file)) {
        $query = $database->prepare("UPDATE users SET image = :image WHERE id = :id");
        $query->bindValue('image', 'images/'.$image_data['image_name']);
        $query->bindValue('id', $_SESSION['id']);
        $query->execute();
        if ($query->rowCount() == 0) {
            // echo 'something went wrong, could not update image';
            header('Location: ./update-image');
            exit();
        }
        header('Location: ./profile');
        exit();
    }
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['error' => 'error on line: '.__LINE__]);
    exit();
}
?>