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
                <li><label><input type="radio" name="filter" value="none" checked> No filter</label></li>
                <li><label><input type="radio" name="filter" value="asc"> Ascending order</label></li>
                <li><label><input type="radio" name="filter" value="desc"> Descending order</label></li>
                <li><label><input type="radio" name="filter" value="highsal"> Highest Salary</label></li>
                <li><label><input type="radio" name="filter" value="lowsal"> Lowest Salary</label></li>
            </ul>
        </div>
        <button id="applyFilters" class="apply-filter-btn">Apply Filters</button>
    </div>

    <div class="jobContainer">
        <h3>Featured Jobs:</h3>
        <div class="scrollBox">
            <?php if (!empty($data['jobs'])): ?>
                <?php foreach ($data['jobs'] as $job): ?>
                    <?php
                    $deadlineDisplay = 'N/A';
                    if (!empty($job->deadline)) {
                        try {
                            $today = new DateTime('today');
                            $deadline = new DateTime($job->deadline);
                            if ($deadline < $today) {
                                $deadlineDisplay = "Closed";
                            } else {
                                $diff = $today->diff($deadline);
                                $days = (int)$diff->format("%a");
                                if ($diff === 0) {
                                    $deadlineDisplay = "Today";
                                } elseif ($diff === 1) {
                                    $deadlineDisplay = "1 day left";
                                } else {
                                    $deadlineDisplay = $days . " days left";
                                }
                            }
                        } catch (Exception $e) {
                            $deadlineDisplay = htmlspecialchars($job->deadline);
                        }
                    }
                    ?>
                    <div class="listItem">
                        <a class="jobListLink" href="<?= ROOT ?>jobdetails/<?= urlencode($job->job_id) ?>">
                            <div class="job-header">
                                <img class="company-logo" src="<?= htmlspecialchars($job->company_photo_path) ?>" alt="Logo">
                                <div class="deadline-box" area-hidden="false" title="Application deadline">
                                    <img class="icon" style="margin-bottom: 7px;" src="<?= ROOT ?>assets/svg_icons/clock.svg">
                                    <span class="deadline-text"><?= $deadlineDisplay ?></span>
                                </div>
                            </div>
                            <div class="job-content">
                                <h4 class="job-title"><?= htmlspecialchars($job->posTitle) ?>
                                    <button type="button" class="BM-button">
                                        <!-- <img class="icon" src="<?= ROOT ?>assets/svg_icons/add_bm.svg"> -->
                                    </button>
                                </h4>
                                <h4 class="company-name"><?= htmlspecialchars($job->companyName) ?></h4>
                                <div class="industry"><?= htmlspecialchars($job->industry) ?></div>
                                <div class="meta-item">
                                    <img class="icon" src="<?= ROOT ?>assets/svg_icons/location.svg">
                                    <span class="job-location"><?= htmlspecialchars($job->city) ?></span>
                                </div>
                                <div>
                                    <img class="icon" src="<?= ROOT ?>assets/svg_icons/briefcase.svg">
                                    <span class="job-type"> <?= htmlspecialchars($job->posType) ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No jobs available.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    document.getElementById("applyFilters").addEventListener("click", function(){
        const salary = document.getElementById("salRange").value;
        const sort = document.querySelector('input[name="filter"]:checked').value;
        window.location.href = "<?= ROOT ?>home?salary=" + salary + "&sort=" + sort;
    });

    document.getElementById("salRange").addEventListener("input", function(){
        document.getElementById("salValue").textContent = this.value;
    });
</script>