function validatePass() {
  var input = document.getElementById("password");
  var errorMessage = document.getElementById("errorMessage");

  var isValid = input.value.length > 6;

  if (!isValid) {
    input.classList.add("error");
    input.style.outline = "2px solid red";
    errorMessage.innerText = "Plase enter 6 or more characters";
    errorMessage.style.color = "red";
  } else {
    input.classList.remove("error");
    errorMessage.innerText = "";
    input.style.outline = "none";
    errorMessage.style.color = "none";
  }
}

function validateConPass() {
  var input = document.getElementById("conpassword");
  var errorMessage = document.getElementById("conerrorMessage");

  var isValid = input.value.length > 6;

  if (!isValid) {
    input.classList.add("error");
    input.style.outline = "2px solid red";
    errorMessage.innerText = "Plase enter 6 or more characters";
    errorMessage.style.color = "red";
  } else {
    input.classList.remove("error");
    errorMessage.innerText = "";
    input.style.outline = "none";
    errorMessage.style.color = "none";
  }
}
