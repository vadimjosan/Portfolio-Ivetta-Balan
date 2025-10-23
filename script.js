// Filtrare pe linkuri de categorii (server sau client)
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.portfolio-categories a');
  const items = document.querySelectorAll('.gallery-item');

  if (!links.length) return;

  links.forEach(link => {
    link.addEventListener('click', e => {
      const key = link.dataset.filter;        // există => filtrare client-side
      if (!key) return;                       // nu există => lasă reload-ul ?category=ID

      e.preventDefault();                     // client-side only
      // active state
      links.forEach(l => l.classList.remove('active'));
      link.classList.add('active');

      if (!items.length) return;
      const all = key === 'all';
      items.forEach(el => {
        const cat = el.dataset.category || '';
        el.style.display = (all || cat === key) ? '' : 'none';
      });
    });
  });
});


// === LIGHT/DARK MODE TOGGLE ===
document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('theme-toggle');
  const currentTheme = localStorage.getItem('theme');

  if (currentTheme === 'light') {
    document.body.classList.add('light-mode');
    toggle.textContent = '☀️';
  }

  toggle?.addEventListener('click', () => {
    document.body.classList.toggle('light-mode');
    const isLight = document.body.classList.contains('light-mode');
    toggle.textContent = isLight ? '☀️' : '🌙';
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
  });
});


// === NAV MOBILE TOGGLE ===
document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-links');
  const navItems = document.querySelectorAll('.nav-links a');

  if (!menuToggle || !navLinks) return;

  // Toggle deschidere / închidere meniu
  menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');

    // Animație pentru linkuri
    navItems.forEach((link, index) => {
      setTimeout(() => link.classList.toggle('animated'), index * 60);
    });
  });

  // Închide meniul când se apasă pe un link
  navItems.forEach(link => {
    link.addEventListener('click', () => navLinks.classList.remove('open'));
  });
});


// === GALLERY LIGHTBOX ===
document.addEventListener("DOMContentLoaded", () => {
  const galleryItems = document.querySelectorAll(".gallery-item img");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxDate = document.getElementById("lightbox-date");
  const lightboxDesc = document.getElementById("lightbox-desc");

  if (!galleryItems.length) return;

  galleryItems.forEach(img => {
    img.addEventListener("click", () => {
      const src = img.getAttribute("src");
      const date = img.dataset.date || "2025.05.04";
      const desc = img.dataset.desc || "This work brought the artist her first audience.";
      lightboxImg.src = src;
      lightboxDate.textContent = date;
      lightboxDesc.textContent = desc;
      lightbox.classList.remove("hidden");
    });
  });

  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox || e.target === lightboxImg || e.target === document.querySelector(".lightbox::after")) {
      lightbox.classList.add("hidden");
    }
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const galleryItems = document.querySelectorAll(".gallery-item img");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxDate = document.getElementById("lightbox-date");
  const lightboxDesc = document.getElementById("lightbox-desc");
  const btnPrev = document.querySelector(".lightbox-prev");
  const btnNext = document.querySelector(".lightbox-next");

  if (!galleryItems.length) return;

  let currentIndex = 0;

  function showImage(index) {
    const img = galleryItems[index];
    if (!img) return;
    const src = img.getAttribute("src");
    const date = img.dataset.date || "2025.05.04";
    const desc = img.dataset.desc || "Artwork description not available.";
    lightboxImg.src = src;
    lightboxDate.textContent = date;
    lightboxDesc.textContent = desc;
    lightbox.classList.remove("hidden");
  }

  galleryItems.forEach((img, index) => {
    img.addEventListener("click", () => {
      currentIndex = index;
      showImage(currentIndex);
    });
  });

  // 🔹 Navigare stânga / dreapta
  btnPrev?.addEventListener("click", (e) => {
    e.stopPropagation();
    currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
    showImage(currentIndex);
  });

  btnNext?.addEventListener("click", (e) => {
    e.stopPropagation();
    currentIndex = (currentIndex + 1) % galleryItems.length;
    showImage(currentIndex);
  });

  // 🔹 Închidere la click în afara imaginii sau pe ESC
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) lightbox.classList.add("hidden");
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") lightbox.classList.add("hidden");
    if (e.key === "ArrowLeft") btnPrev?.click();
    if (e.key === "ArrowRight") btnNext?.click();
  });
});
