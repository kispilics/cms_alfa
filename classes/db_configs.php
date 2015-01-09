<?php

	
	/**
	*		Az adatbázis csatlakozást irja le. Felül a változóknál van lehetőség beállitani a csatlakozás adatait.
	*		Lentebb függvények használják ezeket a beállitásokat a csatlakozáshoz.
	*		
	*/
	class db_configs
	{
		
		var $connection;					# tartalmazza a csatlakozás adatait
		var $numRows;						# sorok számát tartlmazza
		var $affectedRows;					# megtudjuk lett e módositva, hozzáadva az adatbázishoz 
		var $last_insert_id;
		
		
		/**
		*@desc: Az osztály konstruktora. Végrehajtja a csatlakozást az adatbázishoz. 
		*		A csatlakozást a connection globális változóban tárolja.
		*@param:
		*@return:
		*/
		function db_configs($host, $user_db, $password_db, $database)
		{
			$connection = new mysqli($host, $user_db, $password_db, $database);

			if($connection->connect_errno > 0)
			{
				die('Unable to connect to database [' . $connection->connect_error . ']');
			}
			else
				mysqli_set_charset($connection, "utf8");
				$this->connection = $connection;
		}
		
		/**
		*@desc: lekérdezi, hozzáadja vagy frissiti az adatokat az adatbázisban, a SQL parancsoktól függően
		*@param: $sql változó, amely egy SQL lekérdezést tartalmaz
		*@return: a lekérdezés eredményével tér vissza
		*/
		function query_to_db($sql)
		{
			$connection = $this->connection;
			if(!$result = $connection->query($sql))
			{
				die('There was an error running the query [' . $connection->error . ']');
			}
			$this->fun_affected_rows();
			$this->last_insert_id = $connection->insert_id;
			return $result;
		}
		
		/**
		*@desc: törlés, módositás, új adat hozzáadása esetén ennek a változónak a értékével lehet ellenőrizni sikeres-e a művelet
		*		az affectedRows változót állitjuk be, melyet globálisan elérhetünk
		*@param:
		*@return:
		*/
		function fun_affected_rows()
		{
			$this->affectedRows = $this->connection->affected_rows;
		}
		
		/**
		*@desc: Egy adatot kér le az adatbázisból
		*@param: $sql - valamelyik kontrollertől kapjuk a lekérdezést
		*@return: $row - adattal tér vissza ha vannak sorok, egyébként false értékkel
		*/
		function queryOneData($sql)
		{
			$result = $this->query_to_db($sql);
			$this->resultNumRows($result);
			if($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				return $row;
			}
			else
				return false;
		}
		
		/**
		*@desc: a lekérdezés eredménye egy adat tömbö
		*@param: $sql - egy kontrollertől kapja a kérést
		*@return: $row - asszociativ tömbel tér vissza
		*/
		function queryAllData($sql)
		{
			$result = $this->query_to_db($sql);
			$this->resultNumRows($result);
			if($result->num_rows > 0)
			{
				for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
				return $set;
			}
			else
				return false;
		}
		
		
		/**
		*@desc: az első paraméter a tábla neve 2. az oszlop neve a 3. érték pedig az aminek az előfordulását keressük a táblában
		* például ha van olya adat az adatbázisban akkor figyelmeztetjük a felhasználót hogy irjon más nevet STB.
		*@param: $DB_tableName, $var, $value
		*return: TRUE vagy FALSE
		*/
		function CheckDoubleData($DB_tableName, $var, $value)
		{
			$this->queryAllData("SELECT * FROM $DB_tableName WHERE $var = '$value'");
			if($this->numRows > 0)
				return true; #echo 'van ilyen nev';
			else
				return false;
		}
		
		
		/**
		*@desc: megkapjuk, hogy a lekérdezésnek hány sora van
		*@param:
		*@return: 
		*/
		function resultNumRows($result)
		{
			$this->numRows = $result->num_rows;
		}
		
		/**
		*@desc: bezárom a csatlakozást
		*
		*/
		function db_close()
		{
			mysqli_close($this->connection);
		}
		
	}
	
	
?>