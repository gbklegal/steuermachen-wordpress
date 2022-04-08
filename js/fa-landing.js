const modal = new ModalFrame({
    modalElmt: document.querySelector('#modal'),
    closeElmt: document.querySelector('#modalClose'),
    frameElmt: document.querySelector('#modalFrame')
});

const footerLinks = document.querySelectorAll('footer a');
footerLinks.forEach(link => {
    link.addEventListener('click', modal.open);
});