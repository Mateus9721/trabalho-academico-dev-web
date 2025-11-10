document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const email = document.getElementById("id_email");
  const cpf = document.getElementById("id_cpf");

  cpf.addEventListener("input", () => {
    let v = cpf.value.replace(/\D/g, "").slice(0, 11);
    v = v.replace(/(\d{3})(\d)/, "$1.$2")
         .replace(/(\d{3})(\d)/, "$1.$2")
         .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    cpf.value = v;
  });

  function mostrarErro(campo, msg) {
    const box = document.createElement("div");
    box.className = "popup-erro";
    box.textContent = msg;
    const pos = campo.getBoundingClientRect();
    box.style.top = `${pos.top + window.scrollY + 5}px`;
    box.style.left = `${pos.right + window.scrollX + 10}px`;
    document.body.appendChild(box);
    setTimeout(() => box.remove(), 3000);
  }

  form.addEventListener("submit", e => {
    let ok = true;
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const cpfLimpo = cpf.value.replace(/\D/g, "");

    if (!emailValido.test(email.value)) {
      mostrarErro(email, "Email inválido");
      ok = false;
    }

    if (cpfLimpo.length !== 11 || /^(\d)\1+$/.test(cpfLimpo)) {
      mostrarErro(cpf, "CPF inválido");
      ok = false;
    }

    if (!ok) e.preventDefault();
  });
});
