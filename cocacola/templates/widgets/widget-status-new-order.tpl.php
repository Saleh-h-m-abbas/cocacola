<?php

$a= $product->selectall('quotations','*',NULL,'status=1','','number');


?>


<div class="vd_status-widget vd_bg-green  widget">
    <?php include('templates/widgets/panel-menu-widget-refresh.tpl.php'); ?>                                 
    <a class="panel-body" href="#">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
                <?php

                 echo $a;

                ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
            Confirm Order
        </div>  
     </a>                                                                
</div>  