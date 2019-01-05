<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/26/18
 * Time: 9:10 AM
 */
session_start();

require '../class/inv.inc';
$product = new invenotry();

?>


    <!--  item -->

    <td>
        <select id="itemorderid<?php echo $_REQUEST["itemordernumber"];?>" name="<?php echo $_REQUEST["itemordernumber"]; ?>" onchange="getoffer(this.id,this.name,this.value);" style="width: 400px;">

            <option selected disabled>Select Item</option>
            <?php
            $numberofitemis=$product->selectall('item','*', NULL,'','','number');
            //select item code using selectall
            $itemdata = $product->selectall('item','*', NULL,'','','data');
            for ($i = 0; $i < $numberofitemis; $i++) {
                // for loop to store single item in $item and create options from this item where itemcode
                ?>
                <option value="<?php echo $itemdata[$i]['itemcode']; ?>">  <?php echo $itemdata[$i]['itemdesc']; ?>    </option>

            <?php } ?>

        </select>
    </td>

    <!-- end  item -->

    <!--  QTY -->

    <td><input type="number" name="<?php echo $_REQUEST["itemordernumber"]; ?>" id="qty<?php echo $_REQUEST["itemordernumber"]; ?>" style="height: 30px;" onchange="getdata(this.id,this.name)"></td>

    <!--  End QTY -->

    <!--  U OF M -->
    <td><select name="<?php echo $_REQUEST["itemordernumber"]; ?>" id="uofm<?php echo $_REQUEST["itemordernumber"]; ?>" onchange="getdata(this.id,this.name)" ></select>
    <!-- end U OF M -->
    <!--  offer -->
    <td><select name="<?php echo $_REQUEST["itemordernumber"]; ?>" id="offer<?php echo $_REQUEST["itemordernumber"]; ?>" onchange="getdata(this.id,this.name)"></select>



    </td>
    <!-- end  offer -->
<td> <input type="number"  value="0" id="Bonus<?php echo $_REQUEST["itemordernumber"]; ?>"  disabled style="background-color:transparent;
    border: 0px solid;
    height:30px;width:100px;
    "></td>
    <!-- Total QTY -->
<td> <input type="number"  value="0" id="totalqty<?php echo $_REQUEST["itemordernumber"]; ?>"  disabled style="background-color:transparent;
    border: 0px solid;
    height:30px;width:100px"></td>
    <!-- end Total QTY-->
    <!--  Unit price -->
<td> ₪ <input type="number"  value="0" id="unitprice<?php echo $_REQUEST["itemordernumber"]; ?>"  disabled style="background-color:transparent;
    border: 0px solid;
    height:30px;
    width:50px;"></td>
    <!-- end Unit price -->

    <!--  Total Price -->
    <td> <input type="number"  value="0" id="totalprice<?php echo $_REQUEST["itemordernumber"]; ?>"  disabled style="background-color:transparent;
    border: 0px solid;
    height:30px;width:100px
   "></td>
    <!-- end Total Price -->
