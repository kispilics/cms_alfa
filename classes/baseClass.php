<?php
	
	require_once 'classes/datasValidate.php';
	
	/**
	*	
	*	A háttérben fut, figyeli az olyan eseményeket melyek minden oldalon szerepelnek.
	*	Pl.: hirlevél feliratkozás, friss hirek megjelenitése...
	*
	*/	
	
	class baseClass
	{
		
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
		
		var $smarty;
		var $dbQuery;
		# táblanevek
		var $DB_tableName_1 = 'newsletter';
		var $DB_tableName_2= 'news';
		var $DB_tableName_3= 'article_type';
		var $DB_tableName_4= 'header_rotator';
		var $form_element_num = 2;
		var $message;
		var $max_list_sideBarNews = 2;
		
		
		
		/* =========================================== */
		/* ================ FÜGGVÉNYEK =============== */
		/* =========================================== */
		
		/**
		*@desc: Konstruktor
		*@parem:
		*@return:
		*/
		function baseClass($smarty, $dbQuery)
		{
			$this->smarty = $smarty;
			$this->dbQuery = $dbQuery;
			$this->newsletter_monitoring();
			$this->show_sideBarNews();
			$this->show_footerArticle();
			$this->img_header_rotator();
			
		}
		
		
		/**
		*@desc: Figyeli a hirlevél feliratkozást.
		*@param:
		*@return:
		*/
		function newsletter_monitoring()
		{
			if(isset($_POST['log_button']) and $_POST['log_button'] != '')
			{
				$valid = new datasValidate;
			
				if($valid->check_data($this->form_element_num) and $valid->EmailCheckRegex($_POST['email']) and 
						!($this->dbQuery->CheckDoubleData($this->DB_tableName_1, 'email', $_POST['email'])))
				{
					$sql_insert = "INSERT INTO $this->DB_tableName_1 (name, email) 
									VALUES ('$_POST[name]','$_POST[email]')";
					$this->dbQuery->query_to_db($sql_insert);
					
					$this->message = '<div class="side-msg success">Successful.</div>';
				}
				else
				{
					# hiba uzenet
					$this->message = '<div class="side-msg error">Unsuccessful</div>';
				}
				$this->smarty->assign('newsletter_message', $this->message);
			}
		}
		
		
		/**
		*@desc: Jobboldalt a friss hirek listázását végzi.
		*@param: 
		*@return: 
		*/
		function show_sideBarNews()
		{	
			$row = $this->dbQuery->queryAllData("SELECT * FROM $this->DB_tableName_2 WHERE status = '1' ORDER BY date DESC");
		
			if(count($row) >= $this->max_list_sideBarNews)
			{
				for($c = 0; $c < $this->max_list_sideBarNews; $c++)
				{
					$sideBar_news[] = $row[$c];
				}
			}
			else
			{
				$sideBar_news[] = $row[0];
			}
			
			# több dimenziós asszociativ tömb tartalmát járja át és a tartalomról leszedi a HTML tageket			
			$sideBar_news = $this->stripTags_on_multi_D_assocArray($sideBar_news);
			
			$this->smarty->assign('sideBar_news', $sideBar_news);
		}
		
		
		/**
		*@desc: footer tartalmát irja ki ... ezt majd ki kell javitani
		*@param:
		*@return:
		*/
		function show_footerArticle()
		{
			
			$row = $this->dbQuery->queryAllData("SELECT * FROM $this->DB_tableName_3 
				WHERE speaking_URL = 'a-clean-welcome-4' OR speaking_URL = 'a-clean-welcome-5'");
			
			$sideBar_news = $this->stripTags_on_multi_D_assocArray($row);
			
			$footer_content_1 = array($sideBar_news[0]);
			$footer_content_2 = array($sideBar_news[1]);
			
			$this->smarty->assign('footer_content_1', $footer_content_1);
			$this->smarty->assign('footer_content_2', $footer_content_2);
			
		}
		
		
		/**
		*@desc: több dimenziós asszociativ tömbről szedi le a HTML tageket
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
		*@desc: a fejlécben megjelenő képeket jeleniti meg / forgó
		*@param: 
		*@return:
		*/
		function img_header_rotator()
		{
			
			$row = $this->dbQuery->queryAllData("SELECT * FROM $this->DB_tableName_4");
			#print_r($row);
			#die();
			$this->smarty->assign('img', $row);
		}		
	}
	
?>