if (document.querySelector(".alg-api-form")) {
  document.querySelectorAll(".alg-api-form").forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var formData = {};
      for (const pair of new FormData(form).entries()) {
        formData[pair[0]] = pair[1];
      }
      (async () => {
        const response = await fetch(
          `/api/v1/${form.getAttribute("data-interface")}/`,
          {
            method: "POST",
            body: JSON.stringify(formData),
            headers: {
              "Content-Type": "application/json",
            },
          }
        );
        const data = await response.json();
        console.log(data);
      })();
    });
  });
}
