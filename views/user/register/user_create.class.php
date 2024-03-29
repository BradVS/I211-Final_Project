<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/15/2018
 * Name: user_create.class.php
 * Description: This class defines a method "display" that displays a user registration form.
 */

class UserCreate extends IndexView {

    public function display() {
        parent::displayHeader("Account Creation");
        ?>
        <section class='inputArea'>
            <div class="top-row">CREATE AN ACCOUNT</div>
            <div class="middle-row">
                <p>Please complete the entire form. All fields are required.</p>
                <form method="post" action="<?= BASE_URL ?>/user/register">
                    <div><input class='txtInput' type="text" name="username" style="width: 99%" placeholder="Username"></div>
                    <div><input class='txtInput' id="password" type="password" name="password" style="width: 99%" placeholder="Password, 5 characters minimum"></div>
                    <div><input oninput="confirmPassword(this)" class='txtInput' type="password" name="confirm_password" style="width: 99%" placeholder="Confirm Password"></div>
                    <div><input class='txtInput' type = 'text' name="name" style="width: 99%" required placeholder="Name"></div>
                    <div><input class='txtInput' type="email" name="email" style="width: 99%" placeholder="Email"></div>
                    <div><input class='txtInput' type = 'text' name="address" style="width: 99%" required placeholder="Address"></div>
                    <div><input class='txtInput' type = 'text' name="city" style="width: 99%" required placeholder="City"></div>
                    <div><input class='txtInput' type = 'text' name="state" style="width: 99%" required placeholder="State"></div>
                    <div><input class='txtInput' type = 'number' name="zip" style="width: 99%" required placeholder="Zip Code"></div>
                    <div><input class='txtInput' type="text" name="country" style="width: 99%" required placeholder="Country"></div>
                    <div><input type="submit" class="button" value="Register"></div>
                </form>
            </div>
            <div class="bottom-row">
                <span style="float: left">Already have an account? <a href="<?= BASE_URL ?>/user/login">Login</a></span>
                <span style="float: right"></span>
            </div>
        </section>
        <script>
            function confirmPassword(input) {
                if (input.value !== document.getElementById('password').value) {
                    input.setCustomValidity('Passwords do not match');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>
        <?php
        parent::displayFooter();
    }

}
