<?php
require_once(__DIR__.'/../../../../lib/controller/IndexController.php');
$controller = new IndexController();

$nom= $_POST['nom'];
$columnHeader ='';
$columnHeader = "Data"."\t"."ID"."\t"."Pagat a"."\t"."Estat"."\t"."Preu"."\t"."Motiu"."\t"."Entregat Fisicament"."\t"."Imatge"."\t"."Forma de Pagament"."\t"."Grup"."\t";
require_once(__DIR__.'/../../../../lib/controller/IndexController.php');
$j = $controller->getLlistatFull();


$setData='';
//while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))

    $rowData = '';
        foreach($j as $def) {
            $motiu=preg_replace( "/\r|\n/", "", $def->getMotiu());
            $value = $def->getData(). "\t" . $def->getId(). "\t". $def->getNom(). "\t". $def->getEstat(). "\t". $def->getPreu(). "\t". $motiu. "\t". $def->getEntregatFisic(). "\t". $def->getImatge()."\t". $def->getComhorebra()."\t". $def->getGrup(). "\n";
            $rowData .= $value;
        }
    $setData .= trim($rowData)."\n";



header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$nom.".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader)."\n".$setData."\n";




?>
