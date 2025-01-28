const deprogrammerButtons = document.getElementById('unprogramBtn');

deprogrammerButtons.addEventListener('click', function () {
    // Récupérer l'ID du groupe et de l'événement
    const idBand = this.dataset.id;
    const idEvent = this.dataset.event;

    if (!idBand || !idEvent) {
        alert('Erreur : ID du groupe ou de l\'événement introuvable.');
        return;
    }

    // Confirmation avant la suppression
    if (!confirm('Voulez-vous vraiment déprogrammer ce groupe pour cet événement ?')) {
        return;
    }

    // Envoyer une requête avec fetch
    fetch('unprogram.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id_band=${encodeURIComponent(idBand)}&id_event=${encodeURIComponent(idEvent)}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Groupe déprogrammé avec succès');
                // Optionnel : supprimer l'élément de l'interface
                this.closest('.band__itm').remove();
            } else {
                alert(data.message || 'Erreur lors de la déprogrammation');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de la communication avec le serveur.');
        });
});

