<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/companyProfileDisplay.css">
<div class="profile_display">
    <div class="pd_content">

        <button class="backBtn" id="backBtn">Back</button>
        
        <div class="profile_card">
            <h1><b> Company Profile</b></h1>
            <!--<div class="profile_img">
                <img src="<?= !empty($companyTable['company_logo']) 
                            ? ROOT.'assets/uploads/company_logos/'.$companyTable['company_logo'] 
                            : ROOT.'assets/images/default_company.png' ?>" 
                     alt="Company Logo">
            </div>-->

            <div class="profile_info">
                <p><strong>Company Name :</strong> <span><?= htmlspecialchars($companyTable['companyName'] ?? 'N/A') ?></span></p>
                <!--<p><strong>Company Email :</strong> <span><?= htmlspecialchars($companyTable['company_email'] ?? 'N/A') ?></span></p>-->
                <p><strong>Contact Number :</strong> <span><?= htmlspecialchars($companyTable['contactNo'] ?? 'N/A') ?></span></p>
                <hr>
                <p><strong>HR Manager First Name :</strong> <span><?= htmlspecialchars($companyTable['hr_first_name'] ?? 'N/A') ?></span></p>
                <p><strong>HR Manager Last Name :</strong> <span><?= htmlspecialchars($companyTable['hr_last_name'] ?? 'N/A') ?></span></p>
                <p><strong>HR Contact Email :</strong> <span><?= htmlspecialchars($companyTable['hr_email'] ?? 'N/A') ?></span></p>
                <p><strong>HR Contact Number :</strong> <span><?= htmlspecialchars($companyTable['hr_contactNo'] ?? 'N/A') ?></span></p>
                <hr>
                <p><strong>Business Registration Certificate :</strong> 
                   <?php if (!empty($companyTable['business_certificate'])): ?>
                       <a href="<?= ROOT.'assets/uploads/company_docs/'.$companyTable['business_certificate'] ?>" target="_blank">View Certificate</a>
                   <?php else: ?>
                       <span>N/A</span>
                   <?php endif; ?>
                </p>
            </div>

            <div class="profile_actions">
                <button class="editBtn" id="editBtn">Edit Profile</button>
            </div>

            <form id="editForm" style="display: none; margin-top:20px;" method="post" action="<?= ROOT ?>updateCompanyProfile" enctype="multipart/form-data">
                <label>Company Name: <input type="text" name="companyName" value="<?= htmlspecialchars($companyTable['companyName'] ?? '') ?>"></label><br>
                <!--<label>Company Email: <input type="email" name="company_email" value="<?= htmlspecialchars($companyTable['company_email'] ?? '') ?>"></label><br>-->
                <label>Contact Number: <input type="text" name="contactNo" value="<?= htmlspecialchars($companyTable['contactNo'] ?? '') ?>"></label><br>
                
                <label>HR First Name: <input type="text" name="hr_firstname" value="<?= htmlspecialchars($companyTable['hr_first_name'] ?? '') ?>"></label><br>
                <label>HR Last Name: <input type="text" name="hr_lastname" value="<?= htmlspecialchars($companyTable['hr_last_name'] ?? '') ?>"></label><br>
                <label>HR Contact Email: <input type="email" name="hr_email" value="<?= htmlspecialchars($companyTable['hr_email'] ?? '') ?>"></label><br>
                <label>HR Contact Number: <input type="text" name="hr_contactNo" value="<?= htmlspecialchars($companyTable['hr_contactNo'] ?? '') ?>"></label><br>

                <!--<label>Company Logo: <input type="file" name="company_logo"></label><br>-->
                <label>Business Certificate: <input type="file" name="business_certificate"></label><br>

                <button type="submit">Save Changes</button>
            </form>

        </div> 
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const backBtn = document.getElementById("backBtn");
        const profileBtn = document.getElementById("profileBtn"); // <-- Add this line
        const editBtn = document.getElementById("editBtn");
        const editForm = document.getElementById("editForm");
        const profileDisplay = document.querySelector(".profile_display");

        if (editBtn && editForm) {
            editBtn.addEventListener("click", () => {
                editForm.style.display = (editForm.style.display === "none") ? "block" : "none";
            });
        }

        if (backBtn && profileDisplay) {
            backBtn.addEventListener("click", () => {
                profileDisplay.classList.remove("active"); // Better than toggle here
            });
        }

        // 👇 ADD THIS to handle the profileBtn
        if (profileBtn && profileDisplay) {
            profileBtn.addEventListener("click", () => {
                profileDisplay.classList.add("active"); // Show the profile section
            });
        }
    });

</script>



