<?php
	
	/**
	*
	*	Lapozható tartalmat valósitja meg.
	*
	*/
	
	class pageTurner extends helperClass
	{
		# hány sora legyan a táblának
		var $listLimit;
		# max hány link jelenjen meg a lapozóban
		var $linklimit;
		# SQL sorokat tartalmazza
		var $rows;
		# lapozót tartalmazza
		var $page_turner;
		
		
		/**
		*@desc: konstruktor, örököl a helperClass osztálytól
		*@param:
		*@return:
		*/
		function pageTurner()
		{
			parent::helperClass();
		}
		
		/**
		*@desc: egy lapozót hoz létre az oldal számára
		*@param: $tableName - a tábla neve
		*@param: $countName - melyik oszlop szerint számolja a sorokat
		*@param: $sql_string - egy SQL részlet mely a megjeleniteni kivánt adatokat tartalmazza
		*@param: $listLimit - a táblában megjelenő sorok száma
		*@param: $linklimit - mennyi link jelenjen meg lapozáshoz
		*@param: $pageTurnerURL - az oldal lapozásához tartozó URL-t tartalmazza
		*@return:
		*/
		function set_pageTurner($tableName, $countName, $sql_string, $listLimit, $linklimit, $pageTurnerURL)
		{
		
			$sql_limit = "SELECT $sql_string FROM $tableName ORDER BY id DESC";
			
			$this->listLimit = $listLimit;
			$this->linklimit = $linklimit;
			
			$sql = "SELECT COUNT($countName) FROM $tableName";
			$num = $this->dbQuery->queryAllData($sql);
			$num = array_shift($num);
			$num = array_shift($num);
			
			$maxpage = ceil($num / $this->listLimit);
			
			
			$page = isset($_GET['id']) ? abs((int)$_GET['id']) : 1;
			
			if($page <= 0)
			{
				$page = 1;
			}
			else if ($page >= $maxpage)
			{
				$page = $maxpage;
			}
			 
			$offset = ($page-1) * $this->listLimit;
	
			$sql_limit = $sql_limit . " LIMIT $offset, $this->listLimit";
			
			$this->rows = $this->dbQuery->queryAllData($sql_limit);
			
		
			$linklimit2 = $this->linklimit / 2;
			$linkoffset = ($page > $linklimit2) ? $page - $this->linklimit / 2 : 0;
			$linkend = $linkoffset+$this->linklimit;
			 
			if ($maxpage - $linklimit2 < $page)
			{
				$linkoffset = $maxpage - $this->linklimit;
				if ($linkoffset < 0)
				{
						$linkoffset = 0;
				}
				$linkend = $maxpage;
			}
			
			if($page <= $maxpage)
			{
				$this->page_turner = '';
				if ($page > 1)
				{
					$this->page_turner .= '<a href="'.$pageTurnerURL.($page-1).'"> « </a>';
				}
				else
				{
					$this->page_turner .= '<a href="#" style="pointer-events:none;"> « </a>';
				}
				for ($i = 1 + $linkoffset; $i <= $linkend and $i <= $maxpage; $i++)
				{
					$style = ($i == $page) ? "color: white;background-color:black;font-weight:bold;" : "color: black;font-weight:bold;";
					$this->page_turner .= '<a href="'.$pageTurnerURL.($i).'" style="'.($style).'">'.($i).'</a>';
				}
				if ($page < $maxpage)
				{
					$this->page_turner .= '<a href="'.$pageTurnerURL.($page+1).'"> » </a>';
				} 
				else
				{
					$this->page_turner .= '<a href="#" style="pointer-events:none;"> » </a>';
				}
			}
		
		}
		
		
	}
		
?>