if (document.querySelector(".alg-api-form")) {
  document.querySelectorAll(".alg-api-form").forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var formData = {};
      for (const pair of new FormData(form).entries()) {
        formData[pair[0]] = pair[1];
      }
      grecaptcha.ready(function () {
        grecaptcha
          .execute("6LdLtVohAAAAAMXB_7_q1C5JZbqSQAdzxPM7Q50-", {
            action: "support_alg2022",
          })
          .then(function (token) {
            (async () => {
              formData["token"] = token;
              formData["action"] = "support_alg2022";
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
              if (data.status == "success") {
                form.hidden = true;
              }
              form.nextElementSibling.innerText = data.message;
              form.nextElementSibling.hidden = false;
              console.log(data);
            })();
          });
      });
    });
  });
}
