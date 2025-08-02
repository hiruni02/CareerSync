<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/home.css">
        <script>
            function confirm_logout(){
                if(confirm("Are you sure you want to log out") == true){
                    event.preventDefault();
                }
            }
        </script>
        <title>Home</title>
    </head>
    <body>
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
                            <h2 style="font-family: roboto,sans-serif;">Welcome, <?=$username?></h2>
                        <?php
                    }
                ?>
                
            </div>
        </section>
        
        <div class="list-container">
                <div class="jobs">
                    <h3>[ job / internship listing goes here  ]</h3>
                </div>
        </div>
    </div>
    <?php
    include("footer.php");
    ?>
    </body>
</html>