<?php
namespace Cheope_ns\fw;
require_once("Creator.tra.php");
/*=======================================================================
// File: 				JPGRAPH_BAR.PHP
// Description: 		Bar plot extension for JpGraph
// Created: 			2001-01-08
//	Last edit:			14/09/01 13:35
// Author:				Johan Persson (johanp@aditus.nu)
// Ver:					$Id: jpgraph_bar.php,v 1.5 2001/09/23 20:31:37 ljp Exp $
//
// License:				This code is released under GPL 2.0
//
//========================================================================
*/

//===================================================
// CLASS Gradient
// Description: Handles gradient fills. This is to be
// considered a "friend" class of Class Image. The
// Gradient takes care of productin a gradient fill for
// the bars.
//===================================================
class Gradient {
	var $img=null;
//---------------
// CONSTRUCTOR
	function __construct(&$img) {
		$this->img = $img;
	}

//---------------
// PUBLIC METHODS	
	// Produce a gradient filled rectangle with a smooth transition between
	// two colors.
	// ($xl,$yt) 	Top left corner
	// ($xr,$yb)	Bottom right
	// $from_color	Starting color in gradient
	// $to_color	End color in the gradient
	// $style		Which way is the gradient oriented?
	function filledRectangle($xl,$yt,$xr,$yb,$from_color,$to_color,$style=1) {
		switch( $style ) {	
		case 1:  // HORIZONTAL
			$steps = $xr-$xl;
			$this->getColArray($from_color,$to_color,$steps,$colors);
			for($x=$xl; $x<=$xl+$steps; ++$x) {
				$this->img->current_color = $colors[$x-$xl];
				$this->img->Line($x,$yt,$x,$yb);
			}
			break;
		case 2: // VERTICAL
			$steps = $yb-$yt;	
			$this->getColArray($from_color,$to_color,$steps,$colors);
			for($y=$yt; $y<$yt+$steps; ++$y) {
				$this->img->current_color = $colors[$y-$yt];
				$this->img->Line($xl,$y,$xr,$y);
			}
			break;
		case 3: // VERTICAL FROM MIDDLE
			$steps = ($yb-$yt)/2;
			$this->getColArray($from_color,$to_color,$steps,$colors);
			for($y=$yt, $i=0; $y<$yt+$steps; ++$y, ++$i) {
				$this->img->current_color = $colors[$i];
				$this->img->Line($xl,$y,$xr,$y);
			}
			--$i;
			for($y=$yt+$steps; $i>0; ++$y, --$i) {
				$this->img->current_color = $colors[$i];
				$this->img->Line($xl,$y,$xr,$y);
			}
			$this->img->Line($xl,$y,$xr,$y);
			break;
		case 4: // HORIZONTAL FROM MIDDLE
			$steps = ($xr-$xl)/2;
			$this->GetColArray($from_color,$to_color,$steps,$colors);
			for($x=$xl, $i=0; $x<$xl+$steps; ++$x, ++$i) {
				$this->img->current_color = $colors[$i];
				$this->img->Line($x,$yb,$x,$yt);
			}
			--$i;
			for($x=$xl+$steps; $i>0; ++$x, --$i) {
				$this->img->current_color = $colors[$i];
				$this->img->Line($x,$yb,$x,$yt);
			}
			$this->img->Line($x,$yb,$x,$yt);		
			break;
		case 5: // Rectangle
			$steps = floor(min(($yb-$yt)+1,($xr-$xl)+1)/2);	
			$this->getColArray($from_color,$to_color,$steps,$colors);
			$dx = ($xr-$xl)/2;
			$dy = ($yb-$yt)/2;
			$x=$xl;$y=$yt;$x2=$xr;$y2=$yb;
			for($x=$xl, $i=0; $x<$xl+$dx && $y<$yt+$dy ; ++$x, ++$y, --$x2, --$y2, ++$i) {
				assert($i<count($colors));
				$this->img->current_color = $colors[$i];			
				$this->img->rectangle($x,$y,$x2,$y2);
			}
			$this->img->line($x,$y,$x2,$y2);
			break;
		case 6: // HORIZONTAL WIDER MIDDLE
			$steps = ($xr-$xl)/3;
			$this->getColArray($from_color,$to_color,$steps,$colors);
			for($x=$xl, $i=0; $x<$xl+$steps; ++$x, ++$i) {
				$this->img->current_color = $colors[$i];
				$this->img->line($x,$yb,$x,$yt);
			}
			--$i;
			$this->img->current_color = $colors[$i];
			for($x=$xl+$steps; $x<$xl+2*$steps; ++$x) {
				$this->img->Line($x,$yb,$x,$yt);
			}
			for($x=$xl+2*$steps; $i>=0; ++$x, --$i) {
				$this->img->current_color = $colors[$i];				
				$this->img->line($x,$yb,$x,$yt);		
			}				
			break;
		case 7: // VERTICAL WIDER MIDDLE
			$steps = ($yb-$yt)/3;
			$this->getColArray($from_color,$to_color,$steps,$colors);
			for($y=$yt, $i=0; $y<$yt+$steps; ++$y, ++$i) {
				$this->img->current_color = $colors[$i];
				$this->img->line($xl,$y,$xr,$y);
			}
			--$i;
			$this->img->current_color = $colors[$i];
			for($y=$yt+$steps; $y<$yt+2*$steps; ++$y) {
				$this->img->line($xl,$y,$xr,$y);
			}
			for($y=$yt+2*$steps; $i>=0; ++$y, --$i) {
				$this->img->current_color = $colors[$i];				
				$this->img->line($xl,$y,$xr,$y);		
			}				
			break;
		default:
			die("JpGraph Error: Unknown gradient style (=$style).");
			break;
		}
	}

//---------------
// PRIVATE METHODS	
	// Add to the image color map the necessary colors to do the transition
	// between the two colors using $numcolors intermediate colors
	function getColArray($from_color,$to_color,$arr_size,&$colors,$numcols=100) {
		if( $arr_size==0 ) return;
		// If color is give as text get it's corresponding r,g,b values
		$from_color = $this->img->rgb->Color($from_color);
		$to_color = $this->img->rgb->Color($to_color);
		
		$rdelta=($to_color[0]-$from_color[0])/$numcols;
		$gdelta=($to_color[1]-$from_color[1])/$numcols;
		$bdelta=($to_color[2]-$from_color[2])/$numcols;
		$stepspercolor	= $numcols/$arr_size;
		$prevcolnum	= -1;
		for ($i=0; $i<$arr_size; ++$i) {
			$colnum	= floor($stepspercolor*$i);
			if ( $colnum == $prevcolnum ) 
				$colors[$i]	= $colidx;
			else {
				$r = floor($from_color[0] + $colnum*$rdelta);
				$g = floor($from_color[1] + $colnum*$gdelta);
				$b = floor($from_color[2] + $colnum*$bdelta);
				$colidx = $this->img->rgb->allocate(sprintf("#%02x%02x%02x",$r,$g,$b));
				$colors[$i]	= $colidx;
			}
			$prevcolnum = $colnum;
		}
	 }	
} // Class


