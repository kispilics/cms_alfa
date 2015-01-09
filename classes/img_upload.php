<?php
	
	/**
	*		Képek feltöltését végzi. A függvényt egy paraméterrel kell megghivni, ami a kép elérésnek az útja.
	*		Az elérési utat a kontrollerben lehet szerkeszteni az $imgUpLoad_DIR_name névre kell rákeresni.
	*		
	*/
	
	class img_upload
	{
		
		
		/**
		*@desc: képek felöltését végzi el a szükséges ellenőrzésekkel
		*@param: $folder_name - a kép mappa nevét adja meg, vagy elérési útját
		*@return: a felöltött fájl útvonala IMG tag-be zárva / FALSE - hiba vagy helytelen adat esetén
		*/
		function upload($folderName)
		{
			foreach($_FILES as $key => $item)
			{
				$file_temp = $item['tmp_name'];
				# file név elkészítése
				$photo_name = Date("YmdHis") . $item['name'];		
			}
		
			
			if($file_temp != '' and $photo_name != '')
			{
				# fájl feltöltése a szerverre
				move_uploaded_file($file_temp, $folderName . $photo_name);
				return $photo_name;
			}
			else
				return false;
		}
		
	}
	
?>