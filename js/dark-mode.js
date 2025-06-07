// Saat halaman dimuat, cek localStorage dan terapkan dark mode jika perlu
document.addEventListener("DOMContentLoaded", function () {
  const isDarkStored = localStorage.getItem("darkMode") === "enabled";
  const body = document.body;
  const toggleBtn = document.getElementById("toggleMode");

  if (isDarkStored) {
    body.classList.add("dark-mode");
  }

  // Set icon dan label sesuai mode yang aktif
  const isDark = body.classList.contains("dark-mode");
  const iconPath = isDark
    ? "icons/brightness-high-fill.svg"
    : "icons/moon-fill.svg";
  toggleBtn.innerHTML = `<img src="${iconPath}" alt="" id="modeIcon"> ${
    isDark ? "Light Mode" : "Dark Mode"
  }`;
});

// Saat tombol diklik, toggle dark mode dan simpan status ke localStorage
document.getElementById("toggleMode").addEventListener("click", function () {
  document.body.classList.toggle("dark-mode");

  const isDark = document.body.classList.contains("dark-mode");
  const iconPath = isDark
    ? "icons/brightness-high-fill.svg"
    : "icons/moon-fill.svg";

  // Update isi tombol
  this.innerHTML = `<img src="${iconPath}" alt="" id="modeIcon"> ${
    isDark ? "Light Mode" : "Dark Mode"
  }`;

  // Simpan status dark mode
  localStorage.setItem("darkMode", isDark ? "enabled" : "disabled");
});
