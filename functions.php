<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function isPage(string $page_name, string $class = 'active') {
    if (isset($_GET['page']) && $_GET['page'] === $page_name) {
        return $class;
    }
}

function addTask($tasks, $task_message) {
    $task = htmlentities($task_message, ENT_QUOTES);
    $tasks[] = $task;

    file_put_contents('tasks_data.json', json_encode($tasks));

    return $task;
}

function getTasks() {
    $file_name = 'tasks_data.json';
    $tasks = [];
    if (file_exists($file_name)) {
        $tasks = json_decode(file_get_contents($file_name), true);
        if (!is_array($tasks)) {
            $tasks = [];
        }
    }
    return $tasks;
}

