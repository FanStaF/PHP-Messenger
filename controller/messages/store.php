<?php
use Core\Database;
use Core\Validator;

$message = $_POST['messageText'];

if (!Validator::string($message, 4, 1024)) {
    return view('messages/create.view.php', [
        '$error' => "Invalid message length. (4-1024)"
    ]);
} else {
    $db = new Database();

    $db->query("INSERT INTO messages (senderId, recipiantId, message) VALUES(:senderId, :recipiantId, :message)", [
        'senderId' => $_SESSION['user'],
        'recipiantId' => 7,
        'message' => $message
    ]);

    view('messages/sent.view.php');
}