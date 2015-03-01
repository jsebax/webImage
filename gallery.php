<?php
class gallery {
	
	var $files = array();
	var $path;
	var $misImagenes = false;
	var $id;
	var $data;
	
	function loadFolder($path, $id, $boolean){		
		$this->data = file_get_contents("imagenes.json");
		$imagenes = json_decode($this->data, true);
		$arreglo = array();

		if ($boolean) {
			$this->misImagenes = true;
			$this->id = $id;
			foreach ($imagenes as $imagen) {
				if ($imagen['id'] == $this->id) {
					$arreglo[] = $imagen['nombre'];
				}
			}
		} else {
			foreach ($imagenes as $imagen) {
				if ($imagen['publico'] == true) {
					$arreglo[] = $imagen['nombre'];
				}	
			}
		}		

		$this->path = $path;
		
		//---Guardar en un arreglo todos los archivos en el directorio	
		$folder = opendir($this->path);
			
		while ($fil = readdir($folder)) {
			
			//---Si no es un directorio
			if(!is_dir($fil)){
				
				$arr = explode('.', $fil);
				
				if(count($arr) > 1){
					
					for ($i = 0; $i < sizeof($arreglo); $i++) {
						if ($arreglo[$i] == $fil) {
							$this->files[] = $fil;
							break;
						}
					}					
				}
				
			}
			
		}
		
		//---Cerrar el directorio
		closedir($folder);
		
		//---Ordenar alfabeticamente el arreglo
		sort($this->files);
	
	}
	
	function show($area, $width){
	
		//---Calcular la cantidad de imagenes en un tramo de ancho
		$cant = floor(($area + 5) / ($width + 5));

		//---Calcular un nuevo espacio para la imagenes
		$space = floor(($area - $width * $cant) / ($cant - 1));

		//---Crear la galería con los nombres de todos los archivos
		$total = count($this->files);
		$cont = 0;
		
		echo '<div style="width:'.$area.'px">';
		
			//---Situar los thumbnails
			for($i = 0; $i < $total; $i++){		
				
				//---Determinar si se trata de la ultima imagen de la fila o no
				$margin = (($i + 1) % $cant == 0) ? 0 : $space;

				echo '<div style="width:'.$width.'px; float:left; margin-right:'.$margin.'px; margin-bottom:'.$space.'px;">';
				echo '<a href="'.$this->path.'/'.$this->files[$i].'" rel="lightbox" title="'.$this->getName($this->files[$i]).'">';
				echo '<img src="show_thumb.php?src='.$this->path.'/'.$this->files[$i].'&width='.$width.'&height='.$width.'" width="'.$width.'" height="'.$width.'" border="0"></img>';
				echo $this->files[$i];
				echo '</a>';
				echo '</div>';
			}
			
			?>
        	
			<script type="text/javascript">
    
                $(document).ready(function(){
                   
                    $("a[rel = 'lightbox']").lightBox();					   
                                           
                });
    
            </script>
        
       		<?php
		
		echo '</div>';
	
	}



	//---Función de convertir el nombre de archivo a un nombre descriptivo
   function getName($name){
   	$reg = array('/\[\d*\]/', '/_/', '/\.+jpg|gif|png+$/', '/@A@/', '/@E@/', '/@I@/', '/@O@/', '/@U@/', '/@N@/', '/@a@/', '/@e@/', '/@i@/', '/@o@/', '/@u@/', '/@n@/');
   	$out = array('', ' ', '', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;', '&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;');
   	$ret = preg_replace($reg, $out, $name);

   	return $ret;
   }

} 
?>
