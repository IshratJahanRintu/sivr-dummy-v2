/**
 * @script For Element Type Dropdown Toggle in page element add form
 */
let elementProperties = null;
let children=null;
if (typeof pageElement !== 'undefined') {
    console.log(pageElement);

    elementProperties = JSON.parse(pageElement.element_properties);
    console.log(elementProperties);

}
if (typeof sivrPage!=="undefined"){
    console.log(sivrPage);
  children=sivrPage.children;
  console.log(children);
}


// Function to remove all child elements of a specific container
function removeAllChildren(containerId) {
    let container = document.getElementById(containerId);
    container.innerHTML = '';
}
function removeLastField(container) {
    if (container.lastChild) {
        container.removeChild(container.lastChild);

    }
}

// Create a map of selected values to corresponding functions
let valueToFunctionMap = {
    button: createInputFieldsForButton,
    navigation_dynamic:createInputFieldsForDynamicNavigationButton,
    confirm:createInputFieldsForConfirmButton,
    resend:createInputFieldsForResendButton,
    static:createInputFieldsForStaticButtonTitle,
    api:createInputFieldsForDynamicButtonTitle,

    paragraph: createInputFieldsForParagraph,
    hyperlink: createInputFieldsForHyperlink,
    table: createInputFieldsForTable,
    dynamic_horizontal: createInputFieldsForDynamicTable,
    dynamic_vertical: createInputFieldsForDynamicTable,
    compare_api: createInputFieldsForCompareApi,
    compare_elements: createCompareApiElements,
    input: createInputFieldsForInputType,
    input_text: createInputFieldsForInputTypeText,
    input_number: createInputFieldsForInputTypeNumber,
    input_password: createInputFieldsForInputTypePassword,
    input_select: createInputFieldsForInputTypeSelect,
    input_select_elements: createInputSelectElements,
    input_radio: createInputFieldsForInputTypeRadio,
    input_radio_elements: createInputRadioElements,
    input_checkbox: createInputFieldsForInputTypeCheckbox,
    input_checkbox_elements: createInputCheckboxElements,
    input_pin: createInputFieldsForInputTypePIN,
    input_otp: createInputFieldsForInputTypeOTP,
    input_expire_date: createInputFieldsForInputTypeExpireDate,
};

function createInputFieldsForButton(containerId) {
    let type = 'navigation_static';
    // let value = '';
    // let apiKey = '';
    // let apiDataComparison = '';
    // let apiDataCalculation = '';
    let transferOption = 'redirect';
    let transferPageId = '';
    let gotoPageId='';
    let backPageId='';
    let buttonTitleEn='';
    let buttonTitleBan='';
    if (elementProperties) {
        type = elementProperties.button_type ?? '';
        // value = elementProperties.button_value ?? '';
        // apiKey = elementProperties.button_api_keys ?? '';
        // apiDataComparison = elementProperties.button_api_data_comparison ?? '';
        // apiDataCalculation = elementProperties.button_api_data_calculation ?? '';
        transferOption = elementProperties.button_transfer_options ?? 'redirect';
        transferPageId = elementProperties.button_transfer_page_id ?? '';
        gotoPageId= elementProperties.button_goto_page_id ?? '';
        backPageId= elementProperties.button_back_page_id ?? '';


    }
    // <div class="form-group col-md-4 mb-3">
    //     <label for="button-value">Value:</label>
    //     <input class="form-control" type="text" name="button_value" id="button-value" value="${value}">
    // </div>
    // <div class="form-group col-md-4 mb-3">
    //     <label for="button-api-keys">Api keys:</label>
    //     <input class="form-control" type="text" name="button_api_keys" id="button-api-keys" value="${apiKey}">
    // </div>
    // <div class="form-group col-md-4 mb-3">
    //     <label for="button-api-data-comparison">API Data Comparison:</label>
    //     <input class="form-control" type="text" name="button_api_data_comparison" id="button-api-data-comparison" value="${apiDataComparison}">
    // </div>
    // <div class="form-group col-md-4 mb-3">
    //     <label for="button-api-data-calculation">API Data Calculation:</label>
    //     <input class="form-control" type="text" name="button_api_data_calculation" id="button-api-data-calculation" value="${apiDataCalculation}">
    // </div>
    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="button-type">Button Type:</label>
                                                            <select name="button_type" id="button-type"
                                                                    class="form-control">
                                                                <option value="navigation_static" ${type === 'navigation_static' ? 'selected' : ''}>
                                                                        Navigation Static
                                                                </option>
                                                                <option value="navigation_dynamic" ${type === 'navigation_dynamic' ? 'selected' : ''}>
                                                                        Navigation Dynamic
                                                                </option>
                                                                <option value="submit" ${type === 'submit' ? 'selected' : ''}>
                                                                    Submit
                                                                </option>
                                                                <option value="confirm" ${type === 'confirm' ? 'selected' : ''}>
                                                                   Confirm
                                                                </option>

                                                                <option value="resend" ${type === 'resend' ? 'selected' : ''}>Resend</option>

                                                            </select>
                                                            </div>

                                                            </div>
                                                            <div class="g-create-form">

                                                             <div id="button-type-wise-value" class="row ">
                                                            </div>
                                                            <div class="row" id="button-title-container">

                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="button-transfer-options">Transfer options:</label>
                                                                <select class="form-control"  name="button_transfer_options" id="button-transfer-options">
                                                                    <option value="redirect" ${transferOption === 'redirect' ? 'selected' : ''}>Redirect Page</option>
                                                                    <option value="goto" ${transferOption === 'goto' ? 'selected' : ''}>Goto Page</option>
                                                                </select>
                                                            </div>
                                                            <div id="button-transfer-type-element">


                                                            </div>
`;
    createInputFieldsForStaticButtonTitle();
    let createInitialInputFields=valueToFunctionMap[type];
if(createInitialInputFields){
    createInitialInputFields('button-type-wise-value');
}

    document.getElementById('button-type').addEventListener('change',function () {
        createInputFieldsForStaticButtonTitle();
        let selectedValue=this.value;
        containerId='button-type-wise-value';
        removeAllChildren(containerId);
        // Get the function for the selected value from the map
        let createInputFieldsFunction = valueToFunctionMap[selectedValue];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId);

        }

    })
    createElementsForTransferPageId(transferOption, 'button-transfer-type-element',transferOption==='redirect'? transferPageId:gotoPageId,backPageId);
    document.getElementById('button-transfer-options').addEventListener('change', function () {
        let selectedValue = this.value;
        let containerId = "button-transfer-type-element";
        removeAllChildren(containerId);
        createElementsForTransferPageId(selectedValue, containerId, selectedValue==='redirect'? transferPageId:gotoPageId,backPageId);

    });
}
function createInputFieldsForDynamicNavigationButton(containerId) {
    let titleType = 'static';



    if (elementProperties) {
        titleType = elementProperties.button_title_type ?? 'static';



    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="button-title-type">Title type:</label>
                                                                <select class="form-control"  name="button_title_type" id="button-title-type">
                                                                    <option value="api" ${titleType === 'api' ? 'selected' : ''}>Api</option>
                                                                    <option value="static" ${titleType === 'static' ? 'selected' : ''}>Static</option>
                                                                </select>
                                                            </div>






`;

let createInitialButtonTitle=valueToFunctionMap[titleType];
if(createInitialButtonTitle){
    createInitialButtonTitle();
}
document.getElementById('button-title-type').addEventListener('change',function(){
    let selectedValue=this.value;
    let createButtonTitle=valueToFunctionMap[selectedValue];
    if(createButtonTitle){
        createButtonTitle();
    }
    })

}

