function isValid() {
  var defUser='admin';
  var defPass='admin';

    var inUser = document.getElementById("usr").value;
    var inPass = document.getElementById("pass").value;

    if (defUser == inUser && defPass == inPass) {
      window.open(
        "../html/home.html",
        "_self"
      );
    } else {
      alert("Enter valid credentials");
    }
  }

  function reset() {
    document.getElementById("usr").value = "";
    document.getElementById("pass").value = "";
  }

  function clearErr(){
    document.getElementById("errMsg").value = "";
  }