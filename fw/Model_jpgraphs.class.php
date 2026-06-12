<?php
namespace Std\fw;
require_once("std_filesystem.const.php");
require_once("generic.fun.php");
require_once("Classes_info.class.php");
require_once("Creator.tra.php");
/*=======================================================================
// File: 				JPGRAPH.PHP
// Description: 		PHP4 Graph Plotting library. Base module.
// Created: 			2001-01-08
//	Last edit:			12/09/01 15:54
// Author:				Johan Persson (johanp@aditus.nu)
// Ver:					$Id: jpgraph.php,v 1.6 2001/09/23 14:01:32 ljp Exp $
//
// License:				This code is released under GPL 2.0
//
//========================================================================
*/

//------------------------------------------------------------------
// Manifest Constants that control varius aspect of JpGraph
//------------------------------------------------------------------
// The full name of directory to be used as a cache. This directory MUST
// be readable and writable for PHP. Must end with '/'
// ***************************************************
// ********** JPGRAPH_IMG_CACHE va definita in
// ********** <application_name>_filesystem_const.php
// ***************************************************

DEFINE("JPGRAPH_CACHE_DIR",JPGRAPH_IMG_CACHE);

// What grou should the cached file belong to
// (Set to "" will give the default group for the "PHP-user")
// Please note that the Apache user must be a member of the
// specified group since otherwise it is impossible for Apache
// to set the specified group.
DEFINE("JPGRAPH_CACHE_FILE_GROUP","wwwadmin");

// What permissions should the cached file have
// (Set to "" will give the default persmissions for the "PHP-user")
DEFINE("JPGRAPH_CACHE_FILE_MOD",0774);

// Should we try to read from the cache? Set to false to bypass the
// reading of the cache and always re-generate the image and save it in
// the cache. Useful for debugging.
DEFINE("JPGRAPH_READ_CACHE",true);
//DEFINE("JPGRAPH_READ_CACHE",false);

// Should the cache be used at all? By setting this to false no
// files will be generated in the cache directory. 
DEFINE("JPGRAPH_USE_CACHE",true);

// Directory for TTF fonts. Must end with '/'
// DEFINE("TTF_DIR","/usr/local/fonts/ttf/");
// ****************************************
// *** SPOSTATO IN filesystem_const.php ***
// ****************************************
//DEFINE("TTF_DIR","C:\\windows\\fonts\\");
//

// If the color palette is full should JpGraph try to allocate
// the closest match? If you plan on using background image or
// gradient fills it might be a good idea to enable this.
// If not you will otherwise get an error saying that the color palette is 
// exhausted. The drawback of using approximations is that the colors 
// might not be exactly what you specified. 
DEFINE("JPGRAPH_USE_APPROX_COLORS",true);

// Should usage of deprecated functions and parameters give a fatal error?
// (Useful to check if code is future proof.)
DEFINE("JPGRAPH_ERR_DEPRECATED",true);

// Should the time taken to generate each picture be branded to the lower
// left in corner in each generated image? Useful for performace measurements
// generating graphs
DEFINE("JPGRAPH_BRAND_TIMING",true);
DEFINE("JPGRAPH_BRAND_TIME_FORMAT","Generated in: %01.3fs");

// Decide if we should use the bresenham circle algorithm or the
// built in Arc(). Bresenham gives better visual apperance of circles 
// but is more CPU intensive and slower then the built in Arc() function
// in GD. Turned off by default for speed
DEFINE("JPGRAPH_USE_BRESENHAM",false);

// Deafult graphic format set to "auto" which will automtically
// choose the best available format in the order png,gif,jpg
// (The supported format depends on what your PHP installation supports)
DEFINE("DEFAULT_GFORMAT","auto");

// Enable some extra debug information. Should only be enabled if you know
// what you are doing!
DEFINE("JPGRAPH_JPG_DEBUG",false);

//------------------------------------------------------------------
// Constants which are used as parameters for the method calls
//------------------------------------------------------------------

// TTF Font families
DEFINE("JPGRAPH_FF_COURIER",10);
DEFINE("JPGRAPH_FF_VERDANA",11);
DEFINE("JPGRAPH_FF_TIMES",12);
DEFINE("JPGRAPH_FF_HANDWRT",13);
DEFINE("JPGRAPH_FF_COMIC",14);
DEFINE("JPGRAPH_FF_ARIAL",15);
DEFINE("JPGRAPH_FF_BOOK",16);

// TTF Font styles
DEFINE("JPGRAPH_FS_NORMAL",1);
DEFINE("JPGRAPH_FS_BOLD",2);
DEFINE("JPGRAPH_FS_ITALIC",3);
DEFINE("JPGRAPH_FS_BOLDIT",4);

//Definitions for internal font
DEFINE("JPGRAPH_FONT0",1);		// Deprecated from 1.2
DEFINE("JPGRAPH_FONT1",2);		// Deprecated from 1.2
DEFINE("JPGRAPH_FONT1_BOLD",3);	// Deprecated from 1.2
DEFINE("JPGRAPH_FONT2",4);		// Deprecated from 1.2
DEFINE("JPGRAPH_FONT2_BOLD",5); // Deprecated from 1.2

DEFINE("JPGRAPH_FF_FONT0",1);
DEFINE("JPGRAPH_FF_FONT1",2);
DEFINE("JPGRAPH_FF_FONT2",4);


// Tick density
DEFINE("JPGRAPH_TICKD_DENSE",1);
DEFINE("JPGRAPH_TICKD_NORMAL",2);
DEFINE("JPGRAPH_TICKD_SPARSE",3);
DEFINE("JPGRAPH_TICKD_VERYSPARSE",4);

// Side for ticks and labels
DEFINE("JPGRAPH_SIDE_LEFT",-1);
DEFINE("JPGRAPH_SIDE_RIGHT",1);

// Legend type stacked vertical or horizontal
DEFINE("JPGRAPH_LEGEND_VERT",0);
DEFINE("JPGRAPH_LEGEND_HOR",1);

// Mark types 
DEFINE("JPGRAPH_MARK_SQUARE",1);
DEFINE("JPGRAPH_MARK_UTRIANGLE",2);
DEFINE("JPGRAPH_MARK_DTRIANGLE",3);
DEFINE("JPGRAPH_MARK_DIAMOND",4);
DEFINE("JPGRAPH_MARK_CIRCLE",5);
DEFINE("JPGRAPH_MARK_FILLEDCIRCLE",6);
DEFINE("JPGRAPH_MARK_CROSS",7);
DEFINE("JPGRAPH_MARK_STAR",8);
DEFINE("JPGRAPH_MARK_X",9);

// Styles for gradient color fill
DEFINE("JPGRAPH_GRAD_VER",1);
DEFINE("JPGRAPH_GRAD_HOR",2);
DEFINE("JPGRAPH_GRAD_MIDHOR",3);
DEFINE("JPGRAPH_GRAD_MIDVER",4);
DEFINE("JPGRAPH_GRAD_CENTER",5);
DEFINE("JPGRAPH_GRAD_WIDE_MIDVER",6);
DEFINE("JPGRAPH_GRAD_WIDE_MIDHOR",7);

//===================================================
// CLASS JpgTimer
// Description: General timing utility class to handle
// timne measurement of generating graphs. Multiple
// timers can be started by pushing new on a stack.
//===================================================
class JpgTimer {
	var $start;
	var $idx;	
//---------------
// CONSTRUCTOR
	function __construct() {
		$this->idx=0;
	}

//---------------
// PUBLIC METHODS	

	// Push a new timer start on stack
	function push() {
		list($ms,$s)=explode(STRING_SPACE,microtime());	
		$this->start[$this->idx++]=floor($ms*1000) + 1000*$s;	
	}

	// Pop the latest timer start and return the diff with the
	// current time
	function pop() {
		assert($this->idx>0);
		list($ms,$s)=explode(STRING_SPACE,microtime());	
		$etime=floor($ms*1000) + (1000*$s);
		$this->idx--;
		return $etime-$this->start[$this->idx];
	}
} // Class


//===================================================
// CLASS Graph
// Description: Main class to handle graphs
//===================================================
class Graph {
	use Creator;
	
	var $cache=null;
	var $img=null;
	var $plots=array(),$y2plots=array();
	var $xscale=null,$yscale=null,$y2scale=null;
	var $cache_name;
	var $xgrid=null,$ygrid=null,$y2grid=null;
	var $doframe=true,$frame_color=array(0,0,0), $frame_weight=1;
	var $boxed=false, $box_color=array(0,0,0), $box_weight=1;	
	var $doshadow=false,$shadow_width=4,$shadow_color=array(102,102,102);
	var $xaxis=null,$yaxis=null, $y2axis=null;
	var $margin_color=array(198,198,198);
	var $plotarea_color=array(255,255,255);
	var $title = false;
	var $axtype="linlin";
//	var $xtick_factor,$xtick_factor;
	var $xtick_factor;
	var $texts=null;
	var $text_scale_off=0;
	var $background_image=STRING_NULL,$background_image_type=-1,$background_image_format="png";
	var $background_image_bright=0,$background_image_contr=0;
	var $image_bright=0, $image_contr=0;
	var $inline=1; // defult is to stream image inline
	var $showcsim=0; //debug stuff, draw the csim boundaris on the image if <>0
	var $csimcolor="red";	
//---------------
// CONSTRUCTOR
	function __construct($aWidth=300,$aHeight=200,$aCachedName="",$aTimeOut=0,$aInline=0) {
		
		// If timing is used create a new timing object
		if( JPGRAPH_BRAND_TIMING ) {
			global $tim;
			$tim = Creator::create(getClassNameForCreate(Classes_info::JPGTIMER_CLASS),STRING_NULL);
			$tim->Push();
		}
		
		// Should the image be streamed back to the browser or only to the
		// cache?
		$this->inline=$aInline;
		
		$this->img = Creator::create(getClassNameForCreate(Classes_info::ROTIMAGE_CLASS),STRING_NULL,$aWidth,$aHeight);
		$this->cache = Creator::create(getClassNameForCreate(Classes_info::IMGSTREAMCACHE_CLASS),STRING_NULL,$this->img);
		$this->cache->SetTimeOut($aTimeOut);
		$this->title = Creator::create(getClassNameForCreate(Classes_info::TEXT_CLASS),STRING_NULL,STRING_NULL);
		$this->legend = Creator::create(getClassNameForCreate(Classes_info::LEGEND_CLASS),STRING_NULL);
		
		// If the cached version exist just read it directly from the
		// cache, stream it back to browser and exit
		if( $aCachedName!=STRING_NULL && JPGRAPH_READ_CACHE && $aInline )
			if( $this->cache->getAndStream($aCachedName) ) exit();
				
		$this->cache_name = $aCachedName;
		$this->setTickDensity(); // Normal density
	}
//---------------
// PUBLIC METHODS	

	// Specify graph angle 0-360 degrees.
	function setAngle($aAngle) {
		$this->img->setAngle($aAngle);
	}
	
	// Add a plot object to the graph
	function add(&$aPlot) {
		$this->plots[] = $aPlot;
		return true;
	}
	
	// Add plot to second Y-scale
	function addY2(&$aPlot) {
		$this->y2plots[] = $aPlot;
		return true;
	}
	
	// Addd text object to the graph
	function addText(&$txt) {
		$this->texts[] = $txt;
	}
	
	// Specify a background image
	function setBackgroundImage($fname,$type=1,$format="png") {
		$this->background_image = $fname;
		$this->background_image_type=$type;
		$this->background_image_format=$format;
	}
	
	// Adjust brightness and constrast for background image
	function adjBackgroundImage($bright,$contr) {
		$this->background_image_bright=$bright;
		$this->background_image_contr=$contr;
	}
	
	// Adjust brightness and constrast for image
	function adjImage($bright,$contr) {
		$this->image_bright=$bright;
		$this->image_contr=$contr;
	}
	
	// Set a frame arounf the plot area
	function setBox($box=true,$color=array(0,0,0),$weight=1) {
		$this->boxed = $box;
		$this->box_weight = $weight;
		$this->box_color = $color;
	}
	
	// Specify color for the plotarea (not the marginals)
	function setColor($col) {
		$this->plotarea_color=$col;
	}
	
	// Specify color for the margins (all areas outside the plotarea)
	function setMarginColor($col) {
		$this->margin_color=$col;
	}
	
	// Set a frame around the entire image
	function setFrame($frame=true,$color=array(0,0,0),$weight=1) {
		$this->doframe = $frame;
		$this->frame_color = $color;
		$this->frame_weight = $weight;
	}
		
	// Set the shadow around the whole image
	function setShadow($aShadow=true,$aShadowWidth=5,$aShadowCol=array(102,102,102)) {
		$this->doshadow = $aShadow;
		$this->shadow_color = $aShadowCol;
		$this->shadow_width = $aShadowWidth;
	}

	// Specify x,y scale. Note that if you manually specify the scale
	// you must also speciofy the tick distance with a call to Ticks::Set()
	function setScale($axtype,$ymin=1,$ymax=1,$xmin=1,$xmax=1) {
		$this->axtype = $axtype;
		if( $axtype ==  "linlin" || $axtype == "textlin" ) {
			$this->xscale = Creator::create(getClassNameForCreate(Classes_info::LINEARSCALE_CLASS),STRING_NULL,$xmin,$xmax,"x");
			$this->yscale = Creator::create(getClassNameForCreate(Classes_info::LINEARSCALE_CLASS),STRING_NULL,$ymin,$ymax);					
		}
		elseif( $axtype ==  "linlog" || $axtype == "textlog" ) {
			$this->xscale = Creator::create(getClassNameForCreate(Classes_info::LINEARSCALE_CLASS),STRING_NULL,$xmin,$xmax,"x");
			$this->yscale = Creator::create(getClassNameForCreate(Classes_info::LOGSCALE_CLASS),STRING_NULL,$ymin,$ymax);			
		}
		elseif( $axtype ==  "loglog" ) {
			$this->xscale = Creator::create(getClassNameForCreate(Classes_info::LOGSCALE_CLASS),STRING_NULL,$xmin,$xmax,"x");			
			$this->yscale = Creator::create(getClassNameForCreate(Classes_info::LOGSCALE_CLASS),STRING_NULL,$ymin,$ymax);
		}		
		elseif( $axtype ==  "loglin" ) {			
			$this->xscale = Creator::create(getClassNameForCreate(Classes_info::LOGSCALE_CLASS),STRING_NULL,$xmin,$xmax,"x");
			$this->yscale = Creator::create(getClassNameForCreate(Classes_info::LINEARSCALE_CLASS),STRING_NULL,$ymin,$ymax);
		}		
		else die("JpGraph: Unsupported axis type: $axtype<br>");

		$this->xscale->init($this->img);
		$this->yscale->init($this->img);						
					
		$this->xscale->ticks->setPrecision(0);
		
		$this->xaxis = Creator::create(getClassNameForCreate(Classes_info::AXIS_CLASS),STRING_NULL,$this->img,$this->xscale);
		$this->yaxis = Creator::create(getClassNameForCreate(Classes_info::AXIS_CLASS),STRING_NULL,$this->img,$this->yscale);
		$this->xgrid = Creator::create(getClassNameForCreate(Classes_info::GRID_CLASS),STRING_NULL,$this->xaxis);
		$this->ygrid = Creator::create(getClassNameForCreate(Classes_info::GRID_CLASS),STRING_NULL,$this->yaxis);	
		$this->ygrid->show();
			
	}
	
	// Specify secondary Y scale
	function setY2Scale($axtype="lin",$min=1,$max=1) {
		if( $axtype=="lin" ) 
		  $this->y2scale = Creator::create(getClassNameForCreate(Classes_info::LINEARSCALE_CLASS),$min,$max);
		elseif( $axtype=="log" ) {
			$this->y2scale = Creator::create(getClassNameForCreate(Classes_info::LOGSCALE_CLASS),$min,$max);
		}
		else die("JpGraph: Unsupported Y2 axis type: $axtype<br>");
			
		$this->y2scale->init($this->img);	
		$this->y2axis = Creator::create(getClassNameForCreate(Classes_info::AXIS_CLASS),STRING_NULL,$this->img,$this->y2scale);
		$this->y2axis->scale->ticks->setDirection(-1); 
		$this->y2axis->setLabelPos(1); // Labels to right off axis
		
		// Deafult position is the max x-value
		$this->y2axis->setPos($this->xscale->getMaxVal());
		$this->y2grid = Creator::create(getClassNameForCreate(Classes_info::GRID_CLASS),STRING_NULL,$this->y2axis);							
	}
	
	// Specify density of ticks when autoscaling 'normal', 'dense', 'sparse', 'verysparse'
	// The dividing factor have been determined heuristic according to my aesthetic sense
	// y.m.m.v !
	function setTickDensity($densy=JPGRAPH_TICKD_NORMAL,$densx=JPGRAPH_TICKD_NORMAL) {
		$this->xtick_factor=30;
		$this->ytick_factor=25;		
		switch( $densy ) {
			case JPGRAPH_TICKD_DENSE:
				$this->ytick_factor=12;			
				break;
			case JPGRAPH_TICKD_NORMAL:
				$this->ytick_factor=25;			
				break;
			case JPGRAPH_TICKD_SPARSE:
				$this->ytick_factor=40;			
				break;
			case JPGRAPH_TICKD_VERYSPARSE:
				$this->ytick_factor=100;			
				break;		
			default:
				die("JpGraph: Unsupported Tick density: $densy");
		}
		switch( $densx ) {
			case JPGRAPH_TICKD_DENSE:
				$this->xtick_factor=18;							
				break;
			case JPGRAPH_TICKD_NORMAL:
				$this->xtick_factor=30;			
				break;
			case JPGRAPH_TICKD_SPARSE:
				$this->xtick_factor=45;					
				break;
			case JPGRAPH_TICKD_VERYSPARSE:
				$this->xtick_factor=60;								
				break;		
			default:
				die("JpGraph: Unsupported Tick density: $densx");
		}		
	}
	
