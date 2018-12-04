<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/13/2018
 * File: dvd_error.class.php
 * Description: this file is displayed for invalid dvd actions
 *
 */
class DvdError extends DvdIndexView {

    public function display($message) {

        //display page header
        parent::displayHeader("Error");
        ?>

        <section class="errorScreen">
            <div id="main-header">Error</div>
            <hr>
            <table style="width: 100%; border: none">
                <tr>
                    <td style="vertical-align: middle; text-align: center; width:100px">
                        <img src='<?= BASE_URL ?>/www/img/error.png' style="width: 80px; border: none"/>
                    </td>
                    <td style="text-align: left; vertical-align: top;">
                        <h3> Sorry, but an error has occurred.</h3>
                        <div style="color: red">
                            <?= urldecode($message) ?>
                        </div>
                        <br>
                    </td>
                </tr>
            </table>
            <br><br><br><br><hr>
            <a href="<?= BASE_URL ?>/dvd/index">Back to dvd catalog</a>
        </section>
        
        <?php
        //display page footer
        parent::displayFooter();
    }

}