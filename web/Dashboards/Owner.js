const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})
 

/*const assignDriversButtons = document.querySelectorAll(".second-row-buttons .assign-drivers");
const editDetailsButtons = document.querySelectorAll(".second-row-buttons .edit-details");

assignDriversButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        button.classList.add("animate");
        setTimeout(() => {
            button.classList.remove("animate");
        }, 600);
    });
});

editDetailsButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        button.classList.add("animate");
        setTimeout(() => {
            button.classList.remove("animate");
        }, 600);
    });
});*/