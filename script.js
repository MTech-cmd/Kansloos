const characters = document.querySelectorAll(".character")

characters.forEach((character) => {
    character.addEventListener("mouseenter", () => {
        const selectedCharacter = document.querySelector(".selected")
        selectedCharacter.classList.remove("selected")

        character.classList.add("selected")

        const idSelected = character.attributes.id.value
        if(idSelected === "ultron") return;
        
        const imgPlayer1 = document.getElementById('character-player-1');
        imgPlayer1.src = `./img/${idSelected}.png`

        const nameSelected = character.getAttribute('data-name')

        const namePlayer1 = document.getElementById('name-Player-1')
        namePlayer1.innerHTML = nameSelected 

    });
});