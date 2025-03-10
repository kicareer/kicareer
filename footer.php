<!-- Footer -->
<footer id="footer" class="inverted" >
    <div class="footer-content">
        <div class="container">
            <div class="row " style="margin-top: -40px">
                <div class="col-md-12" >
                    <div style="padding-bottom: 10px;">
                        <h3>Signup for our newsletter</h3>
                    </div>
                    
                    <div class="row" style="background: white;">
                        <div class="col-md-6">
                            <div class="hrn">
                               <div class="input-group" style="margin-top: 25px">
                                    <input type="email" required name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                                    <span class="input-group-btn">
                                        <button type="submit" id="widget-subscribe-submit-button" class="btn" style="background: #2b88c4;border:1px solid #2b88c4">Subscribe</button>
                                    </span> </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <center>
                                <img src="images/2.png" width="100px">
                            </center>
                        </div>
                        <div class="col-md-2">
                            <center>
                                <img src="images/3.png" width="100px" >
                            </center>
                        </div>
                        <div class="col-md-2 ">
                            <center>
                                <img src="images/4.png" width="100px">
                            </center>
                        </div>
                    </div>
                 
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-2 p-b-0 p-t-0">
                    <div>
                        <img src="../images/logo(white)-01(1).png" width="80px;" >
                    </div>
                </div>
                <div class="col-md-2 col-3  p-b-0 p-t-20">
                    <p><a href="kenz-group.php?g=<?=$country?>  " class="text-light"> Jobs </a></p>
                </div>
                <div class="col-md-2 col-3  p-b-0 p-t-20">
                    <p><a href="our-plans.php" class="text-light">Our Plans</a></p>
                </div>
                <div class="col-md-2 col-3  p-b-0 p-t-20">
                    <p><a href="login.php?g=<?=$country?>" class="text-light">Login </a></p>
                </div>

                <div class="col-md-2 col-3  p-b-0 p-t-20">
                     <p><a href="registration.php?g=<?=$country?>" class="text-light"> Register </a></p>
                </div>
                <div class="col-md-2  col-3 p-b-0 p-t-15" style="list-style-type: none;" >
                     
                        <li class="dropdown mega-menu-item" ><a href="#" class="text-light">Employer</a></li>
                            <ul class="dropdown-menu">
                                <li class="mega-menu-content">
                                    <div class="row">
                                        <div class="col-lg-2-5">
                                            <ul>
                                                <li><a href="employee-login.php">Login</a></li>
                                                <li><a href="employee-registration.php">Registration</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                </div>


                <div class="col-md-2 col-12 p-b-0 p-t-20">
                    <div class="mb-4 social-icons social-icons-border social-icons-rounded social-icons-colored-hover">
                        <ul>
                            <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li class="social-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 m-t-10">
                    <hr class="no-margin line">
                </div>
                <div class="col-md-12 m-t-10 ">
                    <ul class="listhorizontal" style="display: flex;list-style-type: none;">
                         <li><a href="privacy-statement.php" class="text-light" style="padding-left:20px">Privacy Statement</a></li>
                         <li><a href="terms-conditions.php" class="text-light" style="padding-left:20px">Terms & Conditions</a></li>
                         <li><a href="#" class="text-light" style="padding-left:20px">Cookie Policy </a></li>
                         <li><a href="#" class="text-light" style="padding-left:20px">Accessibility statement</a></li>
                         <li><a href="#" class="text-light" style="padding-left:20px">Sitemap</a></li>
                    </ul>

                
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-content p-t-20 p-b-10">
        <div class="container">
            <div class="copyright-text text-center text-grey"> <span class="azonixfont text-light">Kenz</span> Innovation. All Rights Reserved | Designed & Developed by <a href="https://intencode.com" target="_blank" class="text-light">Intencode</a> </div>
        </div>
    </div>
</footer>
<!-- end: Footer -->


<!-- <script> -->
    <script type="text/javascript">
    (function () {
    let host = window.location.hostname; // Get current host (e.g., sub.kenzwheels.com)
    console.log(host);
    let parts = host.split('.');
	console.log(parts);
    // Define main domain and allowed subdomains (you can load these dynamically from an API)
    let mainDomain = "ki-careers.com";

	
    if (parts.length > 2 && parts[0] !='www') {
        let subdomain = parts[0];

        fetch('check_subdomain.php?subdomain=' + subdomain)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                if (data.available) {
                    // Redirect to main domain if subdomain is invalid
                    alert("Invalid Subdomain, redirecting to main domain!!!")
                    window.location.href = "https://" + mainDomain;
                }
            })
            .catch(error => console.error("Error checking subdomain:", error));
    }
})();
</script>
