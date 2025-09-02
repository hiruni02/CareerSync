<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/listPosition.css">
<div class="listing_application_bg">
    <div class="listing_application_window">
        <h1>Create a Job Position</h1>
        <button id="listing_application_backBtn">Back</button>
        <div class="scrollbox">
            <form method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <label for="posTitle">Position Title</label>
                    <input
                        type="text"
                        placeholder="Position Title"
                        name="posTitle"
                        required
                        value="<?= isset($_POST['posTitle']) ? htmlspecialchars($_POST['posTitle']) : '' ?>">
                </div>
                <div class="input-field">
                    <label for="posType">Position Type</label>
                    <select name="posType" id="posType">
                        <option disabled selected hidden>Select Position Type</option>
                        <option value="intern">Internship</option>
                        <option value="fullTime">Full Time Employee</option>
                        <option value="partTime">Part Time Employee</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="salaryDetails">Salary Details</label>
                    <input
                        type="text"
                        placeholder="Last Name"
                        name="salaryDetails"
                        required
                        value="<?= isset($_POST['salaryDetails']) ? htmlspecialchars($_POST['salaryDetails']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="jobDescription">Job Description</label>
                    <textarea
                        name="jobDescription"
                        rows="10" placeholder="Your Message"
                        required></textarea>
                </div>
                <div class="form_btns">
                    <button type="submit" class="submit">CREATE</button>
                </div>
            </form>
        </div>
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