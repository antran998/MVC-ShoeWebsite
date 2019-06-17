<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap Simple Success Confirmation Popup</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="lib/css/mail.css">
	</head>
	<body onload="loadConfirmText();">
		<div class="text-center">
			<!-- Button HTML (to Trigger Modal) -->
			<a href="#myModal" id="alertsuccess" class="trigger-btn" data-toggle="modal"></a>
		</div>

		<!-- Modal HTML -->
		<div id="myModal" class="modal fade">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content">
					<div class="modal-header">
						<div class="icon-box">
							<i class="material-icons">&#xE876;</i>
						</div>				
						<h4 class="modal-title">Success!</h4>	
					</div>
					<div class="modal-body">
						<p class="text-center" id="confirmText"><?php if(isset($_SESSION['confirmText'])){echo $_SESSION['confirmText']; unset($_SESSION['confirmText']);} ?></p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="lib/js/mailalert.js"></script>     
	</body>
</html>                                                        