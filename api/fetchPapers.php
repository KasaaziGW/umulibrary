<?php
include("dbconfig.php");
// converting the file size
function convertFileSize($sizeInBytes)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $size = $sizeInBytes;
    $unitIndex = 0;
    while ($size >= 1024 && $unitIndex < count($units) - 1) {
        $size /= 1024;
        $unitIndex++;
    }
    return number_format($size, 2) . ' ' . $units[$unitIndex];
}
// Check the request method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $length = $_POST['length'];
    $search = $_POST['search']['value'];
    $cu_id = $_POST['courseUnit'];

    if (empty($search)) {
        $sql = "SELECT cu.name, e.filename, e.caption, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id= $cu_id";
        $sql2 = "SELECT cu.name, e.filename, e.caption, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id= $cu_id";
        $sql .= " LIMIT {$start}, {$length}";
    } else {
        $sql = "SELECT cu.name, e.filename, e.caption, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id= $cu_id";
        $sql2 = "SELECT cu.name, e.filename, e.caption, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id= $cu_id";
        $sql .= " LIMIT {$start}, {$length}";
    }
    // $fp = fopen("test_queries.txt", "w");
    // fprintf($fp, $sql);
    // fprintf($fp, "\r\n");
    // fprintf($fp, $sql2);

    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $filename = $row['filename'];
        $data[] = array(
            'name' => $row['name'],
            'caption' => $row['caption'],
            'exam_date' => $row['date'],
            'size' => convertFileSize($row['size']),
            'download' => '<a href="downloadpaper.php?doc=' . urlencode(base64_encode(json_encode($filename))) . '"><button class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></button></a>'
        );
    }

    // Return the data in JSON format
    echo json_encode(array(
        'draw' => $draw,
        'recordsTotal' => mysqli_num_rows($result2),
        'recordsFiltered' => mysqli_num_rows($result2),
        'data' => $data
    ));

    exit;
}


$conn->close();
