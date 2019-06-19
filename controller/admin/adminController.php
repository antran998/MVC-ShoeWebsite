<?php
require_once('model/ProductModel.php');
$GLOBALS['db'] = new Database();
$GLOBALS['db']->connectDB();
class adminController{
    public static function CreateView($viewName){

        if(isset($_POST['logout'])){
            adminController::LogOut();
        }

        // create random ID for account
        if($viewName=="addUser"){
            $ranID="";
            $compareID="CreateVar";
            while($compareID!=""){
                $randNum = rand(1,9999);
                $ranID= "A".$randNum;
                $compareID=$GLOBALS['db']->GetSpecificRow("'".$ranID."'",'ID','account_info','ID');
            }
            $_SESSION['tempid']=$ranID;
        }
        
        // Create view
        require_once('View/admin/'.$viewName.'.php');
        $GLOBALS['db']->CloseConn();
    }

    // search bar for admin to CRUD account or item
    public static function GetSearchString($tmp){
        $_SESSION['searchString']=$tmp;
    }
    
    // check if login are correct
    public static function CheckLogin(){
        if(isset($_POST['login'])){
            $usernameLogin = $_POST['usernameLogin'];
            $passwordLogin = $_POST['passwordLogin'];
            
            if($usernameLogin==''||$passwordLogin==''){
                echo 'Vui lòng nhập tên tài khoản hoặc mật khẩu';
            }else{
                $usernameLogin = strip_tags($usernameLogin); // prevent sql injection
                $usernameLogin = addslashes($usernameLogin); // prevent sql injection
                $passwordLogin = strip_tags($passwordLogin); // prevent sql injection
                $passwordLogin = addslashes($passwordLogin); // prevent sql injection
                $check=$GLOBALS['db']->ReturnLoginAccount($usernameLogin,$passwordLogin);
                if($check==true){
                    while($data = mysqli_fetch_assoc($GLOBALS['db']->GetResult())){
                        $_SESSION['id']=$data['ID'];
                        $_SESSION['username']=$data['USERNAME'];
                    }

                }else{
                    $_SESSION['check']='0';
                    header('Location: addUser');
                }
            }
        }
    }

    public static function LogOut(){
        if(isset($_POST['logout'])){
            session_destroy();
            header('Location: home');
        }
    }

    public static function RemoveItem($index){
            $GLOBALS['db']->DeleteItem($index);        
    }

    public static function RemoveAccount($index){
        $GLOBALS['db']->deleteAccountById($index);
    }

