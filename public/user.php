<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

$userController = new UserController($pdo);

if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$message = '';
$messageType = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        $userController->logout();
        header('Location: login.php');
        exit;
    }

    if (isset($_POST['update_profile'])) {
        $newUsername = trim($_POST['new_username']);
        $currentProfilePhoto = $userController->getUserProfile($userId);
        $profilePhotoPath = $currentProfilePhoto;

        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/images/profile_photos/';
            
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = basename($_FILES['profile_photo']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExt, $allowedExtensions)) {
                $newFileName = uniqid('profile_', true) . '.' . $fileExt;
                $uploadFile = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadFile)) {
                    $profilePhotoPath = '/images/profile_photos/' . $newFileName;

                    // Delete old photo if it exists and is not the default
                    if ($currentProfilePhoto && $currentProfilePhoto !== '/NotesApp/public/images/default-avatar.png' && file_exists(__DIR__ . $currentProfilePhoto)) {
                        unlink(__DIR__ . $currentProfilePhoto);
                    }
                } else {
                    $message = "Помилка завантаження фото профілю.";
                }
            } else {
                $message = "Непідтримуваний формат файлу. Доступні формати: JPG, JPEG, PNG, GIF.";
            }
        }

        if (empty($message)) {
            $message = $userController->updateUserProfile($userId, $newUsername, $profilePhotoPath);
            $_SESSION['user_name'] = $newUsername;
            $messageType = 'success';
            header('Location: user.php');
            exit;
        }
    }

    if (isset($_POST['change_password'])) {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $message = "Всі поля обов'язкові для заповнення.";
            $messageType = 'error';
        } elseif ($newPassword !== $confirmPassword) {
            $message = "Паролі не співпадають!";
            $messageType = 'error';
        } else {
            $message = $userController->changeUserPassword($userId, $currentPassword, $newPassword);
            $messageType = ($message === 'Пароль успішно змінено!' || $message === 'Пароль успішно змінено.') ? 'success' : 'error';
        }
    }
}

// Get profile photo URL - this will be null if no photo is set
$profilePhotoUrl = $userController->getUserProfile($userId);

// Set default path for comparison in the view
$defaultAvatarPath = '/NotesApp/public/images/default-avatar.png';

include '../src/views/user.php';
?>