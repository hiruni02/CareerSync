<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/counselorDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><a href=""><button class="setting_btn" id="profileBtn">Your Profile</button></a></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
    </ul>
</div>

<div class="message_menu" id="message_menu" role="region" aria-label="Messages" aria-live="polite">
    <div class="msg-header">
        <div class="msg-title">Inbox</div>
        <div class="msg-tabs" role="tablist">
            <button class="msg-tab active" data-tab="messages">Messages</button>
            <button class="msg-tab" data-tab="alerts">Alerts</button>
        </div>
    </div>

    <div class="message_body">
        <div class="message_empty_state" data-section="empty" style="display: none;">
            <div class="envelope">
                <svg width="80" height="60" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 3.5C1 2.119 2.119 1 3.5 1h17C21.881 1 23 2.119 23 3.5v11c0 1.381-1.119 2.5-2.5 2.5h-17C2.119 17 1 15.881 1 14.5v-11z" stroke="rgba(255,255,255,0.9)" stroke-width="0.8"/>
                    <path d="M2 3.5L12 10l10-6.5" stroke="rgba(255,255,255,0.9)" stroke-width="0.8"/>
                </svg>
            </div>
            <h2>All caught up!</h2>
            <p>New messages will appear here</p>
        </div>
    </div>

    <div class="decor-star" aria-hidden="true"></div>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/counselorProfile.php");
?>

<h1 class="dashboard_tag">Welcome back <?php echo $counselorTable->firstName; ?> !</h1>

<div class="counting_boxes">
    <div class="box_segment">
        Assigned Students:<br>
        <h1>35</h1>
    </div>
    <div class="box_segment">
        Scheduled Sessions: <br>
        <h1>12</h1>
    </div>
    <div class="box_segment">
        Pending Approvals: <br>
        <h1>5</h1>
    </div>
    <div class="box_segment">
        Messages: <br>
        <h1>8</h1>
    </div>
    <div class="box_segment">
        Feedback Received: <br>
        <h1>3</h1>
    </div>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/counselorSideSchdeuler.php");
?>

<div class="content_section">
    <div class="meeting-requests">
        <h1>Meeting requests</h1>
        <div class="scrollBox">
            <?php
            $pendingRequests = array_filter($data['request'] ?: [], function ($req) {
                return $req->counselor_acceptance === "pending";
            });
            ?>
            <?php if (!empty($pendingRequests)): ?>
                <?php foreach ($pendingRequests as $req): ?>
                    <div class="request-card">
                        <img src="<?= ROOT . htmlspecialchars($req->candidate_photo_path) ?>" alt="candidate photo" class="candidate_photo">
                        <div class="candidate-name"><?= htmlspecialchars($req->candidate_firstName . " " . $req->candidate_lastName) ?></div>
                        <button class="schedule-btn" data-candidate="<?= $req->candidate_id ?>">Schedule Meeting</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class='itemsEmpty'>No Meeting Requests Received Yet </p>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="interview-section">
    <h3>Upcoming Counselor Meetings</h3>
    <div class="interview-scrollbox">
        <?php if (!empty($data['confirmedConsultation'])): ?>
            <?php foreach ($data['confirmedConsultation'] as $cm): ?>
                <div class="interview-item">
                    <div class="interview-row">
                        <span class="interview-label">Candudate:</span>
                        <span class="interview-value"><?= htmlspecialchars($cm->candidate_first_name)." ".htmlspecialchars($cm->candidate_last_name) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Consultation Date and Time:</span>
                        <span class="interview-value"><?= htmlspecialchars($cm->slot_datetime) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Method:</span>
                        <span class="interview-value"><?= htmlspecialchars(ucfirst($cm->mode)) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Address:</span>
                        <a href="<?= htmlspecialchars($cm->address_link) ?>" target="_blank" class="interview-value"><?= htmlspecialchars($cm->address_link) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="itemsEmpty">No Upcoming Consultations</p>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const schedulerBg = document.querySelector(".popup-overlay");
    const backBtn = document.getElementById("schedulerBackBtn");
    const openBtns = document.querySelectorAll(".schedule-btn");
    const candidateInput = document.getElementById("schedulerCandidateId");

    openBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const candidateId = btn.dataset.candidate;

            candidateInput.value = candidateId;

            schedulerBg.classList.add("active");
        });
    });

    if (backBtn) {
        backBtn.addEventListener("click", (e) => {
            e.preventDefault();
            schedulerBg.classList.remove("active");
        });
    }
});

</script>