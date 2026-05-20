document.addEventListener("DOMContentLoaded", () => {
  const burger = document.querySelector(".burger");
  const mobileMenu = document.querySelector(".mobile-menu");
  const container = document.getElementById("cats-container");
  const form = document.querySelector(".main-form");
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (burger && mobileMenu) {
    burger.addEventListener("click", () => {
      burger.classList.toggle("active");
      mobileMenu.classList.toggle("active");
    });
  }

  if (container && Array.isArray(cats)) {
    cats.forEach((cat) => {
      const card = document.createElement("div");
      card.classList.add("card");

      card.innerHTML = `
        <img src="${cat.image}" alt="${cat.title}">
        <h3>${cat.title}</h3>
        <p>${cat.text}</p>
      `;

      container.appendChild(card);
    });
  }

  const slides = Array.from(document.querySelectorAll(".slide"));
  const dotsContainer = document.querySelector("[data-dots]");
  const prevBtn = document.querySelector("[data-prev]");
  const nextBtn = document.querySelector("[data-next]");
  let currentSlide = 0;
  let sliderTimer = null;

  function showSlide(index) {
    if (!slides.length) {
      return;
    }

    currentSlide = (index + slides.length) % slides.length;

    slides.forEach((slide, slideIndex) => {
      slide.classList.toggle("active", slideIndex === currentSlide);
    });

    document.querySelectorAll(".slider-dot").forEach((dot, dotIndex) => {
      dot.classList.toggle("active", dotIndex === currentSlide);
    });
  }

  function startSlider() {
    if (sliderTimer) {
      clearInterval(sliderTimer);
    }

    sliderTimer = setInterval(() => showSlide(currentSlide + 1), 3000);
  }

  if (slides.length && dotsContainer) {
    slides.forEach((_, index) => {
      const dot = document.createElement("button");
      dot.className = "slider-dot";
      dot.type = "button";
      dot.setAttribute("aria-label", `Слайд ${index + 1}`);
      dot.addEventListener("click", () => {
        showSlide(index);
        startSlider();
      });
      dotsContainer.appendChild(dot);
    });

    prevBtn.addEventListener("click", () => {
      showSlide(currentSlide - 1);
      startSlider();
    });

    nextBtn.addEventListener("click", () => {
      showSlide(currentSlide + 1);
      startSlider();
    });

    showSlide(0);
    startSlider();
  }

  if (form) {
    form.addEventListener("submit", async (event) => {
      event.preventDefault();

      let isValid = true;
      const fields = ["name", "email", "budget", "subject", "message"];

      fields.forEach((field) => {
        const input = document.getElementById(field);
        input.classList.remove("error");

        if (!input.value.trim()) {
          input.classList.add("error");
          isValid = false;
        }
      });

      const emailField = form.querySelector("#email");

      if (emailField && !emailPattern.test(emailField.value.trim())) {
        emailField.classList.add("error");
        isValid = false;
      }

      if (!isValid) {
        alert("Заповніть обов'язкові поля та перевірте email.");
        return;
      }

      const formData = {
        name: document.getElementById("name").value.trim(),
        email: document.getElementById("email").value.trim(),
        location: document.getElementById("location").value.trim(),
        budget: document.getElementById("budget").value.trim(),
        subject: document.getElementById("subject").value.trim(),
        message: document.getElementById("message").value.trim()
      };

      try {
        const response = await fetch("subscriptions.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
          body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (data.success) {
          form.reset();
          alert(data.message || "Дякуємо за підписку!");
        } else {
          alert(data.message || "Сталася помилка.");
        }
      } catch (error) {
        alert("Сталася помилка під час відправки форми.");
      }
    });
  }
});
