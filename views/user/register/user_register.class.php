<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/15/2018
 * Name: user_register.class.php
 * Description: This class defines a method "display" that confirms the user registration.
 */

class UserRegister extends IndexView {

    public function display($result) {
        parent::displayHeader("Account Creation");

//        $message = ($result) ? "Your account has been successfully created." : "Your last attempt for creating an account failed. Please try again.";
        ?>
        <div class="top-row">CREATE AN ACCOUNT</div>
        <div class="middle-row">
            <p><?= $result ?></p>
        </div>
        <div class="bottom-row">         
            <span style="float: left">Already have an account? <a href="<?= BASE_URL ?>/user/login">Login</a></span>
            <span style="float: right"></span>
        </div>

        <?php
        parent::displayFooter();
    }

}
