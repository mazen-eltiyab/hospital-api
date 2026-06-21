const menuToggle = document.getElementById("mobile-menu");
const navMenu = document.getElementById("nav-menu");

menuToggle.addEventListener("click", () => {
  navMenu.classList.toggle("active");
  menuToggle.classList.toggle("is-active");

  // لمنع التمرير عند فتح القائمة
  if (navMenu.classList.contains("active")) {
    document.body.style.overflow = "hidden";
  } else {
    document.body.style.overflow = "auto";
  }
});

// إغلاق القائمة عند الضغط على أي رابط
document.querySelectorAll(".nav-links a").forEach((link) => {
  link.addEventListener("click", () => {
    navMenu.classList.remove("active");
    menuToggle.classList.remove("is-active");
    document.body.style.overflow = "auto";
  });
});

