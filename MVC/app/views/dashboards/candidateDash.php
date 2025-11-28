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
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/counselorSelector.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/candidateConsultationScheduler.php");
?>

<h1 class="dashboard_tag">Welcome back <?php echo $candidateTable->firstName; ?> !</h1>
<div class="counting_boxes">
    <div class="box_segment">
        Pending applications:<br>
        <h1>2</h1>
    </div>
    <div class="box_segment">
        Accepted applications: <br>
        <h1>1</h1>
    </div>
    <div class="box_segment">
        Rejected applications: <br>
        <h1>2</h1>
    </div>
    <div class="box_segment">
        Unread messeges: <br>
        <h1>4</h1>
    </div>
</div>

<div class="contact_counselor_section">
    <label>Unsure about your next step?<br> Reach out to one of our counselors for personalized guidance.</label>
    <button id="select_counselor">Contact a Counselor</button>
</div>

<div class="content_section">
    <div class='scrollBoxContainer'>
        <h1>Sent Applications</h1>
        <div class="scrollBox">
            <ul class="applications job-applications">
                <?php
                $sent_cv = $data['cv'];
                ?>
                <?php if (!empty($sent_cv)): ?>
                    <?php foreach ($sent_cv as $cv): ?>
                        <li class="application_item">
                            <div class="application-title"><?= htmlspecialchars($cv->posTitle) ?></div>
                            <div class="application_state">
                                <?php
                                switch ($cv->company_approval) {
                                    case 'pending':
                                ?>
                                        <span class="status pending">Pending</span>
                                    <?php
                                        break;
                                    case 'rejected':
                                    ?>
                                        <span class="status rejected">Rejected</span>
                                    <?php
                                        break;
                                    case 'approved':
                                    ?>
                                        <span class="status accepted">Accepted</span>
                                <?php
                                        break;
                                }
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class='itemsEmpty'>No CV's sent yet</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="content_section">
    <div class='scrollBoxContainer'>
        <h1>Sent Consultation Requests</h1>
        <div class="scrollBox">
            <ul class="applications consultation-list">
                <?php if (!empty($data['consultation'])): ?>
                    <?php foreach ($data['consultation'] as $cons): ?>
                        <li class="application_item">
                            <div class="application-title"><?= htmlspecialchars($cons->firstName . $cons->lastName) ?></div>
                            <div class="application_state">
                                <?php
                                switch ($cons->counselor_acceptance) {
                                    case 'pending':
                                ?>
                                        <span class="status pending">Pending</span>
                                    <?php
                                        break;
                                    case 'accepted':
                                    ?>
                                        <span class="status accepted">Accepted</span>
                                <?php
                                        break;
                                }
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class='itemsEmpty'>No Requests Sent</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="interview-section">
    <h3>Upcoming Interviews</h3>
    <div class="interview-scrollbox">
        <?php if (!empty($data['confirmedInterview'])): ?>
            <?php foreach ($data['confirmedInterview'] as $iv): ?>
                <div class="interview-item">
                    <div class="interview-row">
                        <span class="interview-label">Position:</span>
                        <span class="interview-value"><?= htmlspecialchars($iv->posTitle) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Company:</span>
                        <span class="interview-value"><?= htmlspecialchars($iv->companyName) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Interview Date:</span>
                        <span class="interview-value"><?= htmlspecialchars($iv->slot_datetime) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Method:</span>
                        <span class="interview-value"><?= htmlspecialchars(ucfirst($iv->mode)) ?></span>
                    </div>
                    <div class="interview-row">
                        <span class="interview-label">Address:</span>
                        <a href="<?= htmlspecialchars($iv->address_link) ?>" target="_blank" class="interview-value"><?= htmlspecialchars($iv->address_link) ?></a>
                    </div>
                    <div class="interview-row interview-cv">
                        <span class="interview-label">Candidate CV:</span>
                        <a href="<?= ROOT . htmlspecialchars($iv->cv_file_path) ?>" class="interview-cvBtn" target="_blank">View CV</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="itemsEmpty">No upcoming interviews</p>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* ------------------------------------------
           INTERVIEW SCHEDULER (Job Applications)
        ------------------------------------------- */
        const interviewBg = document.querySelector(".interview_scheduler_bg");
        const interviewBackBtn = document.getElementById("interviewSchedulerBackBtn");

        // Select only job application items
        const jobAppItems = document.querySelectorAll(".applications.job-applications .application_item");

        jobAppItems.forEach(item => {
            const status = item.querySelector(".status");

            if (status && status.classList.contains("accepted")) {
                // Open interview scheduler
                item.addEventListener("click", () => {
                    interviewBg.classList.add("active");
                });

            } else if (status && status.classList.contains("rejected")) {
                // Allow deletion of rejected job applications
                item.addEventListener("click", () => {
                    const confirmDelete = confirm("This application was rejected. Do you want to delete it?");
                    if (confirmDelete) item.remove();
                });
            }
        });

        interviewBackBtn.addEventListener("click", () => {
            interviewBg.classList.remove("active");
        });


        /* ------------------------------------------
           CONSULTATION SCHEDULER (Consultation Requests)
        ------------------------------------------- */
        const consultationBg = document.querySelector(".consultation_scheduler_bg");
        const consultationBackBtn = document.getElementById("consultationSchedulerBackBtn");

        // Select only consultation request items
        const consultationItems = document.querySelectorAll(".applications.consultation-list .application_item");

        consultationItems.forEach(item => {
            const status = item.querySelector(".status");

            if (status && status.classList.contains("accepted")) {
                item.addEventListener("click", () => {
                    consultationBg.classList.add("active");
                });
            }
        });

        consultationBackBtn.addEventListener("click", () => {
            consultationBg.classList.remove("active");
        });


        /* ------------------------------------------
           COUNSELOR SELECTOR
        ------------------------------------------- */
        const selectCounselorBtn = document.getElementById("select_counselor");
        const counselorSelector = document.querySelector(".selector_bg");
        const counselorSelectBackBtn = document.getElementById("counselor_selector_backBtn");

        selectCounselorBtn.addEventListener("click", () => {
            counselorSelector.style.display = "flex";
        });

        counselorSelectBackBtn.addEventListener("click", () => {
            counselorSelector.style.display = "none";
        });

    });
</script>