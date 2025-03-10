<?php
include 'includes/connection.php';
include 'includes/header.php';
?>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>All Job Types</h2>
                <div class="row">
                    <?php
                    $fetch_type = $conn->prepare("SELECT emp_type, COUNT(*) as job_count 
                                                FROM post 
                                                WHERE emp_type<>'' 
                                                GROUP BY emp_type 
                                                ORDER BY emp_type ASC");
                    $fetch_type->execute();
                    foreach ($fetch_type->fetchAll(PDO::FETCH_ASSOC) as $type) {
                        ?>
                        <div class="col-lg-4 mb-3">
                            <a href="./?filter_by_type?type=<?=$type['emp_type']?>" class="btn btn-light btn-block text-left">
                                <?=$type['emp_type']?>
                                <span class="badge badge-primary float-right"><?=$type['job_count']?></span>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?> 