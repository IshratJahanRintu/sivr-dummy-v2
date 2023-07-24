function highlightCurrentAudio(index) {
    let listItems = document.querySelectorAll('#audioList li');
    for (let i = 0; i < listItems.length; i++) {
        listItems[i].classList.remove('highlight');
    }

    if (index >= 0 && index < listItems.length) {
        listItems[index].classList.add('highlight');
    }
}


function playAudio(url,index){
    console.log(url);
    highlightCurrentAudio(index);
    document.getElementById('audioSource').src = `${url}`;
    document.getElementById('audioPlayer').load();
    document.getElementById('audioPlayer').play();
}


// delete audio functionalities
let audioToDelete = null;
let fileTypeToDelete = null;
const    deleteAudioForm=document.getElementById('deleteAudioForm');
const  deleteConfirmationModal= document.getElementById('deleteConfirmationModal');
function openDeleteConfirmationModal(audioFile, fileType) {
    audioToDelete = audioFile;
    fileTypeToDelete = fileType;

    deleteConfirmationModal.classList.add('active');
}



function closeDeleteConfirmationModal() {
    deleteConfirmationModal.classList.remove('active');
}
function deleteAudio() {

    // Fill the form inputs with the audio file and file type to delete
    deleteAudioForm.elements.namedItem('audioFile').value = audioToDelete;
    deleteAudioForm.elements.namedItem('fileType').value = fileTypeToDelete;

    // Submit the form to delete the audio file
    deleteAudioForm.submit();

    // Hide the modal after form submission
    deleteConfirmationModal.style.display = 'none';
}
