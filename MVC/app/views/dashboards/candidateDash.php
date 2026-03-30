<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/candidateDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><a href=""><button class="setting_btn" id="profileBtn">Your Profile</button></a></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
        <li><a href=""><button class="setting_btn" id="bookmarksBtn">Bookmarks</button></a></li>
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
        <?php if (!empty($messages ?? [])): ?>
            <ul class="message_list" data-section="messages">
                <?php foreach ($messages as $msg): ?>
                    <li class="message">
                        <div class="msg-content"><?= htmlspecialchars($msg->content) ?></div>
                        <span class="msg-time"><?= htmlspecialchars(date('M d, Y', strtotime($msg->created_at))) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="message_empty_state" data-section="empty">
                <div class="envelope">
                    <svg width="80" height="60" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 3.5C1 2.119 2.119 1 3.5 1h17C21.881 1 23 2.119 23 3.5v11c0 1.381-1.119 2.5-2.5 2.5h-17C2.119 17 1 15.881 1 14.5v-11z" stroke="rgba(255,255,255,0.9)" stroke-width="0.8" />
                        <path d="M2 3.5L12 10l10-6.5" stroke="rgba(255,255,255,0.9)" stroke-width="0.8" />
                    </svg>
                </div>
                <h2>All caught up!</h2>
                <p>New messages will appear here</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="decor-star" aria-hidden="true"></div>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/candidateProfile.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/candidateSideScheduler.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/bookmarkViewer.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/counselorSelector.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/candidateConsultationScheduler.php");
?>

<h1 class="dashboard_tag">Welcome back <?php echo $candidateTable->firstName; ?> !</h1>
<?php $allCVs = $data['cv'] ?? []; ?>
<div class="counting_boxes">
    <div class="box_segment">
        Pending applications:<br>
        <h1><?= count(array_filter((array)($data['cv'] ?? []), fn($cv) => $cv->company_approval === 'pending')) ?></h1>
    </div>
    <div class="box_segment">
        Accepted applications: <br>
        <h1><?= count(array_filter((array)($data['cv'] ?? []), fn($cv) => $cv->company_approval === 'approved')) ?></h1>
    </div>
    <div class="box_segment">
        Rejected applications: <br>
        <h1><?= count(array_filter((array)($data['cv'] ?? []), fn($cv) => $cv->company_approval === 'rejected' || $cv->validator_approval === 'rejected')) ?></h1>
    </div>
    <div class="box_segment">
        Unread messages: <br>
        <h1><?= count(array_filter((array)($data['messages'] ?? []),fn($msg) => is_object($msg) && !$msg->is_read)) ?></h1>
    </div>
</div>

<div class="contact_counselor_section">
    <label>Unsure about your next step?<br> Reach out to one of our counselors for personalized guidance.</label>
    <button id="select_counselor">Contact a Counselor</button>
</div>

<div class="upcoming_section">
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
</div>

<div class="upcoming_section">
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

    <div class="interview-section">
        <h3>Upcoming Counselor Meetings</h3>
        <div class="interview-scrollbox">
            <?php if (!empty($data['confirmedConsultation'])): ?>
                <?php foreach ($data['confirmedConsultation'] as $cm): ?>
                    <div class="interview-item">
                        <div class="interview-row">
                            <span class="interview-label">Counselor:</span>
                            <span class="interview-value"><?= htmlspecialchars($cm->counselor_first_name) . " " . htmlspecialchars($cm->counselor_last_name) ?></span>
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
                        <div class="interview-row">
                            <span class="interview-label">Extra Details:</span>
                            <span class="interview-value"><?= htmlspecialchars(ucfirst($cm->extra_details)) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="itemsEmpty">No Upcoming Consultations</p>
            <?php endif; ?>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {

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

        const consultationBg = document.querySelector(".consultation_scheduler_bg");
        const consultationBackBtn = document.getElementById("consultationSchedulerBackBtn");

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
<script>
    document.addEventListener("DOMContentLoaded", () => {

        const bookmarksBtn = document.getElementById("bookmarksBtn");
        const bmBg = document.querySelector(".bmDisplay_bg");
        const bmBackBtn = document.getElementById("bmBackBtn");

        bookmarksBtn.addEventListener("click", (e) => {
            e.preventDefault();
            bmBg.classList.add("active");
        });

        bmBackBtn.addEventListener("click", () => {
            bmBg.classList.remove("active");
        });

    });
</script>