// resources/js/details-modal.js

const SPORT_DETAILS = {
    Badminton: {
        description:
            "A rapid racquet sport where players hit a feathered or synthetic projectile (shuttlecock) back and forth across a high net. Played in singles or doubles on a rectangular indoor court, it demands explosive footwork, lightning-fast reflexes, pinpoint accuracy, and a mix of delicate drop shots and powerful smashes.",
        note: "Bring your own racket and shuttlecocks.",
    },
    Basketball: {
        description:
            "A fast-paced team sport centered on shooting a ball through an elevated hoop. 5x5 basketball is played on a full indoor court with five players per side, emphasizing structured offensive plays, zone or man-to-man defense, and deep tactical rotations. 3x3 basketball is a condensed, high-intensity half-court variant played with three players per side and one hoop, featuring a fast 12-second shot clock and continuous frantic action.",
        note: "Team jersey required. Bring your own ball for warm-up.",
    },

    Chess: {
        description:
            "A strategic board game of intellectual combat played on an 8x8 checkered grid by two opponents. Each player commands an army of sixteen pieces with distinct movement rules, aiming to trap the opponent's king in an inescapable checkmate through tactical combinations, spatial control, and long-term positional planning.",
        note: "Bring your own chess set if possible.",
    },
    Futsal: {
        description:
            "A variant of association football played on a hard, smaller indoor or outdoor court enclosed by touchlines, featuring five players per side (including a goalkeeper). Using a smaller, heavier, low-bounce ball, futsal places a premium on tight ball control, quick passing combinations, spatial awareness, and rapid transitions.",
        note: "Futsal shoes required — no cleats.",
    },
    "Lawn Tennis": {
        description:
            "A racket sport played individually against a single opponent (singles) or between two teams of two players each (doubles) on a rectangular court divided by a net. Players strike a felt-covered rubber ball using various spins, slices, and power shots to outmaneuver their opponent within the baseline and service boxes.",
        note: "Bring your own racket.",
    },
    Swimming: {
        description:
            "An aquatic racing sport where competitors propel themselves through water using designated strokes—freestyle, backstroke, breaststroke, and butterfly. Success requires hydrodynamic body positioning, efficient breathing techniques, explosive starts off the blocks, and precise turn execution at the pool walls.",
        note: "Bring goggles, cap, and towel.",
    },
    "Table Tennis": {
        description:
            "A fast-paced racket sport played on a hard divided table by two or four players who hit a lightweight hollow ball back and forth using small wooden rackets. Points are won through speed, lightning reflexes, spin manipulation (topspin, backspin, sidespin), and tactical placement.",
        note: "Bring your own paddle if preferred.",
    },
    Volleyball: {
        description:
            "A non-contact team sport where players use their hands and arms to volley a ball over a high net. Indoor volleyball features six players per side on a hard court, emphasizing specialized positional roles (setters, liberos, hitters), powerful jump serves, and coordinated blocking schemes. Beach volleyball is played outdoors on sand with teams of two, requiring exceptional endurance, court coverage, leaping ability, and adaptability to wind and sun.",
        note: "Knee pads recommended.",
    },
    "Beach Volleyball": {
        description: "2-on-2 beach volleyball. Best of 3 sets to 21 points.",
        note: "Played outdoors — bring sunscreen.",
    },
    Baseball: {
        description:
            "A bat-and-ball team sport played between two teams taking turns batting and fielding on a diamond-shaped infield. Pitchers throw a ball toward a batter trying to hit it into fair territory to run around four bases, combining individual pitching and hitting matchups with team defensive strategy.",
        note: "Bring your own glove and cleats.",
    },
    Football: {
        description:
            "The world's most popular team sport, played on a large rectangular grass field with eleven players per side. The objective is to maneuver a spherical ball into the opposing goal using any part of the body except the hands and arms (excluding the goalkeeper), blending endurance, tactical passing, and team structure.",
        note: "Shin guards required. Cleats recommended.",
    },
    Softball: {
        description:
            "A close relative of baseball played with a larger ball, an underhand pitching delivery, and a smaller diamond-shaped field. It features faster game pacing and shorter distances between bases, requiring sharp reflexes, quick base-running decisions, and strong defensive teamwork.",
        note: "Only exclusive for female participants.",
    },

    Sprint: {
        description:
            "Sprinting in athletics encompasses the 100m, 200m, and 400m events, testing explosive power, top-end velocity, and speed endurance on a standard track. The 100m is the ultimate test of pure acceleration and maximum speed executed entirely along a single straightaway, leaving zero room for technical error. The 200m introduces curve-running mechanics and demands speed endurance to maintain near-peak velocity over half a lap. Finally, the 400m pushes the limits of human physiology across a full lap, requiring strategic pacing and extreme tolerance to lactic acid fatigue to sustain power through the home stretch. Together, these disciplines highlight a progression from an instantaneous burst of speed to intense metabolic grit, all driven by precise biomechanics from the starting blocks to the finish line.",
        note: "Spikes recommended. Warm up thoroughly.",
    },

    Relay: {
        description:
            "Relay events in sprint athletics—most prominently the 4x100m and 4x400m—transform individual velocity into a team effort governed by precise baton exchanges inside designated passing zones. The 4x100m relay demands explosive speed and blind handoffs, where sprinters pass the baton at near-maximal velocity without looking back. In contrast, the 4x400m relay tests speed endurance and race tactics, requiring visual exchanges under heavy fatigue as runners navigate track traffic after breaking from assigned lanes on the second leg. Success across all relays depends as much on chemistry, timing, and flawless handoff execution as it does on raw speed.",
        note: "Practice handoffs before race day.",
    },

    "Long Jump": {
        description:
            "The long jump is a field event in athletics that translates horizontal sprint speed into maximum vertical and forward distance. Athletes build controlled, peak velocity down a straight runway before launching off a single foot from a wooden take-off board into a sand pit, where the distance is measured from the board to the nearest mark made in the sand. Success relies on four distinct phases: a precise approach run to hit maximum controllable speed, an explosive take-off driving the hips upward without stepping past the foul line, aerial techniques in the flight phase (such as the hitch-kick or sail technique) to maintain balance, and a forward-leaning landing that extends the feet as far forward as possible without falling backward.",
        note: "Spikes recommended for the runway.",
    },
    "Triple Jump": {
        description:
            "A horizontal jump event requiring athletes to execute a precise three-phase sequence—the hop, step, and jump—off a runway into a sand pit. The athlete takes off on one foot, lands on the same foot for the hop, springs onto the opposite foot for the step, and leaps into the sand for the jump. Success demands extreme lower-body strength, rhythm, and body control to maintain horizontal velocity across all three impacts.",
        note: "Spikes recommended.",
    },
    "Shot Put": {
        description:
            "A strength and power event where athletes `put` (push) a heavy metal sphere—7.26 kg for men, 4 kg for women—held tightly against the neck rather than throwing it overhead. Executed inside a 2.135-meter circle using either a linear `glide` or rotational `spin`` technique, the event converts explosive leg and core power into maximal thrust without stepping outside the ring or toe board.",
        note: "Technique matters more than raw strength.",
    },
    Discus: {
        description:
            "A rotational throwing discipline where athletes sling a heavy smooth-edged disc—2 kg for men, 1 kg for women—from inside a 2.5-meter throwing circle. The thrower completes one and a half rapid spins across the ring to generate maximum angular momentum and rotational torque before releasing the disc, using aerodynamic lift to maximize distance across the field sector.",
        note: "Bring your own discus if allowed.",
    },
    Javelin: {
        description:
            "The only throwing event featuring a straight runway approach, requiring athletes to sprint forward carrying a spear-like javelin. Near the foul arc, the thrower abruptly braces their lead leg to transfer linear momentum into explosive upper-body rotation, throwing the javelin overhand so its metal point strikes the ground first inside the designated sector.",
        note: "Proper footwear and grip required.",
    },

    "On the Spot Poster Making": {
        description:
            "A timed visual arts competition where participants create a creative, thematic poster entirely from scratch within a strict window, responding to an unrevealed prompt or theme given at the start of the event. Success relies on combining striking graphic design, clean typography, persuasive symbolism, and eye-catching visual communication to deliver an impactful message.",
        note: "Bring your own materials. Paper provided.",
    },
    "Pencil Drawing": {
        description:
            "A fine arts discipline utilizing graphite pencils of varying hardness (from delicate light 9H grades to rich dark 9B grades) to render detailed subjects on paper. Artists focus on linework, hatching, cross-hatching, and subtle tonal gradations to capture light, shadow, texture, and depth without color.",
        note: "Bring your own pencils and eraser.",
    },
    "Charcoal Rendering": {
        description:
            "A dramatic drawing technique utilizing compressed or vine charcoal to produce deep, velvety blacks, striking contrasts, and expressive shadows. Because charcoal smudges easily and allows for rapid blending or erasing, artists use it to build bold compositions, moody atmospheric lighting, and high-impact tonal depth.",
        note: "Bring your own charcoal and smudge tools.",
    },
    Painting: {
        description:
            "A traditional fine arts medium where liquid color pigments—such as oil, acrylic, or watercolor—are applied to a canvas or paper support. Evaluation focuses on color harmony, brushwork technique, texture, composition, lighting control, and the artist's ability to interpret a subject or emotion through color and form.",
        note: "Bring your own brushes and paints.",
    },

    "Pop Solo": {
        description:
            "A vocal performance category where a single singer delivers a contemporary popular song. Evaluation centers on vocal mechanics—such as pitch accuracy, tone quality, breath control, and vocal range—alongside stage presence, emotional delivery, and commercial appeal.",
        note: "Submit your minus-one track in advance.",
    },
    "Vocal Duet": {
        description:
            "A musical discipline featuring two vocalists performing together, blending a primary melody line with supporting harmonic parts. Beyond individual vocal skill, success relies on voice blending, dynamic balance, timing synchronization, and performance chemistry between the two singers.",
        note: "Coordinate costumes with your partner.",
    },
    "Vocal Solo Kundiman": {
        description:
            "A classical vocal discipline dedicated to traditional Filipino art songs characterized by smooth, flowing, and melancholic melodies in 3/4 time. Performed by a single vocalist, this genre demands formal vocal control, fluid legato phrasing, and deep emotional resonance to convey themes of romantic longing, heartbreak, or patriotic devotion.",
        note: "Live piano accompaniment provided.",
    },
    "Song Writing": {
        description:
            "A creative musical competition where a composer or lyricist crafts an original song from scratch, establishing the melody, lyrics, and harmonic progression. Entries are evaluated on lyrical artistry, melodic memorability, structural balance, originality, and thematic resonance.",
        note: "Original work only — no covers.",
    },
    Piano: {
        description:
            "An instrumental performance category focused on executing a musical piece on the piano without vocal accompaniment. Judges score performers on technical mastery—including finger dexterity, touch, and pedal control—as well as dynamic range, rhythmic precision, and artistic interpretation of classical or modern piano literature.",
        note: "Submit sheet music in advance.",
    },

    Declamation: {
        description:
            "A dramatic public speaking discipline where a performer delivers a pre-written, highly emotional monologue or famous speech from memory. Rather than generating original content, the speaker focuses on vocal modulation, facial expressions, body language, and dramatic interpretation to convey the author's original passion and message.",
        note: "Memorize your piece — no notes allowed.",
    },
    "Extemporaneous Speaking": {
        description:
            "A public speaking event where a contestant receives an undisclosed topic on the spot, gets a brief preparation period (typically 3 to 5 minutes), and delivers a structured speech without relying on a full script. It evaluates quick analytical thinking, logical argument organization, confidence, and conversational fluency under tight time constraints.",
        note: "You get 5 minutes prep time.",
    },
    "Essay Writing": {
        description:
            "An academic writing competition that tests an individual's ability to compose a coherent, original piece of prose based on a given prompt or theme within a set timeframe. Judges evaluate the entry on thesis clarity, logical organization, depth of argument, vocabulary, and grammatical precision.",
        note: "Bring your own pen. Paper provided.",
    },
    "Short and Sweet Play Dialog": {
        description:
            "A condensed theatrical performance featuring a brief, fast-paced script executed by a small cast (usually within 3 to 10 minutes). Success relies on sharp character interactions, brisk pacing, strong stage presence, and delivering a complete narrative arc—whether comedic or dramatic—in a very limited timeframe.",
        note: "Rehearse blocking and props.",
    },
    "Pangdalawahang Pag-arte": {
        description:
            "A theatrical discipline where two performers present a dramatic or comedic scene together. The event emphasizes partner chemistry, emotional synchronization, character dynamics, and fluid dialogue exchange, with actors working in tandem to build tension or humor—frequently using minimal props or sets to keep the spotlight strictly on their acting caliber.",
        note: "Costumes encouraged.",
    },

    "Mass Dance": {
        description:
            "A large-scale, synchronized performance involving many dancers executing identical or complementary choreography simultaneously. Common in school exhibitions, sports opening ceremonies, and cultural festivals, mass dance emphasizes spatial formations, unison, visual patterns, and community spirit rather than individual virtuosity.",
        note: "Choreography must be original or credited. Propsmen allowed but exclusive only for male participants.",
    },
    "Folk Dance": {
        description:
            "A traditional dance form originating from the heritage, customs, and daily life of a specific culture or region. Passed down through generations, folk dances often depict local rituals, occupational tasks, courtship, or historical events, performed in authentic regional attire to traditional music and rhythms.",
        note: "Traditional costumes required.",
    },
    "Pop Dance": {
        description:
            "A dynamic, commercial style of dance tailored to contemporary popular music and youth culture. Drawing elements from hip-hop, jazz, commercial street styles, and modern choreography, pop dance focuses on sharp musicality, catchy signature movements, energy, and stage presence, frequently seen in music videos, concerts, and social media trends.",
        note: "Submit your music in advance.",
    },
    "Dance Sports": {
        description:
            "A highly structured, competitive form of ballroom dancing that combines artistic expression with athletic rigor. It is split into two primary disciplines: International Standard (e.g., Waltz, Tango, Quickstep), which focuses on smooth, continuous movement in a closed frame, and International Latin (e.g., Cha-Cha, Samba, Rumba), which features rhythmic hip action and expressive partner interaction. Judges score couples on technique, musicality, posture, and floor craft.",
        note: "Costumes required. Pairs only.",
    },
};

const GROUP_FALLBACKS = {
    Sports: "Competitive team or individual sport. Standard intramurals rules apply.",
    Athletics: "",
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
            details.note || "Arrive 30 minutes before your scheduled match.";
        modalRegisterBtn.href = `${REGISTER_URL}?sport=${encodeURIComponent(
            sport.name
        )}`;

        const slug = sport.name
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, "-")
            .replace(/^-|-$/g, "");
        const imgPath = `/assets/sports/${slug}.jpg`;

        modalImage.src = imgPath;
        modalImage.alt = sport.name;
        modalImageWrapper.classList.remove("hidden");

        // Hide the wrapper if the image fails to load
        modalImage.onerror = () => {
            modalImageWrapper.classList.add("hidden");
        };
        modalImage.onload = () => {
            modalImageWrapper.classList.remove("hidden");
        };
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
            // Reset image
            modalImage.src = "";
            modalImageWrapper.classList.add("hidden");
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
