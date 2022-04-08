/**
 * Countdown
 */
function countdown() {
    const countdownElmts = document.querySelectorAll('.countdown');

    countdownElmts.forEach((countdownElmt, index) => {
        let countdownEnd = countdownElmt.dataset.countdownEnd;
        if (!countdownEnd)
            return;

        // Set the date we're counting down to
        let countdownDate = new Date(countdownEnd).getTime();
        // simple check length function
        const cl = n => n < 10 ? '0' + n : n;
        // all elements
        daysElmt = countdownElmt.querySelector('.countdown-days');
        hoursElmt = countdownElmt.querySelector('.countdown-hours');
        minutesElmt = countdownElmt.querySelector('.countdown-minutes');
        secondsElmt = countdownElmt.querySelector('.countdown-seconds');

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

countdown();