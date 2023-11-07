// ********** Gestion de la modale ********** //
let contactModal = document.querySelector("#contact-modal")
let menuItem = document.querySelector("#menu-item-49 a")

menuItem.addEventListener("click", function (){
    contactModal.style.display = "block"
})

window.onclick = function(event) {
    if (event.target == contactModal) {
        contactModal.style.display = "none";
    }
}

// ********** Gestion photos miniatures single-photo ********** //


































