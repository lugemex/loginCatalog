<?php
error_reporting(E_ALL); // para que despliegue fallas
ini_set('display_errors','1'); //cuando hay warnings

function getDirFiles($directoryName,$extensionsType)
{
    //$directoryName='pictures';
    //$extensionsType=array('gif','jpg','jpeg','tif','tiff','bmp','png');
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
    echo "uploadFile";
}

?>