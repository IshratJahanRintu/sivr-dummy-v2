/**
 *************
 * *********** COMMON VARIABLES **********************
 * ***********
 * */
// const menu = document.getElementById("contextMenu");
const nodes = document.querySelectorAll('.node-name');
const files = document.querySelectorAll('.files');
const allMenu=document.querySelectorAll('.context-menu');
 let clickedElement = null;
let sivrPageId = null;
let sivrPage = null;
 let pageElements = null;

//hiding all the context menu on clicking any place on the window
window.addEventListener('click', function(event) {

    allMenu.forEach(function(menu) {
        menu.style.display = 'none';
    });
});

Array.from(nodes).forEach(function (element) {

    element.addEventListener("contextmenu", function (e) {

        allMenu.forEach(menu => {
            menu.style.display = "none";
        });
        //DISPLAYING THE CONTEXT MENU OPTIONS
        sivrPageId = element.dataset.sivrpageId;
        const menu = document.getElementById(`contextMenu-${sivrPageId}`);
        console.log(menu);
        e.preventDefault();
        menu.style.display = "block";
        menu.style.left = e.pageX;
        menu.style.top = e.pageY;
        menu.style.position = "fixed";

        // Calculate the offset from the viewport's top-left corner
        const offsetX = e.pageX - window.scrollX;
        const offsetY = e.pageY - window.scrollY;

        // Adjust the menu position to align with the cursor
        const menuWidth = menu.offsetWidth;
        const menuHeight = menu.offsetHeight;
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        if (offsetX + menuWidth > windowWidth) {
            menu.style.left = (windowWidth - menuWidth) + "px";
        } else {
            menu.style.left = offsetX + "px";
        }

        if (offsetY + menuHeight > windowHeight) {
            menu.style.top = (windowHeight - menuHeight) + "px";
        } else {
            menu.style.top = offsetY + "px";
        }

    });


    element.addEventListener("click", function () {
        allMenu.forEach(menu => {
            menu.style.display = "none";
        });
    });

});




/**
 *************
 * *********** DELETE FUNCTIONALITIES **********************
 * ***********
 * */

/// DELETE  variables////
const deleteTreeMenuItems = document.querySelectorAll('.jsDeleteTreeConfirm');
const deleteToast = document.getElementById('delete-toast');
const deletePageForm = document.getElementById('delete-sivrPage-form');
const deleteConfirmButton = document.getElementById('delete-confirm');
const cancelButton = document.getElementById('delete-cancel');

Array.from(deleteTreeMenuItems).forEach(deleteTreeMenuItem=>{
    deleteTreeMenuItem.addEventListener('click', () => {
        deleteToast.classList.toggle('d-none');
        const formAction = deletePageForm.getAttribute('action').replace(':sivrpageid', sivrPageId);
        deletePageForm.setAttribute('action', formAction);

        deleteConfirmButton.addEventListener('click', () => {
            deletePageForm.submit();
        });
        cancelButton.addEventListener('click', () => {
            deleteToast.classList.toggle('d-none');
        });
    });
});



/**
 *************
 * *********** Audio upload  FUNCTIONALITIES **********************
 * ***********
 * */
// //audio-upload variables
// const audioUploadOption = document.getElementById('audio-upload-option');
// const audioPageIdInput = document.getElementById('audio-page-id');
// const audioList = document.getElementById('audioList');
// const audioSource = document.getElementById('audioSource');
// const audioPlayer = document.getElementById('audioPlayer');
//
// //Event listener for audio upload option
// function playAudio(fileName) {
//     let audioUrl = `/storage/app/${fileName}`;
//     // currentAudioIndex = index;
//     // highlightCurrentAudio();
//     // if (index >= 0 && index < audioFiles.length) {
//     //     let file = audioFiles[index];
//     audioSource.setAttribute('src', audioUrl);
//     audioPlayer.load();
//     audioPlayer.play();
//     // }
// }
//
// audioUploadOption.addEventListener('click', function () {
//
//     if (clickedElement != null) {
//
//         audioPageIdInput.value = sivrPageId;
//         console.log(audioPageIdInput.value);
//         audioList.innerHTML = `
// <li onclick="playAudio('${sivrPage.audio_file_ban}')">Bangla Audio file:${sivrPage.audio_file_ban}</li>
// <li  onclick="playAudio('${sivrPage.audio_file_en}')">English Audio file:${sivrPage.audio_file_en}</li>
// `;
//     }
//
// });
//
// function findPageById(sivrPageId) {
//     console.log(sivrPagesJson);
//     return sivrPagesJson.find(sivrPage => sivrPage.id === parseInt(sivrPageId));
// }

//
// // ************************Audio file upload script************************//
//
//
// let audioFiles = [];
// let currentAudioIndex = -1;
//
// function highlightCurrentAudio() {
//     let listItems = document.querySelectorAll('#audioList li');
//     for (let i = 0; i < listItems.length; i++) {
//         listItems[i].classList.remove('highlight');
//     }
//
//     if (currentAudioIndex >= 0 && currentAudioIndex < listItems.length) {
//         listItems[currentAudioIndex].classList.add('highlight');
//     }
// }
//

//
// document.getElementById('audioForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//
//     let fileInput = document.getElementById('audioInput');
//     let fileList = fileInput.files;
//
//     for (let i = 0; i < fileList.length; i++) {
//         let file = fileList[i];
//         let listItem = document.createElement('li');
//         listItem.textContent = file.name;
//         listItem.addEventListener('click', function (index) {
//             return function () {
//                 playAudio(index);
//             };
//         }(audioFiles.length));
//         document.getElementById('audioList').appendChild(listItem);
//
//         let reader = new FileReader();
//         reader.onload = function (e) {
//             audioFiles.push({
//                 name: file.name,
//                 url: e.target.result
//             });
//         };
//         reader.readAsDataURL(file);
//     }
//
//     fileInput.value = '';
//
//
// document.getElementById('audioPlayer').addEventListener('ended', function () {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// });
//
// document.addEventListener('keydown', function (e) {
//     if (e.key === 'ArrowLeft') {
//         if (currentAudioIndex > 0) {
//             playAudio(currentAudioIndex - 1);
//         }
//     } else if (e.key === 'ArrowRight') {
//         if (currentAudioIndex < audioFiles.length - 1) {
//             playAudio(currentAudioIndex + 1);
//         }
//     }
// });
//
// document.getElementById('audioPlayer').addEventListener('ended', function () {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// });
//
//
// document.getElementById('audioPlayer').addEventListener('play', function () {
//     if (currentAudioIndex >= 0 && currentAudioIndex < audioFiles.length) {
//         highlightCurrentAudio();
//     }
// });
//
// document.getElementById('audioPlayer').addEventListener('ended', function () {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// });
//
// function playNext() {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// }
//
// function playPrevious() {
//     if (currentAudioIndex > 0) {
//         playAudio(currentAudioIndex - 1);
//     }
// }
//
// document.getElementById('nextButton').addEventListener('click', playNext);
// document.getElementById('previousButton').addEventListener('click', playPrevious);
//
//
//

