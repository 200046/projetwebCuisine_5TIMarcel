// Toggle password visibility
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.parentElement.querySelector('input');
        if (input.type === "password") {
            input.type = "text";
            button.textContent = "🙈";
        } else {
            input.type = "password";
            button.textContent = "👁️";
        }
    });
});

// Active nav link
document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".navbar a");
    const currentPage = window.location.pathname;

    links.forEach(link => {
        if (link.getAttribute("href") === currentPage.replace("/", "")) {
            link.classList.add("active");
        }
    });
});

// Form validation
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const email = document.querySelector("#email");
    const login = document.querySelector("#login");
    const password = document.querySelector("#mot_de_passe") ?? document.querySelector("input[name='mot_de_passe']");
    const errorBox = document.querySelector("#formError");

    form.addEventListener("submit", (e) => {
        let errors = [];

        // Email valide (si champ présent)
        if (email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                errors.push("Email invalide ❌");
            }
        }

        // Login obligatoire et sans @
        if (login.value.trim().length < 3) {
            errors.push("Le login doit contenir au moins 3 caractères ❌");
        }
        if (login.value.includes("@")) {
            errors.push("Le login ne doit pas être une adresse email ❌");
        }

        // Mot de passe obligatoire
        if (password) {
            if (password.value.trim().length < 6) {
                errors.push("Le mot de passe doit contenir au moins 6 caractères ❌");
            }
        }

        if (errors.length > 0) {
            e.preventDefault();
            errorBox.style.display = "block";
            errorBox.innerHTML = errors.join("<br>");
        } else {
            errorBox.style.display = "none";
        }
    });
});