<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/profileDisplay.css">
<div class="profile_display">
    <div class="pd_content">
        <h1>user profile</h1>
        <button class="backBtn" id="backBtn">Back</button>
        <?php

        show($userTable);
        show($adminTable);

        ?>
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