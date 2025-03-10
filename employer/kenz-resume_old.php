<?php
session_start();
include('../classes/posts.php');
include 'shadow.php';
// var_dump($_SESSION);
// exit;
$base_url = "../";
$postid = $_GET['postid'];

// Fetch data based on applicant's id
$id = $postid; // Replace with dynamic value
$sql = "SELECT * FROM job_applications WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$applicant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$applicant) {
    echo "No data found for the given ID.";
    exit;
}

// Decode JSON fields for structured data
$certifications = json_decode($applicant['certifications'], true);
$skills = json_decode($applicant['skills'], true);
$projects = json_decode($applicant['projects'], true);
$previous_experience = json_decode($applicant['previous_experience'], true);
$education = json_decode($applicant['education'], true);
// var_dump($applicant);
// exit;

// Company logo for watermark
$imagePath = $base_url . $_SESSION['company_logo'];
// Convert image to base64
$imageData = base64_encode(file_get_contents($imagePath));
$imageType = mime_content_type($imagePath);
$imageBase64 = "data:$imageType;base64,$imageData";

// Profile image for applicant
$imagePath1 = $base_url . htmlspecialchars($applicant['profile_image'] ?? 'default.png');
// Convert image to base64
$imageData1 = base64_encode(file_get_contents($imagePath1));
$imageType1 = mime_content_type($imagePath1);
$imageBase641 = "data:$imageType1;base64,$imageData1";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>kenz Resume</title>
   
</head>

<body>
<div style="width: 1200px; margin: 0 auto;">
    <div id="amirDiv" style="float: left; background-color: #abc; width: 100%; border: 2px solid black; padding: 10px 5px; background-image: url('<?= $imagePath ?>'); 
    height: 90vh; background-size: contain; background-repeat: no-repeat; 
    background-position: center;">
        <div style="background: #0089BA;padding:10px 0;color:white;font-size:18px;text-align: center; width: 100%;">
            <b><?= $applicant['name'] ?></b> - <span style="font-size:16px"><?= $applicant['apply_position'] ?></span>
        </div>
       
    </div>
</div>
</body>

    <div style="text-align: center; margin-top: 20px; wich: 100%; float: left">
        <button type="button" onclick="printDiv('amirDiv')" style="padding: 10px; background: #1296cf; color: white; border: none; box-shadow: 0 0 5px 0 rgba(154, 161, 191, 0.45);">Download PDF</button>
    </div>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            // Send data using fetch API (or use XMLHttpRequest if needed)
            //    console.log(printContents);
            //     return false;
            fetch('generate_pdf1.php?postid=1', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'printContents=' + encodeURIComponent(printContents)
                })
                .then(response => response.blob())
                .then(blob => {
                    // Create a link to download the PDF
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = '<?= $applicant['name'] ?>_resume.pdf'; // Default name for the downloaded file
                    link.click();
                })
                .catch(error => console.error('Error generating PDF:', error));
        }
    </script>


</html>