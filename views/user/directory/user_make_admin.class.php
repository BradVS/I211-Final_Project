<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_make_admin
 *
 * @author Erin
 */
class UserMakeAdmin {

    private $admin_check;

    public function __construct($admin_check) {
        $this->admin_check = $admin_check;
    }

    public function display() {
        if ($this->admin_check == 'promoted') {
            header("Location: http://localhost/mvc_final/user/directory");
        }
        else{
            header("Location: http://localhost/mvc_final/user/directory?error_message=" . $this->admin_check);
        }
    }

}
