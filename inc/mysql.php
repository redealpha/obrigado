<?php
	define("EZSQL_DB_USER", "kiabhcom_kia");
	define("EZSQL_DB_PASSWORD", "Alpha2016Barao");
	define("EZSQL_DB_NAME", "kiabhcom_kiabrisa122017");
	define("EZSQL_DB_HOST", "localhost");
	define("EZSQL_DB_CHARSET", "utf8");
			
	define("EZSQL_VERSION","1.01");
	define("OBJECT","OBJECT",true);
	define("ARRAY_A","ARRAY_A",true);
	define("ARRAY_N","ARRAY_N",true);
	ini_set('display_errors','Off');
	ini_set('error_reporting', E_ALL );
	
	class db {
	
	
		function db($dbuser, $dbpassword, $dbname, $dbhost)
		{
	
			$this->dbh = @mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
			
			if ( ! $this->dbh )
			{
				$this->print_error("<ol><b>Erro na conexão!</b><li>Login, senha ou host inválido!</ol>");
			}
			@mysqli_set_charset($this->dbh, "utf8");
		}
		
	
		function select($db)
		{
			if ( !@mysql_select_db($db,$this->dbh))
			{
				$this->print_error("<ol><b>Erro ao selecionar base de dados <u>$db</u>!</b><li>Base inesistente ou conexão inválida!</ol>");
			}
		}
	

		function print_error($str = "")
		{
			
			if ( !$str ) $str = mysqli_error($this->dbh);
			
			print "<blockquote><font face=arial size=2 color=ff0000>";
			print "<b>SQL/DB Erro --</b> ";
			print "[<font color=000077>$str</font>]";
			print "</font></blockquote>";	
		}
		function sql_injection($dados){
			if(!is_array($dados)){
				$dados= @mysqli_real_escape_string($this->dbh, $dados);
			} else {
				$arr = $dados;
				foreach ($arr as $key => $value) {
					$key = @mysqli_real_escape_string($this->dbh, $key);
					$value = @mysqli_real_escape_string($this->dbh,$value);
					$dados[$key] = $value;
				}
			}
			return $dados;
			
		}

		function insert_id(){
			return @mysqli_insert_id($this->dbh);
		}
		
		function query($query, $output = OBJECT) 
		{
			
			$this->func_call = "\$db->query(\"$query\", $output)";		
			
			$this->last_result = null;
			$this->col_info = null;
	
			$this->last_query = $query;
			
			$this->result = mysqli_query($this->dbh,$query);
	
			if ( mysqli_error($this->dbh) ) 
			{
				
				$this->print_error();
	
			}
			else
			{
	
				if ( $this->result )
				{
	
					
					$i=0;
					while ($i < @mysqli_num_fields($this->result))
					{
						$this->col_info[$i] = @mysqli_fetch_field($this->result);
						$i++;
					}
	
					
					$i=0;
					while ( $row = @mysqli_fetch_object($this->result) )
					{ 
	
						$this->last_result[$i] = $row;
						
						$i++;
					}
					
					@mysqli_free_result($this->result);
	
					if ( $i )
					{
						return true;
		
					}
					else
					{
						return false;
					}
	
				}
	
			}
		}
		
		function insert($table, array $dados){
			$dados = $this->sql_injection($dados);
			$campos = implode(', ', array_keys($dados) );
			$valores = "'".implode("', '", $dados)."'";
			$query = "INSERT INTO {$table} ({$campos}) VALUES ({$valores})";
			return $this->query($query);
		}
		function update($table, array $dados, $where = null){
			$dados = $this->sql_injection($dados);
			foreach ($dados as $key => $value ) {
				$fields[] = "{$key} = '{$value}'";
			}
			$fields = implode(', ', $fields);
			$where = ($where) ? " WHERE {$where}" : null;
			$query = "UPDATE {$table} SET {$fields}{$where}";
			return $this->query($query);
		}

		
		function get_var($query=null,$x=0,$y=0)
		{
			
			$this->func_call = "\$db->get_var(\"$query\",$x,$y)";
			
			if ( $query )
			{
				$this->query($query);
			}
			
			if ( $this->last_result[$y] )
			{
				$values = array_values(get_object_vars($this->last_result[$y]));
			}
			
			return $values[$x]?$values[$x]:null;
		}
	
		
		function get_row($query=null,$y=0,$output=OBJECT)
		{
			
			$this->func_call = "\$db->get_row(\"$query\",$y,$output)";
			
			if ( $query )
			{
				$this->query($query);
			}
	
			if ( $output == OBJECT )
			{
				return $this->last_result[$y]?$this->last_result[$y]:null;
			}
			elseif ( $output == ARRAY_A )
			{
				return $this->last_result[$y]?get_object_vars($this->last_result[$y]):null;	
			}
			elseif ( $output == ARRAY_N )
			{
				return $this->last_result[$y]?array_values(get_object_vars($this->last_result[$y])):null;
			}
			else
			{
				$this->print_error(" \$db->get_row(string query,int offset,output type) -- Tipo de saida deve ser do tipo: OBJECT, ARRAY_A, ARRAY_N ");	
			}
	
		}
	

		function get_col($query=null,$x=0)
		{
			
			if ( $query )
			{
				$this->query($query);
			}
			
			for ( $i=0; $i < count($this->last_result); $i++ )
			{
				$new_array[$i] = $this->get_var(null,$x,$i);
			}
			
			return $new_array;
		}
	
		
		function get_results($query=null, $output = OBJECT)
		{
			
			$this->func_call = "\$db->get_results(\"$query\", $output)";
			
			if ( $query )
			{
				$this->query($query);
			}		
	
			if ( $output == OBJECT )
			{
				return $this->last_result; 
			}
			elseif ( $output == ARRAY_A || $output == ARRAY_N )
			{
				if ( $this->last_result )
				{
					$i=0;
					foreach( $this->last_result as $row )
					{
						
						$new_array[$i] = get_object_vars($row);
						
						if ( $output == ARRAY_N )
						{
							$new_array[$i] = array_values($new_array[$i]);
						}
	
						$i++;
					}
				
					return $new_array;
				}
				else
				{
					return null;	
				}
			}
		}
	
	
		
		function get_col_info($info_type="name",$col_offset=-1)
		{
	
			if ( $this->col_info )
			{
				if ( $col_offset == -1 )
				{
					$i=0;
					foreach($this->col_info as $col )
					{
						$new_array[$i] = $col->{$info_type};
						$i++;
					}
					return $new_array;
				}
				else
				{
					return $this->col_info[$col_offset]->{$info_type};
				}
			
			}
			
		}
	
	
	
		function vardump($mixed)
		{

			echo "<blockquote><font color=000090>";
			echo "<pre><font face=arial>";
			
			if ( ! $this->vardump_called )
			{
				echo "<font color=800080><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Variable Dump..</b></font>\n\n";
			}
	
			print_r($mixed);	
			echo "\n\n<b>Última consulta:</b> ".($this->last_query?$this->last_query:"NULL")."\n";
			echo "<b>Última chamada de função::</b> " . ($this->func_call?$this->func_call:"None")."\n";
			echo "<b>Úlrima linha retornada:</b> ".count($this->last_result)."\n";
			echo "</font></pre></font></blockquote>";
			echo "\n<hr size=1 noshade color=dddddd>";
			
			$this->vardump_called = true;

		}
	
		function dumpvars($mixed)
		{
			$this->vardump($mixed);	
		}
	
		
		function debug()
		{
			
			echo "<blockquote>";
	
			if ( ! $this->debug_called )
			{
				echo "<font color=800080 face=arial size=2><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Debug..</b></font><p>\n";
			}
			echo "<font face=arial size=2 color=000099><b>Query --</b> ";
			echo "[<font color=000000><b>$this->last_query</b></font>]</font><p>";
	
				echo "<font face=arial size=2 color=000099><b>Resultado da Consulta..</b></font>";
				echo "<blockquote>";
				
			if ( $this->col_info )
			{
				
				
				echo "<table cellpadding=5 cellspacing=1 bgcolor=555555>";
				echo "<tr bgcolor=eeeeee><td nowrap valign=bottom><font color=555599 face=arial size=2><b>(row)</b></font></td>";
	
	
				for ( $i=0; $i < count($this->col_info); $i++ )
				{
					echo "<td nowrap align=left valign=top><font size=1 color=555599 face=arial>{$this->col_info[$i]->type} {$this->col_info[$i]->max_length}<br><font size=2><b>{$this->col_info[$i]->name}</b></font></td>";
				}
	
				echo "</tr>";
	
	
			if ( $this->last_result )
			{
	
				$i=0;
				foreach ( $this->get_results(null,ARRAY_N) as $one_row )
				{
					$i++;
					echo "<tr bgcolor=ffffff><td bgcolor=eeeeee nowrap align=middle><font size=2 color=555599 face=arial>$i</font></td>";
	
					foreach ( $one_row as $item )
					{
						echo "<td nowrap><font face=arial size=2>$item</font></td>";	
					}
	
					echo "</tr>";				
				}
	
			} 
			else
			{
				echo "<tr bgcolor=ffffff><td colspan=".(count($this->col_info)+1)."><font face=arial size=2>Sem resultados</font></td></tr>";			
			}
	
			echo "</table>";		
	
			} 
			else
			{
				echo "<font face=arial size=2>Sem resultados</font>";			
			}
			
			echo "</blockquote></blockquote><hr noshade color=dddddd size=1>";
			
			
			$this->debug_called = true;
		}
	
	
	}

$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

?>
