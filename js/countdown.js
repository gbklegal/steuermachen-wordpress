/**
 * Countdown
 */
function countdown() {
    const countdownElmts = document.querySelectorAll('[data-countdown]');

    countdownElmts.forEach(countdownElmt => {
        let countdownEnd = countdownElmt.dataset.countdownEnd;
        if (!countdownEnd)
            return;

        // Set the date we're counting down to
        if (!countdownEnd.includes('T'))
            countdownEnd = countdownEnd.replace(/-/g, '/');

        let countdownDate = new Date(countdownEnd).getTime();

        // simple check length function
        const cl = n => n < 10 ? '0' + n : n;

        // all elements
        daysElmt = countdownElmt.querySelector('[data-countdown-days]');
        hoursElmt = countdownElmt.querySelector('[data-countdown-hours]');
        minutesElmt = countdownElmt.querySelector('[data-countdown-minutes]');
        secondsElmt = countdownElmt.querySelector('[data-countdown-seconds]');

        // Update the count down every 1 second
        const countDown = setInterval(() => {
            // Get today's date and time
            let now = new Date().getTime();

            // Find the distance between now and the count down date
            let distance = countdownDate - now;

            if (distance < 0) {
                clearInterval(countDown);
                return;
            }

            // Time calculations for days, hours, minutes and seconds
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // console.log(days, hours, minutes, seconds);
            // console.log(countdownDate, now);

            // If the count down is finished, write some text
            if (distance < 1000)
                // this let the countdown stay at 0
                clearInterval(countDown);

            daysElmt.innerHTML = days;
            hoursElmt.innerHTML = cl(hours);
            minutesElmt.innerHTML = cl(minutes);
            secondsElmt.innerHTML = cl(seconds);
        }, 1000);
    });
}

window.addEventListener('load', countdown);