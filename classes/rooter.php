<?php
	
	require_once 'classes/helperClass.php';
	
	# az admin felület levédésére
	if(isset($_SESSION['log']) and $_SESSION['log']['username'] != '' and $_SESSION['log']['user_right'] == 'admin')  
	{
		require_once 'controllers/admin_articleType.php';
		require_once 'controllers/admin_user.php';
	}
	
	require_once 'controllers/admin_log.php';
	#require_once 'controllers/home.php';
	#require_once 'controllers/contact.php';
	require_once 'controllers/admin_newsletter.php';
	require_once 'controllers/admin_contact.php';
	require_once 'controllers/admin_news.php';
	#require_once 'controllers/news.php';
	require_once 'controllers/admin_header_rotator.php';

	
	/**
	*
	*		Rootolást hajtja végre. A kéréstől függően tölti be a megfelelő controllert.
	*		
	*/
	class rooter
	{
		
		/* =========================================== */
		/* ================ VÁLTOZÓK ================= */
		/* =========================================== */
		
		# a példányositandó osztály neve
		var $className;
		
		# függvénynév
		var $method;
		
		
		/* =========================================== */
		/* ================ FÜGGVÉNYEK =============== */
		/* =========================================== */
		
		/**
		*@desc: Konstruktor
		*		Rooter osztály, ami az URL-ből ($_GET[]) kapja meg az osztály és a függvény nevét
		*		ezekkel a paraméterekkel ellenőrzi, hogy létezik-e a példányositani kivánt osztály és a hivandó függvény.
		*		Hiba esetén alapértelmezett értékek töltödnek be.
		*@param:
		*@return:
		*/
		function rooter()
		{
			# get kérések ellenőrzése
			if(!empty($_GET['class']) and !empty($_GET['method']))
			{
				# fájl létezésének ellenőrzése
				if(file_exists('controllers/'. $_GET['class'] .'.php'))
				{	
					
					if(!empty(get_class_methods($_GET['class'])) AND $this->is_method())
					{
						$this->className = $_GET['class'];
						$this->method = $_GET['method'];
					}
					# alapértelmezett értékek
					else
					{
						if($this->wrongURL_Control());
						else
						{
							$this->className = 'home';
							$this->method = 'show';
						}
					}
				}
				# elgépelt URL vagy nem létező osztály estén a vezérlés
				else
				{
					if($this->wrongURL_Control());
					else
					{
						require_once 'errors/error404.html';
					}
				}
			}
			# alapértelmezett értékek
			else
			{
				$this->className = 'home';
				$this->method = 'show';
			}
		}
		
		
		/**
		*@desc: megvizsgálja, hogy az osztálynak van e ilyen függvénye
		*@param: $_GET['class'] , $_GET['method']
		*@return: TRUE / FALSE
		*/
		function is_method()
		{
			# vizsgálja van e ilyen függvénye az osztálynak
			$var_is_method = false;
			foreach(get_class_methods($_GET['class']) as $methodName)
				if($methodName == $_GET['method'])
					$var_is_method = true;	
			
			return $var_is_method;
		}
		
		
		/**
		*@desc: elgépelt URL esetén ha talál olyan rész sztinget ami illenszkedik egyik konrollerra akkor betölti
		*@param: $_GET['class']
		*@return: TRUE / FALSE / az osztály változóinak is ad értéket
		*/
		function wrongURL_Control()
		{
		
			if(strchr($_GET['class'], "admin"))
			{
				if(isset($_SESSION['log']) and $_SESSION['log']['username'] != '' and $_SESSION['log']['user_right'] == 'admin')
				{
					$this->className = 'admin_articleType';
					$this->method = 'show';
				}
				else
				{
					$this->className = 'admin_log';
					$this->method = 'show';
				}
				
				return true;
			}
			else
			{
				return false;
			}
			
		}
		
	}
	
?>