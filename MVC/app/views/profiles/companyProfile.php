<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/profileDisplay.css">

<div class="profile_display">
    <div class="pd_content">
        <h1>Company Profile</h1>
        <div class="user_data">
            <div class="profile_picture">
                <img src="<?= ROOT . $companyTable->business_certificate ?>" alt="company logo">
            </div>
            <div class="info_segment"><label>Company Name</label>
                <div class="value"><?= $companyTable->companyname; ?></div>
            </div>
            <div class="info_segment"><label>HR Name</label>
                <div class="value"><?= $companyTable->hr_name; ?></div>
            </div>
            <div class="info_segment"><label>HR Contact</label>
                <div class="value"><?= $companyTable->hr_contact; ?></div>
            </div>
            <div class="info_segment"><label>Email Address</label>
                <div class="value"><?= $companyTable->email; ?></div>
            </div>
        </div>
        <button class="backBtn" id="backBtn">Back</button>
        <button class="edit_profileBtn" id="editBtn">Edit Profile</button>
    </div>

    <div class="edit_profile_display">
        <div class="editWindow">
            <h1>Edit Company Profile</h1>
            <form method="POST" enctype="multipart/form-data">

                <div class="input-field">
                    <label for="companyname">Company Name</label>
                    <input
                        type="text"
                        placeholder="Company Name"
                        name="companyname"
                        value="<?= $companyTable->companyname ?>">
                </div>

                <div class="input-field">
                    <label for="hr_name">HR Name</label>
                    <input
                        type="text"
                        placeholder="HR Name"
                        name="hr_name"
                        value="<?= $companyTable->hr_name ?>">
                </div>

                <div class="input-field">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        placeholder="Email"
                        name="email"
                        value="<?= $companyTable->email ?>"
                        style="<?= !empty($errors['email']) ? 'border: 2px solid red;' : '' ?>">
                </div>
                <?php if (!empty($errors['email'])): ?>
                    <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                <?php endif; ?>

                <div class="input-field">
                    <label for="business_certificate">Business Certificate</label><br>
                    <?php if (!empty($companyTable->business_certificate)): ?>
                        <img src="<?= ROOT . $companyTable->business_certificate ?>" alt="Current Certificate" style="max-width:150px;">
                    <?php else: ?>
                        <img src="<?= ROOT ?>assets/uploads/defaultPhoto.jpg" alt="Default Certificate" style="max-width:150px;">
                    <?php endif; ?>
                    <br>
                    <input
                        type="file"
                        name="business_certificate"
                        accept=".jpg, .jpeg, .png, .pdf"
                        style="<?= !empty($errors['business_certificate']) ? 'border: 2px solid red;' : '' ?>">
                </div>
                <?php if (!empty($errors['business_certificate'])): ?>
                    <div style="color:red;" class="error"><?= $errors['business_certificate'] ?></div>
                <?php endif; ?>

                <div class="input-field">
                    <label for="hr_contact">HR Contact Number</label>
                    <input
                        type="tel"
                        placeholder="Contact Number:07xxxxxxxx"
                        name="hr_contact"
                        pattern="[0-9]{10}"
                        value="<?= $companyTable->hr_contact ?>">
                </div>

                <div class="input-field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="pass"
                        placeholder="Password"
                        name="password"
                        required>
                    <button onclick="show_password()" class="eye" type="button" id="eye1"></button>
                </div>

                <div class="input-field">
                    <label for="confirm_password">Re-enter Password</label>
                    <input
                        type="password"
                        id="confirm_pass"
                        placeholder="Confirm Password"
                        name="confirm_password"
                        required
                        style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;' : '' ?>">
                    <button onclick="show_confirm_password()" class="eye" type="button" id="eye2"></button>
                </div>
                <?php if (!empty($errors['confirm_password'])): ?>
                    <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                <?php endif; ?>

                <div class="form_btns">
                    <button type="submit">Save Changes</button>
                    <button id="edit_backBtn">Back</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const profileBtn = document.getElementById("profileBtn");
        const backBtn = document.getElementById("backBtn");
        const profileDisplay = document.querySelector(".profile_display");
        const editBtn = document.getElementById("editBtn");
        const edit_backBtn = document.getElementById("edit_backBtn");
        const editProfile = document.querySelector(".edit_profile_display");

        profileBtn.addEventListener("click", (e) => {
            e.preventDefault();
            profileDisplay.classList.add("active");
        });

        backBtn.addEventListener("click", () => {
            profileDisplay.classList.remove("active");
        });

        editBtn.addEventListener("click", (e) => {
            e.preventDefault();
            editProfile.classList.add("active");
        });

        edit_backBtn.addEventListener("click", () => {
            editProfile.classList.remove("active");
        });
    });

    function show_password() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
            document.getElementById("eye1").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
        } else {
            x.type = "password";
            document.getElementById("eye1").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";
        }
    }

    function show_confirm_password() {
        var x = document.getElementById("confirm_pass");
        if (x.type === "password") {
            x.type = "text";
            document.getElementById("eye2").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
        } else {
            x.type = "password";
            document.getElementById("eye2").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";
        }
    }
</script>


