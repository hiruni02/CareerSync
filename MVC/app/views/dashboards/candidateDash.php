<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/candidateDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><a href=""><button class="setting_btn" id="profileBtn">Your Profile</button></a></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
    </ul>
</div>

<div class="messege_menu" id="messege_menu">
    <ul class="messege_list">
        <li class="messege">messege 1: This is a test messege</li>
        <li class="messege">messege 2: This is a test messege</li>
        <li class="messege">messege 3: This is a test messege</li>
        <li class="messege">messege 4: This is a test messege</li>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/candidateProfile.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/candidateSideScheduler.php");
?>

<h1 class="dashboard_tag">Candidate Dash Board</h1>
<div class="counting_boxes">
    <div class="box_segment">
        Pending applications:<br>
        <h1>23</h1>
    </div>
    <div class="box_segment">
        Accepted applications: <br>
        <h1>2</h1>
    </div>
    <div class="box_segment">
        Rejected applications: <br>
        <h1>45</h1>
    </div>
    <div class="box_segment">
        Unread messeges: <br>
        <h1>5</h1>
    </div>
</div>

<div class="contact_counselor_section">
    <label>Unsure about your next step?<br> Reach out to one of our counselors for personalized guidance.</label>
    <button id="select_counselor">Contact a Counselor</button>
</div>

<div class="content_section">
    <div class='sent_applications'>
        <h1>Sent Applications</h1>
        <div class="scrollBox">
            <ul class="applications">
                <li class="application_item">
                    <div class="application-title">Dialog: business manager</div>
                    <div class="application_state"><span class="status pending">pending</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">ODEL: Performance Marketing & Brand Lead</div>
                    <div class="application_state"><span class="status accepted">accepted</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Singer: sales manager</div>
                    <div class="application_state"><span class="status rejected">rejected</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Abans: UI designer</div>
                    <div class="application_state"><span class="status pending">pending</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">LG : backend developer</div>
                    <div class="application_state"><span class="status rejected">rejected</span></div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const schedulerBg = document.querySelector(".scheduler_bg");
    const backBtn = document.getElementById("schedulerBackBtn");

    // Select all application items
    const appItems = document.querySelectorAll(".application_item");

    appItems.forEach(item => {
        // Find the status inside each application
        const status = item.querySelector(".status");

        // If the status exists and is "accepted"
        if (status && status.classList.contains("accepted")) {
            item.addEventListener("click", () => {
                schedulerBg.classList.add("active");
            });
        }
    });

    // Close scheduler when Back is clicked
    backBtn.addEventListener("click", () => {
        schedulerBg.classList.remove("active");
    });
});
</script>