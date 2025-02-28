document.querySelectorAll(".sponsor__button").forEach(button => {
    // Récupérer l'état de l'attribut data-active et appliquer les classes
    const isActive = button.getAttribute("data-active") === "1";
    const listItem = button.closest(".sponsor__container");
    const img = listItem.querySelector(".sponsor__logo");

    if (isActive) {
        button.classList.remove("sponsor__button--inactive");
        img.classList.remove("sponsor__logo--inactive");
    } else {
        button.classList.add("sponsor__button--inactive");
        img.classList.add("sponsor__logo--inactive");
    }

    // Ajouter l'écouteur de clic
    button.addEventListener("click", async function () {
        const sponsorId = this.getAttribute("data-sponsor-id");
        const isActive = this.getAttribute("data-active") === "1"; // Vérifie si actif ou pas
        const newStatus = isActive ? 0 : 1; // Inverse l'état
        const listItem = this.closest(".sponsor__container");
        const img = listItem.querySelector(".sponsor__logo");

        // Préparer les données à envoyer
        const data = { id_sponsor: sponsorId, is_active: newStatus };
        console.log(data)
        try {
            const response = await fetch("../api.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();
            console.log("Réponse serveur :", result);

            if (result.success) {
                // Mettre à jour l'état local du bouton
                this.setAttribute("data-active", newStatus);
                this.classList.toggle("sponsor__button--inactive", newStatus === 0);
                img.classList.toggle("sponsor__logo--inactive", newStatus === 0);
            }
        } catch (error) {
            console.error("Erreur AJAX :", error);
        }
    });
});
