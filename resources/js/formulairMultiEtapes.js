
import dayjs from 'dayjs';

const formulaire = document.querySelector('.formulaire')

const etapes = document.querySelectorAll(".etape") ; 
//console.log(etapes);
const btnSuivant1 = document.getElementById("btnSuivant1");

const btnPrecedent1 = document.getElementById("btnPrecedent1");


const tarifs = document.getElementById('tarif_id');

const date_fin = document.getElementById('date_fin');
const methode_paiement_id = document.getElementById('methode_paiement_id');
const abonnement_id = document.getElementById('abonnement_id');
const les_mois = document.querySelectorAll('input[type="checkbox"]:checked');
const montant = document.getElementById('montant');




function afficherEtape(index) {
        etapes.forEach((etape, i) => {etape.classList.toggle("active", i === index);
            console.log(etape, i) ; 
            if(i==1){
                
                ramplire_champs_montant()
            }
    });
}


// dayjs librairie de manipulation des dates en js

const nbmois = les_mois.length;
const date_debut1 = dayjs(); 
const date_fin2 = date_debut1.add(nbmois, 'month');


const montant1 = 1000 * nbmois


const date_debut = document.getElementById('date_debut');

async function ramplire_champs_montant(){
    date_fin.value = date_fin2.format('DD/MM/YYYY');
    montant.value = montant1

}

//console.log(bouton);
//bouton.addEventListener("click");
let etapeCourante = 0;

function click_boutton1(){
    if(tarifs.value.trim()){
        etapeCourante = 1;
        afficherEtape(etapeCourante);

    }else{
        alert("errore ramplire les champs");
    }

}

btnSuivant1.addEventListener("click", click_boutton1);



function click_precedent1(){
   let etapeCourante = 0 ;
    afficherEtape(etapeCourante)
}
btnPrecedent1.addEventListener("click",click_precedent1);
