/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("resp_topnav_dropdown");
  if (x.className === "resp_topnav_dropdown") {
    x.className += " responsive";
  } else {
    x.className = "resp_topnav_dropdown";
  }
}