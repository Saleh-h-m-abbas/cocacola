<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 1:58 PM
 */

require 'database.inc';

class invenotry {
    // define main 	Parameter
    public $itemcode;
    public $itemdesc;
    public $itemtype;
    public $itemcat;
    public $barcode;
    public $status;
    public $addpos;
    public $addweb;
    public $price;
    public $from;
    public $to;
    public $invtransdesc;
    public $qty;
    public $uofm;
    public $itemcodetrans;
    public $trxtypecode;
    public $date;
    public $time;
    public $fromorg;
    public $toorg;

//main function{

    // insert item { Item desc(name), Item Type, Item categurise , barcode, unit of Measre,item status,Add POS, Add Web } return Array
    function insert($itemdesc, $itemtype, $itemcat, $barcode, $status, $addpos, $addweb,$weight,$cbs,$DFC,$DFDO,$DFIT) {
        $this->itemdesc = $itemdesc;
        $this->itemtype = $itemtype;
        $this->itemcat = $itemcat;
        $this->barcode = $barcode;
        $this->status = $status;
        $this->addpos = $addpos;
        $this->addweb = $addweb;
        $this->weight=$weight;
        $this->cbs=$cbs;
        $this->DFC=$DFC;
        $this->DFDO=$DFDO;
        $this->DFIT=$DFIT;

        $db = new Database();
        $db->connect();

        $db->insert('item', array('itemdesc' => $itemdesc, 'itemtype' => $itemtype, 'itemcat' => $itemcat, 'barcode' => $barcode, 'status' => $status,'weight' =>$weight,'canbesold' => $cbs, 'addpos' => $addpos, 'addweb' => $addweb, 'descriptionforcustomers' => $DFC, 'descriptionfordeliveryorders' => $DFDO, 'descriptionforinternaltransfers' => $DFIT));  // Table name, column names and respective values
        $res = $db->getResult();
        return $res;
    }
    // update item { Item desc(name), Item Type, Item categurise , barcode, unit of Measre,item status,Add POS, Add Web } void
    function update($itemcode,$itemdesc, $itemtype, $itemcat, $barcode, $status, $addpos, $addweb,$weight,$cbs,$DFC,$DFDO,$DFIT) {
        $this->itemcode = $itemcode;
        $this->itemdesc = $itemdesc;
        $this->itemtype = $itemtype;
        $this->itemcat = $itemcat;
        $this->barcode = $barcode;
        $this->status = $status;
        $this->addpos = $addpos;
        $this->addweb = $addweb;
        $this->weight=$weight;
        $this->cbs=$cbs;
        $this->DFC=$DFC;
        $this->DFDO=$DFDO;
        $this->DFIT=$DFIT;

        $db = new Database();
        $db->connect();
        $db->update('item', array('itemdesc' => $itemdesc, 'itemtype' => $itemtype, 'itemcat' => $itemcat, 'barcode' => $barcode, 'status' => $status,'weight' =>$weight,'canbesold' => $cbs, 'addpos' => $addpos, 'addweb' => $addweb, 'descriptionforcustomers' => $DFC, 'descriptionfordeliveryorders' => $DFDO, 'descriptionforinternaltransfers' => $DFIT), 'itemcode=' . $itemcode); // Table name, column names and values, WHERE conditions
        $res = $db->getResult();
        return $res;
    }
    // select all need {$table,$rows,$join=NULL,$where,$order,$type} from item
    function selectall($table,$rows,$join,$where,$order,$type){

        $this->table=$table;
        $this->rows=$rows;
        $this->join=$join;
        $this->where=$where;
        $this->order=$order;
        $this->table=$table;

        $db = new Database();
        $db->connect();
        $db->select($table,$rows,$join,$where,$order); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions

        if($type=='number'){
            $res = $db->numRows();
        }elseif($type=='data'){
            $res = $db->getResult();
        }
        return $res;
    }
    // insert new price for item {$itemcode, $price,$from,$to,status}
    function insertnewprice($itemcode,$price,$from,$to,$status) {

        $this->itemcode = $itemcode;
        $this->price = $price;
        $this->from = $from;
        $this->to = $to;
        $this->status=$status;


        $db = new Database();
        $db->connect();
        $t=time();
        $time=date("Y-m-d H:i:s",$t);

        $db->insert('itemprice', array('itemcprice' => $itemcode,'price' => $price, 'from' => $from, 'to' => $to,'time' => $time,'status'=>$status) ); // Table name, column names and values, WHERE conditions
        $res = $db->getResult();
        return $res;
    }
    // insert price for item {$itemcode, $price,$from,$to,cost}
    function insertitemprice($itemcode, $price,$from,$to,$cost,$status) {

        $this->itemcode = $itemcode;
        $this->price = $price;
        $this->from = $from;
        $this->to = $to;
        $this->cost=$cost;
        $this->status=$status;

        $db = new Database();
        $db->connect();
        $t=time();

        $time=date("Y-m-d H:i:s",$t);

        $db->insert('itemprice', array('itemcprice' => $itemcode,'price' => $price, 'from' => $from, 'to' => $to,'cost'=>$cost,'time' => $time,'status'=>$status) ); // Table name, column names and values, WHERE conditions
        $res = $db->getResult();
        return $res;
    }
    // insert item on hand WHERE {itemcode}
    function insertitemonhand($itemcode){
        $this->itemcode = $itemcode;
        $db = new Database();
        $db->connect();
        $db->insert('itemonhand', array('itco' => $itemcode)); // Table name, column names and values, WHERE conditions
    }
    // insert intransaction {$invtransdesc,$qty,$uofm,$itemcodetrans,$trxtypecode,$date,$time,$fromorg,$toorg}
    function inserttrans($qty,$uofm,$itemcodetrans,$trxtypecode,$fromorg,$toorg,$date,$time,$note){

        $this->qty = $qty;
        $this->uofm=$uofm;
        $this->itemcodetrans = $itemcodetrans;
        $this->trxtypecode = $trxtypecode;
        $this->fromorg = $fromorg;
        $this->toorg = $toorg;
        $this->date = $date;
        $this->time = $time;
        $this->note = $note;

        $db = new Database();
        $db->connect();

        $db->insert('invTranslation', array('qty' => $qty,'uofmcode' => $uofm,'itemcodetrans' => $itemcodetrans,'trxtypecode'=>$trxtypecode, 'date'=>$date,'time'=>$time,'fromorg'=>$fromorg,'toorg'=>$toorg,'note'=>$note)); // Table name, column names and values, WHERE conditions
        $res = $db->getResult();
       return $res;

    }
    // update on hand qty for itemcode and newqty
    function updateonhand($itemcode,$newqty) {
        $this->itemcode = $itemcode;
        $this->newqty=$newqty;

        $db = new Database();
        $db->connect();
        $db->update('itemonhand',array('qty'=>$newqty),'itco='.$itemcode);
         $res = $db->getResult();
        return $res;
    }
    // update price for itemcode to deactivate all old price after add new price
    function updateprice($itemcode) {
        $newstat=0;
        $db = new Database();
        $db->connect();
        $db->update('itemprice',array('status'=>$newstat),' itemcprice='.$itemcode);
        $res = $db->getResult();
        return $res;
    }
// } end main function

//special function{

