 <?php
 		//[["jan"]]
			$dep = $this->db->query("select * FROM departemen")->result();
		echo '<br />';
		echo "[[\"January sfsd\", 10], [\"February\", 8], [\"March\", 4], [\"April\", 13], [\"May\", 17], [\"June\",20]]";
		echo '<br />';
		echo '<br />';
		echo '<br />';
		$a = array();
		$c = array();
			echo "[";
		  	foreach($dep as $deps):
				//echo "[[\"January sfsd\", 10], [\"February\", 8], [\"March\", 4], [\"April\", 13], [\"May\", 17], [\"June\",20]]";
				echo "[\"".$deps->departemen."\", 10],";
				echo '<br />';

				$a[] = '['.$deps->departemen.'],';
				//$d2[] = array (intval($row['valx']),intval($row['valy']));
				$c[]= array(intval($deps->departemen));
			endforeach;
			echo "]";
		  
		 // echo $a[0];
		  echo '<br />';
		  
		  
		  echo json_encode($a);
		  echo '<br />';
		  echo json_encode($c);


		  
		  echo '<br />';
		  
		  
		  echo '<br />';
		  echo '<br />';
		  
		  $b = array('satu', 'dua');
		  echo json_encode($b);
		  echo '<br />';
		  echo json_encode(array($b))
		  //[["satu", 1], ["dua", 2]]
		  ?>