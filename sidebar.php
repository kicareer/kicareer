<!-- Sidebar -->
<div class="sidebar">
    <ul class="sidebar-menu">
        
        <li><a href="manage-employee-experience.php">Manage Experience</a></li>
        <li><a href="manage-employee-education.php">Manage Education</a></li>
        <li><a href="manage-employee-skills.php">Manage Skills</a></li>
        <li><a href="manage-employee-certificates.php">Manage Certificates</a></li>
        <li><a href="manage-employee-projects.php">Manage Projects</a></li>
        <li><a href="manage-resume.php">Manage Resume</a></li>
       
    </ul>
</div>
<!-- end: Sidebar -->

<style>
    /* Sidebar Styling */
.sidebar {
    width: 100%;
    left: 0;
    top: 0;
    bottom: 0;
    background-color: #2b88c4;
    padding-top: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
    height: 75vh;
}

.sidebar-menu {
    list-style: none;
    padding-left: 0;
}

.sidebar-menu li {
    margin: 10px 0;
}

.sidebar-menu li a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.sidebar-menu li a:hover {
    opacity: 0.8    ;
}

/* Page Content Styling */
.page-content {
    margin-left: 250px; /* Adjusting content to the right to avoid overlap */
    padding: 20px;
}

/* Responsive Sidebar for smaller screens */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 200px;
    }

    .page-content {
        margin-left: 0;
    }
}

</style>