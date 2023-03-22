<?php

namespace Core;

class Message
{

    public $sender;
    public $recipiant;
    public $messageText;

    public function __construct(array $message)
    {
       $this->getSender($message);
       $this->getRecipiant($message);
       $this->messageText = $message['message'];
    }

    public function printMessage()
    {
        echo $this->messageText;
    }


    protected function getSender($message)
    {
        $this->sender = $this->getName($message['senderId']);
    }

    protected function getRecipiant($message)
    {
        $this->recipiant = $this->getName($message['recipiantId']);
    }
    
    protected function getName($id)
    {
        
        $db = new Database();

        $user = $db->query("SELECT * FROM users WHERE userId = :id", [
        'id' => $id
        ])->find();
        
        return $user['firstname'] . ' ' . $user['lastname'];
    }

}