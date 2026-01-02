<div class="edit_job_display" id="editJobModel" style="display: none;">
    <div class="editWindow">
        <h1>Edit Job Post</h1>

        <form method="POST" action="<?= ROOT ?>jobdetails/updateJob/<?= $job->job_id ?>">
            <input type="hidden" name="action" value="job_edit">

            <div class="input-field">
                <label>Job Title</label>
                <input type="text" name="posTitle" value="<?= $job->posTitle ?>">
            </div>

            <div class="input-field">
                <label>City</label>
                <input type="text" name="city" value="<?= $job->city ?>">
            </div>

            <div class="input-field">
                <label>Job Description</label>
                <textarea name="jobDescription"><?= $job->jobDescription ?></textarea>
            </div>

            <div class="input-field">
                <label>Salary</label>
                <input type="text" name="salaryDetails" value="<?= $job->salaryDetails ?>">
            </div>

            <div class="form_btns">
                <button type="submit">Save Changes</button>
                <a href="<?= ROOT ?>jobdetails/<?= $job->job_id ?>">
                    <button type="button">Back</button>
                </a>
            </div>
        </form>
    </div>
</div>
