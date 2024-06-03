<?php

//fetch_data.php

include 'conexao_db.php';

if(isset($_POST["action"]))
{
 $query = "
  SELECT tag_id FROM  tb_pergunta 
 ";
 if(isset($_POST["tag_id"], $_POST["tag_id"]))
 {
  $query .= "
   AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
  ";
 }

 /*if(isset($_POST["brand"]))
 {
  $brand_filter = implode("','", $_POST["brand"]);
  $query .= "
   AND product_brand IN('".$brand_filter."')
  ";
 }
 if(isset($_POST["ram"]))
 {
  $ram_filter = implode("','", $_POST["ram"]);
  $query .= "
   AND product_ram IN('".$ram_filter."')
  ";
 }
 if(isset($_POST["storage"]))
 {
  $storage_filter = implode("','", $_POST["storage"]);
  $query .= "
   AND product_storage IN('".$storage_filter."')
  ";
 }
*/
$statement = $conecta->prepare($query);
$statement->execute();
$result = $statement->get_result();
$perguntas = $result->fetch_all(MYSQLI_ASSOC);
$total_row = $result->num_rows;
$output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
     
     <p align="center"><strong><a href="#">'. $row['tag_id'] .'</a></strong></p>
    
    </div>

   </div>
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}

?>
