<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/home.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/joblist.css">
        <script>
            function confirm_logout(){
                if(confirm("Are you sure you want to log out") == true){
                    event.preventDefault();
                }
            }

            window.onload = function () {
                const rangeInput = document.getElementById("salRange");
                const valueDisplay = document.getElementById("salValue");

                rangeInput.addEventListener("input", function () {
                valueDisplay.textContent = Number(this.value).toLocaleString();
                });
            };
        </script>
        <title>Home</title>
    </head>
    <body>
        <div class="page-wrapper">
            <?php
            include("navbar.php");
            ?>
            <div class='page-content'>
                <section class="intro">
                    <div class="intro-content">
                        <h1>Empowering Careers. Connecting Talent.</h1>
                        <p style="padding-bottom: 50px;">One platform for potential employees, companies collaborate.</p>
                        <?php
                            if($username=='User'){
                        ?>
                                <p style=" font-size: 20px; padding-bottom:20px;">you are currently exploring as a guest.<br> would you like to:</p>
                                <div class="intro-buttons">
                                    <a href="login"><button class="intro-btn">Login</button></a>
                                    <p style=" font-size: 25px;">- or -</p>
                                    <a href="welcome"><button class="intro-btn secondary">Register</button></a>
                                </div>
                        <?php
                            }else{
                                ?>
                                    <h2 style="font-family: roboto,sans-serif;">Welcome, <?=$username?></h1>
                                <?php
                            }
                        ?>
                        
                    </div>
                </section>
                <section class="job-section">
                <div class="filtersContainer">
                    <label for="salRange">Salary Range:</label><br>
                    <input type="range" id="salRange" name="salRange" min="21000" max="10000000" value="21000">
                    <div id="salValue">21000</div>
                </div>
                    <div class="jobContainer">
                        <div class="scrollBox">
                            <h3 style="padding-bottom: 25px;">Select a position</h3>
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
            </div>
            <?php
            include("footer.php");
            ?>
        </div>
    </body>
</html>