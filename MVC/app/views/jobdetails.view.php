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
            <div class="heading_content">
                <h1 class="job_title">Outlet Manager | Colombo</h1>
                <h3 class="company_name">ODEL PLC</h3>
            </div>

            <p class="job_description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt possimus sint
                magnam exercitationem quos, tempore a ipsum blanditiis hic eligendi. Sapiente distinctio doloribus ipsam
                modi non sequi aliquam saepe iusto, dolorum cum odio possimus esse inventore in delectus voluptatum soluta,
                commodi deserunt adipisci laboriosam perferendis. Veritatis a impedit nam porro quos ratione dolorum, saepe
                sapiente earum odio placeat neque sunt numquam qui quia amet possimus harum tempore? Veniam similique
                reprehenderit animi, vel repellat fugiat quas quos deserunt. Neque officia alias blanditiis error inventore
                natus dolorem? Consectetur porro molestiae et totam officia praesentium dolorem nemo earum libero. Impedit
                commodi illum hic?
            </p>
            <div class="jobinfo_box">
                <img class="company_logo" src="<?= ROOT . $data['job']->company_photo_path ?>" alt="Company Logo">
                <h4>Outlet Manager | Colombo</h4>
                <h5>ODEL PLC</h5><br>

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

                <p class="short_details">Colombo</p>
                <p class="short_details">
                    <?php echo $deadlineDisplay ?> </p>
                <p class="short_details">Full time</p>
                <hr><br>

                <p class="requirement">A degree or equivalent and minimum 3 years of experience in a similar role.Please refer
                    to the job advert for
                    further information.</p>
                <div class="job-meta">
                    <table>
                        <tr>
                            <td>Education</td>
                            <td><strong>BSC Degree</strong></td>
                        </tr>
                        <tr>
                            <td>Experience</td>
                            <td><strong>3–5 Years</strong></td>
                        </tr>
                        <tr>
                            <td>Salary Range</td>
                            <td><strong>Any</strong></td>
                        </tr>
                    </table>
                    <hr><br><br>

                    <form action="" method="GET">
                        <button class="apply_job">Apply for a job</button><br>
                        <button class="save_job">Save job</button>
                    </form>
                </div>
            </div>



            <!-- <h2 class="position">Outlet Manager | Colombo</h2>

            <p class="roles">Roles and Responsibilities</p>
            <ul class="responsibilities">
                <li>Managing and motivating team members to achieve performance goals</li>
                <li>Monitoring daily operations to ensure efficiency and quality standards</li>
                <li>Analyzing sales figures and preparing performance reports</li>
                <li>Overseeing inventory management and stock control processes</li>
                <li>Ensuring compliance with company policies and procedures</li>
                <li>Building strong relationships with customers and stakeholders</li>
            </ul> -->
        </div>
    </div>
</body>

</html>