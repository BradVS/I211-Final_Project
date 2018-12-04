<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/21/2018
 * File: dvd_edit.class.php
 * Description: the display method in the class displays dvd details in a form.
 *
 */
class DvdEdit extends DvdIndexView {

    public function display($dvd) {
        //display page header
        parent::displayHeader("Edit Dvd");

        //get dvd ratings from a session variable
        if (isset($_SESSION['dvd_ratings'])) {
            $ratings = $_SESSION['dvd_ratings'];
        }
        
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
        ?>

        <div id="main-header">Edit Dvd Details</div>

        <!-- display dvd details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/dvd/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Title</strong><br>
                <input name="title" type="text" size="100" value="<?= $title ?>" required autofocus></p>
            <p><strong>Rating</strong>:
                <?php
                foreach ($ratings as $m_rating => $m_id) {
                    $checked = ($rating == $m_rating ) ? "checked" : "";
                    echo "<input type='radio' name='rating' value='$m_id' $checked> $m_rating &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p><strong>Release Date</strong>: <input name="release_date" type="date" value="<?= $release_date->format('Y-m-d') ?>" required=""></p>
            <p><strong>Directors</strong>: Separate directors with commas<br>
                <input name="director" type="text" size="40" value="<?= $director ?>" required=""></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="text" size="100" required value="<?= $image ?>"></p>
            <p><strong>Description</strong>:<br>
                <textarea name="description" rows="8" cols="100"><?= $description ?></textarea></p>
            <p><strong>Runtime</strong>:<br>
                <input name="runtime" type="number" size="100" required value="<?= $runtime ?>"></p>
            <p><strong>Price</strong>:<br>
                <input name="price" type="number" step=".01" size="100" required value="<?= $price ?>"></p>
            <p><strong>Available</strong>:<br>
                <input name="available" type="number" size="100" required value="<?= $available ?>"></p>
            <input type="submit" name="action" value="Update Dvd">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/dvd/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}