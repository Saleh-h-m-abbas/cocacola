<?php
require '../class/inv.inc';
$product = new invenotry();

$itemselected = $_REQUEST["itemid"];

$numberofofferis=$product->selectall('offer','id',NULL,'offeritemcode='.$itemselected,'','number');
//select item code and store in $itemcodeis
?>
    <option value="0" selected  disabled> Select Offer </option>

<?php
$itemcodeis = $product->selectall('offer','*', NULL,'offeritemcode='.$itemselected,'','data');
for ($i = 0; $i < $numberofofferis; $i++) {
    ?>
    <option value="<?php echo $itemcodeis[$i]['id']; ?>">  <?php echo $itemcodeis[$i]['descoffer']; ?>    </option>
<?php }






