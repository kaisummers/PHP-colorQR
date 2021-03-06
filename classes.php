<?php
/*
 * PHP-colorQR
 */
class colorQR
{
	// Always runs
    	public function __construct()
    	{
        	// Width/Height of each segment
	    	$GLOBALS['w'] = 10; // Set size of color segments
		
		// CSS Styles
	    	$GLOBALS['c'] = "<style>.cqr_cont{border:3px dashed black}.cqr{display:inline-block;width:".$GLOBALS['w']."px;height:".$GLOBALS['w']."px;}.w{background-color:white}.b{background-color:black}.r{background-color:red}.o{background-color:orange}.y{background-color:yellow}.g{background-color:limegreen}.c{background-color:blue}.m{background-color:pink}</style>";
		
	    	// Array of shortcode colors & count
        	$p = ['w','b','r','o','y','g','c','m']; 
        	$n = count($p)-1;
        
        	// Create Base62 color map array 
        	foreach($m = array_merge(range('a','z'), range('A', 'Z'), range('0', '9'), [62=>"NUL", 63=>"PAD"]) as $k=>$v)
        	{
        		$a[$m[$k]] = $p[floor($k/8)]." ".$p[$n = $n == 7 ? 0 : ++$n];
        	}
       		$GLOBALS['m'] = $a; // Set global color map
    	}
    
	// Create colorQR                    
	public static function create($d)
	{	
        	// Encode as base62
		$c = new base62();
		$d = $c->encode($d);
		
		// Calculate Row width
		$l = strlen($d)*2;
		$r = ceil(sqrt($l));
        	$r = $r %2 == 0 ? $r : $r+1;
		$f = $GLOBALS['w']*$r."px";
		$p = ($r*$r-$l)/2;
  		
		// Make colorQR elements
		foreach(str_split($d) as $v)
		{
        		$e = explode(" ", $GLOBALS['m'][$v]);
        		$q .= "<span class=\"cqr ".$e[0]."\"></span><span class=\"cqr ".$e[1]."\"></span>";
        	}
    
        	// Pad remaining space
        	if($p > 0){
            		do
            		{   
                		$e = !isset($s) ? explode(" ", $GLOBALS['m']['PAD']) : explode(" ", $GLOBALS['m'][$s]);
                		$q .= "<span class=\"cqr ".$e[0]."\"></span><span class=\"cqr ".$e[1]."\"></span>";
                		$p--; $s = $s == 9 ? 0 : ++$s;
            		} 
			while ($p > 0);
        	}

		return $GLOBALS['c']."<div class=\"cqr_cont\" style=\"width:$f!important;height:$f!important;\">$q</div>";
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
