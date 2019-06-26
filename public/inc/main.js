
function accordionFunction(id) {
    var element = document.getElementById(id);
    if (element.className.indexOf("show") == -1) {
      element.className = element.className.replace("hide", "show");
    } else { 
      element.className = element.className.replace("show", "hide");
    }
  }