<?php  

// Xử lý số tiền đúng định dạng
function numberWithDots($x) {
	$x=(string) $x;
	$pattern = '/\B(?=(\d{3})+(?!\d))/';
    return preg_replace($pattern,".",$x); // \B not boundary \d{3} 3 digit /d 
}

?>