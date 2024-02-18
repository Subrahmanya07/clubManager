function isValid() {
    const defUser = "admin";
    const defPass = "admin";

    var inUser = document.getElementById("usr").value;
    var inPass = document.getElementById("pass").value;

    fetch("C:/Users/hegde/OneDrive/Desktop/dbms/FrontEnd/php/login.php", { method: "POST", body: inPass,inPass })
  .then(res => res.text())
  .then(txt => console.log(txt))
  .catch(err => console.error(err));

    if (defUser == inUser && defPass == inPass) {
      window.open(
        "C:/Users/hegde/OneDrive/Desktop/dbms/FrontEnd/html/home.html",
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