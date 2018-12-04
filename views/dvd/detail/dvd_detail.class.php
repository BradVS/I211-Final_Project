<?php

/*
 *Author: Zachary Smith
 * file name: dvd_detail.class.php
 * description: this file 
 */


class DvdDetail extends DvdIndexView {

    public function display($dvd, $confirm = "") {
        //display page header
        parent::displayHeader("DVD Details");

        //retrieve dvd details by calling get methods
        $id = $dvd->getId();
        $title = $dvd->getTitle();
        $rating = $dvd->getRating();
        $release_date = new \DateTime($dvd->getRelease_date());
        $director = $dvd->getDirector();
        $image = $dvd->getImage();
        $description = $dvd->getDescription();
        $runtime = $dvd->getRuntime();
        $price = $dvd->getPrice();
        $available = $dvd->getAvailable();
       

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . DVD_IMG . $image;
        }
        ?>
        <section class='dvdDetails'>
            <div id="main-header">DVD Details</div>
            <hr>
            <!-- display dvd details in a table -->
            <table id="detail">
                <tr>
                    <td style="width: 150px;">
                        <img src="<?= $image ?>" alt="<?= $title ?>" />
                    </td>
                    <td style="width: 130px;">
                        <p><strong>Title:</strong></p>
                        <p><strong>Rating:</strong></p>
                        <p><strong>Release Date:</strong></p>
                        <p><strong>Runtime:</strong></p>
                        <p><strong>Director:</strong></p>
                        <p><strong>Description:</strong></p>
                        <p><strong>Price:</strong></p>
                        <p><strong>Available:</strong></p>
                        
                    </td>
                    <td>
                        <p><?= $title ?></p>
                        <p><?= $rating ?></p>
                        <p><?= $release_date->format('m-d-Y') ?></p>
                        <p><?= $runtime ?> minutes</p>
                        <p><?= $director ?></p>
                        <p class="media-description"><?= $description ?></p>
                        <p>$<?= $price ?></p>
                        <p><?= $available ?></p>
                        <div id="confirm-message"><?= $confirm ?></div>
                    </td>
                </tr>
            </table>
            <div id="button-group">
                            <?php
                            if(!isset($_COOKIE['account_type'])){
                                echo "";
                            }else if($_COOKIE['account_type'] === "2"){
                                echo "<input type='button' id='edit-button' value='Edit' onclick=\""."window.location.href = '".BASE_URL."/dvd/edit/".$id."'\">&nbsp;";
                            }

                            if(isset($_COOKIE['account_type'])){
                                echo "<input type='button' id='rent-button' value='Rent' onclick=\""."window.location.href = '".BASE_URL."/dvd/rent/".$id."'\">&nbsp;";
                            } else {
                                echo "<h4>Please log in to rent this movie.</h4>";
                            }
                            ?>
    <!--                        <input type="button" id="edit-button" value="   Edit   "
                                onclick="window.location.href = '<?= BASE_URL ?>/dvd/edit/<?= $id ?>'">&nbsp;-->
                        </div>
            <a href="<?= BASE_URL ?>/dvd/index">Go to dvd list</a>
        </section>
        

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
