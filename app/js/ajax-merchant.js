function confirmDeleteMerchant(button) {
    // Demander confirmation
    const isConfirmed = confirm("Êtes-vous sûr de vouloir supprimer l'exposant ? Cette action est IRREVERSIBLE.");

    if (isConfirmed) {
        // Si l'utilisateur confirme, on récupère l'ID du marchand
        const merchantId = button.getAttribute("data-merchant-id");

        // Envoi de la requête AJAX pour supprimer le marchand
        const data = { id_merchant: merchantId };

        fetch("api.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            // Vérification du statut HTTP
            console.log(response); // Affiche la réponse HTTP dans la console
            if (!response.ok) {
                throw new Error('Erreur de réponse HTTP: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            console.log(result); // Affiche le résultat du serveur
            if (result.success) {
                // Si la suppression est réussie, on peut faire quelque chose (par exemple, supprimer l'élément du DOM)
                alert("Exposant supprimé avec succès.");
                button.closest("li").remove(); // Enlève le li contenant le bouton
            } else {
                // Si la suppression échoue
                alert("Erreur lors de la suppression de l'exposant.");
            }
        })
        .catch(error => {
            console.error("Erreur AJAX :", error);
            location.reload();
        });
    } else {
        // Si l'utilisateur annule, rien ne se passe
        console.log("Suppression annulée");
    }
}