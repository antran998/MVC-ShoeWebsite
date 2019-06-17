<?php
require_once('model/ProductModel.php');
$GLOBALS['db'] = new Database();
$GLOBALS['db']->connectDB();

class HomeController{
    // Load trang
    public static function CreateView($viewName){
        if(isset($_POST['login'])){
            adminController::CheckLogin();
        }
        if(isset($_POST['logout'])){
            adminController::LogOut();
        }
        // tạo ra id Guest khách vãng lai
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
        if(strpos($_SESSION['id'], 'A') !== false){
            $_SESSION['voucher']=$GLOBALS['db']->GetSpecificVoucher();
        }


        if($viewName == "contact"){

            $_SESSION['email'] = $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'EMAIL','account_info','ID');

            $_SESSION['name'] = $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'FULL_NAME','account_info','ID');
        }          	  	   	
        
        // Tạo giao diện
        require_once('View/home/'.$viewName.'.php');
        $GLOBALS['db']->CloseConn();
    }

    public static function CreatePaypalView($viewName){
        require_once('PaypalTest/'.$viewName.'.php');  
        if($viewName=='pay' && isset($_SESSION['paymentSuccess'])){

            ////////////////////
            $idExist = $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'ID','account_info','ID');
            // thêm khách vãng lai 
            if($idExist==''){
                $idPaid = $_SESSION['pattern']->totalPrice - $_SESSION['pattern']->totalPrice*$_SESSION['pattern']->voucherPercent + $_SESSION['pattern']->shipFee;

                $GLOBALS['db']->GuestData($_SESSION['id'],$_SESSION['pattern']->fullname,$_SESSION['pattern']->email,$_SESSION['pattern']->address,$_SESSION['pattern']->phone,$idPaid);
            }
            // cộng tiền cho account có sẵn
            // if(strpos($_SESSION['id'], 'A') !== false){
            else{
                $idPaid = $_SESSION['pattern']->totalPrice - $_SESSION['pattern']->totalPrice*$_SESSION['pattern']->voucherPercent + $_SESSION['pattern']->shipFee;

                $currentMoneyPaid= $GLOBALS['db']->GetSpecificRow("'".$_SESSION['id']."'",'MONEY_PAID','account_info','ID');

                $idPaid+=$currentMoneyPaid;

                $GLOBALS['db']->updateMoneyPaid((float) $idPaid,"'".$_SESSION['id']."'");
            }            
            $newVoucher=$_SESSION['voucher'];
            // Thêm voucher
            if($_SESSION['pattern']->voucherPercent>0){
                $newVoucher = $_SESSION['voucher'].(string)($_SESSION['pattern']->voucherPercent*100);
                $GLOBALS['db']->UpdateVoucherStatus($_SESSION['voucher']);
                $GLOBALS['db']->UpdateVoucherID($_SESSION['voucher'],$newVoucher);
            }

            // thêm lịch sử mua hàng     
            for ($j=0; $j < count($_SESSION['pattern']->list); $j++) {
                $GLOBALS['db']->BuyAction($_SESSION['id'],$_SESSION['pattern']->list[$j]->id,$_SESSION['pattern']->totalPrice,$_SESSION['pattern']->list[$j]->prices,$newVoucher,$_SESSION['pattern']->list[$j]->quantity,$_SESSION['pattern']->shipFee);
            }

            if(strpos($_SESSION['id'], 'G') !== false){
                unset($_SESSION['id']);
            }

            unset($_SESSION['pattern']);
            unset($_SESSION['paymentSuccess']);
            $_SESSION['confirmText']='Chúc mừng bạn đã thanh toán thành công';
            $GLOBALS['db']->CloseConn();
            header('location: mailcheck');
        }    
    }

    //Nhận và gửi lại request tìm kiếm
    public static function SendDataAjax($pattern){
        $pattern = json_decode($pattern);

        if(isset($pattern->list[0]->quantity)){
            $_SESSION['pattern']=$pattern;
        }

        if(isset($pattern->mess)){
            $GLOBALS['db']->insertMess($_SESSION['id'],$pattern->mess,$pattern->star,$pattern->idItem);
            $GLOBALS['db']->CloseConn();
        }
        
        if(isset($pattern->contactMess)){
            $title = $pattern->usernameContact;
            $content = $pattern->contactMess." ";
            $header = $pattern->email;
            mail("baoan11111@gmail.com",$title,$content,$header);
        }
    }


    public static function SendSearch($regexPatt){
        $itemsContainer = array();
        $GLOBALS['db']->SearchResult($regexPatt,$itemsContainer,'items','NAME');
        echo json_encode($itemsContainer);

        $GLOBALS['db']->CloseConn();
    }


}


?>