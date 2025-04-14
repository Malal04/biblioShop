// $(document).ready(function () {
//     let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
//     const token = $('meta[name="csrf-token"]').attr('content');
//     const urlCommande = $('meta[name="commande-passer-url"]').attr('content');

//     renderCartFromLocalStorage();
//     updateCartCount();
//     updateTotal();

//     $('#cart-container').removeClass('open');
//     $('#cart-count').toggle(cartItems.length > 0);

//     $('#show-cart').on('click', function (e) {
//         e.preventDefault();
//         $('#cart-container').toggleClass('open');
//     });

//     $('#close-cart').on('click', function () {
//         $('#cart-container').removeClass('open');
//     });

//     // Ajouter au panier
//     $('.section_livres_item_button').on('click', function () {
//         const livre = $(this).closest('.section_livres_item');
//         const titre = livre.find('h3').text().trim();
//         const prix = parseFloat(livre.find('.prix').text().replace(/[^\d,.-]/g, '').replace(',', '.'));
//         const id = $(this).data('id');
//         const quantite = parseInt(livre.find('.quantite-input').val()) || 1;
//         const stock = parseInt(livre.find('.quantite-input').attr('max')) || 1;

//         if (quantite <= 0 || isNaN(quantite)) {
//             Swal.fire('Erreur', 'Veuillez entrer une quantité valide.', 'error');
//             return;
//         }

//         if (quantite > stock) {
//             Swal.fire('Stock insuffisant', 'Quantité demandée supérieure au stock disponible.', 'warning');
//             return;
//         }

//         const existingIndex = cartItems.findIndex(item => item.id === id);
//         if (existingIndex !== -1) {
//             const existing = cartItems[existingIndex];
//             const newQuantite = existing.quantite + quantite;

//             if (newQuantite > stock) {
//                 Swal.fire('Stock insuffisant', 'Stock insuffisant pour cette quantité.', 'warning');
//                 return;
//             }

//             cartItems[existingIndex].quantite = newQuantite;
//             cartItems[existingIndex].prix = prix * newQuantite;
//         } else {
//             cartItems.push({
//                 id,
//                 titre,
//                 quantite,
//                 prix: prix * quantite
//             });
//         }

//         localStorage.setItem('cart', JSON.stringify(cartItems));
//         renderCartFromLocalStorage();
//         updateCartCount();
//         updateTotal();
//     });

//     // Supprimer un item avec SweetAlert
//     $(document).on('click', '.remove-item', function () {
//         const id = $(this).closest('li').data('id');

//         Swal.fire({
//             title: 'Supprimer ?',
//             text: "Cet article sera retiré du panier.",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonText: 'Oui, supprimer',
//             cancelButtonText: 'Annuler'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 cartItems = cartItems.filter(item => item.id !== id);
//                 localStorage.setItem('cart', JSON.stringify(cartItems));
//                 renderCartFromLocalStorage();
//                 updateCartCount();
//                 updateTotal();
//             }
//         });
//     });

//     // Commander avec SweetAlert
//     $('#commander-btn').click(function () {
//         if (cartItems.length === 0) {
//             Swal.fire('Panier vide', 'Ajoutez des articles avant de commander.', 'warning');
//             return;
//         }

//         Swal.fire({
//             title: 'Valider la commande ?',
//             text: "Voulez-vous envoyer votre commande ?",
//             icon: 'question',
//             showCancelButton: true,
//             confirmButtonText: 'Oui, commander',
//             cancelButtonText: 'Annuler',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: urlCommande,
//                     type: "POST",
//                     data: {
//                         livres: cartItems,
//                         _token: token
//                     },
//                     success: function (response) {
//                         Swal.fire('Commande envoyée !', response.message, 'success');
//                         cartItems = [];
//                         localStorage.removeItem('cart');
//                         renderCartFromLocalStorage();
//                         updateCartCount();
//                         updateTotal();
//                         $('#cart-container').removeClass('open');
//                     },
//                     error: function (xhr) {
//                         Swal.fire('Erreur', xhr.responseJSON?.message || 'Une erreur est survenue.', 'error');
//                     }
//                 });
//             }
//         });
//     });

//     // Helpers
//     function renderCartFromLocalStorage() {
//         $('#cart-list').empty();
//         cartItems.forEach(item => {
//             $('#cart-list').append(`
//                 <li class="cart-item" data-id="${item.id}">
//                     <span>${item.titre}</span>
//                     <span class="item-quantite">(x${item.quantite})</span>
//                     <span class="item-prix">${item.prix.toFixed(2)} fcfa</span>
//                     <button class="remove-item">X</button>
//                 </li>
//             `);
//         });
//     }

//     function updateTotal() {
//         let total = 0;
//         cartItems.forEach(item => {
//             total += item.prix;
//         });
//         $('#cart-total').html(`<strong>Total :</strong> ${total.toFixed(2)} fcfa`);
//     }

