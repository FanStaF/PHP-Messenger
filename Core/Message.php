<?php

namespace Core;

/**
 * Holds the text of one message along with the name of its sender and recipiant
 */
class Message
{

    /**
     * Name of sender.
     * @var string
     */
    public $sender;
    /**
     * name of recipiant
     * @var string
     */
    public $recipiant;
    /**
     * text of the message
     * @var string
     */
    public $messageText;

    /**
     * Retrieve the text, sender and recipiand of the message.
     * @param array $message (senderID, recipiantID, message)
     */
    public function __construct(array $message)
    {
        $this->getSender($message);
        $this->getRecipiant($message);
        $this->messageText = $message['message'];
    }

    /**
     * Output the text of the message.
     * @return void
     */
    public function printmessage()
    {
        echo $this->messageText;
    }

    /**
     * Get full name of sender
     * @param mixed $message
     * @return void
     */
    protected function getSender($message)
    {
        $this->sender = $this->getName($message['senderID']);
    }

    /**
     * Get full name of recipiant
     * @param mixed $message
     * @return void
     */
    protected function getRecipiant($message)
    {
        $this->recipiant = $this->getName($message['recipiantID']);
    }

    /**
     * Get full name of of user iwth $ID
     * @param int $ID
     * @return string
     */
    protected function getName($ID)
    {
        $db = new Database();

        $user = $db->query("SELECT * FROM users WHERE userID = :ID", [
            'ID' => $ID
        ])->find();

        return $user['firstname'] . ' ' . $user['lastname'];
    }

}