function createInputFieldsForStaticButtonTitle(){
    let buttonTitleEn='';
    let buttonTitleBan='';
    if (elementProperties) {
        buttonTitleEn = elementProperties.button_title_english ?? '';
        buttonTitleBan=elementProperties.button_title_bangla??'';
    }
    document.getElementById('button-title-container').innerHTML=`


                                                               <div class="form-group col-md-4 mb-3" id="button-title-english">
                                                                   <label for="button-title-en">Button Title(EN):</label>
                                                                   <input type="text" class="form-control"  name="button_title_english" id="button-title-en" value="${buttonTitleEn}">

                                                               </div>
                                                                <div class="form-group col-md-4 mb-3"  id="button-title-bangla">
                                                                   <label for="button-title-ban">Button Title(BN):</label>
                                                                   <input type="text" class="form-control"  name="button_title_bangla" id="button-title-ban" value="${buttonTitleBan}">

                                                               </div>`;
}
function createInputFieldsForDynamicButtonTitle(){
    let buttonValueApiKey='';
    let buttonTitleEn='';
    let buttonTitleBan='';
    if (elementProperties) {
        buttonValueApiKey = elementProperties.button_value_api_key ?? '';
        buttonTitleEn = elementProperties.button_api_title_english ?? '';
        buttonTitleBan=elementProperties.button_api_title_bangla??'';
    }
    document.getElementById('button-title-container').innerHTML=`
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="button-value-api-key">Button value Api Key:</label>
                                                                <input type="text" class="form-control"  name="button_value_api_key" id="button-value-api-key" value="${buttonValueApiKey}">

                                                            </div><div class="form-group col-md-4 mb-3" >
                                                                <label for="button-api-title-en">Button Api Title Key(EN):</label>
                                                                <input type="text" class="form-control"  name="button_api_title_english" id="button-api-title-en" value="${buttonTitleEn}">

                                                            </div>
                                                             <div class="form-group col-md-4 mb-3"  >
                                                                <label for="button-api-title-ban">Button Api Title Key(BN):</label>
                                                                <input type="text" class="form-control"  name="button_api_title_bangla" id="button-api-title-ban" value="${buttonTitleBan}">

                                                            </div>`;
}
function createInputFieldsForConfirmButton(containerId) {
   let buttonConfirmationMessageEnglish='';
let buttonConfirmationMessageBangla='';
    if (elementProperties) {
        buttonConfirmationMessageEnglish = elementProperties.button_confirmation_message_english ?? '';
        buttonConfirmationMessageBangla=elementProperties.button_confirmation_message_bangla??'';
    }

    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                                <label for="button-confirmation-message-en">Button Confirmation Message (EN):</label>
                                                                <input type="text" class="form-control"  name="button_confirmation_message_english" id="button-confirmation-message-en" value="${buttonConfirmationMessageEnglish}">

                                                            </div>
                                                             <div class="form-group col-md-4 mb-3">
                                                                <label for="button-confirmation-message-ban">Button Confirmation Message (BAN):</label>
                                                                <input type="text" class="form-control"  name="button_confirmation_message_bangla" id="button-confirmation-message-ban" value="${buttonConfirmationMessageBangla}">

                                                            </div>



`;


}

function createInputFieldsForResendButton(containerId) {
    let OtpResendMessageEnglish='';
    let OtpResendMessageBangla='';
    let otpResendTime=1;
    if (elementProperties) {
        OtpResendMessageEnglish = elementProperties.button_otp_resend_message_english ?? '';
        OtpResendMessageBangla=elementProperties.button_otp_resend_message_bangla??'';
        otpResendTime=elementProperties.button_otp_resend_time??1;
    }

    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                                <label for="button-otp-resend-message-en">OTP Resend Message (EN):</label>
                                                                <input type="text" class="form-control"  name="button_otp_resend_message_english" id="button-otp-resend-message-en" value="${OtpResendMessageEnglish}">

                                                            </div>
                                                             <div class="form-group col-md-4 mb-3">
                                                                <label for="button-otp-resend-message-ban">OTP Resend Confirmation Message (BAN):</label>
                                                                <input type="text" class="form-control"  name="button_otp_resend_message_bangla" id="button-otp-resend-message-ban" value="${OtpResendMessageBangla}">

                                                            </div>
                                                             <div class="form-group col-md-4 mb-3">
                                                                <label for="otp-resend-time">OTP Resend Time (Minute):</label>
                                                                <input type="number" class="form-control"  name="button_otp_resend_time" id="otp-resend-time" value="${otpResendTime}">

                                                            </div>



`;


}
function createElementsForTransferPageId(selectedValue, containerId, pageId,backPageId) {

    if (selectedValue === 'redirect') {
        let optionsHtml='';
        if (children){
             optionsHtml=children.map(page=>`<option value="${page.id}" ${pageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')

        }
       document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="button-redirect-to">Transfer page id:</label>
                                                                <select class="form-control"  name="button_transfer_page_id" id="button-redirect-to">
                                                                    ${optionsHtml}

                                                                </select>
                                                            </div>`;
    }
    if (selectedValue === 'goto') {
        let optionsHtml='';
        let backOptionsHtml='';
        if (typeof allPages!=="undefined"){
         optionsHtml=allPages.map(page=>`<option value="${page.id}" ${pageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')
            backOptionsHtml=allPages.map(page=>`<option value="${page.id}" ${backPageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')
        }
        document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="button-go-to">Go to:</label>
                                                                <select class="form-control"  name="button_goto_page_id" id="button-go-to">
                                                                    ${optionsHtml}

                                                                </select>
                                                            </div>
 <div class="form-group col-md-4 mb-3">
               <label for="button-back-page-id">Back page id:</label>
              <select class="form-control"  name="button_back_page_id" id="button-back-page-id" >
             <option value="" <option value="" selected>No Page</option>

             ${backOptionsHtml}</select>`;
    }
}

function createInputFieldsForParagraph(containerId) {
    let apiKey = '';
    let apiDataComparison = '';
    let apiDataCalculation = '';
    if (elementProperties) {
        apiKey = elementProperties.paragraph_api_keys ?? '';
        apiDataComparison = elementProperties.paragraph_api_data_comparison ?? '';
        apiDataCalculation = elementProperties.paragraph_api_data_calculation ?? '';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="paragraph-api-keys">Api keys:</label>
                                                                <input class="form-control" type="text" name="paragraph_api_keys" id="paragraph-api-keys" value="${apiKey}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="paragraph-api-data-comparison">API Data Comparison:</label>
                                                                <input class="form-control" type="text" name="paragraph_api_data_comparison" id="paragraph-api-data-comparison" value="${apiDataComparison}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="paragraph-api-data-calculation">API Data Calculation:</label>
                                                                <input class="form-control" type="text" name="paragraph_api_data_calculation" id="paragraph-api-data-calculation" value="${apiDataCalculation}">
                                                            </div>
`;
}

function createInputFieldsForHyperlink(containerId) {
    let webAddressBn = '';
    let webAddressEn = '';
    if (elementProperties) {
        webAddressBn = elementProperties.paragraph_web_address_bn ?? '';
        webAddressEn = elementProperties.paragraph_web_address_en ?? '';

    }
    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                                <label for="paragraph-web-address-bn">Web Address (BN) :</label>
                                                                <input class="form-control" type="text" name="paragraph_web_address_bn" id="paragraph-web-address-bn" value="${webAddressBn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="paragraph-web-address-en">Web Address (EN) :</label>
                                                                <input class="form-control" type="text" name="paragraph_web_address_en" id="paragraph-web-address-en" value="${webAddressEn}">
                                                            </div>
                                                                `;
}


function createInputFieldsForTable(containerId) {
    let type = null;
    let headingBn = '';
    let headingEn = '';
    if (elementProperties) {
        type = elementProperties.table_type ?? '';
        headingBn = elementProperties.table_heading_bn ?? '';
        headingEn = elementProperties.table_heading_en ?? '';

    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                            <label for="table-type">Table Type:</label>
                                                            <select name="table_type" id="table-type"
                                                                    class="form-control">
                                                                <option value="static" ${type === 'static' ? 'selected' : ''}>
                                                                        Static
                                                                </option>
                                                                <option value="dynamic_horizontal" ${type === 'dynamic_horizontal' ? 'selected' : ''}>
                                                                    Dynamic Horizontal
                                                                </option>
                                                                <option value="dynamic_vertical" ${type === 'dynamic_vertical' ? 'selected' : ''}>
                                                                   Dynamic Vertical
                                                                </option>
                                                            </select>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="table-heading-bn">Table Heading (BN) :</label>
                                                                <input class="form-control" type="text" name="table_heading_bn" id="table-heading-bn" value="${headingBn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="table-heading-en">Table Heading (EN) :</label>
                                                                <input class="form-control" type="text" name="table_heading_en" id="table-heading-en" value="${headingEn}">
                                                            </div>

                                                            <div class="g-create-form">
                                                            <div id="table-type-wise-value" class="row">

                                                            </div>
                                                        </div>

    `;
    if (type){
        let createInitialFields = valueToFunctionMap[type];
        createInitialFields('table-type-wise-value');
    }


    document.getElementById('table-type').addEventListener('change', function () {
        let selectedValue = this.value;
        let containerId = 'table-type-wise-value';

        // Remove all existing input fields from the container
        removeAllChildren(containerId);

        // Get the function for the selected value from the map
        let createInputFieldsFunction = valueToFunctionMap[selectedValue];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId);

        }

    });
}

function createInputFieldsForDynamicTable(containerId) {
    let keyId = '';
    let keyComparison = '';
    let keyCalculation = '';
    if (elementProperties) {
        keyId = elementProperties.table_key_id ?? '';
        keyComparison = elementProperties.table_key_comparison ?? '';
        keyCalculation = elementProperties.table_key_calculation ?? '';

    }

    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                                <label for="table-key-id">Key id: :</label>
                                                                <input class="form-control" type="text" name="table_key_id" id="table-key-id" value="${keyId}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="table-key-comparison">Key Comparison :</label>
                                                                <input class="form-control" type="text" name="table_key_comparison" id="table-key-comparison" value="${keyComparison}">
                                                            </div>
                                                             <div class="form-group col-md-4 mb-3">
                                                                <label for="table-key-calculation">Key Calculation :</label>
                                                                <input class="form-control" type="text" name="table_key_calculation" id="table-key-calculation" value="${keyCalculation}">
                                                            </div>

`;
}

function createInputFieldsForCompareApi(containerId) {
    let createdElements = [];
    let count = 1;



    if (elementProperties && elementProperties.compare_count) {
        count = elementProperties.compare_count;
    }


    document.getElementById(containerId).innerHTML = `
        <div class="form-group col-md-4 mb-3">
            <label for="compare-count">Compare Count:</label>
            <input class="form-control" name="compare_count" id="compare-count" type="number" min="1" max="10" value="${count}">
        </div>

        <div class="g-create-form">
            <div id="compare-api-elements"></div>
        </div>`;

    let initialCompareElementsCreation = valueToFunctionMap['compare_elements'];
    initialCompareElementsCreation('compare-api-elements', createdElements, count);

    // Adding or removing input fields on count value change
    document.getElementById('compare-count').addEventListener('change', function () {
        let countValue = this.value;
        let containerId = 'compare-api-elements';

        // Get the function from the map
        let createInputFieldsFunction = valueToFunctionMap['compare_elements'];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId, createdElements, countValue);
        }
    });
}

function createCompareApiElements(containerId, createdElements, countValue) {
    countValue = parseInt(countValue);


    const container = document.getElementById(containerId);

    // Add or remove input fields based on the countValue
    while (createdElements.length < countValue) {
        addField(createdElements.length + 1, container);
    }

    while (createdElements.length > countValue) {
        removeLastField(container);
        createdElements.pop();
    }


    function addField(index, container) {
        let keyValue ='';
        let comparison = '';
        let apiDataCalculation ='';
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

        createCompareTransferTypeElements(transferOption??'redirect',transferTypeContainerId,pageId,backPageId,index);
        console.log(transferOptionId);
        document.getElementById(transferOptionId).addEventListener('change', function () {
            let selectedValue = this.value;
            removeAllChildren(transferTypeContainerId);
            createCompareTransferTypeElements(selectedValue,transferTypeContainerId,pageId,backPageId,index);
        });
    }


}

function createCompareTransferTypeElements(selectedValue,transferTypeContainerId,pageId,backPageId,index) {
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
    }
}
function createInputFieldsForInputType(containerId) {
    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="input-type">Input Type:</label>
                                                            <select name="input_type" id="input-type"
                                                             class="form-control">
                                                                <option value="input_text" ${elementProperties  && elementProperties.input_type === 'input_text' ? 'selected' : ''}>Text</option>
                                                                <option value="input_number" ${elementProperties  && elementProperties.input_type === 'input_number' ? 'selected' : ''} > Number</option>
                                                                <option value="input_password" ${elementProperties  && elementProperties.input_type === 'input_password' ? 'selected' : ''}>Password</option>
                                                                <option value="input_select" ${elementProperties  && elementProperties.input_type === 'input_select' ? 'selected' : ''}>Select</option>
                                                                <option value="input_radio" ${elementProperties  && elementProperties.input_type === 'input_radio' ? 'selected' : ''}> Radio</option>
                                                                <option value="input_checkbox" ${elementProperties  && elementProperties.input_type === 'input_checkbox' ? 'selected' : ''}>Checkbox</option>
                                                                <option value="input_pin" ${elementProperties  && elementProperties.input_type === 'input_pin' ? 'selected' : ''}>Tpin/Pin</option>
                                                                <option value="input_otp" ${elementProperties  && elementProperties.input_type === 'input_otp' ? 'selected' : ''}>OTP</option>
                                                                <option value="input_expire_date" ${elementProperties  && elementProperties.input_type === 'input_expire_date' ? 'selected' : ''}>Expire date</option>
                                                                </select>
                                                      </div>
                                                       <div class="g-create-form">
                                                            <div id="input-type-wise-value" class="row">

                                                            </div>
                                                        </div>

`;

    let initialInputTypeElementCreation = null;
    if (elementProperties && elementProperties.input_type) {
        console.log(elementProperties.input_type);
        initialInputTypeElementCreation = valueToFunctionMap[elementProperties.input_type];
    } else {
        initialInputTypeElementCreation = valueToFunctionMap["input_text"];
    }


    initialInputTypeElementCreation('input-type-wise-value');
    document.getElementById('input-type').addEventListener('change', function () {
        let selectedValue = this.value;
        let containerId = 'input-type-wise-value';

        // Remove all existing input fields from the container
        removeAllChildren(containerId);

        // Get the function for the selected value from the map
        let createInputFieldsFunction = valueToFunctionMap[selectedValue];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId);

        }
    });

}

function createInputFieldsForInputTypeText(containerId) {
    let placeholderBn='';
    let placeholderEn='';
    let minLength=1;
    let maxLength=1;
    let pattern='';
    let defaultValue='';
    let required='';
    if(elementProperties){
        placeholderBn=elementProperties.input_text_placeholder_bn??'';
        placeholderEn=elementProperties.input_text_placeholder_en??'';
        minLength=elementProperties.input_text_min_length??1;
        maxLength=elementProperties.input_text_max_length??1;
        pattern=elementProperties.input_text_pattern??'';
        defaultValue=elementProperties.input_text_default_value??'';
        required=elementProperties.input_text_required??'';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="input-text-placeholder-bn">Placeholder (Bn) :</label>
                                                                <input class="form-control" type="text" name="input_text_placeholder_bn" id="input-text-placeholder-bn" value="${placeholderBn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-text-placeholder-en">Placeholder (En) :</label>
                                                                <input class="form-control" type="text" name="input_text_placeholder_en" id="input-text-placeholder-en" value="${placeholderEn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-text-min-length">Min length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_text_min_length" id="input-text-min-length" value="${minLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-text-max-length">Max length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_text_max_length" id="input-text-max-length" value="${maxLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-text-pattern">Pattern :</label>
                                                                <input class="form-control" type="text" name="input_text_pattern" id="input-text-pattern" value="${pattern}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-text-default-value">Default value :</label>
                                                                <input class="form-control" type="text" name="input_text_default_value" id="input-text-default-value" value="${defaultValue}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-text-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_text_required" id="input-text-required" value="Y" ${required==='Y'?'checked':''}>
                                                            </div>`;
}

function createInputFieldsForInputTypeNumber(containerId) {
    let placeholderBn='';
    let placeholderEn='';
    let minLength=1;
    let maxLength=1;
    let pattern='';
    let defaultValue='';
    let required='';
    if(elementProperties){
        placeholderBn=elementProperties.input_number_placeholder_bn??'';
        placeholderEn=elementProperties.input_number_placeholder_en??'';
        minLength=elementProperties.input_number_min_length??1;
        maxLength=elementProperties.input_number_max_length??1;
        pattern=elementProperties.input_number_pattern??'';
        defaultValue=elementProperties.input_number_default_value??'';
        required=elementProperties.input_number_required??'';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="input-number-placeholder-bn">Placeholder (Bn) :</label>
                                                                <input class="form-control" type="text" name="input_number_placeholder_bn" id="input-number-placeholder-bn" value="${placeholderBn}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-number-placeholder-en">Placeholder (En) :</label>
                                                                <input class="form-control" type="text" name="input_number_placeholder_en" id="input-number-placeholder-en" value="${placeholderEn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-number-min-length">Min Value :</label>
                                                                <input class="form-control" type="number" min="1" name="input_number_min_length" id="input-number-min-length" value="${minLength}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-number-max-length">Max Value :</label>
                                                                <input class="form-control" type="number" min="1" name="input_number_max_length" id="input-number-max-length" value="${maxLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-number-pattern">Pattern :</label>
                                                                <input class="form-control" type="text" name="input_number_pattern" id="input-number-pattern" value="${pattern}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-number-default-value">Default value :</label>
                                                                <input class="form-control" type="text" name="input_number_default_value" id="input-number-default-value" value="${defaultValue}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-number-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_number_required" id="input-number-required" value="Y" ${required==='Y'?'checked':''}>
                                                            </div>`;
}

function createInputFieldsForInputTypePassword(containerId) {
    let placeholderBn='';
    let placeholderEn='';
    let minLength=1;
    let maxLength=1;
    let pattern='';
    let defaultValue='';
    let required='';
    if(elementProperties){
        placeholderBn=elementProperties.input_password_placeholder_bn??'';
        placeholderEn=elementProperties.input_password_placeholder_en??'';
        minLength=elementProperties.input_password_min_length??1;
        maxLength=elementProperties.input_password_max_length??1;
        pattern=elementProperties.input_password_pattern??'';
        defaultValue=elementProperties.input_password_default_value??'';
        required=elementProperties.input_password_required??'';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="input-password-placeholder-bn">Placeholder (Bn) :</label>
                                                                <input class="form-control" type="text" name="input_password_placeholder_bn" id="input-password-placeholder-bn" ${placeholderBn}>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-password-placeholder-en">Placeholder (En) :</label>
                                                                <input class="form-control" type="text" name="input_password_placeholder_en" id="input-password-placeholder-en" ${placeholderEn}>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-password-min-length">Min length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_password_min_length" id="input-password-min-length" ${minLength}>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-password-max-length">Max length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_password_max_length" id="input-password-max-length" ${maxLength}>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-password-pattern">Pattern :</label>
                                                                <input class="form-control" type="text" name="input_password_pattern" id="input-password-pattern" ${pattern}>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-password-default-value">Default value :</label>
                                                                <input class="form-control" type="text" name="input_password_default_value" id="input-password-default-value" ${defaultValue}>
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-password-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_password_required" id="input-password-required" value="Y" ${required==='Y'?'checked':''}>
                                                            </div>`;
}


function createInputFieldsForInputTypeSelect(containerId) {
    let count = 1;
    let createdElements = [];
    if (elementProperties && elementProperties.input_select_count) {
        count = parseInt(elementProperties.input_select_count);
    }
    document.getElementById(containerId).innerHTML = `
                                                 <div class="form-group col-md-4 mb-3">
                                                        <label for="input-select-count">Count :</label>
                                                                <input class="form-control" type="number" min="1" name="input_select_count" id="input-select-count" value="${count}">
                                                            </div>
                                                            <div class="g-create-form">

                                                              <div id="input-select-elements" >

                                                               </div>
                                                            </div>

                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-select-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_select_required" id="input-select-required" value="Y">
                                                            </div>`;
    let initialSelectElementsCreation = valueToFunctionMap['input_select_elements'];
    initialSelectElementsCreation('input-select-elements', createdElements, count);


    // Adding or removing input fields on count value change
    document.getElementById('input-select-count').addEventListener('change', function () {
        let countValue = this.value;
        let containerId = 'input-select-elements';

        // Get the function from the map
        let createInputFieldsFunction = valueToFunctionMap['input_select_elements'];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId, createdElements, countValue);
        }
    });
}

function createInputSelectElements(containerId, createdElements, countValue) {
    countValue = parseInt(countValue);
    console.log(countValue);
    const container = document.getElementById(containerId);

    // Add or remove input fields based on the countValue
    while (createdElements.length < countValue) {
        addField(createdElements.length + 1, container);
    }

    while (createdElements.length > countValue) {
        removeLastField(container);
        createdElements.pop();
    }


    function addField(i, container) {
        let optionBn = '';
        let optionEn = '';
        let selectValue = '';
        if (elementProperties && elementProperties.select_values && elementProperties.select_values[i - 1]) {
            optionBn = elementProperties.select_values[i - 1]['option_bn'];
            optionEn = elementProperties.select_values[i - 1]['option_en'];
            selectValue = elementProperties.select_values[i - 1]['value'];
        }

        let containerDiv = document.createElement('div');
        containerDiv.classList.add("col-md-4", "mb-3", "form-group");
        containerDiv.innerHTML = `<label >Select value ${i}:</label>
                                   <input type="text" name="input_select_option_bn[]" id="input-select-option-bn-${i}" class="col-md-4 form-control mb-2" placeholder="Option BN" required value="${optionBn}">
                                   <input type="text" name="input_select_option_en[]" id="input-select-option-en-${i}" class="col-md-4 form-control mb-2" placeholder="Option EN" required value="${optionEn}">
                                   <input type="text" name="input_select_value[]" id="input-select-value-${i}" class="col-md-4 form-control mb-2" placeholder="Value" required value="${selectValue}">
                                   `;
        container.appendChild(containerDiv);

        createdElements.push(containerDiv);


    }
}

function createInputFieldsForInputTypeRadio(containerId) {
    let count = 1;
    let createdElements = [];
    if (elementProperties && elementProperties.input_radio_count) {
        count = parseInt(elementProperties.input_radio_count);
    }

    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                              <label for="input-radio-count">Count :</label>
                                                                <input class="form-control" type="number" min="1" name="input_radio_count" id="input-radio-count" value="${count}">
                                                            </div>
                                                            <div class="g-create-form">

                                                              <div id="input-radio-elements" >

                                                                 </div>
                                                        </div>`;
    let initialRadioElementsCreation = valueToFunctionMap['input_radio_elements'];
    initialRadioElementsCreation('input-radio-elements', createdElements, count);


    // Adding or removing input fields on count value change
    document.getElementById('input-radio-count').addEventListener('change', function () {
        let countValue = this.value;
        let containerId = 'input-radio-elements';

        // Get the function from the map
        let createInputFieldsFunction = valueToFunctionMap['input_radio_elements'];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId, createdElements, countValue);
        }
    });
}

function createInputRadioElements(containerId, createdElements, countValue) {

    countValue = parseInt(countValue);

    const container = document.getElementById(containerId);

    // Add or remove input fields based on the countValue
    while (createdElements.length < countValue) {
        addField(createdElements.length + 1, container);
    }

    while (createdElements.length > countValue) {
        removeLastField(container);
        createdElements.pop();
    }


    function addField(i, container) {
        let radioBnValue = '';
        let radioEnValue = '';
        if (elementProperties && elementProperties.radio_values && elementProperties.radio_values[i - 1]) {
            radioBnValue = elementProperties.radio_values[i - 1]['radio_label_bn'];
            radioEnValue = elementProperties.radio_values[i - 1]['radio_label_en'];
        }

        let containerDiv1 = document.createElement('div');
        containerDiv1.classList.add("col-md-4", "mb-3", "form-group");
        containerDiv1.innerHTML = ` <label for="input-radio-label-bn">Radio label (Bn) ${i}:</label>
                                                           <input class="form-control" type="text" name="input_radio_label_bn[]" id="input-radio-label-bn-${i}" value="${radioBnValue}">
                                                          </div>
                                                              `;
        let containerDiv2 = document.createElement('div');
        containerDiv2.classList.add("col-md-4", "mb-3", "form-group");
        containerDiv2.innerHTML = `<label for="input-radio-label-en">Radio label (En) ${i}:</label>
                                 <input class="form-control" type="text" name="input_radio_label_en[]" id="input-radio-label-en-${i}" value="${radioEnValue}">`;
        container.appendChild(containerDiv1);
        container.appendChild(containerDiv2);
        createdElements.push(containerDiv1);


    }

}

function createInputFieldsForInputTypeCheckbox(containerId) {
    let count = 1;
    let createdElements = [];
    if (elementProperties && elementProperties.input_checkbox_count) {
        count = parseInt(elementProperties.input_checkbox_count);
    }


    document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                                <label for="input-checkbox-count">Count :</label>
                                                                 <input class="form-control" type="number" min="1" name="input_checkbox_count" id="input-checkbox-count" value="${count}">
                                                            </div>
                                                             <div class="g-create-form">

                                                               <div id="input-checkbox-elements" >

                                                                 </div>
                                                        </div>`;
    let initialRadioElementsCreation = valueToFunctionMap['input_checkbox_elements'];
    initialRadioElementsCreation('input-checkbox-elements', createdElements, count);


    // Adding or removing input fields on count value change
    document.getElementById('input-checkbox-count').addEventListener('change', function () {
        let countValue = this.value;
        let containerId = 'input-checkbox-elements';

        // Get the function from the map
        let createInputFieldsFunction = valueToFunctionMap['input_checkbox_elements'];

        if (createInputFieldsFunction) {
            // Call the function to create the new input fields
            createInputFieldsFunction(containerId, createdElements, countValue);
        }
    });
}


function createInputCheckboxElements(containerId, createdElements, countValue) {

    countValue = parseInt(countValue);

    const container = document.getElementById(containerId);

    // Add or remove input fields based on the countValue
    while (createdElements.length < countValue) {
        addField(createdElements.length + 1, container);
    }

    while (createdElements.length > countValue) {
        removeLastField(container);
        createdElements.pop();
    }


    function addField(i, container) {
        let checkboxValue = '';
        if (elementProperties && elementProperties.checkbox_values && elementProperties.checkbox_values[i - 1]) {
            checkboxValue = elementProperties.checkbox_values[i - 1]['checkbox_value'];

        }

        console.log(container);
        let containerDiv = document.createElement('div');
        containerDiv.classList.add("col-md-4", "mb-3", "form-group");
        containerDiv.innerHTML = `  <label for="input-checkbox-value">Checkbox ${i}:</label>
        <input class="form-control" type="text" name="input_checkbox_value[]" id="input-checkbox-value"
        value="${checkboxValue}">`;

        container.appendChild(containerDiv);
        createdElements.push(containerDiv);


    }


}


function createInputFieldsForInputTypePIN(containerId) {
    let placeholderBn='';
    let placeholderEn='';
    let minLength=1;
    let maxLength=1;
    let pattern='';
    let defaultValue='';
    let required='';
    if(elementProperties){
        placeholderBn=elementProperties.input_pin_placeholder_bn??'';
        placeholderEn=elementProperties.input_pin_placeholder_en??'';
        minLength=elementProperties.input_pin_min_length??1;
        maxLength=elementProperties.input_pin_max_length??1;
        pattern=elementProperties.input_pin_pattern??'';
        defaultValue=elementProperties.input_pin_default_value??'';
        required=elementProperties.input_pin_required??'';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="input-pin-placeholder-bn">Placeholder (Bn) :</label>
                                                                <input class="form-control" type="text" name="input_pin_placeholder_bn" id="input-pin-placeholder-bn"  value="${placeholderBn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-pin-placeholder-en">Placeholder (En) :</label>
                                                                <input class="form-control" type="text" name="input_pin_placeholder_en" id="input-pin-placeholder-en" value="${placeholderEn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-pin-min-length">Min length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_pin_min_length" id="input-pin-min-length" value="${minLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-pin-max-length">Max length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_pin_max_length" id="input-pin-max-length" value="${maxLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-pin-pattern">Pattern :</label>
                                                                <input class="form-control" type="text" name="input_pin_pattern" id="input-pin-pattern" value="${pattern}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-pin-default-value">Default value :</label>
                                                                <input class="form-control" type="text" name="input_pin_default_value" id="input-pin-default-value" value="${defaultValue}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-pin-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_pin_required" id="input-pin-required" value="Y" ${required==='Y'?'checked':''}>
                                                            </div>`;
}

function createInputFieldsForInputTypeOTP(containerId) {
    let placeholderBn='';
    let placeholderEn='';
    let minLength=1;
    let maxLength=1;
    let pattern='';
    let defaultValue='';
    let required='';
    if(elementProperties){
        placeholderBn=elementProperties.input_otp_placeholder_bn??'';
        placeholderEn=elementProperties.input_otp_placeholder_en??'';
        minLength=elementProperties.input_otp_min_length??1;
        maxLength=elementProperties.input_otp_max_length??1;
        pattern=elementProperties.input_otp_pattern??'';
        defaultValue=elementProperties.input_otp_default_value??'';
        required=elementProperties.input_otp_required??'';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="input-otp-placeholder-bn">Placeholder (Bn) :</label>
                                                                <input class="form-control" type="text" name="input_otp_placeholder_bn" id="input-otp-placeholder-bn" value="${placeholderBn}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-otp-placeholder-en">Placeholder (En) :</label>
                                                                <input class="form-control" type="text" name="input_otp_placeholder_en" id="input-otp-placeholder-en" value="${placeholderEn}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-otp-min-length">Min length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_otp_min_length" id="input-otp-min-length" value="${minLength}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-otp-max-length">Max length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_otp_max_length" id="input-otp-max-length" value="${maxLength}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-otp-pattern">Pattern :</label>
                                                                <input class="form-control" type="text" name="input_otp_pattern" id="input-otp-pattern" value="${pattern}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-otp-default-value">Default value :</label>
                                                                <input class="form-control" type="text" name="input_otp_default_value" id="input-otp-default-value" value="${defaultValue}" >
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-otp-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_otp_required" id="input-otp-required" value="Y" ${required==='Y'?'checked':''}>
                                                            </div>`;
}

function createInputFieldsForInputTypeExpireDate(containerId) {
    let placeholderBn='';
    let placeholderEn='';
    let minLength=1;
    let maxLength=1;
    let pattern='';
    let defaultValue='';
    let required='';
    if(elementProperties){
        placeholderBn=elementProperties.input_expire_date_placeholder_bn??'';
        placeholderEn=elementProperties.input_expire_date_placeholder_en??'';
        minLength=elementProperties.input_expire_date_min_length??1;
        maxLength=elementProperties.input_expire_date_max_length??1;
        pattern=elementProperties.input_expire_date_pattern??'';
        defaultValue=elementProperties.input_expire_date_default_value??'';
        required=elementProperties.input_expire_date_required??'';
    }
    document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="input-expire-date-placeholder-bn">Placeholder (Bn) :</label>
                                                                <input class="form-control" type="text" name="input_expire_date_placeholder_bn" id="input-expire-date-placeholder-bn" value="${placeholderBn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-expire-date-placeholder-en">Placeholder (En) :</label>
                                                                <input class="form-control" type="text" name="input_expire_date_placeholder_en" id="input-expire-date-placeholder-en" value="${placeholderEn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-expire-date-min-length">Min length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_expire_date_min_length" id="input-expire-date-min-length" value="${minLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-expire-date-max-length">Max length :</label>
                                                                <input class="form-control" type="number" min="1" name="input_expire_date_max_length" id="input-expire-date-max-length" value="${maxLength}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-expire-date-pattern">Pattern :</label>
                                                                <input class="form-control" type="text" name="input_expire_date_pattern" id="input-expire-date-pattern" value="${pattern}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="input-expire-date-default-value">Default value :</label>
                                                                <input class="form-control" type="text" name="input_expire_date_default_value" id="input-expire-date-default-value" value="${defaultValue}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label  for="input-expire-date-required">Required :</label>
                                                                <input class="form-check" type="checkbox" name="input_expire_date_required" id="input-expire-date-required" value="Y" ${required==='Y'?'checked':''}>
                                                            </div>`;
}


//initially create input fields for element type  selected
let initialInputFieldsCreation = typeof pageElement !== 'undefined' && pageElement.type ? valueToFunctionMap[pageElement.type] : valueToFunctionMap['button'];
initialInputFieldsCreation('element-wise-value');
document.getElementById('g-element-type').addEventListener('change', function () {
    let selectedValue = this.value;
    let containerId = 'element-wise-value';

    // Remove all existing input fields from the container
    removeAllChildren(containerId);

    // Get the function for the selected value from the map
    let createInputFieldsFunction = valueToFunctionMap[selectedValue];

    if (createInputFieldsFunction) {
        // Call the function to create the new input fields
        createInputFieldsFunction(containerId);

    }
});
