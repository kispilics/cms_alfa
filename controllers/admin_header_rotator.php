<?php

	/*
		HIBÁK ÉSZREVÉTELEK:
	*/

	
	require_once 'classes/formFactory.php';
	require_once 'classes/img_upload.php';
	
	/**
	*	admin_header_rotator.php
	*	
	* a fejlécben megjelenő képek hozzáadását, módositását és törlését végzi
	*
	*/
	class admin_header_rotator extends helperClass
	{
	
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
		
		# tábla neve
		var $DB_tableName = 'header_rotator';
		
		# a táblában a sorok megjelenitésének a száma
		var $listLimit = 5; 
		
		# az oldal lapozásához hány link jelenjen meg maximum
		var $linklimit = 6; 
		
		# a lapozó URL cime
		var $pageTurnerURL = 'header_rotator/show/';
		
		# listázáskor az oldal feléc információja
		var $pageHeader_show = 'Fejlécek listázása';
		
		# új elem hozzáadásakor az oldal fejléc információja
		var $pageHeader_addNew = 'Fejléc hozzáadása';
		
		# adatok szerkesztésekor az oldal fejléc infrmációja
		var $pageHeader_edit = 'Fejléc szerkesztése';
		
		# tábla mezők neve
		var $fieldName = array('ID', 'Név', 'Módositás');
		
		# a szerkesztése nevű formhoz az ACTION=URL
		var $formAction_edit = 'admin_header_rotator/edit/';
		
		# a hozzáadás nevű formhoz az ACTION=URL
		var $formAction_addNew = 'admin_header_rotator/addNew/';
		
		# a törléséhez az URL
		var $Delete = 'admin_header_rotator/Delete/';
		
		# form mezők nevei asszociativ tömben
		var $formFieldsName = array('name' => 'Name','img' => 'Image');
						
		# SQL részlet, mely leírja, mely adatokat kell listázni
		var $sql_select = 'id, name';
		
		# a kép elérési útja, mappa/folder név
		var $imgUpLoad_DIR_name = 'images/';
		
		# a template-ben be kapcsoljuk az export linket
		var $excel_export = 'off';
		
		# módositás engedélyezése toiltása
		var $set_edit_link = 'on'; # on/off
		
		# törlés engedélyezése tiltása
		var $set_delete_link = 'on'; # on/off
		
		
		
		
		/* ============================================ */
		/* ================ FÜGGVÉNYEK ================ */
		/* ============================================ */
		
		/**
		*@desc: az admin osztály konstruktora,  helperClass osztálytól örököl
		*@param: 
		*@return:
		*/
		function admin_header_rotator()
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
			
			$this->smarty->assign('excel_export', $this->excel_export);	
			$this->smarty->assign('set_edit_link', $this->set_edit_link);
			$this->smarty->assign('set_delete_link', $this->set_delete_link);
		
			$page_turner = new pageTurner;

			# table name, id, sql_select, listLimit, linklimit, pageTurnerURL --- 6 db paramétert vár a függvény ---
			$page_turner->set_pageTurner($this->DB_tableName, 'id', $this->sql_select, $this->listLimit, $this->linklimit, $this->pageTurnerURL);
			
			$this->smarty->assign('table_fieldName', $this->fieldName);
			$this->smarty->assign('listing', $page_turner->rows);
			$this->smarty->assign('page_turner', $page_turner->page_turner);	
			$this->smarty->assign('edit', $this->formAction_edit); 			# szerkesztés link küldése a templatnek
			$this->smarty->assign('delete', $this->Delete);					# törlés link küldése a templatnek
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
				$form->input($this->formFieldsName['name'], 'text', 'name', $item['name'], 'id_name');	
				$form->input($this->formFieldsName['img'], 'file', 'img', $item['img'], 'id_img', $this->imgUpLoad_DIR_name);	
				$form->input('', 'submit', 'editButton', 'Módsitás', 'id_EditButton');
				$form->html_form .= $form->form_end;
				
			}
			
			
			if($form->registFormCheck())
			{
				$img = new img_upload;
				$file_name = $img->upload($this->imgUpLoad_DIR_name);
				if($file_name !== false)
				{
					# file törlése
					if(isset($_POST['holder']))
						unlink(($this->imgUpLoad_DIR_name).($_POST['holder']));
					
				}
				else
				{	
					$file_name = $_POST['holder'];
				}
					
				$sql = "UPDATE $this->DB_tableName SET name = '$_POST[name]', img = '$file_name' WHERE id = '$_GET[id]'";
						
				$this->dbQuery->query_to_db($sql);
					
					
				if($this->dbQuery->affectedRows)
				{
					$_SESSION['ok_message'] = 'A módosítás sikeres.';
					header('Location:'.($this->URL).'admin_header_rotator/show/');
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
			
			$this->smarty->assign('form', $form);
			$this->smarty->assign('table_title', $this->pageHeader_edit);		# a tábla fejléc neve			
			$this->smarty->display('admin/admin_edit.tpl');
		}
		
		
		/**
		*@desc: hozzáad egy sort a táblához, ellenőrzéseket végez az adatokon mielőtt az adatbázisba irja
		*		képet másol fel a megadott mappába
		*@param:
		*@return:
		*/
		function addNew()
		{
			
			if(isset($_POST['name']))
				$var_title = $_POST['name'];
			else
				$var_title = '';
			
			$form = new formFactory;
			
			$form->form('post', ($this->formAction_addNew), 'addForm', 'idAddForm');
			$form->input($this->formFieldsName['name'], 'text', 'name', $var_title, 'id_name');
			$form->input($this->formFieldsName['img'], 'file', 'img', '', 'id_img');
			$form->input('', 'submit', 'userAddButton', 'Hozzáad', 'id_AddButton');
			$form->html_form .= $form->form_end;
			
			
			# adatok átadása a template kezelőnek
			$this->smarty->assign('form', $form);
				
			# ha minden adat rendbe van		
			if($form->registFormCheck())
			{
				# két értékkel térhet vissza: a fájl nevével img tag-be rakva vagy egy FALSE értékkel
				$img = new img_upload;
				
				$file_name = $img->upload($this->imgUpLoad_DIR_name);
			
				# SQL
				$sql_insert = "INSERT INTO $this->DB_tableName (name, img) VALUES ('$_POST[name]', '$file_name')";
						
				# adatok beirása az adatbázisba
				$this->dbQuery->query_to_db($sql_insert);
			
				# ellenőrzi, hogy volt e módositás a táblában
				if($this->dbQuery->affectedRows)
				{
					$_SESSION['ok_message'] = 'Sikeres hozzáadás.';
					header('Location:'.($this->URL).'admin_header_rotator/show/');
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
		*@desc: sor törlése a táblából
		*@param:
		*@return:
		*/
		function Delete()
		{
			$row = $this->data_download($this->DB_tableName, 'id', $_GET['id']);
			$this->delete_userDB($this->DB_tableName, $_GET['id']);
			
			# a törlés után 0-ra állitom a get id-t, hogy ne zavarjon be a lapozóban, ugyan azt a GET lekérést használja
			# nem okoz fenn akadást
			$_GET['id'] = 0;
			if($this->dbQuery->affectedRows)
			{
				$this->smarty->assign('ok','Sikeres törlés!');
				# file törlése
				if($row[0]['img'] != '')
					unlink(($this->imgUpLoad_DIR_name).($row[0]['img']));
			}
			else
				$this->smarty->assign('error','Nem sikerült törlés!');
			$this->show();
			
		}
		
	}
	
?>