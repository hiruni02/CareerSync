<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/companyDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><button class="setting_btn" id="profileBtn">Company Profile</button></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
    </ul>
</div>

<div class="message_menu" id="message_menu" role="region" aria-label="Messages" aria-live="polite">
    <ul class="message_list">
        <?php if (!empty($messages ?? [])): ?>
            <?php foreach ($messages as $msg): ?>
                <li class="message">
                    <?= htmlspecialchars($msg->content) ?>
                    <span class="msg-time"><?= htmlspecialchars(date('M d, Y', strtotime($msg->created_at))) ?></span>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="message">No messages.</li>
        <?php endif; ?>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/companyProfile.php");
?>

<?php $allApplications = $data['cv'] ?? []; ?>

<h1 class="dashboard_tag">Company Dashboard</h1>

<div class="counting_boxes">
    <div class="box_segment">
        Posted Jobs: <br>
        <h1>15</h1>
    </div>

    <div class="box_segment">
        Active Applications: <br>
        <h1><?= count($allApplications) ?></h1>
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
    <div class="content_section" id="appliedCandidatesSection">
        <h3>Applied Candidates</h3>
        <div class="filter">
            <label for="jobFilter">Filter jobs:</label>
            <select id="jobFilter">
                <option value="all">All</option>
                <?php foreach ($postedJobs as $pj): ?>
                    <option value="<?= $pj->job_id ?>">
                        <?= htmlspecialchars($pj->posTitle) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="scScrollbox">
            <?php $approvedCvs = $data['cv'] ?? []; ?>

            <?php
            $pendingCvs = array_filter($approvedCvs, fn($cv) => $cv->company_approval === 'pending');
            ?>

            <?php if (!empty($pendingCvs)): ?>
                <?php foreach ($pendingCvs as $cv): ?>
                    <div class="listItem" data-job-id="<?= $cv->job_id ?>">
                        <div class="li-row">
                            <span class="li-label">Position:</span>
                            <span class="li-value"><?= htmlspecialchars($cv->posTitle) ?></span>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Candidate Name:</span>
                            <span class="li-value"><?= htmlspecialchars($cv->candidateName) ?></span>
                        </div>
                        <div class="li-row li-cv">
                            <span class="li-label">Candidate CV:</span>
                            <a href="<?= ROOT ?><?= htmlspecialchars($cv->cv_file_path) ?>" class="cvBtn" target="_blank">View CV</a>
                        </div>
                        <form method="POST" class="li-actions">
                            <input type="hidden" name="action" value="company_scheduler">
                            <input type="hidden" name="candidate_id" value="<?= $cv->candidate_id ?>">
                            <input type="hidden" name="job_id" value="<?= $cv->job_id ?>">
                            <input type="hidden" name="cv_id" value="<?= $cv->cv_id ?>">
                            <input type="hidden" name="decision" value="">
                            <button type="button" class="acceptBtn">Accept and schedule interview</button>
                            <button type="submit" class="rejectBtn">Reject candidate</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class='itemsEmpty'>No candidates applied yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="content_section">
        <h3>Posted Jobs</h3>
        <div class="scScrollbox">
            <?php
            $postedJobs = $data['postedJobs'];
            ?>
            <?php if (!empty($postedJobs)): ?>
                <?php foreach ($postedJobs as $pj): ?>
                    <div class="listItem">
                        <div class="li-row">
                            <a href="<?= ROOT ?>jobdetails/<?= urlencode($pj->job_id) ?>"><span class="jobTitleLink"><?= htmlspecialchars($pj->posTitle) ?></span></a>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Posted On:</span>
                            <span class="li-value"><?= htmlspecialchars($pj->posted_at) ?></span>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Deadline:</span>
                            <span class="li-value"><?= htmlspecialchars($pj->deadline) ?></span>
                        </div>
                        <div class="li-actions">
                            <form method="post" class="pj_form">
                                <input type="hidden" name="action" value="postedJobActions">
                                <input type="hidden" name="job_id" value="<?= $pj->job_id ?>">
                                <div class="jdBtns">
                                    <input type="date" name="new_deadline" required>
                                    <input type="submit" name="btn" class="extendBtn" value="Extend Deadline">
                                    <input type="submit" name="btn" class="deleteBtn" onclick="return confirm('Are you sure you want to delete this job post?');" value="Delete">
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class='itemsEmpty'>No jobs posted yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="content_section">
        <h3>Upcoming interviews</h3>
        <div class="scScrollbox">
            <?php $confirmedInterviews = $data['confirmedInterviews'] ?? []; ?>
            <?php if (!empty($confirmedInterviews)): ?>
                <?php foreach ($confirmedInterviews as $iv): ?>
                    <div class="listItem">
                        <div class="li-row">
                            <span class="li-label">Position:</span>
                            <span class="li-value"><?= htmlspecialchars($iv->posTitle) ?></span>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Candidate Name:</span>
                            <span class="li-value"><?= htmlspecialchars($iv->candidateName) ?></span>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Interview Date:</span>
                            <span class="li-value"><?= htmlspecialchars($iv->slot_datetime) ?></span>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Method:</span>
                            <span class="li-value"><?= htmlspecialchars($iv->mode) ?></span>
                        </div>
                        <div class="li-row">
                            <span class="li-label">Address:</span>
                            <a href="<?= htmlspecialchars($iv->address_link) ?>" target="_blank" class="li-value link">
                                <?= htmlspecialchars($iv->address_link) ?>
                            </a>
                        </div>
                        <div class="li-row li-cv">
                            <span class="li-label">Candidate CV:</span>
                            <a href="<?= ROOT ?><?= htmlspecialchars($iv->cv_file_path) ?>" class="cvBtn" target="_blank">View CV</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="itemsEmpty">No upcoming interviews scheduled.</p>
            <?php endif; ?>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const schedulerBg = document.querySelector(".scheduler_bg");
        const backBtn = document.getElementById("schedulerBackBtn");
        const openBtns = document.querySelectorAll(".acceptBtn");

        openBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                if (schedulerBg) schedulerBg.classList.add("active");
            });
        });

        if (backBtn) {
            backBtn.addEventListener("click", () => schedulerBg.classList.remove("active"));
        }

        const deleteBtns = document.querySelectorAll(".deleteBtn");
        deleteBtns.forEach(btn => {
            btn.addEventListener("click", function(event) {
                const form = btn.closest("form");
                const dateInput = form.querySelector("input[name='new_deadline']");
                if (dateInput) dateInput.removeAttribute("required");
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const schedulerBg = document.querySelector(".scheduler_bg");
        const backBtn = document.getElementById("schedulerBackBtn");
        const openBtns = document.querySelectorAll(".acceptBtn");
        const rejectBtns = document.querySelectorAll(".rejectBtn");
        const candidateInput = document.getElementById("schedulerCandidateId");
        const jobInput = document.getElementById("schedulerJobId");

        // Open scheduler for accepting
        openBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const form = btn.closest("form");
                const candidateId = form.querySelector("input[name='candidate_id']").value;
                const jobId = form.querySelector("input[name='job_id']").value;
                const decisionInput = form.querySelector("input[name='decision']");

                decisionInput.value = "accept"; // set decision type

                candidateInput.value = candidateId;
                jobInput.value = jobId;

                schedulerBg.classList.add("active");
            });
        });

        // Reject directly (submits form)
        rejectBtns.forEach(btn => {
            btn.addEventListener("click", (e) => {
                const form = btn.closest("form");
                const decisionInput = form.querySelector("input[name='decision']");
                decisionInput.value = "reject"; // mark as rejected
                form.submit();
            });
        });

        backBtn.addEventListener("click", (e) => {
            e.preventDefault();
            schedulerBg.classList.remove("active");
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const filter = document.getElementById("jobFilter");
        const appliedSection = document.getElementById("appliedCandidatesSection");

        if (!filter || !appliedSection) return;

        const items = appliedSection.querySelectorAll(".listItem");

        filter.addEventListener("change", () => {
            const selectedJob = filter.value;

            items.forEach(item => {
                const jobId = item.dataset.jobId;

                item.style.display =
                    selectedJob === "all" || jobId === selectedJob ?
                    "block" :
                    "none";
            });
        });
    });
</script>