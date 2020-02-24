<?php
require('./dump.php');
require('./db.php');

// 1st query
$sql = "SELECT name FROM department 
        WHERE (
            SELECT COUNT(*) FROM worker 
            WHERE department_id = department.id
        ) >= 5";

$res = mysqli_query($db, $sql);

if (!$res) {
  die('Error: ' . mysqli_error($db));
}

dump(mysqli_fetch_all($res));

// 2nd query
$sql = "SELECT name, (
    SELECT GROUP_CONCAT(id) FROM worker WHERE department_id = department.id
    ) FROM department";

$res = mysqli_query($db, $sql);

if (!$res) {
  die('Error: ' . mysqli_error($db));
}

dump(mysqli_fetch_all($res));
