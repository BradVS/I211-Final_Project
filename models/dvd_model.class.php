<?php

/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * File: dvd_model.class.php
 * Description: the dvd model
 * 
 */

class DvdModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblDvd;
    private $tblDvdRating;
    private $tblCheckout;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getDvdModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblDvd = $this->db->getDvdTable();
        $this->tblDvdRating = $this->db->getDvdRatingTable();
        $this->tblCheckout = $this->db->getCheckoutTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize dvd ratings
        if (!isset($_SESSION['dvd_ratings'])) {
            $ratings = $this->get_dvd_ratings();
            $_SESSION['dvd_ratings'] = $ratings;
        }
    }

    //static method to ensure there is just one DvdModel instance
    public static function getDvdModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new DvdModel();
        }
        return self::$_instance;
    }

    /*
     * the list_dvd method retrieves all dvds from the database and
     * returns an array of Dvd objects if successful or false if failed.
     * Dvds should also be filtered by ratings and/or sorted by titles or rating if they are available.
     */

    public function list_dvd() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblDvd . "," . $this->tblDvdRating .
                " WHERE " . $this->tblDvd . ".rating=" . $this->tblDvdRating . ".rating_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no dvd was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned dvds
        $dvds = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $dvd = new Dvd(stripslashes($obj->title), stripslashes($obj->runtime), stripslashes($obj->rating), stripslashes($obj->description), stripslashes($obj->release_date), stripslashes($obj->director), stripslashes($obj->price), stripslashes($obj->image), stripslashes($obj->available));

            //set the id for the dvd
            $dvd->setId($obj->id);

            //add the dvd into the array
            $dvds[] = $dvd;
        }
        return $dvds;
    }

    /*
     * the viewDvd method retrieves the details of the dvd specified by its id
     * and returns a dvd object. Return false if failed.
     */

    public function view_dvd($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblDvd . "," . $this->tblDvdRating .
                " WHERE " . $this->tblDvd . ".rating=" . $this->tblDvdRating . ".rating_id" .
                " AND " . $this->tblDvd . ".id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a dvd object
            $dvd = new Dvd(stripslashes($obj->title), stripslashes($obj->runtime), stripslashes($obj->rating), stripslashes($obj->description), stripslashes($obj->release_date), stripslashes($obj->director), stripslashes($obj->price), stripslashes($obj->image), stripslashes($obj->available));
            
            //set the id for the dvd
            $dvd->setId($obj->id);

            return $dvd;
        }

        return false;
    }

    //the update_dvd method updates an existing dvd in the database. Details of the dvd are posted in a form. Return true if succeed; false otherwise.
    public function update_dvd($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'runtime') ||
                !filter_has_var(INPUT_POST, 'rating') ||
                !filter_has_var(INPUT_POST, 'release_date') ||
                !filter_has_var(INPUT_POST, 'director') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'available') ||
                !filter_has_var(INPUT_POST, 'rating')) {

            return false;
        }

        //retrieve data for the new dvd; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $runtime = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'runtime', FILTER_SANITIZE_STRING)));
        $rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING)));
        $release_date = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'release_date', FILTER_DEFAULT));
        $director = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'director', FILTER_SANITIZE_STRING)));
        $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));
        $available = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'available', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "UPDATE " . $this->tblDvd .
                " SET title='$title', runtime='$runtime', rating='$rating', release_date='$release_date', director='$director', "
                . "price='$price', image='$image', description='$description', available='$available' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    //add a new DVD to the database
    public function insert_dvd() {
        //trigger the function when the button in clicked.
    if (!empty($_POST['title'])&& !FALSE) {
            $title =  filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
            $runtime = filter_input(INPUT_POST, 'runtime', FILTER_SANITIZE_NUMBER_INT);
            $rating = filter_input(INPUT_POST, "rating", FILTER_SANITIZE_STRING);
            $release_date = filter_input(INPUT_POST, 'release_date', FILTER_DEFAULT);
            $director = filter_input(INPUT_POST, "director", FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
            $available = filter_input(INPUT_POST, 'available', FILTER_SANITIZE_NUMBER_INT);

           

            //Insert data into table
            //query string for INSERT 
            $sql = "INSERT INTO " . $this->tblDvd . " VALUES(NULL, '$title', '$runtime', '$rating', '$description', '$release_date', '$director', '$price', '$image', '$available')";
            // $sql = "INSERT INTO " . $this->tblDvd .
            //         " SET title='$title', runtime='$runtime', rating='$rating', release_date='$release_date', director='$director', "
            //         . "price='$price', image='$image', description='$description', available='$available' ";

            //execute the query and return true if successful or false if failed
            if($this->dbConnection->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    //search the database for dvds that match words in titles. Return an array of dvds if succeed; false otherwise.
    public function search_dvd($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblDvd . "," . $this->tblDvdRating .
                " WHERE " . $this->tblDvd . ".rating=" . $this->tblDvdRating . ".rating_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND title LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false. 
        if (!$query)
            return false;

        //search succeeded, but no dvd was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 dvd found.
        //create an array to store all the returned dvds
        $dvds = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $dvd = new Dvd($obj->title, $obj->runtime, $obj->rating, $obj->description, $obj->release_date, $obj->director, $obj->price, $obj->image, $obj->available);

            //set the id for the dvd
            $dvd->setId($obj->id);

            //add the dvd into the array
            $dvds[] = $dvd;
        }
        return $dvds;
    }
    
    //rent a dvd
    public function rent_dvd($id){
        
        $user_id = $_COOKIE['user_id'];
        $date = date("Y-m-d");
        
        $sql = "SELECT * FROM checkout LEFT JOIN checkin ON checkout.id = checkin.checkout_id WHERE checkin.checkout_id IS NULL AND checkout.user_id = '$user_id' UNION SELECT * FROM checkout RIGHT JOIN checkin ON checkout.id = checkin.checkout_id WHERE checkin.checkout_id IS NULL AND checkout.user_id = '$user_id'";
        
        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query->num_rows == 0) {
            
            $sql = "INSERT INTO ". $this->tblCheckout . " VALUES (NULL, '$id', '$user_id', '$date')";
            
            //execute the query and return true if successful or false if failed
            if($this->dbConnection->query($sql) === TRUE) {
                return "Renting successful!";
            } else {
                return "Renting failed.";
            }
            
        } else {
            return "Checkout without a checkin.";
        }
    }

    //get all dvd ratings
    private function get_dvd_ratings() {
        $sql = "SELECT * FROM " . $this->tblDvdRating;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $ratings = array();
        while ($obj = $query->fetch_object()) {
            $ratings[$obj->rating] = $obj->rating_id;
        }
        return $ratings;
    }

}
