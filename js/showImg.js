document.querySelector("#save-img").addEventListener("change", function () {
    if (this.files[0]) {
        var fr = new FileReader();
        fr.addEventListener("load", function () {
        document.querySelector(".modal-show-img").innerHTML = `<img class="show-img img-responsive" src="${fr.result}" alt="image">`;
        }, false);

        fr.readAsDataURL(this.files[0]);
    }
});