<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: dvd_index_view.class.php
 * Description: the parent class that displays a search box.
 * The javascript varaiable media specifies the media type. This variable is needed for auto suggestion.
 */

class DvdIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <!-- <script>
            //the media type
            var media = "dvd";
        </script> -->
        <!--create the search bar -->
        <!-- <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/dvd/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search dvds by title" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div> -->
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }

}
