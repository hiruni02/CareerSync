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

<div class="content_section">
    <div class='sent_applications'>
        <h1>Your Job Posts</h1>
        <div class="scrollBox">
            <ul class="applications">
                <?php if (!empty($jobPosts)): ?>
                    <?php foreach ($jobPosts as $job): ?>
                        <li class="application_item">
                            <div class="application-title">
                                <?= htmlspecialchars($job->posTitle) ?>
                            </div>
                            <div class="application_count">
                                Vacancies: <?= htmlspecialchars($job->vacancies) ?>
                            </div>
                            <div class="application_meta">
                                <small>Location: <?= htmlspecialchars($job->city) ?></small><br>
                                <small>Deadline: <?= htmlspecialchars($job->deadline) ?></small>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="application_item">
                        <div class="application-title">No job posts yet.</div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>