<?php
use Core\Database;
use Core\Validator;

$message = $_POST['messageText'];
$messageTo = $_POST['messageTo'];

if (!Validator::string($message, 4, 1024)) {
    // return to create.view if message is of invalid length
    return view('messages/create.view.php', [
        '$error' => "Invalid message length. (4-1024)"
    ]);
} else {
    $db = new Database();

    $db->query("INSERT INTO messages (senderID, recipiantID, message) VALUES(:senderID, :recipiantID, :message)", [
        'senderID' => $_SESSION['user'],
        'recipiantID' => $messageTo,
        'message' => $message
    ]);

    view('messages/sent.view.php');
}