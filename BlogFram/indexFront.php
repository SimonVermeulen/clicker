<?php
$arrayTest = [];
$arrayTest2 = [];

if(!isset($value))
{
  $value = 0;
}

if(isset($clicPCDefault) && isset($clicPSDefault))
{
	array_push($arrayTest, $clicPCDefault->jsonString());	
  
  	foreach ($clicPSDefault as $PSDefault) {
		array_push($arrayTest2, $PSDefault->jsonString());	
    }
}

if(isset($clicPCUser) && isset($clicPSUser))
{
  array_push($arrayTest, $clicPCUser->jsonString());
  
  foreach ($clicPSUser as $PSUser) {
  		array_push($arrayTest2, $PSUser->jsonString());
  }
}

if(isset($clicPSSession) && isset($clicPCSession))
{
  foreach ($clicPSSession as $PSEntity) {
  		array_push($arrayTest2, $PSEntity->jsonString());
  }
  
  array_push($arrayTest, $clicPCSession->jsonString());
}

?>

<div id="indexFront">
  <img onclick="counter.incrementClic()" id="phone" class="flexFront" src="/../images/Iphone-vide.png" alt="Cliquez-ici">
  <div id="data"></div>
  <div id="midZone" class="flexFront">
    <div id="clickCounter">0</div>
    <div id="errors"></div>
    <div id="sentence">Cliquer sans jamais s'arrêter</div>
  </div>
  
  <div id="upgradeEmplacement" class="flexFront"></div>
</div>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>var test = <?php echo json_encode($arrayTest); ?>; var test2 = <?php echo json_encode($arrayTest2); ?>; var test3 = <?php echo $value; ?>;</script>
<script src="/../js/clickerDefault.js"></script>
<script src="/../js/clicPS.js"></script>
<script src="/../js/counter.js"></script>
<script src="/../js/index.js"></script>
