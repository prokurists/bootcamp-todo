<?php

include "functions.php";

header('Content-Type: application/json');

$output = [
    'status' => false
];
if (
    isset($_POST['task']) &&
    is_string($_POST['task']) &&
    !empty($_POST['task'])
) {
    $tasks = getTasks();

    $output['id'] = count($tasks);
    $output['task'] = addTask($tasks, $_POST['task']);
    $output['status'] = true;
}

echo json_encode($output, JSON_PRETTY_PRINT);