<?php
//import method from database
require './class/inv.inc';
session_start();
$product = new invenotry();

if(!isset($_SESSION['email'])){
    echo("<script>location.href ='pages-login.php';</script>");

}
if($_SESSION['lock']!=0){
    echo("<script>location.href ='pages-Lockscreen.php';</script>");

}
?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<!-- Specific Page Data -->
<?php $title = 'Add Product'; ?>
<?php $keywords = ''; ?>
<?php $description = ''; ?>
<?php $page = 'forms';   // To set active on the same id of primary menu ?>
<!-- End of Data -->

<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>

    <script>
        //function to update image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    //update image after select in same page
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(250)
                        .height(220);
                    //update image after select in last page
                    $('#last')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);

            }
        }
        //function to update data
        function data() {
            // get and print name
            Name = document.getElementById("name").value;
            document.getElementById("na").innerHTML = Name;
            // get and print Categories
            Categories = document.getElementById("Categories").value;
            document.getElementById("ca").innerHTML = Categories;
            // get and print Type
            Type = document.getElementById("Type").value;
            document.getElementById("ty").innerHTML = Type;
            // get and print Barcode
            Barcode = document.getElementById("Barcode").value;
            document.getElementById("ba").innerHTML = Barcode;
            // get and print website
            var website = document.getElementById("website");
             xw="";
            if(website.checked == true){
               xw ="on";
                document.getElementById("we").innerHTML = "on";
            }else {
                xw="off";
                document.getElementById("we").innerHTML = "off";
            }
            // get and print POS
            var POS = document.getElementById("POS");
             xp="";
            if(POS.checked == true){
                 xp="on";
            document.getElementById("po").innerHTML = "on";
            }else {
                 xp="off";
            document.getElementById("po").innerHTML = "off";
            }
            // get and print Price
            Price = document.getElementById("price").value;
            document.getElementById("pr").innerHTML = Price;
            // get and print price From
            From = document.getElementById("from").value;
            document.getElementById("fr").innerHTML = From;
            // get and print Price to
            to = document.getElementById("to").value;
            document.getElementById("too").innerHTML = to;
            // get and print item Weight
            Weight = document.getElementById("weight").value;
            document.getElementById("wei").innerHTML = Weight;
            // get and print item cost
            cost = document.getElementById("cost").value;
            document.getElementById("co").innerHTML = cost;
            // get and print item note
            DFC = document.getElementById("DFC").value;
            document.getElementById("DFC1").innerHTML = DFC;
            // get and print Price
            DFDO = document.getElementById("DFDO").value;
            document.getElementById("DFDO1").innerHTML = DFDO;
            // get and print Price
            DFIT = document.getElementById("DFIT").value;
            document.getElementById("DFIT1").innerHTML = DFIT;
            // get and print Price
             radios = document.getElementsByName('Status');
             stat="";
            for (var i = 0, length = radios.length; i < length; i++) {
                if (radios[i].checked) {
                    // do whatever you want with the checked radio
                    stat= radios[i].value;
                    document.getElementById("status").innerHTML = stat;
                    // only one radio can be logically checked, don't check the rest
                    break;
                }
            }
            cbs = document.getElementById("cbs");
            cbso="";
            if(cbs.checked == true){
                cbso =1;
                document.getElementById("cbs1").innerHTML = "true";
            }else {
                cbso=0;
                document.getElementById("cbs1").innerHTML = "false";
            }



        }
      

        function insertdata() {

            fileName = "./operation/insert.php?Name=" + Name +"&Categories=" + Categories +"&Type=" + Type+"&Barcode=" + Barcode +"&website=" + xw + "&pos=" + xp+"&Status="+radios+"&cbs=" + cbso+"&Price=" + Price+"&From=" + From + "&to=" + to+ "&Weight=" + Weight+"&cost=" + cost+ "&DFC=" + DFC+"&DFDO=" + DFDO+ "&DFIT=" + DFIT;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                 //  alert( this.responseText);
                }
            };
            xhttp.open("POST", fileName, true);
            xhttp.send();


        }




    </script>

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
                                <li><a href="inventory.php">Inventory</a> </li>
                                <li class="active">Add Product</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Add Product</h1>
                            <small class="subtitle"></small> </div>
                    </div>
                    <div class="vd_content-section clearfix">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel widget">
                                    <div class="panel-heading vd_bg-grey">
                                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span> Wizard Add Product </h3>
                                    </div>
                                    <div class="panel-body" style="height:90%;">
                                        <form class="form-horizontal" action="./operation/insert.php" method="POST" enctype="multipart/form-data">
                                            <div id="wizard-2" class="form-wizard">
                                                <ul>
                                                    <li><a href="#tab21" data-toggle="tab">
                                                            <div class="menu-icon"> 1 </div>
                                                            Product Information </a></li>
                                                    <li><a href="#tab22" data-toggle="tab">
                                                            <div class="menu-icon"> 2 </div>
                                                            Sales and Inventory </a></li>
                                                    <li><a href="#tab23" data-toggle="tab">
                                                            <div class="menu-icon"> 3 </div>
                                                            invoicing </a></li>
                                                    <li><a href="#tab24" data-toggle="tab">
                                                            <div class="menu-icon"> 4 </div>
                                                            Notes </a></li>
                                                    <li><a href="#tab25" data-toggle="tab">
                                                            <div class="menu-icon"> 5 </div>
                                                            Confirm </a></li>
                                                </ul>
                                                <div class="progress progress-striped active" >
                                                    <div class="progress-bar progress-bar-info" > </div>
                                                </div>
                                                    <div class="tab-content no-bd pd-25" >

                                                    <div class="tab-pane" id="tab21" style="height:50%;" >
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Product Name</label>
                                                            <div class="col-sm-3 controls">
                                                                <input type="text"  placeholder="Product Name" name="name" class="input-border-btm" id="name" required>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Barcode</label>
                                                            <div class="col-sm-3 controls">
                                                                <input type="number" value="0102392" name="Barcode" class="  updateCurrentText " id="Barcode" >

                                                            </div>
                                                        </div>
                                                        <div class="form-group">


                                                            <label class="col-sm-2 control-label">Product Type</label>
                                                            <div class="col-sm-3 controls">
                                                                <select  name="Type" class="input-border-btm" id="Type" >

                                                                    <option selected="selected" > Select Type </option>
                                                                    <?php
                                                                    //select number of type useing selectall function
                                                                    $numberoftype = $product->selectall('itemtype','*',NULL,'','','number');
                                                                    //for loop to display all type as a select and all have own id
                                                                    for ($i = 0; $i < $numberoftype; $i++) {
                                                                        //
                                                                        $x1 = $product->selectall('itemtype','*', NULL,'','','data')[$i];
                                                                        ?>
                                                                        <option value="<?php echo $x1['id']; ?>"><?php echo $x1['type']; ?></option>

                                                                    <?php }
                                                                    ?>

                                                                </select>

                                                                  </div>
                                                            <label class="col-sm-2 control-label">Enable on Webiste</label>
                                                            <div class="col-sm-3 controls">
                                                                <input type="checkbox" data-rel="switch" data-size="mini" data-wrapper-class="yellow" id="website" name="website" checked>
                                                                </div>


                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Select Categories</label>
                                                            <div class="col-sm-3 controls">
                                                                <select  name="Categories" class="input-border-btm" id="Categories">
                                                                    <option selected="selected" value="00"> Select Categories </option>
                                                                    <?php
                                                                    $numberofcat = $product->selectall('categories','*',NULL,'','','number');
                                                                    for ($i = 0; $i < $numberofcat; $i++) {
                                                                        $x1 = $product->selectall('categories','*', NULL,'','','data')[$i];
                                                                        ?>
                                                                        <option value="<?php echo $x1['id']; ?>"><?php echo $x1['seg1'] . " | " . $x1['seg2'] . " | " . $x1['seg3']; ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>

                                                               </div>
                                                            <label class="col-sm-2 control-label">Enable on POS</label>
                                                            <div class="col-sm-3 controls">
                                                                <input type="checkbox" data-rel="switch" data-size="mini" data-wrapper-class="yellow" id="POS" name="pos" checked>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Status</label>
                                                            <div class="col-sm-3 controls">
                                                                <div class="vd_radio radio-success">
                                                                    <input type="radio" checked="checked" value="Active" name="Status" id="yes">
                                                                    <label for="yes">Active</label>
                                                                </div>
                                                                <div class="vd_radio radio-success">
                                                                    <input type="radio"  value="Archive" name="Status" id="no">
                                                                    <label for="no">Archive</label>
                                                                </div>
                                                                 </div>
                                                            <label class="col-sm-2 control-label">Upload image</label>
                                                            <div class="col-sm-3 controls">
                                                                <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);" >
                                                               </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Image selected</label>
                                                            <div class="col-sm-3 controls">

                                                                <img id="blah" class="rounded mx-auto d-block" src="./img/prod.png" alt="your image" style="width: 250px; height: 220px;" />
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="tab22" style="height:500px;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Price</label>
                                                            <div class="col-sm-7 controls">
                                                                <div class="input-group"> <span class="input-group-addon"> ₪ </span>
                                                                    <input type="number" placeholder="Price" name="price" id="price">
                                                                  </div>
                                                            </div>


                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">From</label>
                                                            <div class="col-sm-3 controls">
                                                                <div class="input-group">
                                                                    <input type="Date" placeholder="Date" id="from" name="from">
                                                                    <span class="input-group-addon" id="datepicker-icon-trigger" data-datepicker="#datepicker-icon"><i class="fa fa-calendar"></i></span> </div>
                                                            </div>
                                                            <label class="col-sm-1 control-label">To</label>
                                                            <div class="col-sm-3 controls">
                                                                <div class="input-group">
                                                                    <input type="Date" placeholder="Date" id="to" name="to">
                                                                    <span class="input-group-addon" id="datepicker-icon-trigger" data-datepicker="#datepicker-icon"><i class="fa fa-calendar"></i></span> </div>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Weight</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" id="weight" name="weight">
                                                            </div>
                                                            <label class="col-sm-2 control-label">cost</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="number" class="input-border-btm" id="cost" name="cost">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="tab23" style="height:500px;">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Can Be Sold</label>
                                                            <div class="col-sm-7 controls">
                                                                <div class="vd_checkbox checkbox-success">
                                                                    <input type="checkbox" value="1" id="cbs" name="cbs">
                                                                    <label for="cbs"> Yes </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="tab24" style="height:500px;">

                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Description for Customers </label>
                                                                <div class="col-sm-9 controls">

                                                                    <textarea rows="2" class="width-50" id="DFC" name="DFC"></textarea>


                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Description for Delivery Orders</label>
                                                                <div class="col-sm-9 controls">
                                                                    <textarea rows="2" class="width-50" id="DFDO" name="DFDO"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Description for Internal Transfers</label>
                                                                <div class="col-sm-9 controls">
                                                                    <textarea rows="2" class="width-50" id="DFIT" name="DFIT"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="tab25" style="height:50%;">


                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Product name</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="na"></p>
                                                            </div>

                                                            <label class="col-sm-2 control-label">Price</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="pr"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Product Type</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="ty"></p>
                                                            </div>
                                                            <label class="col-sm-2 control-label">From</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="fr"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Product Cat</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="ca"></p>
                                                            </div>
                                                            <label class="col-sm-2 control-label">to</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="too"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Barcode</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="ba"></p>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Enable on Webiste</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="we"></p>
                                                            </div>
                                                            <label class="col-sm-2 control-label">cbs</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="cbs1"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Enable on POS</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="po"></p>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Weight</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="wei"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Status</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="status"></p>
                                                            </div>
                                                            <label class="col-sm-2 control-label">cost</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="co"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Img</label>
                                                            <div class="col-sm-4 controls">
                                                                <img id="last" class="rounded mx-auto d-block" src="./img/prod.png" alt="your image" style="width: 100px; height: 100px;" />
                                                            </div>
                                                            <label class="col-sm-2 control-label">Description for Customers</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="DFC1"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Description for Delivery Orders</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="DFDO1"></p>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Description for Internal Transfers</label>
                                                            <div class="col-sm-4 controls">
                                                                <p id="DFIT1"></p>
                                                            </div>
                                                        </div>


                                                        </div>

                                                    <div class="form-actions-condensed wizard">
                                                        <div class="row mgbt-xs-0">
                                                            <div class="col-sm-9 col-sm-offset-2">
                                                                <a class="btn vd_btn prev" href="javascript:void(0);">
                                                                    <span class="menu-icon">
                                                                        <i class="fa fa-fw fa-chevron-circle-left">

                                                                        </i></span> Previous</a>
                                                                <a class="btn vd_btn next" onclick="data()" >Next <span class="menu-icon">
                                                                        <i class="fa fa-fw fa-chevron-circle-right"></i></span></a>


                                                                <button type="submit"  value="Submit" name="submit" class="btn vd_btn vd_bg-green finish" onclick="insertdata()" ><span class="menu-icon">
                                                                        <i class="fa fa-fw fa-check"></i></span> Finish
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- Panel Widget -->
                            </div>
                            <!-- col-md-12 -->
                        </div>
                        <!-- row -->
                    </div>
                </div></div></div></div></div>

<?php require_once('templates/footers/'.$footer.'.tpl.php'); ?>

    <!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/forms-wizard.tpl.php'); ?>


    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>