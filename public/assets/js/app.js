document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");
    const mobileOverlay = document.querySelector(".mobile-overlay");

    // Toggle sidebar pada semua ukuran layar
    menuToggle.addEventListener("click", function () {
        if (window.innerWidth >= 768) {
            // Desktop: toggle collapsed state
            sidebar.classList.toggle("collapsed");
        } else {
            // Mobile: toggle sidebar visibility
            sidebar.classList.toggle("mobile-open");
        }
    });

    // Tutup sidebar mobile saat overlay diklik
    mobileOverlay.addEventListener("click", function () {
        sidebar.classList.remove("mobile-open");
    });

    // Responsif saat resize window
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove("mobile-open");
        } else {
            sidebar.classList.remove("collapsed");
        }
    });
});
