<?php

use Core\Database;
use Core\CurrentUser;

$currentUser = new CurrentUser($_SESSION['user']);
$currentFriendsList = $currentUser->myFriends->listOfIDs;

$ids = array_keys($_POST);

$db = new Database();

// Delete all entries in friends that has current user
$db->query("DELETE FROM friends WHERE requesterID = :id OR accepterID = :id",[
    'id' => $_SESSION['user']
]);

// Add back new selection of friends
foreach($ids as $id){
    $db->query("INSERT INTO friends (requesterID, accepterID) VALUES (:userID, :friendID)", [
        'userID' => $_SESSION['user'],
        'friendID' => $id]);
}

header('location: /friends');

