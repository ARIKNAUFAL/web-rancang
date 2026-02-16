const inputField = document.querySelector('input');
const btnComment = document.querySelector('.btn-group');
const btnHide = document.querySelector('button[type="button"]');
const btnSubmit = document.querySelector('#submit-comment');

inputField.addEventListener('click', () => {
    btnComment.style.display = 'block';
})

btnHide.addEventListener('click', () => {
    btnComment.style.display = 'none';
})