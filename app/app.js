document.addEventListener('DOMContentLoaded', () => {

// elements

let dayElement = document.getElementById('dayElement');
let hourElement = document.getElementById('hourElement');
let minuteElement = document.getElementById('minuteElement');
let seceondElement = document.getElementById('seceondElement');

// countdown

let countDownDate = new Date('Nov 2, 2017 00:00:00').getTime();

let x = setInterval(() => {

  let now = moment();

  // Find the distance between now an the count down date
  let distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);

  dayElement.textContent = days;
  hourElement.textContent = hours;
  minuteElement.textContent = minutes;
  secondElement.textContent = seconds;  

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    dayElement.textContent = '00';
    hourElement.textContent = '00';
    minuteElement.textContent = '00';
    secondElement.textContent = '00';  
  }
}, 1000);

});