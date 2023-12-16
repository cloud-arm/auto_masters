<?php 
include('../connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM customer WHERE  sync_id = '' ORDER BY id ASC LIMIT 1");
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){  


    $data="id=1&";
    $data.="key=1&";
    $data.="cus_id=".$row['id']."&";
    $data.="name=".$row['customer_name']."&";
    $data.="address=".$row['address']."&";
    $data.="phone_no=".substr($row['contact'],-9)."&";
    $data.="email=".$row['email']."&";
    $data.="nic=".$row['nic']."&";
    $data.="birthday=".$row['birthday']."&";
    $data.="gender=&";





$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.colorbiz.org/auto_dimension/sync/customer.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response.'<br>';

$rs=json_decode($response, true);
$action=$rs[0]['action'];

if($action=='save'){
    $sql = 'UPDATE  customer SET arm_id =?, sync_id=? WHERE  id=? ';
    $ql = $db->prepare($sql);
    $ql->execute(array($rs[0]['arm_id'],$rs[0]['arm_id'],0));
}



echo $rs[0]['action'];
}

?>