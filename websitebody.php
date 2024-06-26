<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qr_attendance_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user by email
    $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            // Password is correct, set user as logged in
            $_SESSION['user_id'] = $user['email'];
            // Redirect to the user's profile page
            header("Location: http://localhost/website/qr-code-attendance-system/profile.php?user_id={$user['tbl_student_id']}");
            exit();
        } else {
            // Incorrect password
            $error = "Incorrect password";
        }
    } else {
        // User not found
        $error = "User not found";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The MAGNIFICAT Student Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/old-english-five" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #383a3b;
            font-family: 'Playfair Display', serif;
            height: 100vh;
            margin: 0;
            background-image: url('/img/background4.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body {
            margin: 0;
            padding: 0;
        }


        header {
            background-color: #0a0a4eeb;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 300%;
            font-family: 'Old English Five', sans-serif;
                                                
                                             
        }



        header img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        nav {
            background-color: #e5e7e9;
            padding: 10px;
            text-align: center;
            font-family: 'Bebas Neue', sans-serif;
            color:#f8f9fa00
            
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            color:#f8f9fa
            
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
            max-width: 100%;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            transition: color 0.3s;
            color:#f8f9fa
        }

        nav ul li a:hover {
            color: #ffcc00;
        }

        section {
            padding: 40px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #050232;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #05c1ff76;
        }

        #countdownTimer {
            font-size: 24px;
            text-align: center;
            color: #050232;
        }

        footer {
            background-color: #2188f07e;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .widget {
            display: none;
            padding: 15px 24px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0);
            margin-top: 20px;
            max-width: 100%;
            
            
        }

        .widget h3 {
            color: #050232;
        }

        .widget p {
            color: #1395e0;
        }

        .image-container {
            position: relative;
            overflow: hidden;
            width: 320px; 
            height: 250px; 
            
        }

        
        .image-container img {
            width: 100%;
            height: 100%;
            transition: opacity 0.3s ease-in-out;
            position: absolute;
            top: 0;
            left: 0;
            
        }

        .image-container img:nth-child(2) {
            opacity: 0;
        }

      
        .image-container:hover img:nth-child(2) {
            opacity: 1;
        }

        .one {
            width: 350px; 
            height: 250px;
        }

        .front-gate {
            position: relative;
            overflow: hidden;
            width: 1190px; 
            height: 100px;
            max-width: 100%;
       
        }

        .front-gate img {
            width: 100%;
            height: 100%;
            transition: opacity 0.3s ease-in-out;
            position: absolute;
            top: 0;
            left: 0;
        }

        .front-gate img:nth-child(2) {
            opacity: 0;
        }

        .front-gate:hover img:nth-child(2) {
            opacity: 1;
        }

        .logo2 {
            max-width: 35px;
            max-height: 60px;
        }
        
        .nav-link {
            font-size: 20px;
        }
       
        .navbar {
            background-color: #1f8adc;
        }


    </style>
</head>

