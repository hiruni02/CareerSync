<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/adminDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><a href=""><button class="setting_btn" id="profileBtn">Your Profile</button></a></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
    </ul>
</div>

<div class="message_menu" id="message_menu">
    <ul class="message_list">
        <li class="message">message 1: This is a test message</li>
        <li class="message">message 2: This is a test message</li>
        <li class="message">message 3: This is a test message</li>
        <li class="message">message 4: This is a test message</li>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/adminProfile.php");
?>

<h1 class="dashboard_tag">Dashboard</h1>
<div class="counting_boxes">
    <div class="box_segment">
        Total Users:<br>
        <h1>170</h1>
    </div>
    <div class="box_segment">
        Active Users: <br>
        <h1>67</h1>
    </div>
    <div class="box_segment">
        Pending requests: <br>
        <h1>22</h1>
    </div>
    <div class="box_segment">
        System Alerts: <br>
        <h1>26</h1>
    </div>
    <div class="box_segment">
        New Feedback forms: <br>
        <h1>2</h1>
    </div>
</div>
<div class="sbContainer">
    <h3>User Feedback</h3>
    <div class="scrollBox">
        <?php
        for ($x = 0; $x <= 10; $x++) {
        ?>
            <div class="listItem">
                <div class="itemContent">
                    <div class="title">User ID: 1414</div>
                    <div class="title">User Name: Anuk Thotawatta</div>
                    <div class="description">
                        THE DESCRIPTION GOES HERE.
                        YOU MUST FETCH THIS DESCRIPTION FROM THE DATABASE
                        AND MAKE IT APPEAR HERE. SAME GOES FOR THE TITLE
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
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

<div class="sbContainer">
    <h3>Manage Companies</h3>
    <div class="scrollBox">
        <?php
        $validators = $data['validators'];
        ?>
        <?php if (!empty($validators)): ?>
            <?php foreach ($validators as $val): ?>
                <div class="validator_manager_list_item">
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

<div class="sbContainer">
    <h3>Manage Candidates</h3>
    <div class="scrollBox">
        <?php
        $validators = $data['validators'];
        ?>
        <?php if (!empty($validators)): ?>
            <?php foreach ($validators as $val): ?>
                <div class="validator_manager_list_item">
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

<div class="sbContainer">
    <h3>Manage Counselors</h3>
    <div class="scrollBox">
        <?php
        $validators = $data['validators'];
        ?>
        <?php if (!empty($validators)): ?>
            <?php foreach ($validators as $val): ?>
                <div class="validator_manager_list_item">
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

<div class="sbContainer">
    <h3>Manage Validators</h3>
    <div class="scrollBox">
        <?php
        $validators = $data['validators'];
        ?>
        <?php if (!empty($validators)): ?>
            <?php foreach ($validators as $val): ?>
                <div class="validator_manager_list_item">
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

<div class="genReport">
    <label>Generate a report for the last 30 Days :</label>
    <a href="adminReport ? live=1" target="_blank"><button>Generate</button></a>
</div>