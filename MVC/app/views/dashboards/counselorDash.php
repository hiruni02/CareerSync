<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/counselorDash.css">

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