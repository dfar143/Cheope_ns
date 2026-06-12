<?
namespace Cheope_ns\fw;

interface Html_template
{

public function enableModules():void;
	
public function putMetaInfo():void;
 
public function testDisableOpt():void;

public function putLinkTags():void;
 
 // Metodo virtuale per l'esecuzione dell'istruzione
 // di require dei moduli php
 // 
public function putRequirePhpModulesCode():void;
  
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
public function putClientScriptIncludeCode():void;
 
 // Metodo virtuale per l'output del codice di visualizzazione nel caso 
 // di noscript
public function putNoScriptSection():void;
 
 // Metodo virtuale per output struttura body.
 // E' previsto implementazione nelle classi figlie 
 // a seconda dell'applicativo.
 //
public function putBodyStruct():void;
 
 // Metodo virtuale per output di codice prima della chiusura del body
 // E' previsto implementazione nelle classi figlie 
 // a seconda dell'applicativo.
public function putCodeBeforeBodyClose():void;
	
}

?>