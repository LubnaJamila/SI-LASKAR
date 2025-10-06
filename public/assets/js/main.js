/**
* Template Name: Arsha
* Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
* Updated: Feb 22 2025 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
    ("use strict");

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
        const selectBody = document.querySelector("body");
        const selectHeader = document.querySelector("#header");
        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;
        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

    function mobileNavToogle() {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    }
    if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener("click", mobileNavToogle);
    }

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", () => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToogle();
            }
        });
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document
        .querySelectorAll(".navmenu .toggle-dropdown")
        .forEach((navmenu) => {
            navmenu.addEventListener("click", function (e) {
                e.preventDefault();
                this.parentNode.classList.toggle("active");
                this.parentNode.nextElementSibling.classList.toggle(
                    "dropdown-active"
                );
                e.stopImmediatePropagation();
            });
        });

    /**
     * Preloader
     */
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    /**
     * Scroll top button
     */
    let scrollTop = document.querySelector(".scroll-top");

    function toggleScrollTop() {
        if (scrollTop) {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        }
    }
    scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);

    /**
     * Animation on scroll function and init
     */
    function aosInit() {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }
    window.addEventListener("load", aosInit);

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Init swiper sliders
     */
    function initSwiper() {
        document
            .querySelectorAll(".init-swiper")
            .forEach(function (swiperElement) {
                let config = JSON.parse(
                    swiperElement
                        .querySelector(".swiper-config")
                        .innerHTML.trim()
                );

                if (swiperElement.classList.contains("swiper-tab")) {
                    initSwiperWithCustomPagination(swiperElement, config);
                } else {
                    new Swiper(swiperElement, config);
                }
            });
    }

    window.addEventListener("load", initSwiper);

    /**
     * Frequently Asked Questions Toggle
     */
    document
        .querySelectorAll(".faq-item h3, .faq-item .faq-toggle")
        .forEach((faqItem) => {
            faqItem.addEventListener("click", () => {
                faqItem.parentNode.classList.toggle("faq-active");
            });
        });

    /**
     * Animate the skills items on reveal
     */
    let skillsAnimation = document.querySelectorAll(".skills-animation");
    skillsAnimation.forEach((item) => {
        new Waypoint({
            element: item,
            offset: "80%",
            handler: function (direction) {
                let progress = item.querySelectorAll(".progress .progress-bar");
                progress.forEach((el) => {
                    el.style.width = el.getAttribute("aria-valuenow") + "%";
                });
            },
        });
    });

    // Popup Portfolio
    document.querySelectorAll(".preview-popup").forEach((item) => {
        item.addEventListener("click", () => {
            const src = item.getAttribute("data-src");
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("popupImage");
            modal.style.display = "block";
            modalImg.src = src;
        });
    });

    const itemsPerPage = 6;
    const items = document.querySelectorAll(".portfolio-item");
    let currentPage = 1;
    const totalPages = Math.ceil(items.length / itemsPerPage);

    function showPage(page) {
        items.forEach((item, index) => {
            item.style.display =
                index >= (page - 1) * itemsPerPage &&
                index < page * itemsPerPage
                    ? "block"
                    : "none";
        });

        // Disable button jika di halaman pertama / terakhir
        document.getElementById("prevBtn").disabled = page === 1;
        document.getElementById("nextBtn").disabled = page === totalPages;
    }

    document.getElementById("prevBtn").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Tampilkan halaman pertama saat load
    showPage(currentPage);

    // Close modal with X button
    document.querySelector(".close-modal").addEventListener("click", () => {
        document.getElementById("imageModal").style.display = "none";
    });

    // Close modal when clicking outside the image
    window.addEventListener("click", (e) => {
        const modal = document.getElementById("imageModal");
        if (e.target === modal) modal.style.display = "none";
    });

    /**
     * Init isotope layout and filters
     */
    document
        .querySelectorAll(".isotope-layout")
        .forEach(function (isotopeItem) {
            let layout = isotopeItem.getAttribute("data-layout") ?? "masonry";
            let filter = isotopeItem.getAttribute("data-default-filter") ?? "*";
            let sort =
                isotopeItem.getAttribute("data-sort") ?? "original-order";

            let initIsotope;
            imagesLoaded(
                isotopeItem.querySelector(".isotope-container"),
                function () {
                    initIsotope = new Isotope(
                        isotopeItem.querySelector(".isotope-container"),
                        {
                            itemSelector: ".isotope-item",
                            layoutMode: layout,
                            filter: filter,
                            sortBy: sort,
                        }
                    );
                }
            );

            isotopeItem
                .querySelectorAll(".isotope-filters li")
                .forEach(function (filters) {
                    filters.addEventListener(
                        "click",
                        function () {
                            isotopeItem
                                .querySelector(
                                    ".isotope-filters .filter-active"
                                )
                                .classList.remove("filter-active");
                            this.classList.add("filter-active");
                            initIsotope.arrange({
                                filter: this.getAttribute("data-filter"),
                            });
                            if (typeof aosInit === "function") {
                                aosInit();
                            }
                        },
                        false
                    );
                });
        });

    /**
     * Correct scrolling position upon page load for URLs containing hash links.
     */
    window.addEventListener("load", function (e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop =
                        getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: "smooth",
                    });
                }, 100);
            }
        }
    });

    /**
     * Navmenu Scrollspy
     */
    let navmenulinks = document.querySelectorAll(".navmenu a");

    function navmenuScrollspy() {
        navmenulinks.forEach((navmenulink) => {
            if (!navmenulink.hash) return;
            let section = document.querySelector(navmenulink.hash);
            if (!section) return;
            let position = window.scrollY + 200;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                document
                    .querySelectorAll(".navmenu a.active")
                    .forEach((link) => link.classList.remove("active"));
                navmenulink.classList.add("active");
            } else {
                navmenulink.classList.remove("active");
            }
        });
    }
    window.addEventListener("load", navmenuScrollspy);
    document.addEventListener("scroll", navmenuScrollspy);
})();

