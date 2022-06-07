import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";
import "tippy.js/animations/perspective.css";
import * as WK from "../data/wahlkreise.json";

if (document.querySelector(".alg-map-inner")) {
  let wahlkreise = document.querySelectorAll("path.alg-wahlkreis");
  wahlkreise.forEach((wahlkreis) => {
    tippy(wahlkreis, {
      content: WK[wahlkreis.id].name,
      animation: "perspective",
    });
    wahlkreis.addEventListener("click", () => {
      window.location.href = `/gemeinde/${wahlkreis.id}`;
    });
  });
}
