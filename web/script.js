const formOpenBtn = document.querySelector("#form-open"),
  home = document.querySelector(".home"),
  formContainer = document.querySelector(".form_container"),
  formCloseBtn = document.querySelector(".form_close"),
  signupBtn = document.querySelector("#signup"),
  loginBtn = document.querySelector("#login"),
  pwShowHide = document.querySelectorAll(".pw_hide");
  
pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});

signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    update();
    home.classList.remove("show");
    formContainer.classList.add("active"); 
    document.body.classList.add("adjusted");
  });

loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active"); 
  home.classList.add("show");
  document.body.classList.remove("adjusted");
});

function update() {
  var selectedRole = document.getElementById("userRole").value;
  switch (selectedRole) {
    case "parent":
      document.getElementById("emailInput").style.display = "block";
      document.getElementById("passwordInput").style.display = "block";
      document.getElementById("confirmPasswordInput").style.display = "block";
      break;
    case "owner":
      document.getElementById("cityInput").style.display = "none";
      break;
    case "driver":
      document.getElementById("cityInput").style.display = "none";
      break;
    case "admin":
      // Handle admin specific fields
      break;
  }
}
