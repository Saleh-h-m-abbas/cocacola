<?php
require '../class/inv.inc';
$product = new invenotry();
$numberofitemis=$product->selectall('item','itemcode',NULL,'','','number');

$orgselected = $_REQUEST["org"];
if($orgselected=='All'){?>

              <ul class="list-wrapper">
   <?php
    $itemcodeis=$product->selectall('item','*', NULL,'','','data');
         for ($i=0;$i<$numberofitemis;$i++){
             $x1 = ($product->selectall('item', '*', NULL, 'itemcode=' . $itemcodeis[$i]["itemcode"], '','data'));
             $x2=($product->sumon($itemcodeis[$i]['itemcode']));
             $x3=($product->selectall('itemprice', '*', NULL, 'itemcprice=' . $itemcodeis[$i]["itemcode"], 'time DESC','data'));
             ?>
             <li> <a href="./view.php?id=<?php  echo $itemcodeis[$i]['itemcode']; ?>" >
                     <div class="menu-icon" ><img src="img/product/<?php  echo $x1[0]['itemimage']; ?>" style="width: 70%; height:180px; "></div>
                 </a>
                 <div class="menu-text" style="font-size: 24px;"> <?php  echo $x1[0]['itemdesc']; ?>
                     <div class="menu-info">
                         <div class="menu-date" style="font-size: 18px;">on hand:  <?php   echo $x2;    ?></div>
                         <div class="menu-date" style="font-size: 18px;">price: <?php  echo $x3[0]['price'];   ?></div>
                         <div class="menu-action" >

                             <a  href="./view.php?id=<?php  echo $itemcodeis[$i]['itemcode']; ?>" >
                                 <span data-placement="bottom" data-toggle="tooltip" data-original-title="View" class="menu-action-icon vd_black vd_bd-black" style="width: 40px;height: 30px">
                                     <i class="glyphicon glyphicon-eye-open" style="font-size: 25px;">  </i> </span></a>
                             <a href="./edit.php?itemcodeedit=<?php  echo $itemcodeis[$i]['itemcode']; ?>">  <span data-placement="bottom" data-toggle="tooltip" data-original-title="Edit" class="menu-action-icon vd_black vd_bd-black" style="width: 40px;height: 30px" >
                                     <i class="fa fa-pencil" style="font-size: 25px;" ></i>
                                 </span> </a> </div>
                     </div>
                 </div>
             </li>
             <?php
         } ?>

              </ul>


<?php

}else{
$numberofiteminorg=$product->selectall('invTranslation',' DISTINCT itemcodetrans',NULL,'fromorg='.$orgselected. ' OR toorg='.$orgselected,'','number');
$iteminorg=$product->selectall('invTranslation',' DISTINCT itemcodetrans',NULL,'fromorg='.$orgselected. ' OR toorg='.$orgselected,'','data');
?>

<ul class="list-wrapper">
<?php
$itemcodeis = $product->selectall('item', '*', NULL, '', '', 'data');
for ($i = 0; $i < $numberofiteminorg; $i++) {

    $x1 = ($product->selectall('item', '*', NULL, 'itemcode=' . $iteminorg[$i]["itemcodetrans"], '', 'data'));
     $x2=($product->sumonorg($iteminorg[$i]["itemcodetrans"],$orgselected));
    $x3 = ($product->selectall('itemprice', '*', NULL, 'itemcprice=' . $iteminorg[$i]["itemcodetrans"], 'time DESC', 'data'));
    ?>



    <li> <a href="./view.php?id=<?php echo $itemcodeis[$i]['itemcode']; ?>" >
            <div class="menu-icon" ><img src="img/product/<?php echo $x1[0]['itemimage']; ?>" style="width: 70%; height:180px; "></div>
        </a>
        <div class="menu-text" style="font-size: 24px;"> <?php echo $x1[0]['itemdesc']; ?>
            <div class="menu-info">
                <div class="menu-date" style="font-size: 18px;">on hand:  <?php   echo $x2;     ?></div>
                <div class="menu-date" style="font-size: 18px;">price: <?php echo $x3[0]['price']; ?></div>
                <div class="menu-action" >

                    <a  href="./view.php?id=<?php echo $iteminorg[$i]["itemcodetrans"]; ?>" >
                        <span data-placement="bottom" data-toggle="tooltip" data-original-title="View" class="menu-action-icon vd_black vd_bd-black" style="width: 40px;height: 30px">
                            <i class="glyphicon glyphicon-eye-open" style="font-size: 25px;">  </i> </span></a>
                    <a href="./edit.php?itemcodeedit=<?php echo $iteminorg[$i]["itemcodetrans"]; ?>">  <span data-placement="bottom" data-toggle="tooltip" data-original-title="Edit" class="menu-action-icon vd_black vd_bd-black" style="width: 40px;height: 30px" >
                            <i class="fa fa-pencil" style="font-size: 25px;" ></i>
                        </span> </a> </div>
            </div>
        </div>
    </li>
<?php }
?>

    </ul>

<?php }?>