const map = L.map("map").setView([-2.5, 118], 5);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 18,
  attribution: '&copy; <a href="https://www.openstreetmap.org/">OSM</a>',
}).addTo(map);

// Fungsi pewarnaan
function getColor(total_wps, total_hotspot) {
  if (total_wps >= 100 || total_hotspot >= 8) return "#FF0000"; // Merah
  else if (
    (total_wps >= 50 && total_wps < 100) ||
    (total_hotspot >= 4 && total_hotspot < 8)
  )
    return "#FFFF00"; // Kuning
  else return "#008000"; // Hijau
}

// Fungsi gelapkan border
function shadeColor(color, percent) {
  if (color.toUpperCase() === "#FFFF00") return "#999900"; // khusus kuning
  const f = parseInt(color.slice(1), 16),
    t = percent < 0 ? 0 : 255,
    p = Math.abs(percent) / 100,
    R = f >> 16,
    G = (f >> 8) & 0x00ff,
    B = f & 0x0000ff;
  return (
    "#" +
    (
      0x1000000 +
      (Math.round((t - R) * p) + R) * 0x10000 +
      (Math.round((t - G) * p) + G) * 0x100 +
      (Math.round((t - B) * p) + B)
    )
      .toString(16)
      .slice(1)
  );
}

// Style untuk setiap feature
function featureStyle(feature) {
  const fill = getColor(
    feature.properties.total_wps,
    feature.properties.total_hotspot
  );
  return {
    fillColor: fill,
    color: shadeColor(fill, -40),
    weight: 2,
    opacity: 1,
    fillOpacity: 0.5,
  };
}

// Event highlight & click
let selectedLayer = null;
function highlightFeature(e) {
  const layer = e.target;
  const fill = getColor(layer.feature.properties.total_wps, layer.feature.properties.total_hotspot);
  layer.setStyle({
    color: shadeColor(fill, -20),
    weight: 3,
    fillOpacity: 0.6,
  });
}
function resetHighlight(e) {
  const layer = e.target;
  if (selectedLayer !== layer && geojson) {
    geojson.resetStyle(layer);
  }
}
function zoomToFeature(e) {
  const layer = e.target;
  if (selectedLayer && geojson) geojson.resetStyle(selectedLayer);
  selectedLayer = layer;
  const fill = getColor(layer.feature.properties.total_wps, layer.feature.properties.total_hotspot);
  layer.setStyle({
    color: shadeColor(fill, -20),
    weight: 3,
    fillOpacity: 0.6,
  });
  map.fitBounds(layer.getBounds());
}
function onEachFeature(feature, layer) {
  layer.on({
    mouseover: highlightFeature,
    mouseout: resetHighlight,
    click: zoomToFeature,
  });
  layer.bindPopup(`<b>${feature.properties.nama_kecamatan}</b><br/>
    Total WPS: ${feature.properties.total_wps}<br/>
    Total Hotspot: ${feature.properties.total_hotspot}`);
}

// Load GeoJSON dari public
const dataUrl = "/geojson/kecamatan.geojson";
let geojson;

fetch(dataUrl)
  .then((res) => res.json())
  .then((data) => {
    geojson = L.geoJSON(data, {
      style: featureStyle,
      onEachFeature: onEachFeature,
    }).addTo(map);

    map.fitBounds(geojson.getBounds());

    // Pastikan kuning di bawah
    geojson.eachLayer(function (layer) {
      const fill = getColor(layer.feature.properties.total_wps, layer.feature.properties.total_hotspot);
      if (fill === "#FFFF00") layer.bringToBack();
    });

    // Tambah legenda
    const info = L.control({ position: "topright" });
    info.onAdd = function () {
      const div = L.DomUtil.create("div", "info");
      div.innerHTML = `
        <h4>Legenda WPS & Hotspot</h4>
        <div class="legend-item"><span class="legend-color" style="background:#FF0000"></span> WPS ≥ 100 atau Hotspot ≥ 8</div>
        <div class="legend-item"><span class="legend-color" style="background:#FFFF00"></span> WPS 50–99 atau Hotspot 4–7</div>
        <div class="legend-item"><span class="legend-color" style="background:#008000"></span> WPS < 50 dan Hotspot ≤ 3</div>
      `;
      return div;
    };
    info.addTo(map);
  })
  .catch((err) => {
    console.error("Gagal memuat GeoJSON:", err);
    alert("Gagal memuat data kecamatan.");
  });