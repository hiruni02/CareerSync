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
            <?php
            $approvedCvs = $data['cv'];
            ?>
            <?php if (!empty($approvedCvs)): ?>
                <?php foreach ($approvedCvs as $cv): ?>
                    <div class="listItem">
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
                        <div class="li-actions">
                            <button type="button" class="acceptBtn">Accept and schedule interview</button>
                            <button type="button" class="rejectBtn">Reject candidate</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class='itemsEmpty'>No candidates applied yet</p>
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
                            <span class="li-label">Position:</span>
                            <span class="li-value"><?= htmlspecialchars($pj->posTitle) ?></span>
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
                                <input type="submit" name="btn" class="extendBtn" value="Extend Deadline">
                                <input type="submit" name="btn" class="deleteBtn" onclick="return confirm('Are you sure you want to delete this job post?');" value="Delete">
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
            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Software Engineer Intern</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">John Silva</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Interview Date:</span>
                    <span class="li-value">2025-06-09</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Method:</span>
                    <span class="li-value">Online</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Address:</span>
                    <span class="li-value">https://app.zoom.us/wc/8863638238/join?fromPWA=1</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="cvBtn" target="_blank">View CV</a>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">UI/UX Designer</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Emma Rodriguez</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Interview Date:</span>
                    <span class="li-value">2025-06-11</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Method:</span>
                    <span class="li-value">Physical</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Address:</span>
                    <span class="li-value">123 Tech Park, Silicon Avenue, CA</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="cvBtn" target="_blank">View CV</a>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Data Analyst Intern</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Kavindu Perera</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Interview Date:</span>
                    <span class="li-value">2025-06-13</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Method:</span>
                    <span class="li-value">Online</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Address:</span>
                    <span class="li-value">https://example.com/zoom-meeting/FAKE-56327</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="cvBtn" target="_blank">View CV</a>
                </div>
            </div>

            <div class="listItem">
                <div class="li-row">
                    <span class="li-label">Position:</span>
                    <span class="li-value">Marketing Assistant</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Candidate Name:</span>
                    <span class="li-value">Sarah Johnson</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Interview Date:</span>
                    <span class="li-value">2025-06-15</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Method:</span>
                    <span class="li-value">Online</span>
                </div>
                <div class="li-row">
                    <span class="li-label">Address:</span>
                    <span class="li-value">https://example.com/zoom-meeting/FAKE-94822</span>
                </div>
                <div class="li-row li-cv">
                    <span class="li-label">Candidate CV:</span>
                    <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="cvBtn" target="_blank">View CV</a>
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