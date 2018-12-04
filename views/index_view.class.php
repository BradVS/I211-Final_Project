<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/08/2018
 * Name: index_view.class.php
 * Description: the parent class for all view classes. The two functions display page header and footer.
 */

class IndexView {

    //this method displays the page header
    static public function displayHeader($page_title) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title> <?php echo $page_title ?> </title>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <link rel='shortcut icon' href='<?= BASE_URL ?>/www/img/favicon.ico' type='image/x-icon' />
                <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/app_style.css' />
                <script>
                    //create the JavaScript variable for the base url
                    var base_url = "<?= BASE_URL ?>";
                     //the media type
                    var media = "dvd";
                </script>
            </head>
            <body>
                <div id="top"></div>
                <div id='wrapper'>
                    <nav>
                        <!--<img alt="Website Mini Logo" src="<?= BASE_URL ?>/www/img/miniLogo.png">-->
                        <div id="searchbar">
                            <form method="get" action="<?= BASE_URL ?>/dvd/search">
                                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search DVDs by Title" autocomplete="off" onkeyup="handleKeyUp(event)">
                                <input type="submit" value="Search" />
                            </form>
                            <div id="suggestionDiv"></div>
                        </div>
                        <div class="navLinks">
                            <a href="<?= BASE_URL ?>/dvd/index">DVD Catalog</a>
                            <a href="<?= BASE_URL ?>/index">Home</a>
                            <?php 
                            if (!isset($_COOKIE["user"])){
                                echo "<a href='".BASE_URL ."/user/login'>Login</a>";
                            } else {
                                echo "<a href='".BASE_URL."/user/logout'>Logout</a>";
                            }
                            ?>
                            
                        </div>
                    </nav>
                    <div id="navBlock"></div>
                    <?php
                }//end of displayHeader function
                
                //this method displays the page footer
                public static function displayFooter() {
                    ?>
                    <hr>
                <footer><br>&copy 2018 Group 10 DVD Rental Service. All Rights Reserved.</footer>
                </div>
                <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>
            </body>
        </html>
        <?php
    } //end of displayFooter function
}
