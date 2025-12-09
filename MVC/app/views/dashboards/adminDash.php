<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/adminDash.css">

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
        for ($x = 0; $x <= 10; $x++) {
        ?>
            <div class="listItem">
                <div class="itemContent">
                    <div class="title">Report No: 12</div>
                    <div class="title">Date: 2025-05-07</div>
                    <div class="description">
                        click to download report
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<div class="genReport">
    <form action="POST">
        <label>Generate a report for the last 30 Days :</label>
        <input type="hidden" name="action" value="reportGen">
        <button id="generate" type="submit">Generate</button>
    </form>
</div>

<script>
    document.getElementById("generate").addEventListener("click", function(e) {
        e.preventDefault(); // stop the form submit

        // Create a blank file
        const file = new Blob([""], {
            type: "text/plain"
        });

        // Create a download link
        const url = URL.createObjectURL(file);

        const a = document.createElement("a");
        a.href = url;
        a.download = "report.txt"; // your file name
        a.click();

        URL.revokeObjectURL(url);
    });
</script>