var sortTab = function(){

 var SORT_COLUMN_INDEX;
 
 function st_rendiOrdinabile(table) {
  if (table.rows && table.rows.length > 0) {
    var firstRow = table.rows[0];
  }
  if (!firstRow) return;
  // Prima riga: si assume che sia l'header
  // i contenuti vengono trasformati in link cliccabili
  for (var i=0; i<firstRow.cells.length; i++) {
    var cell = firstRow.cells[i];
    var txt = st_getInnerText(cell);
    cell.innerHTML = '<a href="#" class="sorthdr" onclick="sortTab.riordina(this);return false;">'+txt+'<span class="sortfrec">&nbsp;&nbsp;</span></a>';
  }
}

function st_getInnerText(el) {
  if (typeof el == "string") return el;
  if (typeof el == "undefined") { return el };
  if (el.innerText) return el.innerText;
  var str = "";

  var cs = el.childNodes;
  var l = cs.length;
  for (var i=0; i<l; i++) {
    switch (cs[i].nodeType) {
      case 1: // ELEMENT_NODE
        str += st_getInnerText(cs[i]);
        break;
      case 3: // TEXT_NODE
        str += cs[i].nodeValue;
        break;
    }
  }
  return str;
}


function st_riordinaTab(lnk) {
  // recupera contenuto tag span
  var span;
  for (var ci=0; ci<lnk.childNodes.length; ci++) {
    if (lnk.childNodes[ci].tagName && lnk.childNodes[ci].tagName.toLowerCase() == 'span')
      span=lnk.childNodes[ci];
  }
  var spantext = st_getInnerText(span);
  var td = lnk.parentNode;
  var column = td.cellIndex;
  var table = getParent(td,'TABLE');

  // Cerca di determinare il tipo dato della colonna
  if (table.rows.length <= 1) return;
  var itm = st_getInnerText(table.rows[1].cells[column]);
  var sortfn = st_sort_caseinsensitive;
  if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d\d\d$/)) sortfn = st_sort_date;
  if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d$/)) sortfn = st_sort_date;
  if (itm.match(/^[£$]/)) sortfn = st_sort_currency;
  if (itm.match(/^[\d\.]+$/)) sortfn = st_sort_numeric;
  SORT_COLUMN_INDEX = column;
  var firstRow = new Array();
  var newRows = new Array();
  for (var i=0; i<table.rows[0].length; i++) { firstRow[i] = table.rows[0][i]; }
  for (var j=1; j<table.rows.length; j++) { newRows[j-1] = table.rows[j]; }

  newRows.sort(sortfn);

  if (span.getAttribute("sortdir") == 'down') {
    var ARROW = '&nbsp;&uarr;';
    newRows.reverse();
    span.setAttribute('sortdir','up');
  } else {
    var ARROW = '&nbsp;&darr;';
    span.setAttribute('sortdir','down');
  }

  // We appendChild rows that already exist to the tbody, so it moves them rather than creating new ones
  // don't do sortbottom rows
  for (var i=0; i<newRows.length; i++) {
    if (!newRows[i].className || (newRows[i].className && (newRows[i].className.indexOf('sortbottom') == -1)))
      table.tBodies[0].appendChild(newRows[i]);
  }
  // do sortbottom rows only
  for (var i=0; i<newRows.length; i++) {
    if (newRows[i].className && (newRows[i].className.indexOf('sortbottom') != -1))
      table.tBodies[0].appendChild(newRows[i]);
  }

  // Delete any other arrows there may be showing
  var allspans = document.getElementsByTagName("span");
  for (var ci=0; ci<allspans.length; ci++) {
    if (allspans[ci].className == 'sortfrec') {
      if (getParent(allspans[ci],"table") == getParent(lnk,"table")) { // in the same table as us?
        allspans[ci].innerHTML = '&nbsp;&nbsp;';
      }
    }
  }

  span.innerHTML = ARROW;
}

function getParent(el, pTagName) {
  if (el == null) return null;
  else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase()) // Gecko bug, supposed to be uppercase
    return el;
  else
    return getParent(el.parentNode, pTagName);
}

function st_sort_date(a,b) {
  // y2k notes: two digit years less than 50 are treated as 20XX, greater than 50 are treated as 19XX
  var aa = st_getInnerText(a.cells[SORT_COLUMN_INDEX]);
  var bb = st_getInnerText(b.cells[SORT_COLUMN_INDEX]);
  if (aa.length == 10) {
    var dt1 = aa.substr(6,4)+aa.substr(3,2)+aa.substr(0,2);
  } else {
    var yr = aa.substr(6,2);
    if (parseInt(yr) < 50) { yr = '20'+yr; } else { yr = '19'+yr; }
    var dt1 = yr+aa.substr(3,2)+aa.substr(0,2);
  }
  if (bb.length == 10) {
    var dt2 = bb.substr(6,4)+bb.substr(3,2)+bb.substr(0,2);
  } else {
    var yr = bb.substr(6,2);
    if (parseInt(yr) < 50) { yr = '20'+yr; } else { yr = '19'+yr; }
    var dt2 = yr+bb.substr(3,2)+bb.substr(0,2);
  }
  if (dt1==dt2) return 0;
  if (dt1<dt2) return -1;
  return 1;
}

function st_sort_currency(a,b) {
  var aa = st_getInnerText(a.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
  var bb = st_getInnerText(b.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
  return parseFloat(aa) - parseFloat(bb);
}

function st_sort_numeric(a,b) {
  var aa = parseFloat(st_getInnerText(a.cells[SORT_COLUMN_INDEX]));
  if (isNaN(aa)) aa = 0;
  var bb = parseFloat(st_getInnerText(b.cells[SORT_COLUMN_INDEX]));
  if (isNaN(bb)) bb = 0;
  return aa-bb;
}

function st_sort_caseinsensitive(a,b) {
  var aa = st_getInnerText(a.cells[SORT_COLUMN_INDEX]).toLowerCase();
  var bb = st_getInnerText(b.cells[SORT_COLUMN_INDEX]).toLowerCase();
  if (aa==bb) return 0;
  if (aa<bb) return -1;
  return 1;
}

function st_sort_default(a,b) {
  var aa = st_getInnerText(a.cells[SORT_COLUMN_INDEX]);
  var bb = st_getInnerText(b.cells[SORT_COLUMN_INDEX]);
  if (aa==bb) return 0;
  if (aa<bb) return -1;
  return 1;
}

 return {
 	"sorttab_init":
  function () {
  // Trova le tabelle con classe "sorttab" e le rende ordinabili
  if (!document.getElementsByTagName) return;
  var tbls = document.getElementsByTagName("table");
  for (var ti=0; ti<tbls.length; ti++) {
    var thisTbl = tbls[ti];
    if (((' '+thisTbl.className+' ').indexOf("sorttab") != -1) && (thisTbl.id)) {
      st_rendiOrdinabile(thisTbl);
    }
  }
},
"addEvent":function(elm, evType, fn, useCapture) {
  if (elm.addEventListener){
    elm.addEventListener(evType, fn, useCapture);
    return true;
  } else if (elm.attachEvent){
    var r = elm.attachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
  }
},
"riordina":function(lnk){st_riordinaTab(lnk);}
};
}();

sortTab.addEvent(window, "load", sortTab.sorttab_init);