    public static function SendData($pattern){
        $pattern=json_decode($pattern);
       // Insert Item 
        if(isset($pattern->idInsert)){
            $idInsert= $pattern->idInsert;
            $nameInsert= $pattern->nameInsert;
            $priceInsert= $pattern->priceInsert;
            $dispriceInsert= $pattern->dispriceInsert;
            $imgUrl=$pattern->imgUrl;
            
            // $GLOBALS['db']->InsertItem($idInsert,$nameInsert,$priceInsert,$dispriceInsert,$imgUrl);
            // $GLOBALS['db']->CloseConn();
            $checkID=$GLOBALS['db']->CheckExistIDItem($idInsert);
            if($checkID==true){
                $GLOBALS['db']->InsertItem($idInsert,$nameInsert,$priceInsert,$dispriceInsert,$imgUrl);
                $GLOBALS['db']->CloseConn();
                echo 1;
            }else{
                echo 0;
            }
        }else
        if(isset($pattern->idEdit)){ // Edit Item
            $idEdit=$pattern->idEdit;
            $nameEdit=$pattern->nameEdit;
            $priceEdit=$pattern->priceEdit;
            $dispriceEdit=$pattern->dispriceEdit;
            $imgUrlEdit=$pattern->imgUrlEdit;
            $idUpdate=$pattern->idRemmemberEdit;
            $GLOBALS['db']->UpdateItem($idUpdate,$nameEdit,$priceEdit,$dispriceEdit,$imgUrlEdit);
            $GLOBALS['db']->CloseConn();
        }else
        if(isset($pattern->idInsertAcc)){ // Add account
            $idInsertAcc=$pattern->idInsertAcc;
            $username=$pattern->username;
            $fullname=$pattern->fullname;
            $address=$pattern->address;
            $email=$pattern->email;
            $phone=$pattern->phone;
            $password=$pattern->password;
            // $GLOBALS['db']->insertAccount($idInsertAcc,$username,$password,$fullname,$email,$address,$phone);
            // $GLOBALS['db']->CloseConn();
            $check=$GLOBALS['db']->CheckExistUsername($username);
            $IDcheck=$GLOBALS['db']->GetSpecificRow("'".$idInsertAcc."'",'ID','account','ID');
            
            if($check==true && $IDcheck==NULL){
                $GLOBALS['db']->insertAccount($idInsertAcc,$username,$password,$fullname,$email,$address,$phone);
                $GLOBALS['db']->CloseConn();
                echo 1;
            }else{
                if($check!=true){
                    echo 0;
                }
                if($IDcheck!=NULL){
                    echo 2;
                }                
            }
        }else
        if(isset($pattern->usernameRegistry)){ // sign up an account
            $usernameRegistry=$pattern->usernameRegistry;
            $passwordRegistry=$pattern->passwordRegistry;
            $fullnameRegistry=$pattern->fullnameRegistry;
            $emailRegistry=$pattern->emailRegistry;
            $addressRegistry=$pattern->addressRegistry;
            $phoneRegistry=$pattern->phoneRegistry;

            // $GLOBALS['db']->insertAccount($_SESSION['tempid'],$usernameRegistry,$passwordRegistry,$fullnameRegistry,$emailRegistry,$addressRegistry,$phoneRegistry);
            // $GLOBALS['db']->CloseConn();
            $check=$GLOBALS['db']->CheckExistUsername($usernameRegistry);
            if($check==true){
            $GLOBALS['db']->insertAccount($_SESSION['tempid'],$usernameRegistry,$passwordRegistry,$fullnameRegistry,$emailRegistry,$addressRegistry,$phoneRegistry);
            $GLOBALS['db']->CloseConn();
            echo 1;
            }else{
                echo 0;
            }
        }else
        if(isset($pattern->idEditAcc)){ // Edit Account (admin)
            $idEditAcc=$pattern->idEditAcc;
            $fullnameEditAcc=$pattern->fullnameEditAcc;
            $emailEditAcc=$pattern->emailEditAcc;
            $addressEditAcc=$pattern->addressEditAcc;
            $phoneEditAcc=$pattern->phoneEditAcc;
            $GLOBALS['db']->updateAccountInfo($idEditAcc,$fullnameEditAcc,$emailEditAcc,$addressEditAcc,$phoneEditAcc);
            $GLOBALS['db']->CloseConn();
        }else
        if(isset($pattern->idUpdateAcc)){ // Edit Account (customer)
            $idUpdateAcc=$pattern->idUpdateAcc;
            $nameUpdateAcc=$pattern->nameUpdateAcc;
            $emailUpdateAcc=$pattern->emailUpdateAcc;
            $addressUpdateAcc=$pattern->addressUpdateAcc;
            $phoneUpdateAcc=$pattern->phoneUpdateAcc;
            $passwordUpdateAcc=$pattern->passwordUpdateAcc;
            $GLOBALS['db']->updateAccountInfo($idUpdateAcc,$nameUpdateAcc,$emailUpdateAcc,$addressUpdateAcc,$phoneUpdateAcc);
            if($passwordUpdateAcc!=''){
                $GLOBALS['db']->updateAccount($idUpdateAcc,$passwordUpdateAcc);
            }
            $GLOBALS['db']->CloseConn();
            header('Location: shop');
        }
        if(isset($pattern->phoneExist)){ // Remeber guest by phone
            $idExist = $GLOBALS['db']->GetSpecificRow($pattern->phoneExist,'ID','account_info','PHONE');
            if(strpos($idExist, 'A') !== false){
                $usernameExist = $GLOBALS['db']->GetSpecificRow("'".$idExist."'",'USERNAME','account','ID');
                echo $usernameExist;
            }
            else{
                $nameExist = $GLOBALS['db']->GetSpecificRow($pattern->phoneExist,'FULL_NAME','account_info','PHONE');
                if($nameExist!=null){
                    echo $nameExist;
                    $_SESSION['id']=$idExist;
                }                                
            }
            $GLOBALS['db']->CloseConn();
        }
        if(isset($pattern->resetEmail)){ // Send email and receive password
            $returnIDCheckByMail=$GLOBALS['db']->ReturnRegistryEmail($pattern->resetEmail);
            $currentPassword=$GLOBALS['db']->ReturnRegistryPassworByUsername($pattern->usernameReset,$returnIDCheckByMail);
            if($currentPassword!=NULL){
                    $message = "Mật khẩu của bạn là :".$currentPassword;
                    mail($pattern->resetEmail,"ResetPassword",$message,"From SneakerBoy");
                    echo 1;
            }else{
                echo 0;
                
            }
            $GLOBALS['db']->CloseConn();
        }
        
        
        
    }
}
?>