<?php
	
	/**
	*
	*	az admin bejelentkezését és kijelentkezését végzi
	*
	*/
	
	class admin_log extends helperClass
	{
		
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
	
		# táble neve
		var $DB_tableName = 'login';
		
		# a login form action paramétere
		var $loginFormAction = 'admin_log/click_login/';
		
		
		
		/* =========================================== */
		/* ================ FÜGGVÉNYEK =============== */
		/* =========================================== */
		
		/**
		*@desc: Az admin bejelentkező felüleletet jeleniti meg.
		*@param:
		*@return:
		*/
		function show()
		{
			$this->smarty->assign('action', $this->loginFormAction);
			$this->smarty->display('admin/admin_login.tpl');
		
		}
		
		
		/**
		*@desc: Bejelentkezést hajtja végre.
		*@param:
		*@return:
		*/
		function click_login()
		{
			# ide nem ártana egy kis védelem
			$sql = "SELECT id, username, user_right, DATE_FORMAT(date,'%Y-%m-%d %H:%i') AS date FROM login 
					WHERE username = '$_POST[login]' and passwd = MD5('$_POST[pass]') and user_right = 'admin'";
			$row = $this->dbQuery->queryAllData($sql);
			
			if($this->dbQuery->numRows)
			{
				$row = array_shift($row);
				$_SESSION['log'] = $row;
				
				# az utolsó bejelentkezés dátumát frissiti
				$id = $_SESSION['log']['id'];
				$sql_update = "UPDATE login SET date = now() WHERE id = '$id'";
				$this->dbQuery->query_to_db($sql_update);
				
				header('Location:'. $this->URL .'admin_articleType/show/');
				die();
			}
			else
			{
				header('Location:'. $this->URL .'admin_log/show/');
				die();
			}
		
		}
		
		
		/**
		*@desc: Kijelentkezést hajtja végre.
		*@param:
		*@return:
		*/
		function click_logout()
		{
			/*
			
				session törlése
			
			*/
			unset($_SESSION['log']);
			
			header('Location:'. $this->URL .'admin_log/show/');
			die();
		}
		
		/*
		
			mikor a loginra kattint megnezi h van e olyan admin, ha van akkor betölti neki az admin felületet
			kellenek a formról az adatok utánna egy sql lekérdezés, ha van, jók az adatok akkor beléptetés
			
		*/
		
	
	}

?>