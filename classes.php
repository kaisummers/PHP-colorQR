<?php
/*
 * PHP-colorQR
 */
class colorQR
{
    	// Color combination array matrix
    	public function __construct()
    	{
        	$m = array_merge(range('a','z'), range('A', 'Z'), range('0', '9'), [62=>"NUL", 63=>"PAD"]);
        	$p = ['w','b','r','o','y','g','c','m'];
        	$n = 7;
        	foreach($m as $k=>$v)
        	{
            		$n = $n == 7 ? 0 : ++$n;
            		$a[$m[$k]] = $p[floor(($k)/8)]." ".$p[$n];
        	}
       		$GLOBALS['matrix'] = $a;
    	}
    
	// Create colorQR                    
	public static function create($d)
	{
		// Set width & height
		$w = 5;
		
        	// Encode as base62
		$c = new base62();
		$d = $c->encode($d);
		
		// Calculate Row width
        	$r = ceil(sqrt(strlen($d)*2));
		$f = $w*$r."px";
        
		// ColorQR Container
		$q = "<div class=\"cqr_cont\" style=\"width:$f!important;height:$f!important;\">";
  		
		// Make colorQR elements
		foreach(str_split($d) as $v)
		{
                	$e = explode(" ", $GLOBALS['matrix'][$v]);
                	$q .= "<span class=\"cqr ".$e[0]."\"></span><span class=\"cqr ".$e[1]."\"></span>";
        	}
        	$q .= "</div>";
		
		return $q;
	}	
}
 
/*
 * PHP-base62
 */
class base62
{
  	// Base62 Encode
	public static function encode($d)
	{
		$l = strlen($d);
		for ($i = 0; $i < $l; $i += 8) 
		{
			$c = substr($d, $i, 8);
			$o[] = str_pad(gmp_strval(gmp_init(ltrim(bin2hex($c), '0'), 16), 62), ceil((strlen($c) * 8)/6), '0', STR_PAD_LEFT);
	 	}
	 	return implode($o);
  	}
  	// Base62 Decode
  	public static function decode($d)
  	{
		$l = strlen($d);
		for ($i = 0; $i < $l; $i += 11) 
    		{
			$c = substr($d, $i, 11);
			$o[] = pack('H*', str_pad(gmp_strval(gmp_init(ltrim($c, '0'), 62), 16), floor((strlen($c) * 6)/8) * 2, '0', STR_PAD_LEFT));
		}
		return implode($o);
	}
}
