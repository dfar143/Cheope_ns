function Container(actName)
{
	this.name = actName;
	this.getName = function()
	{
		return this.name;
	};
	this.setName = function(actName)
	{
		this.name = actName;
	}
	this.contents = new Array();
	this.getContents = function()
	{
		return this.contents;
	}
	this.setContents = function(actContents)
	{
		this.contents = actContents;
	}
	this.count = function()
	{
		var contents = this.getContents();
		return contents.length;
  }
	this.setElement = function(actItem,actPos)
	{
		var contents = this.getContents();
		if((actPos <= this.count()) && (actPos>=0))
		{
			contents[actPos] = actItem;
			return true;
		}
		else
		 return false;
	}
	this.getElement = function(actPos)
	{
		var contents = this.getContents();
		if((actPos <= this.count()) && (actPos>=0))
		{
			return contents[actPos];
			return true;
		}
		else
		 return false;		
	}
	this.add = function(actItem)
	{
		var contents = this.getContents();
		contents.push(actItem);
	}
	this.deleteItem = function(actPos)
	{
		var contents = this.getContents();
		contents.splice(actPos,1);
	}
	
}