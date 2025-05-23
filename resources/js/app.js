import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// === Tambahin ini ===
document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll("a");

    links.forEach(link => {
        link.addEventListener("click", (e) => {
            // Cek kalau link internal
            if (
                link.hostname === window.location.hostname &&
                link.getAttribute('href') !== '#' &&
                !link.hasAttribute('target')
            ) {
                const loadingContainer = document.querySelector(".loading-container");
                if (loadingContainer) {
                    loadingContainer.style.display = "block";
                }
            }
        });
    });
});

window.addEventListener("load", function() {
    const loadingContainer = document.querySelector(".loading-container");
    if (loadingContainer) {
        loadingContainer.classList.add("hide");
        setTimeout(() => {
            loadingContainer.style.display = "none";
        }, 300);
    }
});
