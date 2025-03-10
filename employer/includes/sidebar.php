<!-- Menu -->
<?php 
if (!isset($_SESSION['kenz_employer']) && !isset($_SESSION['kenz_recruiter'])) {
session_destroy();
 header("Location: ../employer-login.php");
}

?>
 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="./" class="app-brand-link">
              <span class="app-brand-logo demo">
               
                  <img src="../<?= $_SESSION['company_logo'] ?>" style="max-height: 60px; width: 120px;" alt="Brand Logo" class="img-fluid">
              </span>
              <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Kenz</span> -->
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
        <a href="./index.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    
    <!-- Manage Jobs -->
    <li class="menu-item <?php echo $current_page == 'manage-jobs.php' ? 'active' : ''; ?>">
        <a href="manage-jobs.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-detail"></i>
            <div data-i18n="Tables">Manage Jobs</div>
        </a>
    </li>
    
    <!-- Manage Applications -->
    <li class="menu-item <?php echo $current_page == 'manage-job-application.php' ? 'active' : ''; ?>">
        <a href="manage-job-application.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-crown"></i>
            <div data-i18n="Tables">Manage Applications</div>
        </a>
    </li>

    <li class="menu-item <?php echo $current_page == 'manage-clients.php' ? 'active' : ''; ?>">
        <a href="manage-clients.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Tables">Manage Clients</div>
        </a>
    </li>
    
    <?php if (!isset($_SESSION['kenz_recruiter'])) { ?>
        <li class="menu-item <?php echo $current_page == 'manage-recruiters.php' ? 'active' : ''; ?>">
            <a href="manage-recruiters.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Tables">Manage Recruiters</div>
            </a>
        </li>
        <li class="menu-item <?php echo $current_page == 'subscription.php' ? 'active' : ''; ?>">
            <a href="subscription.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Tables">Subscription</div>
            </a>
        </li>
        <!-- Settings Dropdown -->
        <li class="menu-item <?php echo in_array($current_page, ['manage-status.php', 'manage-locations.php']) ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $current_page == 'manage-status.php' ? 'active' : ''; ?>">
                    <a href="manage-status.php" class="menu-link">
                        <div data-i18n="Manage Status">Manage Status</div>
                    </a>
                </li>
                <li class="menu-item <?php echo $current_page == 'manage-locations.php' ? 'active' : ''; ?>">
                    <a href="manage-locations.php" class="menu-link">
                        <div data-i18n="Manage Locations">Manage Locations</div>
                    </a>
                </li>
                <li class="menu-item <?php echo $current_page == 'select-colours.php' ? 'active' : ''; ?>">
                    <a href="select-colours.php" class="menu-link">
                        <div data-i18n="Select Colours">Select Colours</div>
                    </a>
                </li>
            </ul>
        </li>

      

       
    <?php } ?>

    
</ul>

        </aside>
        <!-- / Menu -->