//     function updateCartCount() {
//         if (cartItems.length > 0) {
//             $('#cart-count').text(cartItems.length).show();
//         } else {
//             $('#cart-count').hide();
//         }
//     }
// });



$(document).ready(function () {
    let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const token = $('meta[name="csrf-token"]').attr('content');
    const urlCommande = $('meta[name="commande-passer-url"]').attr('content');

    sanitizeCart(); // Nettoyage au démarrage
    renderCartFromLocalStorage();
    updateCartCount();
    updateTotal();

    $('#cart-container').removeClass('open');
    $('#cart-count').toggle(cartItems.length > 0);

    $('#show-cart').on('click', function (e) {
        e.preventDefault();
        $('#cart-container').toggleClass('open');
    });

    $('#close-cart').on('click', function () {
        $('#cart-container').removeClass('open');
    });

    // Ajouter au panier
    $('.section_livres_item_button').on('click', function () {
        const livre = $(this).closest('.section_livres_item');
        const titre = livre.find('h3').text().trim();
        const prix = parseFloat(livre.find('.prix').text().replace(/[^\d,.-]/g, '').replace(',', '.'));
        const id = $(this).data('id');
        const quantite = parseInt(livre.find('.quantite-input').val()) || 1;
        const stock = parseInt(livre.find('.quantite-input').attr('max')) || 1;

        if (quantite <= 0 || isNaN(quantite)) {
            Swal.fire('Erreur', 'Veuillez entrer une quantité valide.', 'error');
            return;
        }

        if (quantite > stock) {
            Swal.fire('Stock insuffisant', 'Quantité demandée supérieure au stock disponible.', 'warning');
            return;
        }

        const existingIndex = cartItems.findIndex(item => item.id === id);
        if (existingIndex !== -1) {
            const existing = cartItems[existingIndex];
            const newQuantite = existing.quantite + quantite;

            if (newQuantite > stock) {
                Swal.fire('Stock insuffisant', 'Stock insuffisant pour cette quantité.', 'warning');
                return;
            }

            cartItems[existingIndex].quantite = newQuantite;
            cartItems[existingIndex].prix = prix * newQuantite;
        } else {
            cartItems.push({
                id,
                titre,
                quantite,
                prix: prix * quantite
            });
        }

        saveCart();
        renderCartFromLocalStorage();
        updateCartCount();
        updateTotal();
    });

    // Supprimer un item avec SweetAlert
    $(document).on('click', '.remove-item', function () {
        const id = $(this).closest('li').data('id');

        Swal.fire({
            title: 'Supprimer ?',
            text: "Cet article sera retiré du panier.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                cartItems = cartItems.filter(item => item.id !== id);
                saveCart();
                renderCartFromLocalStorage();
                updateCartCount();
                updateTotal();
            }
        });
    });

    // Commander avec SweetAlert
    $('#commander-btn').click(function () {
        if (cartItems.length === 0) {
            Swal.fire('Panier vide', 'Ajoutez des articles avant de commander.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Valider la commande ?',
            text: "Voulez-vous envoyer votre commande ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, commander',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlCommande,
                    type: "POST",
                    data: {
                        livres: cartItems,
                        _token: token
                    },
                    success: function (response) {
                        Swal.fire('Commande envoyée !', response.message, 'success');
                        cartItems = [];
                        localStorage.removeItem('cart');
                        renderCartFromLocalStorage();
                        updateCartCount();
                        updateTotal();
                        $('#cart-container').removeClass('open');
                    },
                    error: function (xhr) {
                        Swal.fire('Erreur', xhr.responseJSON?.message || 'Une erreur est survenue.', 'error');
                    }
                });
            }
        });
    });

    // 🔧 Helpers
    function renderCartFromLocalStorage() {
        $('#cart-list').empty();
        cartItems.forEach(item => {
            const prixAffiche = (typeof item.prix === 'number' && !isNaN(item.prix))
                ? item.prix.toFixed(2)
                : 'N/A';

            $('#cart-list').append(`
                <li class="cart-item" data-id="${item.id}">
                    <span>${item.titre}</span>
                    <span class="item-quantite">(x${item.quantite})</span>
                    <span class="item-prix">${prixAffiche} fcfa</span>
                    <button class="remove-item">X</button>
                </li>
            `);
        });
    }

    function updateTotal() {
        let total = 0;
        cartItems.forEach(item => {
            if (typeof item.prix === 'number' && !isNaN(item.prix)) {
                total += item.prix;
            }
        });
        $('#cart-total').html(`<strong>Total :</strong> ${total.toFixed(2)} fcfa`);
    }

    function updateCartCount() {
        if (cartItems.length > 0) {
            $('#cart-count').text(cartItems.length).show();
        } else {
            $('#cart-count').hide();
        }
    }

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cartItems));
    }

    function sanitizeCart() {
        cartItems = cartItems.filter(item =>
            item && typeof item.prix === 'number' && !isNaN(item.prix) && item.titre && item.id
        );
        saveCart();
    }
});
