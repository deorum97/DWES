<?php
    $arrayAlfabeto = range("a","z");
    
    $archivo = "alfabeto.txt";

    $farchivo  = fopen($archivo,"w");

    $numLetra = 0;

    foreach($arrayAlfabeto as $letra){
        fwrite($farchivo,$letra." ");
        $numLetra++;
        if($numLetra %5===0){
            fwrite($farchivo, PHP_EOL);
        }
    }

    fclose($farchivo);

    $dir="alfabeto";
    
    if (!is_dir($dir)) mkdir($dir);

    $farchivo  = fopen($archivo,"r");

    while (($lineas  = fscanf($farchivo, "%s%s%s%s%s"))!== false ) {
        // fscanf lee letra por letra separada por espacio
        foreach($lineas as $letra){
            if(is_null($letra)){
                continue;
            }
            $rutaLetra = "$dir/$letra.txt";

            // Crear archivo solo si no existe
            if (!file_exists($rutaLetra)) {
                file_put_contents($rutaLetra, $letra);
            }
        }
    }

    fclose($farchivo);

    $dirCopias = "copiasletras";
    if (!is_dir($dirCopias)) mkdir($dirCopias);

    $farchivo = fopen($archivo, "r");
    rewind($farchivo);

    while (($lineas  = fscanf($farchivo, "%s%s%s%s%s"))!== false ) {
        // fscanf lee letra por letra separada por espacio
        foreach($lineas as $letra){
            if(is_null($letra)){
                continue;
            }
            $rutaLetra = "$dir/$letra.txt";
            $rutaCopia = "$dirCopias/$letra.txt";

            // Si existe en 'letras', copiar a 'copiasletras'
            if (file_exists($rutaLetra)) {
                copy($rutaLetra, $rutaCopia);
            }
        }
    }

    fclose($farchivo);