//===================================================
// CLASS BarPlot
// Description: Main code to produce a bar plot 
//===================================================
class BarPlot extends Plot {
	use Creator;
	
	var $width=0.4; // in percent of major ticks
	var $fill_color=false; // No fill default
	var $ymin=0;
	var $grad=false,$grad_style=1;
	var $grad_fromcolor=array(50,50,200),$grad_tocolor=array(255,255,255);
	var $bar_shadow=false;
	var $bar_shadow_color="black";
	var $bar_shadow_hsize=3,$bar_shadow_vsize=3;	
	var $show_value=false,$show_value_format="%d",$show_value_angle=0;
	var $show_value_ff=JPGRAPH_FF_FONT1,$show_value_fs=JPGRAPH_FS_NORMAL,$show_value_fsize=12;
	var $show_value_color="black",$show_value_margin=3;
	
//---------------
// CONSTRUCTOR
	function __construct(&$datay) {
		parent::__construct($datay);		
		++$this->numpoints;
	}

//---------------
// PUBLIC METHODS	
	
	// Set a drop shadow for the bar (or rather an "up-right" shadow)
	function setShadow($f=true,$color="black",$hsize=3,$vsize=3) {
		$this->bar_shadow=$f;
		$this->bar_shadow_color=$color;
		$this->bar_shadow_vsize=$vsize;
		$this->bar_shadow_hsize=$hsize;
		
		// Adjust the value margin to compensate for shadow
		$this->show_value_margin += $vsize;
	}
	
