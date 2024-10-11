<?php
include("inc/header/homepage-headscripts.php");
include("inc/header/homepage-navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Mera Darzi</title>
    <link rel="stylesheet" href="/path/to/your/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }
        .about-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 50px;
            margin: 100px auto;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .about-title {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
        }
        .about-description {
            font-size: 1.2em;
            line-height: 1.6;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="about-container">
        <h1 class="about-title">About Us</h1>
        <p class="about-description">
            Welcome to Mera Darzi, your trusted partner in bespoke tailoring and custom clothing. Our mission is to provide you with the finest tailor-made garments that fit your style and personality perfectly. With a rich heritage of craftsmanship and a dedication to quality, Mera Darzi stands at the forefront of the tailoring industry.
        </p>
        <p class="about-description">
            At Mera Darzi, we believe that clothing is more than just fabric; it is a statement of who you are. Our skilled tailors are committed to delivering exceptional service and superior quality, ensuring every stitch and seam is crafted to perfection. We offer a wide range of services, including custom suits, dresses, alterations, and more.
        </p>
        <p class="about-description">
            Our journey began with a simple vision: to make high-quality, custom-fit clothing accessible to everyone. Over the years, we have built a reputation for excellence and reliability, with countless satisfied clients who trust us to bring their fashion dreams to life. Whether you need a sharp business suit, a glamorous evening gown, or a unique piece for a special occasion, Mera Darzi is here to make it happen.
        </p>
        <p class="about-description">
            Thank you for choosing Mera Darzi. We look forward to creating your perfect garment and helping you look your best, always.
        </p>
    </div>
</body>
</html>
<?php
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/inc/footer/homepage-footer-section.php");