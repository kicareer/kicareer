<?php 
include('classes/posts.php');
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
    <title>Our Plans - KI Careers</title>
    
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
    
    <style>
        .pricing-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .plan-card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .plan-header {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            text-align: center;
        }
        
        .plan-price {
            padding: 30px 0;
            margin: 0 -24px 24px -24px;
            background: #eef2ff;
            text-align: center;
        }
        
        .plan-price h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .feature-list li {
            padding: 12px 15px;
            background: #f8f9fa;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .feature-list li:hover {
            background: #eef2ff;
        }
        
        .feature-list i {
            color: #457eff;
            margin-right: 10px;
        }
        
        .plan-footer {
            text-align: center;
            padding: 30px;
            background: transparent;
            border-top: none;
        }
        
        .select-plan-btn {
            background: #457eff;
            border: none;
            padding: 12px 35px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .select-plan-btn:hover {
            background: #3461cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(69, 126, 255, 0.4);
        }
        
        .section-heading {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-heading h2 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .section-heading p {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .plans-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .plan-column {
            display: flex;
            justify-content: center;
        }
        
        .plan-card {
            width: 100%;
            max-width: 400px;
        }
        
        .accordion .card-header button:hover {
            color: #457eff !important;
        }
        
        .accordion .card-header button.collapsed i {
            transform: rotate(0deg);
            transition: transform 0.3s ease;
        }
        
        .accordion .card-header button i {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
        
        .accordion .card:hover {
            box-shadow: 0 0 20px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
        <?php include 'header.php'; ?>
        <!-- end: Header -->

        <!-- Main Content -->
        <section class="pricing-section">
            <div class="container">
                <div class="section-heading">
                    <h2>Choose the Right Plan for Your Business</h2>
                    <p>Select from our competitive plans designed to meet your recruitment needs</p>
                </div>
                
                <div class="row plans-row">
                    <?php
                    // Fetch plans from database
                    $stmt = $conn->prepare("SELECT * FROM plans ORDER BY price ASC");
                    $stmt->execute();
                    $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($plans as $plan) {
                    ?>
                    <div class="col-lg-4 col-md-6 plan-column">
                        <div class="card plan-card">
                            <div class="plan-header">
                                <h3 class="mb-0" style="color:rgb(114, 132, 155); font-weight: 600;">
                                    <?php echo htmlspecialchars($plan['plan_name']); ?>
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="plan-price">
                                    <h2>$<?php echo number_format($plan['price'], 2); ?></h2>
                                    <span class="text-muted">for <?php echo htmlspecialchars($plan['duration']); ?> days</span>
                                </div>
                                <div class="px-4">
                                    <ul class="list-unstyled feature-list">
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle mt-1"></i>
                                            <div>
                                                <strong><?php echo htmlspecialchars($plan['num_recruiter']); ?></strong> Recruiters Included
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle mt-1"></i>
                                            <div>
                                                Additional recruiters at <strong>$<?php echo number_format($plan['charge_per_recruiter'], 2); ?></strong> each
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="fas fa-check-circle mt-1"></i>
                                            <div>
                                                <strong><?php echo htmlspecialchars($plan['duration']); ?> days</strong> plan validity
                                            </div>
                                        </li>
                                        <!-- Add more features as needed -->
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle mt-1"></i>
                                            <div>24/7 Customer Support</div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle mt-1"></i>
                                            <div>Advanced Analytics</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="plan-footer">
                                <a href="employer-registration.php" class="btn select-plan-btn">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                
                <!-- FAQ Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2>Frequently Asked Questions</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="accordion" id="faqAccordion">
                            <!-- FAQ Item 1 -->
                            <div class="card mb-3" style="border-radius: 15px; border: none; box-shadow: 0 0 15px rgb(255, 255, 255);">
                                <div class="card-header" style="background: white; border: none; border-radius: 15px;">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link w-100 text-left px-2 d-flex justify-content-between align-items-center" 
                                                type="button" 
                                                data-toggle="collapse" 
                                                data-target="#faq1"
                                                style="text-decoration: none; color:rgb(255, 255, 255); font-weight: 600; padding: 15px 0;">
                                            How do I choose the right plan?
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </h4>
                                </div>
                                <div id="faq1" class="collapse show" data-parent="#faqAccordion">
                                    <div class="card-body" style="padding: 20px 30px;">
                                        Consider your recruitment needs, team size, and budget. Each plan is designed to cater to different business scales, from startups to large enterprises.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="card mb-3" style="border-radius: 15px; border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05);">
                                <div class="card-header" style="background: white; border: none; border-radius: 15px;">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link w-100 text-left px-2 d-flex justify-content-between align-items-center collapsed" 
                                                type="button" 
                                                data-toggle="collapse" 
                                                data-target="#faq2"
                                                style="text-decoration: none; color:rgb(255, 255, 255); font-weight: 600; padding: 15px 0;">
                                            Can I upgrade my plan later?
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </h4>
                                </div>
                                <div id="faq2" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body" style="padding: 20px 30px;">
                                        Yes, you can upgrade your plan at any time. The difference in price will be prorated for the remaining duration of your current plan.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="card mb-3" style="border-radius: 15px; px-2 border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05);">
                                <div class="card-header" style="background: white; border: none; border-radius: 15px;">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link w-100 text-left px-2 d-flex justify-content-between align-items-center collapsed" 
                                                type="button" 
                                                data-toggle="collapse" 
                                                data-target="#faq3"
                                                style="text-decoration: none; color:rgb(255, 255, 255); font-weight: 600; padding: 15px 0;">
                                            What payment methods do you accept?
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </h4>
                                </div>
                                <div id="faq3" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body" style="padding: 20px 30px;">
                                        We accept all major credit cards, PayPal, and bank transfers. All payments are processed securely through our payment gateway.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="card mb-3" style="border-radius: 15px; border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05);">
                                <div class="card-header" style="background: white; border: none; border-radius: 15px;">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link w-100 text-left px-2 d-flex justify-content-between align-items-center collapsed" 
                                                type="button" 
                                                data-toggle="collapse" 
                                                data-target="#faq4"
                                                style="text-decoration: none; color:rgb(255, 255, 255); font-weight: 600; padding: 15px 0;">
                                            Is there a refund policy?
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </h4>
                                </div>
                                <div id="faq4" class="collapse" data-parent="#faqAccordion">
                                <div id="faq4" class="collapse" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        Yes, we offer a 30-day money-back guarantee if you're not satisfied with our services. Terms and conditions apply.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- end: Footer -->
    </div>
    <!-- end: Body Inner -->

    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>

    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/functions.js"></script>
</body>
</html> 