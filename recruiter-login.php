<?php
// include('classes/posts.php');
include('config.php');

// Check if this is a subdomain
$host = $_SERVER['HTTP_HOST'];
$is_subdomain = false;
$employer_id = null;
$custom_logo = 'images/kenz-logo1.png'; // Default logo
$primary_color = null;
$secondary_color = null;

if (count(explode('.', $host)) > 2) {
    $subdomain = explode('.', $host)[0];
    
    // Query to fetch employer details based on subdomain
    $stmt = $conn->prepare("SELECT id, company_logo, primary_color, secondary_color FROM employer_tbl WHERE subdomain = ?");
    $stmt->execute([$subdomain]);
    $employer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($employer) {
        $is_subdomain = true;
        $employer_id = $employer['id'];
        $custom_logo = $employer['company_logo'];
        $primary_color = $employer['primary_color'];
        $secondary_color = $employer['secondary_color'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />  
    <meta name="author" content="INSPIRO" />
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="images/favicon.png">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Recruiter Login</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            background: radial-gradient(circle at 50% 50%, #00537B, #0C2947);
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            opacity: 0.4;
        }

        .page-content {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1;
        }

        .left-content {
            flex: 1;
            padding-left: 10%;
            color: white;
        }

        .right-content {
            width: 600px;
            min-height: 100vh;
            background: linear-gradient(to right, rgb(8, 52, 73), #004481);
            padding: 40px !important;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
        }

        .card-my {
            height: 100%;
            width: 90%;
            /* background: conic-gradient(from 45deg, rgb(255, 255, 255), rgb(175, 201, 81), rgb(255, 255, 255), rgb(175, 201, 81), rgb(255, 255, 255)) !important; */
            background: conic-gradient(from 45deg, rgb(255, 255, 255), rgb(250, 250, 250), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255)) !important;
            
            border-radius: 15px !important;
            border: none !important;
            box-shadow: none !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .card-my::before {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            background: linear-gradient(45deg, #274fbd, rgb(32, 88, 134), rgb(44, 129, 145));
            border-radius: 15px;
            z-index: -1;
        }

        .card-my form {
            width: 100%;
            padding: 40px;
        }

        .title__heading1 {
            margin: 0;
            font-weight: 900;
            font-size: 70px !important;
            font-family: "Azonix", sans-serif;
            line-height: 1;
            text-align: left;
            text-transform: uppercase;
            background: linear-gradient(45deg, #274fbd, #f9ac07, #e34a0e, #01d8fd, #14dfea, #5406d9, #e912a3, #7a3bca, #f9ac07, #7a3bca);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-overflow 20s linear infinite;
            user-select: none;
        }

        @keyframes gradient-overflow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .logo-container {
            width: 150px;
            height: 150px;
            margin: 0 auto 60px;
            background: <?php echo $is_subdomain ? $primary_color : 'linear-gradient(135deg, #014260, #002552)'; ?>;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
            transition: all 0.3s ease;
        }

        .logo-container:after {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border-radius: 50%;
            background: <?php echo $is_subdomain ? 
                "linear-gradient(45deg, $primary_color, $secondary_color, $primary_color)" : 
                'linear-gradient(45deg, #274fbd, rgb(30, 152, 209), #01d8fd)'; ?>;
            z-index: -1;
            opacity: 0.7;
        }

        .logo-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(150, 39, 39, 0.4);
        }

        .logo-container img {
            width: 100px;
            transition: all 0.3s ease;
        }

        .logo-container:hover img {
            transform: scale(1.1);
        }

        .input-group {
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: 15px !important;
            padding: 5px 15px !important;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-group:hover, .input-group:focus-within {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .input-group-text {
            background: transparent !important;
            border: none !important;
            color: rgba(255, 255, 255, 0.7) !important;
            padding-right: 15px !important;
        }

        .input-group-text i {
            font-size: 20px !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        input {
            background: transparent !important;
            border: none !important;
            height: 50px !important;
            color: white !important;
            font-size: 16px !important;
            padding: 0 10px !important;
            width: 100% !important;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        input:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .forgot-password {
            text-align: right;
            margin-top: 8px;
        }

        .forgot-password a {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: white !important;
            text-decoration: underline;
        }

        button {
            width: 100% !important;
            margin: 30px 0 !important;
            border: none !important;
            background: linear-gradient(45deg, #0099cc, #00b3d6) !important;
            height: 55px !important;
            color: white !important;
            border-radius: 15px !important;
            font-weight: bold;
            font-size: 16px !important;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            background: linear-gradient(45deg, #00b3d6, #0099cc) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 153, 204, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .text-center a:hover {
            color: white !important;
            text-decoration: underline !important;
        }

        @media (max-width: 768px) {
            .page-content {
                flex-direction: column;
            }
            
            .left-content {
                padding: 20px;
                text-align: center;
                height: 40vh;
            }
            
            .right-content {
                width: 100%;
                min-height: 60vh;
                padding: 20px !important;
            }
            
            .title__heading1 {
                font-size: 30px !important;
            }
        }
    </style>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop>
            <source src="bgspark.mp4" type="video/mp4">
        </video>
    </div>

    <div class="page-content">
        <div class="left-content">
            <h1 class="title__heading1">Connect<br><br>with<br><br>great<br><br>companies.</h1>
        </div>

        <div class="right-content">
            <div class="card-my">
                <form method="POST" enctype="multipart/form-data">
                    <div class="logo-container">
                        <a href="index.php">
                            <?php if ($is_subdomain): ?>
                                <img src="<?=$custom_logo?>" alt="Company Logo" style="width: 100px; max-height: 100px;">
                            <?php else: ?>
                                <img src="images/kenz-logo1.png" alt="Kenz Logo" style="width: 100px; max-height: 100px;">
                            <?php endif; ?>
                        </a>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="email" required name="email" class="form-control" placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" required name="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit" name="submit_form">
                        Sign In
                    </button>
                    
                    <!-- <div class="text-center" style="color: rgba(255, 255, 255, 0.7);">
                        Don't have an account? 
                        <a href="recruiter-registration.php" style="color: #01d8fd; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
                            Sign Up
                        </a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/functions.js"></script>
</body>
</html>
<?php
if (isset($_POST['submit_form'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $password = hash('sha256', $password);
    
    // Modify query based on whether we're on a subdomain
    if ($is_subdomain) {
        $check = $conn->prepare("SELECT * FROM recruiter_tbl WHERE email = :email AND employer_id = :employer_id");
        $check->bindParam(':email', $email);
        $check->bindParam(':employer_id', $employer_id);
    } else {
        $check = $conn->prepare("SELECT * FROM recruiter_tbl WHERE email = :email");
        $check->bindParam(':email', $email);
    }
    
    $check->execute();
    
    if ($check->rowCount() == 1) {
        $fetch = $check->fetch(PDO::FETCH_ASSOC);
        if ($fetch['password'] == $password) {
            // If on main domain, redirect to correct subdomain
            if (!$is_subdomain) {
                // Get employer's subdomain
                $stmt = $conn->prepare("SELECT subdomain FROM employer_tbl WHERE id = ?");
                $stmt->execute([$fetch['employer_id']]);
                $employer = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($employer && !empty($employer['subdomain'])) {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $domain = 'ki-careers.com';
                    echo '<script>window.location.href="'.$protocol.$employer['subdomain'].'.'.$domain.'/recruiter-login.php"</script>';
                    exit;
                } else {
                    echo '<script>alert("No subdomain configured for this employer. Please contact support.");</script>';
                    exit;
                }
            }
            
            // Set session variables and redirect
            $_SESSION['kenz_recruiter'] = $fetch['id'];
            $_SESSION['employer_id'] = $fetch['employer_id'];
            
            // Get employer details
            $stmt = $conn->prepare("SELECT * FROM employer_tbl WHERE id = :employer_id");
            $stmt->bindParam(':employer_id', $fetch['employer_id']);
            $stmt->execute();
            $company = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['company_name'] = $company['company_name'];
            $_SESSION['company_description'] = $company['company_description'];
            $_SESSION['company_address'] = $company['company_address'];
            $_SESSION['company_logo'] = $company['company_logo'];
            
            foreach ($fetch as $key => $value) {
                $_SESSION[$key] = $value;
            }
            $_SESSION['logged_in'] = 1;
            
            echo '<script>window.location.href="employer/index.php"</script>';
        } else {
            echo '<script>
                alert("Invalid password. Please try again.");
                window.location.href = "recruiter-login.php";
            </script>';
        }
    } else {
        if ($is_subdomain) {
            echo '<script>
                alert("Invalid email or password. Please check your credentials and try again.");
                window.location.href = "recruiter-login.php";
            </script>';
        } else {
            echo '<script>
                alert("Email not found. Please check your email address and try again.");
                window.location.href = "recruiter-login.php";
            </script>';
        }
    }
}

// Add this at the top of the page to show error messages from URL parameters
if (isset($_GET['invalid-password'])) {
    echo '<script>alert("Invalid password. Please try again.");</script>';
}
if (isset($_GET['invalid-email'])) {
    echo '<script>alert("Email not found. Please check your email address and try again.");</script>';
}
?>
