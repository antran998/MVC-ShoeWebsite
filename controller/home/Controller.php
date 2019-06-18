<?php
require_once('model/ProductModel.php');
$GLOBALS['db'] = new Database();
$GLOBALS['db']->connectDB();

class HomeController{
    public static function CreateView($viewName){
        // check login action
        if(isset($_POST['login'])){
            adminController::CheckLogin();
        }
        // check logout action
        if(isset($_POST['logout'])){
            adminController::LogOut();
        }
        // create id for guest
        if(!isset($_SESSION['id'])){
            $ranID="";
            $compareID="CreateVar";
            while($compareID!=""){
                $randNum = rand(1,9999);
                $ranID= "G".$randNum;
                $compareID=$GLOBALS['db']->GetSpecificRow("'".$ranID."'",'ID','account_info','ID');
            }            
            $_SESSION['id']=$ranID;
        }
        $_SESSION['voucher']='';
        if(strpos($_SESSION['id'], 'A') !== false){ // only for member who can use voucher
            $_SESSION['voucher']=$GLOBALS['db']->GetSpecificVoucher();
        }

        // load info of account to contact form
        if($viewName == "contact"){

            $_SESSION['email'] = $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'EMAIL','account_info','ID');

            $_SESSION['name'] = $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'FULL_NAME','account_info','ID');
        }          	  	   	
        
        // create view
        require_once('View/home/'.$viewName.'.php');
        $GLOBALS['db']->CloseConn();
    }

    // create view for paypal
    public static function CreatePaypalView($viewName){
        require_once('PaypalTest/'.$viewName.'.php');

        // insert to information to database if payment success
        if($viewName=='pay' && isset($_SESSION['paymentSuccess'])){

            ////////////////////
            $idExist = $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'ID','account_info','ID');
            // add guest information (first time)
            if($idExist==''){
                $idPaid = $_SESSION['pattern']->totalPrice - $_SESSION['pattern']->totalPrice*$_SESSION['pattern']->voucherPercent + $_SESSION['pattern']->shipFee;

                $GLOBALS['db']->GuestData($_SESSION['id'],$_SESSION['pattern']->fullname,$_SESSION['pattern']->email,$_SESSION['pattern']->address,$_SESSION['pattern']->phone,$idPaid);
            }
            else{ // update money paid for id that has already exist (even guest)
                $idPaid = $_SESSION['pattern']->totalPrice - $_SESSION['pattern']->totalPrice*$_SESSION['pattern']->voucherPercent + $_SESSION['pattern']->shipFee;

                $currentMoneyPaid= $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'MONEY_PAID','account_info','ID');

                $idPaid+=$currentMoneyPaid;

                $GLOBALS['db']->updateMoneyPaid((float) $idPaid,"'".$_SESSION['id']."'");
            }            
            $newVoucher=$_SESSION['voucher'];
            // add voucher
            if($_SESSION['pattern']->voucherPercent>0){
                $newVoucher = $_SESSION['voucher'].(string)($_SESSION['pattern']->voucherPercent*100);
                $GLOBALS['db']->UpdateVoucherStatus($_SESSION['voucher']);
                $GLOBALS['db']->UpdateVoucherID($_SESSION['voucher'],$newVoucher);
            }

            // add buying history    
            for ($j=0; $j < count($_SESSION['pattern']->list); $j++) {
                $GLOBALS['db']->BuyAction($_SESSION['id'],$_SESSION['pattern']->list[$j]->id,$_SESSION['pattern']->totalPrice,$_SESSION['pattern']->list[$j]->prices,$newVoucher,$_SESSION['pattern']->list[$j]->quantity,$_SESSION['pattern']->shipFee);
            }

            // create id for guest after bought things
            if(strpos($_SESSION['id'], 'G') !== false){
                unset($_SESSION['id']);
            }

            unset($_SESSION['pattern']);
            unset($_SESSION['paymentSuccess']);
            $_SESSION['confirmText']='Chúc mừng bạn đã thanh toán thành công';
            $GLOBALS['db']->CloseConn();
            header('location: mailcheck'); // success page
        }    
    }

    //receive and send request (ajax type)
    public static function SendDataAjax($pattern){
        $pattern = json_decode($pattern);

        // use this to add cart for paypal
        if(isset($pattern->list[0]->quantity)){
            $_SESSION['pattern']=$pattern;
        }

        // insert comment for item
        if(isset($pattern->mess)){
            $GLOBALS['db']->insertMess($_SESSION['id'],$pattern->mess,$pattern->star,$pattern->idItem);
            $GLOBALS['db']->CloseConn();
        }
        
        // send contact mail from guest to admin 
        if(isset($pattern->contactMess)){
            $title = $pattern->usernameContact;
            $content = $pattern->contactMess." ";
            $header = $pattern->email;
            mail("baoan11111@gmail.com",$title,$content,$header);
        }
    }

    // Search item for shop page
    public static function SendSearch($regexPatt){
        $itemsContainer = array();
        $GLOBALS['db']->SearchResult($regexPatt,$itemsContainer,'items','NAME');
        echo json_encode($itemsContainer);

        $GLOBALS['db']->CloseConn();
    }


}


?>