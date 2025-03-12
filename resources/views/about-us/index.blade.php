<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .parallax {
            background-image: url('https://source.unsplash.com/random/1600x900?nature');
            height: 100%;
            background-attachment: scroll;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .content-section {
            padding: 60px 15px;
            text-align: center;
        }

        .content-section h2 {
            margin-bottom: 20px;
        }

        .content-section p {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .team-section {
            padding: 60px 15px;
            background: #f9f9f9;
        }

        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .parallax {
                background-attachment: scroll;
                background-size: cover;
            }
        }
    </style>
</head>
<body>
    <!-- Parallax Section -->
    <div class="parallax">
        <h1>Tentang Kami</h1>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <h2>Siapa Kami?</h2>
        <p>
            Kami adalah tim profesional yang berdedikasi untuk menyediakan layanan terbaik dalam pengelolaan kost-kostan. 
            Dengan komitmen tinggi terhadap kualitas dan kenyamanan, kami siap membantu Anda menemukan hunian terbaik.
        </p>
    </div>

    <!-- Team Section -->
    <div class="team-section">
        <h2>Tim Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 text-center team-member">
                <img src="https://via.placeholder.com/150" alt="Team Member">
                <h5>John Doe</h5>
                <p>CEO & Founder</p>
            </div>
            <div class="col-md-3 text-center team-member">
                <img src="https://via.placeholder.com/150" alt="Team Member">
                <h5>Jane Smith</h5>
                <p>Marketing Manager</p>
            </div>
            <div class="col-md-3 text-center team-member">
                <img src="https://via.placeholder.com/150" alt="Team Member">
                <h5>Michael Brown</h5>
                <p>Customer Support</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>&copy; 2024 D'Kost Laravel. All Rights Reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("scroll", function () {
            let scrollPos = window.pageYOffset;
            document.querySelectorAll(".parallax").forEach(function (element) {
                let speed = 0.5;
                let yPos = -(scrollPos * speed);
                element.style.backgroundPosition = "center " + yPos + "px";
            });
        });
    </script>
</body>
</html>
