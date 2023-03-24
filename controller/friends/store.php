<?php

use Core\Database;
use Core\User;

$currentUser = new User($_SESSION['user']);
$currentFriendsList = $currentUser->myFriends->getFriendIDs();

$ids = array_keys($_POST);

$db = new Database();

//delete all entries in friends that has current user
$db->query("DELETE FROM friends WHERE requesterID = :id OR accepterID = :id",[
    'id' => $_SESSION['user']
]);

foreach($ids as $id){
    $db->query("INSERT INTO friends (requesterID, accepterID) VALUES (:userID, :friendID)", [
        'userID' => $_SESSION['user'],
        'friendID' => $id]);
}

header('location: /friends');
   
// drop all friend records with current user
// add back all checked friends
