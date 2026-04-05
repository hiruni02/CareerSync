<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/adminDash.css">

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
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/adminProfile.php");
?>

<h1 class="dashboard_tag">Dashboard</h1>
<div class="counting_boxes">
    <div class="box_segment">
        Total Users:<br>
        <h1><?= $data['totalUsers'] ?? 0 ?></h1>
    </div>
    <div class="box_segment">
        Active Users: <br>
        <h1><?= $data['activeUsers'] ?? 0 ?></h1>
    </div>
    <div class="box_segment">
        Total Posted Jobs: <br>
        <h1><?= $data['totalJobPosts'] ?? 0 ?></h1>
    </div>
    <div class="box_segment">
        System Alerts: <br>
        <h1><?= $data['systemAlertCount'] ?? 0 ?></h1>
    </div>
    <div class="box_segment">
    New Feedback forms: <br>
    <?php
    // Ensure countable
    $feedbacks = $data['feedbacks'] ?? [];
    if ($feedbacks === false || !is_array($feedbacks)) $feedbacks = [];
    ?>
    <h1><?= count($feedbacks); ?></h1>
</div>
</div>

<div class="sbContainer">
    <h3>System Alerts</h3>
    <?php
    $alerts = $data['sysAlerts'];
    ?>
    <div class="scrollBox">
        <?php if (!empty($alerts)): ?>
            <?php foreach ($alerts as $a): ?>
                <div class="alertListItem">
                    <div class="alertItemContent">
                        <label>Log ID: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->log_id); ?></div>
                        <label>User ID: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->user_id); ?></div>
                        <label>Role: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->role); ?></div>
                        <label>Description: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->description); ?></div>
                        <label>IP Address: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->ip_address); ?></div>
                        <label>User Agent: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->user_agent); ?></div>
                        <label>Time Created: </label>
                        <div class="alertDetail"><?= htmlspecialchars($a->created_at); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No Validators Registered yet.</p>
        <?php endif; ?>
    </div>
</div>


<div class="sbContainer">
    <h3>User Feedback</h3>
    <div class="scrollBox">
        <?php
        // Ensure $feedbacks is always an array
        $feedbacks = !empty($data['feedbacks']) && is_array($data['feedbacks']) ? $data['feedbacks'] : [];
        ?>

        <?php if (!empty($feedbacks)): ?>
            <?php foreach ($feedbacks as $f): ?>
                <div class="listItem">
                    <div class="itemContent">
                        <div class="title">Name: <?= htmlspecialchars($f->name); ?></div>
                        <div class="title">Email: <?= htmlspecialchars($f->email); ?></div>
                        <div class="description"><?= htmlspecialchars($f->message); ?></div>
                        <div class="deleteLink">
                            <a href="?delete_id=<?= $f->id ?>" onclick="return confirm('Are you sure you want to delete this message?')">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="itemsEmpty">No feedback yet</p>
        <?php endif; ?>
    </div>
</div>

