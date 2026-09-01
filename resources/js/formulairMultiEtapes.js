
import dayjs from 'dayjs';

const etapes = document.querySelectorAll(".etape") ; 
const btnSuivant1 = document.getElementById("btnSuivant1");

const btnPrecedent1 = document.getElementById("btnPrecedent1");
const tarifs = document.getElementById('tarif_id');

const date_fin = document.getElementById('date_fin');
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




async function ramplire_champs_montant(){

    const options_selectionnee = tarifs.options[tarifs.selectedIndex];
    const montant_tarif = parseFloat(options_selectionnee.getAttribute('data-montant'));
    const les_mois = document.querySelectorAll( 'input[name="lesmois[]"]:checked');
    const nbmois = les_mois.length;



    date_fin.value = dayjs().add(nbmois, 'month').format('YYYY-MM-DD');
    montant.value = montant_tarif * nbmois

}


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
    etapeCourante = 0 ;
    afficherEtape(etapeCourante)
}
btnPrecedent1.addEventListener("click",click_precedent1);
