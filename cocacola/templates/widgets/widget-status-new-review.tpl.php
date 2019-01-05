<?php

$numberofcancelorder= $product->selectall('quotations','*',NULL,'status=2','','number');


?>

<div class="vd_status-widget label-danger widget">
    <?php include('templates/widgets/panel-menu-widget-refresh.tpl.php'); ?>                                  
    <a class="panel-body"  href="#">                                  
        <div class="clearfix">
            <span class="menu-icon">
                <i class="fa fa-comments"></i>
            </span>
            <span class="menu-value">
                <?php
                echo $numberofcancelorder;

                ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
            Cancelled Order
        </div>
     </a>                                                                  
</div> 