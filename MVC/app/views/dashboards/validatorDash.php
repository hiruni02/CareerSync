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
        <?php $companyDetails = $data['companyDetails']; ?>
        <?php if (!empty($companyDetails)): ?>
            <?php foreach ($companyDetails as $cd): ?>
                <div class="companylistItem">
                    <img src="<?= ROOT . htmlspecialchars($cd->company_photo_path) ?>" alt="company photo" class="photo">
                    <div class="itemContent">
                        <div class="title"></div>
                        <div class="details"><label>Company Name: </label><?= htmlspecialchars($cd->companyName) ?></div>
                        <div class="details"><label>User ID: </label><?= htmlspecialchars($cd->user_id); ?></div>
                        <div class="details"><label>HR manager Name: </label><?= htmlspecialchars($cd->hr_firstName . ' ' . $cd->hr_lastName); ?></div>
                        <div class="details"><label>Email: </label><?= htmlspecialchars($cd->email); ?></div>
                        <div class="details"><label>Comapny Contact No: </label><?= htmlspecialchars($cd->contactNo); ?></div>
                        <div class="details"><label>HR Contact No: </label><?= htmlspecialchars($cd->hr_contactNo); ?></div>
                        <div class="details"><label>Business Certificate: </label><a target="_blank" href="<?= $cd->business_certificate ?>">click here to view</a></div>
                        <form method="post">
                            <input type="hidden" name="action" value="validateCompany">
                            <button type="submit" name="approve" value="approve" class="acceptBtn">Approve</button>
                            <button type="submit" name="reject" value="reject" class="denyBtn">Reject</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='itemsEmpty'>No pending applications available.</p>
        <?php endif; ?>
    </div>
</div>

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