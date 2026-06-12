<?
namespace Cheope_ns\fw;
require_once ("Cheope_ns_page.class.php");
require_once ("cheope_ns_db_struct.def.php");
require_once ("cheope_ns_db_queries.def.php");
require_once ("http.const.php");
require_once ("filesystem.fun.php");
require_once ("javascript.fun.php");

date_default_timezone_set ( "Europe/Rome" );
define ( 'DEFAULT_PAGE_NAME', "pagine_edit" );
define ( 'THIS_PAGE', "pagine_edit.php" );
class Cheope_ns_pagine_edit_op_page extends Cheope_ns_page {
	const ERROR_1 = MSG_16;
	
	function __construct($actNum = 0) {
		parent::__construct ( DEFAULT_PAGE_NAME, OP_NONE, $actNum=0 );
		$this->isASessionPage = true;
		// spl_autoload_register(array($this, 'autoload'));
	}
	function putLinkTags():void {
		parent::putLinkTags ();
		putLinkTag ( STRING_NULL, CLIENT_STYLE_SHEET_PATH . DIR_SEP . "subModal" . STYLE_SHEET_FILE_POSTFIX );
		putLinkTag ( STRING_NULL, CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . DIR_SEP . "nihilo" . STYLE_SHEET_FILE_POSTFIX );
	}
	function putClientScriptIncludeCode():void {
		$htmlWriter = $this->getHtmlWriter ();
		parent::putClientScriptIncludeCode ();
		putScriptIncludeTag ( CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL );
		if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && ($_SESSION [SESSION_VAR_ACTIVE_APP] != STRING_NULL)) {
			$htmlWriter->putScriptIncludeTag ( CLIENT_CODE_PATH . DIR_SEP . "Selection" . JAVASCRIPT_SOURCE_FILE_POSTFIX );
			$htmlWriter->putGenericHtmlString ( "<script>dojo.require(\"dojo.parser\")</script>" );
			$htmlWriter->putGenericHtmlString ( "<script>dojo.require(\"dijit.Menu\")</script>" );
			$htmlWriter->putGenericHtmlString ( "<script>" . "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>" );
		}
	}
	function putActiveApp():void {
		$htmlWriter = $this->getHtmlWriter ();
		putActiveApp ( $htmlWriter );
	}
	function putBody():void {
		global $dbStructTree;
		global $dbQueriesContainer;
		
		$interfaces = $this->getInterfacesContainer ();
		
		if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && 
		($_SESSION [SESSION_VAR_ACTIVE_APP] != STRING_NULL) && 
		(! isset ( $_GET ["Nome_pagina"] ))) {
			$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
			$appDir = $appName;
			
			$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
			$files = scandir ( $appXmlDir );
			$pagesFiles1 = Interfaces_model::getAllPages ( $appName );
			//$pagesFiles [STRING_NULL] = STRING_NULL;
			$pagesFiles [VAR_SEP] = STRING_NULL;
			$pagesFiles [STRING_NULL] = "Default";		
			foreach ( $pagesFiles1 as $page ) {
				//$pagesFiles [$page] = $page;
				$pagesFiles [$page] = $page;
			}

			$intForm = $interfaces->getInterface ( OBJ_NONE, OP_NONE, Interfaces_info::INT_FORM_2, NUM_1 );
			$intForm->setDataFieldDomainValueByName ( FIELD_NOME_PAGINA, $pagesFiles );
			$int_iter = $interfaces->create ();
			$int = $int_iter->last ();
			$int->putData ();
		} elseif (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && 
		($_SESSION [SESSION_VAR_ACTIVE_APP] != STRING_NULL) && 
		(isset ( $_GET ["Nome_pagina"] ))) {
			$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
			$appDir = $appName;
			$nomePagina = $_GET ["Nome_pagina"];
			
			$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
			$files = scandir ( $appXmlDir );
			$pagesFiles1 = Interfaces_model::getAllPages ( $appName );

			if ($nomePagina != "Default")
				$pagesFiles [$nomePagina] = $nomePagina;
			$pagesFiles [STRING_NULL] = "Default";			
			foreach ( $pagesFiles1 as $page ) {
				$pagesFiles [$page] = $page;
			}
			//$pagesFiles [STRING_NULL] = "Default";
			if ($nomePagina == STRING_NULL)
			{
				$suffix = STANDARD_MOD_PREFIX;
				$nomePagina=STRING_NULL;
			}
			else
				$suffix = $appDir;
			
			$interfaceName1 = $suffix . self::INTERFACE_NAME_SEP . $nomePagina . 
			self::INTERFACE_NAME_SEP . "html_page" . self::INTERFACE_NAME_SEP . 
			self::INTERFACE_NAME_SEP . "0";
			$interfaceName2 = $suffix . self::INTERFACE_NAME_SEP . $nomePagina . 
			self::INTERFACE_NAME_SEP . "html_page" . self::INTERFACE_NAME_SEP . 
			self::INTERFACE_NAME_SEP . "0" . 
			FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$interfaceDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
            $interfaceCompleteName1 = $interfaceDir . DIR_SEP . $interfaceName1;
            $interfaceCompleteName2 = $interfaceDir . DIR_SEP . $interfaceName2;
			if(file_exists($interfaceCompleteName1))
			 $interfaceCompleteName = $interfaceCompleteName1;
			elseif(file_exists($interfaceCompleteName2))
			 $interfaceCompleteName = $interfaceCompleteName2;
			else
			 die(self::ERROR_1);
			 
			$serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL, $interfaceCompleteName );
			$serializer->setXmlDir ( PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR );
			$serializer->setInterfacesDir ( $interfaceDir );
			$serializer->setDbStruct ( $dbStructTree );
			$serializer->setDbQueries ( $dbQueriesContainer );
			$serializer->setAppName ( $appDir );
			$serializer->setPageName ( $nomePagina );
			$serializer->setLoadInterfaceAsString ( true );
			$serializer->setInterpolateConsts ( false );
			$serializer->loadData ();
			$items = $serializer->getItems ();
			
			if (! isset ( $items ["op"] ))
				$items ["op"] = STRING_NULL;
			if (! isset ( $items ["num"] ))
				$items ["num"] = 0;
			if (! isset ( $items ["type"] ))
				$items ["type"] = STRING_NULL;
			if (! isset ( $items ["cssClass"] ))
				$items ["cssClass"] = STRING_NULL;
			if (! isset ( $items ["docTypeString"] ))
				$items ["docTypeString"] = STRING_NULL;
			if (! isset ( $items ["xmlPrologVersion"] ))
				$items ["xmlPrologVersion"] = STRING_NULL;
			if (! isset ( $items ["xmlPrologEnctype"] ))
				$items ["xmlPrologEnctype"] = STRING_NULL;
			if (! isset ( $items ["pageMetaCharset"] ))
				$items ["pageMetaCharset"] = STRING_NULL;
			if (! isset ( $items ["lang"] ))
				$items ["lang"] = STRING_NULL;
			if (! isset ( $items ["htmlNameSpace"] ))
				$items ["htmlNameSpace"] = STRING_NULL;
			if (! isset ( $items ["@bodyOnLoad"] ))
				$items ["@bodyOnLoad"] = STRING_NULL;
			if (! isset ( $items ["@bodyOnUnLoad"] ))
				$items ["@bodyOnUnLoad"] = STRING_NULL;
			if (! isset ( $items ["dojoEnabled"] ))
				$items ["dojoEnabled"] = false;
			if (! isset ( $items ["jQueryEnabled"] ))
				$items ["jQueryEnabled"] = false;
			if (! isset ( $items ["localizationEnabled"] ))
				$items ["localizationEnabled"] = false;
			if (! isset ( $items ["ajaxOps"] ))
				$items ["ajaxOps"] = array ();
			if (! isset ( $items ["jsExtModule"] ))
				$items ["jsExtModule"] = STRING_NULL;
			if (! isset ( $items ["CssExtModule"] ))
				$items ["CssExtModule"] = STRING_NULL;
			if (! isset ( $items ["locale"] ))
				$items ["locale"] = STRING_NULL;
			if (! isset ( $items ["bootstrapEnabled"] ))
				$items ["bootstrapEnabled"] = STRING_NULL;
			if (! isset ( $items ["interfacesContainer"] ))
				$items ["interfacesContainer"] = null;
			if (! isset($items["bodyStructTemplate"]))
				$items ["bodyStructTemplate"] = null;
			if (! isset($items["codeBeforeBodyClose"]))
				$items ["codeBeforeBodyClose"] = null;
			
			$interfaceDivTag1 = $interfaces->getInterface ( OBJ_NONE, 
			OP_NONE, Interfaces_info::INT_HTML_TAGS, NUM_1 );
			$interfaceDivTagContainer1 = $interfaceDivTag1->getInterfacesContainer ();
			
			$interfaceInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "nuovo_nome_pagina",
					"type" => "text" 
			);
			$interfaceInputTag1->setAttribs ( $attribs );
			
			$interfaceLabelTag1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "nuovo_nome_pagina_label",
					"for" => "nuovo_nome_pagina" 
			);
			$interfaceLabelTag1->setAttribs ( $attribs );
			$interfaceLabelTag1->setTagBody ( LABEL_NUOVO_NOME_PAGINA . 
			ENTITY_SPACE . ENTITY_SPACE );
			
			if ($nomePagina == STRING_NULL) {
				$interfaceDivTagContainer1->add ( $interfaceLabelTag1 );
				$interfaceDivTagContainer1->add ( $interfaceInputTag1 );
			} else {
				$interfaceInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
				$attribs = array (
						"id" => "nuovo_nome_pagina",
						"type" => "hidden",
						"value" => $nomePagina 
				);
				$interfaceInputTag1->setAttribs ( $attribs );
				$interfaceDivTagContainer1->add ( $interfaceInputTag1 );
			}
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* Op  */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_op",
					"for" => "op" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Op" . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "op",
					"type" => "text",
					"value" => $items ["op"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* Type */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_type",
					"for" => "type" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Type" . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "type",
					"type" => "text",
					"value" => "html_page" 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* Num */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_num",
					"for" => "num" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Num" . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "num",
					"type" => "text",
					"value" => "0",
					"value" => $items ["num"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* CssClass */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_cssClass",
					"for" => "cssClass" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "CssClass" . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "cssClass",
					"type" => "text",
					"value" => $items ["cssClass"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* XmlPrologVersion */
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_xmlPrologVersion",
					"for" => "xmlPrologVersion" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "Xml prolog" . STRING_SPACE . 
			LABEL_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "xmlPrologVersion",
					"type" => "text",
					"size" => "40",
					"value" => $items ["xmlPrologVersion"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					"Xml prolog" 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			$intOption1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => CHARSET_UTF8 
			);
			$intOption1->setAttribs ( $attribs );
			$intOption1->setTagBody ( 'CHARSET_UTF8' );
			
			$intOption2 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => CHARSET_ISO88591 
			);
			$intOption2->setAttribs ( $attribs );
			$intOption2->setTagBody ( 'CHARSET_ISO88591' );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_xmlPrologEnctype_select",
					"for" => "xmlPrologEnctype_select" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Xml enctype" . STRING_SPACE . 
			LABEL_ELENCO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "xmlPrologEnctype_select",
					"onchange" => "$('input#xmlPrologEnctype').val(this.value)" 
			);
			$interfaceSelect1->setAttribs ( $attribs );

            $interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);			
			$interfaceSelect1Container->add ( $intOption1 );
			$interfaceSelect1Container->add ( $intOption2 );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_xmlPrologEnctype",
					"for" => "xmlPrologEnctype" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "Xml enctype" . STRING_SPACE . 
			LABEL_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			/* XmlPrologEncType */
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "xmlPrologEnctype",
					"type" => "text",
					"size" => "30",
					"value" => $items ["xmlPrologEnctype"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					"Xml enctype" 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			
			/* Doctype */
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			$intOption1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_HTML_401_TRANSITIONAL ) 
			);
			$intOption1->setTagBody ( 'DOCTYPE_HTML_401_TRANSITIONAL' );
			$intOption1->setAttribs ( $attribs );
			
			$intOption2 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL); 
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_HTML_401_STRICT ) 
			);
			$intOption2->setTagBody ( 'DOCTYPE_HTML_401_STRICT' );
			$intOption2->setAttribs ( $attribs );
			
			$intOption3 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL); 
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_HTML_401_FRAMESET ) 
			);
			$intOption3->setTagBody ( 'DOCTYPE_HTML_401_FRAMESET' );
			$intOption3->setAttribs ( $attribs );
			
			$intOption4 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_XHTML_10_STRICT ) 
			);
			$intOption4->setTagBody ( 'DOCTYPE_XHTML_10_STRICT' );
			$intOption4->setAttribs ( $attribs );
			
			$intOption5 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_XHTML_10_TRANSITIONAL ) 
			);
			$intOption5->setTagBody ( 'DOCTYPE_XHTML_10_TRANSITIONAL' );
			$intOption5->setAttribs ( $attribs );
			
			$intOption6 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_XHTML_10_FRAMESET ) 
			);
			$intOption6->setTagBody ( 'DOCTYPE_XHTML_10_FRAMESET' );
			$intOption6->setAttribs ( $attribs );
			
			$intOption7 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => htmlentities ( DOCTYPE_XHTML_11 ) 
			);
			$intOption7->setTagBody ( 'DOCTYPE_XHTML_11' );
			$intOption7->setAttribs ( $attribs );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_docTypeString_select",
					"for" => "docTypeString_select" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "DocType string" . STRING_SPACE .
			LABEL_ELENCO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "docTypeString_select",
					"onchange" => "$('input#docTypeString').val(this.value)" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
			$interfaceSelect1Container->add ( $intOption1 );
			$interfaceSelect1Container->add ( $intOption2 );
			$interfaceSelect1Container->add ( $intOption3 );
			$interfaceSelect1Container->add ( $intOption4 );
			$interfaceSelect1Container->add ( $intOption5 );
			$interfaceSelect1Container->add ( $intOption6 );
			$interfaceSelect1Container->add ( $intOption7 );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_docTypeString",
					"for" => "docTypeString" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "DocType string" . STRING_SPACE . 
			LABEL_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfacebr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "docTypeString",
					"type" => "text",
					"size" => "40",
					"value" => htmlentities ( $items ["docTypeString"] ) 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					"DocType string" 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			
			/* PageMetaCharset */
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			$intoption1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => CHARSET_UTF8 
			);
			$intOption1->setAttribs ( $attribs );
			$intOption1->setTagBody ( 'CHARSET_UTF8' );
			
			$intOption2 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => CHARSET_ISO88591 
			);
			$intOption2->setAttribs ( $attribs );
			$intOption2->setTagBody ( 'CHARSET_ISO88591' );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_pageMetaCharset_select",
					"for" => "pageMetaCharset_select" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "PageMetaCharset" . STRING_SPACE . 
			LABEL_ELENCO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "pageMetaCharset_select",
					"onchange" => "$('input#pageMetaCharset').val(this.value)" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect1Container->add ( $intOption1 );
			$interfaceSelect1Container->add ( $intOption2 );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
			$attribs = array (
					"id" => "label_pageMetaCharset",
					"for" => "pageMetaCharset" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "PageMetaCharset" . STRING_SPACE . 
			LABEL_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "pageMetaCharset",
					"type" => "text",
					"size" => "30",
					"value" => $items ["pageMetaCharset"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					"PageMetaCharset" 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			
			/* Lang */
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			$intOption1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => LANG_ITALIAN 
			);
			$intOption1->setAttribs ( $attribs );
			$intOption1->setTagBody ( 'LANG_ITALIAN' );
			
			$intOption2 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => LANG_ENGLISH 
			);
			$intOption2->setAttribs ( $attribs );
			$intOption2->setTagBody ( 'LANG_ENGLISH' );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_lang_select",
					"for" => "lang_select" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Lang" . STRING_SPACE . 
			LABEL_ELENCO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "lang_select",
					"onchange" => "$('input#lang').val(this.value)" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
			$interfaceSelect1Container->add ( $intOption1 );
			$interfaceSelect1Container->add ( $intOption2 );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_lang",
					"for" => "lang" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "Lang" . STRING_SPACE . 
			LABEL_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "lang",
					"type" => "text",
					"size" => "40",
					"value" => $items ["lang"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					"Html lang" 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* htmlNameSpace */
			
			$intOption1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => STRING_NULL
			);
			$intOption1->setAttribs ( $attribs );
			$intOption1->setTagBody ( STRING_NULL );
			
			$intOption2 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => HTML_NAMESPACE 
			);
			$intOption2->setAttribs ( $attribs );
			$intOption2->setTagBody ( 'HTML_NAMESPACE' );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_htmlNameSpace_select",
					"for" => "htmlNameSpace_select" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "HtmlNameSpace" . STRING_SPACE . 
			LABEL_ELENCO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "htmlNameSpace_select",
					"onchange" => "$('input#htmlNameSpace').val(this.value)" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect1Container->add ( $intOption1 );
			$interfaceSelect1Container->add ( $intOption2 );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_htmlNameSpace",
					"for" => "htmlNameSpace" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "HtmlNameSpace" . STRING_SPACE . 
			LABEL_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "htmlNameSpace",
					"type" => "text",
					"size" => "30",
					"value" => $items ["htmlNameSpace"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					"HtmlNameSpace" 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			
			/* BodyOnLoad */
			
			$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_bodyOnload",
					"for" => "bodyOnLoad" 
			);
			$intLabel1->setTagBody ( "BodyOnLoad" . ENTITY_SPACE . ENTITY_SPACE );
			$intLabel1->setAttribs ( $attribs );
			$intText1 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL);
			$attribs2 = array ();
			$attribs2 ["rows"] = "4";
			$attribs2 ["cols"] = "18";
			$attribs2 ["id"] = "@bodyOnLoad";
			$attribs2 ["name"] = "bodyOnLoad";
			$intText1->setAttribs ( $attribs2 );
			$intText1->setTagBody ( $items ["@bodyOnLoad"] );
			$intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL,OP_NONE);
			$intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL,OP_NONE);
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			$interfaceDivTagContainer1->add ( $intLabel1 );
			$interfaceDivTagContainer1->add ( $intText1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* BodyOnUnload */
			
			$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_bodyOnUnload",
					"for" => "bodyOnUnLoad" 
			);
			$intLabel1->setTagBody ( "BodyOnUnLoad" . ENTITY_SPACE . ENTITY_SPACE);
			$intLabel1->setAttribs ( $attribs );
			$intText1 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL);
			$attribs2 = array ();
			$attribs2 ["rows"] = "4";
			$attribs2 ["cols"] = "18";
			$attribs2 ["id"] = "@bodyOnUnLoad";
			$attribs2 ["name"] = "bodyOnUnLoad";
			$intText1->setAttribs ( $attribs2 );
			$intText1->setTagBody ( $items ["@bodyOnUnLoad"] );
			$intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			$interfaceDivTagContainer1->add ( $intLabel1 );
			$interfaceDivTagContainer1->add ( $intText1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* AjaxOps */
			
			$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_ajaxOps",
					"for" => "ajaxOps" 
			);
			$intLabel1->setTagBody ( "AjaxOps" . ENTITY_SPACE . ENTITY_SPACE );
			$intLabel1->setAttribs ( $attribs );
			$intText1 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL);
			$attribs2 = array ();
			$attribs2 ["rows"] = "4";
			$attribs2 ["cols"] = "18";
			$attribs2 ["id"] = "ajaxOps";
			$attribs2 ["name"] = "ajaxOps";
			$intText1->setAttribs ( $attribs2 );
			$intText1->setTagBody ( var_export ( $items ["ajaxOps"], true ) );
			$intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
			DIR_SEP . XML_DIR . DIR_SEP . "ajaxOps_const" . 
			FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer->loadData ();
			$allItems = $xmlSerializer->getItems ();
			$sectionsObj = $allItems [0];
			$sectionsArray = $sectionsObj->getItem ();
			$sectionObj = $sectionsArray [0];
			$sectionArray = $sectionObj->getItem ();
		  $blockDefObj = $sectionArray[1];
		  $blockDefArray = $blockDefObj->getItem();
		  //$defObj = $blockDefArray[0];
          //$defArray = $defObj->getItem();
         //var_dump($defArray);		  
			$ajaxOps = array ();
			$j = 0;
			foreach ( $blockDefArray as $ind => $defObj ) {
				$defArray1 = $defObj->getItem ();
				$functionCallObj = $defArray1 [0];
				//var_dump($functionCallObj);
				$functionCallArray = $functionCallObj->getItem ();
				//var_dump($functionCallArray);
				$argObj = $functionCallArray [0];
				$stringObj = $argObj->getItem ();
				$ajaxOp = $stringObj->getItem();
				//echo $ajaxOp;
				$ajaxOpsItems = preg_split("/'/",$ajaxOp);
				$ajaxOpItem = $ajaxOpsItems[1];
				$ajaxOpItemEls = preg_split("/_/",$ajaxOpItem);
				$ajaxOpItem1 = $ajaxOpItemEls[2];
                for($i=3;$i<=count($ajaxOpItemEls)-1;$i++)
				 $ajaxOpItem1 = $ajaxOpItem1 . "_" . $ajaxOpItemEls[$i];
				//echo $ajaxOpItem1;
                //print_r($ajaxOpsItems);				
				$ajaxOps [$j ++] = ucfirst(strToLower($ajaxOpItem1));
			}
			//print_r($ajaxOps);
			$menuItems = STRING_NULL;
			foreach ( $ajaxOps as $ind => $ajaxOp ) {
				$menuItems = $menuItems . "<div dojoType=\"dijit.MenuItem\" style=\"color:black;\">" . $ajaxOp . "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" . 
				"var selection = new Selection(\$('#ajaxOps').get(0));" . "var s = selection.create();" . "var lenStr = \$('#ajaxOps').val().length;" . 
				"var leftStr = \$('#ajaxOps').val().substring(0,s.start);" . "var rightStr = \$('#ajaxOps').val().substring(s.end,lenStr);" . 
				"var newStr = leftStr + '" . $ajaxOp . "' + rightStr;" . "\$('#ajaxOps').val(newStr);" . "</script></div>";
			}
			$htmlFragment = "<div dojoType=\"dijit.Menu\" targetNodeIds=\"ajaxOps\" style=\"display:none\" >" . $menuItems . "</div>";
			$intHtmlFragment = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
			$intHtmlFragment->setHtmlFragment ( $htmlFragment );
			
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			$interfaceDivTagContainer1->add ( $intLabel1 );
			$interfaceDivTagContainer1->add ( $intText1 );
			$interfaceDivTagContainer1->add ( $intHtmlFragment );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* jsExtModule */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_jsExtModule",
					"for" => "jsExtModule" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "JsExtModule" . ENTITY_SPACE . ENTITY_SPACE );
			
			$appDir = $_SESSION[SESSION_VAR_ACTIVE_APP];
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "jsExtModule",
					"type" => "text",
					"value" => (isset($items ["jsExtModule"])&& ($items ["jsExtModule"]==''))?(THIS_DIR . DIR_SEP . JAVASCRIPT_DIR . 
					DIR_SEP . strToLower($appDir) . VAR_SEP . FILE_NAME_ELEMENTS_SEP . 
					JAVASCRIPT_ACRONYM):((isset($items ["jsExtModule"]) ? $items ["jsExtModule"]: THIS_DIR . DIR_SEP . JAVASCRIPT_DIR . 
					DIR_SEP . strToLower($appDir) . VAR_SEP . FILE_NAME_ELEMENTS_SEP . 
					JAVASCRIPT_ACRONYM))
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
			
			/* CssExtModule */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_cssExtModule",
					"for" => "cssExtModule" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "CssExtModule" . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "cssExtModule",
					"type" => "text",
					"value" => (isset($items ["cssExtModule"]) && ($items ["cssExtModule"]==''))?(THIS_DIR . DIR_SEP . CSS_DIR . 
					DIR_SEP . strToLower($appDir) . VAR_SEP . STRING_NULL . FILE_NAME_ELEMENTS_SEP . 
					CSS_ACRONYM):((isset($items["cssExtModule"]) ? $items["cssExtModule"]: THIS_DIR . DIR_SEP . CSS_DIR . 
					DIR_SEP . strToLower($appDir) . VAR_SEP . FILE_NAME_ELEMENTS_SEP . 
					CSS_ACRONYM))
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			
			//
			
			$interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceDivTagContainer1->add ( $interfaceBr1 );
			$interfaceDivTagContainer1->add ( $interfaceBr2 );
	        					
			/* dojoEnabled */ 
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_dojo_enabled",
					"for" => "dojoEnabled" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Dojo " . LABEL_ABILITATO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			($items ["dojoEnabled"] == "true") ? ($attribs = array (
					"id" => "dojoEnabled",
					"type" => "checkbox",
					"checked" => STRING_NULL 
			)) : ($attribs = array (
					"id" => "dojoEnabled",
					"type" => "checkbox" 
			));
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* JQueryEnabled */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_jQuery_enabled",
					"for" => "jQueryEnabled" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "JQuery " . LABEL_ABILITATO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			($items ["jQueryEnabled"] == "true") ? ($attribs = array (
					"id" => "jQueryEnabled",
					"type" => "checkbox",
					"checked" => STRING_NULL 
			)) : ($attribs = array (
					"id" => "jQueryEnabled",
					"type" => "checkbox" 
			));
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* LocalizationEnabled */
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_localization_enabled",
					"for" => "localizationEnabled" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( "Localization " . LABEL_ABILITATO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			($items ["localizationEnabled"] == "true") ? ($attribs = array (
					"id" => "localizationEnabled",
					"type" => "checkbox",
					"checked" => STRING_NULL,
					"onclick" => "return checkbox_localization_onClick(this);" 
			)) : ($attribs = array (
					"id" => "localizationEnabled",
					"type" => "checkbox",
					"onclick" => "return checkbox_localization_onClick(this);" 
			));
			
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag2 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag2 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* BootstrapEnabled */
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_bootstrap_enabled",
					"for" => "bootstrapEnabled" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "Bootstrap " . LABEL_ABILITATO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			($items ["bootstrapEnabled"] == "true") ? ($attribs = array (
					"id" => "bootstrapEnabled",
					"type" => "checkbox",
					"checked" => STRING_NULL,
					"onclick" => "return checkbox_bootstrap_onClick(this);" 
			)) : ($attribs = array (
					"id" => "bootstrapEnabled",
					"type" => "checkbox",
					"onclick" => "return checkbox_bootstrap_onClick(this);" 
			));
			
			$interfaceInputTag3->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag3 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag3 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* UiMaterial enabled */
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_uiMaterial_enabled",
					"for" => "uiMaterialEnabled" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( "UiMaterial " . LABEL_ABILITATO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			(isset($items ["uiMaterialEnabled"]) && ($items ["uiMaterialEnabled"] == "true")) ? ($attribs = array (
					"id" => "uiMaterialEnabled",
					"type" => "checkbox",
					"checked" => STRING_NULL,
					"onclick" => "return checkbox_uiMaterial_onClick(this);" 
			)) : ($attribs = array (
					"id" => "uiMaterialEnabled",
					"type" => "checkbox",
					"onclick" => "return checkbox_uiMaterial_onClick(this);" 
			));
			
			$interfaceInputTag3->setAttribs ( $attribs );
			
			$interfaceDivTagContainer1->add ( $interfaceLabelTag3 );
			$interfaceDivTagContainer1->add ( $interfaceInputTag3 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* Set locale */

			
			$intOption1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL); 
			$attribs = array (
					"value" => "IT" 
			);
			$intOption1->setAttribs ( $attribs );
			$intOption1->setTagBody ( 'IT' );
			
			$intOption2 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array (
					"value" => "EN" 
			);
			$intOption2->setAttribs ( $attribs );
			$intOption2->setTagBody ( 'EN' );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_locale_select",
					"for" => "locale_select" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( LABEL_LOCALE_ELENCO . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "locale_select",
					"onchange" => "$('input#locale').val(this.value)" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect1Container->add ( $intOption1 );
			$interfaceSelect1Container->add ( $intOption2 );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_locale",
					"for" => "locale" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( LABEL_LOCALE_VALORE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "locale",
					"type" => "text",
					"size" => "30",
					"value" => $items ["locale"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					LABEL_LOCALE 
			) );
			
			if ($items ["localizationEnabled"] == "true") {
				$intDec1->setStyle ( "display:block;" );
			} else {
				$intDec1->setStyle ( "display:none;" );
			}
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
		    /* Interface container */	
			
			$interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL);
			$interfaceImg1->setAttribs ( array (
					"src" => "./img/trasf.gif",
					"style" => "float:left;cursor:pointer;",
					"title" => LABEL_IMPOSTA_INTERFACCIA,
					"onclick" => "select_container_interfaces_onChange('interfaces_select','interfacesContainer');" 
			) );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_interfaces_container_select",
					"for" => "interfacesContainer" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( LABEL_CONTENITORE_INTERFACCE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "interfacesContainer",
					"class" => "container" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			if (! is_null ( $items ["interfacesContainer"] )) {
				$interfacesContainer = $items ["interfacesContainer"];
				$intIter = $interfacesContainer->create ();
				$objNames = array ();
				$l = 0;
				while ( $intIter->hasMore () ) {
					$objName = $intIter->current ()->getItemName();
					if (array_key_exists ( $objName, $objNames )) {
						$objNameInd = $objName . VAR_SEP . $l;
						$objNames [$objNameInd] = $objName;
						$l ++;
					} else
						$objNames [$objName] = $objName;
					$intIter->next ();
				}
				foreach ( $objNames as $ind2 => $objName ) {
					$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
					$attribs = array (
							"value" => $ind2 
					);
					$interfaceOptionTag->setTagBody ( strComplete ( ucFirst ( $objName ), ENTITY_SPACE, 20 ) );
					$interfaceOptionTag->setAttribs ( $attribs );
					$interfaceSelect1Container->add ( $interfaceOptionTag );
				}
			}
			$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array ();
			$interfaceOptionTag->setTagBody ( STRING_NULL );
			$interfaceOptionTag->setAttribs ( $attribs );
			$interfaceSelect1Container->add ( $interfaceOptionTag );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_interfaces",
					"for" => "interfaces_select" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( LABEL_INTERFACCE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "interfaces_select",
					"onchange" => "select_container_interfaces_onChange('interfaces_select','interfacesContainer')" 
			);
			$interfaceSelect2->setAttribs ( $attribs );
			$interfaceSelect2Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect2->setInterfacesContainer ( $interfaceSelect2Container );
			
			$interfacesFiles = Interfaces_model::getAllInterfacesByPage ( $appName, $nomePagina, true );
			foreach ( $interfacesFiles as $ind => $interfaceFile ) {
				$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
				$attribs5 = array (
						"value" => $interfaceFile 
				);
				$interfaceOptionTag->setTagBody ( $interfaceFile );
				$interfaceOptionTag->setAttribs ( $attribs5 );
				$interfaceSelect2Container->add ( $interfaceOptionTag );
			}
			$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs5 = array (
					"selected" => STRING_NULL 
			);
			$interfaceOptionTag->setTagBody ( STRING_NULL );
			$interfaceOptionTag->setAttribs ( $attribs5 );
			$interfaceSelect2Container->add ( $interfaceOptionTag );
			
			$intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
			$intButton2->setTagBody ( LABEL_EDIT );
			$intButton2->setAttribs ( array (
					"onclick" => "button_container_onClick(this)",
					"type" => "button" 
			) );
			
			$intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
			$intSpan1->setTagBody ( ENTITY_SPACE . ENTITY_SPACE );
			
			$intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
			$intSpan2->setTagBody ( ">>" );
			$intSpan2->setAttribs ( array (
					"id" => $intSpan2->getId (),
					"title" => LABEL_GESTIONE_CONTENITORE,
					"style" => "font-size:10pt;cursor:pointer;",
					"onclick" => "span_container_onClick(this);" 
			) );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
			$intDivTagContainer2->add ( $interfaceImg1 );
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $intButton2 );
			$intDivTagContainer2->add ( $intSpan1 );
			$intDivTagContainer2->add ( $intSpan2 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceSelect2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					LABEL_CONTENITORE_INTERFACCE 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* BodyStruct template */
			
			$intBodyStructTemplateName = $items["bodyStructTemplate"];

            $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL);
			$interfaceImg1->setAttribs ( array (
					"src" => "./img/trasf.gif",
					"style" => "float:left;cursor:pointer;",
					"title" => LABEL_IMPOSTA_BODYSTRUCTTEMPLATE,
					"onclick" => "select_container_templates_onChange('interfaces_select_1','bodyStructTemplate');" 
			) );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_body_struct_template_container_select",
					"for" => "bodyStructTemplate" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( LABEL_TEMPLATE_STRUTTURE_BODY . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "bodyStructTemplate",
                    "size" => "40",
                    "value" => (is_object($intBodyStructTemplateName)?$intBodyStructTemplateName->getItemName():STRING_NULL)			
			);
			$interfaceInputTag1->setAttribs ( $attribs );
			/*$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			//$interfaceSelect1Container = new Interfaces_container ( STRING_NULL );
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			if ($items ["bodyStructTemplate"] !== STRING_NULL) {
  					$bodyStructTemplateName = $items ["bodyStructTemplate"];
					$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
					//$interfaceOptionTag = new Html_option_tag ();
					$attribs = array (
							"value" => $bodyStructTemplateName 
					);
					$interfaceOptionTag->setTagBody ( $bodyStructTemplateName );
					$interfaceOptionTag->setAttribs ( $attribs );
					$interfaceSelect1Container->add ( $interfaceOptionTag );
	
			}
			$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array ();
			$interfaceOptionTag->setTagBody ( STRING_NULL );
			$interfaceOptionTag->setAttribs ( $attribs );
			$interfaceSelect1Container->add ( $interfaceOptionTag );*/
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			/* Code container before body close */
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_interfaces",
					"for" => "interfaces_select_1" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( LABEL_INTERFACCE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "interfaces_select_1",
					"onchange" => "select_container_templates_onChange('interfaces_select_1','bodyStructTemplate')" 
			);
			$interfaceSelect2->setAttribs ( $attribs );
			$interfaceSelect2Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect2->setInterfacesContainer ( $interfaceSelect2Container );
			
			$interfacesFiles = Interfaces_model::getAllInterfacesByPageAndType( $appName, $nomePagina,Interfaces_info::INT_PHP_FRAGMENT_FREE);
			foreach ( $interfacesFiles as $ind => $interfaceFile ) {
				$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
				$attribs5 = array (
						"value" => $interfaceFile 
				);
				$interfaceOptionTag->setTagBody ( $interfaceFile );
				$interfaceOptionTag->setAttribs ( $attribs5 );
				$interfaceSelect2Container->add ( $interfaceOptionTag );
			}
			$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs5 = array (
					"selected" => STRING_NULL 
			);
			$interfaceOptionTag->setTagBody ( STRING_NULL );
			$interfaceOptionTag->setAttribs ( $attribs5 );
			$interfaceSelect2Container->add ( $interfaceOptionTag );
			
			$intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
			$intButton2->setTagBody ( LABEL_EDIT );
			$intButton2->setAttribs ( array (
					"onclick" => "button_template_structure_onClick(this)",
					"type" => "button" 
			) );
			
			$intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
			$intSpan1->setTagBody ( ENTITY_SPACE . ENTITY_SPACE );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
			$intDivTagContainer2->add ( $interfaceImg1 );
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceInputTag1 );
			$intDivTagContainer2->add ( $intButton2 );
			$intDivTagContainer2->add ( $intSpan1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceSelect2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					LABEL_TEMPLATE_STRUTTURE_BODY 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );

			/* code before body close */
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			/*$interfaceInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
			//$interfaceInputTag2 = new Html_input_tag ();
			$attribs = array (
					"id" => "locale",
					"type" => "text",
					"size" => "30",
					"value" => $items ["locale"] 
			);
			$interfaceInputTag2->setAttribs ( $attribs );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			//$intDivTag2 = new Html_div_tag ();
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			//$intDivTagContainer2 = new Interfaces_container ( STRING_NULL );
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceInputTag2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			//$intDec1 = new Html_fieldset_decorator ( $intDivTag2 );
			$intDivTag2->setDispFields ( array (
					LABEL_LOCALE 
			) );
			
			if ($items ["localizationEnabled"] == "true") {
				$intDec1->setStyle ( "display:block;" );
			} else {
				$intDec1->setStyle ( "display:none;" );
			}
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );*/
			
			$interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL);
			$interfaceImg1->setAttribs ( array (
					"src" => "./img/trasf.gif",
					"style" => "float:left;cursor:pointer;",
					"title" => LABEL_IMPOSTA_INTERFACCIA,
					"onclick" => "select_container_interfaces_onChange('codeBeforeBodyClose_select','codeBeforeBodyClose');" 
			) );
			
			$interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_codeBeforeBodyClose_container_select",
					"for" => "codeBeforeBodyClose" 
			);
			$interfaceLabelTag2->setAttribs ( $attribs );
			$interfaceLabelTag2->setTagBody ( LABEL_CONTENITORE_CODICE_PRIMA_CHIUSURA_BODY . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "codeBeforeBodyClose",
					"class" => "container" 
			);
			$interfaceSelect1->setAttribs ( $attribs );
			$interfaceSelect1Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect1->setInterfacesContainer ( $interfaceSelect1Container );
			
			if (! is_null ( $items ["codeBeforeBodyClose"] )) {
				$interfacesContainer = $items ["codeBeforeBodyClose"];
				$intIter = $interfacesContainer->create ();
				$objNames = array ();
				$l = 0;
				while ( $intIter->hasMore () ) {
					$objName = $intIter->current ();
					//print_r($objName);
					if(is_a($objName,Classes_info::INTERFACE_AS_STRING_CLASS))
					 $objName = $objName->getItemName();
					if (array_key_exists ( $objName, $objNames )) {
						$objNameInd = $objName . VAR_SEP . $l;
						$objNames [$objNameInd] = $objName;
						$l ++;
					} else
						$objNames [$objName] = $objName;
					$intIter->next ();
				}
				foreach ( $objNames as $ind2 => $objName ) {
					$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
					$attribs = array (
							"value" => $ind2 
					);
					$interfaceOptionTag->setTagBody ( strComplete ( ucFirst ( $objName ), ENTITY_SPACE, 20 ) );
					$interfaceOptionTag->setAttribs ( $attribs );
					$interfaceSelect1Container->add ( $interfaceOptionTag );
				}
			}
			$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs = array ();
			$interfaceOptionTag->setTagBody ( STRING_NULL );
			$interfaceOptionTag->setAttribs ( $attribs );
			$interfaceSelect1Container->add ( $interfaceOptionTag );
			
			$interfaceBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			$interfaceBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
			
			$interfaceLabelTag3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
			$attribs = array (
					"id" => "label_codeBeforeBodyClose",
					"for" => "codeBeforeBodyClose_select" 
			);
			$interfaceLabelTag3->setAttribs ( $attribs );
			$interfaceLabelTag3->setTagBody ( LABEL_INTERFACCE . ENTITY_SPACE . ENTITY_SPACE );
			
			$interfaceSelect2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
			$attribs = array (
					"id" => "codeBeforeBodyClose_select",
					"onchange" => "select_container_interfaces_onChange('codeBeforeBodyClose_select','codeBeforeBodyCloseContainer')" 
			);
			$interfaceSelect2->setAttribs ( $attribs );
			$interfaceSelect2Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
			$interfaceSelect2->setInterfacesContainer ( $interfaceSelect2Container );
			
			$interfacesFiles1 = Interfaces_model::getAllInterfacesByPageAndType( $appName, $nomePagina,Interfaces_info::INT_JAVASCRIPT_CODE);
			$interfacesFiles2 = Interfaces_model::getAllInterfacesByPageAndType( $appName, $nomePagina,Interfaces_info::INT_JAVASCRIPT_CODE_DATA_TEMPLATE);
			$interfacesFiles3 = array_merge($interfacesFiles1,$interfacesFiles2);
			foreach ( $interfacesFiles3 as $ind => $interfaceFile ) {
				$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
				$attribs5 = array (
						"value" => $interfaceFile 
				);
				$interfaceOptionTag->setTagBody ( $interfaceFile );
				$interfaceOptionTag->setAttribs ( $attribs5 );
				$interfaceSelect2Container->add ( $interfaceOptionTag );
			}
			$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
			$attribs5 = array (
					"selected" => STRING_NULL 
			);
			$interfaceOptionTag->setTagBody ( STRING_NULL );
			$interfaceOptionTag->setAttribs ( $attribs5 );
			$interfaceSelect2Container->add ( $interfaceOptionTag );
			
			$intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
			$intButton2->setTagBody ( LABEL_EDIT );
			$intButton2->setAttribs ( array (
					"onclick" => "button_container_onClick(this)",
					"type" => "button" 
			) );
			
			$intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
			$intSpan1->setTagBody ( ENTITY_SPACE . ENTITY_SPACE );
			
			$intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
			$intSpan2->setTagBody ( ">>" );
			$intSpan2->setAttribs ( array (
					"id" => $intSpan2->getId (),
					"title" => LABEL_GESTIONE_CONTENITORE,
					"style" => "font-size:10pt;cursor:pointer;",
					"onclick" => "span_container_onClick(this);" 
			) );
			
			$intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
			$intDivTag2->setAttribs ( array (
					"id" => $intDivTag2->getId (),
					"style" => "padding:5px" 
			) );
			$intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
			$intDivTagContainer2->add ( $interfaceImg1 );
			$intDivTagContainer2->add ( $interfaceLabelTag2 );
			$intDivTagContainer2->add ( $interfaceSelect1 );
			$intDivTagContainer2->add ( $intButton2 );
			$intDivTagContainer2->add ( $intSpan1 );
			$intDivTagContainer2->add ( $intSpan2 );
			$intDivTagContainer2->add ( $interfaceBr3 );
			$intDivTagContainer2->add ( $interfaceBr4 );
			$intDivTagContainer2->add ( $interfaceLabelTag3 );
			$intDivTagContainer2->add ( $interfaceSelect2 );
			$intDivTag2->setInterfacesContainer ( $intDivTagContainer2 );
			$intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
			$intDivTag2->setDispFields ( array (
					LABEL_CONTENITORE_CODICE_PRIMA_CHIUSURA_BODY 
			) );
			
			$interfaceDivTagContainer1->add ( $intDec1 );
			$interfaceDivTagContainer1->add ( $intBr1 );
			$interfaceDivTagContainer1->add ( $intBr2 );
			
			/* */
            			
			$intForm = $interfaces->getInterface ( OBJ_NONE, OP_NONE, Interfaces_info::INT_FORM_2, NUM_1 );
			$intForm->setDataFieldDomainValueByName ( FIELD_NOME_PAGINA, $pagesFiles );
			$int_iter = $interfaces->create ();
			$int = $int_iter->last ();
			$int->putData ();
		} elseif (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && $_SESSION [SESSION_VAR_ACTIVE_APP] == STRING_NULL) {
			$interfaces->getInterface ( OBJ_NONE, OP_NONE, Interfaces_info::INT_HTML_TAGS, NUM_2 )->getInterfacesContainer ()->deleteItem ( 1 );
			$int_iter = $interfaces->create ();
			$int = $int_iter->last ();
			$int->putData ();
		} else {
			$int = $interfaces->getInterface ( OBJ_NONE, OP_NONE, Interfaces_info::INT_TEMP_MSG, NUM_0 );
			$int->putData ();
		}
	}
}
?>