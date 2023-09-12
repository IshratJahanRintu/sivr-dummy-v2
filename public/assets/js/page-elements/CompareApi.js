class CompareApi {
    constructor() {
        this.containerId='element-wise-value';
        this.createInputFieldsForCompareApi = this.createInputFieldsForCompareApi.bind(this);
    }
 createInputFieldsForCompareApi() {
        let containerId='compare-api-elements';
    let createdElements = [];
    let count = 1;
let displayNameEnglish='';
let displayNameBangla='';

     if(typeof pageElement !== 'undefined' ){
        displayNameEnglish= pageElement.display_name_en??'';
         displayNameBangla= pageElement.display_name_bn??'';
     }

    if (elementProperties && elementProperties.compare_count) {
        count = elementProperties.compare_count;
    }


    document.getElementById(this.containerId).innerHTML = `

<div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-en">Display Text (EN)</label>
                                                            <input class="form-control" type="text"
                                                                   name="display_name_en"
                                                                   id="g-element-text-en"
                                                                   value="${displayNameEnglish}">
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-bn">Display Text (BN)</label>
                                                            <input class="form-control" type="text"
                                                                   name="display_name_bn"
                                                                   id="g-element-text-bn"
                                                                   value="${displayNameBangla}">
                                                        </div>

        <div class="form-group col-md-4 mb-3">
            <label for="compare-count">Compare Count:</label>
            <input class="form-control" name="compare_count" id="compare-count" type="number" min="1" max="10" value="${count}">
        </div>

        <div class="g-create-form">
            <div id="compare-api-elements"></div>
        </div>`;


    this.createCompareApiElements(containerId, createdElements, count);
     const compareCountInput = document.getElementById('compare-count');


     // Add an input event listener to restrict the input value
     compareCountInput.addEventListener('input', () => {
         const inputValue = parseInt(compareCountInput.value, 10); // Parse input value as an integer
          if (inputValue > 10) {
             compareCountInput.value = 10; // Maximum value is 10
         }
         this.createCompareApiElements(containerId, createdElements, compareCountInput.value);
     });
    // Adding or removing input fields on count value change
    // document.getElementById('compare-count').addEventListener('change', (event)=> {
    //     let countValue = event.target.value;
    //     this.createCompareApiElements(containerId, createdElements, countValue);
    //
    //
    // });
}

    createCompareApiElements(containerId, createdElements, countValue) {
        countValue = parseInt(countValue);


        const container = document.getElementById(containerId);

        // Add or remove input fields based on the countValue
        while (createdElements.length < countValue) {
            this.addField(createdElements.length + 1, container,createdElements);
        }

        while (createdElements.length > countValue) {
            removeLastField(container);
            createdElements.pop();
        }





    }
     addField(index, container,createdElements) {
        let keyValue ='';
        let comparison = '';
        let transferOption = null;
        let pageId = '';
        let apiKey='';
        let backPageId='';
        if (typeof compareApis!=='undefined' && compareApis.length!==0 && compareApis[index-1]) {
            apiKey=compareApis[index-1]['api_key']??'';
            keyValue = compareApis[index-1]['key_value']??'';
            comparison =compareApis[index-1]['comparison']??'';

            transferOption=compareApis[index-1]['transfer_option']??'';
            pageId = compareApis[index-1]['transfer_page_id']??compareApis[index-1]['goto_page_id']??'';
            backPageId = compareApis[index-1]['back_page_id']??'';

        }
        console.log(container);
        let containerDiv = document.createElement('div');
        containerDiv.classList.add("container-fluid", "border", "border-secondary-subtle", "rounded", "mb-3", "p-3");
        containerDiv.innerHTML = `<div class="form-group  mb-3">
            <label for="compare-api-comparison-${index}" id="compare-api-comparison-label-${index}">Comparison ${index}:</label>
            <input class="form-control" type="text" name="compare_api_comparison[]" id="compare-api-comparison-${index}" value="${comparison}" maxlength="3">
        </div>
        <div class="form-group  mb-3">
            <label for="compare-api-key-${index}">Api key ${index}:</label>
            <input class="form-control" type="text" name="compare_api_key[]" id="compare-api-key-${index}" value="${apiKey}">
        </div>
        <div class="form-group  mb-3">
            <label for="compare-api-key-value-${index}" id="compare-api-key-value-label-${index}">Key value ${index}:</label>
            <input class="form-control" type="text" name="compare_api_key_value[]" id="compare-api-key-value-${index}" value="${keyValue}">
        </div>
        <div class="form-group  mb-3">
            <label for="compare-api-transfer-options-${index}" id="compare-api-transfer-options-label-${index}">Transfer Options ${index}:</label>
            <select name="compare_api_transfer_options[]" id="compare-api-transfer-options-${index}" class="form-control">
                <option value="redirect" ${transferOption==='redirect'?'selected':''}>Redirect Page</option>
                <option value="goto" ${transferOption==='goto'?'selected':''}>Goto Page</option>
            </select>
        </div>
        <div id="compare-transfer-type-element-${index}">

        </div>`;

        container.appendChild(containerDiv);
        createdElements.push(containerDiv);

        let transferOptionId = "compare-api-transfer-options-" + index;
        let transferTypeContainerId = "compare-transfer-type-element-" + index;

        this.createCompareTransferTypeElements(transferOption??'redirect',transferTypeContainerId,pageId,backPageId,index);
        console.log(transferOptionId);
        document.getElementById(transferOptionId).addEventListener('change',  (event)=> {
            let selectedValue = event.target.value;
            removeAllChildren(transferTypeContainerId);
            this.createCompareTransferTypeElements(selectedValue,transferTypeContainerId,pageId,backPageId,index);
        });
    }
    createCompareTransferTypeElements(selectedValue,transferTypeContainerId,pageId,backPageId,index) {
        if (selectedValue === 'redirect') {

            let optionsHtml='';
            if (children){
                optionsHtml=children.map(page=>`<option value="${page.id}" ${pageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')

            }
            document.getElementById(transferTypeContainerId).innerHTML = `<div class="form-group  mb-3">
                    <label for="compare-api-transfer-page-id-${index}">Transfer page id:</label>
                    <select class="form-control" name="compare_api_transfer_page_id[]" id="compare-api-transfer-page-id-${index}">
                       ${optionsHtml}
                    </select>
                </div>`;
        }
        if (selectedValue === 'goto') {

            let gotoOptionsHtml='';
            let backOptionsHtml='';
            if (typeof allPages!=="undefined"){
                gotoOptionsHtml=allPages.map(page=>`<option value="${page.id}" ${pageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')
                backOptionsHtml=allPages.map(page=>`<option value="${page.id}" ${backPageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')
            }

  document.getElementById(transferTypeContainerId).innerHTML = ` <div class="form-group  mb-3">
                    <label for="compare-api-goto-page-id-${index}">Goto page id:</label>
                    <select class="form-control"  name="compare_api_goto_page_id[]" id="compare-api-goto-page-id-${index}" > ${gotoOptionsHtml}</select>
                </div>
                <div class="form-group  mb-3">
               <label for="compare-api-back-page-id-${index}">Back page id:</label>
              <select class="form-control"  name="compare_api_back_page_id[]" id="compare-api-back-page-id-${index}" >
             <option value="" <option value="" selected>No Page</option>

             ${backOptionsHtml}</select>
                </div>`;


            const gotoPage = document.getElementById(`compare-api-goto-page-id-${index}`);
            const backPage = document.getElementById(`compare-api-back-page-id-${index}`);
            gotoPage.addEventListener('change', function () {
                const selectedValue = gotoPage.value;
                for (let i = 0; i < backPage.options.length; i++) {
                    backPage.options[i].disabled = false;
                }
                for (let i = 0; i < backPage.options.length; i++) {
                    if (backPage.options[i].value === selectedValue) {
                        backPage.options[i].disabled = true;
                        break;
                    }
                }
            });
            backPage.addEventListener('change', function () {
                const selectedValue = backPage.value;
                for (let i = 0; i < gotoPage.options.length; i++) {
                    gotoPage.options[i].disabled = false;
                }
                for (let i = 0; i < gotoPage.options.length; i++) {
                    if (gotoPage.options[i].value === selectedValue) {
                        gotoPage.options[i].disabled = true;
                        break;
                    }
                }
            });

        }
    }


}
