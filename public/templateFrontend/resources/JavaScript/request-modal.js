//**selector */
const mlOpenRequestModal = document.querySelector('#ml-open-request-modal');
const mlModalRequest = document.querySelector('#ml-modal-request');
const mlCloseRequestModal = document.querySelector('#ml-close-request-modal');

//**open the request modal */
mlOpenRequestModal.addEventListener('click', () => {
    mlModalRequest.showModal();
})

//**close the request modal */
mlCloseRequestModal.addEventListener('click', () => {
    mlModalRequest.close();
})