<?php
class Database {
    private $hostname='localhost';
    private $username='root';
    private $password='';
    private $dbname='ql_giay';

    private $conn=NULL;
    private $result=NULL;

    public function connectDB(){
        $this->conn= new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
        if(!$this->conn){
            echo 'Connect Failed';
            exit();
        }
        else{
            mysqli_set_charset($this->conn,'utf8');
        }
        return $this->conn;
    }

    //Truy xuất bất kì bảng nào với một giá trị cột
    public function GetSpecificRow($rowValue,$columnName,$tableName,$columnValue){
        $sql = "SELECT * FROM ".$tableName." WHERE ".$columnValue."=".$rowValue;
        $this->result=$this->conn->query($sql);
        
        // Xuất data.
        $row = $this->result->fetch_assoc();        
        return $row[$columnName];
    }

    public function GetSpecificVoucher(){
        $sql = "SELECT * FROM voucher WHERE STATUS = 'OK' ORDER BY ID_VOUCHER";
        $this->result=$this->conn->query($sql);
        
        // Xuất data.
        $row = $this->result->fetch_assoc();        
        return $row['ID_VOUCHER'];
    }

    //Đóng connection
    public function CloseConn(){
        $this->conn->close();
    }

    //Đếm giá trị
    public function getSize($columnName,$tableName){
        $sql = "SELECT COUNT(".$columnName.") FROM ".$tableName;
        $this->result=$this->conn->query($sql);
        
        // Xuất data.
        $row = $this->result->fetch_row();        
        return $row[0];        
    }

    //Lấy các sản phẩm sắp xếp theo thứ tự
    public function getMultiItemInRank($amount,$tableName,$columnName,$status,array &$valueContainer,$columnGet){
        $sql = "SELECT * FROM ".$tableName." ORDER BY ".$columnName." ".$status." LIMIT ".$amount;
        $this->result=$this->conn->query($sql);

        $count=0;

        // Xuất data.
        while($row = $this->result->fetch_assoc()) {
            $valueContainer[$count] = $row[$columnGet];
            $count++;
        }        
    }

    //Đếm số lượng
    public function SumQuantity($columnName1,$columnName2,$tableName,$groupColumn,$amount,array &$valueContainer){
        $sql = "SELECT SUM(".$columnName2."),".$columnName2." FROM ".$tableName." GROUP BY ".$groupColumn." LIMIT ".$amount;
        $this->result=$this->conn->query($sql);

        $count=0;

        //Xuất data
        while($row = $this->result->fetch_assoc()) {
            $valueContainer[$count] = $row[$columnName2];
            $count++;
        }
    }

    public function updateMoneyPaid($ValueSet,$idCon){
        $sql = "UPDATE account_info SET MONEY_PAID = ".$ValueSet." WHERE ID = ".$idCon;
        $this->conn->query($sql);
    }

    // Tìm kiếm mặt hàng
    public function SearchResult($pattern,array &$valueContainer,$tableName,$columnCondition){

        $sql = "SELECT * FROM ".$tableName." WHERE ".$columnCondition." regexp '".$pattern."'";
        $this->result=$this->conn->query($sql);

        $count=0;

        //Xuất data
        while($row = $this->result->fetch_assoc()) {

            $itemsInfor=[
                'idProduct' => $row['ID_ITEM'],
                'nameProduct' => $row['NAME'],
                'price' => $row['PRICE'],
                'discountPrice' => $row['DISCOUNT_PRICE'],
                'imgItem' => $row['IMG_ITEM']
            ];

            $valueContainer[$count] = $itemsInfor;
            $count++;
        }

    }

    public function BuyAction($ID,$ID_ITEM,$TOTAL_PRICE,$SINGLE_PRICE,$VOUCHER,$QUANTITY,$SHIPFEE){
        // $sql = "INSERT INTO buying_history VALUES (null,'".$ID."',".$ID_ITEM.",".$TOTAL_PRICE.",".$SINGLE_PRICE.",NOW(),'".$VOUCHER."',".$QUANTITY.",".$SHIPFEE.")";
        $sql = "INSERT INTO buying_history VALUES (null,'$ID','$ID_ITEM','$TOTAL_PRICE','$SINGLE_PRICE',NOW(),'$VOUCHER','$QUANTITY','$SHIPFEE')";
        $this->conn->query($sql);
    }

