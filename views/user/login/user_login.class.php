<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/15/2018
 * Name: user_login.class.php
 * Description: This class defines a method "display" that displays a login form.
 */

class UserLogin extends IndexView {

    public function display() {
        parent::displayHeader("Login");
        ?>
        <section class="inputArea">
            <div class="top-row">Login</div>
            <div class="middle-row">
                <p>Please enter your username and password.</p>
                <form method="post" action="<?= BASE_URL ?>/user/verify">
                    <div><input class="txtInput" type="text" name="username" style="width: 99%" required placeholder="Username" autofocus></div>
                    <div><input class="txtInput" type="password" name="password" style="width: 99%" required placeholder="Password"></div>
                    <div><input type="submit" class="button" value="Login"></div>
                </form>
            </div>
            <div class="bottom-row">
                <span style="float: left">Don't have an account? <a href="<?= BASE_URL ?>/user/create">Register</a></span>
                <span style="float: right"></span>
            </div>
        </section>
        <?php
        parent::displayFooter();
    }

}
