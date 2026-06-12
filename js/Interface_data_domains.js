function Int_domain()
{
	this.name = '';
	this.setName = function(actName)
	{
		this.name = actName;
	};
	this.getName = function()
	{
		return this.name;
	};
	
	this.value = '';
	this.setValue = function(actValue)
	{
		this.value = actValue;
	};
	this.getValue = function()
	{
		return this.value;
	};	
	
	this.getAllValues = function()
	{
	 var value = this.getValue();
	 if (value != '')
		return value;
	 else
		return '';
	};
}

Int_domain.FIELD_DOMAIN_ATOMIC = "atomic";
Int_domain.FIELD_DOMAIN_SET = "set";
Int_domain.FIELD_DOMAIN_OBJ = "object";
Int_domain.FIELD_DOMAIN_FUNCTION = "function";
Int_domain.FIELD_DOMAIN_VAR = "var";

function Int_domain_atomic()
{
	this.setName(Int_domain.FIELD_DOMAIN_ATOMIC);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(fieldVal=='')
	 {
	  fieldVal = actFieldVal;
	 }
	 return fieldVal;		
	};
}

Int_domain_atomic.prototype = new Int_domain();
Int_domain_atomic.prototype.constructor = Int_domain_atomic.constructor;

function Int_domain_set()
{
	this.setName(Int_domain.FIELD_DOMAIN_SET);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(fieldVal=='')
	 {
	  alert('Errore nel valore del dominio:Int_domain_set.');
	 }
	 return fieldVal;		
	};
}

Int_domain_set.prototype = new Int_domain();
Int_domain_set.prototype.constructor = Int_domain_set.constructor;

function Int_domain_object()
{
	this.setName(Int_domain.FIELD_DOMAIN_OBJ);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(typeof fieldVal != 'object')
	 {
	  alert('Errore nel valore del dominio:Int_domain_object.');
	 }
	 return fieldVal;		
	};
}

Int_domain_object.prototype = new Int_domain();
Int_domain_object.prototype.constructor = Int_domain_object.constructor;

function Int_domain_function()
{
	this.setName(Int_domain.FIELD_DOMAIN_FUNCTION);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(fieldVal=='')
	 {
	  fieldVal = actFieldVal;
	 }
	 return fieldVal;		
	};
}

Int_domain_function.prototype = new Int_domain();
Int_domain_function.prototype.constructor = Int_domain_function.constructor;

function Int_domain_var()
{
	this.setName(Int_domain.FIELD_DOMAIN_VAR);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 return fieldVal;		
	};
}

Int_domain_var.prototype = new Int_domain();
Int_domain_var.prototype.constructor = Int_domain_function.constructor;

