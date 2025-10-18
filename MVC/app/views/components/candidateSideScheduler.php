<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/candidateScheduler.css">

<div class="scheduler_bg">
    <div class="scheduler_window">
        <h1>Schedule Interview</h1>

        <form method="POST">
            <input type="hidden" name="action" value="candidate_scheduler">

            <div class="interview-details">
                <p><strong>Mode:</strong> Online</p>
                <p><strong>Address/Link:</strong> https://zoom.us/j/123456789</p>
                <p><strong>Extra Details:</strong> Please be ready 5 minutes early and ensure your camera is on.</p>
            </div>

            <div class="input-field">
                <label for="selected_date">Pick a comfortable date:</label>
                <select name="selected_date" id="selected_date" required>
                    <option value="" disabled selected hidden>Select a date</option>
                    <option value="2025-10-07T10:00">October 7, 2025 – 10:00 AM</option>
                    <option value="2025-10-07T15:30">October 7, 2025 – 3:30 PM</option>
                    <option value="2025-10-08T09:00">October 8, 2025 – 9:00 AM</option>
                </select>
            </div>

            <div class="form_btns">
                <button type="button" id="schedulerBackBtn" class="back-btn">Back</button>
                <button type="submit" class="send-btn">Confirm Date</button>
            </div>
        </form>
    </div>
</div>