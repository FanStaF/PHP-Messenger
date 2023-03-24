<?php

namespace Core;

// message stores the text of one message along with the name of its sender and recipiant
class Message
{

    // public variables
    public $sender;
    public $recipiant;
    public $messageText;

    // constructor
    public function __construct(array $message)
    {
        $this->getSender($message);
        $this->getRecipiant($message);
        $this->messageText = $message['message'];
    }

    // print the text of the message
    public function printmessage()
    {
        echo $this->messageText;
    }

    // returns full name of the messages sender
    protected function getSender($message)
    {
        $this->sender = $this->getName($message['senderID']);
    }

    // returns the full name of the message recipiant
    protected function getRecipiant($message)
    {
        $this->recipiant = $this->getName($message['recipiantID']);
    }

    // returns the full name of user with id=$ID
    protected function getName($ID)
    {
        $db = new Database();

        $user = $db->query("SELECT * FROM users WHERE userID = :ID", [
            'ID' => $ID
        ])->find();

        return $user['firstname'] . ' ' . $user['lastname'];
    }

}