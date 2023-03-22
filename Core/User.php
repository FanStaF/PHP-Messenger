<?php

namespace Core;

use Core\Message;

class User
{
    public int $id;

    protected array $user;
    protected $myRecievedMessages = [];

    public function __construct($id)
    {
        $this->id = $id;
        $db = new Database();
        $this->retrieveUser($db);
        $this->retrieveMyRecievedMessages($db);
    }

    protected function retrieveUser($db)
    {
        $this->user = $db->query('SELECT * FROM users WHERE userid = :id', [
            'id' => $this->id
        ])->find();
    }

    protected function retrieveMyRecievedMessages($db)
    {
        $returnedMessages = $db->query('SELECT * FROM messages WHERE recipiantId = :id', [
            'id' => $this->id
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


}