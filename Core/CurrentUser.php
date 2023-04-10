<?php

namespace Core;

use Core\Message;
use Core\User;

/**
* Manages and provides access to the personal information,
* messages, and friends for the current user
* 
*/
  
class CurrentUser extends User
{
    /**
     * Array of integerts holding id of friends
     * @var Friends
     */
    public Friends $myFriends;

    /**
     * Holds Database object that provides access to the database
     * @var Database
     */
    protected Database $db;

    /**
     * initializes database and retrieves list of id for all friends
     * @param int $ID
     */
    public function __construct($ID)
    {
        parent::__construct($ID);

        $this->db = new Database();
        
        $this->myFriends = new Friends($ID);
    }

    /**
     * Returns an array with a Message object for each message.
     * 
     * @return array<Message>
     */
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

    /**
     * Returns array with strings holding all users full name.
     * 
     * @param bool $excludeCurrentUser set to false to include current user
     * @return array of strings
     */
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