/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function sidenav_openNav(actMainContentId) {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById(actMainContentId).style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function sidenav_closeNav(actMainContentId) {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById(actMainContentId).style.marginLeft = "0";
}