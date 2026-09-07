
import dayjs from 'dayjs';

document.addEventListener('DOMContentLoaded', () => {
    window.HSStaticMethods.autoInit();
});

const etapes = document.querySelectorAll(".etape") ; 
const btnSuivant1 = document.getElementById("btnSuivant1");
const btnPrecedent1 = document.getElementById("btnPrecedent1");
const date_fin = document.getElementById('date_fin');
const les_mois = document.querySelectorAll( 'input[name="lesmois[]"]');
const tarifs_id = document.getElementById('tarif_id');
const abonnement_id = document.getElementById('abonnement_id');
const mois_erreure = document.getElementById('mois_erreure')
const tarif_erreure = document.getElementById('tarif_erreure');
const abonnement_erreure = document.getElementById('abonnement_erreure');



function cocher_successivement_lesmois(){

    les_mois.forEach(mois => {
        let indice = mois.getAttribute('data-indice');
        console.log(indice);
    })



}

cocher_successivement_lesmois();





function afficherEtape(index) {
        etapes.forEach((etape, i) => {etape.classList.toggle("active", i === index);
           // console.log(etape, i) ; 
            if(i==1){
                ramplire_champs_montant()
            }
    });
}


// dayjs librairie de manipulation des dates en js

function ramplire_champs_montant(){

    const tarif_selectionnee = tarifs_id.options[tarifs_id.selectedIndex];
    const montant_tarif = parseFloat(tarif_selectionnee.getAttribute('data-montant'));
   
    const montant = document.getElementById('montant');
    const les_mois_selectionne = document.querySelectorAll( 'input[name="lesmois[]"]:checked');

    les_mois.forEach((mois) => console.log(mois));

    const nbmois = les_mois_selectionne.length;
   
    date_fin.value = dayjs().add(nbmois, 'month').format('YYYY-MM-DD');
    montant.value = montant_tarif * nbmois

}




let etapeCourante = 0;

function click_boutton1(){
    const les_mois_selectionne = document.querySelectorAll( 'input[name="lesmois[]"]:checked');

    if(tarifs_id.value.trim() &&  abonnement_id.value.trim() && les_mois_selectionne.length > 0){
        etapeCourante = 1;
        afficherEtape(etapeCourante);
    }else{

       
        if(!tarifs_id.value){
            tarif_erreure.textContent = "selectionner  un tarif";
        }


        if(!abonnement_id.value){
            abonnement_erreure.textContent = "selectionner un abonnement";
        }

        if(les_mois_selectionne.length === 0){
            mois_erreure.textContent = "selectionner  un mois";
        }
        
        
    }
}
btnSuivant1.addEventListener("click", click_boutton1);


function click_precedent1(){
    etapeCourante = 0 ;
    afficherEtape(etapeCourante)
}
btnPrecedent1.addEventListener("click",click_precedent1);










