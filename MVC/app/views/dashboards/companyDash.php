<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/companyDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><button class="setting_btn" id="profileBtn">Company Profile</button></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/companyProfile.php");
?>

<h1 class="dashboard_tag">Company Dashboard</h1>

<div class="counting_boxes">
    <div class="box_segment">
        Posted Jobs: <br>
        <h1>15</h1>
    </div>
    <div class="box_segment">
        Active Applications: <br>
        <h1>42</h1>
    </div>
    <div class="box_segment">
        Shortlisted Candidates: <br>
        <h1>12</h1>
    </div>
    <div class="box_segment">
        Pending Interviews: <br>
        <h1>8</h1>
    </div>
    <div class="box_segment">
        Feedback Received: <br>
        <h1>5</h1>
    </div>
</div>

<div class="list_pos_box">
    <label>Create New Position :</label>
    <button id="createBtn">Create</button>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/dashboards/listPosition.php");
?>

<!--need to bind this code to the backend -->
<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/companySideScheduler.php");
?>

<div class="content_section">
    <div class='sent_applications'>
        <h1>Your Job Posts</h1>
        <div class="scrollBox">
            <ul class="applications">
                <li class="application_item">
                    <div class="candidateCard">
                        <div class="cc-row">
                            <span class="cc-label">Position:</span>
                            <span class="cc-value">Front-End Developer</span>
                        </div>
                        <div class="cc-row">
                            <span class="cc-label">Candidate Name:</span>
                            <span class="cc-value">John Doe</span>
                        </div>
                        <div class="cc-row cc-cv">
                            <span class="cc-label">Candidate CV:</span>
                            <a href="javascript:void(0)" class="cvBtn">View CV</a>
                        </div>
                        <div class="cc-actions">
                            <button type="button" class="acceptBtn">Accept and schedule interview</button>
                            <button type="button" class="rejectBtn">Reject candidate</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const schedulerBg = document.querySelector(".scheduler_bg");
    const backBtn = document.getElementById("schedulerBackBtn");
    const openBtns = document.querySelectorAll(".acceptBtn");

    openBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (schedulerBg) {
                schedulerBg.classList.add("active");
            }
        });
    });

    if (backBtn) {
        backBtn.addEventListener("click", () => {
            schedulerBg.classList.remove("active");
        });
    }
});
</script>

