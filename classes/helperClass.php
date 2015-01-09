<?php
	
	
	require_once '../libs/Smarty.class.php'; 
	require_once 'db_configs.php';
	require_once 'baseClass.php';
	require_once 'exel/PHPExcel.php';
	
	/**
	*
	*		Tartalmazza a SMARTY és az adatbázis csatlakozás példányositását
	*		Egy URL cimet ami az oldal abszolut cimét tartlmazza
	*/
	class helperClass
	{
	
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
		
		# Smarty objektum
		var $smarty;
		
		# Az adatbázis csatlakozás példánya
		var $dbQuery;
		
		# Az oldal abszolút cime
		var $URL;
		
		# Beállitás, hogy a templatben megjelenjen e a hozzáadás link. Alapértelmezett: 0 - disable.
		# Newsletter
		var $disableAddNewsletter = 1;
		# Article
		var $disableAddArticle = 1;
		# User
		var $disableAddUser = 1;
		# Contact
		var $disableAddContact = 0;
		# News
		var $disableAddNews = 1;
		# Header rotator
		var $disableAddHeader = 1;
		
		
		
		/* =========================================== */
		/* ================ FÜGGVÉNYEK =============== */
		/* =========================================== */
		
		/**
		*@desc: A helperClass osztály konstruktora, végrehajtódik a példányosítás, és beállitom a fejléc és lábléc tartalmait
		*		valamint az URL-t
		*@param:
		*@return:
		*/
		function helperClass()
		{
			
			require 'config/config.php';
			
			$this->smarty = new Smarty;
			$this->dbQuery = new db_configs($config['host'], $config['user_db'], $config['password_db'], $config['database']);
			$this->config = $config;
			$this->URL = $config['URL'];
			$this->smarty->assign('URL', $this->URL);
			
			$base = new baseClass($this->smarty, $this->dbQuery);
			
			$this->header_show();
			//$this->footer_show();
		
		}
		
		
		/**
		*@desc: Az oldal fejléc tartlmát jeleniti meg
		*@param:
		*return:
		*/
		function header_show()
		{
			# átadom a template-nek, és az értéktől függően jeleniti meg a linkeket - nem az admin felülethez
			if(isset($_SESSION['user_right']))
				$this->smarty->assign('show_hide', $_SESSION['user_right']); 
			# bejelentkezett admin nevét irja ki a fejlécben - admin felülethez
			if(isset($_SESSION['log']))
			{
				$this->smarty->assign('log_username', $_SESSION['log']['username']);
				$this->smarty->assign('last_log_date', $_SESSION['log']['date']);
			}	
			if(isset($_SESSION['ok_message']))
			{
				$this->smarty->assign('ok', $_SESSION['ok_message']);
				unset($_SESSION['ok_message']);
			}
			$this->smarty->assign('title', 'Gyakorlat');
			$this->smarty->assign('page_name', 'Gyakorlat');
			$this->smarty->assign('a_home', 'Home');
			$this->smarty->assign('a_login', 'Login');
			$this->smarty->assign('a_regist', 'Registration');
			$this->smarty->assign('a_logout', 'LogOut');
			
			# a linkek ki/be kapcsolásáért felelős változókat adja át a template-nek / felül állithatók
			$this->smarty->assign('disableAddNewsletter', $this->disableAddNewsletter);
			$this->smarty->assign('disableAddArticle', $this->disableAddArticle);
			$this->smarty->assign('disableAddUser', $this->disableAddUser);
			$this->smarty->assign('disableAddContact', $this->disableAddContact);
			$this->smarty->assign('disableAddNews', $this->disableAddNews);
			$this->smarty->assign('disableAddHeader', $this->disableAddHeader);
		
		}
		
		/**
		*@desc: az oldal lábléc tartalmát jeleniti meg
		*@param:
		*return:
		*/
		/*function footer_show()
		{
		
		
		}*/
		
		
		/**
		*@desc: az 1. paraméter a tábla neve 2. az oszlop neve a 3. érték pedig az aminek az előfordulását keressük a táblában
		*@param: $DB_tableName, $var, $value
		*@return: $row vagy FALSE
		*/
		function data_download($DB_tableName, $var, $value)
		{
			$row = $this->dbQuery->queryAllData("SELECT * FROM $DB_tableName WHERE $var = '$value'");
			if($this->dbQuery->numRows > 0)
				return $row;
			else
				return false;
		}
		
		/**
		*@desc: egy sor törlése a táblából
		*@param:
		*@return:
		*/
		function delete_userDB($DB_tableName, $id_del)
		{
			$sql = "DELETE FROM $DB_tableName WHERE id='$id_del'";  
			$this->dbQuery->query_to_db($sql);
		}
		
		
		/**
		*@desc: több dimenziós asszociativ tömbről szedig le a HTML tageket
		*@param: a tömb: $multi_D_assocArray
		*@return: $multi_D_assocArray - HTML tag-ek nélkül
		*/
		function stripTags_on_multi_D_assocArray($multi_D_assocArray)
		{
		
			foreach($multi_D_assocArray as $key => $item)
			{
				foreach($item as $key_1 => $item_1)
				{
					$item[$key_1] = strip_tags($item_1);
				}
				$multi_D_assocArray[$key] = $item;
			}
			return $multi_D_assocArray;
		}	
		
		
		/**
		*@desc: speaking URL generálása
		*@param: egy string
		*@return: speaking URL
		*/
		function speaking_URL_generator($string, $id)
		{
			
			$accents_fonts = array(' ' => '-',
								   ',' => '',
								   '*' => '',
								   '/' => '',
								   ':' => '',
								   ';' => '',
								   '.' => '',
								   '?' => '',
								   '!' => '',
								   '&' => '',
								   '$' => '',
								   'ó' => 'o',
								   'ö' => 'o',
								   'ő' => 'o',
								   'ü' => 'u',
								   'ű' => 'u',
								   'ú' => 'u',
								   'é' => 'e',
								   'á' => 'a',
								   'Ó' => 'o',
								   'Ö' => 'o',
								   'Ő' => 'o',
								   'Ü' => 'u',
								   'Ű' => 'u',
								   'Ú' => 'u',
								   'É' => 'e',
								   'Á' => 'a',
								   'š' => 's',
								   'đ' => 'd',
								   'ž' => 'z',
								   'č' => 'c',
								   'ć' => 'c',
								   'Š' => 'S',
								   'Đ' => 'D',
								   'Ž' => 'Z',
								   'Ž' => 'Z',
								   'Č' => 'C',
								   'Ć' => 'C'
								   );
			$URL = $string;
			foreach($accents_fonts as $key => $value)
			{
				while (is_int(strpos($URL, $key)))
				{
					$URL = str_replace($key, $value, $URL);
				}
			}
			
			$URL = strtolower($URL);
			$URL .= '-'. $id;
				
			$sql_update = "UPDATE $this->DB_tableName SET speaking_URL = '$URL' WHERE id = '$id'";
			$this->dbQuery->query_to_db($sql_update);
			
			
			return $URL;
			
		}
		
		/**
		*@desc: excel file export
		*@param: $tabel_fields - tábla mezőnevi
		*@return: excel file
		*/
		function export()
		{
			
			
			date_default_timezone_set('Europe/Belgrade');

			if (PHP_SAPI == 'cli') # command line = CLI
				die('This example should only be run from a Web Browser');


			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
	

	
			// Set document properties
			$objPHPExcel->getProperties()->setCreator($_SESSION['log']['username'])
										 ->setTitle( ($this->DB_tableName) .' datas');

			
			#print_r($this->excel_export_SQL_and_column_name['sql']);
			#die();
			
			$sql = "SELECT ". $this->excel_export_SQL_and_column_name['sql'] ." FROM  $this->DB_tableName";
			$data = $this->dbQuery->queryAllData($sql);
			
			
			# oszlopok létrehozása
			for($c = 'A'; $c < 'Z'; $c++) # <= egy kicsit nagyobb tömb lesz!!!
				$column[] = $c;
			
			
			# az excel file oszlop nevei
			$counter = 0;
			foreach($this->excel_export_SQL_and_column_name['column_name'] as $key => $item)
			{
				$objPHPExcel->getActiveSheet(0)->setCellValue( ($column[$counter]).'1', $item);
				$counter++;
			}
			
			
			# adatok beszúrása az excel fájlba
			$number = 1;	
			foreach($data as $key => $item)
			{
					$number++;
					$help_counter = 0;
					foreach($item as $k => $i)
					{
						$objPHPExcel->getActiveSheet(0)->setCellValue( ($column[$help_counter]) . ($number), $i);
						$help_counter++;
					}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle(($this->DB_tableName).'_datas');

			
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.($this->DB_tableName).'_datas.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
					
		}
		
		
	}

?>