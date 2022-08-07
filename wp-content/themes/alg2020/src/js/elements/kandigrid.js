function toggleKandiOn(id) {
  var kandiWrapper = document.querySelector(
    `.kandi-wrapper[data-kandi='${id}']`
  );
  kandiWrapper.parentElement.classList.add("kandi-open");
  history.pushState({}, null, "/kandi/" + kandiWrapper.id);
  kandiWrapper.classList.add("kandi-active");
  var kandiDetails = kandiWrapper.querySelector(".kandi-details-wrapper");
  var kandiDetailsArrow = kandiWrapper.querySelector(".kandi-details-arrow");
  var detailsOuter = kandiDetails.querySelector(".kandi-details-outer");
  var detailsInner = kandiDetails.querySelector(".kandi-details-inner");
  var detailsPlaceholder = kandiWrapper.querySelector(
    ".kandi-details-placeholder"
  );

  kandiDetails.style.maxHeight = `${kandiDetailsArrow.offsetHeight}px`;
  detailsPlaceholder.style.maxHeight = `${detailsInner.offsetHeight}px`;
  detailsPlaceholder.style.height = `${detailsInner.offsetHeight}px`;
  setTimeout(() => {
    detailsOuter.style.maxHeight = `${detailsInner.offsetHeight}px`;
  }, 250);

  setTimeout(() => {
    var kandiRect = kandiWrapper.getBoundingClientRect();
    window.scrollTo({
      top:
        kandiRect.y +
        window.scrollY -
        (document.querySelector(".alg-navbar-wrapper").offsetHeight + 18),
      behavior: "smooth",
    });
  }, 500);
}

function toggleKandiOff(id) {
  var kandiWrapper = document.querySelector(
    `.kandi-wrapper[data-kandi='${id}']`
  );
  kandiWrapper.parentElement.classList.remove("kandi-open");
  kandiWrapper.classList.remove("kandi-active");
  var kandiDetails = kandiWrapper.querySelector(".kandi-details-wrapper");
  var detailsOuter = kandiDetails.querySelector(".kandi-details-outer");
  var detailsPlaceholder = kandiWrapper.querySelector(
    ".kandi-details-placeholder"
  );
  detailsOuter.style.maxHeight = `0`;
  setTimeout(() => {
    kandiDetails.style.maxHeight = `0`;
    detailsPlaceholder.style.maxHeight = `0`;
  }, 250);
}

if (document.querySelector(".alg-gemeinde-kandi-grid")) {
  document.querySelectorAll(".kandi-inner").forEach(function (element) {
    element.addEventListener("click", function () {
      if (element.parentElement.classList.contains("kandi-active")) {
        toggleKandiOff(element.getAttribute("data-kandi"));
        if (
          document.querySelector(".alg-gemeinde-intro-wrapper[data-gemeinde]")
        ) {
          var gemeinde = document
            .querySelector(".alg-gemeinde-intro-wrapper")
            .getAttribute("data-gemeinde");
          history.pushState({}, null, "/gemeinde/" + gemeinde);
        }
        return;
      }
      if (document.querySelector(".kandi-wrapper.kandi-active")) {
        toggleKandiOff(
          document
            .querySelector(".kandi-wrapper.kandi-active")
            .getAttribute("data-kandi")
        );
      }
      var kandi = element.getAttribute("data-kandi");
      toggleKandiOn(kandi);
    });
  });
}

window.addEventListener("DOMContentLoaded", function () {
  if (
    document.querySelector(".alg-gemeinde-kandi-grid") &&
    window.location.href.includes("?#kandi")
  ) {
    const slug = window.location.href.split("?#kandi=")[1];
    const kandi = document.getElementById(slug).getAttribute("data-kandi");
    toggleKandiOn(kandi);
  }
});
