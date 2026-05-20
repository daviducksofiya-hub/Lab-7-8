document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.querySelector(".signIn-form");

  if (!loginForm) {
    return;
  }

  const loginBtn = loginForm.querySelector(".loginBtn");
  const messageBox = document.createElement("p");
  messageBox.classList.add("error-message");
  loginForm.appendChild(messageBox);

  loginForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    messageBox.textContent = "";
    loginBtn.disabled = true;
    loginBtn.textContent = "Зачекайте...";

    const loginInput = loginForm.querySelector("input[name='login']");
    const passwordInput = loginForm.querySelector("input[name='password']");

    try {
      const response = await fetch("login_process.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        body: JSON.stringify({
          login: loginInput.value.trim(),
          password: passwordInput.value.trim()
        })
      });

      const data = await response.json();

      if (data.success) {
        window.location.href = "admin.php";
        return;
      }

      messageBox.textContent = data.message || "Не вдалося увійти.";
    } catch (error) {
      messageBox.textContent = "Сталася помилка під час входу.";
    } finally {
      loginBtn.disabled = false;
      loginBtn.textContent = "Увійти";
    }
  });
});
