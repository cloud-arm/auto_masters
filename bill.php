<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='job_add.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
	  
	<?php $invo=$_GET['id'];
	$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
	$result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
		$name=$row['customer_name'];
		$phone="";
	 } 
	?>
	  
	  
	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-5">
           <h3>Auto Masters</h3>
	  <h5>No.96/B Galwadugoda, Galle<br>
		  <b>Invoice no.<?php echo $_GET['id']; ?> </b><br>
	<b>Call: 071-2 574 574   091-729 42 45</b><br>	
		  Date:<?php date_default_timezone_set("Asia/Colombo"); 
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?>

<br><br>
	Invoice for: <?php echo $name; ?><br>
	<?php echo $phone; ?>
			</h5>
	  
        </div>
        <!-- /.col -->
		  
		  		  <div class="col-xs-3">
          <h3>
		  <?php if ($co=="qt"){
		echo $_GET['type'];;
	} 
		  if ($co>0){
		 
			  echo "Final Bill";
				
			  }  if ($co=="ds"){
		 
			  echo "Final Bill";
			   } 
			  
			  
					$tot_amount=0;
				$result = $db->prepare("SELECT sum(dic) FROM sales_list WHERE   invoice_no='$invo'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$dis_tot=$row['sum(dic)'];
				}
			  
			   
			  ?>
			  </h3>
      </div>
		  
		  
        <div class="col-xs-4">
          <small class="pull-right"><img src="img/logo2.PNG" width="170" alt="">
        <h5>
		  <?php if ($co=="qt"){
		 $invo=$_GET['id'];	
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$mechanic_id=$row['mechanic'];
				echo "<b>Vehicle No: </b>".$row['vehicle_no'];
					echo "<br>";
					echo "<b>Customer Name: </b>".$row['customer_name'];
					echo "<br>";
					echo "<b>Model: </b>".$row['model'];
					echo "<br>";
					echo "<b>Note: </b>".$row['comment'];
					echo "<br>";
					
					
				}
	} 
		  if ($co>0){
		 
			   $invo=$_GET['id'];	
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$mechanic_id=$row['mechanic_id'];
					
					$kmm=$row['km'];
					$kmplus=2000;
					if($kmm<1800){$kmplus=1400;}
					if($kmm<580){$kmplus=1100;}
					
					
					
					
					
				echo "<b>Vehicle No: </b>".$row['vehicle_no'];
					echo "<br>";
					echo "<b>Mileage: </b>".$kmm=$row['km']."Km";
					echo "<br>";
					echo "<b>Next service: </b>".$kmt=$kmm+$kmplus ."Km";
					echo "<br>";
					
				}
			  $result = $db->prepare("SELECT * FROM mechanic WHERE   id='$mechanic_id'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo "<b>Mechanic: </b>".$row['name'];
					echo "<br></h6></b>";
				}
			  
			  }  if ($co=="ds"){
		 
			   $invo=$_GET['id'];	
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					echo "<b>Vehicle No: </b>".$row['vehicle_no'];
					
				echo "<br><b>Model: </b>".$row['model'];
					echo "<br></h6></b>";
				}
			   } ?>
			</h5></small>
			 </div>
        <!-- /.col -->
</div>
  
<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ID</th>
				<th>Decs</th>
				<th>Type</th>
					<th>Unit Price</th>
                  <th>Qty</th>
                  <?php
					if($dis_tot>0){
					?>
					<th>Disc</th>
					<?php } ?>
                  <th>Amount </th>
                </tr>
                </thead>
                <tbody>
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					$tot_amount=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                <tr>
				<td><?php echo $row['code'];?></td>
                  <td><?php echo $row['name'];?></td>
				  <td><?php echo  $row['type'] ?></td>
					<td><?php echo $u_pri;?></td>
				  <td><?php echo $row['qty'];?></td>
                  <?php
					if($dis_tot>0){
					?>
					<td><?php echo $row['dic'];?></td>
					<?php } ?>
                  <td>Rs.<?php echo $row['price'];?></td>
					<?php $tot_amount+= $row['price'];?>
                  <?php } ?>
                 </tr>
					<tr>
					<td></td><td></td><td></td><td>Total: </td>
						<?php
					if($dis_tot>0){
					?>
					<td>Rs.<?php echo $dis_tot;?></td>
					<?php } ?>
						
						<td>Rs.<?php echo $tot_amount;?></td>
					</tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
	<?php
				$result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'  ");		
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$tot_amount=$row1['amount'];
					$balance=$row1['balance'];
					$bill_dis = $row1['dis'];
					$bill_total = $row1['amount'];
				}
			?>  
	<div class="col-xs-6">
         
          <div class="table-responsive">
            <table class="table">
			<tr>
                <th>Amount</th>
                <td>Rs.<?php echo number_format($bill_total,2); ?></td>
              </tr>
			  <?php if($bill_dis > 1){ ?>
				<tr>
                <th>Bill Discount</th>
                <td>Rs.<?php echo number_format($bill_dis,2); ?></td>
              </tr>
			  <?php } ?>
			  <?php if($dis_tot>0){ ?>
				<tr>
                <th>Item Discount</th>
                <td>Rs.<?php echo number_format($dis_tot,2); ?></td>
              </tr>
			  <?php } ?>
				
			  <tr>
                <th>Pay Amount</th>
                <td>Rs.<?php echo number_format($bill_total+$balance,2); ?></td>
              </tr>
              <tr>
                <th>Balance:</th>
                <td>Rs.<?php echo $balance; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-xs-2"><br><br><br><br> ______________ <br>Cashier</div>
        <div class="col-xs-2"><br><br><br><br> ______________ <br>Customer</div>
        <div class="col-xs-2"><br><br>
            <small class="pull-right"><img src="img/cloud arm 2.png" width="50" alt=""> <br> <b style="font-size:8px">CLOUD ARM</b></small>
        </div>
	
            </div><br><br><br><br>
	 
	
        </div>
       
            
           
           
	 
  </section>
</div>
</body>
</html>