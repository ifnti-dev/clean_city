// class Cart{
//     constructor(lines){
//         this.lines = [];
//     }
  
//     addProduits(id, label){
//         let produit = this.lines.find(element=> element.id == id);
    
//         if(produit){
//             produit.quantity += 1;
//         }else{
//             this.lines.push({id:id, quantity:1, label:label}); 
//         }
//         this.panierfunction();
//     }

   

//     removeProduits(id, label){
//         let indice = this.lines.findIndex(element=> element.id == id);
//         //console.log(indice);
//         if(indice >= 0){
//             let produit = this.lines[indice];
//             if(produit.quantity <= 1 ){
//                 this.lines.splice(indice, 1)
//                 console.log("supprimer");
//             }else{
//                 produit.quantity -=  1
//             }
//         }else{
//             console.log("aucun produit trouver");
//         }  
//         this.panierfunction();

    
//     }


//     panierfunction(){
//         const panier = document.querySelector('.panier'); //on recupere la div et on modifie son contenue
//         panier.innerHTML = "" ;
        
//         this.lines.forEach(line => {const div = document.createElement('div');
                
//                 div.innerHTML = `<span>${line.label}</span> 
//                                 <input type=number value=${line.quantity}>                    
//                                 </input>`
                                
//                 panier.append(div)
//             })

            
//         let lines = document.querySelector('#ligneCommandes');
//         lines.value = JSON.stringify(this.lines)
//         console.log(lines.value);
//     }
    
    
// }

// let c1 = new Cart();

// let boutton_add = document.querySelectorAll('.add_');

// boutton_add.forEach(element => {
//     element.addEventListener('click', (e)=>{
//        // console.log(e.target.dataset.label);
//         c1.addProduits(e.target.id, e.target.dataset.label);
        
        
//     })
    
// });



// console.log("cccccccccc");



class Cart {
    constructor() {
        this.lines = JSON.parse(localStorage.getItem('mon_panier')) || [];
        this.panierfunction();
    }
  
    addProduits(id) {
        let produit = this.lines.find(element => element.id == id);
        if (produit) { 
            produit.quantity += 1; 
        }
        this.sauvegarderEtAfficher();
    }

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

    sauvegarderEtAfficher() {
        localStorage.setItem('mon_panier', JSON.stringify(this.lines));
        this.panierfunction();
    }

    panierfunction() {
        const panierContainer = document.querySelector('#liste-panier');
        const totalContainer = document.querySelector('#total-panier');
        const inputCommandes = document.querySelector('#ligneCommandes');
        
        // Sécurité : Si on n'est pas sur la page panier, on s'arrête
        if (!panierContainer) return;

        if (this.lines.length === 0) {
            panierContainer.innerHTML = `
                <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
                    <p class="text-gray-500 font-medium">Votre panier est vide</p>
                </div>`;
            if (totalContainer) totalContainer.innerText = "0 FCFA";
            if (inputCommandes) inputCommandes.value = "";
            return;
        }

        panierContainer.innerHTML = "";
        let totalGeneral = 0;
        
        this.lines.forEach(line => {
            totalGeneral += line.price * line.quantity;
            
            const itemDiv = document.createElement('div');
            itemDiv.className = "bg-white rounded-2xl p-4 flex items-center justify-between border border-gray-100 shadow-sm";
            itemDiv.innerHTML = `
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center border border-gray-100">
                        <img src="${line.image || 'https://placeholder.com'}" alt="${line.label}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-bold text-base text-gray-900">${line.label}</h3>
                        <p class="text-lg font-extrabold text-[#2F44DE] mt-2">${Number(line.price).toLocaleString('fr-FR')} FCFA</p>
                    </div>
                </div>
                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-2 py-1 space-x-3">
                    <button type="button" class="text-gray-500 hover:text-[#2F44DE] font-bold text-sm btn-minus" data-id="${line.id}">-</button>
                    <span class="text-sm font-bold w-4 text-center">${line.quantity}</span>
                    <button type="button" class="text-gray-500 hover:text-[#2F44DE] font-bold text-sm btn-plus" data-id="${line.id}">+</button>
                </div>`;
            panierContainer.append(itemDiv);
        });

        if (totalContainer) totalContainer.innerText = `${totalGeneral.toLocaleString('fr-FR')} FCFA`;
        if (inputCommandes) inputCommandes.value = JSON.stringify(this.lines);

        this.initCardEvents();
    }

    initCardEvents() {
        document.querySelectorAll('.btn-plus').forEach(b => b.onclick = (e) => this.addProduits(e.target.dataset.id));
        document.querySelectorAll('.btn-minus').forEach(b => b.onclick = (e) => this.removeProduits(e.target.dataset.id));
    }
}

// GESTION DU CLIC SUR LA PAGE ARTICLES
function initArticlesEvents() {
    document.querySelectorAll('.add_').forEach(button => {
        button.addEventListener('click', (e) => {
            // Utiliser currentTarget pour être sûr de cibler le bouton contenant les datasets, pas son texte intérieur
            const btn = e.currentTarget; 
            
            let panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
            
            const id = btn.id;
            const label = btn.dataset.label;
            const price = parseFloat(btn.dataset.price);
            const image = btn.dataset.image;

            let produitExistant = panier.find(item => item.id === id);

            if (produitExistant) {
                produitExistant.quantity += 1;
            } else {
                panier.push({ id, label, price, image, quantity: 1 });
            }

            localStorage.setItem('mon_panier', JSON.stringify(panier));
            alert(`${label} ajouté au panier !`);
        });
    });
}

// Initialisation sécurisée dès que le DOM est totalement chargé
document.addEventListener('DOMContentLoaded', () => {
    // Écoute pour la page des articles
    initArticlesEvents();
    
    // Initialisation pour la page panier
    if (document.querySelector('#liste-panier')) {
        window.cartInstance = new Cart();
    }
});



