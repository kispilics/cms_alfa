<?php

	require_once 'classes/formFactory.php';
	require_once 'classes/pageTurner.php';
	
	/**
	*
	*	Kontroller a kontakt admin felülethez.
	*
	*/
	class admin_contact extends helperClass
	{
		
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
		
		# tábla neve
		var $DB_tableName = 'contact'; 
		
		# a táblában a sorok megjelenitésének a száma
		var $listLimit = 5; 
		
		# az oldal lapozásához hány link jelenjen meg maximum
		var $linklimit = 6; 
		
		# tábla mezők neve
		var $fieldName = array('ID', 'Név', 'Dátum', 'Módositás');
		
		# listázáskor az oldal feléc információja
		var $pageHeader_show = 'Kontakt üzenetek';
		
		# új elem hozzáadásakor az oldal fejléc információja
		var $pageHeader_addNew = 'Új kontakt üzenet hozzáadása';
		
		# adatok szerkesztésekor az oldal fejléc infrmációja
		var $pageHeader_read = 'Üzenet olvasás';
		
		# a lapozó URL cime
		var $pageTurnerURL = 'admin_contact/show/';
		
		# a felhasználó szerkesztése nevű formhoz az ACTION=URL
		var $URL_read = 'admin_contact/read/';
		
		# a felhasználó hozzáadása nevű formhoz az ACTION=URL
		var $formAction_addNew = 'admin_contact/addNew/';
		
		# a törléséhez az URL
		var $Delete = 'admin_contact/Delete/';
		
		# form mezők nevei asszociativ tömben
		var $formFieldsName = array('name' => 'Név', 
									'phone' => 'Telefon',
									'email' => 'Email',
									'message' => 'Üzenet',
									'date' => 'Dátum'
									);
									
		# SQL részlet, mely leírja, mely adatokat kell listázni
		var $sql_string = 'id, name, DATE_FORMAT(date,"%Y-%m-%d %H:%i") AS date, viewed';
		
		# a template-ben be kapcsoljuk az export linket
		var $excel_export = 'off';
		
		# módositás engedélyezése toiltása
		var $set_edit_link = 'on'; # on/off
		
		# törlés engedélyezése tiltása
		var $set_delete_link = 'on'; # on/off
		
		/* =========================================== */
		/* ================ FÜGGVNYEK ================ */
		/* =========================================== */
		
		/**
		*@desc: az admin osztály konstruktora,  helperClass osztálytól örököl
		*@param: 
		*@return:
		*/
		function admin_contact()
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

			# table name, id, sql_string, listLimit, linklimit, pageTurnerURL --- 6 db paramétert vár a függvény ---
			$page_turner->set_pageTurner($this->DB_tableName, 'id', $this->sql_string, $this->listLimit, $this->linklimit, $this->pageTurnerURL);
			
			
			
			$this->smarty->assign('table_fieldName', $this->fieldName);
			$this->smarty->assign('listing', $page_turner->rows);
			$this->smarty->assign('page_turner', $page_turner->page_turner);
			$this->smarty->assign('read', $this->URL_read);
			$this->smarty->assign('delete', $this->Delete);
			$this->smarty->assign('table_title', $this->pageHeader_show);	# a tábla fejléc neve	
			$this->smarty->display('admin/admin_contact.tpl');
		}
		
		
		
		
		/**
		*@desc: A felhasználó az üzenet olvasása gombra kattint akkor ez a függvény vézérli a megjelenitést
		*@param:
		*@return:
		*/
		function read()
		{
			
			
			$sql_allData = "SELECT name, phone, email, message, DATE_FORMAT(date,'%Y-%m-%d %H:%i') AS date FROM $this->DB_tableName WHERE id = '$_GET[id]'";
			$listing = $this->dbQuery->queryAllData($sql_allData);
		
			
			$sql = "UPDATE $this->DB_tableName SET viewed = '1' WHERE id = $_GET[id]";
			$this->dbQuery->query_to_db($sql);
			
			
			$this->smarty->assign('message', $listing);
			$this->smarty->assign('table_title', $this->pageHeader_read);		# a tábla fejléc neve			
			$this->smarty->display('admin/admin_message_read.tpl');
		}
		
		
		/**
		*@desc: levél törlése
		*@param:
		*@return:
		*/
		function Delete()
		{
			$this->delete_userDB($this->DB_tableName, $_GET['id']);
			# a törlés után 0-ra állitom a get id-t, hogy ne zavarjon be a lapozóban, ugyan azt a GET lekérést használják
			# nem okoz fenn akadást
			$_GET['id'] = 0;
			if($this->dbQuery->affectedRows)
				$this->smarty->assign('ok','Sikeres törlés!');
			else
				$this->smarty->assign('error','Nem sikerült a törlés!');
			$this->show();
			
		}
		
	}
	
?>