    // sum qty function on hand for selected itemcode and organization in and out
    public  function sumonorg($itemcode,$org){
        $this->itemcode=$itemcode;
        $this->org=$org;
        $db = new Database();
        $db->connect();

        $sum= $db->sumorg($itemcode,$org);
        return $sum;
    }
    // sum qty function on hand for selected itemcode in all organization
    public  function sumon($itemcode){
        $this->itemcode=$itemcode;

        $db = new Database();
        $db->connect();

        $sum= $db->sum($itemcode);
        return $sum;
    }
    // insert item image {item code}
    function insertimage($itemcode) {
        $this->itemcode = $itemcode;
        $db = new Database();
        $db->connect();

        $target_dir = "../img/product/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
             //   echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
           //     echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            $imagescr=basename( $_FILES["fileToUpload"]["name"]);
           // echo "Sorry, file already exists.";
            $uploadOk = 1;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
           // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
           // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $imagescr=basename( $_FILES["fileToUpload"]["name"]);
              //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $uploadOk = 1;
            } else {
              //  echo "Sorry, there was an error uploading your Image.";
                $uploadOk = 0;
            }
        }
        $userimg=basename( $_FILES["fileToUpload"]["name"]);

        //$db->update('item', array('itemimage' => $imagescr), 'itemcode=' . $itemcode);  // Table name, column names and respective values
       if($uploadOk==1){$db->update('item',array('itemimage' => $imagescr),'itemcode=' . $itemcode);}

        return $uploadOk;
    }


    function insertinvoice($selesmanid,$customer,$ordertype,$discountid,$taxes,$note,$endtotal) {

        $this->selesmanid = $selesmanid;
        $this->customer = $customer;
        $this->ordertype = $ordertype;
        $this->discountid = $discountid;
        $this->taxes = $taxes;
        $this->note = $note;
        $this->endtotal=$endtotal;

        $db = new Database();
        $db->connect();
        $t=time();
        $time=date("Y-m-d",$t);
        $db->insert('invoice', array('selesmanid' => $selesmanid, 'customeridtable' => $customer, 'ordertypeid' => $ordertype, 'discountid' => $discountid, 'taxid' => $taxes,'note' =>$note,'total' =>$endtotal,'Invoicedate' =>$time));  // Table name, column names and respective values
        $res = $db->getResult();
        return $res;
    }

    function addarrayofitem($invoiceid,$itemcode,$qty,$uofm,$offer) {

        $this->invoiceid = $invoiceid;
        $this->itemcode = $itemcode;
        $this->qty = $qty;
        $this->uofm = $uofm;
        $this->offer = $offer;


        $db = new Database();
        $db->connect();

        $db->insert('tableorderitem', array('invnumber' => $invoiceid, 'itemid' => $itemcode, 'qty' => $qty, 'uom' => $uofm, 'offerid' => $offer));  // Table name, column names and respective values
        $res = $db->getResult();
        return $res;
    }


    function addquta($invoiceid) {
        $status=0;
        $this->invoiceid = $invoiceid;

        $db = new Database();
        $db->connect();
        $t=time();
        $time=date("Y-m-d",$t);
        $db->insert('quotations', array('invoicenumber' => $invoiceid,'status' => $status,'dateoforder'=>$time));  // Table name, column names and respective values

    }

    function updateinvoice($invoiceid,$newstat){
        $this->invoiceid=$invoiceid;
        $this->newstat=$newstat;
        $db = new Database();
        $db->connect();
        $t=time();
        $time=date("Y-m-d",$t);
        $db->update('quotations',array('status'=>$newstat,'dateoforder'=>$time),'invoicenumber='.$invoiceid);
        $res = $db->getResult();
        return $res;
    }


}

