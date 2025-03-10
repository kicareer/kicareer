<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <!-- CSS -->
        
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
             
        <style>
            /* Google Fonts - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e0ecfb;
}
nav{
    border-radius: 12px;
    background: #FFF;
    padding: 0 25px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    margin-top: -600px
}
.nav-content{
    display: flex;
    height: 120px;
    align-items: center;
    list-style: none;
    position: relative;
}
.link-item{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 120px;
    width: 95px;
    text-decoration: none;
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.link-item.active{
    transform: translateY(-10px);
}
.link-icon{
    font-size: 38px;
    color: #999;
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.link-item.active .link-icon{
    color: #4070F4;
}
.link-text{
    position: absolute;
    font-size: 12px;
    font-weight: 500;
    color: #4070F4;
    opacity: 0;
    transform: translateY(32px);
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.link-item.active .link-text{
    opacity: 1;
}


/* GG */
body {
  background-color: #e0ecfb;
  font-family: 'Poppins', sans-serif;
}

.container {
  position: absolute;
  height: 300px;
  width: 600px;
  top: 60px;
  left: calc(50% - 300px);
  display: flex;
  margin-top: 300px;
}

.card {
  display: flex;
  height: 300px;
  width: 220px;
  background-color: #17141d;
  border-radius: 10px;
  box-shadow: -1rem 0 3rem #000;
  transition: 0.4s ease-out;
  position: relative;
  overflow: hidden; /* Ensures images fit within the card without spilling over */
  flex-direction: column;
}

.card:not(:first-child) {
  margin-left: -50px;
}

.card:hover {
  transform: translateY(-20px);
  transition: 0.4s ease-out;
}

.card:hover ~ .card {
  position: relative;
  left: 50px;
  transition: 0.4s ease-out;
}

/* Make image cover entire card */
.card-img {
  width: 100%;
  height: 100%; /* Ensure it takes full height */
  object-fit: cover; /* Ensures the image covers the area and maintains aspect ratio */
  border-radius: 10px; /* Rounded corners on entire image */
  position: absolute;
  top: 0;
  left: 0;
}

/* Title should be above the image */
.title {
  color: white;
  font-weight: 300;
  position: absolute;
  left: 20px;
  top: 15px;
  z-index: 10; /* Ensures title is above the image */
  background-color: rgba(0, 0, 0, 0.5); /* Optional: adds a semi-transparent background to improve readability */
  padding: 5px 10px;
  border-radius: 5px;
}

/* Style for the button */
.btn {
  position: absolute; /* Positioning the button inside the card */
  bottom: 20px; /* Give it some space from the bottom */
  left: 50%; /* Center it horizontally */
  transform: translateX(-50%); /* Perfect centering */
  background-color: rgba(102, 91, 239, 0.7); /* Transparent button color */
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 14px;
  border-radius: 25px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-weight: 500;
  z-index: 10; /* Ensure button is above the image */
}

.btn:hover {
  background-color: #EF665B; /* Solid color on hover */
}

a {
    text-decoration: none; /* Removes underline */
}


/* GG */
body {
  background-color: #e0ecfb;
  font-family: 'Poppins', sans-serif;
}

/* Floating Message Styling */
.floating-message {
  position: fixed;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #4070F4;
  color: white;
  padding: 15px 30px;
  font-size: 20px;
  font-weight: 500;
  border-radius: 25px;
  text-align: center;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  opacity: 0.9;
  transition: opacity 0.5s;
  font-family: 'Poppins', sans-serif; /* Apply the stylish font */
  text-transform: uppercase;
  letter-spacing: 1px;
  animation: slideUp 1s ease-out, glow 1.5s infinite alternate;
}

/* Text Glowing Effect */
@keyframes glow {
  0% {
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5), 0 0 20px rgba(255, 255, 255, 0.7);
  }
  100% {
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.8), 0 0 40px rgba(255, 255, 255, 1);
  }
}

