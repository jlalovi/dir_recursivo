<?php
	/**
	 * Almacena la ruta de todas las carpetas, subcarpetas y archivos en un array.
	 * @param string $ruta -> Ruta de la que se quiere obtener su contenido en forma de array
	 * @return boolean | array -> False: En caso de no ser un directorio la ruta especificada.
	 *                            Array: De ficheros, carpetas y subcarpetas de la ruta pasada por par�metro.
	 */
	function RecorrerArchivos( $ruta="") {
		if(!is_dir($ruta))
			return false; // Si la ruta no es un directorio, termino la funci�n devolviendo un 'false'
		 
		$files = array(); // En caso de existir la ruta, la funci�n devolver� un array de ficheros y carpetas.
		 
		if( $dh = opendir($ruta)) { // Crea un manejador de directorios a partir de la ruta y lo almacena en la variable 'dh' ('directory handler')
			while(false !== ($file = readdir($dh))) {  // 'readdir' lee l�nea a l�nea el contenido del directorio. Devuelve un false en caso de no haber contenido (desp�es del �ltimo archivo/carpeta le�da)
				if($file == '.' || $file == '..') // Omitir '.' y '..'
					continue; // Salto a la siguiente iteraci�n
				 
				$subruta = $ruta . '/' . $file;
				if(is_dir($subruta))
					$files += RecorrerArchivos($subruta); // Recursividad: Ejecuto la misma funci�n que estoy ejecutando en caso de encontrarme con subcarpetas, especificadas en $subruta
				else
					$files[] = $subruta; // Variante del 'array_push($files, $subruta)'. (Ojo!!! NO en JS)
			}
			closedir($dh);
		}
		return $files;
	}
?>