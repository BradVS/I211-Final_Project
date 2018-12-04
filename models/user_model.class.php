<?php

class UserModel {
    
    private $db; //database object
    private $dbConnection; //database connection
    
    
    public function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
    }
    
    
    //add a user into the "users" table in the database
    public function add_user() {
        //retrieve password from the registration form
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        //hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        //retrieve other user input from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        

        //construct an INSERT query
//        $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES(NULL, '$username', '$hashed_password', '$name', '$email', '$address', '$city', '$state', '$zip', '$country', 1)";
//        
//        //execute the query and return true if successful or false if failed
//        if($this->dbConnection->query($sql) === TRUE) {
//            return true;
//        } else {
//            return false;
//        }
//        
        try{
            if(strlen($password) < 5){
                throw new DataLengthException("Error: Your password is too short. It must be at least 5 characters long!");
            }
            
            //construct an INSERT query
            $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES(NULL, '$username', '$hashed_password', '$name', '$email', '$address', '$city', '$state', '$zip', '$country', 1)";

            //execute the query and return true if successful or false if failed
            if($this->dbConnection->query($sql) === TRUE) {
                return "Your account has been successfully created.";
            } else {
//                return false;
                throw new DatabaseException("Error: Database could not be reached, Please try again later.");
            }
            
        } catch (DataLengthException $ex) {
            return $ex->getMessage();
        } catch(DatabaseException $ex){
            return $ex->getMessage();
        } catch (Exception $ex){
            return $ex->getMessage();
        }
    }
    
    
    //verify username and password against a database record
    public function verify_user() {
        //retrieve username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

//        //sql statement to filter the users table data with a username
//        $sql = "SELECT password, account_type, id FROM " . $this->db->getUserTable() . " WHERE username='$username'";
//  
//       //execute the query
//        $query = $this->dbConnection->query($sql);
//        
//        //verify password; if password is valid, set a temporary cookie
//        if($query AND $query->num_rows > 0) {
//            $result_row = $query->fetch_assoc();
//            $hash = $result_row['password'];
//            if (password_verify($password, $hash)) {
//                setcookie("user", $username, time()+3600, '/');
//                setcookie("user_id", $result_row['id'], time()+3600, '/');
//                setcookie("account_type", $result_row['account_type'], time()+3600, '/');
//                return true;
//            }
//        }
//        
//        return false;
        
        try{
            
            //sql statement to filter the users table data with a username
            $sql = "SELECT password, account_type, id FROM " . $this->db->getUserTable() . " WHERE username='$username'";

           //execute the query
            $query = $this->dbConnection->query($sql);

            //verify password; if password is valid, set a temporary cookie
            if($query AND $query->num_rows > 0) {
                $result_row = $query->fetch_assoc();
                $hash = $result_row['password'];
                if (password_verify($password, $hash)) {
                    setcookie("user", $username, time()+3600, '/');
                    setcookie("user_id", $result_row['id'], time()+3600, '/');
                    setcookie("account_type", $result_row['account_type'], time()+3600, '/');
                    return "You have successfully logged in.";
                } else {
                    throw new PasswordMatchException("Error: Your password did not match.");
                }
            } else {
                throw new DatabaseException("Error: Database connection returned false or nothing.");
            }
            
        } catch (PasswordMatchException $ex) {
            return $ex->getMessage();
        } catch (DatabaseException $ex){
            return $ex->getMessage();
        } catch (Exception $ex){
            return $ex->getMessage();
        }
    }
    
    
    //logout user: destroy session data
    public function logout() {
        //destroy session data
        setcookie("user", '', -10, '/');
        setcookie("account_type", '', -10, '/');
        return true;
    }
    
    
    //changes the user's password if their login info matches, EXTREMELY INSECURE METHOD IN REALITY
    public function reset_password(){
        
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        
        //hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
//        //construct the query string
//        $sql = "UPDATE " . $this->db->getUserTable() . "SET password='$hashed_password' WHERE username='$username'";
//        
//        //execute the query
//        $query = $this->dbConnection->query($sql);
//
//        // if the query failed, return false. 
//        if (!$query || $this->dbConnection->affected_rows == 0){
//            return false;
//        }
//        
//        return true;
        
        try{
            
            //construct the query string
            $sql = "UPDATE " . $this->db->getUserTable() . "SET password='$hashed_password' WHERE username='$username'";

            //execute the query
            $query = $this->dbConnection->query($sql);

            // if the query failed, return false. 
            if (!$query || $this->dbConnection->affected_rows == 0){
//                return false;
                throw new DatabaseException("Error: Database connection failed or returned nothing!");
            } else{
                return true;
                
            }
        } catch (DatabaseException $ex) {
            return $ex->getMessage();
        }
    }
}
