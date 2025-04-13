$(document).ready(function () {
    $('.valider_commande').on('click', function () {
        const button = $(this);
        const commandeId = button.data('id');
        const validerCommandeUrl = $('meta[name="commande-valider-url"]').attr('content');
        const token = $('meta[name="csrf-token"]').attr('content');

        if (button.hasClass('disabled')) {
            Swal.fire({
                icon: 'info',
                title: 'Commande déjà payée',
                text: 'Cette commande a déjà été validée et payée.',
            });
            return;
        }

        Swal.fire({
            title: 'Valider cette commande ?',
            text: "Cela enregistrera le paiement et enverra la facture par email.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, valider',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: validerCommandeUrl,
                    method: 'POST',
                    data: {
                        _token: token,
                        commande_id: commandeId
                    },
                    success: function (response) {
                        Swal.fire(
                            'Succès',
                            response.message,
                            'success'
                        ).then(() => location.reload());
                    },
                    error: function (xhr) {
                        let message = xhr.responseJSON?.message || 'Une erreur est survenue.';
                        Swal.fire(
                            'Erreur',
                            message,
                            'error'
                        );
                    }
                });
            }
        });
    });
});

