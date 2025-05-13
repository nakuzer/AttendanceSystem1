const openModal = document.getElementById('logout');
const modal = document.querySelector('.modal-overlay');
const closeModal = document.getElementById('logout-no');
const logout = document.getElementById('logout-yes');

openModal.addEventListener('click', () => {
  modal.classList.add('active');
});
closeModal.addEventListener('click', () => {
  modal.classList.remove('active');
});
logout.addEventListener('click', () => {
  window.location.href = '../Class/logout_api.php';
});