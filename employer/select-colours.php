<?php 
include '../config.php';

// Check if form is submitted
if (isset($_POST['update_colors'])) {
    $primary_color = htmlspecialchars(trim($_POST['primary_color']));
    $secondary_color = htmlspecialchars(trim($_POST['secondary_color']));
    $accent_color = htmlspecialchars(trim($_POST['accent_color']));
    $employer_id = $_SESSION['employer_id'];

    try {
        $update = $conn->prepare("UPDATE employer_tbl SET 
            primary_color = :primary_color,
            secondary_color = :secondary_color,
            accent_color = :accent_color
            WHERE id = :employer_id");

        $update->bindParam(':primary_color', $primary_color, PDO::PARAM_STR);
        $update->bindParam(':secondary_color', $secondary_color, PDO::PARAM_STR);
        $update->bindParam(':accent_color', $accent_color, PDO::PARAM_STR);
        $update->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);

        if ($update->execute()) {
            $_SESSION['success_message'] = "Colors updated successfully!";
            $_SESSION['primary_color'] = $primary_color;
            $_SESSION['secondary_color'] = $secondary_color;
            $_SESSION['accent_color'] = $accent_color;
        } else {
            $_SESSION['error_message'] = "Error updating colors.";
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Database error: " . $e->getMessage();
    }
}

// Fetch current colors and logo
$employer_data = $_SESSION;

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Select Colors</title>
     <!-- Favicon -->
     <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.png" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="./assets/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="./assets/vendor/js/helpers.js"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="./assets/js/config.js"></script>
    
    <style>
        .color-preview {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            margin-left: 10px;
            border: 1px solid #ddd;
        }
        .color-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .palette-color {
            width: 50px;
            height: 50px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            border: 1px solid #ddd;
        }
        .logo-preview {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .palette-container {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include 'includes/sidebar.php'; ?>

            <div class="layout-page">
                <?php include 'includes/top-bar.php'; ?>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Select Colors</h4>

                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Customize Portal Colors</h5>
                            </div>
                            
                            <div class="card-body">
                                <?php if (!empty($employer_data['company_logo'])): ?>
                                    <div>
                                        <h6>Colors from Your Logo</h6>
                                        <img src="../<?php echo htmlspecialchars($employer_data['company_logo']); ?>" 
                                             id="logoImage" 
                                             class="logo-preview" 
                                             crossorigin="anonymous"
                                             alt="Company Logo">
                                        
                                        <div class="palette-container">
                                            <h6>Suggested Color Palette</h6>
                                            <div id="colorPalette"></div>
                                            <button type="button" class="btn btn-sm btn-secondary mt-2" id="extractColors">
                                                Extract Colors from Logo
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <div class="color-group">
                                        <div class="mb-3 flex-grow-1">
                                            <label for="primary_color" class="form-label">Primary Color</label>
                                            <input type="color" 
                                                class="form-control form-control-color" 
                                                id="primary_color" 
                                                name="primary_color" 
                                                value="<?php echo $employer_data['primary_color'] ?? '#696cff'; ?>"
                                                title="Choose primary color">
                                        </div>
                                        <div id="primary_color_preview" class="color-preview"></div>
                                    </div>

                                    <div class="color-group">
                                        <div class="mb-3 flex-grow-1">
                                            <label for="secondary_color" class="form-label">Secondary Color</label>
                                            <input type="color" 
                                                class="form-control form-control-color" 
                                                id="secondary_color" 
                                                name="secondary_color" 
                                                value="<?php echo $employer_data['secondary_color'] ?? '#8592a3'; ?>"
                                                title="Choose secondary color">
                                        </div>
                                        <div id="secondary_color_preview" class="color-preview"></div>
                                    </div>

                                    <div class="color-group">
                                        <div class="mb-3 flex-grow-1">
                                            <label for="accent_color" class="form-label">Accent Color</label>
                                            <input type="color" 
                                                class="form-control form-control-color" 
                                                id="accent_color" 
                                                name="accent_color" 
                                                value="<?php echo $employer_data['accent_color'] ?? '#71dd37'; ?>"
                                                title="Choose accent color">
                                        </div>
                                        <div id="accent_color_preview" class="color-preview"></div>
                                    </div>

                                    <button type="submit" name="update_colors" class="btn btn-primary">Save Colors</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php include 'includes/footer.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your existing script imports here -->
    <?php include 'includes/scripts.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>

    <script>
        const colorThief = new ColorThief();
        
        // Update color previews in real-time
        function updatePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(`${inputId}_preview`);
            if (input && preview) {
                preview.style.backgroundColor = input.value;
            }
        }

        // Convert RGB to Hex
        function rgbToHex(r, g, b) {
            return '#' + [r, g, b].map(x => {
                const hex = x.toString(16);
                return hex.length === 1 ? '0' + hex : hex;
            }).join('');
        }

        // Extract colors from logo
        function extractColors() {
            const img = new Image();
            img.src = '../<?php echo $_SESSION['company_logo']; ?>';
            
            try {
                // Get the dominant color and palette
                const dominantColor = colorThief.getColor(img);
                const palette = colorThief.getPalette(img, 5);

                // Clear existing palette
                const paletteContainer = document.getElementById('colorPalette');
                paletteContainer.innerHTML = '';

                // Add dominant color and palette colors
                palette.forEach(color => {
                    const hexColor = rgbToHex(...color);
                    const colorDiv = document.createElement('div');
                    colorDiv.className = 'palette-color';
                    colorDiv.style.backgroundColor = hexColor;
                    colorDiv.setAttribute('data-color', hexColor);
                    colorDiv.title = hexColor;
                    colorDiv.draggable = true;

                    // Add drag event listeners
                    colorDiv.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', hexColor);
                    });
                    
                    paletteContainer.appendChild(colorDiv);
                });
            } catch (error) {
                console.error('Error extracting colors:', error);
            }
        }

        // Initialize color pickers and previews
        document.addEventListener('DOMContentLoaded', function() {
            const colorInputs = ['primary_color', 'secondary_color', 'accent_color'];
            
            colorInputs.forEach(inputId => {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(`${inputId}_preview`);
                if (!input || !preview) return;

                // Make preview droppable
                preview.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.border = '2px dashed #000';
                });

                preview.addEventListener('dragleave', function(e) {
                    this.style.border = '1px solid #ddd';
                });

                preview.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.style.border = '1px solid #ddd';
                    const color = e.dataTransfer.getData('text/plain');
                    input.value = color;
                    updatePreview(inputId, `${inputId}_preview`);
                });

                input.addEventListener('input', () => {
                    updatePreview(inputId, `${inputId}_preview`);
                });

                // Initial preview
                updatePreview(inputId, `${inputId}_preview`);
            });

            // Extract colors button handler
            document.getElementById('extractColors').addEventListener('click', extractColors);

            // If logo exists, extract colors on page load
            const logoImage = document.getElementById('logoImage');
            if (logoImage) {
                logoImage.addEventListener('load', extractColors);
                if (logoImage.complete) {
                    extractColors();
                }
            }
        });
    </script>
</body>
</html> 