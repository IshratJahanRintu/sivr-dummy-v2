/**
 *************
 * *********** COMMON VARIABLES **********************
 * ***********
 * */
const menu = document.getElementById("contextMenu");
const nodes = document.querySelectorAll('.node-name');
const files = document.querySelectorAll('.files');
let clickedElement = null;
let sivrPageId = null;
let sivrPage = null;
let pageElements = null;


Array.from(nodes).forEach(function (element) {
    element.addEventListener("contextmenu", function (e) {
        //DISPLAYING THE CONTEXT MENU OPTIONS
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


        for (let i = 0; i < files.length; i++) {
            files[i].addEventListener("click", function () {
                menu.style.display = "none";
            });
        }
//Keep track of the clicked element
        clickedElement = element;
        sivrPageId = clickedElement.dataset.sivrpageId;
        //get the sivr page from the JSON object of all sivr pages that is clicked on
        // using the page id attached to the data attribute of the  clicked element
        sivrPage = findPageById(sivrPageId);

        //Modal creation for SIVR PAGE ELEMENTS
        /**
         *************
         * *********** PAGE ELEMENTS**********************
         * ***********
         * */

        pageElements = sivrPage.page_elements;
        const nodeElementModal = document.getElementById('node-element-modal');
        let addPageElementPageIdInput = document.getElementById('page_element_add_page_id');
        addPageElementPageIdInput.value = sivrPageId;
        console.log(pageElements);
        let nodeElementModalTableContent = '';
        pageElements.forEach((pageElement) => {
            //Stringifying each page element object to pass it as an argument to the populateEditElementForm() function
            // on the button click eventlistener for the editing page element
            let pageElementJson = JSON.stringify(pageElement);
            console.log(pageElementJson);
            pageElementJson = pageElementJson.replace(/"/g, '&quot;');

            //Creating table containing properties of each page element and appending them to the node element modal
            nodeElementModalTableContent += `

<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="element-tab" data-bs-toggle="tab"
                data-bs-target="#element-tab-pane-${pageElement.id}" type="button" role="tab"
                aria-controls="element-tab-pane-${pageElement.id}" aria-selected="true"><i class="ph-fill ph-stack"></i>
            Element Info
        </button>
    </li>
    <li class="nav-item">
        <button onclick="populateEditElementForm('${pageElementJson}')"
                class="btn nav-link  d-inline-flex align-items-center gap-1" id="edit-element-button"
                data-bs-toggle="modal" data-bs-target="#edit-page-element-modal"><i
                class="ph-fill ph-pencil-simple-line"></i> Edit
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                data-bs-target="#upload-tab-pane-${pageElement.id}"
                type="button" role="tab" aria-controls="upload-tab-pane-${pageElement.id}" aria-selected="false"><i
                class="ph-fill ph-upload"></i> Upload Menu Icon
        </button>
    </li>


    <li class="nav-item" role="presentation">
        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab"
                data-bs-target="#delete-tab-pane-${pageElement.id}" type="button" role="tab"
                aria-controls="delete-tab-pane-${pageElement.id}" aria-selected="false"><i
                class="ph-fill ph-trash-simple"></i> Delete
        </button>
    </li>
</ul>


<div class="tab-content" id="nodeTabContent">

    <div class="tab-pane fade show active" id="element-tab-pane-${pageElement.id}" role="tabpanel"
         aria-labelledby="element-tab" tabindex="0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm border-secondary page-elements">
                <tbody>
                <tr>
                    <td>Element Type:</td>
                    <td>${pageElement.type}</td>
                </tr>
                <tr>
                    <td>Element Order</td>
                    <td>${pageElement.element_order}</td>
                </tr>
                <tr>
                    <td>Text (EN) :</td>
                    <td>${pageElement.display_name_en}</td>
                </tr>
                <tr>
                    <td>Text (BN) :</td>
                    <td>${pageElement.display_name_bn}</td>
                </tr>
                <tr>
                    <td>Text Color :</td>
                    <td>${pageElement.text_color}</td>
                </tr>
                <tr>
                    <td>Background Color :</td>
                    <td>${pageElement.background_color}</td>
                </tr>
                <tr>
                    <td>Element Name :</td>
                    <td>${pageElement.name}</td>
                </tr>
                <tr>
                    <td>Element Value :</td>
                    <td>${pageElement.value}</td>
                </tr>
                <tr>
                    <td>No Of Rows :</td>
                    <td>${pageElement.rows}</td>
                </tr>
                <tr>
                    <td>No Of Columns :</td>
                    <td>${pageElement.columns}</td>
                </tr>
                <tr>
                    <td>Element Visiblity :</td>
                    <td>${(pageElement.is_visible === 'Y') ? 'Visible' : 'Not Visible'}</td>
                </tr>
                <tr>
                    <td>Data Provider Funtion :</td>
                    <td>${pageElement.data_provider_function}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="upload-tab-pane-${pageElement.id}" role="tabpanel" aria-labelledby="upload-tab"
         tabindex="0">Upload
    </div>
    <div class="tab-pane fade" id="delete-tab-pane-${pageElement.id}" role="tabpanel" aria-labelledby="delete-tab"
         tabindex="0">Edit
    </div>
</div>

        `;
        });

        nodeElementModal.innerHTML = `<div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SIVR PAGE ELEMENTS</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
               <div class="text-end mb-3">
                    <button class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1"
                            data-bs-toggle="modal" data-bs-target="#addNewPageElement"><i class="bi bi-plus"></i> Add
                        New Page Element
                    </button>
                </div>
                      ${nodeElementModalTableContent}
    </div>
                </div>
        </div>`;
    });

    document.addEventListener("click", function () {
        menu.style.display = "none";
    });

});
// tree.addEventListener('contextmenu', function (event) {
//
//     event.preventDefault();
//
//     clickedElement = event.target;
//     if (clickedElement.classList.contains('node-name')) {
//         rightClickedNode = clickedElement.parentElement;
//         showFloatingOption(event.clientX, event.clientY);
//     }
// });


/**
 *************
 * *********** ADD FUNCTIONALITIES **********************
 * ***********
 * */

//add variables
const addOption = document.getElementById('add-option');
const parentIdInput = document.getElementById('add-parent-page-id');

//Event listener for add option
addOption.addEventListener('click', function () {

    if (clickedElement != null) {
        parentIdInput.value = sivrPageId;


    }


});
/**
 *************
 * *********** EDIT FUNCTIONALITIES **********************
 * ***********
 * */

//Edit variables///
const editOption = document.getElementById('edit-option');
const editPageForm = document.getElementById('edit-page-form');
const editServiceTitleId = document.getElementById('edit_service_title_id');

//Event listener for edit option
editOption.addEventListener('click', function () {
    document.getElementById('edit_vivr_id').value = sivrPage.vivr_id;
    document.getElementById('edit_page_heading_ban').value = sivrPage.page_heading_ban;
    document.getElementById('edit_page_heading_en').value = sivrPage.page_heading_en;
    document.getElementById('edit_has_previous_menu').value = sivrPage.has_previous_menu;
    document.getElementById('edit_has_main_menu').value = sivrPage.has_main_menu;
    document.getElementById('edit_task').value = sivrPage.task;

    const formAction = editPageForm.getAttribute('action').replace('PAGE', sivrPageId);
    editPageForm.setAttribute('action', formAction);

});

/**
 *************
 * *********** DELETE FUNCTIONALITIES **********************
 * ***********
 * */

/// DELETE  variables////
const deleteTreeMenuItem = document.getElementById('jsDeleteTreeConfirm');
const deleteToast = document.getElementById('delete-toast');
const deletePageForm = document.getElementById('delete-sivrPage-form');
const deleteConfirmButton = document.getElementById('delete-confirm');
const cancelButton = document.getElementById('delete-cancel');
deleteTreeMenuItem.addEventListener('click', () => {
    deleteToast.classList.toggle('d-none');
    const formAction = deletePageForm.getAttribute('action').replace(':sivrpageid', sivrPageId);
    deletePageForm.setAttribute('action', formAction);
});
deleteConfirmButton.addEventListener('click', () => {
    deletePageForm.submit();
});
cancelButton.addEventListener('click', () => {
    deleteToast.classList.toggle('d-none');
});


/**
 *************
 * *********** Audio upload  FUNCTIONALITIES **********************
 * ***********
 * */
//audio-upload variables
const audioUploadOption = document.getElementById('audio-upload-option');
const audioPageIdInput = document.getElementById('audio-page-id');
const audioList = document.getElementById('audioList');
const audioSource = document.getElementById('audioSource');
const audioPlayer = document.getElementById('audioPlayer');

//Event listener for audio upload option
function playAudio(fileName) {
    let audioUrl = `/storage/app/${fileName}`;
    // currentAudioIndex = index;
    // highlightCurrentAudio();
    // if (index >= 0 && index < audioFiles.length) {
    //     let file = audioFiles[index];
    audioSource.setAttribute('src', audioUrl);
    audioPlayer.load();
    audioPlayer.play();
    // }
}

audioUploadOption.addEventListener('click', function () {

    if (clickedElement != null) {

        audioPageIdInput.value = sivrPageId;
        console.log(audioPageIdInput.value);
        audioList.innerHTML = `
<li onclick="playAudio('${sivrPage.audio_file_ban}')">Bangla Audio file:${sivrPage.audio_file_ban}</li>
<li  onclick="playAudio('${sivrPage.audio_file_en}')">English Audio file:${sivrPage.audio_file_en}</li>
`;
    }

});

function findPageById(sivrPageId) {
    console.log(sivrPagesJson);
    return sivrPagesJson.find(sivrPage => sivrPage.id === parseInt(sivrPageId));
}

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

/**
 * @script For Element Type Dropdown Toggle in page element add form
 */
;(function () {
    document.addEventListener("DOMContentLoaded", function () {
        const elementType = document.getElementById('g-element-type')
        const elementNames = document.getElementById('element-name-area');
        const elementRowColumns = document.getElementById('no-row-column-area');

        elementType.addEventListener('change', function () {
            const elementTypeValue = elementType.value;
            if (elementTypeValue === "input") {
                elementNames.style.display = "block";
                elementRowColumns.style.display = "none";
            } else if (elementTypeValue === "table") {
                elementNames.style.display = "none";
                elementRowColumns.style.display = "block";
            } else if (elementTypeValue === "button") {
                elementNames.style.display = "none";
                elementRowColumns.style.display = "none";
            }
        })

    });
})();

function populateEditElementForm(pageElementString) {
    const editElementForm = document.getElementById('edit-element-form')
    let pageElement = JSON.parse(pageElementString);
    console.log(pageElement.type);
    const elementType = document.getElementById('edit-element-type');
    const elementName = document.getElementById('edit-element-name');
    const elementValue = document.getElementById('edit-element-value');
    const elementRows = document.getElementById('edit-element-no-rows');
    const elementColumns = document.getElementById('edit-element-no-columns');
    const elementNames = document.getElementById('edit-element-name-area');
    const elementRowColumns = document.getElementById('edit-no-row-column-area');
    elementType.value = pageElement.type;
    document.getElementById('edit-element-order').value = pageElement.element_order;
    document.getElementById('edit-element-text-bn').value = pageElement.display_name_bn;
    document.getElementById('edit-element-text-en').value = pageElement.display_name_en;
    document.getElementById('edit-element-bg-color').value = pageElement.background_color;
    document.getElementById('edit-element-color').value = pageElement.text_color;
    document.getElementById('edit-element-visibility').value = pageElement.is_visible;
    document.getElementById('edit-element-provider-function').value = pageElement.data_provider_function;


    if (pageElement.type === 'table') {
        elementRows.value = pageElement.rows;
        elementColumns.value = pageElement.columns;
        elementRowColumns.style.display = 'block';
    } else if (pageElement.type === 'input') {
        elementName.value = pageElement.name;
        elementValue.value = pageElement.value;
        elementNames.style.display = 'block';
    }
    const formAction = editElementForm.getAttribute('action').replace('PAGE_ELEMENT', pageElement.id);
    editElementForm.setAttribute('action', formAction);

    elementType.addEventListener('change', function () {
        const elementTypeValue = elementType.value;
        if (elementTypeValue === "input") {
            elementNames.style.display = "block";
            elementRowColumns.style.display = "none";
            elementRows.value = 0;
            elementColumns.value = 0;

        } else if (elementTypeValue === "table") {
            elementNames.style.display = "none";
            elementRowColumns.style.display = "block";
            elementName.value = null;
            elementValue.value = null;
        } else if (elementTypeValue === "button") {
            elementNames.style.display = "none";
            elementRowColumns.style.display = "none";
            elementRows.value = 0;
            elementColumns.value = 0;
            elementName.value = null;
            elementValue.value = null;
        }
    })
}
