<link rel="stylesheet" href="<?= ROOT ?>assets/css/navbar.css">
<div class="desktop">
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">CareerSync</div>
            <ul class="navbar_links">
                <li><a href="home"><button class="navbtn">Home</button></a></li>
                <li><a href="about"><button class="navbtn">About</button></a></li>
                <li><a href="contact"><button class="navbtn">Contact</button></a></li>
                <?php
                if ($username != 'User') {
                ?>
                    <li><a href="dashboard"><button class="navbtn" style="padding: 0px;">Dashboard</button></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <ul class="navbar_right">
            <?php
            if ($username == 'User') {
            ?>
                <li><a href="login"><button class="navbtn">Login</button></a></li>
                <li><a href="welcome"><button class="navbtn">Register</button></a></li>
            <?php
            } else {
            ?>
                <li><a href="logout" onclick="return confirm('Are you sure you want to log out?');"><button class="navbtn">Log out</button></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</div>
<div class="mobile">
    <nav class="navbar">
        <div class="hamburger_btn" onclick="toggleMenu()">
            <img src="<?= ROOT ?>assets/images/options_btn.png" alt="options_btn">
        </div>
        <div class="logo">CareerSync</div>
    </nav>

    <div class="mobile_menu" id="mobileMenu">
        <ul class="mobile_links">
            <li><a href="home"><button class="navbtn">Home</button></a></li>
            <li><a href="about"><button class="navbtn">About</button></a></li>
            <li><a href="contact"><button class="navbtn">Contact</button></a></li>
            <?php if ($username != 'User') { ?>
                <li><a href="dashboard"><button class="navbtn">Dashboard</button></a></li>
            <?php } ?>
            <?php if ($username == 'User') { ?>
                <li><a href="login"><button class="navbtn">Login</button></a></li>
                <li><a href="welcome"><button class="navbtn">Register</button></a></li>
            <?php } else { ?>
                <li><a href="logout" onclick="return confirm('Are you sure you want to log out?');"><button class="navbtn">Log out</button></a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<script>
function toggleMenu() {
  const menu = document.getElementById('mobileMenu');
  menu.classList.toggle('active');
}
</script>