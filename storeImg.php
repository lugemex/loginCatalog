<?php
function getDirFiles($directoryName,$extensionsType)
{
    $directoryName='pictures';
    $extensionsType=array('gif','jpg','jpeg','tif','tiff','bmp','png');
    $listFiles=array();
    $pathFiles=NULL;
    $i=0;
    if (file_exists($directoryName)){ //se pregunta si existe la carpeta
        $dirPointer=opendir($directoryName) or die ('ERROR: It is not possible to open the directory to save the Pictures');
        while($nameImg=readdir($dirPointer)){ //reddir regresa la siguiente entrada del directorio en tipo cadena
            if($nameImg!='.' && $nameImg!='..'){
                $pathFiles=pathinfo($nameImg); //dataIma['dirname','basename','extension','filename']
                if (in_array($pathFiles['extension'],$extensionsType)) { //se pregunta por las extensiones a usar en $extImg (filtra)
                    $listFiles[]="$directoryName/$nameImg"; //se asignan solo cadenas
                    echo $listFiles[$i]."<br>";
                    $i++;
                }
            }
        }
        closedir($dirPointer);
        return $listFiles;
    }else{
        die ('ERROR: Directory does not exist');
    }

}


?>