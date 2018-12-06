<?php

/*
 * Author: Bradley Stegbauer
 * Date: 11/08/2018
 * Name: dvd_controller.class.php
 * Description: This class is the controller for dvds, and handles all user actions regarding dvds
 */

class DvdController {
    //put your code here
    private $dvd_model;

    //default constructor
    public function __construct() {
        //create an instance of the DvdModel class
        $this->dvd_model = DvdModel::getDvdModel();
    }

    //index action that displays all dvds
    public function index() {
        //retrieve all dvds and store them in an array
        $dvds = $this->dvd_model->list_dvd();

//        if (!$dvds) {
//            //display an error
//            $message = "There was a problem displaying dvds.";
//            $this->error($message);
//            return;
//        }
        if(!is_array($dvds)){
            if(strpos($dvds, "Error:") !== false){
                //display an error
                $message = "There was a problem displaying dvds.";
                $this->error($message, $dvds);
                return;
            }
        }
        

        // display all dvds
        $view = new DvdIndex();
        $view->display($dvds);
    }
    
    //show details of a dvd
    public function detail($id) {
        //retrieve the specific dvd
        $dvd = $this->dvd_model->view_dvd($id);

//        if (!$dvd) {
//            //display an error
//            $message = "There was a problem displaying the dvd id='" . $id . "'.";
//            $this->error($message);
//            return;
//        }
        if(!is_object($dvd)){
            if(strpos($dvd, "Error:") !== false){
                //display an error
                $message = "There was a problem displaying the dvd id='" . $id . "'.";
                $this->error($message, $dvd);
                return;
            }
        }
        

        //display dvd details
        $view = new DvdDetail();
        $view->display($dvd);
    }

    //display a dvd in a form for editing
    //ADMIN ONLY FUNCTION
    public function edit($id) {
        //retrieve the specific dvd
        $dvd = $this->dvd_model->view_dvd($id);

//        if (!$dvd) {
//            //display an error
//            $message = "There was a problem displaying the dvd id='" . $id . "'.";
//            $this->error($message);
//            return;
//        }
        if(!is_object($dvd)){
            if(strpos($dvd, "Error:") !== false){
                //display an error
                $message = "There was a problem displaying the dvd id='" . $id . "'.";
                $this->error($message, $dvd);
                return;
            }
        }
        

        $view = new DvdEdit();
        $view->display($dvd);
    }

    //update a dvd in the database
    //ADMIN ONLY FUNCTION
    public function update($id) {
        //update the dvd
        $update = $this->dvd_model->update_dvd($id);
//        if (!$update) {
//            //handle errors
//            $message = "There was a problem updating the dvd id='" . $id . "'.";
//            $this->error($message);
//            return;
//        }
        
        if(strpos($update, "Error:") !== false){
            //handle errors
            $message = "There was a problem updating the dvd id='" . $id . "'.";
            $this->error($message, $update);
            return;
        } else {
            //display the updateed dvd details
            $confirm = "The dvd was successfully updated.";
            $dvd = $this->dvd_model->view_dvd($id);

            $view = new DvdDetail();
            $view->display($dvd, $confirm);
        }

        
    }


    //ADMIN ONLY
    public function add() {
        
        $view = new DvdAdd();
        $view ->display();
    }




    //add  a dvd to the database
    //ADMIN ONLY FUNCTION
    public function insert() {
        //update the dvd
        $add = $this->dvd_model->insert_dvd();
//        if (!$add) {
//            //handle errors
//            $message = "There was a problem adding the dvd";
//            $this->error($message);
//            return;
//        }
        if(!is_bool($add)){
            if(strpos($add, "Error:") !== false){
                //handle errors
                $message = "There was a problem adding the dvd";
                $this->error($message, $add);
                return;
            }
        }
        

        //return the user to the dvd index page
        $this->index();
    }

    //search dvds
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all dvds
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching dvds
        $dvds = $this->dvd_model->search_dvd($query_terms);

//        if ($dvds === false) {
//            //handle error
//            $message = "An error has occurred.";
//            $this->error($message);
//            return;
//        }
        if(!is_array($dvds)){
            if(strpos($dvds, "Error:") !== false){
                //handle error
                $message = "An error has occurred.";
                $this->error($message, $dvds);
                return;
            }
        }
        
        //display matched dvds
        $search = new DvdSearch();
        $search->display($query_terms, $dvds);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $dvds = $this->dvd_model->search_dvd($query_terms);

        //retrieve all dvd titles and store them in an array
        $titles = array();
        if ($dvds) {
            foreach ($dvds as $dvd) {
                $titles[] = $dvd->getTitle();
            }
        }

        echo json_encode($titles);
    }
    
    public function rent($id){
        $rent = $this->dvd_model->rent_dvd($id);
        
        if (strpos($rent, "Error:") !== false) {
            //handle errors
            $message = "An error has occured.";
            $this->error($message, $rent);
            return;
        }
        
        //sends user to the confirmation page
        $confirm = new DvdRentConfirm();
        $confirm->display($rent);

        //return the user to the dvd index page
        // $this->index();
    }
    
    //handle an error
    public function error($message, $err) {
        //create an object of the Error class
        $error = new DvdError();

        //display the error page
        $error->display($message, $err);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }
}
