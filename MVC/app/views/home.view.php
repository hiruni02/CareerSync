<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/navbar.css">
        <style>
            .intro {
                
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px;
                text-align: center;
            }

            .intro-content h1 {
                font-size: 42px;
                color: #1e1f4b;
                margin-bottom: 20px;
                font-weight: 800;
            }

            .intro-content p {
                font-size: 20px;
                color: #333;
                margin-bottom: 20px;
            }

            .intro-buttons {
                display: flex;
                justify-content: center;
                gap: 20px;
                flex-wrap: wrap;
            }

            .intro-btn {
                padding: 10px 32px;
                font-size: 16px;
                font-weight: 600;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                color: #fff;
                background: linear-gradient(to right, #1e1f4b, #662a86);
                transition: 0.3s ease;
            }

            .intro-btn.secondary {
                padding: 8px 28px;
                background: transparent;
                border: 2px solid #1e1f4b;
                color: #1e1f4b;
            }

            .intro-btn:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            }
        </style>
        <title>Home</title>
    </head>
    <body>
    <nav class="navbar">
    <div class="navbar-left">
        <div class="name">CareerSync</div>
        <ul class="navbar_links">
        <li><a href="home"><button class="navbtn" disabled>Home</button></a></li>
        <li><a href="about"><button class="navbtn">About</button></a></li>
        <li><a href="contact"><button class="navbtn">Contact</button></a></li>
        </ul>
    </div>

    <ul class="navbar_right">
        <li><a href="login"><button class="navbtn">Login</button></a></li>
        <li><a href="welcome"><button class="navbtn">Register</button></a></li>
    </ul>
    </nav>
    <div class='page-content'>
        <section class="intro">
            <div class="intro-content">
                <h1>Empowering Careers. Connecting Talent.</h1>
                <p style="padding-bottom: 50px;">One platform for potential employees, companies collaborate.</p>
                <p style=" font-size: 25px;">you are currently exploring as a guest.<br> would you like to:</p>
                <div class="intro-buttons">
                    <a href="login"><button class="intro-btn">Login</button></a>
                    <p style=" font-size: 25px;">- or -</p>
                    <a href="welcome"><button class="intro-btn secondary">Register</button></a>
                </div>
            </div>
        </section>
    </div>
    </body>
</html>