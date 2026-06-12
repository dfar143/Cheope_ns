var menu = function()
{
 return {
"showMenu":function(actId)
{
 var element = document.getElementById(actId);
 element.style.visibility = "visible";
}
,
"showMenu_2":function(actId)
{
 var element = document.getElementById(actId);
 element.style.display = "block";
}
,
"hideMenu":function(actId)
{
 var element = document.getElementById(actId);
 element.style.visibility = "hidden";
}
,
"hideMenu_2":function(actId)
{
 var element = document.getElementById(actId);
 element.style.display = "none";
}
};
}();