	// Display the value of the bar at the top of bar
	function showValue($f=true) {
		$this->show_value = $f;	
	}
	
	function setValueFormat($format="%d",$angle=0) {
		$this->show_value_format = $format;
		$this->show_value_angle = $angle;
	}
	
	function setValueFont($ff="FF_FONT1",$fs="FS_NORMAL",$size=12) {
		$this->show_value_ff=$ff;
		$this->show_value_fs=$fs;
		$this->show_value_fsize=$size;
	}
	
	function setValueColor($color) {
		$this->show_value_color=$color;
	}
	
	function setValueMargin($m) {
		$this->show_value_margin=$m;
	}

	function setYStart($y) {	
		die("JpGraph Error: Deprecated function SetYStart. Use SetYMin() instead.");
	}
	
	function setYMin($y) {
		$this->ymin=$y;
	}
	
	function legend(&$graph) {
		if( $this->fill_color && $this->legend!="" )
			$graph->legend->Add($this->legend,$this->fill_color);		
	}

	// Gets called before any axis are stroked
	function preStrokeAdjust(&$graph) {
		parent::preStrokeAdjust($graph);
		// Center each bar within each major tick
		$graph->xaxis->scale->ticks->setXLabelOffset(0.5);
		$graph->setTextScaleOff(0.5-$this->width/2);						
		$graph->xaxis->scale->ticks->supressTickMarks();
	}

	function min() {
		$m = parent::min();
		$m[1]=min($m[1],$this->ymin);
		return $m;	
	}
	
	function setWidth($w) {
		assert($w > 0 && $w <= 1.0);
		$this->width=$w;
	}
	
	function setNoFill() {
		$this->grad = false;
		$this->fill_color=false;
	}
		
	function setFillColor($c) {
		if(is_array($c)) {
			for($i=0;$i<count($c);++$i) {
				$this->fill_color[$i]=$c[$i];
			}
		} else {
			$this->fill_color=$c;
		}
	}
	
	function setFillGradient($from_color,$to_color,$style) {
		$this->grad=true;
		$this->grad_fromcolor=$from_color;
		$this->grad_tocolor=$to_color;
		$this->grad_style=$style;
	}
	
