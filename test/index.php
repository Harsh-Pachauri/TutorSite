<?php
// Dynamic variables for title, logo, and contact details (can be extended for more dynamic content)
$pageTitle = "TutorTuition.com - Find the Best Tutors";
$companyLogo = "public/images/whitelogo.png";
$email = "support@tutor-tuition.com";
$phone = "+91 99905 17917";
$currentYear = date("Y"); // Fetches the current year
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $pageTitle; ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset CSS */
        #mb {
            margin-right: 21px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        .floating-circles {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .circle {
            width: 50px;
            height: 50px;
            background-color: #25d366;
            /* WhatsApp green */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 24px;
            transition: background-color 0.3s ease;
        }

        .call {
            background-color: #34b7f1;
            /* Blue for call */
        }

        .circle:hover {
            background-color: #128c7e;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            background-color: #f4f7fc;
            color: #333;
            overflow-x: hidden;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .container1 {

            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Section */
        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo img {
            max-width: 150px;
        }

        header nav {
            display: flex;
            align-items: center;
        }

        header .nav-links {
            list-style: none;
            display: flex;
        }

        header .nav-links li {
            margin-left: 20px;
        }

        header .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        header .nav-links li a:hover {
            color: #ffde00;
        }

        .hamburger {
            display: none;
            cursor: pointer;
        }

        .hamburger i {
            font-size: 24px;
            color: #fff;
        }

        /* Hero Section */
        .hero {
            background-color: #007bff;
            color: #fff;
            padding: 100px 0 60px;
            text-align: center;
            margin-top: 70px;
        }

        .hero .container1 {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .hero .hero-content {
            max-width: 50vw;
            text-align: left;
            margin-bottom: 20px;
        }

        .hero .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .hero .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .hero .hero-content .cta-button {
            background-color: #ffde00;
            color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .hero .hero-content .cta-button:hover {
            background-color: #fff;
        }

        .hero .hero-image img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* About Us Section */
        .about {
            padding: 60px 0;
            background-color: #f4f7fc;
            text-align: center;
        }

        .about .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .about .about-text {
            max-width: 600px;
            text-align: center;
            margin-bottom: 20px;
        }

        .about .about-text h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .about .about-text p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .about .about-text .cta-button {
            background-color: #ffde00;
            color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .about .about-text .cta-button:hover {
            background-color: #0056b3;
        }

        .about .about-image img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Features Section */
        .features {
            padding: 60px 0;
            background-color: #fff;
            text-align: center;
        }

        .features .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .feature {
            max-width: 300px;
            margin: 20px 0;
            text-align: center;
            background-color: #f4f7fc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .feature img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .feature h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .feature p {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        /* Footer Section */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        footer .footer-links {
            margin-bottom: 15px;
        }

        footer .footer-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        footer .footer-links a:hover {
            color: #ffde00;
        }

        /* Additional CSS for the hamburger menu */
        header .nav-links {
            display: flex;
            /* Change to flex for the desktop version */
            flex-direction: row;
            /* Horizontal direction by default */
            position: relative;
            /* Ensure default position is relative */
            transition: max-height 0.3s ease-in-out;
            /* Smooth transition for dropdown */
        }

        header .nav-links.active {
            display: block;
            /* Display links when active on smaller screens */
            flex-direction: column;
            /* Vertical direction on smaller screens */
            background-color: #007bff;
            /* Ensure background color for visibility */
            position: absolute;
            /* Position relative to header */
            top: 70px;
            /* Position below the header */
            left: 0;
            width: 100%;
            /* Full width for visibility */
            max-height: 300px;
            /* Set a max-height for dropdown */
            z-index: 1000;
            /* Bring to front */
        }

        header .nav-links {
            display: flex;
            /* Change to flex for the desktop version */
            flex-direction: row;
            /* Horizontal direction by default */
            position: relative;
            /* Ensure default position is relative */
            transition: max-height 0.3s ease-in-out;
            /* Smooth transition for dropdown */
        }

        header .nav-links.active {
            display: block;
            /* Display links when active on smaller screens */
            flex-direction: column;
            /* Vertical direction on smaller screens */
            background-color: #007bff;
            /* Ensure background color for visibility */
            position: absolute;
            /* Position relative to header */
            top: 70px;
            /* Position below the header */
            left: 0;
            width: 100%;
            /* Full width for visibility */
            max-height: 351px;
            /* Set a max-height for dropdown */
            z-index: 1000;
            /* Bring to front */
        }

        #hero {
            padding-top: 5vh;
        }


        .about {
            background-color: #c1e9f4;
        }

        .feature {
            background-color: #c1e9f4;
        }

        #f1 {
            display: flex;
            align-items: center;
        }

        .new2 {
            margin-left: 2vw;
        }

        .carousel-container {
            position: relative;
            width: 50vw;
            height: 50vh;
            overflow: hidden;
            margin-bottom: 2vh;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .card {
            min-width: 50vw;
            height: 50vh;
            background-color: ;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /*box-shadow: 0 5px 15px rgba(0,0,0,0.2);*/
            border-radius: 10px;
            text-align: center;
        }

        /* Responsive font-size based on card size */
        .card h2 {
            font-size: calc(4vw + 1vh);
        }

        .card p {
            font-size: calc(2vw + 0.5vh);
        }

        button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            width: calc(2vw + 2vh);
            /* Circular button with responsive size */
            height: calc(2vw + 2vh);
            /* Circular button with responsive size */
            font-size: calc(1vw + 1vh);
            /* Responsive font size */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .prev {
            opacity: 0.6;
            background-color: #2dacff;
            left: 10px;
        }

        .next {
            opacity: 0.6;
            background-color: #2dacff;
            right: 10px;
        }

        button:hover {
            background-color: #045991;
        }


        #backg {
            background-color: #a3f6ff;
        }

        @media (max-width: 1103px) {
            #herocon {
                max-width: 80vw;
            }

            #carcon {
                width: 80vw;
            }

            #cd {
                min-width: 80vw;
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            #new {
                background-color: #4b9efd;
            }

            header .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 70px;
                left: 0;
                background-color: #007bff;
                padding: 20px 0;
            }

            header .nav-links li {
                margin: 10px 0;
                text-align: center;
            }

            header .hamburger {
                display: block;
            }

            .hero .container {
                flex-direction: column;
            }

            .c2 {
                align-items: center;
            }

            .hero .hero-content {
                text-align: center;
            }

            .about .container {
                flex-direction: column;
            }

            .about .about-image {
                margin-bottom: 20px;
            }

            .features .container {
                flex-direction: column;
            }

            .feature {
                margin: 20px 0;
            }

            header .nav-links {
                display: none;
                /* Hide links on mobile */
                flex-direction: column;
                /* Vertical layout */
            }

            header .nav-links.active {
                display: flex;
                /* Show links when active */
            }

            header .hamburger {
                display: block;
                /* Show hamburger on mobile */
            }
        }

        /* Contact Us Section */
        .contact {
            background-color: #f4f7fc;
            padding: 100px 0;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #a3f6ff;
            color: #333;
        }

        .contact .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .contact h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .contact p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .contact .contact-info {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .contact .contact-info strong {
            font-weight: bold;
            color: #007bff;
        }

        .contact a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .contact a:hover {
            background-color: #0056b3;
        }


        /* Additional responsiveness for small screens */
        @media (max-width: 768px) {
            button {
                width: calc(3vw + 3vh);
                /* Slightly larger buttons on small screens */
                height: calc(3vw + 3vh);
                font-size: calc(2vw + 2vh);
            }
        }

        @media(max-width:409px) {
            #btns {
                display: flex;
                flex-direction: column;
            }

            #mb {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="floating-circles">
        <a href="tel:+91 99905 17917 " class="circle call"><i class="fas fa-phone"></i></a>
        <a href="https://wa.me/+919990517917 " target="_blank" class="circle whatsapp"><i
                class="fab fa-whatsapp"></i></a>
    </div>

    <!-- Header Section -->
    <header>
        <div class="container">
            <div id="f1" class="logo">
                <!-- <img src="images/logo.png" alt="Company Logo"> -->
                <img width="50px" id="header-img" src="<?php echo $companyLogo; ?>" alt="logo" class="navbar-logo">
                <span class="new2">
                    <h2>Tutor Tuition</h2>
                </span>
            </div>
            <nav>
                <ul id="new" class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#contactpart">Contact</a></li> <!-- New Contact link -->
                    <li><a href="public/students/signup-student.php">Get a Tutor</a></li>
                    <li><a href="public/tutors/signup-tutor.php">Become a Tutor</a></li>
                    <li><a href="public/admin/login-admin.php">Login</a></li>
                </ul>
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container1">
            <div id="herocon" class="hero-content">
                <div id="carcon" class="carousel-container">
                    <div class="carousel">
                        <div id="cd" class="card">
                            <h2>Online Coaching in Batches</h2>
                            <p>Tailored learning just for you! Get personalized attention and customized study plans to
                                address your
                                unique academic needs through our online one-on-one sessions.</p>
                        </div>
                        <div id="cd" class="card">
                            <h2>Unlock Your Potential with the Best Tutors</h2>
                            <p>Find the perfect tutor for any subject and achieve academic excellence..</p>
                        </div>
                        <div id="cd" class="card">
                            <h2>Expert Tutors</h2>
                            <p>We provide the best tutors in various subjects to ensure your learning success.</p>
                        </div>
                        <div id="cd" class="card">
                            <h2>Hassle-Free Experience</h2>
                            <p>We value your expertise and ensure you are compensated fairly. Our platform provides
                                competitive
                                rates to help you earn a sustainable income doing what you love.</p>
                        </div>
                    </div>

                    <button class="prev">&#10094;</button> <!-- Using HTML arrow symbol -->
                    <button class="next">&#10095;</button> <!-- Using HTML arrow symbol -->

                </div>
                <div id="btns">
                    <span id="mb">

                        <a class="cta-button" href="public/students/signup-student.php">Get a Tutor</a>

                    </span>
                    <span>

                        <a class="cta-button" href="public/tutors/signup-tutor.php">Become a Tutor</a>

                    </span>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109532/bgimg_rupjzh.png"
                    alt="Hero Image">
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-image">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727110443/TutorTutionLogo_wqpste.png"
                    alt="About Us Image">
            </div>
            <div class="about-text">
                <h2>Who We Are</h2>
                <p>We are a leading tutor bureau dedicated to connecting students with top-notch tutors for
                    personalized, effective learning.</p>
                <p>Our goal is to make education accessible and efficient, providing tailored learning experiences to
                    meet the unique needs of each student.</p>
                <a href="#contactpart" class="cta-button" style="background-color: ">Contact Us</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container c2">
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109532/pexels-ketut-subiyanto-4308095_x8z54i.jpg"
                    alt="Feature Image">
                <h3>Expert Tutors</h3>
                <p>We provide the best tutors in various subjects to ensure your learning success.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109540/student-online-young-cute-girl-glasses-orange-sweater-studying-computer-showing-zen-sign_br4ucc.jpg"
                    alt="Feature Image">
                <h3>Flexible Learning</h3>
                <p>Learn from the comfort of your home with flexible timing that suits your schedule.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727111112/school-teacher-with-globe-background-studying-pupils_23-2147885341_njf4od.avif"
                    alt="Feature Image">
                <h3>Global Tutors</h3>
                <p>Get access to a global network of highly qualified tutors from around the world.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727110562/young-mother-working-from-home-with-daughter_329181-18974_ruhfw9.avif"
                    alt="Feature Image">
                <h3>Home Tuitions</h3>
                <p>Enjoy the comfort of learning at home with one-on-one personal guidance from our expert tutors. We
                    bring quality education directly to your doorstep.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109445/free-trial_rznuo7.jpg"
                    alt="Feature Image">
                <h3>Free Trial Class</h3>
                <p>Not sure where to start? Try a free class to experience our high-quality tutoring first-hand, with no
                    obligation to continue unless you're satisfied.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727110685/smiley-woman-with-headphones-working-laptop_23-2148764546_mbybpy.avif"
                    alt="Feature Image">
                <h3>Online Personalized Coaching</h3>
                <p>Tailored learning just for you! Get personalized attention and customized study plans to address your
                    unique academic needs through our online one-on-one sessions.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109499/online-batch_rdb7dt.jpg"
                    alt="Feature Image">
                <h3>Online Coaching in Batches</h3>
                <p>Experience virtual classrooms with our online batch coaching. Interact with peers, ask questions, and
                    access recorded lessons for review from anywhere, anytime.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727110831/female-african-american-speaker-giving-presentation-hall-university-workshop_155003-3579_idzlia.avif"
                    alt="Feature Image">
                <h3>Offline Coaching in Batches</h3>
                <p>Join our engaging in-person group classes with experienced tutors. Benefit from a collaborative
                    learning environment and boost your academic performance with structured sessions.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109499/hastle-free_eilkl9.jpg"
                    alt="Feature Image">
                <h3>Hassle-Free Experience</h3>
                <p>We take care of the administrative burden, so you can focus on teaching. No more worrying about
                    finding students, we handle everything for you.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109498/high-perks_b9ccmg.jpg"
                    alt="Feature Image">
                <h3>Exciting Perks</h3>
                <p>We value your expertise and ensure you are compensated fairly. Our platform provides competitive
                    rates to help you earn a sustainable income doing what you love.</p>
            </div>
            <div class="feature">
                <img src="https://res.cloudinary.com/dzffxmfsu/image/upload/v1727109501/right-connection_qa9npk.jpg"
                    alt="Feature Image">
                <h3>Connecting You with the Right Students</h3>
                <p>We match you with students that fit your teaching style and expertise, ensuring a smooth and
                    rewarding teaching experience without any stress or tension.</p>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact backg " class="contact">
        <div id="contactpart" class="container ">
            <h2>Contact Us</h2>
            <p>We're here to help! Get in touch with us via email or phone.</p>
            <div class="contact-info">
                <p><strong>Email:</strong>
                    <?php echo $email; ?>
                </p>
                <p><strong>Call/WhatsApp:</strong> <strong>
                        <?php echo $phone; ?>
                    </strong></p>
            </div>
            <a href="tel:<?php echo $phone; ?>">Call Now</a>
            <a href="mailto:<?php echo $email; ?>">Send Us an Email</a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy;
                <?php echo $currentYear; ?> TutorTuition.com . All Rights Reserved.
            </p>
            <br>
            <p>
                Developed by Harsh Pachauri and Kawaljeet Singh
            </p>
        </div>
    </footer>

    <script>
        // JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        const carousel = document.querySelector('.carousel');
        const cards = document.querySelectorAll('.card');
        let currentIndex = 0;
        const intervalTime = 3000; // Auto change every 3 seconds

        // Get the actual width of the card in pixels, then convert it to vw (viewport width)
        const getCardWidth = () => {
            const cardWidthInPixels = cards[0].offsetWidth; // Get card width in pixels
            const vw = (cardWidthInPixels / window.innerWidth) * 100; // Convert pixels to vw
            return vw; // Return width in vw units
        };

        // Move to next card
        const nextCard = () => {
            currentIndex++;
            if (currentIndex >= cards.length) {
                currentIndex = 0; // Go back to the first card
            }
            const cardWidth = getCardWidth(); // Get current card width in vw
            carousel.style.transform = `translateX(-${currentIndex * cardWidth}vw)`;
        };

        // Move to previous card
        const prevCard = () => {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = cards.length - 1; // Go to the last card
            }
            const cardWidth = getCardWidth(); // Get current card width in vw
            carousel.style.transform = `translateX(-${currentIndex * cardWidth}vw)`;
        };

        // Auto-slide functionality
        let autoSlide = setInterval(nextCard, intervalTime);

        // Manual next button
        document.querySelector('.next').addEventListener('click', () => {
            nextCard();
            resetAutoSlide();
        });

        // Manual previous button
        document.querySelector('.prev').addEventListener('click', () => {
            prevCard();
            resetAutoSlide();
        });

        // Reset the auto-slide timer when user interacts manually
        const resetAutoSlide = () => {
            clearInterval(autoSlide);
            autoSlide = setInterval(nextCard, intervalTime);
        };

        // Recalculate card width when the window is resized
        window.addEventListener('resize', () => {
            const cardWidth = getCardWidth(); // Recalculate card width on resize
            carousel.style.transform = `translateX(-${currentIndex * cardWidth}vw)`;
        });


    </script>
</body>

</html>