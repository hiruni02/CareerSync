<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/dash.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="page-wrapper">
        <?php
        include("components/navbar.php");
        ?>
        <div class="page-content">
            <div class="settings_btn" onclick="toggleSettings()">
                <img src="<?= ROOT ?>assets/images/settings_icon.png" alt="settings_btn">
            </div>
            <div class="messeges_btn" onclick="toggleMesseges()">
                <img src="<?= ROOT ?>assets/images/messeges_icon.png" alt="messeges_btn">
            </div>
            <?php
            switch ($_SESSION['USER']->role) {
                case 'admin':
                    include("dashboards/adminDash.php");
                    break;
                case 'candidate':
                    include("dashboards/candidateDash.php");
                    break;
                case 'counselor':
                    include("dashboards/counselorDash.php");
                    break;
                case 'validator':
                    include("dashboards/validatorDash.php");
                    break;
                case 'company':
                    include("dashboards/companyDash.php");
                    break;
            }
            ?>
        </div>
    </div>
    <script>
        function toggleSettings() {
            const settings_menu = document.getElementById('settings_menu');
            const messege_menu = document.getElementById('messege_menu');
            settings_menu.classList.toggle('active');
            messege_menu.classList.remove('active');
        }

        function toggleMesseges() {
            const messege_menu = document.getElementById('messege_menu');
            const settings_menu = document.getElementById('settings_menu');
            messege_menu.classList.toggle('active');
            settings_menu.classList.remove('active');
        }

        document.addEventListener("DOMContentLoaded", () => {
            const profileBtn = document.getElementById("profileBtn");
            const backBtn = document.getElementById("backBtn");
            const profileDisplay = document.querySelector(".profile_display");
            const editBtn = document.getElementById("editBtn");
            const edit_backBtn = document.getElementById("edit_backBtn");
            const editProfile = document.querySelector(".edit_profile_display");

            profileBtn.addEventListener("click", (e) => {
                e.preventDefault();
                profileDisplay.classList.add("active");
                document.body.style.overflow = "hidden";
            });

            backBtn.addEventListener("click", () => {
                profileDisplay.classList.remove("active");
                document.body.style.overflow = "auto";
            });

            editBtn.addEventListener("click", (e) => {
                e.preventDefault();
                editProfile.classList.add("active");
                document.body.style.overflow = "hidden";
            });

            edit_backBtn.addEventListener("click", () => {
                editProfile.classList.remove("active");
                document.body.style.overflow = "auto";
            });
        });

        function show_password() {
            console.log(document.getElementById("pass").type);
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("eye1").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
            } else {
                x.type = "password";
                document.getElementById("eye1").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";

            }
        }

        function show_confirm_password() {
            console.log(document.getElementById("confirm_pass").type);
            var x = document.getElementById("confirm_pass");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("eye2").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
            } else {
                x.type = "password";
                document.getElementById("eye2").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";

            }
        }

        function show_old_password() {
            console.log(document.getElementById("oldPass").type);
            var x = document.getElementById("oldPass");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("eye0").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
            } else {
                x.type = "password";
                document.getElementById("eye0").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";

            }
        }
    </script>
    <?php if (!empty($errors)): ?>
        <!-- error handling for edit profile and edit password -->
        <script> 
            document.addEventListener("DOMContentLoaded", () => {
                <?php if (isset($errors['email']) || isset($errors['admin_photo_path']) || isset($errors['confirm_password'])): ?>
                    document.querySelector(".profile_display").classList.add("active");
                    document.querySelector(".edit_profile_display").classList.add("active");
                <?php endif; ?>
                <?php if (isset($errors['oldPassword']) || isset($errors['confirm_new_password'])): ?>
                    document.querySelector(".editPwDisplay").classList.add("active");
                <?php endif; ?>
                document.body.style.overflow = "hidden";
            });
        </script>
    <?php endif; ?>

</body>

</html>