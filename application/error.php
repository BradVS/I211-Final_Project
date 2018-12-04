<?php
/**
 * Author: Bradley Stegbauer
 * Date: 11/08/2018
 * Name: error.php
 * Description: this script displays an error message. This script is globally available throughout the application.
 */

$page_title = "Error";
//display header
IndexView::displayHeader($page_title);

?>
<section class="errorScreen">
    <div id = "main-header">Error</div>
    <hr>
    <table style = "width: 100%; border: none">
        <tr>
            <td style = "vertical-align: middle; text-align: center; width:100px">
                <img alt="Error image." src = '<?= BASE_URL ?>/www/img/error.jpg' style = "width: 80px; border: none"/>
            </td>
            <td style = "text-align: left; vertical-align: top;">
                <h3> Sorry, but an error has occurred.</h3>
                <div style = "color: red">
                    <?= urldecode($message)
                    ?>
                </div>
                <br>
            </td>
        </tr>
    </table>
    <br><br><br><br><hr>
    <a href="<?= BASE_URL ?>/dvd/index">Back to dvd list</a>
</section>


<?php
//display footer
IndexView::displayFooter();
