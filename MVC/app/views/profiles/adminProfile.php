<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/profileDisplay.css">
<div class="profile_display">
    <div class="pd_content">
        <h1>user profile</h1>
        <button class="backBtn" id="backBtn">Back</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const profileBtn = document.getElementById("profileBtn");
        const backBtn = document.getElementById("backBtn");
        const profileDisplay = document.querySelector(".profile_display");

        // Show profile overlay
        profileBtn.addEventListener("click", (e) => {
            e.preventDefault(); // prevent link/button default behavior
            profileDisplay.classList.toggle("active");
        });

        // Hide profile overlay
        backBtn.addEventListener("click", () => {
            profileDisplay.classList.toggle("active");
        });
    });
</script>