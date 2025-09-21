<?php
// api.php
header('Content-Type: application/json');
require_once "db.php";
require_once "validation.php";

// Разрешаем CORS для тестирования
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit();
}

try {
    $db = connectDatabase();
    
    // Проверяем, переданы ли данные как JSON или form-data
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (json_last_error() === JSON_ERROR_NONE && $input) {
        // Обработка JSON данных
        $response = processJsonData($db, $input);
    } else {
        // Обработка form-data (включая файлы)
        $response = processFormData($db);
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}

function processJsonData($db, $data) {
    // Валидация обязательных полей
    if (!isset($data['user_id']) || !isset($data['description'])) {
        return ['error' => 'Missing required fields: user_id and description are required'];
    }
    
    // Проверяем существование пользователя
    $stmt = $db->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$data['user_id']]);
    if (!$stmt->fetch()) {
        return ['error' => 'User not found'];
    }
    
    // Подготовка данных для вставки
    $imagePath = isset($data['image_url']) ? $data['image_url'] : '';
    $likeCount = isset($data['like_count']) ? (int)$data['like_count'] : 0;
    
    // Вставляем пост в БД
    $stmt = $db->prepare("
        INSERT INTO posts (user_id, image, description, like_count, created_at) 
        VALUES (?, ?, ?, ?, NOW())
    ");
    
    $stmt->execute([
        $data['user_id'],
        $imagePath,
        trim($data['description']),
        $likeCount
    ]);
    
    $postId = $db->lastInsertId();
    
    return [
        'success' => true,
        'message' => 'Post created successfully',
        'post_id' => $postId
    ];
}

function processFormData($db) {
    // Проверяем обязательные поля
    if (!isset($_POST['user_id']) || !isset($_POST['description'])) {
        return ['error' => 'Missing required fields: user_id and description are required'];
    }
    
    $userId = (int)$_POST['user_id'];
    $description = trim($_POST['description']);
    
    // Проверяем существование пользователя
    $stmt = $db->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    if (!$stmt->fetch()) {
        return ['error' => 'User not found'];
    }
    
    // Обработка загрузки изображения
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = saveUploadedImage($_FILES['image']);
    }
    
    // Вставляем пост в БД
    $stmt = $db->prepare("
        INSERT INTO posts (user_id, image, description, like_count, created_at) 
        VALUES (?, ?, ?, ?, NOW())
    ");
    
    $likeCount = isset($_POST['like_count']) ? (int)$_POST['like_count'] : 0;
    
    $stmt->execute([
        $userId,
        $imagePath,
        $description,
        $likeCount
    ]);
    
    $postId = $db->lastInsertId();
    
    return [
        'success' => true,
        'message' => 'Post created successfully',
        'post_id' => $postId,
        'image_path' => $imagePath
    ];
}

function saveUploadedImage($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    // Проверка типа файла
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Invalid file type. Allowed: JPEG, PNG, GIF, WEBP');
    }
    
    // Проверка размера файла
    if ($file['size'] > $maxSize) {
        throw new Exception('File too large. Maximum size: 5MB');
    }
    
    // Создаем папку images если не существует
    if (!file_exists('../src/images/')) {
        mkdir('../src/images/', 0777, true);
    }
    
    // Генерируем уникальное имя файла
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('post_') . '.' . $extension;
    $destination = '../src/images/' . $filename;
    
    // Перемещаем файл
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception('Failed to save image');
    }
    
    return '../src/images/' . $filename;
}
?>