var xml = function()
{
	var XML_VERSION_TB='1.0';
	var XML_ENCODING_TB='ISO-8859-1';
	var DEFAULT_FILTER_ROOT = 'records';
	var DEFAULT_FILTER_RECORD = 'record';
	var DEFAULT_ROW_SEP_STRING = '';
	var DEFAULT_TAGS_SUFFIX = 'ind_';
		
	function Xml_tag_builder()
	{
		this.tag='';
		this.getTag=function()
		{
			return this.tag;
		}
		
		this.setTag=function(actTag)
		{
			this.tag = actTag;
		}
		
		this.getProlog=function()
		{
 	   var xmlProlog = '<' + '?' + "xml" + 
 	   ' ' + "version" + '=' + '"' + XML_VERSION_TB + 
 	   '"' + ' ' + "encoding" + '=' + '"' + XML_ENCODING_TB + 
 	   '"' + ' ' + '?' + '>';
 	   return xmlProlog;			
		}
		
		this.cData_open_build=function()
		{
			return '<![CDATA[';
		}
		
		this.cData_close_build=function()
		{
			return ']]>';
		}	
			
		this.tag_open_build=function(actProps)
		{
 	    var tag = this.getTag();
 	    var attribsStr = '';
 	    attribsStr = '<' + tag;
 	    for(ind in actProps)
 	    {
 		   attribsStr = attribsStr + ' ' + 
 		   ind + '=' + '"' + 
 		   actProps[ind] + '"';
 	    } 
 	    attribsStr = attribsStr + '>';
 	    return attribsStr;
		}
		
    this.tag_close_build=function()
    {
 	   var tag = this.getTag();
 	   var attribsStr = '';
 	   attribsStr = '<' + 
 	   '/' + tag + '>';
 	   return attribsStr; 	
    }		
	}	
	
	function Xml_filter()
	{
		this.item='';
		this.getItem=function()
		{
			return this.item;
		}
		this.setItem=function(actItem)
		{
			this.item = actItem;
		}
		this.tagsSuffix=DEFAULT_TAGS_SUFFIX;
		this.setTagsSuffix=function(actTagsSuffix)
		{
			this.tagsSuffix = actTagsSuffix;
		}
		this.getTagsSuffix=function()
		{
			return this.tagsSuffix;
		}
		this.rowSepStr=DEFAULT_ROW_SEP_STRING;
		this.setRowSepStr=function(actRowSepstr)
		{
			this.rowSepStr = actRowSepStr;
		}
		this.getRowSepStr=function()
	  {
	  	return this.rowSepStr;
	  }
	  this.filterRoot = DEFAULT_FILTER_ROOT;
	  this.getFilerRoot=function()
	  {
	  	return this.filterRoot;
	  }
	  this.setFilterRoot= function(actFilterRoot)
	  {
	   this.filterRoot = actFilterRoot;	
	  }
	  this.filterRecord = DEFAULT_FILTER_RECORD;
	  this.getFilerRecord=function()
	  {
	  	return this.filterRecord;
	  }
	  this.setFilterRecord= function(actFilterRecord)
	  {
	   this.filterRecord = actFilterRecord;	
	  }	  

	  this.filter_exec_recurse=function(actItem,actInd)
	  {
	   var filter_root = this.getFilterRoot();
	   var retStr = '';
	   var innerItemTags = '';
	   var sepString = this.getRowSepString();
	   var tagsSuffix = this.getTagsSuffix();
	   var xmlBuilder = this.getXmlTagBuilder();
     if(typeof actItem=='object')
     {
		  actInd = tagsSuffix + actInd;    	
	    xmlBuilder.setTag(trim(actInd));
   	  if(actInd != filter_root)
   	  {      
       var recordOpenTag1 = xmlBuilder.tag_open_build({'type':'array','id':actInd});
      }
      else
      {
       var recordOpenTag1 = xmlBuilder.tag_open_build();
      }
	    var recordCloseTag1 = xmlBuilder.tag_close_build();
	    var newRetStr = '';
      for(ind in actItem)
      {
      	var val = actItem[ind];
   	    var retStr = this.filter_exec_recurse(val,ind);	    
        newRetStr += retStr;     
      }   
      var innerItemTag = recordOpenTag1 + sepString + 
      newRetStr + sepString + recordCloseTag1; 
      innerItemTags += innerItemTag; 
     }
     else
     {
   	  var ind = actInd;
		  var actInd = tagsSuffix + actInd; 
	    xmlBuilder.setTag(actInd);
	    var openTag = xmlBuilder.tag_open_build({'type':'scalar','id':ind});
	    var closeTag = xmlBuilder.tag_close_build();
	    var cDataOpenTag = xmlBuilder.cData_open_build();
	    var cDataCloseTag = xmlBuilder.cData_close_build();
      var innerItemTags = openTag + cDataOpenTag + sepString + actItem + 
	    sepString + cDataCloseTag + closeTag;
     }
     return innerItemTags;		
	 }

	 this.filter_exec=function()
 	 {
	  var sepString = this.getRowSepString();
	  var xmlBuilder = this.getXmlTagBuilder();
	  var item = this.getItem();

    var filter_root = this.getFilterRoot();
    var retStr = this.filter_exec_recurse(item,filter_root);		  
	  var prolog = xmlBuilder.getProlog();
	  return prolog + sepString + retStr;
   }
  }
  
  Xml_filter.prototype.xmlTagBulder = null;
  Xml_filter.createXmlTagBuilder = function()
   {
	  return new Xml_tag_builder();
   };
  Xml_filter.prototype.setXmlTagBuilder = function(actXmlTagBuilder)
   {
	  this.xmlTagBuilder = actXmlTagBuilder;
   };
  Xml_filter.prototype.getXmlTagBuilder = function()
   {
	  return this.xmlTagBuilder;
   };
  Xml_filter.prototype.setXmlTagBuilder(Xml_filter.createXmlTagBuilder());

return{
"createXmlFilter":function()
{
	return new Xml_filter();
}
}}();
 