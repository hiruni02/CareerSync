<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/jobdetails.css">
</head>

<body>
    <div class="page-wrapper">
        <?php
        include("components/navbar.php");
        ?>
        <div class='page-content'>
            <div class="container">
                <div class="box left">
                    <div class="heading_content">
                        <h1 class="job_title"><?= $data['job']->posTitle ?> | <?= $data['job']->city ?></h1>
                        <h3 class="company_name"><?= $data['job']->companyName ?></h3>
                    </div>
                    <h3 class="jdTitle">About the Position: </h4><br>
                        <p class="job_description"><?= $data['job']->jobDescription ?></p>
                </div>
                <div class="box right">
                    <div class="jobinfo_box">
                        <img class="company_logo" src="<?= ROOT . $data['job']->company_photo_path ?>" alt="Company Logo">
                        <h4><?= $data['job']->posTitle ?> | <?= $data['job']->city ?></h4>
                        <h5><?= $data['job']->companyName ?></h5><br>
                        <?php
                        $deadlineDisplay = 'N/A';
                        if (!empty($data['job']->deadline)) {
                            try {
                                $today = new DateTime('today');
                                $deadline = new DateTime($data['job']->deadline);
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
                                $deadlineDisplay = htmlspecialchars($data['job']->deadline);
                            }
                        }
                        ?>
                        <p class="short_details"><?= $data['job']->city ?></p>
                        <p class="short_details">
                            <?php echo $deadlineDisplay ?> </p>
                        <p class="short_details"><?= $data['job']->posType ?></p>
                        <hr><br>
                        <p class="requirement"><?= $data['job']->required_skills ?></p>
                        <div class="job-meta">
                            <table>
                                <tr>
                                    <td>Education</td>
                                    <td><strong><?= $data['job']->qualifications ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Experience</td>
                                    <td><strong><?= $data['job']->yearsOfExp ?> Years</strong></td>
                                </tr>
                                <tr>
                                    <td>Salary Range</td>
                                    <td><strong><?= $data['job']->salaryDetails ?></strong></td>
                                </tr>
                            </table>
                            <hr><br><br>
                            <div>
                                <button class="apply_job" onclick="wrongUsr()" id="ApplyBtn">Apply</button><br>
                                <button class="save_job" id="backBtn">Bookmark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include("components/cvDropWindow.php");
                ?>
            </div>

            <!--
            need to add contact information of the company here
            also loaction maybe?
            -->
        </div>
        <?php
        include("components/footer.php");
        ?>
        <?php
        show($_SESSION);
        show($job);
        ?>
    </div>
</body>

<script>
    let userSession = <?= isset($_SESSION['USER']) ? json_encode($_SESSION['USER']->role) : 'null' ?>;

    function wrongUsr() {
        const applyBtn = document.querySelector(".apply_job");
        if (!userSession) {
            alert("You must Log-in in order to apply for a position");
            applyBtn.disabled = true;
        } else if (userSession !== 'candidate') {
            alert("You must register as a candidate in order to apply for a position");
            applyBtn.disabled = true;
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const ApplyBtn = document.getElementById("ApplyBtn");
        const backBtn = document.getElementById("backBtn");
        const cvdw_pageCover = document.querySelector(".cvdw_pageCover");

        ApplyBtn.addEventListener("click", (e) => {
            e.preventDefault();
            cvdw_pageCover.classList.add("active");
            document.body.style.overflow = "hidden";
        });

        backBtn.addEventListener("click", () => {
            cvdw_pageCover.classList.remove("active");
            document.body.style.overflow = "auto";
        });
    });
</script>

</html>