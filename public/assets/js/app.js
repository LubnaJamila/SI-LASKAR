document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");
    const mobileOverlay = document.querySelector(".mobile-overlay");

    function collapseAllSubmenus() {
        const submenus = sidebar.querySelectorAll(".collapse");
        const toggles = sidebar.querySelectorAll("[data-bs-toggle='collapse']");

        submenus.forEach(menu => menu.classList.remove("show"));
        toggles.forEach(btn => btn.setAttribute("aria-expanded", "false"));
    }

    function toggleSidebar(e) {
        e.preventDefault();
        e.stopPropagation();

        if (window.innerWidth >= 992) {
            // DESKTOP
            sidebar.classList.toggle("collapsed");
            sidebar.classList.remove("mobile-open");

            if (sidebar.classList.contains("collapsed")) {
                collapseAllSubmenus();
            }
        } else {
            // MOBILE & TABLET
            sidebar.classList.toggle("mobile-open");
            sidebar.classList.remove("collapsed");
        }
    }

    function closeSidebar() {
        sidebar.classList.remove("mobile-open");
    }

    menuToggle.addEventListener("click", toggleSidebar);
    menuToggle.addEventListener("touchstart", toggleSidebar);

    mobileOverlay.addEventListener("click", closeSidebar);
    mobileOverlay.addEventListener("touchstart", closeSidebar);

    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove("mobile-open");
        } else {
            sidebar.classList.remove("collapsed");
            collapseAllSubmenus();
        }
    });
     // ========== FILTER SELECT ==========
    const filterContainer = document.getElementById("filterContainer");
    const selectEl = document.getElementById("filterJenis");

    if (selectEl && filterContainer) {
        selectEl.addEventListener("click", () => {
            filterContainer.classList.toggle("open");
        });

        selectEl.addEventListener("blur", () => {
            filterContainer.classList.remove("open");
        });
    }
});

// // Deteksi klik untuk toggle ikon chevron
// const filterContainer = document.getElementById("filterContainer");
// const selectEl = document.getElementById("filterJenis");

// selectEl.addEventListener("click", () => {
//     filterContainer.classList.toggle("open");
// });

// // Pastikan ikon turun lagi setelah kehilangan fokus
// selectEl.addEventListener("blur", () => {
//     filterContainer.classList.remove("open");
// });

$(document).ready(function () {
    $("#example").DataTable({
        language: {
            lengthMenu: "Tampilkan _MENU_ entri",
            search: "",
            searchPlaceholder: "Cari...",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya",
            },
        },
    });
});
