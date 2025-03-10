<?php
include 'shadow.php';
header('Content-Type: application/force-download');
header('Content-disposition: attachment; filename=export.xls');
header("Pragma: ");
header("Cache-Control: ");
if (isset($_GET['search'])) {
    $field=htmlspecialchars(trim($_GET['field']));
    $table=htmlspecialchars(trim($_GET['table']));
    $term=htmlspecialchars(trim($_GET['term']));
    $percentile=htmlspecialchars(trim($_GET['percentile']));
    if ($percentile=='yes') {
        $term='%'.$term.'%';
    }else{
        $term=$term;
    }

    $getjobs=$esdy_in->prepare("SELECT a.*,p.job_title FROM applicants a LEFT JOIN post p ON p.sno=a.jobid WHERE $table.$field LIKE :term ");
    $getjobs->bindParam(':term',$term);
    $getjobs->execute();
    $tbl='
    <html xmlns:x="urn:schemas-microsoft-com:office:excel">
    	<table border="1">
            <thead>
                <tr>
                    <td>#</td>
                    <td style="padding:4px;">Date</td>
                    <td style="padding:4px;">Applied Job</td>
                    <td style="padding:4px;">Name</td>
                    <td style="padding:4px;">Email</td>
                    <td style="padding:4px;">Phone</td>
                    <td style="padding:4px;">Residence</td>
                    <td style="padding:4px;">Dob</td>
                    <td style="padding:4px;">Experience</td>
                    <td style="padding:4px;">Current Employment</td>
                    <td style="padding:4px;">Salary</td>
                    <td style="padding:4px;">City</td>
                    <td style="padding:4px;">Notice Period</td>
                    <td style="padding:4px;">Profile Image</td>
                    <td style="padding:4px;">Resume</td>
                </tr>
            </thead>
    ';
    $tbl.='<tbody>';
    if ($getjobs->rowCount()>0) {
        $c=1;
        foreach ($getjobs->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $d=explode('/', $value['apply_date']);
            $date=$d[2].'/'.$d[1].'/'.$d[0];
            $tbl.='<tr>
                <td style="padding:4px"><a href="applicant-view.php?postid='.$value['sno'].'">'.$value['sno'].'</a></td>
                <td style="padding:4px">'.$date.'</td>
                <td style="padding:4px">'.$value['job_title'].'</td>
                <td style="padding:4px">'.$value['name'].'</td>
                <td style="padding:4px">'.$value['email'].'</td>
                <td style="padding:4px">'.$value['phone'].'</td>
                <td style="padding:4px">'.$value['residence'].'</td>
                <td style="padding:4px">'.$value['dob'].'</td>
                <td style="padding:4px">'.$value['experience'].'</td>
                <td style="padding:4px">'.$value['current_emp'].'</td>
                <td style="padding:4px">'.$value['current_sal'].'</td>
                <td style="padding:4px">'.$value['job_city'].'</td>
                <td style="padding:4px">'.$value['notice_period'].'</td>
                <td style="padding:4px"><a href="https://kenz-plus.com/changan/uploads/profile/'.$value['profile_image'].'" target="_blank">https://kenz-plus.com/changan/uploads/profile/'.$value['profile_image'].'</a></td>
                <td style="padding:4px"><a href="https://kenz-plus.com/changan/uploads/'.$value['resume'].'" target="_blank">https://kenz-plus.com/changan/uploads/'.$value['resume'].'</a></td>
            </tr>
            ';
        }
    }else{
        echo '<tr>
            <td colspan="16"><center>--No data found--</center></td>
        </tr>';
    }

    $tbl.='<tbody>';
    $tbl.='</table>
    </html>
    ';

	echo $tbl;
}elseif(isset($_GET['sorting'])){
    $table=htmlspecialchars(trim($_GET['table']));
    $field=htmlspecialchars(trim($_GET['field']));
    $sort=htmlspecialchars(trim($_GET['sort']));

    $getjobs=$esdy_in->prepare("SELECT a.*,p.job_title FROM applicants a LEFT JOIN post p ON p.sno=a.jobid ORDER BY $table.$field $sort ");
    $getjobs->execute();
    $tbl='
    <html xmlns:x="urn:schemas-microsoft-com:office:excel">
    	<table border="1">
            <thead>
                <tr>
                    <td>#</td>
                    <td style="padding:4px;">Date</td>
                    <td style="padding:4px;">Applied Job</td>
                    <td style="padding:4px;">Name</td>
                    <td style="padding:4px;">Email</td>
                    <td style="padding:4px;">Phone</td>
                    <td style="padding:4px;">Residence</td>
                    <td style="padding:4px;">Dob</td>
                    <td style="padding:4px;">Experience</td>
                    <td style="padding:4px;">Current Employment</td>
                    <td style="padding:4px;">Salary</td>
                    <td style="padding:4px;">Applying Position</td>
                    <td style="padding:4px;">City</td>
                    <td style="padding:4px;">Notice Period</td>
                    <td style="padding:4px;">Profile Image</td>
                    <td style="padding:4px;">Resume</td>
                </tr>
            </thead>
    ';
    $tbl.='<tbody>';
    if ($getjobs->rowCount()>0) {
        $c=1;
        foreach ($getjobs->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $d=explode('/', $value['apply_date']);
            $date=$d[2].'/'.$d[1].'/'.$d[0];
            $tbl.='<tr>
                <td style="padding:4px"><a href="applicant-view.php?postid='.$value['sno'].'">'.$value['sno'].'</a></td>
                <td style="padding:4px">'.$date.'</td>
                <td style="padding:4px">'.$value['job_title'].'</td>
                <td style="padding:4px">'.$value['name'].'</td>
                <td style="padding:4px">'.$value['email'].'</td>
                <td style="padding:4px">'.$value['phone'].'</td>
                <td style="padding:4px">'.$value['residence'].'</td>
                <td style="padding:4px">'.$value['dob'].'</td>
                <td style="padding:4px">'.$value['experience'].'</td>
                <td style="padding:4px">'.$value['current_emp'].'</td>
                <td style="padding:4px">'.$value['current_sal'].'</td>
                <td style="padding:4px">'.$value['job_city'].'</td>
                <td style="padding:4px">'.$value['notice_period'].'</td>
                <td style="padding:4px"><a href="https://kenz-plus.com/changan/uploads/profile/'.$value['profile_image'].'" target="_blank">https://kenz-plus.com/changan/uploads/profile/'.$value['profile_image'].'</a></td>
                <td style="padding:4px"><a href="https://kenz-plus.com/changan/uploads/'.$value['resume'].'" target="_blank">https://kenz-plus.com/changan/uploads/'.$value['resume'].'</a></td>
            </tr>
            ';
        }
    }else{
        echo '<tr>
            <td colspan="16"><center>--No data found--</center></td>
        </tr>';
    }

    $tbl.='<tbody>';
    $tbl.='</table>
    </html>
    ';

	echo $tbl;
}elseif(isset($_GET['all'])){
    $getjobs=$esdy_in->prepare("SELECT a.*,p.job_title FROM applicants a LEFT JOIN post p ON p.sno=a.jobid ORDER BY a.sno desc");
    $getjobs->execute();
    $tbl='
    <html xmlns:x="urn:schemas-microsoft-com:office:excel">
    	<table border="1">
            <thead>
                <tr>
                    <td>#</td>
                    <td style="padding:4px;">Date</td>
                    <td style="padding:4px;">Applied Job</td>
                    <td style="padding:4px;">Name</td>
                    <td style="padding:4px;">Email</td>
                    <td style="padding:4px;">Phone</td>
                    <td style="padding:4px;">Residence</td>
                    <td style="padding:4px;">Dob</td>
                    <td style="padding:4px;">Experience</td>
                    <td style="padding:4px;">Current Employment</td>
                    <td style="padding:4px;">Salary</td>
                    <td style="padding:4px;">City</td>
                    <td style="padding:4px;">Notice Period</td>
                    <td style="padding:4px;">Profile Image</td>
                    <td style="padding:4px;">Resume</td>
                </tr>
            </thead>
    ';
    $tbl.='<tbody>';
    if ($getjobs->rowCount()>0) {
        $c=1;
        foreach ($getjobs->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $d=explode('/', $value['apply_date']);
            $date=$d[2].'/'.$d[1].'/'.$d[0];
            $tbl.='<tr>
                <td style="padding:4px"><a href="applicant-view.php?postid='.$value['sno'].'">'.$value['sno'].'</a></td>
                <td style="padding:4px">'.$date.'</td>
                <td style="padding:4px">'.$value['job_title'].'</td>
                <td style="padding:4px">'.$value['name'].'</td>
                <td style="padding:4px">'.$value['email'].'</td>
                <td style="padding:4px">'.$value['phone'].'</td>
                <td style="padding:4px">'.$value['residence'].'</td>
                <td style="padding:4px">'.$value['dob'].'</td>
                <td style="padding:4px">'.$value['experience'].'</td>
                <td style="padding:4px">'.$value['current_emp'].'</td>
                <td style="padding:4px">'.$value['current_sal'].'</td>
                <td style="padding:4px">'.$value['job_city'].'</td>
                <td style="padding:4px">'.$value['notice_period'].'</td>
                <td style="padding:4px"><a href="https://kenz-plus.com/changan/uploads/profile/'.$value['profile_image'].'" target="_blank">https://kenz-plus.com/changan/uploads/profile/'.$value['profile_image'].'</a></td>
                <td style="padding:4px"><a href="https://kenz-plus.com/changan/uploads/'.$value['resume'].'" target="_blank">https://kenz-plus.com/changan/uploads/'.$value['resume'].'</a></td>
            </tr>
            ';
        }
    }else{
        echo '<tr>
            <td colspan="16"><center>--No data found--</center></td>
        </tr>';
    }

    $tbl.='<tbody>';
    $tbl.='</table>
    </html>
    ';

	echo $tbl;
}
?>
