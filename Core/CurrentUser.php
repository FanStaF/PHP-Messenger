<?php

namespace Core;

use Core\Message;
use Core\User;

//
// CurrentUser manages and provides access to the personal information,
// messages, and friends for the current user
//  
class CurrentUser extends User
{
    // public variables
    public Friends $myFriends;

    // private variables
    protected Database $db;

    // constructor
    public function __construct($ID)
    {
        parent::__construct($ID);

        $this->myFriends = new Friends($ID);

        $this->db = new Database();

    }

    // Returns an array with a message object for each of the users messages
    public function retrieveMymessages()
    {
        $messageIDs = $this->db->query('SELECT * FROM messages WHERE recipiantID = :ID', [
            'ID' => $this->ID
        ])->getAll();

        $messages = [];
        $messageCounter = 1;

        foreach ($messageIDs as $message) {
            $messages[$messageCounter] = new Message($message);
            $messageCounter++;
        }

        return $messages;
    }

    //returns a array with all users full name and id: 'id' => 'name'
    public function getAllUsers($excludeCurrentUser = true)
    {
        // Get all user IDs except the current user
        $allIds = $this->db->query("SELECT userID FROM users WHERE userID <> {$this->ID}")->getColumn();

        $counter = 0;
        $allUsers = [];

        foreach ($allIds as $id) {

            $firstname = $this->db->query("SELECT firstname FROM users WHERE userID = {$id}")->getString();
            $lastname = $this->db->query("SELECT lastname FROM users WHERE userID = {$id}")->getString();

            $name = "{$firstname} {$lastname}";

            $allUsers[$counter] = [
                'name' => $name,
                'id' => $id
            ];
            $counter++;

        }

        return $allUsers;

    }
}