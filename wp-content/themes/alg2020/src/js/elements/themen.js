changeSlide = function () {
  let currentSlide = document.querySelector(
    ".alg-thema-slide-wrapper.alg-thema-slide-active"
  );
  let currentSlideNumber = parseInt(currentSlide.getAttribute("data-slide-id"));
  let nextSlideNumber = currentSlideNumber + 1;
  if (
    !document.querySelector(
      ".alg-thema-slide-wrapper[data-slide-id='" + nextSlideNumber + "']"
    )
  ) {
    nextSlideNumber = 0;
  }
  let nextSlide = document.querySelector(
    ".alg-thema-slide-wrapper[data-slide-id='" + nextSlideNumber + "']"
  );
  let currentPage = document.querySelector(
    ".alg-thema-page.alg-thema-page-active"
  );
  let nextPage = document.querySelector(
    ".alg-thema-page[data-slide-id='" + nextSlideNumber + "']"
  );

  currentSlide.style.opacity = "0";
  currentSlide.style.visibility = "hidden";
  currentPage.classList.remove("alg-thema-page-active");
  setTimeout(() => {
    currentSlide.style.display = "none";
    nextSlide.style.display = "flex";
  }, 500);
  setTimeout(() => {
    currentSlide.classList.remove("alg-thema-slide-active");
    currentSlide.style = "";
    nextSlide.classList.add("alg-thema-slide-active");
    nextPage.classList.add("alg-thema-page-active");
  }, 600);
};

if (document.querySelectorAll(".alg-themen-slider-outer").length > 0) {
  const SliderInterval = setInterval(() => {
    changeSlide();
  }, 9000);
}
