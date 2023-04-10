<?php

namespace Core;

/**
 * Base class that retrievs, holds and provides access to information about a singel user.
 */
class User
{
    /**
     * user id
     * @var int
     */
    public $ID;
    /**
     * first name of user
     * @var string
     */
    public $firstname;
    /**
     * last name of user
     * @var string
     */
    public $lastname;
    /**
     * users email
     * @var string
     */
    public $email;

    /**
     * Retrieves information about user from database.
     * @param int $id
     */
    public function __construct($id)
    {
        $db = new Database();

        $user = $db->query('SELECT * FROM users WHERE userID = :ID', [
            'ID' => $id
        ])->find();

        $this->ID = $user['userID'];
        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        $this->email = $user['email'];

    }

    /**
     * Returns full name of user
     * @return string
     */
    public function fullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}