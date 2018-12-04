<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: dvd_index.class.php
 * Description: This class defines a method called "display", which displays all dvds.
 */
class DvdIndex extends DvdIndexView {
    /*
     * the display method accepts an array of dvd objects and displays
     * them in a grid.
     */

    public function display($dvds) {
        //display page header
        parent::displayHeader("List All Dvds");
        ?>
        <div id="main-header"> DVDs in our Catalog</div>
        <hr>

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
                    $release_date = new \DateTime($dvd->getRelease_date());
                    $image = $dvd->getImage();
                    $price = $dvd->getPrice();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . DVD_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/dvd/detail/$id'><img src='" . $image .
                    "'></a><span><span class='listTitle'>$title</span><br>Rated: $rating<br>" . $release_date->format('m-d-Y') . "<br>Price: $$price</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($dvds) - 1) {
                        echo "</div>";
                    }
                }
            }

            if(!isset($_COOKIE['account_type'])){
                echo "";
            }else if($_COOKIE['account_type'] === "2"){
                echo "<input type='button' id='add-button' value='Add DVD' onclick=\""."window.location.href = '".BASE_URL."/dvd/add/'\">&nbsp;";
            }
            ?>  
        </div>
       
        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
}
