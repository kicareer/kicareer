<?php
require_once('config.php');

$job_id = $_GET['id'] ?? null;
if (!$job_id) {
    die('Job ID not provided');
}

// Generate the sharing URL
$poster_url = "https://" . $_SERVER['HTTP_HOST'] . "/create_poster.php?id=" . $job_id;
$download_url = $poster_url . "&download=true";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Job Poster</title>
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Share Job Poster</h4>
                        
                        <div class="preview-image text-center my-4">
                            <img src="<?php echo $poster_url; ?>" alt="Job Poster" style="max-width: 100%; height: auto;">
                        </div>

                        <div class="sharing-options">
                            <div class="mb-3">
                                <label>Direct Link:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?php echo $poster_url; ?>" readonly>
                                    <button class="btn btn-primary copy-btn" data-clipboard-text="<?php echo $poster_url; ?>">
                                        Copy Link
                                    </button>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="<?php echo $download_url; ?>" class="btn btn-success">
                                    <i class="fa fa-download"></i> Download Poster
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy-btn');
        $('.copy-btn').click(function() {
            $(this).text('Copied!');
            setTimeout(() => {
                $(this).text('Copy Link');
            }, 2000);
        });
    </script>
</body>
</html> 