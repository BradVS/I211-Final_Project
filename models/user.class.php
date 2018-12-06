<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Erin
 */
class User {
    //fields for user object
    private $username, $name, $email, $account_type;
    //
    public function __construct($username, $name, $email, $account_type) {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->account_type = $account_type;
    }
    function getUsername() {
        return $this->username;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getAccount_type() {
        return $this->account_type;
    }


    
}
