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

// Timer methods
const getTimeLimit = (element, index) => {
    // end date is defined here
    var duration = parseInt(element.innerHTML);
    var now = new Date();
    var ms = now.setDate(now.getDate() + duration);
    var endTime = new Date(ms);
    var endTime = (Date.parse(endTime)) / 1000;
    var itemId = "timeLimit_" + index;
    localStorage.setItem(itemId, endTime);
    return localStorage.getItem(itemId);
}

const getTimeLeft = (element, index) => {
    var finishTime = getTimeLimit(element, index);
    var now = new Date();
    now = (Date.parse(now)) / 1000;
    var timeLeft = finishTime - now
    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
    return {
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

const startTimer = (element, index) => {
    const timerInterVal = setInterval(() => {
        var timeLeft = getTimeLeft(element, index);
        formatTimeLeft(timeLeft, index);
        if (timeLeft <= 0) {
            clearInterval(timerInterVal);
        }
    }, 1000);
}

var elements = document.querySelectorAll('.duration p');
console.log(elements);
elements.forEach((element, index) => {
    console.log(index);
    startTimer(element, index);
});