	// Get a string of all image map areas	
	function getCSIMareas() {
		$csim="";
		foreach ($this->plots as $p) {
				$csim.= $p->getCSIMareas();
		}		
		return $csim;
	}
	
	// Get a complete <MAP>..</MAP> tag for the final image map
	function getHTMLImageMap($aMapName) {
		$im = "<MAP NAME=\"$aMapName\">\n";
		$im .= $this->getCSIMareas();
		$im .= "</MAP>"; 
		return $im;
	}
	
	
	// Stroke the graph
	function stroke() {		
		// Do any pre-stroke adjustment that is needed by the different plot types
		// (i.e bar plots want's to add an offset to the x-labels etc)
		for($i=0; $i<count($this->plots)	; ++$i ) {
			$this->plots[$i]->preStrokeAdjust($this);
			$this->plots[$i]->Legend($this);
		}
		
		if( $this->y2scale != null ) {
			for($i=0; $i<count($this->y2plots)	; ++$i ) {
				$this->y2plots[$i]->preStrokeAdjust($this);
				$this->y2plots[$i]->Legend($this);
			}
		}
		
		// Bail out if any of the Y-axis not been specified and
		// has no plots. (This means it is impossible to do autoscaling and
		// no other scale was given so we can't possible draw anything). If you use manual
		// scaling you also have to supply the tick steps as well.
		if( (!$this->yscale->isSpecified() && count($this->plots)==0) ||
			($this->y2scale!=null && !$this->y2scale->isSpecified() && count($this->y2plots)==0) ) {
			die("<strong>JpGraph: Can't draw unspecified Y-scale.</strong><br>
				You have either:
				<br>* Specified an Y axis for autoscaling but have not supplied any plots");
		}
		
		if( ($this->yscale->isSpecified() && !$this->yscale->ticks->isSpecified()) || 
			 ($this->y2scale && ($this->y2scale->isSpecified() && !$this->y2scale->ticks->isSpecified())) ) {
			die("<strong>JpGraph: Can't draw unspecified Y-scale.</strong>
				<br>You have specified an Y axis with min and max but forgotten to specify tick steps.");
		}
		
		
		// Bail out if no plots and no specified X-scale
		if( (!$this->xscale->isSpecified() && count($this->plots)==0 && count($this->y2plots)==0) )
			die("<strong>JpGraph: Can't draw unspecified X-scale.</strong><br>No plots.<br>");

		//Check if we should autoscale y-axis
		if( !$this->yscale->isSpecified() && count($this->plots)>0 ) {
			list($min,$max) = $this->getPlotsYMinMax($this->plots);
			$this->yscale->autoScale($this->img,$min,$max,$this->img->plotheight/$this->ytick_factor);
		}

		if( $this->y2scale != null) 
			if( !$this->y2scale->isSpecified() && count($this->y2plots)>0 ) {
				list($min,$max) = $this->getPlotsYMinMax($this->y2plots);
				$this->y2scale->autoScale($this->img,$min,$max,$this->img->plotheight/$this->ytick_factor);
			}			
				
		//Check if we should autoscale x-axis
		if( !$this->xscale->isSpecified() ) {
			if( substr($this->axtype,0,4) == "text" ) {
				$max=0;
				foreach( $this->plots as $p ) 
					$max=max($max,$p->numpoints-1);
				$min=1;
				$this->xscale->update($this->img,$min,$max+1);
				$this->xscale->ticks->set($this->xaxis->label_step,1);
				$this->xscale->ticks->supressMinorTickMarks();
			}
			else {
				list($min,$ymin) = $this->plots[0]->min();
				list($max,$ymax) = $this->plots[0]->max();
				foreach( $this->plots as $p ) {
					list($xmin,$ymin) = $p->min();
					list($xmax,$ymax) = $p->max();			
					$min = Min($xmin,$min);
					$max = Max($xmax,$max);
				}
				$this->xscale->autoScale($this->img,$min,$max,$this->img->plotwidth/$this->xtick_factor);
			}
			
			//Adjust position of y-axis and y2-axis to minimum/maximum of x-scale
			$this->yaxis->setPos($this->xscale->getMinVal());
			if( $this->y2axis != null ) {
				$this->y2axis->setPos($this->xscale->getMaxVal());
				$this->y2axis->setTitleSide(JPGRAPH_SIDE_RIGHT);
			}
		}		
		
		// If we have a negative values and x-axis position is at 0
		// we need to supress the first and possible the last tick since
		// they will be drawn on top of the y-axis (and possible y2 axis)
		// The test below might seem strange the reasone being that if
		// the user hasn't specified a value for position this will not
		// be set until we do the stroke for the axis so as of now it
		// is undefined.
		
		if( !$this->xaxis->pos && $this->yscale->getMinVal() < 0 ) {
			$this->yscale->ticks->supressZeroLabel(false);
			$this->xscale->ticks->supressFirst();
			if( $this->y2axis != null ) {
				$this->xscale->ticks->supressLast();
			}
		}
	
		// Copy in background image
		if( $this->background_image != STRING_NULL ) {
			$bkgimg = $this->loadBkgImage($this->background_image_format);
			$this->adjBrightContrast($bkgimg,$this->background_image_bright,
											 $this->background_image_contr);							  

			$bw = ImageSX($bkgimg);
			$bh = ImageSY($bkgimg);

			$aa = $this->img->setAngle(0);
		
			switch( $this->background_image_type ) {
				case 1: // Resize to just fill the plotarea
					$this->strokeFrame();
					imagecopyresized($this->img->img,$bkgimg,
							  $this->img->left_margin,$this->img->top_margin,
							  0,0,$this->img->plotwidth,$this->img->plotheight,
							  $bw,$bh);
					break;
				case 2: // Fill the whole area from upper left corner, resize to just fit
					imagecopyresized($this->img->img,$bkgimg,
							  0,0,0,0,
							  $this->img->width,$this->img->height,
							  $bw,$bh);
					$this->strokeFrame();
					break;
				case 3: // Just fill the image from left corner, no resizing
					imagecopyresized($this->img->img,$bkgimg,
							  0,0,0,0,
							  $bw,$bh,
							  $bw,$bh);
					$this->strokeFrame();
					break;
				default:
					die("JpGraph Error: Unknown background image layout");
			}			
			$this->img->setAngle($aa);										  			
		}
		else {
			$aa = $this->img->setAngle(0);
			$this->strokeFrame();
			$this->img->setAngle($aa);			
				
			$this->img->setColor($this->plotarea_color);		
			$this->img->filledRectangle($this->img->left_margin,
										$this->img->top_margin,
										$this->img->width-$this->img->right_margin,
										$this->img->height-$this->img->bottom_margin);	
		}
		
		$this->xaxis->stroke($this->yscale);
		$this->xgrid->stroke();
		
		$this->yaxis->stroke($this->xscale);		
		$this->ygrid->stroke();
		
		if( $this->y2axis != null ) {		
			$this->y2axis->stroke($this->xscale); 				
			$this->y2grid->stroke();
		}
		
		$oldoff=$this->xscale->off;
		if(substr($this->axtype,0,4)=="text") {
			$this->xscale->off += 
				ceil($this->xscale->scale_factor*$this->text_scale_off*$this->xscale->ticks->minor_step);
		}

		for($i=0; $i<count($this->plots)	; ++$i ) {
			$this->plots[$i]->stroke($this->img,$this->xscale,$this->yscale);
			$this->plots[$i]->strokeMargin($this->img);
 		}						
		
		if( $this->y2scale != null )
			for($i=0; $i< count($this->y2plots); ++$i ) {	
				$this->y2plots[$i]->stroke($this->img,$this->xscale,$this->y2scale);
			}		

		$this->xscale->off=$oldoff;
		
		// Finally draw the axis again since some plots may have nagged
		// the axis in the edges.
		$this->yaxis->stroke($this->xscale);
		$this->xaxis->stroke($this->yscale);
		
		if( $this->y2scale != null) 
			$this->y2axis->stroke($this->xscale); 	
		
		// Should we draw a box around the plot area?
		if( $this->boxed ) {
			$this->img->setLineWeight($this->box_weight);
			$this->img->setColor($this->box_color);
			$this->img->rectangle(
				$this->img->left_margin,$this->img->top_margin,
				$this->img->width-$this->img->right_margin,
				$this->img->height-$this->img->bottom_margin);
		}						
		
		$aa = $this->img->setAngle(0);

		// Stroke title
		$this->title->center($this->img->left_margin,$this->img->width-$this->img->right_margin,5);
		$this->title->stroke($this->img);
		
		// Stroke legend
		$this->legend->stroke($this->img);
		
		// Stroke any user added text objects
		if( $this->texts != null ) {
			foreach( $this->texts as $t) {
				$t->x *= $this->img->width;
				$t->y *= $this->img->height;
				$t->stroke($this->img);
			}
		}
		$this->img->setAngle($aa);	

		if ($this->showcsim) {	// Debug stuff - display the outline of the image map areas
			foreach ($this->plots as $p) {
				$csim.= $p->getCSIMareas();
			}
			$csim.= $this->legend->getCSIMareas();
			if (preg_match_all("/area shape=\"(\w+)\" coords=\"([0-9\, ]+)\"/", $csim, $coords)) {
				$this->img->setColor($this->csimcolor);
				for ($i=0; $i<count($coords[0]); $i++) {
					if ($coords[1][$i]=="poly") {
						preg_match_all('/\s*([0-9]+)\s*,\s*([0-9]+)\s*,*/',$coords[2][$i],$pts);
						$this->img->setStartPoint($pts[1][count($pts[0])-1],$pts[2][count($pts[0])-1]);
						for ($j=0; $j<count($pts[0]); $j++) {
							$this->img->lineTo($pts[1][$j],$pts[2][$j]);
						}
					} else if ($coords[1][$i]=="rect") {
						$pts = preg_split('/,/', $coords[2][$i]);
						$this->img->setStartPoint($pts[0],$pts[1]);
						$this->img->lineTo($pts[2],$pts[1]);
						$this->img->lineTo($pts[2],$pts[3]);
						$this->img->lineTo($pts[0],$pts[3]);
						$this->img->lineTo($pts[0],$pts[1]);
						
					}
				}
			}
		}		
		// Adjust the brightness and contrast
		if( $this->image_contr || $this->image_bright )
			$this->adjBrightContrast($this->img->img,
											 $this->image_bright,
											 $this->image_contr);
							
		// Finally stream the generated picture					
		$this->cache->putAndStream($this->img,$this->cache_name,$this->inline);		
	}

//---------------
// PRIVATE METHODS	
	// Private helper function for backgound image
	function loadBkgImage($format="png",$bright=0,$contr=0) {		
		$f = "imagecreatefrom".$format;
		$img = @$f($this->background_image);
		if( !$img ) {
			die("JpGraph Error: Can't read background image: '".$this->background_image."'");   
		}
		return $img;
	}	
	
	// Private helper function
	function adjBrightContrast($img,$bright,$contr=0) {
		if( $bright < -1 || $bright > 1 || $contr < -1 || $contr > 1 )
			die("JpGraph Error: Parameters for brightness and Contrast out of range [-1,1]");		
		$nbr = imagecolorstotal ($img);
		for( $i=0; $i<$nbr; ++$i ) {
			$colarr = imagecolorsforindex ($img,$i);
			$r = $this->img->adjRGBBrightContrast($colarr["red"],$bright,$contr);
			$g = $this->img->adjRGBBrightContrast($colarr["green"],$bright,$contr);
			$b = $this->img->adjRGBBrightContrast($colarr["blue"],$bright,$contr);		
			imagecolorset ($img, $i, $r, $g, $b);
		}
	}	


	// Text scale offset in absolute pixels
	function setTextScaleOff($o) {
		$this->text_scale_off = $o;
	}
	
	// Get min and max values for all included plots
	function getPlotsYMinMax(&$plots) {
		list($xmax,$max) = $plots[0]->max();
		list($xmin,$min) = $plots[0]->min();
		for($i=0; $i<count($plots); ++$i ) {
			list($xmax,$ymax)=$plots[$i]->max();
			list($xmin,$ymin)=$plots[$i]->min();
			if (!is_string($ymax) || $ymax != STRING_NULL) $max=max($max,$ymax);
			if (!is_string($ymin) || $ymin != STRING_NULL) $min=min($min,$ymin);
		}
		if( $min == STRING_NULL ) $min = 0;
		if( $max == STRING_NULL ) $max = 0;
		if( $min == 0 && $max == 0 ) {
			// Special case if all values are 0
			$min=0;$max=1;			
		}
		return array($min,$max);
	}

	// Draw a frame around the image
	function strokeFrame() {
		if( !$this->doframe ) return;
		if( $this->doshadow ) {
			$this->img->setColor($this->frame_color);			
			if( $this->background_image_type <= 1 ) 
				$c = $this->margin_color;
			else
				$c = false;
			$this->img->shadowRectangle(0,0,$this->img->width,$this->img->height,
												 $c,$this->shadow_width);
		}
		else {
			$this->img->setLineWeight($this->frame_weight);
			if( $this->background_image_type <= 1 ) {
				$this->img->setColor($this->margin_color);
				$this->img->filledRectangle(1,1,$this->img->width-2,$this->img->height-2);		
			}
			$this->img->setColor($this->frame_color);
			$this->img->rectangle(0,0,$this->img->width-1,$this->img->height-1);		
		}
	}
} // Class


//===================================================
// CLASS TTF
// Description: Handle TTF font names
//===================================================
class TTF {
	var $font_fam;
//---------------
// CONSTRUCTOR
	function __construct() {
		// Base file names for available fonts
		$this->font_fam=array(
			JPGRAPH_FF_COURIER => TTF_DIR . DIR_SEP . "courier",
			JPGRAPH_FF_VERDANA => TTF_DIR . DIR_SEP . "verdana",
			JPGRAPH_FF_TIMES => TTF_DIR . DIR_SEP . "times",
			JPGRAPH_FF_HANDWRT => TTF_DIR . DIR_SEP . "handwriting",
			JPGRAPH_FF_COMIC => TTF_DIR . DIR_SEP . "comic",
			JPGRAPH_FF_ARIAL => TTF_DIR . DIR_SEP . "arial",
			JPGRAPH_FF_BOOK => TTF_DIR . DIR_SEP . "bookant");
	}

//---------------
// PUBLIC METHODS	
	// Create the TTF file from the font specification
	function File($fam,$style=JPGRAPH_FS_NORMAL) {
		$f=$this->font_fam[$fam];
		if( !$f ) die("JpGraph Error: Unknown TTF font family.");
		switch( $style ) {
			case JPGRAPH_FS_NORMAL:
			break;
			case JPGRAPH_FS_BOLD: $f .= "bd";
			break;
			case JPGRAPH_FS_ITALIC: $f .= "i";
			break;
			case JPGRAPH_FS_BOLDIT: $f .= "bi";
			break;
			default:
				die("JpGraph Error: Unknown TTF Style.");
		}
		$f .= ".ttf";
		return $f;
	}
} // Class


//===================================================
// CLASS Text
// Description: Arbitrary text object that can be added to the graph
//===================================================
class Text {
	var $t,$x=0,$y=0,$halign="left",$valign="top",$color=array(0,0,0);
	var $size=2,$font_family=JPGRAPH_FONT1,$font_style=JPGRAPH_FS_NORMAL,$font_size=12,$hide=false,$dir=0;
	var $boxed=false;	// Should the text be boxed
//---------------
// CONSTRUCTOR
	function __construct($txt="",$x=0,$y=0) {
		$this->t = $txt;
		$this->x = $x;
		$this->y = $y;
	}
//---------------
// PUBLIC METHODS	
	// Set the string in theb text object
	function set($t) {
		$this->t = $t;
	}
	
	// Specify the position and alignment for the text object
	function pos($x=0,$y=0,$halign="left",$valign="top") {
		$this->x = $x;
		$this->y = $y;
		$this->halign = $halign;
		$this->valign = $valign;
	}
	
	// Specify alignment for the text
	function align($halign,$valign="top") {
		$this->halign = $halign;
		$this->valign = $valign;
	}		
	
	// Specify that the text should be boxed. fcolor=frame color, bcolor=border color,
	// $shadow=drop shadow should be added around the text.
	function setBox($fcolor=array(255,255,255),$bcolor=array(0,0,0),$shadow=false) {
		if( $fcolor==false )
			$this->boxed=false;
		else
			$this->boxed=true;
		$this->fcolor=$fcolor;
		$this->bcolor=$bcolor;
		$this->shadow=$shadow;
	}
	
	// Hide the text
	function hide($f=true) {
		$this->hide=$f;
	}
	
	// Specify font
	function setFont($family,$style=JPGRAPH_FS_NORMAL,$size=10) {
		$this->font_family=$family;
		$this->font_style=$style;
		$this->font_size=$size;
	}
			
	// Center the text between $left and $right coordinates
	function center($left,$right,$y=false) {
		$this->x = $left + ($right-$left	)/2;
		$this->halign = "center";
		if( is_numeric($y) )
			$this->y = $y;		
	}
	
	// Set text color
	function setColor($col) {
		$this->color = $col;
	}
	
	// Orientation of text. Note only TTF fonts can have an arbitrary angle
	function setOrientation($d=0) {
		if( is_numeric($d) )
			$this->dir=$d;	
		elseif( $d=="h" )
			$this->dir = 0;
		elseif( $d=="v" )
			$this->dir = 90;
		else die("JpGraph Error: Invalid direction specified for text.");
	}
	
	// Total width of text
	function getWidth(&$img) {
		$img->setFont($this->font_family,$this->font_style,$this->font_size);		
		return $img->getTextWidth($this->t);
	}
	
	// Hight of text
	function getFontHeight(&$img) {
		$img->setFont($this->font_family,$this->font_style,$this->font_size);		
		return $img->getTextHeight();
	}
	
	// Display text in image
	function stroke(&$img) {
		$img->setColor($this->color);	
		$img->setFont($this->font_family,$this->font_style,$this->font_size);
		$img->setTextAlign($this->halign,$this->valign);
		if( $this->boxed ) {
			if( $this->fcolor=="nofill" ) $this->fcolor=false;		
			$img->strokeBoxedText($this->x,$this->y,$this->t,$this->dir,$this->fcolor,$this->bcolor,$this->shadow);
		}
		else {
			$img->strokeText($this->x,$this->y,$this->t,$this->dir);
		}
	}
} // Class

//===================================================
// CLASS Grid
// Description: responsible for drawing grid lines in graph
//===================================================
class Grid {
	var $img;
	var $scale;
	var $grid_color=array(196,196,196);
	var $type="solid";
	var $show=false, $showMinor=false,$weight=1;
//---------------
// CONSTRUCTOR
	function __construct(&$axis) {
		$this->scale = &$axis->scale;
		$this->img = &$axis->img;
	}
//---------------
// PUBLIC METHODS
	function setColor($color) {
		$this->grid_color=$color;
	}
	
	function setWeight($w) {
		$this->weight=$w;
	}
	
	// Specify if grid should be dashed, dotted or solid
	function setLineStyle($type) {
		$this->type = $type;
	}
	
	// Decide if both major and minor grid should be displayed
	function show($show=true,$minor=false) {
		$this->show=$show;
		$this->showMinor=$minor;
	}
	
	// Display the grid
	function stroke() {
		if( $this->showMinor ) 
			$this->_doStroke($this->scale->ticks->ticks_pos);
		else
			$this->_doStroke($this->scale->ticks->maj_ticks_pos);
	}
	
//--------------
// Private methods	
	// Draw the grid
	function _doStroke(&$ticks_pos) {
		if( !$this->show )
			return;	
		$this->img->setColor($this->grid_color);
		$this->img->setLineWeight($this->weight);
		$nbrgrids = count($ticks_pos);					
		if( $this->scale->type=="y" ) {
			$xl=$this->img->left_margin;
			$xr=$this->img->width-$this->img->right_margin;
			for($i=0; $i<$nbrgrids; ++$i) {
				$y=$ticks_pos[$i];
				if( $this->type == "solid" )
					$this->img->line($xl,$y,$xr,$y);
				elseif( $this->type == "dotted" )
					$this->img->dashedLine($xl,$y,$xr,$y,1,6);
				elseif( $this->type == "dashed" )
					$this->img->dashedLine($xl,$y,$xr,$y,2,4);
				elseif( $this->type == "longdashed" )
					$this->img->dashedLine($xl,$y,$xr,$y,8,6);
			}
		}
				
		if( $this->scale->type=="x" ) {	
			$yu=$this->img->top_margin;
			$yl=$this->img->height-$this->img->bottom_margin;
			$x=$ticks_pos[0];
			$limit=$this->img->width-$this->img->right_margin;
			$i=0;
			// We must also test for limit since we might have
			// an offset and the number of ticks is calculated with
			// assumption offset==0 so we might end up drawing one
			// to many gridlines
			while( $x<=$limit && $i<count($ticks_pos)) {
				$x=$ticks_pos[$i];
				if( $this->type == "solid" )				
					$this->img->line($x,$yl,$x,$yu);
				elseif( $this->type == "dotted" )
					$this->img->dashedLine($x,$yl,$x,$yu,1,6);
				elseif( $this->type == "dashed" )
					$this->img->dashedLine($x,$yl,$x,$yu,2,4);
				elseif( $this->type == "longdashed" )
					$this->img->dashedLine($x,$yl,$x,$yu,8,6);									
				++$i;									
			}
		}		
		return true;
	}
} // Class

//===================================================
// CLASS Axis
// Description: Defines X and Y axis. Notes that at the
// moment the code is not really good since the axis on
// several occasion must know wheter it's an X or Y axis.
// This was a design decision to make the code easier to
// follow. 
//===================================================
class Axis {
	use Creator;
	
	var $pos = false;
	var $weight=1;
	var $color=array(0,0,0),$label_color=array(0,0,0);
	var $img=null,$scale=null; 
	var $hide=false;
	var $ticks_label=false;
	var $show_first_label=true;
	var $label_step=1; // Used by a text axis to specify what multiple of major steps
							 // should be labeled.
	var $labelPos=0;   // Which side of the axis should the labels be?
	var $title=null,$title_adjust,$title_margin,$title_side=JPGRAPH_SIDE_LEFT;
	var $font_family=JPGRAPH_FONT1,$font_style=JPGRAPH_FS_NORMAL,$font_size=12,$label_angle=0;
	
//---------------
// CONSTRUCTOR
	function __construct(&$img,&$aScale,$color=array(0,0,0)) {
		$this->img = &$img;
		$this->scale = &$aScale;
		$this->color = $color;
		$this->title = Creator::create("Text",STRING_NULL,STRING_NULL);
		
		if( $aScale->type=="y" ) {
			$this->title_margin = 25;
			$this->title_adjust="middle";
			$this->title->setOrientation(90);
		}
		else {
			$this->title_margin = 5;
			$this->title_adjust="high";
			$this->title->setOrientation(0);			
		}
		
	}
//---------------
// PUBLIC METHODS	

	// Don't display the first label
	function hideFirstTickLabel($flag=false) {
		$this->show_first_label=$flag;
	}
	
	// Hide the axis
	function hide($h=true) {
		$this->hide=$h;
	}

	// Weight of axis
	function setWeight($weight) {
		$this->weight = $weight;
	}

	// Axis color
	function setColor($color,$label_color=false) {
		$this->color = $color;
		if( !$label_color ) $this->label_color = $color;
		else $this->label_color = $label_color;
	}
	
	// Title on axis
	function setTitle($t,$adj="high") {
		$this->title->Set($t);
		$this->title_adjust=$adj;
	}
	
	// Specify distance from the axis
	function setTitleMargin($m) {
		$this->title_margin=$m;
	}
	
	// Specify text labels for the ticks
	function setTickLabels($l) {
		$this->ticks_label = $l;
	}
	
	// Specify that every $step of the ticks should be displayed starting
	// at $start
	function setTextTicks($step,$start=0) {
		$this->scale->ticks->setTextLabelStart($start);
		$this->label_step=$step;
	}
	
	// Which side of the axis should the labels be on?
	function setLabelPos($pos) {
		$this->labelPos=$pos;
	}
	
	// Set the font
	function setFont($family,$style=JPGRAPH_FS_NORMAL,$size=10) {
		$this->font_family = $family;
		$this->font_style = $style;
		$this->font_size = $size;
	}
	
	// Which side of the axis should the axis title be?
	function setTitleSide($s) {
		$this->title_side = $s;
	}
	
	// Stroke the axis.
	function stroke($otherAxisScale) {		
		if( $this->hide ) return;		
		if( is_numeric($this->pos) ) {
			$pos=$otherAxisScale->translate($this->pos);
		}
		else {	// Default to minimum of other scale if pos not set
			if( $otherAxisScale->getMinVal() >= 0 || $this->pos=="min" ) {
				$pos = $otherAxisScale->scale_abs[0];
			}
			else { // If negative set x-axis at 0
				$this->pos=0;
				$pos=$otherAxisScale->translate(0);
			}
		}	
		$this->img->setLineWeight($this->weight);
		$this->img->setColor($this->color);		
		$this->img->setFont($this->font_family,$this->font_style,$this->font_size);
		if( $this->scale->type == "x" ) {
			$this->img->filledRectangle($this->img->left_margin,$pos,
							  $this->img->width-$this->img->right_margin,$pos+$this->weight-1);
			$y=$pos+$this->img->getFontHeight()+$this->title_margin;	
			if( $this->title_adjust=="high" )
				$this->title->pos($this->img->width-$this->img->right_margin,$y,"right","top");
			elseif($this->title_adjust=="middle") 
				$this->title->pos(($this->img->width-$this->img->left_margin-$this->img->right_margin)/2+$this->img->left_margin,$y,"center","top");
			elseif($this->title_adjust=="low")
				$this->title->pos($this->img->left_margin,$y,"left","top");
		}
		elseif( $this->scale->type == "y" ) {
			// Add line weight to the height of the axis since
			// the x-axis could have a width>1 and we want the axis to fit nicely together.
			$this->img->filledRectangle($pos-$this->weight+1,$this->img->top_margin,
							  $pos,$this->img->height-$this->img->bottom_margin+$this->weight-1);
			$x=$pos ;
			if( $this->title_side == JPGRAPH_SIDE_LEFT ) {
				$x -= $this->title_margin;
				$halign="right";
			}
			else {
				$x += $this->title_margin;
				$halign="left";
			}
			if( $this->title_adjust=="high" ) 
				$this->title->pos($x,$this->img->top_margin,$halign,"top"); 
			elseif($this->title_adjust=="middle" || $this->title_adjust=="center")  
				$this->title->pos($x,($this->img->height-$this->img->top_margin-$this->img->bottom_margin)/2+$this->img->top_margin,$halign,"center");
			elseif($this->title_adjust=="low")
				$this->title->pos($x,$this->img->height-$this->img->bottom_margin,$halign,"bottom");				
		}
		$this->scale->ticks->stroke($this->img,$this->scale,$pos);
		$this->strokeLabels($pos);
		$this->title->stroke($this->img);
	}

	// Position for axis line on the "other" scale
	function setPos($pos) {
		$this->pos=$pos;
	}
	
	// Specify the angle for the tick labels
	function setLabelAngle($a) {
		$this->label_angle = $a;
	}
	
//---------------
// PRIVATE METHODS	
	// Draw all the tick labels
	function strokeLabels($pos,$minor=false) {
		$this->img->setColor($this->label_color);
		$this->img->setFont($this->font_family,$this->font_style,$this->font_size);
		$yoff=$this->img->getFontHeight()/2;
		if( $minor ) { // Normally minor ticks do NOT have any labels
			$nbr = count($this->scale->ticks->ticks_label);
			for( $i=0; $i<$nbr ; $i++ ) {
				if( $this->ticks_label )
					$label=$this->ticks_label[$i];
				else
					$label=$this->scale->ticks->ticks_label[$i];
				if( $this->scale->type == "x" ) {
					$this->img->setTextAlign("center","top");
					$this->img->strokeText($this->scale->ticks->ticks_pos[$i],$pos,$label);
				} else {
					if( $this->labelPos == 0 ) { // To the left of y-axis
						$this->img->setTextAlign("right","center");
						$this->img->strokeText($pos,$this->scale->ticks->ticks_pos[$i],$label);
					}
					else { // To the right of the y-axis
						$this->img->setTextAlign("left","center");
						$this->img->StrokeText($pos,$this->scale->ticks->ticks_pos[$i],$label);
					}
				}
			}
		}
		else {
			$nbr = count($this->scale->ticks->maj_ticks_label);
			if( $this->show_first_label ) $start=0;
			else $start=1;
			
			// Note. the $limit is only used for the x axis since we
			// might otherwhise overshoot if the scale has been centered
			if( $this->scale->type=="x" )
				$limit=$this->img->width-$this->img->right_margin;
			else
				$limit=$this->img->height;
				
			$i=$start; 
			$tpos=$this->scale->ticks->maj_ticks_pos[$i];			
			while( $i<$nbr && $tpos<=$limit ) {
				$tpos=$this->scale->ticks->maj_ticks_pos[$i];				
				if( isset($this->ticks_label[$i]) )
					$label=$this->ticks_label[$i];
				else
					$label=$this->scale->ticks->maj_ticks_label[$i];
				if( $this->scale->type == "x" ) {
					if( $this->label_angle==0 || $this->label_angle==90 ) 
						$this->img->setTextAlign("center","top");
					else
						$this->img->setTextAlign("topanchor","top");
					$this->img->strokeText($tpos,$pos+3,$label,$this->label_angle);
				}
				else {
					if( $this->label_angle!=0 ) 
						die("JpGraph Error: Labels at an angle is not supported on Y-axis");
					if( $this->labelPos == 0 ) { // To the left of y-axis					
						$this->img->setTextAlign("right","center");
						$this->img->strokeText($pos-4,$tpos,$label);					
					}
					else { // To the right of the y-axis
						$this->img->setTextAlign("left","center");
						$this->img->strokeText($pos+4,$tpos,$label);					
					}
				}
				++$i;	
			}								
		}			
	}		
} // Class

//===================================================
// CLASS Ticks
// Description: Abstract base class for drawing linear and logarithmic
// tick marks on axis
//===================================================
class Ticks {
	var $minor_abs_size=3, $major_abs_size=5;
	var $direction=1; // Should ticks be in(=1) the plot area or outside (=-1)?
	var $scale;
	var $ticks_pos=array(); // Save position of minor ticks
	var $maj_ticks_pos=array(); // Save position of major ticks
	var $ticks_label=array(), $maj_ticks_label=array();
	var $is_set=false;
	var $precision=-1;
	var $supress_zerolabel=false,$supress_first=false;
	var $supress_last=false,$supress_tickmarks=false,$supress_minor_tickmarks=false;
	var $mincolor="",$majcolor="";
	var $weight=1;
//---------------
// CONSTRUCTOR
	function __construct(&$aScale) {
		$this->scale=&$aScale;
	}

//---------------
// PUBLIC METHODS	
	// Don't display the first zero label
	function supressZeroLabel($z=true) {
		$this->supress_zerolabel=$z;
	}
	
	// Don't display minor tick marks
	function supressMinorTickMarks($tm=true) {
		$this->supress_minor_tickmarks=$tm;
	}
	
	// Don't display major tick marks
	function supressTickMarks($tm=true) {
		$this->supress_tickmarks=$tm;
	}
	
	// Hide the first tick mark
	function supressFirst($ft=true) {
		$this->supress_first=$ft;
	}
	
	// Hide the last tick mark
	function supressLast($lt=true) {
		$this->supress_last=$lt;
	}

	// Size (in pixels) of minor tick marks
	function getMinTickAbsSize() {
		return $this->minor_abs_size;
	}
	
	// Size (in pixels) of major tick marks
	function getMajTickAbsSize() {
		return $this->major_abs_size;		
	}
	
	// Have the ticks been specified
	function isSpecified() {
		return $this->is_set;
	}
	
	// Set the distance between major and minor tick marks
	function set($maj,$min) {
		// "Virtual method"
		// Should be implemented by the concrete subclass
		// if any action is wanted.
	}
	
	// Specify number of decimals in automtic labels
	function setPrecision($p) {
		$this->precision=$p;
	}
	
	// Which side of the axis should the ticks be on
	function setDirection($dir=JPGRAPH_SIDE_RIGHT) {
		$this->direction=$dir;
	}
	
	// Set colors for major and minor tick marks
	function setMarkColor($majcolor,$mincolor="") {
		$this->majcolor=$majcolor;
		$this->mincolor=$mincolor;
	}
	
	function setWeight($w) {
		$this->weight=$w;
	}
	
} // Class

//===================================================
// CLASS LinearTicks
// Description: Draw linear ticks on axis
//===================================================
class LinearTicks extends Ticks {
	var $minor_step=1, $major_step=2;
	var $xlabel_offset=0;
	var $text_label_start=0;
//---------------
// CONSTRUCTOR
	function __construct() {
		// Empty
	}

//---------------
// PUBLIC METHODS	
	// Return major step size in world coordinates
	function getMajor() {
		return $this->major_step;
	}
	
	// Return minor step size in world coordinates
	function getMinor() {
		return $this->minor_step;
	}
	
	// Set Minor and Major ticks (in world coordinates)
	function set($maj_step,$min_step) {
		if( $maj_step <= 0 || $min_step <= 0 ) {
			die("JpGraph Error:
				You have unfortunately stumbled upon a bug in JpGraph. Sorry for the inconvience.
				Please report Bug #02 to jpgraph@aditus.nu and I will try to fix it ASAP.
				If possible could you please provide the data that caused this problem. It seems
				like either the minor or major step size is 0 which should be impossible.");
		}
		
		$this->major_step=$maj_step;
		$this->minor_step=$min_step;
		$this->is_set = true;
	}

	// Draw linear ticks
	function stroke(&$img,&$scale,$pos) {
		$maj_step_abs = $scale->scale_factor*$this->major_step;		
		$min_step_abs = $scale->scale_factor*$this->minor_step;		
		if( $min_step_abs==0 || $maj_step_abs==0 ) 
			die("JpGraph Error: A plot has an illegal scale. This could for example be 
			that you are trying to use text autoscaling to draw a line plot with only one point 
			or similair abnormality (a line needs two points!).");
		$limit = $scale->scale_abs[1];	
		$nbrmajticks=floor(1.000001*(($scale->getMaxVal()-$scale->getMinVal())/$this->major_step))+1;
		$first=0;
		// If precision hasn't been specified set it to a sensible value
		if( $this->precision==-1 ) { 
			$t = log10($this->minor_step);
			if( $t > 0 )
				$precision = 0;
			else
				$precision = -floor($t);
		}
		else
			$precision = $this->precision;
			
		$img->setLineWeight($this->weight);			
		
		// Handle ticks on X-axis
		if( $scale->type == "x" ) {
			// Draw the major tick marks
			$yu = $pos - $this->direction*$this->getMajTickAbsSize();
			$label = $scale->getMinVal()+$this->text_label_start;	
			$start_abs=$scale->scale_factor*$this->text_label_start;
			$nbrmajticks=ceil(($scale->getMaxVal()-$scale->getMinVal()-$this->text_label_start)/$this->major_step)+1;			
			for( $i=0; $label<=$scale->getMaxVal(); ++$i ) {
				$x=$scale->scale_abs[0]+$start_abs+$i*$maj_step_abs+$this->xlabel_offset*$min_step_abs;				
				$this->maj_ticks_pos[$i]=ceil($x);
				$l = sprintf("%01.".$precision."f",round($label,$precision));
				if( ($this->supress_zerolabel && ($l + 0)==0) ||
				    ($this->supress_first && $i==0) ||
				    ($this->supress_last  && $i==$nbrmajticks-1) )
					$l="";					
				$this->maj_ticks_label[$i]=$l;
				$label+=$this->major_step;
				if(!($this->xlabel_offset > 0 && $i==$nbrmajticks-1) && !$this->supress_tickmarks) {
					if( $this->majcolor!="" ) $img->pushColor($this->majcolor);
					$img->Line($x,$pos,$x,$yu);
					if( $this->majcolor!="" ) $img->popColor();
				}
			}
			// Draw the minor tick marks
			
			$yu = $pos - $this->direction*$this->getMinTickAbsSize();
			$label = $scale->getMinVal();								
			for( $i=0,$x=$scale->scale_abs[0]; $x<$limit; ++$i ) {
				$x=$scale->scale_abs[0]+$i*$min_step_abs;
				$this->ticks_pos[]=$x;
				$this->ticks_label[]=$label;
				$label+=$this->minor_step;
				if( !$this->supress_tickmarks && !$this->supress_minor_tickmarks)	{						
					if( $this->mincolor!=STRING_NULL ) $img->pushColor($this->mincolor);
					$img->Line($x,$pos,$x,$yu); 
					if( $this->mincolor!=STRING_NULL ) $img->popColor();
				}
			}
		}
		elseif( $scale->type == "y" ) {
			// Draw the major tick marks
			$xr = $pos + $this->direction*$this->getMajTickAbsSize();
			$label = $scale->getMinVal();
			for( $i=0; $i<$nbrmajticks; ++$i) {
				$y=$scale->scale_abs[0]+$i*$maj_step_abs;				
				$this->maj_ticks_pos[$i]=$y;
				$l = sprintf("%01.".$precision."f",round($label,$precision));
				if( ($this->supress_zerolabel && ($l + 0)==0) ||
				    ($this->supress_first && $i==0) ||
				    ($this->supress_last  && $i==$nbrmajticks-1) )
					$l="";
				$this->maj_ticks_label[$i]=$l; 
				$label+=$this->major_step;	
				if( !$this->supress_tickmarks ) {
					if( $this->majcolor!=STRING_NULL ) $img->pushColor($this->majcolor);
					$img->Line($pos,$y,$xr,$y);	
					if( $this->majcolor!=STRING_NULL ) $img->popColor();
				}
			}
			// Draw the minor tick marks
			$xr = $pos + $this->direction*$this->getMinTickAbsSize();
			$label = $scale->getMinVal();	
			for( $i=0,$y=$scale->scale_abs[0]; $y>=$limit; ) {
				$this->ticks_pos[$i]=$y;
				$this->ticks_label[$i]=$label;				
				$label+=$this->minor_step;				
				if( !$this->supress_tickmarks && !$this->supress_minor_tickmarks)	{
					if( $this->mincolor!=STRING_NULL ) $img->pushColor($this->mincolor);
					$img->Line($pos,$y,$xr,$y);
					if( $this->mincolor!=STRING_NULL ) $img->popColor();
				}
				++$i;
				$y=$scale->scale_abs[0]+$i*$min_step_abs;								
			}	
		}	
	}
//---------------
// PRIVATE METHODS
	// Spoecify the offset of the displayed tick mark with the tick "space"
	// Legal values for $o is [0,1] used to adjust wher the tick marks should be
	// displed within the tick-size
	function setXLabelOffset($o) {
		$this->xlabel_offset=$o;
		if( $o>0 )
			$this->supressLast();	// The last tick wont fit
	}

	// Which tick label should we start with?
	function setTextLabelStart($s) {
		$this->text_label_start=$s;
	}
	
} // Class



//===================================================
// CLASS LinearScale
// Description: Handle linear scaling between screen and world 
//===================================================
class LinearScale {
	use Creator;
	
	var $scale=array(0,0);
	var $scale_abs=array(0,0);
	var $scale_factor; // Scale factor between world and screen
	var $world_size;	// Plot area size in world coordinates
	var $world_abs_size; // Plot area size in pixels
	var $off; // Offset between image edge and plot area
	var $type; // is this x or y scale ?
	var $ticks=null; // Store ticks
	var $autoscale_min=false; // Forced minimum value, useful to let user force 0 as start and autoscale max
	var $gracetop=0,$gracebottom=0;
//---------------
// CONSTRUCTOR
	function __construct($min=0,$max=0,$type="y") {
		assert($type=="x" || $type=="y" );
		assert($min<=$max);
		
		$this->type=$type;
		$this->scale=array($min,$max);		
		$this->world_size=$max-$min;
		$this->ticks = Creator::create("LinearTicks",STRING_NULL);	
		//$this->ticks = new LinearTicks();
		if( $type=="y" )
			$this->ticks->SupressZeroLabel();
	}

//---------------
// PUBLIC METHODS	
	// Second phase constructor
	function init(&$img) {
		$this->initConstants($img);	
		// We want image to notify us when the margins changes so we 
		// can recalculate the constants.
		// PHP <= 4.04 BUGWARNING: IT IS IMPOSSIBLE TO DO THIS IN THE CONSTRUCTOR
		// SINCE (FOR SOME REASON) IT IS IMPOSSIBLE TO PASS A REFERENCE
		// TO 'this' INSTEAD IT WILL ADD AN ANONYMOUS COPY OF THIS OBJECT WHICH WILL
		// GET ALL THE NOTIFICATIONS. (This took a while to track down...)
		
		// Add us as an observer to class Image
		$img->addObserver("InitConstants",$this);
	}
	
	// Check if scale is set or if we should autoscale
	// We should do this is either scale or ticks has not been set
	function isSpecified() {
		if( $this->getMinVal()==$this->getMaxVal() ) {		// Scale not set
			return false;
		}
		return true;
	}
	
	// Set the minimum data value when the autoscaling is used. 
	function setAutoMin($m) {
		$this->autoscale_min=$m;
	}
	
	// Specify scale "grace" value (top and bottom)
	function setGrace($gt,$gb=0) {
		if( !($gt>=1 && $gt<=100) || $gb > 100  )
			die("JpGraph Error: Grace must be between 1% and 100%");
		$this->gracetop=$gt;
		$this->gracebottom=$gb;
	}
	
	// Get the minimum value in the scale
	function GetMinVal() {
		return $this->scale[0];
	}
	
	// get maximum value for scale
	function GetMaxVal() {
		return $this->scale[1];
	}
		
	// Specify a new min/max value for sclae	
	function update(&$img,$min,$max) {
		$this->scale=array($min,$max);		
		$this->world_size=$max-$min;		
		$this->initConstants($img);					
	}
	
	// Translate between world and screen
	function translate($a) {
		return $this->off+round(($a*1.0 - $this->getMinVal()) * $this->scale_factor,0); 
	}
	
	// Relative translate (don't include offset) usefull when we just want
	// to know the relative position (in pixels) on the axis
	function relTranslate($a) {
		return round(($a*1.0 - $this->getMinVal()) * $this->scale_factor,0); 
	}
	
	// Calculate autoscale. Used if user hasn't given a scale and ticks
	// $maxsteps is the maximum number of major tickmarks allowed.
	function autoScale(&$img,$min,$max,$maxsteps,$majend=true) {
		if( abs($min-$max) < 0.00001 ) {
			// We need some difference to be able to autoscale
			// make it 5% above and 5% below value
			$min *= 0.95;
			$max *= 1.05;
			if( $min==0 && $max==0 ) {		// Special case
				$min=0; $max=1;
			}
		}
		
		$gracetop=($this->gracetop/100.0)*abs($max-$min);
		$gracebottom=($this->gracebottom/100.0)*abs($max-$min);
		if( is_numeric($this->autoscale_min) ) {
			$min = $this->autoscale_min;
			if( abs($min-$max ) < 0.00001 )
				$max *= 1.05;
		}
		else {
			$min -= $gracebottom;
		}
		$max += $gracetop;
		// First get tickmarks as multiples of 0.1, 1, 10, ...	
		list($num1steps,$adj1min,$adj1max,$min1step,$maj1step) = 
			$this->calcTicks($maxsteps,$min,$max,1,2);
		
		// Then get tick marks as 2:s 0.2, 2, 20, ...
		list($num2steps,$adj2min,$adj2max,$min2step,$maj2step) = 
			$this->calcTicks($maxsteps,$min,$max,5,2);
		
		// Then get tickmarks as 5:s 0.05, 0.5, 5, 50, ...
		list($num5steps,$adj5min,$adj5max,$min5step,$maj5step) = 
			$this->calcTicks($maxsteps,$min,$max,2,5);		

		// Check to see whichof 1:s, 2:s or 5:s fit better with
		// the requested number of major ticks		
		$match1=abs($num1steps-$maxsteps);		
		$match2=abs($num2steps-$maxsteps);
		$match5=abs($num5steps-$maxsteps);
		// Compare these three values and see which is the closest match
		// We use a 0.8 weight to gravitate towards multiple of 5:s 
		$r=$this->matchMin3($match1,$match2,$match5,0.8);
		switch( $r ) {
			case 1:
				$this->update($img,$adj1min,$adj1max);
				$this->ticks->set($maj1step,$min1step);
				break;			
			case 2:
				$this->update($img,$adj2min,$adj2max);		
				$this->ticks->set($maj2step,$min2step);
				break;									
			case 3:
				$this->update($img,$adj5min,$adj5max);
				$this->ticks->set($maj5step,$min5step);		
				break;			
		}
	}

//---------------
// PRIVATE METHODS	

	// This method recalculates all constants that are depending on the
	// margins in the image. If the margins in the image are changed
	// this method should be called for every scale that is registred with
	// that image. Should really be installed as an observer of that image.
	function initConstants(&$img) {
		if( $this->type=="x" ) {
			$this->world_abs_size=$img->width - $img->left_margin - $img->right_margin;
			$this->off=$img->left_margin;
			$this->scale_factor = 0;
			if( $this->world_size > 0 )
				$this->scale_factor=$this->world_abs_size/($this->world_size*1.0);
		}
		else { // y scale
			$this->world_abs_size=$img->height - $img->top_margin - $img->bottom_margin;								
			$this->off=$img->top_margin+$this->world_abs_size;			
			$this->scale_factor = 0;			
			if( $this->world_size > 0 )			
				$this->scale_factor=-$this->world_abs_size/($this->world_size*1.0);							
		}
		$size = $this->world_size * $this->scale_factor;
		$this->scale_abs=array($this->off,$this->off + $size);	
	}
	
	// Initialize the conversion constants for this scale
	// This tries to pre-calculate as much as possible to speed up the
	// actual conversion (with Translate()) later on
	// $start	=scale start in absolute pixels (for x-scale this is an y-position
	//				 and for an y-scale this is an x-position
	// $len 		=absolute length in pixels of scale 			
	function setConstants($start,$len) {
		$this->world_abs_size=$len;
		$this->off=$start;
		
		if( $this->world_size<=0 ) {
			echo("JpGraph Fatal Error:
				You have unfortunately stumbled upon a bug in JpGraph. Sorry for the inconvience.
				Please report Bug #01 to jpgraph@aditus.nu and I will try to fix it ASAP.");
		}
		
		// scale_factor = number of pixels per world unit
		$this->scale_factor=$this->world_abs_size/($this->world_size*1.0);
		
		// scale_abs = start and end points of scale in absolute pixels
		$this->scale_abs=array($this->off,$this->off+$this->world_size*$this->scale_factor);		
	}
	
	
	// Calculate number of ticks steps with a specific division
	// $a is the divisor of 10**x to generate the first maj tick intervall
	// $a=1, $b=2 give major ticks with multiple of 10, ...,0.1,1,10,...
	// $a=5, $b=2 give major ticks with multiple of 2:s ...,0.2,2,20,...
	// $a=2, $b=5 give major ticks with multiple of 5:s ...,0.5,5,50,...
	// We return a vector of
	// 	[$numsteps,$adjmin,$adjmax,$minstep,$majstep]
	// If $majend==true then the first and last marks on the axis will be major
	// labeled tick marks otherwise it will be adjusted to the closest min tick mark
	function calcTicks($maxsteps,$min,$max,$a,$b,$majend=true) {
		$diff=$max-$min; 
		if( $diff==0 )
			$ld=0;
		else
			$ld=floor(log10($diff));
		
		// Gravitate min towards zero if we are close		
		if( $min>0 && $min < pow(10,$ld) ) $min=0;
		
		$majstep=pow(10,$ld-1)/$a; 
		$minstep=$majstep/$b;
		$adjmax=ceil($max/$minstep)*$minstep;
		$adjmin=floor($min/$minstep)*$minstep;	
		$adjdiff = $adjmax-$adjmin;
		$numsteps=$adjdiff/$majstep; 
		while( $numsteps>$maxsteps ) {
			$majstep=pow(10,$ld)/$a; 
			$numsteps=$adjdiff/$majstep;
			++$ld;
		}
		
		$minstep=$majstep/$b;
		$adjmin=floor($min/$minstep)*$minstep;	
		$adjdiff = $adjmax-$adjmin;		
		if( $majend ) {
			$adjmin = floor($min/$majstep)*$majstep;	
			$adjdiff = $adjmax-$adjmin;		
			$adjmax = ceil($adjdiff/$majstep)*$majstep+$adjmin;
		}
		else
			$adjmax=ceil($max/$minstep)*$minstep;
			
		return array($numsteps,$adjmin,$adjmax,$minstep,$majstep);
	}
	
	
	// Determine the minimum of three values witha  weight for last value
	function matchMin3($a,$b,$c,$weight) {
		if( $a < $b ) {
			if( $a < ($c*$weight) ) 
				return 1; // $a smallest
			else 
				return 3; // $c smallest
		}
		elseif( $b < ($c*$weight) ) 
			return 2; // $b smallest
		return 3; // $c smallest
	}
} // Class

//===================================================
// CLASS RGB
// Description: Color definitions as RGB triples
//===================================================
class RGB {
	var $rgb_table;
	var $img;
	function __construct(&$img) {
		$this->img = $img;
		
		// Conversion array between color names and RGB
		$this->rgb_table = array(
			"aqua"=> array(0,255,255),		
			"lime"=> array(0,255,0),		
			"teal"=> array(0,128,128),
         "whitesmoke"=>array(245,245,245),
         "gainsboro"=>array(220,220,220),
         "oldlace"=>array(253,245,230),
         "linen"=>array(250,240,230),
         "antiquewhite"=>array(250,235,215),
         "papayawhip"=>array(255,239,213),
         "blanchedalmond"=>array(255,235,205),
         "bisque"=>array(255,228,196),
         "peachpuff"=>array(255,218,185),
         "navajowhite"=>array(255,222,173),
         "moccasin"=>array(255,228,181),
         "cornsilk"=>array(255,248,220),
         "ivory"=>array(255,255,240),
         "lemonchiffon"=>array(255,250,205),
         "seashell"=>array(255,245,238),
         "mintcream"=>array(245,255,250),
         "azure"=>array(240,255,255),
         "aliceblue"=>array(240,248,255),
         "lavender"=>array(230,230,250),
         "lavenderblush"=>array(255,240,245),
         "mistyrose"=>array(255,228,225),
         "white"=>array(255,255,255),
         "black"=>array(0,0,0),
         "darkslategray"=>array(47,79,79),
         "dimgray"=>array(105,105,105),
         "slategray"=>array(112,128,144),
         "lightslategray"=>array(119,136,153),
         "gray"=>array(190,190,190),
         "lightgray"=>array(211,211,211),
         "midnightblue"=>array(25,25,112),
         "navy"=>array(0,0,128),
         "cornflowerblue"=>array(100,149,237),
         "darkslateblue"=>array(72,61,139),
         "slateblue"=>array(106,90,205),
         "mediumslateblue"=>array(123,104,238),
         "lightslateblue"=>array(132,112,255),
         "mediumblue"=>array(0,0,205),
         "royalblue"=>array(65,105,225),
         "blue"=>array(0,0,255),
         "dodgerblue"=>array(30,144,255),
         "deepskyblue"=>array(0,191,255),
         "skyblue"=>array(135,206,235),
         "lightskyblue"=>array(135,206,250),
         "steelblue"=>array(70,130,180),
         "lightred"=>array(211,167,168),
         "lightsteelblue"=>array(176,196,222),
         "lightblue"=>array(173,216,230),
         "powderblue"=>array(176,224,230),
         "paleturquoise"=>array(175,238,238),
         "darkturquoise"=>array(0,206,209),
         "mediumturquoise"=>array(72,209,204),
         "turquoise"=>array(64,224,208),
         "cyan"=>array(0,255,255),
         "lightcyan"=>array(224,255,255),
         "cadetblue"=>array(95,158,160),
         "mediumaquamarine"=>array(102,205,170),
         "aquamarine"=>array(127,255,212),
         "darkgreen"=>array(0,100,0),
         "darkolivegreen"=>array(85,107,47),
         "darkseagreen"=>array(143,188,143),
         "seagreen"=>array(46,139,87),
         "mediumseagreen"=>array(60,179,113),
         "lightseagreen"=>array(32,178,170),
         "palegreen"=>array(152,251,152),
         "springgreen"=>array(0,255,127),
         "lawngreen"=>array(124,252,0),
         "green"=>array(0,255,0),
         "chartreuse"=>array(127,255,0),
         "mediumspringgreen"=>array(0,250,154),
         "greenyellow"=>array(173,255,47),
         "limegreen"=>array(50,205,50),
         "yellowgreen"=>array(154,205,50),
         "forestgreen"=>array(34,139,34),
         "olivedrab"=>array(107,142,35),
         "darkkhaki"=>array(189,183,107),
         "khaki"=>array(240,230,140),
         "palegoldenrod"=>array(238,232,170),
         "lightgoldenrodyellow"=>array(250,250,210),
         "lightyellow"=>array(255,255,200),
         "yellow"=>array(255,255,0),
         "gold"=>array(255,215,0),
         "lightgoldenrod"=>array(238,221,130),
         "goldenrod"=>array(218,165,32),
         "darkgoldenrod"=>array(184,134,11),
         "rosybrown"=>array(188,143,143),
         "indianred"=>array(205,92,92),
         "saddlebrown"=>array(139,69,19),
         "sienna"=>array(160,82,45),
         "peru"=>array(205,133,63),
         "burlywood"=>array(222,184,135),
         "beige"=>array(245,245,220),
         "wheat"=>array(245,222,179),
         "sandybrown"=>array(244,164,96),
         "tan"=>array(210,180,140),
         "chocolate"=>array(210,105,30),
         "firebrick"=>array(178,34,34),
         "brown"=>array(165,42,42),
         "darksalmon"=>array(233,150,122),
         "salmon"=>array(250,128,114),
         "lightsalmon"=>array(255,160,122),
         "orange"=>array(255,165,0),
         "darkorange"=>array(255,140,0),
         "coral"=>array(255,127,80),
         "lightcoral"=>array(240,128,128),
         "tomato"=>array(255,99,71),
         "orangered"=>array(255,69,0),
          "red"=>array(255,0,0),
         "hotpink"=>array(255,105,180),
         "deeppink"=>array(255,20,147),
         "pink"=>array(255,192,203),
         "lightpink"=>array(255,182,193),
         "palevioletred"=>array(219,112,147),
         "maroon"=>array(176,48,96),
         "mediumvioletred"=>array(199,21,133),
         "violetred"=>array(208,32,144),
         "magenta"=>array(255,0,255),
         "violet"=>array(238,130,238),
         "plum"=>array(221,160,221),
         "orchid"=>array(218,112,214),
         "mediumorchid"=>array(186,85,211),
         "darkorchid"=>array(153,50,204),
         "darkviolet"=>array(148,0,211),
         "blueviolet"=>array(138,43,226),
         "purple"=>array(160,32,240),
         "mediumpurple"=>array(147,112,219),
         "thistle"=>array(216,191,216),
         "snow1"=>array(255,250,250),
         "snow2"=>array(238,233,233),
         "snow3"=>array(205,201,201),
         "snow4"=>array(139,137,137),
         "seashell1"=>array(255,245,238),
         "seashell2"=>array(238,229,222),
         "seashell3"=>array(205,197,191),
         "seashell4"=>array(139,134,130),
         "AntiqueWhite1"=>array(255,239,219),
         "AntiqueWhite2"=>array(238,223,204),
         "AntiqueWhite3"=>array(205,192,176),
         "AntiqueWhite4"=>array(139,131,120),
         "bisque1"=>array(255,228,196),
         "bisque2"=>array(238,213,183),
         "bisque3"=>array(205,183,158),
         "bisque4"=>array(139,125,107),
         "peachPuff1"=>array(255,218,185),
         "peachpuff2"=>array(238,203,173),
         "peachpuff3"=>array(205,175,149),
         "peachpuff4"=>array(139,119,101),
         "navajowhite1"=>array(255,222,173),
         "navajowhite2"=>array(238,207,161),
         "navajowhite3"=>array(205,179,139),
         "navajowhite4"=>array(139,121,94),
         "lemonchiffon1"=>array(255,250,205),
         "lemonchiffon2"=>array(238,233,191),
         "lemonchiffon3"=>array(205,201,165),
         "lemonchiffon4"=>array(139,137,112),
         "ivory1"=>array(255,255,240),
         "ivory2"=>array(238,238,224),
         "ivory3"=>array(205,205,193),
         "ivory4"=>array(139,139,131),
         "honeydew"=>array(193,205,193),
         "lavenderblush1"=>array(255,240,245),
         "lavenderblush2"=>array(238,224,229),
         "lavenderblush3"=>array(205,193,197),
         "lavenderblush4"=>array(139,131,134),
         "mistyrose1"=>array(255,228,225),
         "mistyrose2"=>array(238,213,210),
         "mistyrose3"=>array(205,183,181),
         "mistyrose4"=>array(139,125,123),
         "azure1"=>array(240,255,255),
         "azure2"=>array(224,238,238),
         "azure3"=>array(193,205,205),
         "azure4"=>array(131,139,139),
         "slateblue1"=>array(131,111,255),
         "slateblue2"=>array(122,103,238),
         "slateblue3"=>array(105,89,205),
         "slateblue4"=>array(71,60,139),
         "royalblue1"=>array(72,118,255),
         "royalblue2"=>array(67,110,238),
         "royalblue3"=>array(58,95,205),
         "royalblue4"=>array(39,64,139),
         "dodgerblue1"=>array(30,144,255),
         "dodgerblue2"=>array(28,134,238),
         "dodgerblue3"=>array(24,116,205),
         "dodgerblue4"=>array(16,78,139),
         "steelblue1"=>array(99,184,255),
         "steelblue2"=>array(92,172,238),
         "steelblue3"=>array(79,148,205),
         "steelblue4"=>array(54,100,139),
         "deepskyblue1"=>array(0,191,255),
         "deepskyblue2"=>array(0,178,238),
         "deepskyblue3"=>array(0,154,205),
         "deepskyblue4"=>array(0,104,139),
         "skyblue1"=>array(135,206,255),
         "skyblue2"=>array(126,192,238),
         "skyblue3"=>array(108,166,205),
         "skyblue4"=>array(74,112,139),
         "lightskyblue1"=>array(176,226,255),
         "lightskyblue2"=>array(164,211,238),
         "lightskyblue3"=>array(141,182,205),
         "lightskyblue4"=>array(96,123,139),
         "slategray1"=>array(198,226,255),
         "slategray2"=>array(185,211,238),
         "slategray3"=>array(159,182,205),
         "slategray4"=>array(108,123,139),
         "lightsteelblue1"=>array(202,225,255),
         "lightsteelblue2"=>array(188,210,238),
         "lightsteelblue3"=>array(162,181,205),
         "lightsteelblue4"=>array(110,123,139),
         "lightblue1"=>array(191,239,255),
         "lightblue2"=>array(178,223,238),
         "lightblue3"=>array(154,192,205),
         "lightblue4"=>array(104,131,139),
         "lightcyan1"=>array(224,255,255),
         "lightcyan2"=>array(209,238,238),
         "lightcyan3"=>array(180,205,205),
         "lightcyan4"=>array(122,139,139),
         "paleturquoise1"=>array(187,255,255),
         "paleturquoise2"=>array(174,238,238),
         "paleturquoise3"=>array(150,205,205),
         "paleturquoise4"=>array(102,139,139),
         "cadetblue1"=>array(152,245,255),
         "cadetblue2"=>array(142,229,238),
         "cadetblue3"=>array(122,197,205),
         "cadetblue4"=>array(83,134,139),
         "turquoise1"=>array(0,245,255),
         "turquoise2"=>array(0,229,238),
         "turquoise3"=>array(0,197,205),
         "turquoise4"=>array(0,134,139),
         "cyan1"=>array(0,255,255),
         "cyan2"=>array(0,238,238),
         "cyan3"=>array(0,205,205),
         "cyan4"=>array(0,139,139),
         "darkslategray1"=>array(151,255,255),
         "darkslategray2"=>array(141,238,238),
         "darkslategray3"=>array(121,205,205),
         "darkslategray4"=>array(82,139,139),
         "aquamarine1"=>array(127,255,212),
         "aquamarine2"=>array(118,238,198),
         "aquamarine3"=>array(102,205,170),
         "aquamarine4"=>array(69,139,116),
         "darkseagreen1"=>array(193,255,193),
         "darkseagreen2"=>array(180,238,180),
         "darkseagreen3"=>array(155,205,155),
         "darkseagreen4"=>array(105,139,105),
         "seagreen1"=>array(84,255,159),
         "seagreen2"=>array(78,238,148),
         "seagreen3"=>array(67,205,128),
         "seagreen4"=>array(46,139,87),
         "palegreen1"=>array(154,255,154),
         "palegreen2"=>array(144,238,144),
         "palegreen3"=>array(124,205,124),
         "palegreen4"=>array(84,139,84),
         "springgreen1"=>array(0,255,127),
         "springgreen2"=>array(0,238,118),
         "springgreen3"=>array(0,205,102),
         "springgreen4"=>array(0,139,69),
         "chartreuse1"=>array(127,255,0),
         "chartreuse2"=>array(118,238,0),
         "chartreuse3"=>array(102,205,0),
         "chartreuse4"=>array(69,139,0),
         "olivedrab1"=>array(192,255,62),
         "olivedrab2"=>array(179,238,58),
         "olivedrab3"=>array(154,205,50),
         "olivedrab4"=>array(105,139,34),
         "darkolivegreen1"=>array(202,255,112),
         "darkolivegreen2"=>array(188,238,104),
         "darkolivegreen3"=>array(162,205,90),
         "darkolivegreen4"=>array(110,139,61),
         "khaki1"=>array(255,246,143),
         "khaki2"=>array(238,230,133),
         "khaki3"=>array(205,198,115),
         "khaki4"=>array(139,134,78),
         "lightgoldenrod1"=>array(255,236,139),
         "lightgoldenrod2"=>array(238,220,130),
         "lightgoldenrod3"=>array(205,190,112),
         "lightgoldenrod4"=>array(139,129,76),
         "yellow1"=>array(255,255,0),
         "yellow2"=>array(238,238,0),
         "yellow3"=>array(205,205,0),
         "yellow4"=>array(139,139,0),
         "gold1"=>array(255,215,0),
         "gold2"=>array(238,201,0),
         "gold3"=>array(205,173,0),
         "gold4"=>array(139,117,0),
         "goldenrod1"=>array(255,193,37),
         "goldenrod2"=>array(238,180,34),
         "goldenrod3"=>array(205,155,29),
         "goldenrod4"=>array(139,105,20),
         "darkgoldenrod1"=>array(255,185,15),
         "darkgoldenrod2"=>array(238,173,14),
         "darkgoldenrod3"=>array(205,149,12),
         "darkgoldenrod4"=>array(139,101,8),
         "rosybrown1"=>array(255,193,193),
         "rosybrown2"=>array(238,180,180),
         "rosybrown3"=>array(205,155,155),
         "rosybrown4"=>array(139,105,105),
         "indianred1"=>array(255,106,106),
         "indianred2"=>array(238,99,99),
         "indianred3"=>array(205,85,85),
         "indianred4"=>array(139,58,58),
         "sienna1"=>array(255,130,71),
         "sienna2"=>array(238,121,66),
         "sienna3"=>array(205,104,57),
         "sienna4"=>array(139,71,38),
         "burlywood1"=>array(255,211,155),
         "burlywood2"=>array(238,197,145),
         "burlywood3"=>array(205,170,125),
         "burlywood4"=>array(139,115,85),
         "wheat1"=>array(255,231,186),
         "wheat2"=>array(238,216,174),
         "wheat3"=>array(205,186,150),
         "wheat4"=>array(139,126,102),
         "tan1"=>array(255,165,79),
         "tan2"=>array(238,154,73),
         "tan3"=>array(205,133,63),
         "tan4"=>array(139,90,43),
         "chocolate1"=>array(255,127,36),
         "chocolate2"=>array(238,118,33),
         "chocolate3"=>array(205,102,29),
         "chocolate4"=>array(139,69,19),
         "firebrick1"=>array(255,48,48),
         "firebrick2"=>array(238,44,44),
         "firebrick3"=>array(205,38,38),
         "firebrick4"=>array(139,26,26),
         "brown1"=>array(255,64,64),
         "brown2"=>array(238,59,59),
         "brown3"=>array(205,51,51),
         "brown4"=>array(139,35,35),
         "salmon1"=>array(255,140,105),
         "salmon2"=>array(238,130,98),
         "salmon3"=>array(205,112,84),
         "salmon4"=>array(139,76,57),
         "lightsalmon1"=>array(255,160,122),
         "lightsalmon2"=>array(238,149,114),
         "lightsalmon3"=>array(205,129,98),
         "lightsalmon4"=>array(139,87,66),
         "orange1"=>array(255,165,0),
         "orange2"=>array(238,154,0),
         "orange3"=>array(205,133,0),
         "orange4"=>array(139,90,0),
         "darkorange1"=>array(255,127,0),
         "darkorange2"=>array(238,118,0),
         "darkorange3"=>array(205,102,0),
         "darkorange4"=>array(139,69,0),
         "coral1"=>array(255,114,86),
         "coral2"=>array(238,106,80),
         "coral3"=>array(205,91,69),
         "coral4"=>array(139,62,47),
         "tomato1"=>array(255,99,71),
         "tomato2"=>array(238,92,66),
         "tomato3"=>array(205,79,57),
         "tomato4"=>array(139,54,38),
         "orangered1"=>array(255,69,0),
         "orangered2"=>array(238,64,0),
         "orangered3"=>array(205,55,0),
         "orangered4"=>array(139,37,0),
         "deeppink1"=>array(255,20,147),
         "deeppink2"=>array(238,18,137),
         "deeppink3"=>array(205,16,118),
         "deeppink4"=>array(139,10,80),
         "hotpink1"=>array(255,110,180),
         "hotpink2"=>array(238,106,167),
         "hotpink3"=>array(205,96,144),
         "hotpink4"=>array(139,58,98),
         "pink1"=>array(255,181,197),
         "pink2"=>array(238,169,184),
         "pink3"=>array(205,145,158),
         "pink4"=>array(139,99,108),
         "lightpink1"=>array(255,174,185),
         "lightpink2"=>array(238,162,173),
         "lightpink3"=>array(205,140,149),
         "lightpink4"=>array(139,95,101),
         "palevioletred1"=>array(255,130,171),
         "palevioletred2"=>array(238,121,159),
         "palevioletred3"=>array(205,104,137),
         "palevioletred4"=>array(139,71,93),
         "maroon1"=>array(255,52,179),
         "maroon2"=>array(238,48,167),
         "maroon3"=>array(205,41,144),
         "maroon4"=>array(139,28,98),
         "violetred1"=>array(255,62,150),
         "violetred2"=>array(238,58,140),
         "violetred3"=>array(205,50,120),
         "violetred4"=>array(139,34,82),
         "magenta1"=>array(255,0,255),
         "magenta2"=>array(238,0,238),
         "magenta3"=>array(205,0,205),
         "magenta4"=>array(139,0,139),
			   "mediumred"=>array(140,34,34),         
         "orchid1"=>array(255,131,250),
         "orchid2"=>array(238,122,233),
         "orchid3"=>array(205,105,201),
         "orchid4"=>array(139,71,137),
         "plum1"=>array(255,187,255),
         "plum2"=>array(238,174,238),
         "plum3"=>array(205,150,205),
         "plum4"=>array(139,102,139),
         "mediumorchid1"=>array(224,102,255),
         "mediumorchid2"=>array(209,95,238),
         "mediumorchid3"=>array(180,82,205),
         "mediumorchid4"=>array(122,55,139),
         "darkorchid1"=>array(191,62,255),
         "darkorchid2"=>array(178,58,238),
         "darkorchid3"=>array(154,50,205),
         "darkorchid4"=>array(104,34,139),
         "purple1"=>array(155,48,255),
         "purple2"=>array(145,44,238),
         "purple3"=>array(125,38,205),
         "purple4"=>array(85,26,139),
         "mediumpurple1"=>array(171,130,255),
         "mediumpurple2"=>array(159,121,238),
         "mediumpurple3"=>array(137,104,205),
         "mediumpurple4"=>array(93,71,139),
         "thistle1"=>array(255,225,255),
         "thistle2"=>array(238,210,238),
         "thistle3"=>array(205,181,205),
         "thistle4"=>array(139,123,139),
         "gray1"=>array(10,10,10),
         "gray2"=>array(40,40,30),
         "gray3"=>array(70,70,70),
         "gray4"=>array(100,100,100),
         "gray5"=>array(130,130,130),
         "gray6"=>array(160,160,160),
         "gray7"=>array(190,190,190),
         "gray8"=>array(210,210,210),
  	      "gray9"=>array(240,240,240),
         "darkgray"=>array(169,169,169),
         "darkblue"=>array(0,0,139),
         "darkcyan"=>array(0,139,139),
         "darkmagenta"=>array(139,0,139),
         "darkred"=>array(139,0,0),
         "silver"=>array(192, 192, 192),
         "eggplant"=>array(144,176,168),
         "lightgreen"=>array(144,238,144));		
	}
//----------------
// PUBLIC METHODS
	// Colors can be specified as either
	// 1. #xxxxxx			HTML style
	// 2. "colorname" 	as a named color
	// 3. array(r,g,b)	RGB triple
	// This function translates this to a native RGB format and returns an 
	// RGB triple.
	function Color($color) {
		if (is_string($color)) {
      	if (substr($color, 0, 1) == STRING_CANCELLETTO) {
	  			return array(hexdec(substr($color, 1, 2)), 
		      	hexdec(substr($color, 3, 2)),
		       	hexdec(substr($color, 5, 2)));
      	} else {
	  			$tmp=$this->rgb_table[$color];
	  			if( $tmp== null ) die("JpGraph: Unknown color: $color");
	  			return $tmp;
 			}
		} elseif( is_array($color) && (count($color)==3) ) {
			return $color;
		}
		else
			die("JpGraph Error: Unknown color specification: $color , size=".count($color));
	}
	
	// Allocate a new color in the current image
	// Return new color index, -1 if no more colors could be allocated
	function Allocate($color) {
  		list ($r, $g, $b) = $this->color($color);
		$index = imagecolorexact($this->img, $r, $g, $b);
		if ($index == -1) {
      	$index = imagecolorallocate($this->img, $r, $g, $b);
      	if( JPGRAPH_USE_APPROX_COLORS && $index == -1 )
      		$index = imagecolorresolve($this->img, $r, $g, $b);
 		} 
      return $index;
	}
} // Class

//===================================================
// CLASS Image
// Description: Wrapper class with some goodies to form the
// Interface to low level image drawing routines.
//===================================================
class Image {
	use Creator;
	
	var $img_format;
	var $expired=false;
	var $img;
	var $left_margin=30,$right_margin=30,$top_margin=20,$bottom_margin=30;
	var $plotwidth,$plotheight;
	var $rgb;
	var $current_color;
	var $lastx=0, $lasty=0;
	var $width, $height;
	var $line_weight=1;
	var $line_style=1;	// Default line style is solid
	var $obs_list=array();
	var $font_size=12,$font_family=JPGRAPH_FONT1, $font_style=JPGRAPH_FS_NORMAL;
	var $text_halign="left",$text_valign="bottom";
	var $ttf=null;
	var $use_anti_aliasing=false;
	var $quality=null;
	var $colorstack=array(),$colorstackidx=0;
	//---------------
	// CONSTRUCTOR
	function __construct($aWidth,$aHeight,$aFormat=DEFAULT_GFORMAT) {
		assert($aHeight>0 && $aWidth>0);
		$this->img = imagecreate($aWidth, $aHeight);	
		$this->width=$aWidth;
		$this->height=$aHeight;		
		$this->setMargin($aWidth/10,$aWidth/10,$aHeight/10,$aHeight/10);
		assert($this->img != 0);
		if( !$this->setImgFormat($aFormat) ) {
			die("JpGraph: Selected graphic format is either not supported or unknown [$aFormat]");
		}
		$this->rgb = Creator::create("RGB",STRING_NULL,$this->img);	
		$this->ttf = Creator::create("TTF",STRING_NULL);
		// First index is background so this will be white
		$this->setColor("white");
	}
				
	//---------------
	// PUBLIC METHODS	

	// Add observer. The observer will be notified when
	// the margin changes
	function addObserver($meth,&$obj) {
		$this->obs_list[]=array($meth,&$obj);
	}
	
	// Call all observers
	function notifyObservers() {
		foreach( $this->obs_list as $o )
			$o[1]->$o[0]($this);
	}
	
	function setFont($family,$style=JPGRAPH_FS_NORMAL,$size=10) {
		if( JPGRAPH_ERR_DEPRECATED && ($family==JPGRAPH_FONT1_BOLD || $family==JPGRAPH_FONT2_BOLD) )
			die("JpGraph Error: Usage of $family is deprecated.");
		$this->font_family=$family;
		$this->font_style=$style;
		$this->font_size=$size;
	}
	
	function getTextHeight($txt=STRING_NULL,$angle=0) {
		if( $this->font_family <= JPGRAPH_FONT2_BOLD ) {
			if( $angle==0 )
				return imagefontheight($this->font_family);
			else 
				return strlen($txt)*imagefontwidth($this->font_family);
		}
		else {
			$file = $this->ttf->File($this->font_family,$this->font_style);			
			$bbox = ImageTTFBBox($this->font_size,$angle,$file,$txt);
			return abs($bbox[5])+abs($bbox[1]); // upper_right_y - lower_left_y			
		}
	}
	
	function getFontHeight($txt="XMg",$angle=0) {
		return $this->GetTextHeight($txt,$angle);
	}
	
	function getTextWidth(&$txt,$angle=0) {
		if( $this->font_family <= JPGRAPH_FONT2_BOLD ) {
			if( $angle==0 )
				return strlen($txt)*imagefontwidth($this->font_family);
			else
				return imagefontheight($this->font_family);
		}
		else {
			$file = $this->ttf->File($this->font_family,$this->font_style);			
			$bbox = ImageTTFBBox($this->font_size,$angle,$file,$txt);
			return abs($bbox[2]-$bbox[6]);
		}
	}
	
	function strokeBoxedText($x,$y,$txt,$dir,$fcolor,$bcolor,$shadow=false) {
		if( !is_numeric($dir) ) {
			if( $dir=="h" ) $dir=0;
			elseif( $dir=="v" ) $dir=90;
			else die("JpGraph Error: Unknown direction specified in call to StrokeBoxedText() [$dir]");
		}
		
		if( ($this->font_family==JPGRAPH_FONT1 || $this->font_family==JPGRAPH_FONT2) && $this->font_style==JPGRAPH_FS_BOLD )
			++$this->font_family;
		
		$width=$this->getTextWidth($txt,$dir);
		$height=$this->getTextHeight($txt,$dir);

		if( $this->font_family<=JPGRAPH_FONT2_BOLD ) {
			$xmarg=3;	
			$ymarg=3;
		}
		else {
			$xmarg=6;	
			$ymarg=6;
		}		
		$height += 2*$ymarg;
		$width += 2*$xmarg;
		if( $this->text_halign=="right" ) $x -= $width;
		elseif( $this->text_halign=="center" ) $x -= $width/2;
		if( $this->text_valign=="bottom" ) $y -= $height;
		elseif( $this->text_valign=="center" ) $y -= $height/2;
	
		if( $shadow ) {
			$oc=$this->current_color;
			$this->setColor($bcolor);
			$this->shadowRectangle($x,$y,$x+$width+2,$y+$height+2,$fcolor,2);
			$this->current_color=$oc;
		}
		else {
			if( $fcolor ) {
				$oc=$this->current_color;
				$this->setColor($fcolor);
				$this->filledRectangle($x,$y,$x+$width,$y+$height);
				$this->current_color=$oc;
			}
			if( $bcolor ) {
				$oc=$this->current_color;
				$this->setColor($bcolor);			
				$this->rectangle($x,$y,$x+$width,$y+$height);
				$this->current_color=$oc;			
			}
		}
		
		$h=$this->text_halign;
		$v=$this->text_valign;
		$this->setTextAlign("left","top");
		$this->strokeText($x+$xmarg, $y+$ymarg, $txt, $dir);
		$this->setTextAlign($h,$v);
	}
	
	function setTextAlign($halign,$valign="bottom") {
		$this->text_halign=$halign;
		$this->text_valign=$valign;
	}
	
	function setAntiAliasing() {
		$this->use_anti_aliasing=true;
	}
	
	function strokeText($x,$y,$txt,$dir=0) {
		if( !is_numeric($dir) )
			die("JpGraph Error: Direction for text most be given as an angle between 0 and 90.");
			
		if( $this->font_family >= JPGRAPH_FF_FONT0 && $this->font_family <= JPGRAPH_FF_FONT2) {	// Internal font
			if( is_numeric($dir) && $dir!=90 && $dir!=0) 
				die("JpGraph Error: Internal font does not support drawing text at arbitrary angle. Use TTF fonts instead.");

			if( ($this->font_family==JPGRAPH_FF_FONT1 || $this->font_family==JPGRAPH_FF_FONT2) && $this->font_style==JPGRAPH_FS_BOLD )
				++$this->font_family;

			$h=$this->getFontHeight($txt);
			
			if (preg_match("/\n/",$txt)) { //If the text has "\n"...
			//Get the width for the two tokens
				$tmp=split("\n",$txt);
				$w=$this->getTextWidth($tmp[0]);
				$w2=$this->getTextWidth($tmp[1]);
			}else{
				//Get the width for the text
				$w=$this->getTextWidth($txt);
			}

			if( $this->text_halign=="right") 				
				$x -= $dir==0 ? $w : $h;
			elseif( $this->text_halign=="center" ) 
				$x -= $dir==0 ? $w/2 : $h/2;
				
			if( $this->text_valign=="top" )
				$y +=	$dir==0 ? $h : $w;
			elseif( $this->text_valign=="center" ) 				
				$y +=	$dir==0 ? $h/2 : $w/2;
				
			if( $dir==90 )
				imagestringup($this->img,$this->font_family,$x,$y,$txt,$this->current_color);
			else	{
				if (preg_match("/\n/",$txt)) { //If the text has "\n"...
					$tmp=split("\n",$txt);
					 //Put the two tokens centered
					imagestring($this->img,$this->font_family,$x,$y-$h+1,$tmp[0],$this->current_color);
					imagestring($this->img,$this->font_family,($x-(($w2-$w)/2)),$y+1,$tmp[1],$this->current_color);
				}else{
					//Put the text
					imagestring($this->img,$this->font_family,$x,$y-$h+1,$txt,$this->current_color);
				 }
			}
		}
		elseif($this->font_family >= JPGRAPH_FF_COURIER && $this->font_family <= JPGRAPH_FF_BOOK)  { // TTF font
			$file = $this->ttf->File($this->font_family,$this->font_style);			
			$angle=$dir;
			$bbox=ImageTTFBBox($this->font_size,$angle,$file,$txt);
			if( $this->text_halign=="right" ) $x -= $bbox[2]-$bbox[0];
			elseif( $this->text_halign=="center" )	$x -= ($bbox[4]-$bbox[0])/2; 
			elseif( $this->text_halign=="topanchor" ) $x -= $bbox[4]-$bbox[0];
			elseif( $this->text_halign=="left" ) $x += -($bbox[6]-$bbox[0]);
			
			if( $this->text_valign=="top" ) $y -= $bbox[5];
			elseif( $this->text_valign=="center" )	$y -= ($bbox[5]-$bbox[1])/2; 
			elseif( $this->text_valign=="bottom" ) $y -= $bbox[1]; 
				
			// Use lower left of bbox as fix-point, not the default baselinepoint.				
			$x -= $bbox[0];
			ImageTTFText ($this->img, $this->font_size, $angle, $x, $y, $this->current_color, $file,$txt); 
		}
		else
			die("JpGraph Error: Unknown font font family specification. ");
	}
	
	function setMargin($lm,$rm,$tm,$bm) {
		$this->left_margin=$lm;
		$this->right_margin=$rm;
		$this->top_margin=$tm;
		$this->bottom_margin=$bm;
		$this->plotwidth=$this->width - $this->left_margin-$this->right_margin;
		$this->plotheight=$this->height - $this->top_margin-$this->bottom_margin;
		
		$this->notifyObservers();
	}

	function setTransparent($color) {
		imagecolortransparent ($this->img,$this->rgb->allocate($color));
	}
	
	function setColor($color) {
		$this->current_color=$this->rgb->allocate($color);
		if( $this->current_color == -1 ) {
			$tc=imagecolorstotal($this->img);
			die("<b>JpGraph Error: Can't allocate any more colors.</b><br>
				Image has already allocated maximum of <b>$tc colors</b>. 
				This might happen if you have anti-aliasing turned on
				together with a background image or perhaps gradient fill 
				since this requires many, many colors. Try to turn off
				anti-aliasing.<p>
				If there is still a problem try downgrading the quality of
				the background image to use a smaller pallete to leave some 
				entries for your graphs. You should try to limit the number
				of colors in your background image to 64.<p>
				If there is still problem set the constant 
<pre>
DEFINE(\"JPGRAPH_USE_APPROX_COLORS\",true);
</pre>
				in jpgraph.php This will use approximative colors
				when the palette is full.
				<p>
				Unfortunately there is not much JpGraph can do about this
				since the palette size is a limitation of current graphic format and
				what the underlying GD library suppports."); 
		}
		return $this->current_color;
	}
	
	function pushColor($color) {
		if( $color != STRING_NULL ) {
			$this->colorstack[$this->colorstackidx]=$this->current_color;
			++$this->colorstackidx;
			$this->setColor($color);
		}
	}
	
	function popColor() {
		--$this->colorstackidx;
		if($this->colorstackidx<0)
			die("JpGraph Error: Negative Color stack index. Unmatched call to PopColor()");
		$this->current_color=$this->colorstack[$this->colorstackidx];
	}
	// Yes,.. I know I can use the increment operators in array brackets
	// but I think this style is more readable. Agree..?
	
	function adjBrightContrast($bright,$contr=0) {
		if( $bright < -1 || $bright > 1 || $contr < -1 || $contr > 1 )
			die("JpGraph Error: Parameters for brightness and Contrast out of range [-1,1]");		
		$nbr = imagecolorstotal ($this->img);
		for( $i=0; $i<$nbr; ++$i ) {
			$colarr = imagecolorsforindex ($this->img,$i);
			$r = $this->adjRGBBrightContrast($colarr["red"],$bright,$contr);
			$g = $this->adjRGBBrightContrast($colarr["green"],$bright,$contr);
			$b = $this->adjRGBBrightContrast($colarr["blue"],$bright,$contr);		
			imagecolorset ($this->img, $i, $r, $g, $b);
		}
	}

	// Private helper function for AdjBrightContrast
	function adjRGBBrightContrast($rgb,$bright,$contr) {
		// First handle contrast, i.e change the dynamic range around grey
		if( $contr <= 0 ) {
			// Decrease contrast
			$adj = abs($rgb-128) * (-$contr);
			if( $rgb < 128 ) $rgb += $adj;
			else $rgb -= $adj;
		}
		else { // $contr > 0
			// Increase contrast
			if( $rgb < 128 ) $rgb = $rgb - ($rgb * $contr);
			else $rgb = $rgb + ((255-$rgb) * $contr);
		}
	
		// Add (or remove) various amount of white
		$rgb += $bright*255;	
		$rgb=min($rgb,255);
		$rgb=max($rgb,0);
		return $rgb;	
	}
	
	function setLineWeight($weight) {
		$this->line_weight = $weight;
	}
	
	function setStartPoint($x,$y) {
		$this->lastx=$x;
		$this->lasty=$y;
	}
	
	function arc($cx,$cy,$w,$h,$s,$e) {
		imagearc($this->img,$cx,$cy,$w,$h,$s,$e,$this->current_color);
	}

	function ellipse($xc,$yc,$w,$h) {
		$this->arc($xc,$yc,$w,$h,0,360);
	}
	
	// Breseham circle gives visually better result then using GD
	// built in arc(). It takes some more time but gives better
	// accuracy.
	function bresenhamCircle($xc,$yc,$r) {
		$d = 3-2*r;
		$x = 0;
		$y = $r;
		while($x<=$y) {
			$this->point($xc+$x,$yc+$y);			
			$this->point($xc+$x,$yc-$y);
			$this->point($xc-$x,$yc+$y);
			$this->point($xc-$x,$yc-$y);
			
			$this->point($xc+$y,$yc+$x);
			$this->point($xc+$y,$yc-$x);
			$this->point($xc-$y,$yc+$x);
			$this->point($xc-$y,$yc-$x);
			
			if( $d<0 ) $d += 4*$x+6;
			else {
				$d += 4*($x-$y)+10;		
				--$y;
			}
			++$x;
		}
	}
			
	function circle($xc,$yc,$r) {
		if( JPGRAPH_USE_BRESENHAM )
			$this->bresenhamCircle($xc,$yc,$r);
		else
			$this->arc($xc,$yc,$r*2,$r*2,0,360);		
	}
	
	function filledCircle($xc,$yc,$r) {
		for($i=0; $i<$r*2; ++$i)
			$this->arc($xc,$yc,$i,$i,0,360);
	}
	
	// Linear Color InterPolation
	function lip($f,$t,$p) {
		$p = round($p,1);
		$r = $f[0] + ($t[0]-$f[0])*$p;
		$g = $f[1] + ($t[1]-$f[1])*$p;
		$b = $f[2] + ($t[2]-$f[2])*$p;
		return array($r,$g,$b);
	}

	// Anti-aliased line. 
	// Note that this is roughly 8 times slower then a normal line!
	function wuLine($x1,$y1,$x2,$y2) {
		// Get foreground line color
		$lc = imagecolorsforindex($this->img,$this->current_color);
		$lc = array($lc["red"],$lc["green"],$lc["blue"]);

		$dx = $x2-$x1;
		$dy = $y2-$y1;
	
		if( abs($dx) > abs($dy) ) {
			if( $dx<0 ) {
				$dx = -$dx;$dy = -$dy;
				$tmp=$x2;$x2=$x1;$x1=$tmp;
				$tmp=$y2;$y2=$y1;$y1=$tmp;
			}
			$x=$x1<<16; $y=$y1<<16;
			$yinc = ($dy*65535)/$dx;
			while( ($x >> 16) < $x2 ) {
				
				$bc = imagecolorsforindex($this->img,imagecolorat($this->img,$x>>16,$y>>16));
				$bc=array($bc["red"],$bc["green"],$bc["blue"]);
				
				$this->SetColor($this->lip($lc,$bc,($y & 0xFFFF)/65535));
				imagesetpixel($this->img,$x>>16,$y>>16,$this->current_color);
				$this->SetColor($this->lip($lc,$bc,(~$y & 0xFFFF)/65535));
				imagesetpixel($this->img,$x>>16,($y>>16)+1,$this->current_color);
				$x += 65536; $y += $yinc;
			}
		}
		else {
			if( $dy<0 ) {
				$dx = -$dx;$dy = -$dy;
				$tmp=$x2;$x2=$x1;$x1=$tmp;
				$tmp=$y2;$y2=$y1;$y1=$tmp;
			}
			$x=$x1<<16; $y=$y1<<16;
			$xinc = ($dx*65535)/$dy;	
			while( ($y >> 16) < $y2 ) {
				
				$bc = imagecolorsforindex($this->img,imagecolorat($this->img,$x>>16,$y>>16));
				$bc=array($bc["red"],$bc["green"],$bc["blue"]);				
				
				$this->SetColor($this->lip($lc,$bc,($x & 0xFFFF)/65535));
				imagesetpixel($this->img,$x>>16,$y>>16,$this->current_color);
				$this->SetColor($this->lip($lc,$bc,(~$x & 0xFFFF)/65535));
				imagesetpixel($this->img,($x>>16)+1,$y>>16,$this->current_color);
				$y += 65536; $x += $xinc;
			}
		}
		$this->SetColor($lc);
		imagesetpixel($this->img,$x2,$y2,$this->current_color);		
		imagesetpixel($this->img,$x1,$y1,$this->current_color);			
	}

	// Set line style dashed, dotted etc
	function setLineStyle($s) {
		if( is_numeric($s) ) {
			if( $s<1 || $s>4 ) 
				die("JpGraph Error: Illegal numeric argument to SetLineStyle(): $s");
		}
		elseif( is_string($s) ) {
			if( $s == "solid" ) $s=1;
			elseif( $s == "dotted" ) $s=2;
			elseif( $s == "dashed" ) $s=3;
			elseif( $s == "longdashed" ) $s=4;
			else die("JpGraph Error: Illegal string argument to SetLineStyle(): $s");
		}
		else die("JpGraph Error: Illegal argument to SetLineStyle $s");
		$this->line_style=$s;
	}
	
	// Same as Line but take the line_style into account
	function styleLine($x1,$y1,$x2,$y2) {
		switch( $this->line_style ) {
			case 1:// Solid
				$this->line($x1,$y1,$x2,$y2);
				break;
			case 2: // Dotted
				$this->dashedLine($x1,$y1,$x2,$y2,1,6);
				break;
			case 3: // Dashed
				$this->dashedLine($x1,$y1,$x2,$y2,2,4);
				break;
			case 4: // Longdashes
				$this->dashedLine($x1,$y1,$x2,$y2,8,6);
				break;
			default:
				die("JpGraph Error: Unknown line style: $this->line_style ");
				break;
		}
	}

	function line($x1,$y1,$x2,$y2) {
		if( $this->use_anti_aliasing ) {
			$dx = $x2-$x1;
			$dy = $y2-$y1;
			// Vertical, Horizontal or 45 lines don't need anti-aliasing
			if( $dx!=0 && $dy!=0 && $dx!=$dy ) {
				$this->wuLine($x1,$y1,$x2,$y2);
				return;
			}
		}
		if( $this->line_weight==1 )
			imageline($this->img,$x1,$y1,$x2,$y2,$this->current_color);
		elseif( $x1==$x2 ) {		// Special case for vertical lines
			imageline($this->img,$x1,$y1,$x2,$y2,$this->current_color);
			$w1=floor($this->line_weight/2);
			$w2=floor(($this->line_weight-1)/2);
			for($i=1; $i<=$w1; ++$i) 
				imageline($this->img,$x1+$i,$y1,$x2+$i,$y2,$this->current_color);
			for($i=1; $i<=$w2; ++$i) 
				imageline($this->img,$x1-$i,$y1,$x2-$i,$y2,$this->current_color);
		}
		elseif( $y1==$y2 ) {		// Special case for horizontal lines
			imageline($this->img,$x1,$y1,$x2,$y2,$this->current_color);
			$w1=floor($this->line_weight/2);
			$w2=floor(($this->line_weight-1)/2);
			for($i=1; $i<=$w1; ++$i) 
				imageline($this->img,$x1,$y1+$i,$x2,$y2+$i,$this->current_color);
			for($i=1; $i<=$w2; ++$i) 
				imageline($this->img,$x1,$y1-$i,$x2,$y2-$i,$this->current_color);		
		}
		else {	// General case with a line at an angle
			$a = atan2($y1-$y2,$x2-$x1);
			// Now establish some offsets from the center. This gets a little
			// bit involved since we are dealing with integer functions and we
			// want the apperance to be as smooth as possible and never be thicker
			// then the specified width.
			
			// We do the trig stuff to make sure that the endpoints of the line
			// are perpendicular to the line itself.
			$dx=(sin($a)*$this->line_weight/2);
			$dy=(cos($a)*$this->line_weight/2);

			$pnts = array($x2+$dx,$y2+$dy,$x2-$dx,$y2-$dy,$x1-$dx,$y1-$dy,$x1+$dx,$y1+$dy);
			imagefilledpolygon($this->img,$pnts,count($pnts)/2,$this->current_color);
		}		
		$this->lastx=$x2; $this->lasty=$y2;		
	}
	
	function polygon($p) {
		$n=count($p)/2;
		for( $i=0; $i<$n; ++$i ) {
			$j=($i+1)%$n;
			$this->line($p[$i*2],$p[$i*2+1],$p[$j*2],$p[$j*2+1]);
		}
	}
	
	function filledPolygon($points) {
		imagefilledpolygon($this->img,$points,count($points)/2,$this->current_color);
	}
	
	function rectangle($xl,$yu,$xr,$yl) {
		$this->Polygon(array($xl,$yu,$xr,$yu,$xr,$yl,$xl,$yl));
		//imagerectangle($this->img,$xl,$yu,$xr,$yl,$this->current_color);
	}
	
	function filledRectangle($xl,$yu,$xr,$yl) {
		$this->filledPolygon(array($xl,$yu,$xr,$yu,$xr,$yl,$xl,$yl));
		//imagefilledrectangle($this->img,$xl,$yu,$xr,$yl,$this->current_color);
	}
	
	function shadowRectangle($xl,$yu,$xr,$yl,$fcolor=false,$shadow_width=3,$shadow_color=array(102,102,102)) {
		if( $fcolor==false )
			$this->rectangle($xl,$yu,$xr-$shadow_width-1,$yl-$shadow_width-1);
		else {		
			$oc=$this->current_color;//echo "fcolor=$fcolor[0],$fcolor[1],$fcolor[2]";
			$this->setColor($fcolor);
			$this->filledRectangle($xl,$yu,$xr-$shadow_width-1,$yl-$shadow_width-1);
			$this->current_color=$oc;
			$this->rectangle($xl,$yu,$xr-$shadow_width-1,$yl-$shadow_width-1);							
		}
		$this->setColor($shadow_color);
		$this->filledRectangle($xr-$shadow_width,$yu+$shadow_width,$xr,$yl);
		$this->filledRectangle($xl+$shadow_width,$yl-$shadow_width,$xr,$yl);
	}

	function styleLineTo($x,$y) {
		$this->styleLine($this->lastx,$this->lasty,$x,$y);
		$this->lastx=$x;
		$this->lasty=$y;
	}
	
	function lineTo($x,$y) {
		$this->line($this->lastx,$this->lasty,$x,$y);
		$this->lastx=$x;
		$this->lasty=$y;
	}
	
	function point($x,$y) {
		imagesetpixel($this->img,$x,$y,$this->current_color);
	}
	
	function fill($x,$y) {
		imagefill($this->img,$x,$y,$this->current_color);
	}
	
	function dashedLine($x1,$y1,$x2,$y2,$dash_length=1,$dash_space=4) {
		// Code based on, but not identical to, work by Ariel Garza and James Pine
		$line_length = ceil (sqrt(pow(($x2 - $x1),2) + pow(($y2 - $y1),2)) );
		$dx = ($x2 - $x1) / $line_length;
		$dy = ($y2 - $y1) / $line_length;
		$lastx = $x1; $lasty = $y1;
		$xmax = max($x1,$x2);
		$xmin = min($x1,$x2);
		$ymax = max($y1,$y2);
		$ymin = min($y1,$y2);
		for ($i = 0; $i < $line_length; $i += ($dash_length + $dash_space)) {
			$x = ($dash_length * $dx) + $lastx;
			$y = ($dash_length * $dy) + $lasty;
			
			// The last section might overshoot so we must take a computational hit
			// and check this.
			if( $x>$xmax ) $x=$xmax;
			if( $y>$ymax ) $y=$ymax;
			
			if( $x<$xmin ) $x=$xmin;
			if( $y<$ymin ) $y=$ymin;

			$this->line($lastx,$lasty,$x,$y);
			$lastx = $x + ($dash_space * $dx);
			$lasty = $y + ($dash_space * $dy);
		} 
	} 
	
	// Generate image header
	function headers() {
		if ($this->expired) {
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
			header("Cache-Control: no-cache, must-revalidate");
			header("Pragma: no-cache");
		}
		if( $this->img_format=="jpg" )
			header("Content-type: image/jpeg");
		else
			header("Content-type: image/$this->img_format");
	}

	// Adjust image quality for formats that allow this
	function setQuality($q) {
			$this->quality = $q;
	}
	
	// Stream image to browser or to file
	function stream($aFile="") {
		if( $this->img_format=="jpg" ) {
			if( $this->quality != null )
				$res = imagejpeg($this->img,$aFile,$this->quality);
			elseif(  $aFile != "" ) {
				$res = imagejpeg($this->img,$aFile);
			}
			else
				$res = imagejpeg($this->img);
		}
		else
			$func="image".$this->img_format;
		if( $aFile != "" ) {
			$res = @$func($this->img,$aFile);
		}
		else
			$res = $func($this->img);
		if( !$res )
			die("JpGraph Error: Can't create image with name $aFile");
		
	}
		
	// Clear resource tide up by image
	function destroy() {
		imagedestroy($this->img);
	}
	
	// Specify image format. Note depending on your installation
	// of PHP not all formats may be supported.
	function setImgFormat($aFormat) {		
		$aFormat = strtolower($aFormat);
		$tst = true;
		$supported = imagetypes();
		if( $aFormat=="auto" ) {
			if( $supported & IMG_PNG )
				$this->img_format="png";
			elseif( $supported & IMG_GIF )
				$this->img_format="gif";
			elseif( $supported & IMG_JPG )
				$this->img_format="jpg";
			else
				die("JpGraph Error: Your PHP (and GD-lib) installation does not appear to support any known graphic formats.".
				"You need to first make sure GD is compiled as a module to PHP. If you also want to use JPEG images".
				"you must get the JPEG library. Please see the PHP docs for details.");
				
			return true;
		}
		else {
			if( $aFormat=="jpg" || $aFormat=="png" || $aFormat=="gif" ) {
				if( $aFormat=="jpg" && !($supported & IMG_JPG) )
					$tst=false;
				elseif( $aFormat=="png" && !($supported & IMG_PNG) ) 
					$tst=false;
				elseif( $aFormat=="gif" && !($supported & IMG_GIF) ) 	
					$tst=false;
				else {
					$this->img_format=$aFormat;
					return true;
				}
			}
			else 
				$tst=false;
			if( !$tst )
				die("JpGraph Error: Your PHP installation does not support the chosen graphic format: $aFormat");
		}
	}	
} // CLASS

//===================================================
// CLASS RotImage
// Description: Exactly as Image but draws the image at
// a specified angle around a specified rotation point.
//===================================================
class RotImage extends Image {
	var $m=array();
	var $a=0;
	var $dx=0,$dy=0; 
	
	function __construct($aWidth,$aHeight,$a=0,$aFormat=DEFAULT_GFORMAT) {
		parent::__construct($aWidth,$aHeight,$aFormat);
		$this->dx=$this->left_margin+$this->plotwidth/2;
		$this->dy=$this->top_margin+$this->plotheight/2;
		$this->SetAngle($a);	
	}
	
	function setCenter($dx,$dy) {
		$this->dx=$dx;
		$this->dy=$dy;
	}
	
	function setAngle($a) {
		$tmp = $this->a;
		$this->a = $a;
		$a *= M_PI/180;
		$sa=sin($a); $ca=cos($a);
		
		// Create the rotation matrix
		$this->m[0][0] = $ca;
		$this->m[0][1] = -$sa;
		$this->m[0][2] = $this->dx*(1-$ca) + $sa*$this->dy ;
		$this->m[1][0] = $sa;
		$this->m[1][1] = $ca;
		$this->m[1][2] = $this->dy*(1-$ca) - $sa*$this->dx ;
		return $tmp;
	}
	
	function setMargin($lm,$rm,$tm,$bm) {	
		parent::setMargin($lm,$rm,$tm,$bm);
		$this->setAngle($this->a);
	}
	
	function rotate($x,$y) {
		$x1=round($this->m[0][0]*$x + $this->m[0][1]*$y + $this->m[0][2]);
		$y1=round($this->m[1][0]*$x + $this->m[1][1]*$y + $this->m[1][2]);
		return array($x1,$y1);
	}
	
	function arrRotate($pnts) {
		for($i=0; $i<count($pnts)-1; $i+=2)
			list($pnts[$i],$pnts[$i+1]) = $this->rotate($pnts[$i],$pnts[$i+1]);
		return $pnts;
	}
	
	function line($x1,$y1,$x2,$y2) {
		list($x1,$y1) = $this->rotate($x1,$y1);
		list($x2,$y2) = $this->rotate($x2,$y2);
		parent::line($x1,$y1,$x2,$y2);
	}
	
	function rectangle($x1,$y1,$x2,$y2) {
		$this->polygon(array($x1,$y1,$x2,$y1,$x2,$y2,$x1,$y2));
	}
	
	function filledRectangle($x1,$y1,$x2,$y2) {
		if( $y1==$y2 || $x1==$x2 )
			$this->line($x1,$y1,$x2,$y2);
		else 
			$this->filledPolygon(array($x1,$y1,$x2,$y1,$x2,$y2,$x1,$y2));
	}
	
	function polygon($pnts) {
		//Polygon uses Line() so it will be rotated through that call
		parent::polygon($pnts);
	}
	
	function filledPolygon($pnts) {
		parent::filledPolygon($this->arrRotate($pnts));
	}
	
	function point($x,$y) {
		list($xp,$yp) = $this->rotate($x,$y);
		parent::point($xp,$yp);
	}
	
	function dashedLine($x1,$y1,$x2,$y2,$length=1,$space=4) {
		list($x1,$y1) = $this->rotate($x1,$y1);
		list($x2,$y2) = $this->rotate($x2,$y2);
		parent::dashedLine($x1,$y1,$x2,$y2,$length,$space);
	}
	
	function strokeText($x,$y,$txt,$dir=0) {
		list($xp,$yp) = $this->rotate($x,$y);
		parent::strokeText($xp,$yp,$txt,$dir);
	}
}

//===================================================
// CLASS                                                                                             
// Description: Handle caching of graphs to files
//===================================================
class ImgStreamCache {
	var $cache_dir;
	var $img=null;
	var $timeout=0; 	// Infinite timeout
	//---------------
	// CONSTRUCTOR
	function __construct(&$aImg, $aCacheDir=JPGRAPH_CACHE_DIR) {
		$this->img = &$aImg;
		$this->cache_dir = $aCacheDir . DIR_SEP;
	}

//---------------
// PUBLIC METHODS	

	// Specify a timeout (in minutes) for the file. If the file is older then the
	// timeout value it will be overwritten with a newer version.
	// If timeout is set to 0 this is the same as infinite large timeout and if
	// timeout is set to -1 this is the same as infinite small timeout
	function setTimeout($min) {
		$this->timeout=$min;	
	}
	

	// Output image to browser and also write it to the cache
	function putAndStream(&$aImage,$aFile,$aInline) {
		// Some debugging code to brand the image with numbe of colors
		// used
		if( JPGRAPH_JPG_DEBUG ) {
			$c=$aImage->setColor("black");
			$t=imagecolorstotal($this->img->img);
			imagestring($this->img->img,2,5,$this->img->height-20,$t,$c);					
		}
		
		if( JPGRAPH_BRAND_TIMING ) {
			global $tim;
			$t=$tim->pop()/1000.0;
			$c=$aImage->setColor("black");
			$t=sprintf(JPGRAPH_BRAND_TIME_FORMAT,round($t,3));
			imagestring($this->img->img,2,5,$this->img->height-20,$t,$c);			
		}
		
		if( $aFile != STRING_NULL && JPGRAPH_USE_CACHE) {
			$aFile = $this->cache_dir . "$aFile";
			if( file_exists($aFile) ) {
				//$diff=time()-filemtime($aFile);
				// Write a new file if either the old one is to old or
				// we always want the image generated by setting the
				//if( ($this->timeout && ($diff > $this->timeout*60)) || !JPGRAPH_READ_CACHE ) {				
				unlink($aFile);
				$aImage->stream($aFile);					
				//}
			}
			else {
				$this->_makeDirs(dirname($aFile));
				$aImage->stream($aFile);
			}
			
			// Set group to specified
			if( JPGRAPH_CACHE_FILE_GROUP != STRING_NULL )
				chgrp($aFile,JPGRAPH_CACHE_FILE_GROUP);
			if( JPGRAPH_CACHE_FILE_MOD != STRING_NULL )
				chmod($aFile,JPGRAPH_CACHE_FILE_MOD);
			
			$aImage->destroy();
			if( $aInline ) {
				if ($fh = @fopen($aFile, "rb") ) {
					$this->img->headers();
					fpassthru($fh);
					exit();
	 			}
	 			else
	 				die("JpGraph Error: Cant open file from cache [$aFile]"); 
	 		}
	 	}
	 	elseif( $aInline ) {
			$this->img->Headers();	 		
	 		$aImage->stream();	
	 		exit();
	 	}
	}
	
	// Check if a given image is in cache and in that case
	// pass it directly on to web browser
	function getAndStream($aFile) {
		$aFile = $this->cache_dir . $aFile;	
	 	if ( JPGRAPH_USE_CACHE && file_exists($aFile) && $this->timeout>=0 ) {
	 		$diff=time()-filemtime($aFile);
	 		if( $this->timeout && ($diff > $this->timeout*60) ) {
	 			return false;		
	 		}
	 		else {
				if ($fh = fopen($aFile, "rb")) {
					$this->img->Headers();
					fpassthru($fh);
					return true;
				}
			}
		} 
	 	return false;
	}
	
	//---------------
	// PRIVATE METHODS	
	// Create all necessary directories in a path
	function _makeDirs($aFile) {
		$dirs = array();
		while (! (file_exists($aFile))) {
			$dirs[] = $aFile;
			$aFile = dirname($aFile);
	 	}
	 	for ($i = sizeof($dirs)-1; $i>=0; $i--) {
			if(! @mkdir($dirs[$i],0777) )
				die("JpGraph Error: Can't create directory in $aFile. Permission problems?");
				
			// We also specify mode here after we have changed group. 
			// This is necessary if Apache user doesn't belong the
			// default group and hence can't specify group permission
			// in the previous mkdir() call
			if( JPGRAPH_CACHE_FILE_GROUP != STRING_NULL ) {
				chgrp($dirs[$i],JPGRAPH_CACHE_FILE_GROUP);
				chmod($dirs[$i],0777);
			}
			
		}
		return true;
	}	
} // CLASS Cache
	
//===================================================
// CLASS Legend
// Description: Responsible for drawing the box containing
// all the legend text for the graph
//===================================================
class Legend {
	var $color=array(0,0,0),$fill_color=array(240,220,140),$shadow=true;
	var $txtcol=array();
	var $mark_abs_size=10,$xmargin=5,$ymargin=5,$shadow_width=2;
	var $xpos=0.05, $ypos=0.15, $halign="right", $valign="top";
	var $font_family=JPGRAPH_FONT1,$font_style=JPGRAPH_FS_NORMAL,$font_size=12;
	var $hide=false,$layout=JPGRAPH_LEGEND_VERT;
	var $weight=1;
//---------------
// CONSTRUCTOR
	function __construct() {
		// Empty
	}
//---------------
// PUBLIC METHODS	
	function hide($f=true) {
		$this->hide=$f;
	}
	
	function setShadow($f=true,$width=2) {
		$this->shadow=$f;
		$this->shadow_width=$width;
	}
	
	function setLineWeight($w) {
		$this->weight = $w;
	}
	
	function setLayout($l=JPGRAPH_LEGEND_VERT) {
		$this->layout=$l;
	}
	
	function setFont($family,$style=JPGRAPH_FS_NORMAL,$size=10) {
		$this->font_family = $family;
		$this->font_style = $style;
		$this->font_size = $size;
	}
	
	function pos($x,$y,$halign="right",$valign="top") {
		assert($x<1 && $y<1);
		$this->xpos=$x;
		$this->ypos=$y;
		$this->halign=$halign;
		$this->valign=$valign;
	}

	function setBackground($c) {
		$this->fill_color=$c;
	}

	function add($txt,$color,$plotmark="",$linestyle=1) {
		$this->txtcol[]=array($txt,$color,$plotmark,$linestyle);
	}
	
	function stroke(&$img) {
		if( $this->hide ) return;

		$nbrplots=count($this->txtcol);
		if( $nbrplots==0 ) return;
		
		$img->SetFont($this->font_family,$this->font_style,$this->font_size);	
		if( $this->layout==JPGRAPH_LEGEND_VERT )		
			$abs_height=$img->GetFontHeight() + $this->mark_abs_size*$nbrplots +
						$this->ymargin*($nbrplots-1);
		else
			$abs_height=2*$this->mark_abs_size+$this->ymargin;
						
		if( $this->shadow ) $abs_height += $this->shadow_width;
		$mtw=0;
		foreach($this->txtcol as $p) {
			if( $this->layout==JPGRAPH_LEGEND_VERT )
				$mtw=max($mtw,$img->GetTextWidth($p[0]));
			else
				$mtw+=$img->getTextWidth($p[0])+$this->mark_abs_size+$this->xmargin;
		}
		$abs_width=$mtw+2*$this->mark_abs_size+2*$this->xmargin;
		if( $this->halign=="left" )
			$xp=$this->xpos*$img->width;
		elseif( $this->halign=="center" )
			$xp=$this->xpos*$img->width - $abs_width/2; 
		else  
			$xp = $img->width - $this->xpos*$img->width - $abs_width;
		$yp=$this->ypos*$img->height;
		if( $this->valign=="center" )
			$yp-=$abs_height/2;
		elseif( $this->valign=="bottom" )
			$yp-=$abs_height;
		$img->setColor($this->color);				
		$img->setLineWeight($this->weight);
		if( $this->shadow )
			$img->shadowRectangle($xp,$yp,$xp+$abs_width,$yp+$abs_height,$this->fill_color,$this->shadow_width);
		else {
			$img->setColor($this->fill_color);				
			$img->filledRectangle($xp,$yp,$xp+$abs_width,$yp+$abs_height);
			$img->setColor($this->color);							
			$img->rectangle($xp,$yp,$xp+$abs_width,$yp+$abs_height);
		}
					 
		$x1=$xp+$this->mark_abs_size/2;
		$y1=$yp+$img->getFontHeight()*0.5;
		foreach($this->txtcol as $p) {
			$img->setColor($p[1]);
 			if ( (((string)$p[2]) != STRING_NULL) && ($p[2]->getType() > -1 )) {
 				$p[2]->stroke($img,$x1+$this->mark_abs_size/2,$y1+$img->getFontHeight()/2);
 			} 
 			elseif ((string)$p[2] != STRING_NULL) {
 				$img->setLineStyle($p[3]);
 				$img->styleLine($x1,$y1+$img->getFontHeight()/2,$x1+$this->mark_abs_size,$y1+$img->GetFontHeight()/2);
 				$img->styleLine($x1,$y1+$img->getFontHeight()/2-1,$x1+$this->mark_abs_size,$y1+$img->GetFontHeight()/2-1);
 			} 
 			else {
 				$img->filledRectangle($x1,$y1,$x1+$this->mark_abs_size,$y1+$this->mark_abs_size);
 				$img->setColor($this->color);
 				$img->rectangle($x1,$y1,$x1+$this->mark_abs_size,$y1+$this->mark_abs_size);
 			}
			$img->setColor($this->color);
			$img->setTextAlign("left");			
			$img->strokeText($x1+$this->mark_abs_size+$this->xmargin,$y1+$this->mark_abs_size,$p[0]);
			if( $this->layout==JPGRAPH_LEGEND_VERT )
				$y1 += $this->ymargin+$this->mark_abs_size;
			else
				$x1 += 2*$this->ymargin+$this->mark_abs_size+$img->GetTextWidth($p[0]);
		}											 								 
	}
} // Class
	
//===================================================
// CLASS Plot
// Description: Abstract base class for all concrete plot classes
//===================================================
class Plot {
	var $line_weight=1;
	var $coords=array();
	var $legend=STRING_NULL;
	var $csimtargets=array();	// Array of targets for CSIM
	var $csimareas=STRING_NULL;			// Resultant CSIM area tags	
	var $csimalts=null;			// ALT:s for corresponding target
	var $color=array(0,0,0);
	var $numpoints=0;
	var $weight=1;	
//---------------
// CONSTRUCTOR
	function __construct(&$datay,$datax=false) {
		$this->numpoints = count($datay);
		$this->coords[0]=$datay;
		if( is_array($datax) )
			$this->coords[1]=$datax;
	}

//---------------
// PUBLIC METHODS	

	// Stroke the plot
	// "virtual" function which must be implemented by
	// the subclasses
	function stroke(&$img,&$xscale,&$yscale) {
		return true;
	}
	
	// The chance for each plot class to set a legend
	function legend(&$graph) {
		if( $this->legend!=STRING_NULL )
			$graph->legend->add($this->legend,$this->color);		
	}
	
	// Set href targets for CSIM	
	function setCSIMTargets(&$targets,$alts=null) {
		$this->csimtargets=$targets;
		$this->csimalts=$alts;		
	}
 	
 	// Get all created areas
	function getCSIMareas() {
		return $this->csimareas;
	}	
	
	// "Virtual" function which gets called before any scale
	// or axis are stroked used to do any plot specific adjustment
	function preStrokeAdjust(&$graph) {
		if( substr($graph->axtype,0,4) == "text" && (isset($this->coords[1])) )
			die("JpGraph: You can't use a text X-scale with specified X-coords. Use a Linear scale instead.");
		return true;	
	}
	
	function setWeight($weight) {
		$this->weight=$weight;
	}
	
	// Get minimum values in plot
	function min() {
		if( isset($this->coords[1]) )
			$x=$this->coords[1];
		else
			$x=STRING_NULL;
		if( $x != STRING_NULL && count($x) > 0 )
			$xm=min($x);
		else 
			$xm=0;
		$y=$this->coords[0];
		if( count($y) > 0 ) {
			$ym = $y[0];
			for( $i=1; $i < count($y); ++$i ) {
				if( is_numeric($y[$i]) ) 
					$ym=min($ym,$y[$i]);
			}			
		}
		else 
			$ym=STRING_NULL;
		return array($xm,$ym);
	}
	
	// Get maximum value in plot
	function max() {
		if( isset($this->coords[1]) )
			$x=$this->coords[1];
		else
			$x=STRING_NULL;
		if( $x!=STRING_NULL && count($x) > 0 )
			$xm=max($x);
		else 
			$xm=count($this->coords[0]);
		$y=$this->coords[0];
		if( count($y) > 0 ) {
			$ym = $y[0];
			for( $i=1; $i < count($y); ++$i ) {
				if( is_numeric($y[$i]) ) $ym=max($ym,$y[$i]);
			}
		}
		else 
			$ym=STRING_NULL;
		return array($xm,$ym);
	}
	
	function setColor($color) {
		$this->color=$color;
	}
	
	function setLegend($aLegend) {
		$this->legend = $aLegend;
	}
	
	function setLineWeight($weight=1) {
		$this->line_weight=$weight;
	}
	
	// This method gets called by Graph class to plot anything that should go
	// into the margin after the margin color has been set.
	function strokeMargin(&$img) {
		return true;
	}
} // Class


//===================================================
// CLASS PlotMark
// Description: Handles the plot marks in graphs
// mostly used in line and scatter plots.
//===================================================
class PlotMark {
	var $type=-1, $weight=1;
	var $color="black", $width=5, $fill_color="blue";
//	--------------
// CONSTRUCTOR
	function __construct() {
	}
//---------------
// PUBLIC METHODS	
	function setType($t) {
		$this->type = $t;
	}
	
	function getType() {
		return $this->type;
	}
	
	function setColor($c) {
		$this->color=$c;
	}
	
	function setFillColor($c) {
		$this->fill_color = $c;
	}
	
	function setWidth($w) {
		$this->width=$w;
	}
	
	function stroke(&$img,$x,$y) {
		$dx=round($this->width/2,0);
		$dy=round($this->width/2,0);
		$pts=0;		
		switch( $this->type ) {
			case JPGRAPH_MARK_SQUARE:
			$c[]=$x-$dx;$c[]=$y-$dy;
			$c[]=$x+$dx;$c[]=$y-$dy;
			$c[]=$x+$dx;$c[]=$y+$dy;
			$c[]=$x-$dx;$c[]=$y+$dy;
			$pts=4;
			break;
			case JPGRAPH_MARK_UTRIANGLE:
			++$dx;++$dy;
			$c[]=$x-$dx;$c[]=$y+0.87*$dy;	// tan(60)/2*$dx
			$c[]=$x;$c[]=$y-0.87*$dy;
			$c[]=$x+$dx;$c[]=$y+0.87*$dy;
			$pts=3;
			break;
			case JPGRAPH_MARK_DTRIANGLE:
			++$dx;++$dy;			
			$c[]=$x;$c[]=$y+0.87*$dy;	// tan(60)/2*$dx
			$c[]=$x-$dx;$c[]=$y-0.87*$dy;
			$c[]=$x+$dx;$c[]=$y-0.87*$dy;
			$pts=3;
			break;				
			case JPGRAPH_MARK_DIAMOND:
			$c[]=$x;$c[]=$y+$dy;
			$c[]=$x-$dx;$c[]=$y;
			$c[]=$x;$c[]=$y-$dy;
			$c[]=$x+$dx;$c[]=$y;
			$pts=4;
			break;				
		}
		if( $pts>0 ) {
			$img->setLineWeight($this->weight);
			$img->setColor($this->fill_color);								
			$img->filledPolygon($c);
			$img->setColor($this->color);					
			$img->polygon($c);
		}
		elseif( $this->type==JPGRAPH_MARK_CIRCLE ) {
			$img->setColor($this->color);					
			$img->circle($x,$y,$this->width);
		}
		elseif( $this->type==JPGRAPH_MARK_FILLEDCIRCLE ) {
			$img->setColor($this->fill_color);		
			$img->filledCircle($x,$y,$this->width);
			$img->setColor($this->color);		
			$img->circle($x,$y,$this->width);
		}
		elseif( $this->type==JPGRAPH_MARK_CROSS ) {
			// Oversize by a pixel to match the X
			$img->setColor($this->color);
			$img->setLineWeight($this->weight);
			$img->line($x,$y+$dy+1,$x,$y-$dy-1);
			$img->line($x-$dx-1,$y,$x+$dx+1,$y);
		}
		elseif( $this->type==JPGRAPH_MARK_X ) {
			$img->setColor($this->color);
			$img->setLineWeight($this->weight);
			$img->line($x+$dx,$y+$dy,$x-$dx,$y-$dy);
			$img->line($x-$dx,$y+$dy,$x+$dx,$y-$dy);		
		}			
		elseif( $this->type==JPGRAPH_MARK_STAR ) {
			$img->setColor($this->color);
			$img->setLineWeight($this->weight);
			$img->line($x+$dx,$y+$dy,$x-$dx,$y-$dy);
			$img->line($x-$dx,$y+$dy,$x+$dx,$y-$dy);
			// Oversize by a pixel to match the X				
			$img->line($x,$y+$dy+1,$x,$y-$dy-1);
			$img->line($x-$dx-1,$y,$x+$dx+1,$y);
		}			
	}
} // Class

// <EOF>
?>
