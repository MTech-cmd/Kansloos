function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  } 

  document.addEventListener('DOMContentLoaded', function () {
    const playerCards = document.querySelectorAll('.player-card');
    const prevButton = document.querySelector('.navigation-buttons button:first-child');
    const nextButton = document.querySelector('.navigation-buttons button:last-child');
    let currentIndex = 0;

    function showPlayer(index) {
        playerCards.forEach((card, i) => {
            if (i === index) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
        if (index === 0) {
            prevButton.classList.add('hidden');
        } else {
            prevButton.classList.remove('hidden');
        }
        if (index === playerCards.length - 1) {
            nextButton.classList.add('hidden');
        } else {
            nextButton.classList.remove('hidden');
        }
    }

    function showNext() {
        if (currentIndex < playerCards.length - 1) {
            currentIndex++;
            showPlayer(currentIndex);
        }
    }

    function showPrevious() {
        if (currentIndex > 0) {
            currentIndex--;
            showPlayer(currentIndex);
        }
    }

    nextButton.addEventListener('click', showNext);
    prevButton.addEventListener('click', showPrevious);

    showPlayer(currentIndex);
});