// } end special function


/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 1:58 PM
 */

class emp
{


    function selectall($table,$rows,$join,$where,$order,$type){

        $this->table=$table;
        $this->rows=$rows;
        $this->join=$join;
        $this->where=$where;
        $this->order=$order;
        $this->table=$table;

        $db = new Database();
        $db->connect();
        $db->select($table,$rows,$join,$where,$order); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions

        if($type=='number'){
            $res = $db->numRows();
        }elseif($type=='data'){
            $res = $db->getResult();
        }
        return $res;
    }

}


/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 9:08 AM
 */
class customer
{
    public $username;
    public $fullname;
    public $customertype;
    public $company;
    public $phone;
    public $area;
    public $country;
    public $street;
    public $email;
    public $password;


    // insert customer { Item desc(name), Item Type, Item categurise , barcode, unit of Measre,item status,Add POS, Add Web } return Array
    function insertcustomer($username, $fullname, $customertype, $company, $phone, $area, $country,$street,$email,$password) {
        $this->username = $username;
        $this->fullname = $fullname;
        $this->customertype = $customertype;
        $this->company = $company;
        $this->phone = $phone;
        $this->area = $area;
        $this->country = $country;
        $this->street=$street;
        $this->email=$email;
        $this->password=$password;

        $db = new Database();
        $db->connect();

        $db->insert('customer', array('username' => $username, 'fullname' => $fullname, 'customertypeid' => $customertype, 'company' => $company, 'phone' => $phone,'areaid' =>$area,'country' => $country, 'street' => $street, 'email' => $email, 'password' => $password));  // Table name, column names and respective values
        $res = $db->getResult();
        return $res;
    }
    function insertarea($area) {
        $this->area = $area;


        $db = new Database();
        $db->connect();

        $db->insert('area', array('areadesc' => $area));
        $res = $db->getResult();
        return $res;
    }

    function inserttype($type) {
        $this->type = $type;

        $db = new Database();
        $db->connect();

        $db->insert('customertype', array('typedesc' => $type));
        $res = $db->getResult();
        return $res;
    }

    function insertordertype($type) {
        $this->type = $type;

        $db = new Database();
        $db->connect();

        $db->insert('ordertype', array('type' => $type));
        $res = $db->getResult();
        return $res;
    }

    function inserttypeofsales($type) {
        $this->type = $type;

        $db = new Database();
        $db->connect();

        $db->insert('Typeofsale', array('type' => $type));
        $res = $db->getResult();
        return $res;
    }

    // select all need {$table,$rows,$join=NULL,$where,$order,$type} from customer
    function selectall($table,$rows,$join,$where,$order,$type){

        $this->table=$table;
        $this->rows=$rows;
        $this->join=$join;
        $this->where=$where;
        $this->order=$order;
        $this->table=$table;

        $db = new Database();
        $db->connect();
        $db->select($table,$rows,$join,$where,$order); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions

        if($type=='number'){
            $res = $db->numRows();
        }elseif($type=='data'){
            $res = $db->getResult();
        }
        return $res;
    }




    // insert item { Item desc(name), Item Type, Item categurise , barcode, unit of Measre,item status,Add POS, Add Web } return Array
    function insertcustomerintable($customerid,$email,$phone,$typeid,$companyname,$areaid,$country,$street) {
        $this->customerid = $customerid;
        $this->email = $email;
        $this->phone = $phone;
        $this->typeid = $typeid;
        $this->companyname = $companyname;
        $this->areaid = $areaid;
        $this->country = $country;
        $this->street=$street;

        $db = new Database();
        $db->connect();

        $db->insert('cutomertableorder', array('customerid' => $customerid, 'email' => $email, 'phone' => $phone, 'typeid' => $typeid, 'companyname' => $companyname,'areaid' =>$areaid,'country' => $country, 'street' => $street));  // Table name, column names and respective values
        $res = $db->getResult();
        return $res;
    }




}