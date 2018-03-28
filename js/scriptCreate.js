document.querySelector(".modall").addEventListener("click", function () {
    var inputFile = document.querySelector("input[name=image]");   
    var inputName = document.querySelector("input[name=name]");   
    var inputEmail = document.querySelector("input[name=email]");   
    var inputDescription = document.querySelector("textarea[name=description]");   
    var pName = document.querySelector("p[data-input=name]");
    var pEmail = document.querySelector("p[data-input=email]");
    var pDescription = document.querySelector("p[data-input=description]");
    pName.innerHTML = inputName.value;
    pEmail.innerHTML = inputEmail.value;
    pDescription.innerHTML = inputDescription.value;
});
