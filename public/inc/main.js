function accordionFunction(id) {
    var element = document.getElementById(id);
    if (element.className.indexOf("w3-show") == -1) {
      element.className += " w3-show";
    } else { 
      element.className = element.className.replace(" w3-show", "");
    }
  }