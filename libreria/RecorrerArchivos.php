<?php
	/**
	 * Almacena la ruta de todas las carpetas, subcarpetas y archivos en un array.
	 * @param string $ruta -> Ruta de la que se quiere obtener su contenido en forma de array
	 * @return boolean | array -> False: En caso de no ser un directorio la ruta especificada.
	 *                            Array: De ficheros, carpetas y subcarpetas de la ruta pasada por parámetro.
	 */
	function RecorrerArchivos( $ruta="") {
		if(!is_dir($ruta))
			return false; // Si la ruta no es un directorio, termino la función devolviendo un 'false'
		 
		$files = array(); // En caso de existir la ruta, la función devolverá un array de ficheros y carpetas.
		 
		if( $dh = opendir($ruta)) { // Crea un manejador de directorios a partir de la ruta y lo almacena en la variable 'dh' ('directory handler')
			while(false !== ($file = readdir($dh))) {  // 'readdir' lee línea a línea el contenido del directorio. Devuelve un false en caso de no haber contenido (despúes del último archivo/carpeta leída)
				if($file == '.' || $file == '..') // Omitir '.' y '..'
					continue; // Salto a la siguiente iteración
				 
				$subruta = $ruta . '/' . $file;
				if(is_dir($subruta))
					$files += RecorrerArchivos($subruta); // Recursividad: Ejecuto la misma función que estoy ejecutando en caso de encontrarme con subcarpetas, especificadas en $subruta
				else
					$files[] = $subruta; // Variante del 'array_push($files, $subruta)'. (Ojo!!! NO en JS)
			}
			closedir($dh);
		}
		return $files;
	}
?>