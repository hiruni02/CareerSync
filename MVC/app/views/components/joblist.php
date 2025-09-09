<link rel="stylesheet" href="<?= ROOT ?>assets/css/joblist.css">
<section class="job-section">
    <div class="filtersContainer">
        <div class="filterTypeBox ">
            <h2>Filters :</h1>
                <label for="salRange">Salary Range:</label><br>
                <input type="range" id="salRange" name="salRange" min="21000" max="10000000" value="210000">
                <div id="salValue">21000</div>
        </div>
        <div class="filterTypeBox ">
            <label>Sort by:</label><br>
            <ul class="radioList">
                <li><label><input type="radio" name="filter" checked> No filter</label></li>
                <li><label><input type="radio" name="filter"> Ascending order</label></li>
                <li><label><input type="radio" name="filter"> Descending order</label></li>
                <li><label><input type="radio" name="filter"> Highest Salary</label></li>
                <li><label><input type="radio" name="filter"> Lowest Salary</label></li>
            </ul>
        </div>


    </div>
    <div class="jobContainer">
        <h3>Select a position:</h3>
        <div class="scrollBox">
            <?php if (!empty($data['jobs'])): ?>
                <?php foreach ($data['jobs'] as $job): ?>
                    <div class="listItem">
                        <div class="job-content">
                            <div class="job-title"><?= htmlspecialchars($job->posTitle) ?></div>
                            <div class="job-description">
                                <?= nl2br(htmlspecialchars($job->jobDescription)) ?>
                            </div>
                            <div class="job-salary">Salary: <?= htmlspecialchars($job->salaryDetails) ?></div>
                            <div class="job-deadline">Deadline: <?= htmlspecialchars($job->deadline) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No jobs available.</p>
            <?php endif; ?>
        </div>
    </div>
</section>