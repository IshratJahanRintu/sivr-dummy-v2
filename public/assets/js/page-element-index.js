const deletePageElementButtons=document.querySelectorAll('.delete-page-element-btn');
const deletePageElementToast=document.getElementById('delete-page-element-toast');
const deletePageElementForm=document.getElementById('delete-page-element-form');
const pageDeleteConfirmBtn=document.getElementById('page-delete-confirm');
const pageDeleteCancelBtn=document.getElementById('page-delete-cancel');
Array.from(deletePageElementButtons).forEach((deletePageElementButton)=>{
    deletePageElementButton.addEventListener('click', () => {
        console.log(deletePageElementButton.dataset.pageElementId);
        let pageElementId=deletePageElementButton.dataset.pageElementId
        deletePageElementToast.classList.toggle('d-none');
        const formAction =deletePageElementForm.getAttribute('action').replace(':pageElementId', pageElementId);
        deletePageElementForm.setAttribute('action', formAction);


    });

});
pageDeleteConfirmBtn.addEventListener('click', () => {
    deletePageElementForm.submit();
});
pageDeleteCancelBtn.addEventListener('click', () => {
    deletePageElementToast.classList.toggle('d-none');
});
