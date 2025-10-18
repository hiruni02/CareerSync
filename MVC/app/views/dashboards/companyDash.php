<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/companyDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><button class="setting_btn" id="profileBtn">Company Profile</button></li>
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

<div class="content_wrapper">
    <div class="content_section">
        <h3>Applied Candidates</h3>
        <div class="scScrollbox">
            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Software Engineer Intern</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">John Silva</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="#" class="cvBtn" target="_blank">View CV</a>
                </div>
                <div class="li-actions">
                    <button type="button" class="acceptBtn">Accept and schedule interview</button>
                    <button type="button" class="rejectBtn">Reject candidate</button>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">UI/UX Designer</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Ayesha Fernando</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="#" class="cvBtn" target="_blank">View CV</a>
                </div>
                <div class="li-actions">
                    <button type="button" class="acceptBtn">Accept and schedule interview</button>
                    <button type="button" class="rejectBtn">Reject candidate</button>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Data Analyst</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Kasun Perera</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="#" class="cvBtn" target="_blank">View CV</a>
                </div>
                <div class="li-actions">
                    <button type="button" class="acceptBtn">Accept and schedule interview</button>
                    <button type="button" class="rejectBtn">Reject candidate</button>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Marketing Coordinator</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Rashmi De Alwis</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="#" class="cvBtn" target="_blank">View CV</a>
                </div>
                <div class="li-actions">
                    <button type="button" class="acceptBtn">Accept and schedule interview</button>
                    <button type="button" class="rejectBtn">Reject candidate</button>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Project Manager Trainee</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Tharindu Wijesinghe</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="#" class="cvBtn" target="_blank">View CV</a>
                </div>
                <div class="li-actions">
                    <button type="button" class="acceptBtn">Accept and schedule interview</button>
                    <button type="button" class="rejectBtn">Reject candidate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content_section">
        <h3>Posted Jobs</h3>
        <div class="scScrollbox">
            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Software Engineer</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Posted On:</span>
                    <span class="li-value">2025-10-01</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Deadline:</span>
                    <span class="li-value">2025-11-10</span>
                </div>
                <div class="li-actions">
                    <button type="button" class="extendBtn">Extend Deadline</button>
                    <button type="button" class="deleteBtn">Delete</button>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">UI/UX Designer</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Posted On:</span>
                    <span class="li-value">2025-09-25</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Deadline:</span>
                    <span class="li-value">2025-10-30</span>
                </div>
                <div class="li-actions">
                    <button type="button" class="extendBtn">Extend Deadline</button>
                    <button type="button" class="deleteBtn">Delete</button>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">QA Tester</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Posted On:</span>
                    <span class="li-value">2025-10-05</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Deadline:</span>
                    <span class="li-value">2025-11-05</span>
                </div>
                <div class="li-actions">
                    <button type="button" class="extendBtn">Extend Deadline</button>
                    <button type="button" class="deleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
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