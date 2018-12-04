<?php

/* Author: Bradley Stegbauer
 * Date: 11/06/2018
 * Name: database.class.php
 * Description: the Database class sets the database details.
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'dvdrental_db',
        'tblDvds' => 'stock',
        'tblDvdRating' => 'dvd_ratings',
        'tblUser' => 'users',
        'tblCheckout' => 'checkout',
        'tblCheckin' => 'checkin'
    );
     //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    public function __construct() {

        $this->objDBConnection = @new mysqli(
                        $this->param['host'],
                        $this->param['login'],
                        $this->param['password'],
                        $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            exit("Connecting to database failed: " . mysqli_connect_error());
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table storing books
    public function getUserTable() {
        return $this->param['tblUser'];
    }
    
    //returns the name of the table storing dvds/stock
    public function getDvdTable() {
        return $this->param['tblDvds'];
    }
    
    //returns the name of the table storing movie ratings
    public function getDvdRatingTable() {
        return $this->param['tblDvdRating'];
    }
    
    //returns the name of the check ins table
    public function getCheckinTable(){
        return $this->param['tblCheckin'];
    }
    
    //returns the name of the check outs table
    public function getCheckoutTable() {
        return $this->param['tblCheckout'];
    }
}