<?php
/*
 * PHP-colorQR
 */
class colorQR
{
    	// Color combination matrix
    	const MATRIX = ['a'=>'w w','b'=>'w b','c'=>'w r','d'=>'w o','e'=>'w y','f'=>'w g','g'=>'w c','h'=>'w m',
        		'i'=>'b w','j'=>'b b','k'=>'b r','l'=>'b o','m'=>'b y','n'=>'b g','o'=>'b c','p'=>'b m',
                	'q'=>'r w','r'=>'r b','s'=>'r r','t'=>'r o','u'=>'r y','v'=>'r g','w'=>'r c','x'=>'r m',
                        'y'=>'o w','z'=>'o b','A'=>'o r','B'=>'o o','C'=>'o y','D'=>'o g','E'=>'o c','F'=>'o m',
                        'G'=>'y w','H'=>'y b','I'=>'y r','J'=>'y o','K'=>'y y','L'=>'y g','M'=>'y c','N'=>'y m',
                        'O'=>'g w','P'=>'g b','Q'=>'g r','R'=>'g o','S'=>'g y','T'=>'g g','U'=>'g c','V'=>'g m',
                        'W'=>'c w','X'=>'c b','Y'=>'c r','Z'=>'c o','0'=>'c y','1'=>'c g','2'=>'c c','3'=>'c m',
                        '4'=>'m w','5'=>'m b','6'=>'m r','7'=>'m o','8'=>'m y','9'=>'m g','NULL'=>'m c','RES'=>'m m' ];
    
	// Create colorQR                    
	public static function create($d)
	{
		// Set width & height
		$w = '5px';
		
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
                	$e = explode(" ", self::MATRIX[$v]);
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
