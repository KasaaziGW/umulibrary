<?php
if (isset($_GET['doc'])) {
    $filename = json_decode(base64_decode($_GET['doc']), true);
    $filename .= '.pdf';
    if ($filename) {
        $filePath = './past_papers/' . $filename;
        // debugging
        // $fp = fopen("test_download.txt", "w");
        // fprintf($fp, $filename);
        // fprintf($fp, "\r\n");
        // fprintf($fp, $filePath);
        if (file_exists($filePath)) {
            // Set headers to force download
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit();
            echo "This won't be reached";
        } else {
            echo "File not found!";
        }
    } else {
        echo "Invalid file ID!";
    }
}
