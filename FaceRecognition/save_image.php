<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imageData = $_POST['image'];
    $ecid = $_POST['ecid'];

    if (!$imageData || !$ecid) {
        echo 'Image data or ECID is missing.';
        exit;
    }

    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);

    if ($imageData === false) {
        echo 'Failed to decode image data.';
        exit;
    }

    $filePath = 'C:/xampp/htdocs/FaceRecognition/Faces/' . $ecid . '.png';

    if (file_put_contents($filePath, $imageData) === false) {
        echo 'Failed to save image.';
        exit;
    }

    echo 'Image saved successfully.';
} else {
    echo 'Invalid request method.';
}
?>
