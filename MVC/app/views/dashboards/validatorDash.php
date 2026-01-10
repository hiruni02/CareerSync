<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/validatorDash.css">

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
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/validatorProfile.php");
?>

<h1 class="dashboard_tag">Welcome back <?php echo $validatorTable->firstName; ?> !</h1>
<div class="counting_boxes">
    <div class="box_segment">
        Companies to validate:<br>
        <h1>23</h1>
    </div>
    <div class="box_segment">
        Candidates to validate: <br>
        <h1>34</h1>
    </div>
    <div class="box_segment">
        Unread messages: <br>
        <h1>2</h1>
    </div>
</div>

<div class="sbContainer">
    <h3> Pending Company registration requests:</h3>
    <div class="scrollBox">
        <?php
        for ($x = 0; $x <= 10; $x++) {
        ?>
            <div class="listItem">
                <div class="itemContent">
                    <div class="title">Company Name</div>
                    <div class="description">
                        THE DESCRIPTION GOES HERE.
                        YOU MUST FETCH THIS DESCRIPTION FROM THE DATABASE
                        AND MAKE IT APPEAR HERE. SAME GOES FOR THE TITLE
                    </div>
                </div>
                <form method="post" class="formButtons">
                    <input type="hidden" name="action" value="validateCompany">
                    <button type="submit" name="approve" value="approve" class="approveBtn">Approve</button>
                    <button type="submit" name="reject" value="reject" class="rejectBtn">Reject</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<!-- <div class="sbContainer">
    <h3> Pending Student registration requests:</h3>
    <div class="scrollBox">
        <?php
        for ($x = 0; $x <= 10; $x++) {
        ?>
            <div class="listItem">
                <div class="itemContent">
                    <div class="title">Student Application Name</div>
                    <div class="description">
                        THE DESCRIPTION GOES HERE.
                        YOU MUST FETCH THIS DESCRIPTION FROM THE DATABASE
                        AND MAKE IT APPEAR HERE. SAME GOES FOR THE TITLE
                    </div>
                </div>
                <form method="post" class="formButtons">
                    <input type="hidden" name="action" value="validateCandidate">
                    <button type="submit" name="approve" value="approve" class="approveBtn">Approve</button>
                    <button type="submit" name="reject" value="reject" class="rejectBtn">Reject</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</div> -->

<div class="sbContainer">
    <h3> Pending Student Application:</h3>
    <div class="scrollBox">
        <?php
        // filter pending applications
        $pendingCvs = array_filter($data['applications'], function ($cvs) {
            return $cvs->validator_approval === 'pending';
        });
        ?>

        <?php if (!empty($pendingCvs)): ?>
            <?php foreach ($pendingCvs as $cvs): ?>
                <div class="listItem">
                    <div class="itemContent">
                        <div class="title">
                            <?= htmlspecialchars($cvs->firstName . ' ' . $cvs->lastName) ?>
                        </div>
                        <div class="description">
                            Company: <?= htmlspecialchars($cvs->companyName) ?><br>
                            CV: <a href="<?= ROOT . $cvs->cv_file_path ?>" target="_blank">View CV</a>
                        </div>
                    </div>
                    <form method="post" class="formButtons">
                        <input type="hidden" name="action" value="validateCV">
                        <input type="hidden" name="cv_id" value="<?= $cvs->cv_id ?>">
                        <button type="submit" name="approve" value="approve" class="approveBtn">Approve</button>
                        <button type="submit" name="reject" value="reject" class="rejectBtn">Reject</button>
                    </form>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No pending applications available.</p>
        <?php endif; ?>
    </div>
</div>