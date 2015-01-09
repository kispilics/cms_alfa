<?php


	require_once 'classes/formFactory.php';
	require_once 'classes/pageTurner.php';
	
	/**
	*	admin_user.php - vezérlő
	*
	*	Admin felülethez kontroller, melyel a felhaszálókat lehet kezelni.
	*
	*/
	class admin_user extends helperClass
	{
		
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
		
		# tábla neve
		var $DB_tableName = 'login'; 
		
		# a táblában a sorok megjelenitésének a száma
		var $listLimit = 5; 
		
		# az oldal lapozásához hány link jelenjen meg maximum
		var $linklimit = 6; 
		
		# tábla mezők neve
		var $fieldName = array('ID', 'Felhasználónév', 'Email cim', 'Jog', 'Módositás');
		
		# listázáskor az oldal feléc információja
		var $pageHeader_show = 'Felhasználók';
		
		# új elem hozzáadásakor az oldal fejléc információja
		var $pageHeader_addNew = 'Új felhasználó hozzáadása';
		
		# adatok szerkesztésekor az oldal fejléc infrmációja
		var $pageHeader_edit = 'Felhasználó szerkesztése';
		
		# a lapozó URL cime
		var $pageTurnerURL = 'admin_user/show/';
		
		# a felhasználó szerkesztése nevű formhoz az ACTION=URL
		var $formAction_edit = 'admin_user/edit/';
		
		# jelszó szerkeszétse formhoz  az ACTION=URL
		var $formAction_editPasswd = 'admin_user/edit_passwd/';
		
		# a felhasználó hozzáadása nevű formhoz az ACTION=URL
		var $formAction_addNew = 'admin_user/addNew/';
		
		# a törléséhez az URL
		var $Delete = 'admin_user/Delete/';
		
		# form mezők nevei asszociativ tömben
		var $formFieldsName = array('username' => 'Felhasználónév', 
									'email' => 'Email',
									'passwd' => 'Jelszó',
									'passwd_1' => 'Jelszó újra',
									'user_right' => 'Jog'
									);
									
		# SQL részlet, mely leírja, mely adatokat kell listázni
		var $sql_string = 'id, username, email, user_right';
		
		# SQL részlet és a oszlop nevek
		var $excel_export_SQL_and_column_name = array('sql'	=> 'username , email', 
											'column_name'	=>	array('NAME', 'EMAIL')
											);
											
		# a template-ben be kapcsoljuk az export linket
		var $excel_export = 'on';
		
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
		function admin_user()
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
			$this->smarty->assign('edit', $this->formAction_edit);
			$this->smarty->assign('delete', $this->Delete);
			$this->smarty->assign('table_title', $this->pageHeader_show);	# a tábla fejléc neve			
			$this->smarty->assign('excel_export', $this->excel_export);
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
				$form->input($this->formFieldsName['username'], 'text', 'username', $item['username'], 'id_username');
				$form->input($this->formFieldsName['email'], 'text', 'email', $item['email'], 'id_email', 'regex');
				$form->input('', 'submit', 'editButton', 'Módsitás', 'id_EditButton');
				$form->html_form .= $form->form_end;
				$form->link_next_form(($this->URL.'admin_user/edit_passwd/'), $_GET['id'], 'Jelszó módositása');
			}
		
			
			if($form->registFormCheck())
			{
				if($form->validate->EmailCheckRegex($_POST['email']))
				{
					$sql = "UPDATE $this->DB_tableName 
						SET username = '$_POST[username]', email = '$_POST[email]' WHERE id = $_GET[id]";
					$this->dbQuery->query_to_db($sql);
					
					if($this->dbQuery->affectedRows)
					{
						$_SESSION['ok_message'] = 'A módosítás sikeres.';
						header('Location:'.($this->URL).'admin_user/show/');
						die();
					}
					else
					{
						$this->smarty->assign('error', 'Az adat nem került be az adatbázisba!');
					}
					
				}
				else
				{
					$this->smarty->assign('error', 'Helytelen email cim!');
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
		*@desc: Jelszó módositásáért felős függvény.
		*@param: 
		*@return: 
		*/
		function edit_passwd()
		{
			$form = new formFactory;
			
			$form->form('post', ($this->formAction_editPasswd).($_GET['id']), 'editForm', 'idEditForm');
			$form->input($this->formFieldsName['passwd'], 'password', 'passwd', '', 'id_passwd', 'equal');
			$form->input($this->formFieldsName['passwd_1'], 'password', 'passwd_1', '', 'id_passwd_1', 'equal');
			$form->input('', 'submit', 'editPasswdButton', 'Módsitás', 'id_EditButton');
			$form->html_form .= $form->form_end;
			
			if($form->registFormCheck())
			{
				if($form->validate->passwd1_equal_passwd2($_POST['passwd'], $_POST['passwd_1']))
				{
					$sql = "UPDATE $this->DB_tableName 
						SET  passwd = MD5('$_POST[passwd]') WHERE id = $_GET[id]";
					$this->dbQuery->query_to_db($sql);
					
					if($this->dbQuery->affectedRows)
					{
						$_SESSION['ok_message'] = 'A módosítás sikeres.';
						header('Location:'.($this->URL).'admin_user/show/');
						die();
					}
					else
					{
						$this->smarty->assign('error', 'Az adat nem került be az adatbázisba!');
					}
					
				}
				else
				{
					$this->smarty->assign('error', 'A két jelszó mező tartalma nem egyforma!');
				}
			}
			elseif(!empty($form->error_message))
			{
				$this->smarty->assign('error', $form->error_message);
			}
			
			# adatok átadása a template kezelőnek
			$this->smarty->assign('form', $form);
			$this->smarty->assign('table_title', 'Jelszó módositás');		# a tábla fejléc neve			
			$this->smarty->display('admin/admin_edit.tpl');
			
		}
		
		/**
		*@desc: hozzáad egy sort a táblához, ellenőrzéseket végez az adatokon mielőtt az adatbázisba irja
		*@param:
		*@return:
		*/
		function addNew()
		{
			if(isset($_POST['username']))
				$var_username = $_POST['username'];
			else
				$var_username = '';
				
			if(isset($_POST['email']))
				$var_email = $_POST['email'];
			else
				$var_email = '';
		
			$form = new formFactory;
			
			$form->form('post', ($this->formAction_addNew), 'addForm', 'idAddForm');
			$form->input($this->formFieldsName['username'], 'text', 'username', $var_username, 'id_username');
			$form->input($this->formFieldsName['email'], 'text', 'email', $var_email, 'id_email', 'regex');
			$form->input($this->formFieldsName['passwd'], 'password', 'passwd', '', 'id_passwd', 'equal');
			$form->input($this->formFieldsName['passwd_1'], 'password', 'passwd_1', '', 'id_passwd_1', 'equal');			
			$form->input('', 'submit', 'userAddButton', 'Hozzáad', 'id_AddButton');
			$form->html_form .= $form->form_end;
			# adatok átadása a template kezelőnek
			$this->smarty->assign('form', $form);
				
			#ha minden adat rendbe van
			if($form->registFormCheck())
			{
				if($form->validate->EmailCheckRegex($_POST['email']))
				{
					if($form->validate->passwd1_equal_passwd2($_POST['passwd'], $_POST['passwd_1']))
					{
						if($this->dbQuery->CheckDoubleData($this->DB_tableName, 'username', $_POST['username']))
						{
							# hiba ha ilyen nev mar van
							$this->smarty->assign('error', 'A felhasználó név foglalat!');
						}
						else
						{
							if($this->dbQuery->CheckDoubleData($this->DB_tableName, 'email', $_POST['email']))
							{
								# hiba ha ilyen email mar van
								$this->smarty->assign('error', 'Az email cim foglalat!');
							}
							else
							{
								$sql = "INSERT INTO $this->DB_tableName (username, email, passwd, user_right, date) 
									VALUES ('$_POST[username]','$_POST[email]', MD5('$_POST[passwd]'), 'user', now())";
								$this->dbQuery->query_to_db($sql);
								
								if($this->dbQuery->affectedRows)
								{
									$_SESSION['ok_message'] = 'Sikeres hozzáadás.';
									header('Location:'.($this->URL).'admin_user/show/');
									die();
								}
								else
									$this->smarty->assign('error', 'Nem sikerült a hozzáadás!');
							}
						}
					}
					else
					{
						$this->smarty->assign('error', 'Nem egyformák a jelszavak!');
					}
				}
				else
				{
					$this->smarty->assign('error', 'Az email cim helytelen!');
				}
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
		*@desc: felhasználó törlése
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