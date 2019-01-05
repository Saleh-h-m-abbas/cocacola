<?php
//call inv class
require '../class/inv.inc';
//start session
session_start();

//create object from inv class
$product = new invenotry();
//set # of item in $numberofitemis using selectall method
$numberofitemis = $product->selectall('item','itemcode',NULL,'','','number');
//set # of organiztion in $numberoforg using selectall method
$numberoforg = $product->selectall('organization','orgcode',NULL,'','','number');
//set # of transactiontype in $numberoftrxtype using selectall method
$numberoftrxtype = $product->selectall('invtranstype','invtycode',NULL,'','','number');
$orgselect = $_REQUEST["org"];
?>
<div class="col-sm-7 controls" style="margin-top: 20px;">



    <select class="width-40" name="to" id="to">
        <option>Select Organiztion</option>


        <?php
        //select item code and store in $itemcodeis
        $itemcodeis = $product->selectall('organization','*', NULL,'orgcode!='.$orgselect,'','data');
        for ($i = 0; $i < $numberoforg-1; $i++) {
            ?>
            <option value="<?php echo $itemcodeis[$i]['orgcode']; ?>">  <?php echo $itemcodeis[$i]['desc']; ?>    </option>
        <?php }


?>
    </select></div>
