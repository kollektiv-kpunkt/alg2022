if (document.querySelector(".alg-navbar-wrapper")) {
  const NavbarWrapper = document.querySelector(".alg-navbar-wrapper");
  window.addEventListener("scroll", function () {
    if (window.scrollY < 0) {
      console.log("Fuck you Safari");
      return;
    }
    if (NavbarWrapper.classList.contains("alg-mobilemenu-open")) {
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

if (document.querySelector("button.alg-menu-mobile-tofuburger")) {
  const Burger = document.querySelector("button.alg-menu-mobile-tofuburger");
  const Menu = document.querySelector(".alg-navbar-wrapper");
  Burger.addEventListener("click", function () {
    Menu.classList.toggle("alg-mobilemenu-open");
    document.getElementsByTagName("html")[0].classList.toggle("noscroll");
  });
}
