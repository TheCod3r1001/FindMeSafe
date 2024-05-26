<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imageData = $_POST['image'];

    if (!$imageData) {
        echo 'Image data is missing.';
        exit;
    }

    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);

    if ($imageData === false) {
        echo 'Failed to decode image data.';
        exit;
    }

    $filePath = 'C:/xampp/htdocs/FaceRecognition/Recognition/' . 'face' . '.png';

    if (file_put_contents($filePath, $imageData) === false) {
        echo 'Failed to save image.';
        exit;
    }

    echo 'Image saved successfully.';
} else {
    echo 'Invalid request method.';
    // Read the content of out.txt
    $content = file_get_contents('C:/xampp/htdocs/FaceRecognition/Recognition/out.txt');
    // Redirect to the retrieve page with the content as ecid
    if ($content !== false) {
        $ecid = urlencode(trim($content));
        header("Location: /IPFSapi/retrieve?ecid=$ecid");
        exit;
    } else {
        echo 'Failed to read out.txt';
        exit;
    }
}
?>
