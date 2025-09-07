<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/listPosition.css">
<div class="listing_application_bg">
    <div class="listing_application_window">
        <h1>Create a Job Position</h1>
        <button id="listing_application_backBtn">Back</button>
        <div class="scrollbox">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="posting_job">
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
                    <select
                        name="posType"
                        required
                        value="<?= isset($_POST['posType']) ? htmlspecialchars($_POST['posType']) : '' ?>">
                        <option disabled selected hidden>Select Position Type</option>
                        <option value="intern">Internship</option>
                        <option value="fullTime">Full Time</option>
                        <option value="partTime">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="freelance">Freelance</option>
                    </select>
                </div>

                <div class="input-field">
                    <label for="field">Industry/Department</label>
                    <input
                        type="text"
                        placeholder="e.g., IT, Marketing, Finance"
                        name="field"
                        required
                        value="<?= isset($_POST['field']) ? htmlspecialchars($_POST['field']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="level">Experience Level</label>
                    <select
                        name="level"
                        required
                        value="<?= isset($_POST['level']) ? htmlspecialchars($_POST['level']) : '' ?>">
                        <option disabled selected hidden>Select reqired level of experience</option>
                        <option value="entry">Entry-level</option>
                        <option value="mid">Mid-level</option>
                        <option value="senior">Senior</option>
                    </select>
                </div>

                <div class="input-field">
                    <label for="yearsOfExp">Years of experiance required</label>
                    <input
                        type="text"
                        placeholder="Number of years of experience"
                        name="yearsOfExp"
                        required
                        value="<?= isset($_POST['yearsOfExp']) ? htmlspecialchars($_POST['yearsOfExp']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="qualifications">Education Requirements</label>
                    <input
                        type="text"
                        placeholder="Bachelor's, Master's, High School, etc."
                        name="qualifications"
                        required
                        value="<?= isset($_POST['qualifications']) ? htmlspecialchars($_POST['qualifications']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="skillReq">Required Skills</label>
                    <input
                        type="text"
                        placeholder="required Skills"
                        name="skillReq"
                        required
                        value="<?= isset($_POST['skillReq']) ? htmlspecialchars($_POST['skillReq']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="salaryDetails">Salary Details</label>
                    <input
                        type="text"
                        placeholder="Salary Details"
                        name="salaryDetails"
                        required
                        value="<?= isset($_POST['salaryDetails']) ? htmlspecialchars($_POST['salaryDetails']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="address">Work Location</label>
                    <input
                        type="text"
                        placeholder="Address"
                        name="address"
                        required
                        value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>">
                </div>

                <div class="input-field">
                    <label>Work Mode</label>
                    <div id="workMode">
                        <label>
                            <input type="radio" name="workMode" value="online"
                                <?= (isset($_POST['workMode']) && $_POST['workMode'] === 'online') ? 'checked' : '' ?> required>
                            Online
                        </label>
                        <label>
                            <input type="radio" name="workMode" value="offline"
                                <?= (isset($_POST['workMode']) && $_POST['workMode'] === 'offline') ? 'checked' : '' ?>>
                            Offline
                        </label>
                        <label>
                            <input type="radio" name="workMode" value="hybrid"
                                <?= (isset($_POST['workMode']) && $_POST['workMode'] === 'hybrid') ? 'checked' : '' ?>>
                            Hybrid
                        </label>
                    </div>
                </div>

                <div class="input-field">
                    <label for="jobDescription">Job Description</label>
                    <textarea
                        id="jobDesc"
                        name="jobDescription"
                        rows="10" placeholder="A breif description about the job"
                        required></textarea>
                </div>

                <div class="input-field">
                    <label for="capacity">Number of Vacancies</label>
                    <input
                        type="text"
                        placeholder="Number of Vacancies"
                        name="capacity"
                        required
                        value="<?= isset($_POST['capacity']) ? htmlspecialchars($_POST['capacity']) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="deadline">Appllication Deadline</label>
                    <input
                        type="date"
                        placeholder="Appllication Deadline"
                        name="deadline"
                        required
                        value="<?= isset($_POST['deadline']) ? htmlspecialchars($_POST['deadline']) : '' ?>">
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