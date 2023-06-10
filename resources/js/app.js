import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    var modalToggle = document.getElementById("modal-toggle");
    var modalClose = document.getElementById("modal-close");
    var postModal = document.getElementById("post-modal");

    modalToggle.addEventListener("click", function (event) {
        event.preventDefault();
        postModal.classList.remove("hidden");
    });

    modalClose.addEventListener("click", function (event) {
        event.preventDefault();
        postModal.classList.add("hidden");
    });
});
