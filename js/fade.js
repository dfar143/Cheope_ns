
function fadeElement(actId, actType,actFps, actDuration, actFrom, actTo) 
 {
 	  if (!actType) actType=0; 
    if (!actFps) actFps = 30;
    if (!actDuration) actDuration = 1000;
    if (!actFrom || actFrom=="#") actFrom = "#FFFFFF";
    if (!actTo) actTo = this.get_bgColor();
    var frames = Math.round(actFps * (actDuration / 1000));
    var interval = actDuration / frames;
    var delay = interval;
    var frame = 0;
    if (actFrom.length < 7) actFrom += actFrom.substr(1, 3);
    if (actTo.length < 7) actTo += actTo.substr(1, 3);
    var rf = parseInt(actFrom.substr(1, 2), 16);
    var gf = parseInt(actFrom.substr(3, 2), 16);
    var bf = parseInt(actFrom.substr(5, 2), 16);
    var rt = parseInt(actTo.substr(1, 2), 16);
    var gt = parseInt(actTo.substr(3, 2), 16);
    var bt = parseInt(actTo.substr(5, 2), 16);
    var r,g,b,h;
    while (frame < frames) {
      r = Math.floor(rf * ((frames-frame)/frames) + rt * (frame/frames));
      g = Math.floor(gf * ((frames-frame)/frames) + gt * (frame/frames));
      b = Math.floor(bf * ((frames-frame)/frames) + bt * (frame/frames));
      h = util.makeHex(r, g, b);
      switch(actType)
      {
       case 0:
        setTimeout("util.setBgColorById('"+actId+"','"+h+"')", delay);
        break;
       case 1:
        setTimeout("util.setForeColorById('"+actId+"','"+h+"')", delay);
        break;
       case 2:
        setTimeout("util.setBorderColorById('"+actId+"','"+h+"')", delay);
        break;
      }
      frame++;
      delay = interval * frame; 
    }
      switch(actType)
      {
       case 0:
        setTimeout("util.setBgColorById('"+actId+"','"+actTo+"')", delay);
        break;
       case 1:
        setTimeout("util.setForeColorById('"+actId+"','"+actTo+"')", delay);
        break;
       case 2:
        setTimeout("util.setBorderColorById('"+actId+"','"+actTo+"')", delay);
        break;
      }
  } 
 

function Fade(actId,actType,actFps,actDuration,actFrom,actTo)
{
	this.id = actId;
	this.type = actType;
	this.fps = actFps;
	this.duration = actDuration;
	this.from = actFrom;
	this.to = actTo;
	this.fade_element = function ()
	{
		fadeElement(this.id,this.type,this.fps,this.duration,this.from,this.to);
	}
	this.get_bgColor = function () 	
  {
   return this.from;
  }
}


