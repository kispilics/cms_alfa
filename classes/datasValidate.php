<?php
	
	/**
	*
	*	Adatok ellenőrzését végzi
	*
	*/
	
	class datasValidate
	{

		var $data;
		var $count_data;
		
		
		/**
		*@desc: Ellenőrzi, hogy a kötelező mezők ki lettek e töltve
		*@param: $important_element - egy asszociatov tömb amely tartalmazza melyik mezőt kell kötelezően kitölteni
		*@return: TRUE / FALSE
		*/
		function form_data_validation($important_element)
		{
			
			# az egyező mezőket számolja meg
			$ok = 0;
			# a nem egyező mezők száma
			$error = 0;
			
			foreach($_POST as $key => $item)
			{
				if($item != '' AND $item != 'NULL')
					$this->data[$key] = 1;
				else
					$this->data[$key] = 0;
				
			}
			
			if(isset($_FILES))
			{
				foreach($_FILES as $key => $item)
				{
					if($item['name'] != '' and $item['size'] != 0)
						$this->data[$key] = 1;
					else
						$this->data[$key] = 0;					
				}
			}
			elseif($_POST['holder'])
			{
				$this->data['file'] = 1;
			}
			
			
			
			foreach($important_element as $key => $item)
			{
				if($item == 1)
				{
					if($this->data[$key] == $item)
						$ok++;
					else
						$error++;
				}
				else
				{
					if($this->data[$key] == 1)
						$ok++;
				}
			}
			
			if($error == 0 AND $ok >= 0)
				return true;
			else
				return false;
		}
		
		
		
		/**
		* @desc: - ellenőrzi, hogy a form összes szükséges adata ki van-e töltve
		* @param: - $num_element: form elemek száma
		* @return: TRUE / FALSE
		*/
		function check_data($num_element)
		{
			$this->data = $_POST;
			$help_count_data = 0;
			
			
			$help_count_data += count($this->data);
			if(isset($_FILES))
			{
				foreach($_FILES as $key => $item)
				{
					if($item['name'] != '' and $item['size'] != 0)
					{
						$help_count_data++;
						$this->count_data++;
					}
					else
					{
						$this->count_data--;
					}
				}
			}
			elseif($_POST['holder'])
			{
				$this->count_data++;
			}
			
			if($num_element <= $help_count_data)
			{
				foreach($this->data as $tmp_data_key => $tmp_data)
				{
					
					if($tmp_data == '' or $tmp_data == 'NULL' )
					{
						$this->count_data--;
					}
					else
					{
						$this->count_data++;
					}
				}
			}
			
			if($num_element <= $this->count_data)
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
		
	
		/**
		* @desc: - email ellenőrzése reguláris kifejezésekkel
		* @param:
		* @return: - TRUE 
		*		   - FALSE
		*/
		function EmailCheckRegex($email)
		{
			return preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $email);
		}
		
		
		/**
		*@desc: Ellenőrzi a két különböző mezőből érekező adatok azonoságát
		*@param: $passwd1, $passwd2
		*@return: TRUE vagy FALSE
		*/
		function passwd1_equal_passwd2($passwd1, $passwd2)
		{
			return $passwd1 == $passwd2 ? true : false;
		}
	}

?>