if (document.querySelector(".alg-navbar-wrapper")) {
  const NavbarWrapper = document.querySelector(".alg-navbar-wrapper");
  window.addEventListener("scroll", function () {
    if (window.scrollY < 0) {
      console.log("Fuck you Safari");
      return;
    }
    if (window.scrollY > this.oldScroll && window.scrollY > 80) {
      NavbarWrapper.classList.add("alg-navbar-hide");
    } else {
      NavbarWrapper.classList.remove("alg-navbar-hide");
    }
    this.oldScroll = window.scrollY;
  });
}
