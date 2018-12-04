<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/08/2018
 * Name: welcome_index.class.php
 * Description: This class defines the method "display" that displays the home page. This is necessary for the homepage.
 */

class WelcomeIndex extends IndexView {

    public function display() {
        //display page header
        parent::displayHeader("Group 10 DVD Rental Website Home Page");
        ?>
        <section class="frontPage">  
            <div id="main-header">Welcome to Group 10's DVD rental website!</div>
            <!--<p>This application is designed to demonstrate the popular software design pattern named MVC. The application hosts four different media types: dvd, book, music cd, and game. The dvd library is complete. The partially completed book, cd, and game libraries are to show how easy it is to host additional media objects. The application is meant to be flexible and extensible.</p>-->
            <br>
    <!--        <table style="border: none; width: 700px; margin: 5px auto">
                <tr>
                    <td colspan="2" style="text-align: center"><strong>Major features include:</strong></td>
                </tr>
                <tr>
                    <td style="text-align: left">
                        <ul>
                            <li>List all media</li>
                            <li>Display details of specific media</li>
                            <li>Update or delete existing media</li>
                            <li>Add new media</li>
                        </ul>
                    </td>
                    <td style="text-align: left">
                        <ul>
                            <li>Search for media</li>
                            <li>Autosuggestion</li>
                            <li>Filter media</li>
                            <li>Sort media</li>
                            <li>Pagination</li>
                        </ul></td>
                </tr>
            </table>-->

            <br>

            <div id="thumbnails" style="text-align: center; border: none">
                <p>Click below to either explore our dvd catalog, or access functions for your user account. Not logged in? Sign in above!</p>

                <a href="<?= BASE_URL ?>/dvd/index">
                    <img src="<?= BASE_URL ?>/www/img/dvds.jpeg" title="DVD Library"/>
                </a>
            </div>
            <br>
            <div class="disclaimer">
                <p style="text-align: center; color: red; font-weight: bold">Disclaimer</p>
                <p style="font-style: italic">This application is created as a course project for I211. It is solely for teaching and learning purposes. As a course project, the goal is to learn how to do things, but not to get things done. Therefore, the code used in this project may not be most efficient or most effective. Furthermore, the code has not been tested in any production environment. If you want to use any code in this project in any production environment, use it at your own risk.</p><br>
            </div>
        </section>  
        <?php
        //display page footer
        parent::displayFooter();
    }

}
