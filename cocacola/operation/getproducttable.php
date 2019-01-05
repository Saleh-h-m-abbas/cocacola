<?php
require '../class/inv.inc';
$product = new invenotry();
$numberofitemis=$product->selectall('item','itemcode',NULL,'','','number');

$orgselected = $_REQUEST["org"];
if($orgselected=='All'){?>
    <div class="panel-heading vd_bg-grey">

        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Data Tables Example </h3>
    </div>
    <div class="panel-body table-responsive">
    <table class="table table-striped" id="data-tables">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>category</th>
            <th>ON HAND</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

    <tbody>
        <?php
        $itemcodeis=$product->selectall('item','*', NULL,'','','data');
        for ($i=0;$i<$numberofitemis;$i++){
            $x1 = ($product->selectall('item', '*', NULL, 'itemcode=' . $itemcodeis[$i]["itemcode"], '','data'));
            $x2=($product->sumon($itemcodeis[$i]['itemcode']));
            $x3=($product->selectall('itemprice', '*', NULL, 'itemcprice=' . $itemcodeis[$i]["itemcode"], 'time DESC','data'));
            $x4=($product->selectall('categories', '*', NULL, 'id=' . $itemcodeis[$i]["itemcat"], '','data'));

            ?>

            <tr class="odd gradeX">
                <td><?php  echo $itemcodeis[$i]['itemcode']; ?></td>
                <td><a href="./view.php?id=<?php  echo $itemcodeis[$i]['itemcode']; ?>"><img alt="product image" style="width:80px;" src="img/product/<?php  echo $x1[0]['itemimage']; ?>"> </a></td>
                <td><?php  echo $x4[0]['seg1']; ?></td>
                <td class="center"> <?php  echo $x2;  ?> </td>
                <td class="center">     <?php  if( ($x1[0]['status'])==0){ ?>
                        <span class="label label-default">Inactive</span>
                        <?php
                    }else{?>

                        <span class="label label-success">Active</span>

                    <?php }  ?></td>
                <td class="center"> <a href="view.php?id=<?php echo $itemcodeis[$i]['itemcode'];?> " data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_green">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="./edit.php?itemcodeedit=<?php  echo $itemcodeis[$i]['itemcode']; ?>" data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_yellow">
                        <i class="fa fa-pencil"></i>
                    </a></td>
            </tr>

            <?php
        } ?>


    </tbody>
    </table>
    </div>
    <?php



}else{
    $numberofiteminorg=$product->selectall('invTranslation',' DISTINCT itemcodetrans',NULL,'fromorg='.$orgselected. ' OR toorg='.$orgselected,'','number');
    $iteminorg=$product->selectall('invTranslation',' DISTINCT itemcodetrans',NULL,'fromorg='.$orgselected. ' OR toorg='.$orgselected,'','data');
    ?>

    <div class="panel-heading vd_bg-grey">
        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Data Tables Example </h3>
    </div>
    <div class="panel-body table-responsive">
    <table class="table table-striped" id="data-tables">
    <thead>
    <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>category</th>
        <th>ON HAND</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $itemcodeis = $product->selectall('item', '*', NULL, '', '', 'data');
        for ($i = 0; $i < $numberofiteminorg; $i++) {

            $x1 = ($product->selectall('item', '*', NULL, 'itemcode=' . $iteminorg[$i]["itemcodetrans"], '', 'data'));
            $x2=($product->sumonorg($iteminorg[$i]["itemcodetrans"],$orgselected));
             $x4=($product->selectall('categories', '*', NULL, 'id=' . $itemcodeis[$i]["itemcat"], '','data'));

                ?>
                        <tr class="odd gradeX">
                            <td><?php echo $itemcodeis[$i]['itemcode']; ?></td>
                            <td><a href="./view.php?id=<?php echo $itemcodeis[$i]['itemcode']; ?>"><img alt="product image" style="width:80px;" src="img/product/<?php  echo $x1[0]['itemimage']; ?>"> </a></td>
                            <td><?php  echo $x4[0]['seg1']; ?></td>
                            <td class="center"> <?php  echo $x2;  ?> </td>
                            <td class="center">     <?php  if( ($x1[0]['status'])==0){ ?>
                                    <span class="label label-default">Inactive</span>
                                    <?php
                                }else{?>

                                    <span class="label label-success">Active</span>

                                <?php }  ?></td>
                            <td class="center"> <a href="view.php?id=<?php echo $itemcodeis[$i]['itemcode'];?> " data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_green">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="./edit.php?itemcodeedit=<?php  echo $itemcodeis[$i]['itemcode']; ?>" data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_yellow">
                                    <i class="fa fa-pencil"></i>
                                </a></td>
                        </tr>

                        <?php
                    } ?>

                    </tbody>
                </table>
            </div>
        <?php

}?>

