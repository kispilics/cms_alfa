<?php

	

	require_once 'classes/formFactory.php';
	require_once 'classes/pageTurner.php';
	
	/**
	*	admin_news.php - vezérlő
	*	
	*	Hirek hozzáadását, módositását, törlését vezérli
	*
	*/
	class admin_news extends helperClass
	{
		
		# tábla neve
		var $DB_tableName = 'news'; 
		
		# a táblában a sorok megjelenitésének a száma
		var $listLimit = 5; 
		
		# az oldal lapozásához hány link jelenjen meg maximum
		var $linklimit = 6; 
		
		# tábla mezők neve
		var $fieldName = array('ID', 'Szerző', 'Cim', 'Datum', 'Statusz', 'Módositás');
		
		# listázáskor az oldal feléc információja
		var $pageHeader_show = 'Hirek';
		
		# új elem hozzáadásakor az oldal fejléc információja
		var $pageHeader_addNew = 'Uj hir hozzáadása';
		
		# adatok szerkesztésekor az oldal fejléc infrmációja
		var $pageHeader_edit = 'Hir szerkesztése';
		
		# a lapozó URL cime
		var $pageTurnerURL = 'admin_news/show/';
		
		# a felhasználó szerkesztése nevű formhoz az ACTION=URL
		var $formAction_edit = 'admin_news/edit/';
		
		# a felhasználó hozzáadása nevű formhoz az ACTION=URL
		var $formAction_addNew = 'admin_news/addNew/';
		
		# a törléséhez az URL
		var $Delete = 'admin_news/Delete/';
		
		#  $FORMFIELDSNAME tömben a USER_RIGHT ellemnek a bővitése...egy select form legörüdülő elem beállitásai
		var $option = array(0 => 'Inaktiv', 1 => 'Aktiv');
		
		# form mezők nevei asszociativ tömben
		var $formFieldsName = array('author' => 'Szerző', 
									'title' => 'Cim',
									'content' => 'Tartalom',
									'src_img' => 'Fotó',
									'date' => 'Dátum',
									'status' => 'Státusz'
									);
									
		# SQL részlet, mely leírja, mely adatokat kell listázni
		var $sql_string = 'id, author, title, date, status';
		
		# a kép elérési útja / mappa név
		var $imgUpLoad_DIR_name = 'images/';
		
		# a template-ben be kapcsoljuk az export linket
		var $excel_export = 'off'; # on/off
		
		# módositás engedélyezése toiltása
		var $set_edit_link = 'on'; # on/off
		
		# törlés engedélyezése tiltása
		var $set_delete_link = 'on'; # on/off
		
		/* ================ FÜGGVNYEK ================ */
		
		
		/**
		*@desc: az admin osztály konstruktora,  helperClass osztálytól örököl
		*@param: 
		*@return:
		*/
		function admin_news()
		{
			parent::helperClass();
		}
		
		
		/**
		*@desc: tábla adatait jeleniti meg
		*@param:
		*@return:
		*/
		function show()
		{
			# a template ellemek ki/be kapcsolást végzi
			$this->smarty->assign('excel_export', $this->excel_export);	
			$this->smarty->assign('set_edit_link', $this->set_edit_link);
			$this->smarty->assign('set_delete_link', $this->set_delete_link);
			
			$page_turner = new pageTurner;

			# table name, id, sql_string, listLimit, linklimit, pageTurnerURL --- 6 db paramétert vár a függvény ---
			$page_turner->set_pageTurner($this->DB_tableName, 'id', $this->sql_string, $this->listLimit, $this->linklimit, $this->pageTurnerURL);
			
			$this->smarty->assign('table_fieldName', $this->fieldName);
			$this->smarty->assign('listing', $page_turner->rows);
			$this->smarty->assign('page_turner', $page_turner->page_turner);
			$this->smarty->assign('edit', $this->formAction_edit);
			$this->smarty->assign('delete', $this->Delete);
			$this->smarty->assign('table_title', $this->pageHeader_show);	# a tábla fejléc neve			
			$this->smarty->display('admin/admin_listing.tpl');
		}
		
		
		
		
		/**
		*@desc: tábla szerkesztése, form factoryt használ
		*		betölti az adatokat a megfelelő mezőkbe, lekérdezi a táblát és egy foreach-val
		*		irja ki a tömb adatait
		*@param:
		*@return:
		*/
		function edit()
		{
			$form = new formFactory;
			
			$sql_allData = "SELECT * FROM $this->DB_tableName WHERE id = '$_GET[id]'";
			$listing = $this->dbQuery->queryAllData($sql_allData);
			
			
			foreach($listing as $key => $item)
			{
				
				$form->form('post', ($this->formAction_edit).($item['id']), 'editForm', 'idEditForm');
				$form->input($this->formFieldsName['author'], 'text', 'author', $item['author'], 'id_author');
				$form->input($this->formFieldsName['title'], 'text', 'title', $item['title'], 'id_title');
				$form->textarea_tiny($this->formFieldsName['content'], 'content', 14, 35, 'id_content', $item['content']);
				$form->input($this->formFieldsName['src_img'], 'file', 'src_img', $item['src_img'], 'id_src_img', $this->imgUpLoad_DIR_name);
				$form->select($this->formFieldsName['status'], 'status', $this->option, 'id_status');
				$form->input('', 'submit', 'editButton', 'Módsitás', 'id_EditButton');
				$form->html_form .= $form->form_end;
				
				# szép URL készitése ha nem létezik a cikkhez
				if($item['speaking_URL'] == '')
				{
					# szép URL generátor hivása
					$this->speaking_URL_generator($item['title'], $item['id']);
				}
				
			}
		
			
			if($form->registFormCheck())
			{
				$img = new img_upload;
				$file_name = $img->upload($this->imgUpLoad_DIR_name);
				if($file_name !== false)
				{
					if(isset($_POST['holder']))
						unlink($_POST['holder']);
					
				}
				else
				{	
					$file_name = $_POST['holder'];
				}
				
				$sql = "UPDATE $this->DB_tableName SET author = '$_POST[author]', title = '$_POST[title]', content = '$_POST[content]', 
						src_img = '$file_name', status = '$_POST[status]' WHERE id = '$_GET[id]'";
				
				$this->dbQuery->query_to_db($sql);
					
					
					
				
				if($this->dbQuery->affectedRows)
				{
					$_SESSION['ok_message'] = 'A módosítás sikeres.';
					header('Location:'.($this->URL).'admin_news/show/');
					die();
				}
				else
				{
					$this->smarty->assign('error', 'Sikertelen módositás!');	
				}
			}
			elseif(!empty($form->error_message))
			{
				$this->smarty->assign('error', $form->error_message);
			}
			
			# adatok átadása a template kezelőnek
			$this->smarty->assign('form', $form);
			$this->smarty->assign('table_title', $this->pageHeader_edit);		# a tábla fejléc neve			
			$this->smarty->display('admin/admin_edit.tpl');
		}
		
		
		/**
		*@desc: hozzáad egy sort a táblához, ellenőrzéseket végez az adatokon mielőtt az adatbázisba irja
		*@param:
		*@return:
		*/
		function addNew()
		{
			if(isset($_POST['author']))
				$var_author = $_POST['author'];
			else
				$var_author = '';
				
			if(isset($_POST['title']))
				$var_title = $_POST['title'];
			else
				$var_title = '';
			
			if(isset($_POST['content']))
				$var_content = $_POST['content'];
			else
				$var_content = '';
				
			
			$form = new formFactory;
			
			$form->form('post', ($this->formAction_addNew), 'addForm', 'idAddForm');
			$form->input($this->formFieldsName['author'], 'text', 'author', $var_author, 'id_author');
			$form->input($this->formFieldsName['title'], 'text', 'title', $var_title, 'id_title');
			$form->textarea_tiny($this->formFieldsName['content'], 'content', 14, 35, 'id_content', $var_content);
			$form->input($this->formFieldsName['src_img'], 'file', 'src_img', '', 'id_src_img');
			$form->select($this->formFieldsName['status'], 'status', $this->option, 'id_status');
			$form->input('', 'submit', 'userAddButton', 'Hozzáad', 'id_AddButton');
			$form->html_form .= $form->form_end;
			# adatok átadása a template kezelőnek
			$this->smarty->assign('form', $form);
			
			
			#ha minden adat rendbe van
			if($form->registFormCheck())
			{
				# két értékkel térhet vissza: a fájl nevével img tag-be rakva vagy egy FALSE értékkel
				$img = new img_upload;
				
				#if($img->upload($this->imgUpLoad_DIR_name) !== false)
				#{
					$file_name = $img->upload($this->imgUpLoad_DIR_name);
					
					# SQL
					$sql_insert = "INSERT INTO $this->DB_tableName (author, title, content, src_img, date, status) 
							VALUES ('$_POST[author]', '$_POST[title]', '$_POST[content]', '$file_name', now(), '$_POST[status]')";
					# adatok beirása az adatbázisba
					$this->dbQuery->query_to_db($sql_insert);
					
					
					# szép URL generátor meghivása
					$URL = $this->speaking_URL_generator($_POST['title'], $this->dbQuery->last_insert_id);
				
				#}
				
				# ellenőrzi, hogy volt e módositás a táblában
				if($this->dbQuery->affectedRows)
				{
					$_SESSION['ok_message'] = 'Sikeres hozzáadás.';
					header('Location:'.($this->URL).'admin_news/show/');
					die();
				}
				else
					$this->smarty->assign('error', 'Nem sikerült a hozzáadás!');
			}
			elseif(!empty($form->error_message))
			{
				$this->smarty->assign('error', $form->error_message);
			}
		
			# a tábla fejléc neve
			$this->smarty->assign('table_title', $this->pageHeader_addNew);	
			
			# az oldal megjelenitése
			$this->smarty->display('admin/admin_addNew.tpl');
			
		}
		
		
		/**
		*@desc: sor törlése
		*@param:
		*@return:
		*/
		function Delete()
		{
			$row = $this->data_download($this->DB_tableName, 'id', $_GET['id']);
			$this->delete_userDB($this->DB_tableName, $_GET['id']);
			# a törlés után 0-ra állitom a get id-t, hogy ne zavarjon be a lapozóban, ugyan azt a GET lekérést használják
			# nem okoz fenn akadást
			$_GET['id'] = 0;
			if($this->dbQuery->affectedRows)
			{
				$this->smarty->assign('ok','Sikeres törlés!');
				if($row[0]['src_img'] != '')
					unlink(($this->imgUpLoad_DIR_name).($row[0]['src_img']));
			}
			else
				$this->smarty->assign('error','Nem sikerült a törlés!');
			$this->show();
		}
		
	}
	
?>