	function stroke(&$img,&$xscale,&$yscale) { 
		$img->setColor($this->color);
		$img->setLineWeight($this->weight);
		$numbars=count($this->coords[0]);
		if( $yscale->scale[0] >= 0 )
			$zp=$yscale->scale_abs[0]; 
		else
			$zp=$yscale->translate(0.0);
		$abswidth=round($this->width*$xscale->scale_factor,0);
		for($i=0; $i<$numbars; $i++) {
			
			$x=$xscale->translate($i+1);
			$pts=array(
				$x,$zp,
				$x,$yscale->translate($this->coords[0][$i]),
				$x+$abswidth,$yscale->translate($this->coords[0][$i]),
				$x+$abswidth,$zp);
			if( $this->grad ) {
				$grad = Creator::create("Gradient",STRING_NULL,$img);
				$grad->filledRectangle($pts[2],$pts[3],
											  $pts[6],$pts[7],
											  $this->grad_fromcolor,$this->grad_tocolor,$this->grad_style);				
			}
			elseif( $this->fill_color ) {
				if(is_array($this->fill_color)) {
					$img->setColor($this->fill_color[$i % $numbars]);
				} else {
					$img->setColor($this->fill_color);
				}
				$img->filledPolygon($pts,4);
				$img->setColor($this->color);
			}
			
			// Remember value of this bar
			$val=$this->coords[0][$i];
			
			if( $this->bar_shadow ) {
				$ssh = $this->bar_shadow_hsize;
				$ssv = $this->bar_shadow_vsize;
				// Create points to create a "upper-right" shadow
				if( $val > 0 ) {
					$sp[0]=$pts[6];		$sp[1]=$pts[7];
					$sp[2]=$pts[4];		$sp[3]=$pts[5];
					$sp[4]=$pts[2]+$ssh;	$sp[5]=$pts[3];
					$sp[6]=$pts[2]+$ssh;	$sp[7]=$pts[3]-$ssv;
					$sp[8]=$pts[4]+$ssh;	$sp[9]=$pts[5]-$ssv;
					$sp[10]=$pts[6]+$ssh;	$sp[11]=$pts[7];
				} 
				elseif( $val<0 ) {
					$sp[0]=$pts[4];		$sp[1]=$pts[5];
					$sp[2]=$pts[6];		$sp[3]=$pts[7];
					$sp[4]=$pts[0]+$ssh;	$sp[5]=$pts[1];
					$sp[6]=$pts[0]+$ssh;	$sp[7]=$pts[1]-$ssv;
					$sp[8]=$pts[6]+$ssh;	$sp[9]=$pts[7]-$ssv;
					$sp[10]=$pts[4]+$ssh;	$sp[11]=$pts[5];
				}
			
				$img->setColor($this->bar_shadow_color);
				$img->filledPolygon($sp,4);
			}
					
			if( $this->show_value) {
				$sval=sprintf($this->show_value_format,$val);
				$txt = Creator::create("Text",STRING_NULL,$sval);
				$txt->setFont($this->show_value_ff,$this->show_value_fs,$this->show_value_fsize);
				$txt->setColor($this->show_value_color);
				
				if( $val >= 0 ) {
					$txt->pos($pts[2]+($pts[4]-$pts[2])/2,$pts[3]-$this->show_value_margin);
					$txt->align("center","bottom");
				}
				else {
					$txt->pos($pts[2]+($pts[4]-$pts[2])/2,$pts[3]+$this->show_value_margin);
					$txt->align("center","top");
				}
				$txt->setOrientation($this->show_value_angle);
				$txt->stroke($img);			
			}
			
			// Create the client side image map
			$this->csimareas.= "<area shape=\"rect\" coords=\"";
			// Hmmm, this is fishy.  Fixes a bug in Opera whereby if Y2<Y1 or X2<X1 the csim doesn't work
			if ($pts[3] < $pts[7]) {
				if ($pts[2] < $pts[6]) 
					$this->csimareas .= "$pts[2], $pts[3], $pts[6], $pts[7]\"";
				else 
					$this->csimareas .= "$pts[6], $pts[3], $pts[2], $pts[7]\"";
			} else {
				if ($pts[2] < $pts[6]) 
					$this->csimareas .= "$pts[2], $pts[7], $pts[6], $pts[3]\"";
				else 
					$this->csimareas .= "$pts[6], $pts[7], $pts[2], $pts[3]\"";
			}
			if(isset($this->csimtargets[$i]))
			$this->csimareas .= " href=\"".$this->csimtargets[$i]."\"";
			if( !empty($this->csimalts[$i]) ) {
				$sval=sprintf($this->csimalts[$i],$this->coords[0][$i]);
				$this->csimareas .= " alt=\"$sval\"";
			}
			$this->csimareas .= ">\r\n";
			$img->polygon($pts,4);
		}
		return true;
	}
} // Class

