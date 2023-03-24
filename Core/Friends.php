<?php

namespace Core;

//
// Friends stores a list of IDs for a users friends and
// provides access to to each friends full name.
//
class Friends
{
    // public variables
    public array $listOfIDs;

    // prodected variables
    protected Database $db;

    // constructor
    public function __construct($userID)
    {
        $this->db = new Database();
        $this->listOfIDs = $this->getFriendIDs($userID);
    }

    // returns string holding full name of friend with $friendsID
    public function getFriendName($friendID)
    {

        $firstname = $this->db->query("SELECT firstname FROM users WHERE userID = {$friendID}")->getString();
        $lastname = $this->db->query("SELECT lastname FROM users WHERE userID = {$friendID}")->getString();

        return "{$firstname} {$lastname}";
    }

    // returnes an array holding the IDs of all friends for user with id=$userID
    protected function getFriendIDs($userID)
    {
        return $this->db->query("SELECT accepterID FROM friends WHERE requesterID = {$userID}
                            UNION
                            SELECT requesterID FROM friends WHERE accepterID = {$userID}")->getColumn();
    }
}