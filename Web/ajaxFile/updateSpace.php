<?php
session_start();
require "../function.php";
require "../object/spaces.php";


if(isAdmin() || isSuperAdmin()){
  if( count($_POST)==3 && isset($_POST["idSpace"]) && isset( $_POST["newNameSpace"])  && isset( $_POST["newIsDeletedSpace"]) ){
    $db=connectDb();
    $space = new Space(null);

    echo $_POST["newIsDeletedSpace"];

    $error = false;
    $listOfErrors = [];
    if($space->IsDeleted(  ($_POST["newIsDeletedSpace"]== "true"?1:0)   ) ){
      echo ($_POST["newIsDeletedSpace"]?1:0);
    }

    if($space->NameOfSpace($_POST["newNameSpace"])){
      echo "yes";
    }

    if($error){
      $_SESSION["errorSpaceForm"] = $space->listOfErrors;
      print_r($_SESSION["errorSpaceForm"]);
    }else{
      $spaceMng = new SpaceMng($db);
      $spaceMng->updateSpace($_POST["idSpace"],$space);
    }

  }


  /* echo $_POST["spaceId"];
   echo $_POST["spaceName"];
   echo 'L\'espace a été ajouté';*/

}else{
  echo "Vous n'êtes pas autorisé à accéder à cette page.";
}