//===================================================
// CLASS GroupBarPlot
// Description: Produce grouped bar plots
//===================================================
class GroupBarPlot extends BarPlot {
	var $plots;
	var $width=0.7;
	var $nbrplots=0;
	var $numpoints;
//---------------
// CONSTRUCTOR
	function __construct($plots) {
		$this->plots = $plots;
		$this->nbrplots = count($plots);
		$this->numpoints = $plots[0]->numpoints;
	}

//---------------
// PUBLIC METHODS	
	function legend(&$graph):void {
		foreach( $this->plots as $p )
			$p->legend($graph);
	}
	
	function min() {
		//return array(0,$this->ymin);	// Must be adjusted for log plots
		list($xmin,$ymin) = $this->plots[0]->min();
		foreach($this->plots as $p) {
			list($xm,$ym) = $p->Min();
			$xmin = max($xmin,$xm);
			$ymin = min($ymin,$ym);
		}
		return array($xmin,$ymin);		
	}
	
	function max() {
		list($xmax,$ymax) = $this->plots[0]->max();
		foreach($this->plots as $p) {
			list($xm,$ym) = $p->max();
			$xmax = max($xmax,$xm);
			$ymax = max($ymax,$ym);
		}
		return array($xmax,$ymax);
	}
	
	function getCSIMareas() {
		foreach($this->plots as $p) {
			$csimareas.= $p->csimareas;
		}
		return $csimareas;
	}
	
	// Stroke all the bars next to each other
	function stroke(&$img,&$xscale,&$yscale) { 
		$tmp=$xscale->off;
		for( $i=0; $i<count($this->plots); ++$i ) {
			$this->plots[$i]->ymin=$this->ymin;
			$this->plots[$i]->setWidth($this->width/$this->nbrplots);
			$xscale->off = $tmp+$i*round($xscale->ticks->major_step*$xscale->scale_factor*$this->width/$this->nbrplots);
			$this->plots[$i]->stroke($img,$xscale,$yscale);
		}
		$xscale->off=$tmp;
	}
} // Class

//===================================================
// CLASS AccBarPlot
// Description: Produce accumulated bar plots
//===================================================
class AccBarPlot extends BarPlot {
	use Creator;
	
	var $plots=null,$nbrplots=0,$numpoints=0;
//---------------
// CONSTRUCTOR
	function __construct($plots) {
		$this->plots = $plots;
		$this->nbrplots = count($plots);
		$this->numpoints = $plots[0]->numpoints;		
	}

//---------------
// PUBLIC METHODS	
	function legend(&$graph) {
		foreach( $this->plots as $p )
			$p->legend($graph);
	}

	function max() {
		$accymax=0;
		list($xmax,$dummy) = $this->plots[0]->max();
		foreach($this->plots as $p) {
			list($xm,$ym) = $p->max();
			$xmax = max($xmax,$xm);
			$accymax += $ym;
		}
		$accymax = 0;
		for( $i = 0; $i < $xmax; $i++ ) {
			$accy = 0;
			for( $j = 0; $j < $this->nbrplots; $j++ ) {
				$accy += $this->plots[ $j ]->coords[0][$i];
			}
			if( $accy > $accymax )
				$accymax = $accy;
		}
		return array($xmax,$accymax);
	}

	function min() {
		$accymin=0;
		list($xmin,$dummy) = $this->plots[0]->Min();
		foreach($this->plots as $p) {
			list($xm,$ym) = $p->min();
			$xmin = max($xmin,$xm);
			$accymin += $ym;
		}
		return array($xmin,$accymin);		
	}