/* Sliding Up Animation */
@keyframes slideUp {
  0% {
    bottom: -80px;
    opacity: 0;
  }
  100% {
    bottom: 0;
    opacity: 1;
  }
}

/* Styling the Span Text */
.floating-message span {
  font-size: 34px;
  font-weight: 500;}
  /* color: #ffffff;
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.floating-message:hover {
  background-color: #d85c4c;
  transition: background-color 0.3s ease;
}

.floating-message:hover span {
  color: #fff;
  font-weight: 600;
  text-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
} */




</style>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">
    </head>
    <body>
        <nav class="nav">
            <ul class="nav-content">
                <li class="nav-list">
                    <a href="dashboard.php" class="link-item active">
                        <i class='bx bxs-home link-icon'></i>
                        <span class="link-text">Home</span>
                    </a>
                </li>
                <li class="nav-list">
                    <a href="resumes.php" class="link-item">
                        <i class='bx bxs-graduation link-icon'></i>
                        <span class="link-text">Resumes</span>
                    </a>
                </li>
                <li class="nav-list">
                    <a href="portfolios.php" class="link-item">
                        <i class='bx bxs-bar-chart-square link-icon'></i>
                        <span class="link-text">Portfolios</span>
                    </a>
                </li>
                <li class="nav-list">
                    <a href="profile.php" class="link-item">
                        <i class='bx bxs-user link-icon'></i>
                        <span class="link-text">Profile</span>
                    </a>
                </li>
                <li class="nav-list">
                    <a href="logout.php" class="link-item">
                        <i class='bx bxs-exit link-icon'></i>
                        <span class="link-text">Logout</span>
                    </a>
                </li>

                
            </ul>
        </nav>
        


<div class="container">
  <div class="card">
    <img src="https://cdn.create.microsoft.com/catalog-assets/en-us/ce343500-4aff-4dfa-b337-57c78459c6ee/thumbnails/616/modern-nursing-resume-orange-modern-geometric-1-1-dbc3e775c6f4.webp" alt="Resume 1" class="card-img">
    <h3 class="title">Resume 1</h3>
    <a href="resumes.php" class="btn">Try Now!</a><!-- Added button -->
  </div>
  <div class="card">
    <img src="https://s3.envato.com/files/367226814/01-preview.__large_preview.jpg" alt="Portfolio 1" class="card-img">
    <h3 class="title">Portfolio 1</h3>
    <a href="portfolios.php" class="btn">Try Now!</a>
 <!-- Added button -->
  </div>
  <div class="card">
    <img src="https://d25zcttzf44i59.cloudfront.net/official-resume-template.png" alt="Resume 2" class="card-img">
    <h3 class="title">Resume 2</h3>
    <a href="resumes.php" class="btn">Try Now!</a> <!-- Added button -->
  </div>
  <div class="card">
    <img src="https://colorlib.com/wp/wp-content/uploads/sites/2/personalportfolio-free-template-353x278.jpeg" alt="Portfolio 2" class="card-img">
    <h3 class="title">Portfolio 2</h3>
    <a href="portfolios.php" class="btn">Try Now!</a> <!-- Added button -->
  </div>
</div>

<!-- Floating footer message -->
<div class="floating-message">
    <span id="message"></span>
  </div>
  <script>
    const messages = [
  "WELCOME! MAKE A RESUME THAT LANDS YOU A JOB!",
  "Create an impressive portfolio that gets noticed!",
  "Craft a resume that stands out from the crowd!",
  "Your dream job is just a resume away. Start now!",
  "Build a portfolio that speaks for itself!",
];

let index = 0;

function changeMessage() {
  document.getElementById('message').textContent = messages[index];
  index = (index + 1) % messages.length; // Loop back to the start
}

// Change message every 5 seconds
setInterval(changeMessage, 5000);

// Initialize with the first message
changeMessage();

  </script>


    </body>
</html>
