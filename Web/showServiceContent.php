<?php
	require "conf.inc.php";
	require "function.php";

	if(!empty($_GET["service"])){
		$db = connectDb();
		$query = $db->prepare("SELECT * FROM `SERVICE_CONTENT` WHERE idService=?");
		$query->execute(array($_GET["service"]));
		$res = $query->fetchAll(PDO::FETCH_ASSOC);

		$query2 = $db->prepare("SELECT nameService FROM `SERVICES` WHERE idService=?");
		$query2->execute(array($_GET["service"]));
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

		if(!empty($res) && !empty($res2) ){
			$y=0;
			echo "<h2> Choissisez votre ".utf8_encode($res2[0]["nameService"])." </h2>";
			foreach ($res as $key => $value) {
	             	 echo "<button onclick='clicked(\"".utf8_encode($value['nameServiceContent'])."\",".$value['idServiceContent'].")' value='".$value['idServiceContent']."' class='pc btn btn-primary' aria-pressed='true'>".utf8_encode($value['nameServiceContent'])."</button>";
          	}


          	switch (utf8_encode($res2[0]["nameService"])) {
				case 'Matériel informatique':
					?>
			        <div id='carac' >
				        <ul>
				          <li><a href="https://www.microsoft.com/fr-fr/store/d/surface-pro/8nkt9wttrbjk?activetab=pivot:techspecstab" target="_blank">Lien vers le site officiel</a></li>
				        </ul>
				    </div>

			        <?php
					break;
			}

        }else 
			echo "Choissisez quelque chose";
	}else{
		//header("Location: index.php");
	}	
