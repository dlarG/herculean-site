// resources/js/details-modal.js

const SPORT_DETAILS = {
    Badminton: {
        description:
            "Singles or doubles badminton match. Best of 3 sets, 21-point rally scoring.",
        note: "Bring your own racket and shuttlecocks.",
    },
    "Basketball 5x5": {
        description:
            "Full-court 5-on-5 basketball. Four 10-minute quarters, FIBA rules.",
        note: "Team jersey required. Bring your own ball for warm-up.",
    },
    "Basketball 3x3": {
        description:
            "Half-court 3-on-3 basketball. 10-minute games or first to 21 points.",
        note: "One substitute allowed per team.",
    },
    Chess: {
        description:
            "Standard FIDE-rules chess. Swiss system, 15 minutes per player.",
        note: "Bring your own chess set if possible.",
    },
    Futsal: {
        description: "Indoor 5-a-side futsal. Two 20-minute halves.",
        note: "Futsal shoes required — no cleats.",
    },
    "Lawn Tennis": {
        description: "Singles or doubles tennis. Best of 3 sets.",
        note: "Bring your own racket.",
    },
    Swimming: {
        description:
            "Freestyle, breaststroke, backstroke, or butterfly — 50m and 100m events.",
        note: "Bring goggles, cap, and towel.",
    },
    "Table Tennis": {
        description:
            "Singles or doubles table tennis. Best of 5 games to 11 points.",
        note: "Bring your own paddle if preferred.",
    },
    Volleyball: {
        description: "Indoor 6-on-6 volleyball. Best of 3 sets to 25 points.",
        note: "Knee pads recommended.",
    },
    "Beach Volleyball": {
        description: "2-on-2 beach volleyball. Best of 3 sets to 21 points.",
        note: "Played outdoors — bring sunscreen.",
    },
    Baseball: {
        description:
            "Standard 9-inning baseball game with 9 fielders per team.",
        note: "Bring your own glove and cleats.",
    },
    Football: {
        description: "Full 11-a-side football. Two 45-minute halves.",
        note: "Shin guards required. Cleats recommended.",
    },
    Softball: {
        description:
            "Standard 7-inning softball game with 9 fielders per team.",
        note: "Bring your own glove.",
    },

    "100m Sprint": {
        description: "100-meter dash. Heats and finals based on seed times.",
        note: "Spikes recommended. Warm up thoroughly.",
    },
    "200m Sprint": {
        description: "200-meter dash around the curve. Heats and finals.",
        note: "Spikes recommended.",
    },
    "400m Sprint": {
        description: "One full lap around the track. Heats and finals.",
        note: "Pace yourself — it's a sprinter's endurance race.",
    },
    "4x100m Relay": {
        description:
            "Four runners, 100m each. Baton exchange within designated zones.",
        note: "Practice handoffs before race day.",
    },
    "4x400m Relay": {
        description: "Four runners, 400m each. One lap per runner.",
        note: "Order matters — place your fastest anchor last.",
    },
    "Long Jump": {
        description: "Three attempts. Best mark advances to finals.",
        note: "Spikes recommended for the runway.",
    },
    "Triple Jump": {
        description: "Hop, step, and jump — three attempts, best mark counts.",
        note: "Spikes recommended.",
    },
    "Shot Put": {
        description: "Three throws. Best mark advances to finals.",
        note: "Technique matters more than raw strength.",
    },
    Discus: {
        description: "Three throws. Best mark advances to finals.",
        note: "Bring your own discus if allowed.",
    },
    Javelin: {
        description: "Three throws. Best mark advances to finals.",
        note: "Proper footwear and grip required.",
    },

    "On the Spot Poster Making": {
        description:
            "Create a poster on a surprise theme within the time limit.",
        note: "Bring your own materials. Paper provided.",
    },
    "Pencil Drawing": {
        description:
            "Freehand pencil drawing. Judged on technique, composition, creativity.",
        note: "Bring your own pencils and eraser.",
    },
    "Charcoal Rendering": {
        description: "Charcoal drawing on paper. Judged on shading and form.",
        note: "Bring your own charcoal and smudge tools.",
    },
    Painting: {
        description: "Painting on canvas using your chosen medium.",
        note: "Bring your own brushes and paints.",
    },

    "Pop Solo": {
        description:
            "Solo vocal performance of a pop song. One entry per contestant.",
        note: "Submit your minus-one track in advance.",
    },
    "Vocal Duet": {
        description: "Two-person vocal performance. Any genre.",
        note: "Coordinate costumes with your partner.",
    },
    "Vocal Solo Kundiman": {
        description: "Solo performance of a traditional Filipino kundiman.",
        note: "Live piano accompaniment provided.",
    },
    "Song Writing": {
        description:
            "Original song composition. Submit lyrics and perform live.",
        note: "Original work only — no covers.",
    },
    Piano: {
        description:
            "Solo piano performance. Any classical or contemporary piece.",
        note: "Submit sheet music in advance.",
    },

    Declamation: {
        description:
            "Dramatic delivery of a memorized piece. Judged on voice, emotion, stage presence.",
        note: "Memorize your piece — no notes allowed.",
    },
    "Extemporaneous Speaking": {
        description: "Impromptu speech on a surprise topic. 3–5 minutes.",
        note: "You get 5 minutes prep time.",
    },
    "Essay Writing": {
        description:
            "Timed essay on a surprise prompt. Judged on content and style.",
        note: "Bring your own pen. Paper provided.",
    },
    "Short and Sweet Play Dialog": {
        description:
            "Group performance of a short play or dialog. 5–10 minutes.",
        note: "Rehearse blocking and props.",
    },
    "Pangdalawahang Pag-arte": {
        description: "Two-person dramatic performance in Filipino.",
        note: "Costumes encouraged.",
    },

    "Mass Dance": {
        description: "Large-group dance performance. Open to all year levels.",
        note: "Choreography must be original or credited.",
    },
    "Folk Dance": {
        description: "Traditional Filipino folk dance performance.",
        note: "Traditional costumes required.",
    },
    "Pop Dance": {
        description: "Modern pop dance routine. Group or solo.",
        note: "Submit your music in advance.",
    },
    "Dance Sports - Latin/American": {
        description: "Ballroom dance sport — Latin or American style. Pairs.",
        note: "Costumes required. Pairs only.",
    },
    "Dance Sports - Standard": {
        description: "Standard ballroom dance sport. Pairs.",
        note: "Formal attire required.",
    },
    "Dance Sports - Third Kind": {
        description: "Contemporary or freestyle dance sport. Pairs.",
        note: "Costumes encouraged.",
    },
};

