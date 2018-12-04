<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/16/2018
 * Name: user_logout.class.php
 * Description: This class defines a method "display" that displays a logout message.
 */

class UserLogout extends IndexView {

    public function display() {
        parent::displayHeader("Logout");
        ?>
        <section class="logout">
            <div class="top-row">Login</div>
            <div class="middle-row">
                <p>You have successfully logged out.</p>
            </div>
            <div class="bottom-row">
                    <span style="float: left">Already have an account? <a href="<?= BASE_URL ?>/user/login">Login</a></span>
                    <span style="float: right">Don't have an account? <a href="<?= BASE_URL ?>/user/create">Register</a></span>
            </div>
        </section>
        

        <?php
        parent::displayFooter();
    }

}
