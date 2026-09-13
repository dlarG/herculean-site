import "./bootstrap";
import { initDetailsModal } from "./details-modal";

// ── Hero carousel ────────────────────────────────────────────────
function initHeroCarousel() {
    const slides = document.querySelectorAll(".hero-slide");
    const dots = document.querySelectorAll(".hero-dot");
    if (!slides.length) return;

    let current = 0;
    let timer = null;
    const DURATION = 6000;

    function show(index) {
        slides.forEach((el, i) => {
            el.classList.toggle("opacity-100", i === index);
            el.classList.toggle("opacity-0", i !== index);
        });
        dots.forEach((dot, i) => {
            const isActive = i === index;
            dot.style.width = isActive ? "24px" : "8px";
            dot.style.background = isActive
                ? "var(--gold)"
                : "rgba(255,255,255,0.4)";
        });
        current = index;
    }

    function next() {
        show((current + 1) % slides.length);
    }
    function start() {
        stop();
        timer = setInterval(next, DURATION);
    }
    function stop() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    dots.forEach((dot) => {
        dot.addEventListener("click", () => {
            show(parseInt(dot.dataset.slide, 10));
            start();
        });
    });

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;
    if (!reducedMotion) {
        start();
        document.addEventListener("visibilitychange", () => {
            document.hidden ? stop() : start();
        });
    }
}

// ── Theme toggle ─────────────────────────────────────────────────
function initThemeToggle() {
    const root = document.documentElement;
    const toggleBtn = document.getElementById("themeToggle");
    const iconSun = document.getElementById("themeIconSun");
    const iconMoon = document.getElementById("themeIconMoon");
    if (!toggleBtn) return;

    function applyIcons(theme) {
        if (theme === "dark") {
            iconSun.classList.remove("hidden");
            iconMoon.classList.add("hidden");
        } else {
            iconSun.classList.add("hidden");
            iconMoon.classList.remove("hidden");
        }
    }

    applyIcons(root.getAttribute("data-theme") || "dark");

    toggleBtn.addEventListener("click", () => {
        const next =
            root.getAttribute("data-theme") === "dark" ? "light" : "dark";
        root.setAttribute("data-theme", next);
        localStorage.setItem("theme", next);
        applyIcons(next);
    });
}

// ── Boot ─────────────────────────────────────────────────────────
document.addEventListener("DOMContentLoaded", () => {
    const modalImageWrapper = document.getElementById("modalImageWrapper");
    const modalImage = document.getElementById("modalImage");

    initDetailsModal();
    initHeroCarousel();
    initThemeToggle();
});
