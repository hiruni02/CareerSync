<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/candidateProfileDisplay.css">
<div class="profile_display">
    <div class="pd_content">

        <button class="backBtn" id="backBtn">Back</button>
        
        <div class="profile_card">
            <h1><b> User Profile</b></h1>
            <div class="profile_img">
                <img src="<?=!empty($user['profile_pic'])? ROOT.'assets/uploads/candidate_photos/'.$user['profile_pic'] : ROOT.'assets/images/default.png' ?>" 
                        alt="Profile Picture">
            </div>

            <div class="profile_info">
                <p><strong>First name :</strong> <span><?= htmlspecialchars($user['first_name'] ?? 'N/A') ?></span></p>
                <p><strong>Last name :</strong> <span><?= htmlspecialchars($user['last_name'] ?? 'N/A') ?></span></p>
                <p><strong>Contact number :</strong> <span><?= htmlspecialchars($user['phone'] ?? 'N/A') ?></span></p>
                <p><strong>Email address :</strong> <span><?= htmlspecialchars($user['email'] ?? 'N/A') ?></span></p>
            </div>

            <div class="profile_actions">
                <button class="editBtn">Edit Profile</button>
            </div>

            <form id="editForm" style="display: none; margin-top:20px;" method="post" action="<?= ROOT ?>updateProfile" enctype="multipart/form-data">
                <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>"></label><br>
                <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>"></label><br>
                <label>Phone: <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"></label><br>
                <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>"></label><br>
                <label>Profile Picture: <input type="file" name="profile_pic"></label><br>
                <button type="submit">Save Changes</button>
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
        const editForm = document.getElementById("editForm");

        if (editBtn && editForm) {
        editBtn.addEventListener("click", () => {
            editForm.style.display = (editForm.style.display === "none") ? "block" : "none";
        });

        if(profileBtn){
            profileBtn.addEventListener("click", (e) => {
                e.preventDefault();
                profileDisplay.classList.toggle("active");
            });
        }

        backBtn.addEventListener("click", () => {
            profileDisplay.classList.toggle("active");
        });
        }
    });
</script>