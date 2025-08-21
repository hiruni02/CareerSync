<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/profileDisplay.css">
<div class="profile_display">
    <div class="pd_content">
        <h1>user profile</h1>
        <?php
        // show($userTable);
        // show($adminTable);
        ?>
        <div class="profile_picture"><img src="<?=ROOT.$adminTable->admin_photo_path?>" alt="admin photo"></div>
        <div class="info_segment"><label>First name :</label><?php echo $adminTable->firstName; ?></div>
        <div class="info_segment"><label>Last name :</label><?php echo $adminTable->lastName; ?></div>
        <div class="info_segment"><label>Contact number :</label><?php echo $adminTable->contactNo; ?></div>
        <div class="info_segment"><label>email address :</label><?php echo $userTable->email; ?></div>
        <button class="backBtn" id="backBtn">Back</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const profileBtn = document.getElementById("profileBtn");
        const backBtn = document.getElementById("backBtn");
        const profileDisplay = document.querySelector(".profile_display");

        profileBtn.addEventListener("click", (e) => {
            e.preventDefault();
            profileDisplay.classList.toggle("active");
        });

        backBtn.addEventListener("click", () => {
            profileDisplay.classList.toggle("active");
        });
    });
</script>