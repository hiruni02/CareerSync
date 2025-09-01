<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/listPosition.css">
<div class="listing_application_bg">
    <div class="listing_application_window">
        <h1>Create a Job Position</h1>
        <button id="listing_application_backBtn">Back</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const listing_application_backBtn = document.getElementById("listing_application_backBtn");
        const createBtn = document.getElementById("createBtn");
        const listing_application_bg = document.querySelector(".listing_application_bg");

        createBtn.addEventListener("click", (e) => {
            e.preventDefault();
            listing_application_bg.classList.add("active");
        });

        listing_application_backBtn.addEventListener("click", () => {
            listing_application_bg.classList.remove("active");
        });
    });
</script>