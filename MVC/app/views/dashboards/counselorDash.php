<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/counselorDash.css">

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
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/counselorProfile.php");
?>

<h1 class="dashboard_tag">Counselor Dashboard</h1>

<div class="counting_boxes">
    <div class="box_segment">
        Assigned Students:<br>
        <h1>35</h1>
    </div>
    <div class="box_segment">
        Scheduled Sessions: <br>
        <h1>12</h1>
    </div>
    <div class="box_segment">
        Pending Approvals: <br>
        <h1>5</h1>
    </div>
    <div class="box_segment">
        Messages: <br>
        <h1>8</h1>
    </div>
    <div class="box_segment">
        Feedback Received: <br>
        <h1>3</h1>
    </div>
</div>

<div class="content_section">
    <div class='Clients'>
        <h1>Clients</h1>
        <div class="scrollBox">
            <ul class="applications">
                <li class="application_item">
                    <div class="application-title">Kavi</div>
                    <div class="application_state"><span class="status requested">requested</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Suman</div>
                    <div class="application_state"><span class="status completed">completed</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Lisa</div>
                    <div class="application_state"><span class="status pending">pending</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Rahul</div>
                    <div class="application_state"><span class="status completed">completed</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Yohan</div>
                    <div class="application_state"><span class="status pending">pending</span></div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="schedule_session">
<button class="schedule_btn">Schedule a Session with candidate</button>
</div>



<div class="popup-overlay">
        <div class="popup-box">
            <div class="popup-header">
                <h2>Schedule interview with candidate</h2>
            </div>
            <div class="popup-content">
                <!-- Online or Physical Section -->
                <div class="form-section">
                    <h3>Online or Physical</h3>
                    <p>Select interview medium</p>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="interview-mode" value="online" checked>
                            Online
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="interview-mode" value="physical">
                            Physical
                        </label>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Address/Link Section -->
                <div class="form-section">
                    <div class="input-group">
                        <label for="address-link">Address/Link</label>
                        <input type="text" id="address-link" placeholder="physical address or link">
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Extra Details Section -->
                <div class="form-section">
                    <div class="input-group">
                        <label for="extra-details">Extra Details</label>
                        <textarea id="extra-details" placeholder="Additional info (optional)"></textarea>
                    </div>
                </div>

                <!-- Date/Time Section -->
                <div class="form-section">
                    <div class="input-group">
                        <label>Interview Date & Time</label>
                        <div class="date-time-group">
                            <div class="date-time-item">
                                <input type="datetime-local" value="2023-11-15T10:00">
                            </div>
                            <div class="date-time-item">
                                <input type="datetime-local" value="2023-11-16T14:00">
                            <button type="button" class="remove-date-btn">❌</button>
                            </div>
                        </div>
                        <button type="button" class="add-date-btn">
                            <span>+</span> Add another date/time
                        </button>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="button" class="btn btn-back">Back</button>
                    <button type="button" class="btn btn-send">Send Dates</button>
                </div>
            </div>
        </div>
    </div>

    <script>
// Get elements
const scheduleBtn = document.querySelector('.schedule_btn');
const popupOverlay = document.querySelector('.popup-overlay');
const backBtn = document.querySelector('.btn-back');

popupOverlay.style.display = 'none';

scheduleBtn.addEventListener('click', () => {
    popupOverlay.style.display = 'flex'; 
});

backBtn.addEventListener('click', () => {
    popupOverlay.style.display = 'none';
});

popupOverlay.addEventListener('click', (e) => {
    if (e.target === popupOverlay) {
        popupOverlay.style.display = 'none';
    }
});
</script>

</body>
</html>