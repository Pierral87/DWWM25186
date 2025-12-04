/* 

    Plusieurs façon de mettre en place un events en js 


    Anciennement : 
    1 - Au travers des attributs html, par exemple ! onclick=""
    <div onclick="alert('coucou')">Cliquez ici pour voir l'alerte</div>

    2 - Par l'évènement directement en js 
    document.getElementById("unId").onclick = function() { .......}


    3 - La bonne pratique pour mettre en place un event en JS : on rajoute un Event Listener, c'est une écoute d'évènement 
    document.getElementById('unID').addEventListener('click', function() {
    .....
    .....
        Code
    .....
    .....
    })

    addEventListener permet d'ajouter plusieurs évènements identiques mais avec des comportements potentiellement différent 


*/

// EVENEMENT CLICK 
// Ici je pioche mon div avec l'id div1, et je lui rattache un Event Listener sur un click 
// En gros, si cet élément est cliqué, il va se passer quelque chose ! A moi de le definir
document.getElementById('div1').addEventListener('click', function () {

    // Ici je défini une variable pour récupérer la couleur du background pour ma condition après
    let couleurActuelle = this.style.backgroundColor;
    console.log(couleurActuelle);

    // console.log("Ok, j'ai cliqué la div !");

    // Si la couleur est bleue
    if (couleurActuelle == "cornflowerblue") {
        // Alors je la change en rouge ! etc 
        this.style.backgroundColor = "red";
        this.style.width = "200px";
    } else if (couleurActuelle == "red") {
        this.style.backgroundColor = "orange";
        this.style.height = "200px";
    } else if (couleurActuelle == "orange") {
        this.style.backgroundColor = "purple";
        this.style.width = "100px";
    } else {
        this.style.backgroundColor = "cornflowerblue";
        this.style.height = "100px";
    }

    // Mon JS ici m'a permis d'intéragir avec mon div, en changeant son design, basé sur un évènement ! C'est là tout l'intérêt du JS 

});