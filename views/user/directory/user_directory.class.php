<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_directory
 *
 * @author Erin
 */
class UserDirectory extends IndexView {

    public function display($users) {
        parent::displayHeader("List of Users");
        ?>
        <section class="inputArea">
            <?php
            if (isset($_GET['error_message'])){
                echo "<h4 style='color:red'>" . $_GET['error_message'] ."</h4>";
            }
            if ($users === 0) {
                echo "No users in the system.<br><br><br><br><br>";
            } else {
                echo "<table class=user_table>"
                . "<tr>"
                . "<th>Username</th>"
                . "<th>Name</th>"
                . "<th>Email Address</th>"
                . "<th>Access Level</th>"
                . "</tr>";
                //display users in a table
                foreach ($users as $i => $user) {
                    $username = $user->getUsername();
                    $name = $user->getName();
                    $email = $user->getEmail();
                    $account_type = $user->getAccount_type();

                    echo "<tr>"
                    . "<td>" . $username . "</td>"
                    . "<td>" . $name . "</td>"
                    . "<td>" . $email . "</td>";
                    if ($account_type == 1) {
                        echo "<td>"
                        . "<button onclick='confirmPromotion(\"" . $username . "\")'>Make Admin</button>"
                        . "</td>";
                    } else {
                        echo "<td>Admin</td>";
                    }
                }

                echo "</table>";
            }
            ?>
        </section>


        <?php
        parent::displayFooter();
        ?>
        <script>
            function confirmPromotion(username) {
                if (confirm('Do you want to promote ' + username + ' to an Admin?')) {
                    window.location.replace('http://localhost/mvc_final/user/make_admin?username=' + username);
                }
            }

        </script>
        <?php
    }

}