<body>
    <header>
        <h1>School of Mount St. Mary, Inc.</h1> 
       <div class="front-gate"> 
           <img src="/img/fronts.png" alt="gate of smsm cartoon" class="img-fronts">
           <img src="/img/stemgirls1.PNG" class="rickroll1">
       </div>
    </header>

    <nav class="navbar navbar-expand-lg">
        <ul class="navbar-nav mr-auto">
            <img src="/img/logo.png" class="logo2"> 
            <li class="nav-item"><a class="nav-link" href="#home" onclick="smoothScroll('home')">School</a></li>
            <li class="nav-item"><a class="nav-link" href="#about" onclick="smoothScroll('about')">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#Attendance" onclick="smoothScroll('contact')">Attendance</a></li>
            <li class="nav-item"><a class="nav-link" href="#Images" onclick="smoothScroll('Images')">Images</a></li>
        </ul>
    </nav>

    <section>
        <h2 class="text-center" style="font-size:250%;">The MAGNIFICAT Student Portal</h2>
        <p class="text-center" style="font-size:150%">Explore the world of education with us.</p>
    </section>

    <section id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 style="font-size:200%;">Our School</h2>
                    <p style="font-size:100%;">School of Mount St. Mary, Inc. features academically empowered learners, exceptionally well-trained teachers, well-mannered faculty staffs and non-staffs.</p>
                    <button onclick="toggleWidget()" class="btn btn-primary" style="font-size: 2vw;">Explore Features</button>
                 </div>
                 <meta charset="UTF-8">
                 <meta name="viewport" content="width=device-width, initial-scale=1.0">
                 <div class="wrapper">
                    <figure>
                        <div class="image-container">
                           <img src="/img/three.jpg" alt="smsm students" class="one">
                           <img src="/img/two.jpg" alt="smsm students and teacher" class="three">
                        </div>
                      </figure>
                 </div>
            </div>
            <div class="widget" id="homeWidget">
                <h3>Additional Features</h3>
                <p>Discover more about our home section. We offer personalized learning, interactive courses, and much more.</p>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/OHrfPIOylB4" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="/img/one.jpg" alt="smsm building" class="one">
                </div>
                <div class="col-md-6">
                    <h2 style="font-size: 200%;">About the School</h2>
                     <p style="font-size: 100%;"> It offers Preschool, Grade School, Junior High School, and Senior High School with academic strands such as Science Technology and Engineering (STEM), Accountancy Business Management (ABM), General Academic Strand (GAS), and Humanities and Social Sciences (HUMSS).</p>
                </div>
            </div>
        </div>
    </section>

    <section id="Attendance">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 style="font-size: 200%;">Attendance Section</h2>
                <p style="font-size: 100%;">Access your Attendance information by entering your personal email given to you. </p>

                <div id="login-container">
                    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" required><br>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" required><br>

                        <button type="submit" value="Login">Login</button><p><a href="admin-login.html">If you're an Admin click here.</a></p>
                    </form>
                    
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>


    <section id="countdown">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center" style="font-size: 2vw;">Event Countdown</h2>
                    <p id="countdownTimer" class="text-center" style="font-size: 2vw"></p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 feature">
                    <i class="fas fa-book"></i>
                    <h3 style="font-size: 100%;">School Mission</h3>
                    <p style="font-size: 75%;">To continue providing quality education to the youth for the maximum development of their potentials, values, and attitudes by creating a supportive environment that enables them to meet challenges leading to their growth as Christians, human beings, Filipinos and learners.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3 style="font-size: 100%;">School Theme</h3>
                    <p style="font-size: 75%;">Promoting a peaceful, caring, and safe environment to produce academically empowered learners.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fas fa-graduation-cap"></i>
                    <h3 style="font-size: 100%;">School Vision</h3>
                    <p style="font-size: 75%;">The School of Mount St. Mary is a private co-educational institution that provides the development of students who love and serve God, who are prepared to excel in complex, interconnected changing world, ecologically supportive, and responsible for their community and nation.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-white bg-dark">
        <div class="container">
            <p>&copy; 2024 The MAGNIFICAT Student Portal. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
        function smoothScroll(targetId) {
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 50,
                    behavior: 'smooth'
                });
            }
        }
        function smoothScroll(target) {
            document.querySelector(target).scrollIntoView({
                behavior: 'smooth'
            });
        }

        function toggleWidget() {
            var widget = document.getElementById('homeWidget');
            if (widget.style.display === 'none') {
                widget.style.display = 'block';
            } else {
                widget.style.display = 'none';
            }
        }

        function setCountdown() {
            const eventDate = new Date('2024-12-31T23:59:59');
            const currentDate = new Date();

            const timeDifference = eventDate - currentDate;

            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            document.getElementById('countdownTimer').innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        setInterval(setCountdown, 1000);
        setCountdown(); 


        // Simple email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Toggle widget visibility
        function toggleWidget() {
            const homeWidget = document.getElementById('homeWidget');
            if (homeWidget.style.display === 'none' || homeWidget.style.display === '') {
                homeWidget.style.display = 'block';
                smoothScroll('homeWidget');
            } else {
                homeWidget.style.display = 'none';
            }
        }

        var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("slide");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].classList.remove("active");
      }
      slides[slideIndex-1].classList.add("active");
    }
    </script>

</body>

</html>

<?php
// Flush the output buffer and send buffered output to the browser
ob_end_flush();
?>
