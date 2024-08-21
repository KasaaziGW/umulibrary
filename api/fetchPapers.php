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
        $sql = "SELECT cu.name, cu.code, cu.semester, cu.year, e.filename, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id = $cu_id";
        $sql2 = "SELECT cu.name, cu.code, cu.semester, cu.year, e.filename, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id = $cu_id";
        $sql .= " LIMIT {$start}, {$length}";
    } else {
        // $fp = fopen("test_queries_1.txt", "w");
        // fprintf($fp, "Something is wrong here!");
        // fprintf($fp, "\r\n");
        // fprintf($fp, "Search: $search");
        // fprintf($fp, "\r\n");
        // fprintf($fp, "id: $cu_id");
        // fprintf($fp, "\r\n");
        // fprintf($fp, "draw: $draw");
        // fprintf($fp, "\r\n");
        // fprintf($fp, "start: $start");
        // fprintf($fp, "\r\n");
        // fprintf($fp, "length: $length");
        $sql = "SELECT cu.name, cu.code, cu.semester, cu.year, e.filename, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id = $cu_id";
        // OR cu.code LIKE '%{$search}%'
        //          OR cu.semester LIKE '%{$search}%'
        //          OR cu.year LIKE '%{$search}%'
        $sql2 = "SELECT cu.name, cu.code, cu.semester, cu.year, e.filename, e.size, e.date FROM exams e JOIN exam_course_units ecu ON e.id = ecu.exam_id JOIN course_units cu ON ecu.course_unit_id = cu.id WHERE cu.id = $cu_id";
        // OR cu.code LIKE '%{$search}%'
        //          OR cu.semester LIKE '%{$search}%'
        //          OR cu.year LIKE '%{$search}%'
        $sql .= " LIMIT {$start}, {$length}";
    }
    // $fp = fopen("test_queries.txt", "w");
    // fprintf($fp, "\r\n");
    // fprintf($fp, $sql);
    // fprintf($fp, "\r\n");
    // fprintf($fp, $sql2);

    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $filename = $row['filename'];
        $data[] = array(
            'code' => strtoupper($row['code']),
            'name' => $row['name'],
            'year' => $row['year'],
            'semester' => $row['semester'],
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
