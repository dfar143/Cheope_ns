/* Toggle between adding and removing the "responsive" class to the navbar when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myNavbar");
  console.log('HHH');
  if (x.className === "resp_navbar") {
    x.className += " responsive";
  } else {
    x.className = "resp_navbar";
  }
}