	// Method description
	function stroke(&$img,&$xscale,&$yscale) {
		$img->setLineWeight($this->weight);
		for($i=0; $i<$this->numpoints-1; $i++) {
			$accy = 0;
			$accy_neg = 0; 
			for($j=0; $j<$this->nbrplots; ++$j ) {				
				$img->setColor($this->plots[$j]->color);
				if ($this->plots[$j]->coords[0][$i] > 0) {
					$yt=$yscale->translate($this->plots[$j]->coords[0][$i]+$accy);
					$accyt=$yscale->translate($accy);
					$accy+=$this->plots[$j]->coords[0][$i];
				} else {
					$yt=$yscale->translate($this->plots[$j]->coords[0][$i]+$accy_neg);
					$accyt=$yscale->translate($accy_neg);
					$accy_neg+=$this->plots[$j]->coords[0][$i];
				}				
				
				$xt=$xscale->translate($i+1);
				$abswidth=round($this->width*$xscale->scale_factor,0);
				$pts=array($xt,$accyt,$xt,$yt,$xt+$abswidth,$yt,$xt+$abswidth,$accyt);
				
				if( $this->plots[$j]->grad ) {
					$grad = Creator::create("Gradient",STRING_NULL,$img);
					$grad->filledRectangle(
							$pts[2],$pts[3],
							$pts[6],$pts[7],
							$this->plots[$j]->grad_fromcolor,
							$this->plots[$j]->grad_tocolor,
							$this->plots[$j]->grad_style);				
				} elseif ($this->plots[$j]->fill_color ) {
 					$img->setColor($this->plots[$j]->fill_color);
 					$img->filledPolygon($pts,4);
 					$img->setColor($this->plots[$j]->color);
				}				  

				if( $this->bar_shadow ) {
					$ssh = $this->bar_shadow_hsize;
					$ssv = $this->bar_shadow_vsize;
					// Create points to create a "upper-right" shadow
					$sp[0]=$pts[6];		$sp[1]=$pts[7];
					$sp[2]=$pts[4];		$sp[3]=$pts[5];
					$sp[4]=$pts[2]+$ssh;	$sp[5]=$pts[3];
					$sp[6]=$pts[2]+$ssh;	$sp[7]=$pts[3]-$ssv;
					$sp[8]=$pts[4]+$ssh;	$sp[9]=$pts[5]-$ssv;
					$sp[10]=$pts[6]+$ssh;	$sp[11]=$pts[7];
					$img->setColor($this->bar_shadow_color);
					$img->filledPolygon($sp,4);
				}

				$this->csimareas.= "<area shape=\"rect\" coords=\"";
				// Hmmm, this is fishy.  Fixes a bug in Opera whereby if Y2<Y1 or X2<X1 the csim doesn't work
				// This means that the area MUST specify top left and bottom right corners
				if ($pts[3] < $pts[7]) {
					if ($pts[2] < $pts[6]) {
						$this->csimareas.= "$pts[2], $pts[3], $pts[6], $pts[7]\"";
					} else {
						$this->csimareas.= "$pts[6], $pts[3], $pts[2], $pts[7]\"";
					}
				} else {
					if ($pts[2] < $pts[6]) {
						$this->csimareas.= "$pts[2], $pts[7], $pts[6], $pts[3]\"";
					} else {
						$this->csimareas.= "$pts[6], $pts[7], $pts[2], $pts[3]\"";
					}
				}
				$this->csimareas.= " href=\"".$this->plots[$j]->csimtargets[$i]."\"";
				if( !empty($this->plots[$j]->csimalts[$i]) ) {
					$sval=sprintf($this->plots[$j]->csimalts[$i],$this->plots[$j]->coords[0][$i]);										
					$this->csimareas .= " alt=\"$sval\"";
				}
				$this->csimareas .= ">\r\n";				
				$img->polygon($pts,4);
			}
			
			$yt=$yscale->translate($accy);
			
			if( $this->show_value) {
				$sval=sprintf($this->show_value_format,$accy);
				$txt = Creator::create("Text",STRING_NULL,$sval);
				$txt->setFont($this->show_value_ff,$this->show_value_fs,$this->show_value_fsize);
				$txt->setColor($this->show_value_color);
				$txt->pos($pts[2]+($pts[4]-$pts[2])/2,$yt-$this->show_value_margin);
				$txt->align("center","bottom");
				$txt->setOrientation($this->show_value_angle);
				$txt->stroke($img);			
			}			
		}
		return true;
	}
} // Class

/* EOF */
?>
