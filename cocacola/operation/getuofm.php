<?php
require '../class/inv.inc';
$product = new invenotry();

$itemselected = $_REQUEST["itemid"];

$numberofunitis=$product->selectall('itemuofm','uofmid',NULL,'unititemcodeid='.$itemselected,'','number');
//select item code and store in $itemcodeis
?>
    <option value="1" selected  disabled> Unit Of Measure </option>

<?php
$itemunitis = $product->selectall('itemuofm','*', NULL,'unititemcodeid='.$itemselected,'','data');

for ($i = 0; $i < $numberofunitis; $i++) {
    $unitofm = $product->selectall('uofm','*', NULL,'id='.$itemunitis[$i]['uofmid'],'','data');
    ?>

    <option value="<?php echo $itemunitis[$i]['numberofitem']; ?>" >  <?php echo $unitofm[0]['uofm']; ?>    </option>
<?php }






