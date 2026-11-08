class Cart {

    constructor() {
        this.lines = JSON.parse(sessionStorage.getItem('mon_panier')) || [];
        this.panierfunction();
    }

  

    // AJOUTER UN PRODUIT
    addProduits(id, label, price, image) {

        let produit = this.lines.find(element => element.id == id);

        if (produit) {

            produit.quantity += 1;

        } else {

            this.lines.push({
                id: id,
                label: label,
                price: Number(price),
                image: image,
                quantity: 1
            });

        }

        this.sauvegarderEtAfficher();
    }


    // DIMINUER LA QUANTITE
    removeProduits(id) {

        let indice = this.lines.findIndex(element => element.id == id);

        if (indice >= 0) {

            if (this.lines[indice].quantity <= 1) {

                this.lines.splice(indice, 1);

            } else {

                this.lines[indice].quantity -= 1;

            }

        }

        this.sauvegarderEtAfficher();
    }


    // CALCULER LE TOTAL
    calculerTotal() {

        let total = 0;

        this.lines.forEach(line => {

            total += Number(line.price) * Number(line.quantity);

        });

        return total;
    }


    // SAUVEGARDER LE PANIER
    sauvegarderEtAfficher() {

        sessionStorage.setItem(
            'mon_panier',
            JSON.stringify(this.lines)
        );

        this.panierfunction();
    }


    // AFFICHER LE PANIER
    panierfunction() {

        const panierContainer = document.querySelector('#liste-panier');
        const totalContainer = document.querySelector('#total-panier');
        const inputCommandes = document.querySelector('#ligneCommandes');

        if (!panierContainer) return;


        // PANIER VIDE
        if (this.lines.length === 0) {

            panierContainer.innerHTML = `
                <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
                    <p class="text-gray-500 font-medium">
                        Votre panier est vide
                    </p>
                </div>
            `;

            if (totalContainer) {
                totalContainer.innerText = "0 FCFA";
            }

            if (inputCommandes) {
                inputCommandes.value = "";
            }

            return;
        }


        panierContainer.innerHTML = "";

        // CALCUL DU TOTAL GENERAL
        let totalGeneral = this.calculerTotal();


        // AFFICHER CHAQUE PRODUIT
        this.lines.forEach(line => {

            const itemDiv = document.createElement('div');

            itemDiv.className =
                "bg-white rounded-2xl p-4 flex items-center justify-between border border-gray-100 shadow-sm";


            itemDiv.innerHTML = `

                <div class="flex items-center space-x-4">

                    <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center border border-gray-100">

                        <img
                            class="w-full h-full object-cover"
                        >

                    </div>

                    <div>

                        <h3 class="font-bold text-base text-gray-900">
                            ${line.label}
                        </h3>

                        <p class="text-lg font-extrabold text-[#2F44DE] mt-2">
                            ${(Number(line.price) * Number(line.quantity)).toLocaleString('fr-FR')} FCFA
                        </p>


                    </div>

                </div>


                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-2 py-1 space-x-3">

                    <button
                        type="button"
                        class="text-gray-500 hover:text-[#2F44DE] font-bold text-sm btn-minus"
                        data-id="${line.id}"
                    >
                        -
                    </button>

                    <span class="text-sm font-bold w-4 text-center">
                        ${line.quantity}
                    </span>

                    <button
                        type="button"
                        class="text-gray-500 hover:text-[#2F44DE] font-bold text-sm btn-plus"
                        data-id="${line.id}"
                    >
                        +
                    </button>

                </div>

            `;

            panierContainer.append(itemDiv);

        });


        // AFFICHER LE TOTAL
        if (totalContainer) {

            totalContainer.innerText =
                `${totalGeneral.toLocaleString('fr-FR')} FCFA`;

        }


        // ENVOYER LES DONNEES AU FORMULAIRE
        if (inputCommandes) {

            inputCommandes.value = JSON.stringify(this.lines);

        }
         

        // INITIALISER LES BOUTONS
        this.initCardEvents();

    }


    // GESTION DES BOUTONS + ET -
    initCardEvents() {

        document.querySelectorAll('.btn-plus').forEach(button => {

            button.onclick = (e) => {

                const id = e.currentTarget.dataset.id;

                this.addProduits(id);

            };

        });

       
        document.querySelectorAll('.btn-minus').forEach(button => {

            button.onclick = (e) => {

                const id = e.currentTarget.dataset.id;

                this.removeProduits(id);

            };

        });

    }

   

}

// INITIALISATION DU PANIER
function initialiserPanier() {

    if (!window.cartInstance) {
        window.cartInstance = new Cart();
    }

}

// INITIALISATION DES EVENEMENTS D'AJOUT
document.addEventListener('click', function(e) {

    const btn = e.target.closest('.add_');

    if (!btn) return;

    const id = btn.id;
    const label = btn.dataset.label;
    const price = Number(btn.dataset.price);
    const image = btn.dataset.image;

    console.log("Produit :", label);
    console.log("Prix :", price);

    if (!Number.isFinite(price) || price <= 0) {
        alert("Prix du produit invalide !");
        return;
    }

    initialiserPanier();

    window.cartInstance.addProduits(
        id,
        label,
        price,
        image
    );

    alert(label + " ajouté au panier !");

});


// INITIALISATION AU CHARGEMENT
document.addEventListener('DOMContentLoaded', initialiserPanier);

// INITIALISATION LORSQU'ON REVIENT SUR UNE PAGE
window.addEventListener('pageshow', initialiserPanier);