<?php
class Utils
{
	/*Functions which has to be global in later stage*/	
	static function createUrlRequest($get,$removeArr)
	{
		$q_str="?";
		$amp = "&";
		$element_number=0;
		foreach($removeArr as $value)
		{
			unset($get[$value]);
		}
		
		foreach($get as $key=>$value)
		{
			$element_number++;
			if(count($get)==$element_number)
				$amp="";
				
			$q_str .= $key."=".$value.$amp;
		}
		return $q_str;
	}
	
	static function createLimitString($ipp,$p,$n_rows)
	{
		$lim_str = "";
		if($n_rows>$ipp)
		{
			$low_limit = 0;
			$up_limit = $ipp;
			if($p>1)
			{
				$up_limit = $p*$ipp;
				$low_limit = $up_limit-$ipp;
			}
			$lim_str = " LIMIT ".$low_limit.",".$ipp." ";
			
		}
		return $lim_str;
	}
	
	static function drawPagination($ipp,$p,$n_rows,$around)
	{
		if($n_rows>$ipp)
		{
			$all_pages = ceil($n_rows/$ipp);
			$curr_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$full_url = $curr_url.Utils::createUrlRequest($_GET,array('page'));
			
			echo "<ul>";	
				/*first/previous page*/
				if($p>1)
				{
					echo "<li><a href='".$full_url."&page=1'>Първа</a></li>";
					$prev = $p-1;
					echo "<li><a href='".$full_url."&page=".$prev."'>Предишна</a></li>";
				}
				for($i=$p-$around;$i<=$p+$around;$i++)
				{
					$selected = "";
					if($i>0&&$i<=$all_pages)
					{
						if($p==$i)
							$selected = "class='selected'";
						echo "<li ".$selected."><a href='".$full_url."&page=".$i."'>".$i."</a></li>";
					}
				}				
				/*last/next page*/
				if($p<$all_pages)
				{
					$next= $p+1;
					echo "<li><a href='".$full_url."&page=".$next."'>Следваща</a></li>";
					echo "<li><a href='".$full_url."&page=".$all_pages."'>Последна</a></li>";
				}
			echo "</ul>";
		}
	}
}
?>