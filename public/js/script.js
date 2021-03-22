document.getElementById("year").innerHTML = new Date().getFullYear();

const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    burger.addEventListener('click', () => {
        //Toggle nav
        nav.classList.toggle('nav-active');

        //Animate links
        navLinks.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = '';
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.4}s`;
            }
        });

        burger.classList.toggle('toggle');
    });
};

navSlide();

mybutton = document.getElementById("myBtn");
window.onscroll = () => {
    scrollFunction();
}

// When user scrolls down 20px from the top of the document, show the button
const scrollFunction = () => {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When user clicks on the button, scroll to the top of the document
const topFunction = () => {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera Mini
}

const rentSuccessAlertDisplay = () => {
    var element = document.querySelector('.rentSuccessMessage');
    if (element) {
        var price = element.innerHTML;
        Swal.fire(
            {
                title: "SUCCÈS DE VOTRE PRÊT DE VOITURE. \n\n Montant actuel de vos prêts : " + price + "FCFA",
                text: "Votre prêt de voiture a été réalisé avec succès Veuillez régler vos dus au moment de la récupération de la voiture au parc. \n Veuillez bien aussi rendre la voiture à temps pour éviter des complications inutiles",
                icon: "success"
            }
        );
    }
}

const freeRentSuccessAlertDisplay = () => {
    var element = document.querySelector('.freeRentSuccessMessage');
    if (element) {
        Swal.fire(
            {
                title: "SUCCÈS DE VOTRE EMPRUNT DE VOITURE",
                text: "Votre emprunt de voiture a été réalisé avec succès \n\n Veuillez rendre la voiture à temps pour éviter des complications inutiles",
                icon: "success"
            }
        );
    }
}

rentSuccessAlertDisplay();
freeRentSuccessAlertDisplay();

