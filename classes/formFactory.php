<?php
	
	require_once 'datasValidate.php';
	
	
	/**
	*
	*			autómatikus form generálás
	*			java ellenőrzés autómatikus generálása
	*			form ellenőrzés PHP-val
	*/
	class formFactory
	{
		# a form tárolására
		var $html_form;
		# a fieldset záró tag-je
		var $fieldset_end;
		# a form záró tag-je
		var $form_end;
		# a form ellemeinek számát tárolja
		var $count_form_element;
		# hiba üzenet
		var $error_message;
		# a form küldő gombjának a nevét tárolja
		var $submit;
		# validaló objectum
		var $validate;
		# fontos form mezok
		var $importantForm_element_array;
		# java validáló kód
		var $java;
		
		
		function formFactory()
		{	
			$this->validate = new datasValidate;
		}
		
		
		/**
		*@desc: Példányositva van a datasValidate osztály amely az adatok 
		* 		érvényeségét ellenőrzi a következő sorrendben:
		*		- submitelve lett van-e a form
		*		- nem lehetnek a mezők üressek
		*		Érvénytelen adat esetén hiba üzenettel tér vissza.
		*@param:
		*@return: feltétel vizsgálatától függően: TRUE vagy FALSE
		*/
		function registFormCheck()
		{
			if(isset($_POST[$this->submit]))
			{	
				#if($this->validate->check_data($this->count_form_element))
				if($this->validate->form_data_validation($this->importantForm_element_array))
				{
					return true;
				}
				else
				{
					$this->error_message = 'Kérem Töltsön ki minden mezőt!';
					return false;
				}
			}
		}
		
		
		/**
		* @desc: - form nyitó tag-et (a paraméterekkel) hozza létre és a form záró taget: <form ...> ... </form> 
		*			FIGYELEM!!! A form záró taget $form_end változóval érheted el
		* @param: - $method
		* @param: - $action
		* @param: - $name
		* @param: - $id
		* @return:
		*/
		function form($method, $action, $name, $id)
		{
			$this->count_form_element = 0;
			$this->html_form .= "\n\t<form method=\"$method\" action=\"$action\" name=\"$name\" id=\"$id\" enctype=\"multipart/form-data\" >\n";
			$this->form_end = "\n\t</form>\n";
			$this->java .= 'var equal_var = "0", eq_fieldName = "0", eq_fieldName_2 = "0";'."\n";
			$this->java .= 'function validateForm_'.$name.'(){'."\n";
			$this->formName = $name;
		}
		
		
		/**
		* @desc: - fieldset nyitó elemet és záró ellemet valamint legend nyitó és záró tageket hozza létre
		*			<fieldset><legend>title</legend> ... </fieldset>
		*			FIGYELEM!!! A fieldset záró taget a $fieldset_end változóval érheted el
		* @param: - $title
		* @return:
		*/
		function fieldsetANDlegend($title)
		{	
			$this->html_form .= "\n\t\t<fieldset><legend>$title</legend>\n";
			$this->fieldset_end = "\n\t\t</fieldset>\n";
		}
		
		
		/**
		* @desc: - $type változó értékétől függően hozza létre a következőket: 
		*				text mező, jelszavas -, checkbox -, radio -, rejtett -, fájl -, datum - mező, submit gomb, reset gomb
		*				A függvény paraméter listáját szigorúan ki kell tölteni, 
		*				kivéve az utolsó elemt, az opcionális, alapértéke false.
		*				Az utolsó érték egy segéd változó speciális esetkre mint pl: raiod button, checkbox, egyébb.
		*				FONTOS!!!
		*				Checkbox esetén ha több jelölő doboz van, akkor ne rakjuk
		*				1-nél több értéket checkedre!!!
		*				Generál JAVA ellenőrzést a mezőkre
		*
		*
		* @param: - $field_name
		* @param: - $type
		* @param: - $name
		* @param: - $value
		* @param: - $id
		* @param: - $help = false - egy segéd változó: a gombok(radio, checkbox...) beállitására is szolgál
		*							át lehát adni vele a kép elérési útját a file tipusú mezőnek
		*							ezzel a kapcsolóval lehet újabb JAVA ellenőrzést hozzáfűzni ha az important field mező 1:
		*								- regexes email ellenőrzés: regex
		*								- mező azonoság ellenőrzése: equal
		* @param: - $important_field - 1 kötelező mező / 0 nem kötelező mező / 1 érték esetén generál JAVA ellenőrzést
		* @return: 
		*/
		function input($field_name, $type, $name, $value, $id, $help = false, $important_field = 1)
		{
			switch($type)
			{
				case "checkbox":
					if($help)
					{
						$this->count_form_element++;
						
						$this->importantForm_element_array[$name] = $important_field;
						
						$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\" checked /><br />\n";
					}
					else
						$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\" /><br />\n";
				
					# java validator
					if($important_field)
					{	
						$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
						$this->java .= 'if($("#'.$id.'").val() != ""){'."\n\t";
							$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
						$this->java .= 'else{'."\n\t";
							$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
							$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
							$this->java .= '$(".fancybox").fancybox(); '."\n\t";
							$this->java .= '$("#'.$id.'").focus();'."\n\t";
							$this->java .= 'return false;}'."\n";
					}
				break;
				
				case "radio":
					if($help)
					{
						$this->count_form_element++;
						
						$this->importantForm_element_array[$name] = $important_field;
						
						$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\" checked /><br />\n";
					}
					else
						$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\" /><br />\n";
					
					# java validator
					if($important_field)
					{	
						$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
						$this->java .= 'if($("#'.$id.'").val() != ""){'."\n\t";
							$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
						$this->java .= 'else{'."\n\t";
							$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
							$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
							$this->java .= '$(".fancybox").fancybox(); '."\n\t";
							$this->java .= '$("#'.$id.'").focus();'."\n\t";
							$this->java .= 'return false;}'."\n";
					}
				break;
				
				case "submit":
					$this->count_form_element++;
					
					$this->importantForm_element_array[$name] = $important_field;
					
					$this->html_form .= "\n\t\t<input type=\"$type\" name=\"$name\" value=\"$value\" id=\"$id\" class=\"fancybox\" href=\"#error_popup\" onclick=\"return validateForm_$this->formName()\" /><br />\n";
					$this->submit = $name;
					$this->java .= '}'."\n";
				break;
				
				case "hidden":
					$this->count_form_element++;
					
					$this->importantForm_element_array[$name] = $important_field;
					
					$this->html_form .= "\n\t\t<input type=\"$type\" name=\"$name\" value=\"$value\" id=\"$id\" /><br />\n";
					
					# java validator
					if($important_field)
					{	
						$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
						$this->java .= 'if($("#'.$id.'").val() != ""){'."\n\t";
							$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
						$this->java .= 'else{'."\n\t";
							$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
							$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
							$this->java .= '$(".fancybox").fancybox(); '."\n\t";
							$this->java .= '$("#'.$id.'").focus();'."\n\t";
							$this->java .= 'return false;}'."\n";
					}
				break;
				
				case "date":
					$this->count_form_element++;
					
					$this->importantForm_element_array[$name] = $important_field;
					
					$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\" /><br />\n";
					
					# java validator
					if($important_field)
					{	
						$this->java .= '$(".error_fancybox").attr("class","fancybox"); var x = $("#'.$id.'").val(); alert(x);'."\n\t";
						$this->java .= 'if($("#'.$id.'").val() != ""){'."\n\t";
							$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
						$this->java .= 'else{'."\n\t";
							$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
							$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
							$this->java .= '$(".fancybox").fancybox(); '."\n\t";
							$this->java .= '$("#'.$id.'").focus();'."\n\t";
							$this->java .= 'return false;}'."\n";
					}
				break;
				
				case "file":
					$this->count_form_element++;
					
					
					if($value != '')
					{
						$this->importantForm_element_array['holder'] = $important_field;
					}
					else
						$this->importantForm_element_array[$name] = $important_field;
					
					$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" /><br />\n";
					
					if($value != '')
					{
						$this->html_form .= "<p class=\"img_style\"><img src=\"$help$value\" /> </p>";
						$this->html_form .= "<input type=\"hidden\" name=\"holder\" value=\"$value\" />";
					}
					elseif($_GET['id'] != '')
						$this->html_form .= "<p style=\"font-size:20px;\">Nincs elérhető kép!</p>";
					
					if($important_field and ($value == '' OR $_GET['id'] != '' and $value == ''))
					{
						$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
						$this->java .= 'if($("#'.$id.'").val() != ""){'."\n\t";
							$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
						$this->java .= 'else{'."\n\t";
							$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
							$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
							$this->java .= '$(".fancybox").fancybox(); '."\n\t";
							$this->java .= '$("#'.$id.'").focus();'."\n\t";
							$this->java .= 'return false;}'."\n";
					}
				break;	
					
				default:
					$this->count_form_element++;
					
					$this->importantForm_element_array[$name] = $important_field;
					
					$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\" /><br />\n";
					
					# java validator
					if($important_field)
					{	
						$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
						$this->java .= 'if($("#'.$id.'").val() != ""){'."\n\t\t"; # if_java_open1
						# regexes ellenőrzés emailre
						if($help == 'regex')
						{
							$this->java .= 'var userinput = $("#'.$id.'").val();'."\n\t\t";
							$this->java .= 'var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;'."\n\t\t";
							$this->java .= 'if(!pattern.test(userinput)){'."\n\t\t\t"; # if_java_open2
								$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t\t\t";
								$this->java .= '$("#error_popup").text("Rossz Email cim!");'."\n\t\t\t";
								$this->java .= '$(".fancybox").fancybox(); '."\n\t\t\t";
								$this->java .= '$("#'.$id.'").focus();'."\n\t\t\t";
								$this->java .= 'return false;}'."\n\t"; # if_java_close2
						}
						
						#equal: két mező összehasnolitása
						if($help == 'equal')
						{
							$this->java .= 'if(equal_var == "0"){'."\n\t";# if_java_open3
								$this->java .= 'equal_var = $("#'.$id.'").val(); eq_fieldName = "'.$field_name.'";'."\n\t";
								$this->java .= '}'; # if_java_close3
							$this->java .= 'else{'."\n\t"; # else_java_open3
									$this->java .= 'if(eq_fieldName_2 == "0"){ eq_fieldName_2 = "'.$field_name.'"; }'."\n\t"; # if_java_open_close4
									$this->java .= 'if(equal_var != $("#'.$id.'").val()){'."\n\t"; # if_java_open5
										$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t\t\t";
										$this->java .= '$("#error_popup").text(eq_fieldName +" és "+eq_fieldName_2+" mezők nem egyformák!");'."\n\t\t\t";
										$this->java .= '$(".fancybox").fancybox(); '."\n\t\t\t";
										$this->java .= '$("#'.$id.'").focus();'."\n\t\t\t";
										$this->java .= 'return false;}'."\n\t"; # if_java_close5
							$this->java .= '}'; # if_java_close3
						}
						
							$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t"; # if_java1_close
						$this->java .= 'else{'."\n\t\t"; # else_java_open1
							$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t\t";
							$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t\t";
							$this->java .= '$(".fancybox").fancybox(); '."\n\t\t";
							$this->java .= '$("#'.$id.'").focus();'."\n\t\t";
							$this->java .= 'return false;}'."\n\t"; # else_java_close1
					}
				break;
			}
		}
		
		
		/**
		* @desc: textareat hoz létre 
		* @param: $field_name
		* @param: $name
		* @param: $rows
		* @param: $cols
		* @param: $id
		* @param: $value
		* @return: 
		*/
		function textarea($field_name, $name, $rows, $cols, $id, $value, $important_field = 1)
		{
			$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><br />\n<textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\" id=\"$id\">$value</textarea><br />\n";
			$this->count_form_element++;
			
			$this->importantForm_element_array[$name] = $important_field;
			
			# java validator
			if($important_field)
			{	
				$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
				$this->java .= 'var x = $("textarea#'.$id.'").val();'."\n\t";
				$this->java .= 'if(x != ""){'."\n\t";
					$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
				$this->java .= 'else{'."\n\t";
					$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
					$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
					$this->java .= '$(".fancybox").fancybox(); '."\n\t";
					$this->java .= '$("#'.$id.'").focus();'."\n\t";
					$this->java .= 'return false;}'."\n";
			}
		}
		
		/**
		* @desc: tiny editort hoz létre
		* @param: $field_name
		* @param: $name
		* @param: $rows
		* @param: $cols
		* @param: $id
		* @param: $value
		* @return: 
		*/
		function textarea_tiny($field_name, $name, $rows, $cols, $id, $value, $important_field = 1)
		{
			$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><br />\n<div id=\"showErrorColor\"><textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\" id=\"$id\" class=\"tinyEditor\">$value</textarea></div><br />\n";
			$this->count_form_element++;
			
			$this->importantForm_element_array[$name] = $important_field;
			
			# java validator tiny editorra
			if($important_field)
			{
				$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n";
				$this->java .= 'tinyMCE.triggerSave();'."\n";
				$this->java .= 'var x = $("#'.$id.'").val();'."\n";
				$this->java .= 'if(x != ""){'."\n\t";
					$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
				$this->java .= 'else{'."\n\t";
					$this->java .= '$("#showErrorColor").css("box-shadow","0px 0px 10px red");'."\n\t";
					$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
					$this->java .= '$(".fancybox").fancybox(); '."\n\t";
					$this->java .= '$("#'.$id.'").focus();'."\n\t";
					$this->java .= 'return false;}'."\n";
			}
		}
		
		/**
		* @desc: egy select elemet hoz létre
		* @param: $field_name
		* @param: $name
		* @param: $option - asszociativ tömb
		* @param: $id
		* @return:
		*/
		function select($field_name, $name, $option, $id, $important_field = 1)
		{
			$this->html_form .= "\n\t\t<label for=\"$id\">$field_name </label><br />\n";
			$this->html_form .= "\n\t\t\t<select name=\"$name\" id=\"$id\">\n";
			$this->html_form .= "\n\t\t\t\t<option value=\"NULL\">-----------</optin>";
			foreach($option as $key => $value)
				$this->html_form .= "\n\t\t\t\t<option value=\"$key\">$value</option>";
			$this->html_form .= "\n\t\t\t</select><br />\n";
			
			$this->count_form_element++;
			
			$this->importantForm_element_array[$name] = $important_field;
			
			# java validator
			if($important_field)
			{	
				$this->java .= '$(".error_fancybox").attr("class","fancybox");'."\n\t";
				$this->java .= 'if($("#'.$id.'").val() != "NULL"){'."\n\t";
					$this->java .= '$(".fancybox").attr("class","error_fancybox");}'."\n\t";
				$this->java .= 'else{'."\n\t";
					$this->java .= '$("#'.$id.'").css("box-shadow","0px 0px 10px red");'."\n\t";
					$this->java .= '$("#error_popup").text("'.$field_name.'"+" mezőt kötelező kitölteni!");'."\n\t";
					$this->java .= '$(".fancybox").fancybox(); '."\n\t";
					$this->java .= '$("#'.$id.'").focus();'."\n\t";
					$this->java .= 'return false;}'."\n";
			}
		
		}
		
		
		/**
		*@decs: Egy linket hoz létre a megadott paraméterekkel
		*@param: $href
		*@param: $id
		*@param: $link_name
		*@return: 
		*/
		function link_next_form($href, $id, $link_name)
		{
			$this->html_form .= '<p><a href="'.$href.''.$id.'">'.$link_name.'</a></p>';
		}
		
	}

?>