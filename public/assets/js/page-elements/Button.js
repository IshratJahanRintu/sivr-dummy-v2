class Button {


    constructor(elementProperties = null) {
        this.containerId = 'element-wise-value';
        this.elementProperties = elementProperties;
        this.createInputFieldsForButton = this.createInputFieldsForButton.bind(this);


    }


    createInputFieldsForButton() {

        let type = 'navigation_static';
        // let value = '';
        // let apiKey = '';
        // let apiDataComparison = '';
        // let apiDataCalculation = '';
        let transferOption = 'redirect';
        let transferPageId = '';
        let gotoPageId = '';
        let backPageId = '';
        let buttonTitleEn = '';
        let buttonTitleBan = '';
        if (this.elementProperties) {
            type = this.elementProperties.button_type ?? '';
            // value = elementProperties.button_value ?? '';
            // apiKey = elementProperties.button_api_keys ?? '';
            // apiDataComparison = elementProperties.button_api_data_comparison ?? '';
            // apiDataCalculation = elementProperties.button_api_data_calculation ?? '';
            transferOption = this.elementProperties.button_transfer_options ?? 'redirect';
            transferPageId = this.elementProperties.button_transfer_page_id ?? '';
            gotoPageId = this.elementProperties.button_goto_page_id ?? '';
            backPageId = this.elementProperties.button_back_page_id ?? '';


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
        document.getElementById(this.containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
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
        this.createStaticButtonTitle();
        this.createButtonTypeWiseElement(type);

        let button = new Button(this.elementProperties);
        document.getElementById('button-type').addEventListener('change', function () {
            button.createButtonTitle('static');
            let selectedValue = this.value;
            button.createButtonTypeWiseElement(selectedValue);

        })

        this.createElementsForTransferPageId(transferOption, 'button-transfer-type-element', transferOption === 'redirect' ? transferPageId : gotoPageId, backPageId);
        document.getElementById('button-transfer-options').addEventListener('change', (event) => {
            let selectedValue = event.target.value;
            let containerId = "button-transfer-type-element";
            removeAllChildren(containerId);
            this.createElementsForTransferPageId(selectedValue, containerId, selectedValue === 'redirect' ? transferPageId : gotoPageId, backPageId);

        });
    }


    createButtonTypeWiseElement(type) {
        console.log(this);
        let typeToFunctionMap = {
            navigation_dynamic: this.createInputFieldsForDynamicNavigationButton,
            confirm: this.createInputFieldsForConfirmButton,
            resend: this.createInputFieldsForResendButton,
        }
        let containerId = 'button-type-wise-value';
        removeAllChildren(containerId);
        // Get the function for the selected value from the map
        let createElement = typeToFunctionMap[type];

        if (createElement) {
            // Call the function to create the new input fields
            createElement.call(this, containerId);

        }


    }

    createButtonTitle(type) {
        console.log(this);
        let titleTypeToFunctionMap = {
            static: this.createStaticButtonTitle,
            api: this.createDynamicButtonTitle,
        }
        let createButtonTitleFunction = titleTypeToFunctionMap[type];
        if (createButtonTitleFunction) {

            createButtonTitleFunction.call(this);
        }
    }

    createInputFieldsForDynamicNavigationButton(containerId) {
        console.log(this);
        let titleType = 'static';

        if (this.elementProperties) {
            titleType = this.elementProperties.button_title_type ?? 'static';

        }

        document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="button-title-type">Title type:</label>
                                                                <select class="form-control"  name="button_title_type" id="button-title-type">
                                                                    <option value="api" ${titleType === 'api' ? 'selected' : ''}>Api</option>
                                                                    <option value="static" ${titleType === 'static' ? 'selected' : ''}>Static</option>
                                                                </select>
                                                            </div>

`;

        this.createButtonTitle(titleType);
        const button = new Button(this.elementProperties);
        document.getElementById('button-title-type').addEventListener('change', function () {
            let selectedValue = this.value;
            button.createButtonTitle(selectedValue);
        })

    }

    createInputFieldsForConfirmButton(containerId) {
        let buttonConfirmationMessageEnglish = '';
        let buttonConfirmationMessageBangla = '';
        if (this.elementProperties) {
            buttonConfirmationMessageEnglish = this.elementProperties.button_confirmation_message_english ?? '';
            buttonConfirmationMessageBangla = this.elementProperties.button_confirmation_message_bangla ?? '';
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

    createInputFieldsForResendButton(containerId) {
        let OtpResendMessageEnglish = '';
        let OtpResendMessageBangla = '';
        let otpResendTime = 1;
        if (this.elementProperties) {
            OtpResendMessageEnglish = this.elementProperties.button_otp_resend_message_english ?? '';
            OtpResendMessageBangla = this.elementProperties.button_otp_resend_message_bangla ?? '';
            otpResendTime = this.elementProperties.button_otp_resend_time ?? 1;
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

    createStaticButtonTitle() {
        let buttonTitleEn = '';
        let buttonTitleBan = '';
        if (this.elementProperties) {
            buttonTitleEn = this.elementProperties.button_title_english ?? '';
            buttonTitleBan = this.elementProperties.button_title_bangla ?? '';
        }
        document.getElementById('button-title-container').innerHTML = `


                                                               <div class="form-group col-md-4 mb-3" id="button-title-english">
                                                                   <label for="button-title-en">Button Title(EN):</label>
                                                                   <input type="text" class="form-control"  name="button_title_english" id="button-title-en" value="${buttonTitleEn}">

                                                               </div>
                                                                <div class="form-group col-md-4 mb-3"  id="button-title-bangla">
                                                                   <label for="button-title-ban">Button Title(BN):</label>
                                                                   <input type="text" class="form-control"  name="button_title_bangla" id="button-title-ban" value="${buttonTitleBan}">

                                                               </div>`;
    }

    createDynamicButtonTitle() {
        let buttonValueApiKey = '';
        let buttonTitleEn = '';
        let buttonTitleBan = '';
        if (this.elementProperties) {
            buttonValueApiKey = this.elementProperties.button_value_api_key ?? '';
            buttonTitleEn = this.elementProperties.button_api_title_english ?? '';
            buttonTitleBan = this.elementProperties.button_api_title_bangla ?? '';
        }
        document.getElementById('button-title-container').innerHTML = `
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


    createElementsForTransferPageId(selectedValue, containerId, pageId, backPageId) {

        if (selectedValue === 'redirect') {
            let optionsHtml = '';
            if (children) {
                optionsHtml = children.map(page => `<option value="${page.id}" ${pageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')

            }
            document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="button-redirect-to">Transfer page id:</label>
                                                                <select class="form-control"  name="button_transfer_page_id" id="button-redirect-to">
                                                                    ${optionsHtml}

                                                                </select>
                                                            </div>`;
        }
        if (selectedValue === 'goto') {
            let optionsHtml = '';
            let backOptionsHtml = '';
            if (typeof allPages !== "undefined") {
                optionsHtml = allPages.map(page => `<option value="${page.id}" ${pageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')
                backOptionsHtml = allPages.map(page => `<option value="${page.id}" ${backPageId == page.id ? 'selected' : ''} >${page.page_heading_en}</option>`).join('')
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

}


