//----------- Permet de scroll à la section about us ------------------------------------
var aboutUs = document.getElementById('aboutUsId');
var aboutUsButton = document.getElementById('aboutUsIdButton').addEventListener('click',function(){
    aboutUs.scrollIntoView();
});
//----------- Permet de scroll à la section services ------------------------------------
var services = document.getElementById('servicesId');
var servicesButton = document.getElementById('servicesIdButton').addEventListener('click',function(){
    services.scrollIntoView({block: "center"});
});
//----------- Permet de scroll à la section community ------------------------------------
var community = document.getElementById('communityId');
document.getElementById('communityIdButton').addEventListener('click',function(){
    community.scrollIntoView({block: "center"});
});
//----------- Permet de scroll à la section download ------------------------------------
var download = document.getElementById('downloadId');
document.getElementById('downloadIdButton').addEventListener('click',function(){
    download.scrollIntoView({block: "center"});
});
// =============================== Bouton mission ==========================
//----------- Permet de scroll à la section mission ------------------------------------
var mission = document.getElementById('missionId');
var missionButton = document.getElementById('missionIdButton');
missionButton.addEventListener('click',function(){
    mission.scrollIntoView({block: "center"});
    console.log("yo ca marche pas");
});
//------------------ OnMouseOver ---------------------------------------------
/*
missionButton.onmouseover = changementCouleurVert('missionIdButton');
missionButton.onmouseleave = ChangementCouleurBack('missionIdButton');
// --------- Animation du scroll  ---------------------------------------------------- pas fini

document.getElementById('scrollDogId').addEventListener('click',function(){
    console.log("yo ca marche pas");
    $("html,body").animate({
        scrollTop: aboutUs.offset().top
      }, 1000);
});

// ================================ Function ===========================================
// ---------------------- OnMouseOver chagement de couleur ----------------------------
/*
function changementCouleurVert(button){
    document.getElementById(button).style.backgroundColor = "rgba(129, 199, 132, 0.3000000119)";
}

function ChangementCouleurBack(button){
    document.getElementById(button).style.backgroundColor = "#ffffff";
}
*/