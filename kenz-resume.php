<?php
// First, add this to fetch employer details after the existing database queries
$stmt = $conn->prepare("SELECT company_name, email, phone, website FROM employer_tbl WHERE id = :employer_id");
$stmt->bindValue(':employer_id', $employer_id, PDO::PARAM_INT);
$stmt->execute();
$employer_details = $stmt->fetch(PDO::FETCH_ASSOC);

// Then modify the left section HTML in the template
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Resume Template</title>
</head>
<body style="background-color: #f5f5f5; padding: 10px;">
    <div id="container" style="width: 90%; max-width: 1200px; margin: 0 auto;">
        <style>
            /* Add responsive styles */
            @media screen and (max-width: 768px) {
                .resume {
                    min-width: unset;
                    width: 100%;
                    display: block;
                }
                
                .left-section, .right-section {
                    display: block;
                    width: 100%;
                    padding: 15px;
                }
                
                .left-section {
                    padding-bottom: 80px; /* Space for company details */
                }
                
                .profile-picture img {
                    width: 100px;
                    height: 100px;
                }
                
                .skills-list li {
                    width: calc(50% - 10px);
                    margin: 5px;
                    box-sizing: border-box;
                }
                
                .company-details {
                    padding: 10px;
                    position: relative;
                    margin-top: 20px;
                }
                
                p, h3, h4 {
                    padding-left: 0;
                    padding-right: 0;
                }
                
                footer p {
                    position: relative;
                    margin-top: 20px;
                    padding: 10px;
                }
            }

            /* Additional styles for very small screens */
            @media screen and (max-width: 480px) {
                .skills-list li {
                    width: 100%;
                    margin: 5px 0;
                }
                
                #container {
                    width: 100% !important;
                    padding: 10px;
                }
            }

            /* Print styles to ensure PDF generation works correctly */
            @media print {
                .resume {
                    min-width: 800px;
                    display: table;
                }
                
                .left-section, .right-section {
                    display: table-cell;
                }
                
                .left-section {
                    width: 30%;
                }
                
                .right-section {
                    width: 70%;
                }
            }
        </style>
        <div class="resume">
            <!-- Left Section -->
            <aside class="left-section">
              <div class="profile-picture">
                <img src="' . $imageBase64 . '" alt="Profile Picture">
              </div>
              <h1 class="name">' . $applicant['name'] . '</h1>
              
              <!-- Add Employer Details Section -->
              <section class="employer-details" style="margin: 20px 0; text-align: left; padding: 0 20px;">
                <h3 style="color: #fff; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 5px;">Company Details</h3>
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.7);">Company Name</p>
                    <p style="margin: 0; font-size: 14px; color: #fff;">' . htmlspecialchars($employer_details['company_name']) . '</p>
                </div>
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.7);">Phone</p>
                    <p style="margin: 0; font-size: 14px; color: #fff;">' . htmlspecialchars($employer_details['phone']) . '</p>
                </div>
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.7);">Email</p>
                    <p style="margin: 0; font-size: 14px; color: #fff;">' . htmlspecialchars($employer_details['email']) . '</p>
                </div>
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.7);">Website</p>
                    <p style="margin: 0; font-size: 14px; color: #fff;">' . htmlspecialchars($employer_details['website']) . '</p>
                </div>
              </section>

              <section class="skills">
                <h3>Skills</h3>
                <ul class="skills-list">
// ... rest of the existing code ...

$html .= '</ul>
              </section>

              <!-- Add Company Details Section -->
              <section style="margin-top: 30px; text-align: left; padding: 15px;">
                <h3 style="border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 8px; margin-bottom: 15px;">Company Details</h3>
                
                <div style="margin-bottom: 12px;">
                    <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin: 0;">Company Name</p>
                    <p style="color: #fff; font-size: 14px; margin: 3px 0 0 0;">' . htmlspecialchars($company_name) . '</p>
                </div>

                <div style="margin-bottom: 12px;">
                    <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin: 0;">Contact Number</p>
                    <p style="color: #fff; font-size: 14px; margin: 3px 0 0 0;">' . htmlspecialchars($country_code) . ' ' . htmlspecialchars($contact_number) . '</p>
                </div>

                <div style="margin-bottom: 12px;">
                    <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin: 0;">Email</p>
                    <p style="color: #fff; font-size: 14px; margin: 3px 0 0 0;">' . htmlspecialchars($company_email) . '</p>
                </div>
              </section>
            </aside>

            <!-- Right Section -->
            <main class="right-section">
            // ... rest of the existing code ...
            </main>
        </div>
        <form method="post" action="" style="text-align: center;">
            <button type="submit" name="download_resume" class="btn btn-primary" style="background-color: #2b88c4; padding: 10px 20px; margin-top: 20px; border-radius: 5px; font-size: 16px; border: none; color: #fff;">Download Resume</button>
        </form>
    </div>
</body>
</html>';

// Also modify the container div in the HTML output section
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Resume Template</title>
</head>
<body style="background-color: #f5f5f5; padding: 10px;">
    <div id="container" style="width: 90%; max-width: 1200px; margin: 0 auto;">
        <?php echo $html; ?>
        <form method="post" action="" style="text-align: center;">
            <button type="submit" name="download_resume" class="btn btn-primary" style="background-color: #2b88c4; padding: 10px 20px; margin-top: 20px; border-radius: 5px; font-size: 16px; border: none; color: #fff;">Download Resume</button>
        </form>
    </div>
</body>
</html> 