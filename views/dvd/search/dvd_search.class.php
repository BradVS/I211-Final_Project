<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/13/2018
 * Name: dvd_search.class.php
 * Description: this script defines the SearchDvd class. The class contains a method named display, which
 *     accepts an array of Dvd objects and displays them in a grid.
 */

class DvdSearch extends DvdIndexView {
    /*
     * the displays accepts an array of dvd objects and displays
     * them in a grid.
     */

     public function display($terms, $dvds) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($dvds)) ? "( 0 - 0 )" : "( 1 - " . count($dvds) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($dvds === 0) {
                echo "No dvd was found.<br><br><br><br><br>";
            } else {
                //display dvds in a grid; six dvds per row
                foreach ($dvds as $i => $dvd) {
                    $id = $dvd->getId();
                    $title = $dvd->getTitle();
                    $rating = $dvd->getRating();
                    $release_date = $release_date = new \DateTime($dvd->getRelease_date());
                    $image = $dvd->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . DVD_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='" . BASE_URL . "/dvd/detail/$id'><img src='" . $image .
                    "'></a><span>$title<br>Rated $rating<br>" . $release_date->format('m-d-Y') . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($dvds) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a href="<?= BASE_URL ?>/dvd/index">Go to dvd catalog</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}