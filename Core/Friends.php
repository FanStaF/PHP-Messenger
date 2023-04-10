<?php

namespace Core;

/**
 * Stores list of friend ids and provides access to friends full name.
 */
class Friends
{
    /**
     * List holding friends ids
     * @var array<int>
     */
    public array $listOfIDs;

    /**
     * Database object for accessing database.
     * @var Database
     */
    protected Database $db;

    /**
     * Creates database object and retrievs list of friends ids.
     * @param int $userID id of user
     */
    public function __construct($userID)
    {
        $this->db = new Database();
        $this->listOfIDs = $this->getFriendIDs($userID);
    }

    /**
     * Get full name of friend.
     * @param int $friendID
     * @return string
     */
    public function getFriendName($friendID)
    {

        $firstname = $this->db->query("SELECT firstname FROM users WHERE userID = {$friendID}")->getString();
        $lastname = $this->db->query("SELECT lastname FROM users WHERE userID = {$friendID}")->getString();

        return "{$firstname} {$lastname}";
    }

    /**
     * Retrievs a list holding ids of all friends of $userID.
     * @param int $userID
     * @return array
     */
    protected function getFriendIDs($userID)
    {
        return $this->db->query("SELECT accepterID FROM friends WHERE requesterID = {$userID}
                            UNION
                            SELECT requesterID FROM friends WHERE accepterID = {$userID}")->getColumn();
    }
}