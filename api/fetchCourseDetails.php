<?php
include("dbconfig.php");

// Check the request method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $length = $_POST['length'];
    $search = $_POST['search']['value'];

    if (empty($search)) {
        $sql = "SELECT DISTINCT c.name AS course, c.code AS course_code, cu.id, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE (cu.credit_unit = 0 OR cu.year = 0 OR cu.semester = 0) ORDER BY c.name, cu.name";
        $sql2 = "SELECT DISTINCT c.name AS course, c.code AS course_code, cu.id, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE (cu.credit_unit = 0 OR cu.year = 0 OR cu.semester = 0) ORDER BY c.name, cu.name";
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
        $sql = "SELECT DISTINCT c.name AS course, c.code AS course_code, cu.id, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE (cu.credit_unit = 0 OR cu.year = 0 OR cu.semester = 0) ORDER BY c.name, cu.name";
        // OR cu.code LIKE '%{$search}%'
        //          OR cu.semester LIKE '%{$search}%'
        //          OR cu.year LIKE '%{$search}%'
        $sql2 = "SELECT DISTINCT c.name AS course, c.code AS course_code, cu.id, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE (cu.credit_unit = 0 OR cu.year = 0 OR cu.semester = 0) ORDER BY c.name, cu.name";
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
        $id = $row['id'];
        $data[] = array(
            'course' => ucwords($row['course']),
            'course_code' => $row['course_code'],
            'course_unit' => $row['course_unit'],
            'code' => $row['code'],
            'credit_unit' => $row['credit_unit'],
            'year' => $row['year'],
            'semester' => $row['semester'],
            'edit' => '<a href="updatecourse.php?id=' . urlencode(base64_encode(json_encode($id))) . '"><button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>'
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
