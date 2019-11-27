<?php
require_once 'CompanyOperations.php';

    $createObject=new CompanyOperations();
    $finalres=array();

    $response=$createObject->getFoundItems();

    foreach ($response as $row){
        array_push($finalres,array('reg_number'=>$row['registration_number'],'finder_contact'=>$row['finder_contact']));

    }

echo json_encode($finalres);
?>