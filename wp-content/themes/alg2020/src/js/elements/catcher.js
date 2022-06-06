import Cookies from "js-cookie";

if (document.querySelector(".alg-catcher-wrapper")) {
  document
    .querySelector(".alg-catcher-close")
    .addEventListener("click", function () {
      document.querySelector(".alg-catcher-wrapper").style = "max-height: 0px";
      Cookies.set("alg-catcher-closed", "true", {
        expires: 2,
      });
    });
}
