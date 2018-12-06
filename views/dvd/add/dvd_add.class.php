<?php
/*
 * Author: Zachary Smith
 * Date: 11/27/2018
 * File: dvd_add.class.php
 * Description: this should display a form that the admin will enter information into to create a new entry in the database
 *
 */
class DvdAdd extends DvdIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add Dvd");

        
        //get dvd ratings from a session variable
        if (isset($_SESSION['dvd_ratings'])) {
            $ratings = $_SESSION['dvd_ratings'];
        }
        
        ?>

        <div id="main-header">Add a DVD to the Store</div>

        <!-- display dvd details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/dvd/insert/" ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Title</strong><br>
                <input name="title" type="text" size="100" value="" placeholder="Title" autofocus></p>
            <p><strong>Rating</strong>:
                <!-- <input name="rating" type="text" size="100" value="" required autofocus> -->
                <?php
                foreach ($ratings as $m_rating => $m_id) {
//                    $checked = ($rating == $m_rating ) ? "checked" : "";
                    echo "<input type='radio' name='rating' value='$m_id'> $m_rating &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p><strong>Release Date</strong>: <input name="release_date" type="date" value="" >
                
            </p>
            <p><strong>Directors</strong>: Separate directors with commas<br>
                <input placeholder="Directors" name="director" type="text" size="40" value="" ></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input placeholder="Image" name="image" type="text" size="100" value=""></p>
            <p><strong>Description</strong>:<br>
                <textarea name="description" rows="8" cols="100"></textarea></p>
            <p><strong>Runtime</strong>:<br>
                <input placeholder="Runtime" name="runtime" type="number" size="100" value=""></p>
            <p><strong>Price</strong>:<br>
                <input placeholder="Price" name="price" type="number" step=".01" size="100" value=""></p>
            <p><strong>Available</strong>:<br>
                <input placeholder="Available" name="available" type="number" size="100" value=""></p>
            <input type="submit" name="action" value="Add Dvd">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL ?>/dvd/index/"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}