<?php
header('Content-Type: application/json; charset=utf-8');

$file = __DIR__ . '/tasks.json';

function loadTasks($file) {
    if (!file_exists($file)) return [];
    $raw = file_get_contents($file);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function saveTasks($file, $tasks) {
    file_put_contents($file, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    echo json_encode(['ok' => true, 'data' => loadTasks($file)]);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $action = $input['action'] ?? '';

    $tasks = loadTasks($file);

    if ($action === 'add') {
        $title = trim($input['title'] ?? '');
        if ($title === '') {
            echo json_encode(['ok' => false, 'error' => 'Tiêu đề không được rỗng']);
            exit;
        }
        $nextId = empty($tasks) ? 1 : (max(array_column($tasks, 'id')) + 1);
        $tasks[] = ['id' => $nextId, 'title' => $title, 'done' => false];
        saveTasks($file, $tasks);
        echo json_encode(['ok' => true, 'data' => $tasks]);
        exit;
    }

    if ($action === 'toggle') {
        $id = intval($input['id'] ?? 0);
        foreach ($tasks as &$t) {
            if ($t['id'] === $id) { $t['done'] = !$t['done']; break; }
        }
        saveTasks($file, $tasks);
        echo json_encode(['ok' => true, 'data' => $tasks]);
        exit;
    }

    if ($action === 'delete') {
        $id = intval($input['id'] ?? 0);
        $tasks = array_values(array_filter($tasks, fn($t) => $t['id'] !== $id));
        saveTasks($file, $tasks);
        echo json_encode(['ok' => true, 'data' => $tasks]);
        exit;
    }

    echo json_encode(['ok' => false, 'error' => 'Action không hợp lệ']);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
