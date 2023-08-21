const deleteVivrButtons=document.querySelectorAll('.delete-vivr-btn');
const deleteVivrToast=document.getElementById('delete-toast');
const deleteVivrForm=document.getElementById('delete-vivr-form');
const vivrDeleteConfirmBtn=document.getElementById('delete-confirm');
const vivrDeleteCancelBtn=document.getElementById('delete-cancel');
Array.from(deleteVivrButtons).forEach((deleteVivrButton)=>{
    deleteVivrButton.addEventListener('click', () => {
        console.log(deleteVivrButton.dataset.vivrId);
        let vivrId=deleteVivrButton.dataset.vivrId
        deleteVivrToast.classList.toggle('d-none');
        const formAction =deleteVivrForm.getAttribute('action').replace(':vivrId', vivrId);
        deleteVivrForm.setAttribute('action', formAction);
    });

});
vivrDeleteConfirmBtn.addEventListener('click', () => {
    deleteVivrForm.submit();
});
vivrDeleteCancelBtn.addEventListener('click', () => {
    deleteVivrToast.classList.toggle('d-none');
});
