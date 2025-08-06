<link rel="stylesheet" href="<?=ROOT?>assets/css/joblist.css">
<section class="job-section">
    <div class="filtersContainer">
        <div class="filterTypeBox ">
            <label for="salRange">Salary Range:</label><br>
            <input type="range" id="salRange" name="salRange" min="21000" max="10000000" value="21000">
            <div id="salValue">21000</div>
        </div>
        <div class="filterTypeBox ">
            <label>Sort by:</label><br>
            <ul class="radioList">
                <li><label><input type="radio" name="filter"> No filter</label></li>
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
            <div class="listItem">job1</div>
            <div class="listItem">job2</div>
            <div class="listItem">job3</div>
            <div class="listItem">job4</div>
            <div class="listItem">job5</div>
            <div class="listItem">job6</div>
            <div class="listItem">job7</div>
        </div>
    </div>
</section>