const GROUP_FALLBACKS = {
    Sports: "Competitive team or individual sport. Standard intramurals rules apply.",
    Athletics:
        "Track and field event. Heats and finals will be scheduled based on entries.",
    "Visual Arts":
        "Individual art competition. Materials and time limits will be announced on the day.",
    Music: "Musical performance category. Live performances judged by a panel.",
    "Literary-Musical":
        "Literary or theatrical performance. Judged on delivery and stage presence.",
    Dance: "Dance performance category. Choreography and execution will be judged.",
};

export function initDetailsModal() {
    const modal = document.getElementById("detailsModal");
    if (!modal) return;

    const modalBackdrop = document.getElementById("modalBackdrop");
    const modalPanel = document.getElementById("modalPanel");
    const modalTitle = document.getElementById("detailsModalTitle");
    const modalGroupPill = document.getElementById("modalGroupPill");
    const modalMembers = document.getElementById("modalMembers");
    const modalType = document.getElementById("modalType");
    const modalDescription = document.getElementById("modalDescription");
    const modalNote = document.getElementById("modalNote");
    const modalRegisterBtn = document.getElementById("modalRegisterBtn");

    const SPORTS = window.__SPORTS__ || [];
    const SPORTS_BY_ID = Object.fromEntries(SPORTS.map((s) => [s.id, s]));
    const REGISTER_URL = window.__REGISTER_URL__ || "/register/create";

    let lastFocusedEl = null;

    function openModal(sportId) {
        const sport = SPORTS_BY_ID[sportId];
        if (!sport) return;

        const details = SPORT_DETAILS[sport.name] || {};
        const fallback =
            GROUP_FALLBACKS[sport.group] ||
            "Details for this category will be announced soon.";

        modalTitle.textContent = sport.name;
        modalGroupPill.textContent = sport.group;
        modalMembers.textContent =
            sport.min === sport.max
                ? `${sport.max}`
                : `${sport.min}–${sport.max}`;
        modalType.textContent = sport.max === 1 ? "Individual" : "Team";
        modalDescription.textContent = details.description || fallback;
        modalNote.textContent =
            details.note ||
            "Bring your own gear. Arrive 30 minutes before your scheduled match.";
        modalRegisterBtn.href = `${REGISTER_URL}?sport=${encodeURIComponent(
            sport.name
        )}`;

        lastFocusedEl = document.activeElement;

        modal.classList.remove("hidden");
        modal.classList.add("flex");

        requestAnimationFrame(() => {
            modalBackdrop.classList.remove("opacity-0");
            modalPanel.classList.remove("opacity-0", "scale-95");
            modalPanel.classList.add("opacity-100", "scale-100");
        });

        document.body.style.overflow = "hidden";
        document.getElementById("modalClose").focus();
    }

    function closeModal() {
        modalBackdrop.classList.add("opacity-0");
        modalPanel.classList.add("opacity-0", "scale-95");
        modalPanel.classList.remove("opacity-100", "scale-100");

        setTimeout(() => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            document.body.style.overflow = "";
            if (lastFocusedEl) lastFocusedEl.focus();
        }, 200);
    }

    document.querySelectorAll(".details-btn").forEach((btn) => {
        btn.addEventListener("click", () => openModal(btn.dataset.sportId));
    });

    document.getElementById("modalClose").addEventListener("click", closeModal);
    document
        .getElementById("modalCloseFooter")
        .addEventListener("click", closeModal);
    modalBackdrop.addEventListener("click", closeModal);

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            closeModal();
        }
    });
}
