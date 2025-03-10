 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="./" class="app-brand-link">
              <span class="app-brand-logo demo">
               
                  <img src="./assets/img/logo/logo-01.png" style="max-height: 60px;" alt="Brand Logo" class="img-fluid">
              </span>
              <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Kenz</span> -->
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') ? 'active' : ''; ?>">
              <a href="./" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

          
            <!-- Tables -->
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage-jobs.php') ? 'active' : ''; ?>">
              <a href="manage-jobs.php" class="menu-link">
                <i class="menu@-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Tables">Manage Jobs</div>
              </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage-job-application.php') ? 'active' : ''; ?>">
              <a href="manage-job-application.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Tables">Manage Applications</div>
              </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage-employers.php') ? 'active' : ''; ?>">
                <a href="manage-employers.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Tables">Manage Employers</div>
              </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage-candidates.php') ? 'active' : ''; ?>">
              <a href="manage-candidates.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Tables">Manage Candidates</div>
              </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage-plans.php') ? 'active' : ''; ?>">
              <a href="manage-plans.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Tables">Manage Plans</div>
              </a>
            </li>
           
          </ul>
        </aside>
        <!-- / Menu -->