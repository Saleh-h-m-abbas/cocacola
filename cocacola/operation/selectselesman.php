<?php
//call inv class
require '../class/inv.inc';
//start session
session_start();
//if not login go to login page
if (!isset($_SESSION['email'])) {
    echo("<script>location.href ='pages-login.php';</script>");
}
//if account lock go to lock page
if ($_SESSION['lock'] != 0) {
    echo("<script>location.href ='pages-Lockscreen.php';</script>");
}
//create object from inv class
$employee = new emp();
$superid = $_REQUEST["superid"];
$numberofsalesman=$employee->selectall('salesman','id',NULL,'supervisorid='.$superid,'','number');


?>

    <?php
    $salesmanid=$employee->selectall('salesman','*',NULL,'supervisorid='.$superid,'','data');
    $employeeid=$employee->selectall('emp','*',NULL,'empno='.$salesmanid[0]['empid'],'','data');
    $employeearea=$employee->selectall('area','*',NULL,'id='.$salesmanid[0]['areaid'],'','data');

    ?>

<tr>
<td><?php echo $employeeid[0]['empno'];?></td>
<td><?php echo $employeeid[0]['user'];?></td>
<td><?php echo $employeeid[0]['email'];?></td>
<td><?php echo $employeearea[0]['areadesc'];?></td>


<td ><?php if($employeeid[0]['groupID']==1){echo "Salesman";} ;?></td>
<td class="center">

    <?php
    if($employeeid[0]['status']==1){
        ?>
        <span class="label label-success">Active</span>
    <?php }elseif($employeeid[0]['status']==0){ ?>
        <span class="label label-danger">Deactivate</span>
    <?php } ?>
</td>
<td class="menu-action"><a data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-grey vd_grey"> <i class="fa fa-eye"></i> </a> <a data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-pencil"></i> </a> </td>


</tr>

<?php
    for($i=1;$i<$numberofsalesman;$i++){
        $employeeid=$employee->selectall('emp','*',NULL,'empno='.$salesmanid[$i]['empid'],'','data');
        $employeearea=$employee->selectall('area','*',NULL,'id='.$salesmanid[$i]['areaid'],'','data');
         ?>

<tr>
    <td><?php echo $employeeid[0]['empno'];?></td>
        <td><?php echo $employeeid[0]['user'];?></td>
        <td><?php echo $employeeid[0]['email'];?></td>
        <td><?php echo $employeearea[0]['areadesc'];?></td>


        <td ><?php if($employeeid[0]['groupID']==1){echo "Salesman";} ;?></td>
        <td class="center">

            <?php
            if($employeeid[0]['status']==1){
                ?>
                <span class="label label-success">Active</span>
            <?php }elseif($employeeid[0]['status']==0){ ?>
                <span class="label label-danger">Deactivate</span>
            <?php } ?>
        </td>
        <td class="menu-action"><a data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-grey vd_grey"> <i class="fa fa-eye"></i> </a> <a data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-pencil"></i> </a> </td>
</tr>

    <?php } ?>
