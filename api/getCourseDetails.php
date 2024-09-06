<?php
include("dbconfig.php");

// Check the request method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $length = $_POST['length'];
    $search = $_POST['search']['value'];

    if (empty($search)) {
        $sql = "SELECT DISTINCT c.id, c.name AS course, c.code AS course_code, cu.id, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id ORDER BY c.name, cu.name";
        $sql2 = "SELECT DISTINCT c.id, c.name AS course, c.code AS course_code, cu.id, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id ORDER BY c.name, cu.name";
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
        $sql = "SELECT DISTINCT c.id, c.name AS course, c.code AS course_code, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE (c.name LIKE '%{$search}%' OR cu.name LIKE '%{$search}%' OR cu.code LIKE '%{$search}%' OR c.code LIKE '%{$search}%') ORDER BY c.name, cu.name";
        $sql2 = "SELECT DISTINCT c.id, c.name AS course, c.code AS course_code, cu.name AS course_unit, cu.code, cu.credit_unit, cu.semester, cu.year FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE (c.name LIKE '%{$search}%' OR cu.name LIKE '%{$search}%' OR cu.code LIKE '%{$search}%' OR c.code LIKE '%{$search}%') ORDER BY c.name, cu.name";
        $sql .= " LIMIT {$start}, {$length}";
    }

    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $data[] = array(
            'course' => strtoupper($row['course']),
            'course_code' => $row['course_code'],
            'course_unit' => strtoupper($row['course_unit']),
            'code' => $row['code'],
            'credit_unit' => $row['credit_unit'],
            'year' => $row['year'],
            'semester' => $row['semester'],
            'edit' => '<a href="editcourse.php?id=' . urlencode(base64_encode(json_encode($id))) . '"><button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>'
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
