<?php 

require_once(__DIR__.'/../services/validator.php');

// try {
    validate_image();
// } catch (PDOException $exception) {
//     http_response_code(500);
//     echo json_encode(['error' => 'error on line: '.__LINE__]);
//     exit();
// }
?>