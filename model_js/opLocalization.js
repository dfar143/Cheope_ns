function OpLocalization()
{
	var localeObj=null;
	var locale='IT';
	var fileName = "locale";
	
	this.name = 'localization';
	this.setLocaleObj = function(actLocaleObj){if (typeof actLocaleObj=='object')localeObj = actLocaleObj;else
		alert('Errore nell\'inserimento dell\'oggetto Locale');};
	this.getLocaleObj = function(){return localeObj};
	this.setLocale = function(actLocale){locale=actLocale};
	this.getLocale=function(){return locale};
	this.setFileName = function(actFileName){fileName=actFileName};
	this.getFileName=function(){return fileName};
	this.exec = function(actJsonObj){localeObj=actJsonObj;};
	this.getString=function(actKey,actIndex){return localeObj[actKey][actIndex];alert('end');};
}