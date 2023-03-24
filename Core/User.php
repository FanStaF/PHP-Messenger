<?php

namespace Core;

//
// User is a base class that retrieves and holds the information
// about a single user and provides access their info.
//
class User
{
    // public variables
    public $ID;
    public $firstname;
    public $lastname;
    public $email;

    //constructor
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

    // returns the full name of User
    public function fullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}