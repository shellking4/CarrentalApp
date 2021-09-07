let baseIdString = "timeLimit_";

document.getElementById("year").innerHTML = new Date().getFullYear();
const navLinks = document.querySelectorAll('.nav-links li');

const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
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

// Notifications functions
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
    var itemCount = parseInt(element.innerHTML);
    console.log(itemCount);
    localStorage.removeItem('itemCount');
    console.log(localStorage.getItem('itemCount'));
    if (localStorage.getItem('itemCount') != null) {
        if (itemCount == localStorage.getItem('itemCount') + 1) {
            Swal.fire(
                {
                    title: "SUCCÈS DE VOTRE EMPRUNT DE VOITURE",
                    text: "Votre emprunt de voiture a été réalisé avec succès \n\n Veuillez rendre la voiture à temps pour éviter des complications inutiles",
                    icon: "success"
                }
            );
            localStorage.setItem('itemCount', itemCount);
        }
    } else {
        localStorage.setItem('itemCount', itemCount);
        Swal.fire(
            {
                title: "SUCCÈS DE VOTRE EMPRUNT DE VOITURE",
                text: "Votre emprunt de voiture a été réalisé avec succès \n\n Veuillez rendre la voiture à temps pour éviter des complications inutiles",
                icon: "success"
            }
        );
        console.log(localStorage.getItem('itemCount'));
    }
}



const endOfCarUsageAlert = () => {
    Swal.fire(
        {
            title: "TEMPS D'UTILISATION ÉCOULÉ",
            text: "Votre temps d'utilisation de cette voiture est écoulé. \n\n Veuillez rendre promptement la voiture au parc CaRRentAL le plus proche",
            icon: "warning"
        }
    );
}

const passResetSuccessAlert = () => {
    var element = document.querySelector('.pass-reset-success');
    if (element) {
        Swal.fire(
            {
                title: "MOT DE PASSE CHANGÉ AVEC SUCCÈS",
                text: "Veuillez bien garder le nouveau mot de passe",
                icon: "success"
            }
        );
    }
}

const addAlert = () => {
    var element = document.querySelector('.add-success');
    if (element) {
        Swal.fire(
            {
                title: "AJOUT EFFECTUÉ AVEC SUCCÈS",
                text: "",
                icon: "success"
            }
        );
    }
}


const updateAlert = () => {
    var element = document.querySelector('.update-success');
    if (element) {
        Swal.fire(
            {
                title: "MODIFICATION EFFECTUÉ AVEC SUCCÈS",
                text: "",
                icon: "success"
            }
        );
    }
}





const deleteAlert = () => {
    var element = document.querySelector('.delete-success');
    if (element) {
        Swal.fire(
            {
                title: "SUPPRESSION EFFECTUÉ AVEC SUCCÈS",
                text: "",
                icon: "success"
            }
        );
    }
}




deleteAlert();
updateAlert();
addAlert();
rentSuccessAlertDisplay();
freeRentSuccessAlertDisplay();
passResetSuccessAlert();

// Timer methods
const getTimeLimitFromServer = (element) => {
    var endTimeFromServer = element.innerHTML;
    var endTime = new Date(endTimeFromServer);
    return endTime;
}

const getTimeLeft = (endTime) => {
    var total = (Date.parse(endTime) / 1000) - (Date.parse(new Date()) / 1000);
    console.log(total);
    var days = Math.floor(total / 86400);
    var hours = Math.floor((total / 3600) % 24);
    var minutes = Math.floor((total / 60) % 60);
    var seconds = Math.floor(total % 60);
    return {
        total,
        days,
        hours,
        minutes,
        seconds
    };
}

const formatTimeLeft = (timeLeft, index) => {
    var days = timeLeft.days;
    var hours = timeLeft.hours;
    var minutes = timeLeft.minutes;
    var seconds = timeLeft.seconds;

    if (hours < "10") {
        hours = "0" + hours;
    }
    if (minutes < "10") {
        minutes = "0" + minutes;
    }
    if (seconds < "10") {
        seconds = "0" + seconds;
    }
    var daysSelector = "#timer-" + index + " .days";
    var hoursSelector = "#timer-" + index + " .hours";
    var minutesSelector = "#timer-" + index + " .minutes";
    var secondsSelector = "#timer-" + index + " .seconds";

    $(daysSelector).html(days + "<span>Jours</span>");
    $(hoursSelector).html(hours + "<span>Heures</span>");
    $(minutesSelector).html(minutes + "<span>Minutes</span>");
    $(secondsSelector).html(seconds + "<span>Secondes</span>");

}


const updateTime = (endTime, index) => {
    var timeLeft = getTimeLeft(endTime);
    formatTimeLeft(timeLeft, index);
    if (timeLeft.total <= 0) {
        clearInterval(timerInterVal);
        endOfCarUsageAlert();
    }
}

let timerInterVal = null;
const startTimer = (element, index) => {
    let endTime = getTimeLimitFromServer(element);
    console.log(endTime);
    timerInterVal = setInterval(updateTime, 1000, endTime, index);
}

var elements = document.querySelectorAll('.endOfRent');
elements.forEach((element) => {
    console.log(elements);
    var index = parseInt(element.parentElement.children[0].innerHTML);
    startTimer(element, index);
});

