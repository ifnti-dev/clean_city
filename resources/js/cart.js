class Cart{
    constructor(lines){
        this.lines = [];
    }
  
    addProduits(id, label){
        let produit = this.lines.find(element=> element.id == id);
    
        if(produit){
            produit.quantity += 1;
        }else{
            this.lines.push({id:id, quantity:1, label:label}); 
        }
        this.panierfunction();
    }

   

    removeProduits(id, label){
        let indice = this.lines.findIndex(element=> element.id == id);
        //console.log(indice);
        if(indice >= 0){
            let produit = this.lines[indice];
            if(produit.quantity <= 1 ){
                this.lines.splice(indice, 1)
                console.log("supprimer");
            }else{
                produit.quantity -=  1
            }
        }else{
            console.log("aucun produit trouver");
        }  
        this.panierfunction();

    
    }

    
    panierfunction(){
        const panier = document.querySelector('.panier'); //on recupere la div et on modifie son contenue
        panier.innerHTML = "" ;
        
        this.lines.forEach(line => {const div = document.createElement('div');
                
                div.innerHTML = `<span>${line.label}</span> 
                                <input type=number value=${line.quantity}>                    
                                </input>`
                                
                panier.append(div)
            })

            
        let lines = document.querySelector('#ligneCommandes');
        lines.value = JSON.stringify(this.lines)
        console.log(lines.value);
    }
    
    
}

let c1 = new Cart();

let boutton_add = document.querySelectorAll('.add_');

boutton_add.forEach(element => {
    element.addEventListener('click', (e)=>{
       // console.log(e.target.dataset.label);
        c1.addProduits(e.target.id, e.target.dataset.label);
        
        
    })
    
});






console.log("cccccccccc");




