<?php

function getDirFiles($directoryName,$extensionsType)
{
    //$directoryName='pictures';
    //$extensionsType=array('gif','jpg','jpeg','tif','tiff','bmp','png');
    // regresa $listFiles=array()
    $listFiles=array();
    $pathFiles=NULL;
    
    if (file_exists($directoryName)){ //se pregunta si existe la carpeta
        $dirPointer=opendir($directoryName) or die ('ERROR: It is not possible to open the directory to save the Pictures');
        while($nameImg=readdir($dirPointer)){ //reddir regresa la siguiente entrada del directorio en tipo cadena
            if($nameImg!='.' && $nameImg!='..'){
                $pathFiles=pathinfo($nameImg); //dataIma['dirname','basename','extension','filename']
                if (in_array($pathFiles['extension'],$extensionsType)) { //se pregunta por las extensiones a usar en $extImg (filtra)
                    $listFiles[]="$directoryName/$nameImg"; //se asignan solo cadenas
                }
            }
        }
        closedir($dirPointer);
        return $listFiles; //array
    }else{
        die ('ERROR: Directory does not exist');
    }

}

function printListFiles($listFiles)
{
    $numElements=count($listFiles);
    if ($numElements>0){
        for($i=0;$i<$numElements;$i++){
            echo "<li>";
            echo basename($listFiles[$i])."<br>";
            echo "</li>";
        }
    }
    else{
        return true;
    }
    return false;
}

function showPictures($listFiles)
{
    $numElements=count($listFiles);
    if ($numElements>0){
        for($i=0;$i<$numElements;$i++){
            echo "<li>";
            echo '<img height="150"width="200" src=$listFiles[$i]>';
            echo $listFiles[$i]."<br>";
            echo "</li>";
        }
    }
    else{
        return true;
    }
    return false;
}

function uploadFile($nameFileOrigin,$nameTempInServer,$destinyFile,$name='')
{
    echo "DNI";
}

function openDB($hostDB,$userDB,$passwordDB,$nameDB,$portDB=3306)
{
    $myDB=mysqli_connect($hostDB,$userDB,$passwordDB,$nameDB,$portDB);
    if (empty($myDB)){
        echo "FAllo al abrir BD";
        die('fallo conexión a ('.mysqli_connect_error().')'.mysqli_connect_error());
        return NULL;
	}
    //echo 'Exito...'.mysqli_get_host_info($myDB)."<br>";
    return $myDB;
}

function insertDataIntoDB($myDB,$tablaDB,$rowsDB,$valuesDB)
{
    $numValues=sizeof($valuesDB);
    $numRows=sizeof($rowsDB);
    if ($numRows!=$numValues){
        echo "el numero de campos y valores deben ser el mismo";
        return FALSE;
    }
    if (empty($myDB)){
        echo "fallo conexión a (".mysqli_connect_error().')'.mysqli_connect_error();
        return FALSE;
    } else{
        //$rows="DNI,nombre,apellidos,exp_curso";
        $rows=implode(",",$rowsDB);
        //$values="'16','no','ap','2'";
        
        
        for($i=0;$i<$numValues;$i++){
            $values[$i]="'".$valuesDB[$i]."'";
            //echo $values[$i];
        }
        $valuesFormated=implode(",",$values);
        
        mysqli_query($myDB,"INSERT INTO $tablaDB ($rows) VALUES ($valuesFormated)");
        //mysqli_query($myDB,"INSERT INTO $tablaDB (Article) VALUES ('sd)");
        //mysqli_query($myDB,"INSERT INTO $tablaDB ($rowsDB[0],$rowsDB[1],$rowsDB[2],$rowsDB[3]) VALUES ('$valuesDB[0]','$valuesDB[1]','$valuesDB[2]','$valuesDB[3]')");
        return TRUE;
    }
}

function getDataFromDB($myDB,$tablaDB,$row="",$value="",$format=0)
{
    $dataDB=mysqli_query($myDB,("SELECT * FROM $tablaDB WHERE $row='$value'")); //obtiene todos los campos de la tabla señalada en la BD.
    if ($format==0){ // regresa valor tipo mysql_result
        return $dataDB;
    } elseif($format==1){//regresa array de string con los datos
        $data=array();
        $i=0;
        while ($queryDB=mysqli_fetch_array($dataDB)){ // obtiene las columnas de la tabla de la base de datos
            //echo $queryDB[$Article]."<BR>"; por nombre de campo
            $data[$i]=$queryDB[$i];
            $i++;
        }
        return $data;
    }
    
}


function modifyElementFromDB($myDB,$tablaDB,$rowDB,$valueDB,$condition)
{
    //mejorar esta función con primaryKey en lugar de Article
    mysqli_query($myDB, "UPDATE $tablaDB SET $rowDB='$valueDB' WHERE Article='$condition'");

}

function removeElementFromDB($myDB,$tablaDB,$rowDB,$valueToDelete)
{
    mysqli_query($myDB,"DELETE FROM $tablaDB WHERE $rowDB='$valueToDelete'");
}




?>