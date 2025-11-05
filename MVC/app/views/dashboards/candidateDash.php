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
    <div class='sent_applications'>
        <h1>Sent Applications</h1>
        <div class="scrollBox">
            <ul class="applications">
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
                                        case 'accepted':
                                        ?>
                                            <span class="status accepted">accepted</span>
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

<div class="interview-section">
    <h3>Upcoming Interviews</h3>
    <div class="interview-scrollbox">

        <div class="interview-item">
            <div class="interview-row">
                <span class="interview-label">Position:</span>
                <span class="interview-value">Software Engineer Intern</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Company:</span>
                <span class="interview-value">TechNova Solutions</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Interview Date:</span>
                <span class="interview-value">2025-06-09</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Method:</span>
                <span class="interview-value">Online</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Address:</span>
                <span class="interview-value">https://app.zoom.us/wc/8863638238/join?fromPWA=1</span>
            </div>
            <div class="interview-row interview-cv">
                <span class="interview-label">Candidate CV:</span>
                <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="interview-cvBtn" target="_blank">View CV</a>
            </div>
        </div>

        <div class="interview-item">
            <div class="interview-row">
                <span class="interview-label">Position:</span>
                <span class="interview-value">UI/UX Designer</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Company:</span>
                <span class="interview-value">PixelWorks Studio</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Interview Date:</span>
                <span class="interview-value">2025-06-11</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Method:</span>
                <span class="interview-value">Physical</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Address:</span>
                <span class="interview-value">123 Tech Park, Silicon Avenue, CA</span>
            </div>
            <div class="interview-row interview-cv">
                <span class="interview-label">Candidate CV:</span>
                <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="interview-cvBtn" target="_blank">View CV</a>
            </div>
        </div>

        <div class="interview-item">
            <div class="interview-row">
                <span class="interview-label">Position:</span>
                <span class="interview-value">Data Analyst Intern</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Company:</span>
                <span class="interview-value">DataWave Analytics</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Interview Date:</span>
                <span class="interview-value">2025-06-13</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Method:</span>
                <span class="interview-value">Online</span>
            </div>
            <div class="interview-row">
                <span class="interview-label">Address:</span>
                <span class="interview-value">https://example.com/zoom-meeting/FAKE-56327</span>
            </div>
            <div class="interview-row interview-cv">
                <span class="interview-label">Candidate CV:</span>
                <a href="<?= ROOT ?>assets/uploads/cv/sampleCV.pdf" class="interview-cvBtn" target="_blank">View CV</a>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const schedulerBg = document.querySelector(".scheduler_bg");
        const schedulerbackBtn = document.getElementById("schedulerBackBtn");
        const selectCounselorBtn = document.getElementById("select_counselor");
        const counselorSelector = document.querySelector(".selector_bg");
        const counselorSelectBackBtn = document.getElementById("counselor_selector_backBtn");

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
            } else if (status && status.classList.contains("rejected")) {
                item.addEventListener("click", () => {
                    const confirmDelete = confirm("This application was rejected. Do you want to delete it?");
                    if (confirmDelete) {
                        item.remove();
                    }
                });
            }

        });

        // Close scheduler when Back is clicked
        schedulerbackBtn.addEventListener("click", () => {
            schedulerBg.classList.remove("active");
        });

        // Open counselor selector
        selectCounselorBtn.addEventListener("click", () => {
            counselorSelector.style.display = "flex";
        });

        // Close counselor selector when back button is clicked
        counselorSelectBackBtn.addEventListener("click", () => {
            counselorSelector.style.display = "none";
        });
    });
</script>