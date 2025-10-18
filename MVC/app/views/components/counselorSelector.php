<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/counselorSelector.css">
<div class="selector_bg">
    <div class="selector_window">
        <h1>Select a Counselor</h1>
        <div class="scrollbox">
            <?php
            for ($x = 0; $x <= 10; $x++) {
            ?>
                <div class="listItem">
                    <div class="itemContent">
                        <div class="title">Dr john doe</div>
                        <img src="<?= ROOT ?>assets/images/default.png" alt="Counselor photo" class="counselor_photo">
                        <div class="description">
                            This description is about the counselor and what areas he/she specializes in
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <button id="counselor_selector_backBtn">Back</button>
    </div>
</div>