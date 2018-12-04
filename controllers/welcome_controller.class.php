<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/08/2018
 * File: welcome_controller.class.php
 * Description: This scripts define the class for the welcome controller; this is the default controller. 
 * This allows the webpage to display the homepage.
 * 
 */

class WelcomeController {
    //put your code here
    public function index() {
        $view = new WelcomeIndex();
        $view->display();
    }
}