    public function GuestData($ID,$FULLNAME,$EMAIL,$ADDRESS,$PHONE,$MONEYPAID){
        $sql = "INSERT INTO account_info VALUES ('$ID','$FULLNAME','$EMAIL','$ADDRESS','$PHONE','$MONEYPAID')";
        $this->conn->query($sql);
    }



    ///////////////////////////////////Tạo tài khoản người dùng
    public function insertAccount($id,$username,$password,$name,$email,$address,$phoneNum){
        $sql = "INSERT INTO account_info VALUES ('$id','$name','$email','$address','$phoneNum',0)";
        $this->conn->query($sql);

        $sql= "INSERT INTO account VALUES ('$id','$username','$password',now())";
        $this->conn->query($sql);
    }

    public function GetResult(){
        return $this->result;
    }

    //new
    public function ReturnLoginAccount($username,$password){
        $sql="SELECT * FROM account WHERE USERNAME='$username' AND PASSWORD ='$password'";
        $this->result=$this->conn->query($sql);
        
        $num_rows=mysqli_num_rows($this->result);
        if($num_rows==0){
            return false;
        }
        else
            return true;
    }

    //return list value from specific table
    public function ReturnListValue($tableName){
        $sql = "SELECT * FROM ".$tableName;
        return $this->result=$this->conn->query($sql);      
    }

    //new
    public function InsertItem($id,$name,$price,$disprice,$img){
        $sql= "INSERT INTO items VALUES ('$id','$name','$price','$disprice','$img')";
        $this->conn->query($sql);
    }
    public function DeleteItem($id){
        $sql="DELETE FROM items WHERE ID_ITEM='$id'";
        $this->conn->query($sql);
    }
   
    public function UpdateItem($idUpdate,$name,$price,$disprice,$img){
        // $sql="UPDATE items SET NAME='$name',PRICE='$price',DISCOUNT_PRICE='$disprice'";
        // if($img=="img/"){
        //     $sql+=", IMG_ITEM='$img'";
        // }
        // $sql+=" WHERE ID_ITEM='$idUpdate'";
        $sql="UPDATE items SET NAME='$name',PRICE='$price',DISCOUNT_PRICE='$disprice', IMG_ITEM='$img' WHERE ID_ITEM='$idUpdate'";
        $this->conn->query($sql);
    }

    public function updateAccountInfo($id,$fullname,$email,$address,$phone){
        $sql="UPDATE account_info SET FULL_NAME='$fullname',EMAIL='$email',ADDRESS='$address',PHONE='$phone' WHERE ID='$id'";
        $this->conn->query($sql);
    }
    public function updateAccount($id,$password){
        $sql="UPDATE account SET PASSWORD='$password' WHERE ID='$id'";
        $this->conn->query($sql);
    }

    public function insertMess($id,$mess,$star,$idItem){
        $sql = "INSERT INTO cus_review VALUES (null,'$id','$idItem','$mess',now(),'$star')";
        $this->conn->query($sql);
    }

    public function UpdateVoucherStatus($voucher){
        $sql = "UPDATE voucher SET STATUS ='X' WHERE ID_VOUCHER='$voucher'";
        $this->conn->query($sql);
    }

    public function UpdateVoucherID($voucher,$newVoucher){
        $sql = "UPDATE voucher SET ID_VOUCHER ='$newVoucher' WHERE ID_VOUCHER='$voucher'";
        $this->conn->query($sql);
    }

    // lấy dữ liệu comment
    public function GetComment($idItem,array &$valueContainer){
        $sql = "SELECT * FROM cus_review WHERE ID_ITEM = '$idItem' ORDER BY DATE_POST DESC";
        $this->result=$this->conn->query($sql);

        $count=0;

        //Xuất data
        while($row = $this->result->fetch_assoc()) {

            $commentInfor=[
                'id' => $row['ID'],
                'star' => $row['STAR'],
                'content' => $row['CONTENT'],
                'datePost' => $row['DATE_POST']
            ];

            $valueContainer[$count] = $commentInfor;
            $count++;
        } 
    }

    public function LuckyCircleCondition($id){
        $sql = "SELECT count(*) FROM buying_history WHERE VOUCHER <> '' AND ID = '$id' ORDER BY ID";
        $this->result=$this->conn->query($sql);

        // Xuất data.
        $row = $this->result->fetch_row();        
        return $row[0];
    }

}


?>