<div class="sbContainer">
    <h3>Manage Companies</h3>
    <div class="scrollBox">
        <?php
        $companies = $data['companies'];
        ?>
        <?php if (!empty($companies)): ?>
            <?php foreach ($companies as $val): ?>
                <div class="manager_list_item">
                    <img src="<?= ROOT . htmlspecialchars($val->company_photo_path) ?>" alt="Company logo" class="photo">
                    <div class="managerContent">
                        <label>User ID: </label>
                        <div class="details"><?= htmlspecialchars($val->user_id); ?></div>
                        <label>Company: </label>
                        <div class="details"><?= htmlspecialchars($val->companyName); ?></div>
                        <label>Email: </label>
                        <div class="details"><?= htmlspecialchars($val->email); ?></div>
                        <label>Contact No: </label>
                        <div class="details"><?= htmlspecialchars($val->contactNo); ?></div>
                        <label>Payment Status: </label>
                        <div class="details"><?= htmlspecialchars($val->payment_status); ?></div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="action" value="validateCompany">
                        <input type="hidden" name="company_id" value="<?= $val->user_id ?>">
                        <button type="submit" class="acceptBtn" name="grant" value="grant">Grant Access</button>
                        <button type="submit" class="denyBtn" name="deny" value="deny" onclick="return confirm('Are you sure you want to deny and delete this company?');">Deny Access</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No Companies Registered yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="sbContainer">
    <h3>Manage Candidates</h3>
    <div class="scrollBox">
        <?php
        $candidates = $data['candidates'];
        ?>
        <?php if (!empty($candidates)): ?>
            <?php foreach ($candidates as $val): ?>
                <div class="manager_list_item">
                    <img src="<?= ROOT . htmlspecialchars($val->candidate_photo_path) ?>" alt="candidate photo" class="photo">
                    <div class="managerContent">
                        <label>User ID: </label>
                        <div class="details"><?= htmlspecialchars($val->user_id); ?></div>
                        <label>Name: </label>
                        <div class="details"><?= htmlspecialchars($val->firstName . ' ' . $val->lastName); ?></div>
                        <label>Email: </label>
                        <div class="details"><?= htmlspecialchars($val->email); ?></div>
                        <label>Contact No: </label>
                        <div class="details"><?= htmlspecialchars($val->contactNo); ?></div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="action" value="validateCandidate">
                        <input type="hidden" name="candidate_id" value="<?= $val->user_id ?>">
                        <button type="submit" class="acceptBtn" name="grant" value="grant">Grant Access</button>
                        <button type="submit" class="denyBtn" name="deny" value="deny" onclick="return confirm('Are you sure you want to deny and delete this candidate?');">Deny Access</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No Candidates Registered yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="sbContainer">
    <h3>Manage Counselors</h3>
    <div class="scrollBox">
        <?php
        $counselors = $data['counselors'];
        ?>
        <?php if (!empty($counselors)): ?>
            <?php foreach ($counselors as $val): ?>
                <div class="manager_list_item">
                    <img src="<?= ROOT . htmlspecialchars($val->counselor_photo_path) ?>" alt="Counselor photo" class="photo">
                    <div class="managerContent">
                        <label>User ID: </label>
                        <div class="details"><?= htmlspecialchars($val->user_id); ?></div>
                        <label>Name: </label>
                        <div class="details"><?= htmlspecialchars($val->firstName . ' ' . $val->lastName); ?></div>
                        <label>Email: </label>
                        <div class="details"><?= htmlspecialchars($val->email); ?></div>
                        <label>Contact No: </label>
                        <div class="details"><?= htmlspecialchars($val->contactNo); ?></div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="action" value="validateCounselor">
                        <input type="hidden" name="counselor_id" value="<?= $val->user_id ?>">
                        <button type="submit" class="acceptBtn" name="grant" value="grant">Grant Access</button>
                        <button type="submit" class="denyBtn" name="deny" value="deny" onclick="return confirm('Are you sure you want to deny and delete this counselor?');">Deny Access</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No Counselors Registered yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="sbContainer">
    <h3>Manage Validators</h3>
    <div class="scrollBox">
        <?php
        $validators = $data['validators'];
        ?>
        <?php if (!empty($validators)): ?>
            <?php foreach ($validators as $val): ?>
                <div class="manager_list_item">
                    <img src="<?= ROOT . htmlspecialchars($val->validator_photo_path) ?>" alt="Validator photo" class="photo">
                    <div class="managerContent">
                        <label>User ID: </label>
                        <div class="details"><?= htmlspecialchars($val->user_id); ?></div>
                        <label>Name: </label>
                        <div class="details"><?= htmlspecialchars($val->firstName . ' ' . $val->lastName); ?></div>
                        <label>Email: </label>
                        <div class="details"><?= htmlspecialchars($val->email); ?></div>
                        <label>Contact No: </label>
                        <div class="details"><?= htmlspecialchars($val->contactNo); ?></div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="action" value="validateValidator">
                        <input type="hidden" name="validator_id" value="<?= $val->user_id ?>">
                        <button type="submit" class="acceptBtn" name="grant" value="grant">Grant Access</button>
                        <button type="submit" class="denyBtn" name="deny" value="deny" onclick="return confirm('Are you sure you want to deny and delete this validator?');">Deny Access</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No Validators Registered yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="report_generators">
    <div class="genReport">
        <label>Generate a report for the last 30 Days :</label>
        <a href="adminReport ? live=1" target="_blank"><button>Generate</button></a>
    </div>

    <div class="genReport">
        <label>View System Logs :</label>
        <a href="systemLog" target="_blank"><button>View</button></a>
    </div>
</div>

<div class="sbContainer">
    <h3>View Monthly Reports</h3>
    <div class="scrollBox">
        <?php
        $oldReportDetails = $data['oldReportDetails'];
        ?>
        <?php if (!empty($oldReportDetails)): ?>
            <?php foreach ($oldReportDetails as $report): ?>
                <div class="listItem">
                    <div class="itemContent">
                        <div class="title">
                            <?= htmlspecialchars($report->report_month_name) ?>
                        </div>
                        <div class="title">
                            Generated on: <?= date('Y-m-d', strtotime($report->generated_at)) ?>
                        </div>
                        <div class="description">
                            <a href="adminReport ? report_id=<?= $report->report_id ?>" target="_blank">Click to view / download report</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="itemsEmpty">No Reports available yet</p>
        <?php endif; ?>
    </div>
</div>