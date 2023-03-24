<?php

namespace Core;

class Friends
{
    public array $friendsIDList;

    protected Database $db;

    public function __construct()
    {

        $this->db = new Database();
        $this->friendsIDList = $this->getFriendIDs();
    }


    public function requestFriend()
    {

    }

    public function acceptFriend()
    {

    }

    public function dropFriend()
    {

    }
    public function getFriendName($friendID)
    {

        $firstname = $this->db->query("SELECT firstname FROM users WHERE userID = {$friendID}")->getString();
        $lastname = $this->db->query("SELECT lastname FROM users WHERE userID = {$friendID}")->getString();

        return "{$firstname} {$lastname}";

    }
    public function getFriendIDs()
    {
        return $this->db->query("SELECT accepterID FROM friends WHERE requesterID = {$_SESSION['user']}
                            UNION
                            SELECT requesterID FROM friends WHERE accepterID = {$_SESSION['user']}")->getColumn();
    }
}