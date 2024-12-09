<?php
// Check if the file parameter is set
if(isset($_GET['file'])) {
    $filePath = $_GET['file'];
    
    // Check if the file exists
    if(file_exists($filePath)) {
        // Set appropriate headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        echo "hello";
        // Read the file and output its contents
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
