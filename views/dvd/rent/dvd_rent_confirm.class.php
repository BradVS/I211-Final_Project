<?php

class DvdRentConfirm extends DvdIndexView {
    
    public function display($confirmation){
        
        //display page header
        parent::displayHeader("Rental confirmed!");
        ?>
        
        <section class='rentConfirm'>
            <div id="main-header">Rental Confirmation</div>
            <hr>
            <div class="confirmMsg">
                <?= $confirmation ?>
            </div>
            <a href="<?= BASE_URL ?>/dvd/index">Return to DVDs</a>
        </section>
        
        <?php
        parent::displayFooter();
    }
    
}
