<?php

namespace Core;

use Core\Message;

class User
{
    public int $ID;

    public Friends $myFriends;

    protected array $user;

    protected Database $db;

    protected $myRecievedMessages = [];

    public function __construct($ID)
    {
        $this->ID = $ID;

        $this->myFriends = new Friends();

        $this->db = new Database();
        $this->retrieveUser();
        $this->retrieveMyRecievedMessages();
    }

    protected function retrieveUser()
    {
        $this->user = $this->db->query('SELECT * FROM users WHERE userID = :ID', [
            'ID' => $this->ID
        ])->find();
    }

    protected function retrieveMyRecievedMessages()
    {
        $returnedMessages = $this->db->query('SELECT * FROM messages WHERE recipiantID = :ID', [
            'ID' => $this->ID
        ])->getAll();

        $messageCounter = 1;
        foreach ($returnedMessages as $message) {
            $this->myRecievedMessages[$messageCounter] = new Message($message);
            $messageCounter++;
        }
    }

    public function getFirstname()
    {
        return $this->user['firstname'];
    }
    public function getLastname()
    {
        return $this->user['lastname'];
    }
    public function getEmail()
    {
        return $this->user['email'];
    }

    public function getFullName()
    {
        return $this->user['firstname'] . ' ' . $this->user['lastname'];
    }

    public function getMyRecievedMessages()
    {
        return $this->myRecievedMessages;
    }

    //returns a array with all users full name and id: 'id' => 'name'
    public function getAllUsers($excludeCurrentUser = true)
    {
        $allIds = $this->db->query("SELECT userID FROM users")->getColumn();

        $counter = 0;
        $allUsers = [];
        foreach ($allIds as $id) {
            if($id !== $this->ID ){

                $firstname = $this->db->query("SELECT firstname FROM users WHERE userID = {$id}")->getString();
                $lastname = $this->db->query("SELECT lastname FROM users WHERE userID = {$id}")->getString();
                
                $name = "{$firstname} {$lastname}";
                
                $allUsers[$counter] = [
                    'name' => $name,
                    'id' => $id
                ];
                $counter++;
            }
        }

        return $allUsers;

    }
}