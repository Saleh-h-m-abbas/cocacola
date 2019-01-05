<?php
require './class/inv.inc';
$product = new invenotry();
$numberofitemis=$product->selectall('item','itemcode',NULL,'','','number');


session_start();

if(!isset($_SESSION['email'])){
    echo("<script>location.href ='pages-login.php';</script>");

}
if($_SESSION['lock']!=0){
    echo("<script>location.href ='pages-Lockscreen.php';</script>");

}

?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

    <!-- Specific Page Data -->
<?php $title = 'Product View'; ?>
<?php //$keywords = 'HTML5 Template, CSS3, Mega Menu, Admin Template, Elegant HTML Theme, Vendroid'; ?>
<?php //$description = 'Form Wizards - Responsive Admin HTML Template'; ?>
<?php $page = 'forms';   // To set active on the same id of primary menu ?>
    <!-- End of Data -->

<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>




    <div class="content">
        <div class="container">
            <?php if ($navbar_left_config != 0) { $current_navbar="vd_navbar-left"; require('templates/navbars/'.$navbar_left.'.tpl.php'); }?>
            <?php if ($navbar_right_config != 0) { $current_navbar="vd_navbar-right"; require('templates/navbars/'.$navbar_right.'.tpl.php'); }?>

            <!-- Middle Content Start -->

            <div class="vd_content-wrapper">
                <div class="vd_container">
                    <div class="vd_content clearfix">
                        <div class="vd_head-section clearfix">
                            <div class="vd_panel-header">
                                <ul class="breadcrumb">
                                    <li><a href="index.php">Home</a> </li>
                                    <li><a href="forms-elements.php">Inventory</a> </li>
                                    <li class="active">Product View</li>
                                </ul>
                                <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                            </div>
                        </div>
                        <div class="vd_title-section clearfix">
                            <div class="vd_panel-header">
                                <h1>Product View</h1>
                                <small class="subtitle">***</small>



                                <div class="vd_panel-menu ">

                                    <div class="menu">
                                        <a href="#view" data-toggle="tab"> <div> <span class="menu-icon mgr-10 active"> <i class="glyphicon glyphicon-th-large"></i> View  </span>
                                        </div></a>

                                    </div>
                                    <div class="menu">
                                        <a href="#list" data-toggle="tab"> <div> <span class="menu-icon mgr-10 active"> <i class="glyphicon glyphicon-th-large"></i> List  </span>
                                            </div></a>

                                    </div>
                                </div>
                            </div>
                        </div>


                            <div class="container">



                            <div class="tab-content">


                                <div id="view" class="tab-pane fade in active">
                                    <div class="vd_content-section clearfix">
                                        <div id="tabinfo" class="tab-pane active">
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12">
                                                    <div class="panel widget light-widget panel-bd-top">
                                                        <div class="panel-heading no-title"> </div>
                                                        <div class="panel-body">
                                                            <h3 class="mgtp--5"> Product</h3>
                                                            <div class="content-grid column-xs-2 column-sm-2 column-md-4 column-lg-5 column-lg-10 height-xs-5">
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
                                                            </div>
                                                            <!-- content-grid -->
                                                        </div>
                                                    </div>
                                                    <!-- Panel Widget -->

                                                </div>
                                                <!-- col-md-4 -->

                                            </div>
                                        </div>

                                    </div>



                                      </div>



                                <div id="list" class="tab-pane fade">

                                    <div class="vd_content-section clearfix">

                                        <!-- row -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel widget">
                                                    <div class="panel-heading vd_bg-grey">
                                                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Product List </h3>
                                                    </div>
                                                    <div class="panel-body  table-responsive">
                                                        <table class="table table-condensed table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Photo</th>
                                                                <th>category</th>
                                                                <th>Price</th>
                                                                <th>ON HAND</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php
                                                            $itemcodeis=$product->selectall('item','*', NULL,'','','data');
                                                            $nop=1;
                                                            for ($i=0;$i<$numberofitemis;$i++){

                                                                $x1 = ($product->selectall('item', '*', NULL, 'itemcode=' . $itemcodeis[$i]["itemcode"], '','data'));
                                                                $x2=($product->sumon($itemcodeis[$i]['itemcode']));
                                                                $x3=($product->selectall('itemprice', '*', NULL, 'itemcprice=' . $itemcodeis[$i]["itemcode"], '','data'));
                                                                $cat=$product->selectall('categories','*', NULL,'id='.$x1[0]['itemcat'],'','data');

                                                                if($i!=0 && $i%4==0){$nop++;

                                                                ?><div id="<?php echo $nop; ?>" class="tab-pane fade">

                                                                <?php

                                                                }

                                                                ?>





                                                                    <tr>
                                                                    <td> <?php echo $itemcodeis[$i]['itemcode'];?>      </td>
                                                                    <td>

                                                                        <a href=""><img alt="product image" style="width:80px;" src="img/product/<?php  echo $x1[0]['itemimage']; ?>"> </a>


                                                                    </td>
                                                                    <td class="center"><?php echo $cat[0]['seg1']."|".$cat[0]['seg2']."|".$cat[0]['seg3'];?></td>
                                                                    <td class="center"><?php  echo $x3[0]['price'];   ?></td>
                                                                    <td class="center"><?php   echo $x2;    ?></td>

                                                                    <td class="center">
                                                                        <?php  if( ($x1[0]['status'])==0){ ?>
                                                                            <span class="label label-default">Inactive</span>
                                                                            <?php
                                                                        }else{?>

                                                                        <span class="label label-success">Active</span>

                                                                        <?php }  ?>
                                                                    </td>
                                                                    <td class="menu-action">
                                                                        <a href="view.php?id=<?php echo $itemcodeis[$i]['itemcode'];?> " data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_green">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>
                                                                        <a href="./edit.php?itemcodeedit=<?php  echo $itemcodeis[$i]['itemcode']; ?>" data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_yellow">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        </a></td>
                                                                </tr>




                                                          <?php if($i!=0 && $i%4==0) { ?>    </div> <?php }?>
                                                                    <?php
                                                                     } ?>


                                                            </tbody>
                                                        </table>

                                                        <ul class="pagination">
                                                            <li><a href="#">&laquo;</a></li>

                                                            <li class="active"><a href="#">1</a></li>
                                                            <?php for ($j=2;$j<$nop;$j++) ?>
                                                            <li><a href="#<?php echo $j; ?>"><?php echo $j; ?></a></li>



                                                            <li><a href="#">&raquo;</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- Panel Widget -->
                                            </div>
                                            <!-- col-md-12 -->
                                        </div>
                                        <!-- row -->
                                    </div>







                                      </div>

                            </div>
                        </div>

                    </div></div></div></div></div>





<?php require_once('templates/footers/'.$footer.'.tpl.php'); ?>

    <!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/forms-wizard.tpl.php'); ?>


    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>