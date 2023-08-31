class Input {

    constructor() {
        this.containerId = 'element-wise-value';
        this.createInputFieldsForInputType = this.createInputFieldsForInputType.bind(this);
    }

    createInputFieldsForInputType() {
        let inputType = 'input_text';
        if (elementProperties && elementProperties.input_type) {
            inputType = elementProperties.input_type;
        }
        document.getElementById(this.containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="input-type">Input Type:</label>
                                                            <select name="input_type" id="input-type"
                                                             class="form-control">
                                                                <option value="input_text" ${inputType === 'input_text' ? 'selected' : ''}>Text</option>
                                                                <option value="input_number" ${inputType === 'input_number' ? 'selected' : ''} > Number</option>
                                                                <option value="input_password" ${inputType === 'input_password' ? 'selected' : ''}>Password</option>
                                                                <option value="input_select" ${inputType === 'input_select' ? 'selected' : ''}>Select</option>
                                                                <option value="input_radio" ${inputType === 'input_radio' ? 'selected' : ''}> Radio</option>
                                                                <option value="input_checkbox" ${inputType === 'input_checkbox' ? 'selected' : ''}>Checkbox</option>
                                                                <option value="input_pin" ${inputType === 'input_pin' ? 'selected' : ''}>Tpin/Pin</option>
                                                                <option value="input_otp" ${inputType === 'input_otp' ? 'selected' : ''}>OTP</option>
                                                                <option value="input_expire_date" ${inputType === 'input_expire_date' ? 'selected' : ''}>Expire date</option>
                                                                </select>
                                                      </div>
                                                       <div class="g-create-form">
                                                            <div id="input-type-wise-value" class="row">

                                                            </div>
                                                        </div>

`;

        this.createInputTypeWiseFields(inputType);

        document.getElementById('input-type').addEventListener('change', (event) => {
            let selectedValue = event.target.value;
            let containerId = 'input-type-wise-value';

            // Remove all existing input fields from the container
            removeAllChildren(containerId);

            this.createInputTypeWiseFields(selectedValue);
        });

    }

    createInputTypeWiseFields(type) {
        let inputTypeToFunctionMap = {
            input_text: this.createInputFieldsForInputTypeText,
            input_number: this.createInputFieldsForInputTypeNumber,
            input_password: this.createInputFieldsForInputTypePassword,
            input_select: this.createInputFieldsForInputTypeSelect,
            input_radio: this.createInputFieldsForInputTypeRadio,
            input_checkbox: this.createInputFieldsForInputTypeCheckbox,
            input_pin: this.createInputFieldsForInputTypePIN,
            input_otp: this.createInputFieldsForInputTypeOTP,
            input_expire_date: this.createInputFieldsForInputTypeExpireDate,
        }
        let createInputFields = inputTypeToFunctionMap[type];
        if (createInputFields) {
            createInputFields.call(this, 'input-type-wise-value');
        }

    }

    createNestedInputElements(type, containerId, createdElements, countValue) {
        let elementTypeToFunctionMap = {
            select: this.createNestedSelectElements,
            checkbox: this.createNestedCheckboxElements,
            radio: this.createNestedRadioElements,
        }
        countValue = parseInt(countValue);
        console.log(countValue);
        const container = document.getElementById(containerId);

        // Add or remove input fields based on the countValue
        while (createdElements.length < countValue) {
            elementTypeToFunctionMap[type].call(this, createdElements.length + 1, container, createdElements);
        }

        while (createdElements.length > countValue) {
            removeLastField(container);
            createdElements.pop();
        }


    }

    createInputFieldsForInputTypeText(containerId) {
        let placeholderBn = '';
        let placeholderEn = '';
        let minLength = 1;
        let maxLength = 1;
        let pattern = '';
        let defaultValue = '';
        let required = '';
        if (elementProperties) {
            placeholderBn = elementProperties.input_text_placeholder_bn ?? '';
            placeholderEn = elementProperties.input_text_placeholder_en ?? '';
            minLength = elementProperties.input_text_min_length ?? 1;
            maxLength = elementProperties.input_text_max_length ?? 1;
            pattern = elementProperties.input_text_pattern ?? '';
            defaultValue = elementProperties.input_text_default_value ?? '';
            required = elementProperties.input_text_required ?? '';
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
                                                                <input class="form-check" type="checkbox" name="input_text_required" id="input-text-required" value="Y" ${required === 'Y' ? 'checked' : ''}>
                                                            </div>`;
    }

    createInputFieldsForInputTypeNumber(containerId) {
        let placeholderBn = '';
        let placeholderEn = '';
        let minLength = 1;
        let maxLength = 1;
        let pattern = '';
        let defaultValue = '';
        let required = '';
        if (elementProperties) {
            placeholderBn = elementProperties.input_number_placeholder_bn ?? '';
            placeholderEn = elementProperties.input_number_placeholder_en ?? '';
            minLength = elementProperties.input_number_min_length ?? 1;
            maxLength = elementProperties.input_number_max_length ?? 1;
            pattern = elementProperties.input_number_pattern ?? '';
            defaultValue = elementProperties.input_number_default_value ?? '';
            required = elementProperties.input_number_required ?? '';
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
                                                                <input class="form-check" type="checkbox" name="input_number_required" id="input-number-required" value="Y" ${required === 'Y' ? 'checked' : ''}>
                                                            </div>`;
    }

    createInputFieldsForInputTypePassword(containerId) {
        let placeholderBn = '';
        let placeholderEn = '';
        let minLength = 1;
        let maxLength = 1;
        let pattern = '';
        let defaultValue = '';
        let required = '';
        if (elementProperties) {
            placeholderBn = elementProperties.input_password_placeholder_bn ?? '';
            placeholderEn = elementProperties.input_password_placeholder_en ?? '';
            minLength = elementProperties.input_password_min_length ?? 1;
            maxLength = elementProperties.input_password_max_length ?? 1;
            pattern = elementProperties.input_password_pattern ?? '';
            defaultValue = elementProperties.input_password_default_value ?? '';
            required = elementProperties.input_password_required ?? '';
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
                                                                <input class="form-check" type="checkbox" name="input_password_required" id="input-password-required" value="Y" ${required === 'Y' ? 'checked' : ''}>
                                                            </div>`;
    }

    createInputFieldsForInputTypeSelect(containerId) {
        let selectType = 'static';
        if (elementProperties && elementProperties.input_select_type) {
            selectType = elementProperties.input_select_type;
        }
        document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="select-type">Select Type:</label>
                                                            <select name="input_select_type" id="select-type"
                                                             class="form-control">
                                                                <option value="static" ${selectType === 'static' ? 'selected' : ''}>Static</option>
                                                                <option value="api" ${selectType === 'api' ? 'selected' : ''}>Api</option>
                                                                </select>
                                                      </div>
                                                       <div class="g-create-form">
                                                            <div id="select-type-wise-value" class="row">

                                                            </div>
                                                        </div>

`;


        this.createSelectTypeWiseFields(selectType, 'select-type-wise-value');
        document.getElementById('select-type').addEventListener('change', (event) => {
            let selectedValue = event.target.value;
            let containerId = 'select-type-wise-value';

            // Remove all existing input fields from the container
            removeAllChildren(containerId);

            this.createSelectTypeWiseFields(selectedValue, containerId);
        });


    }


    createInputFieldsForStaticSelectType(containerId) {
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


        this.createNestedInputElements('select', 'input-select-elements', createdElements, count);
        // Adding or removing input fields on count value change
        document.getElementById('input-select-count').addEventListener('change', (event) => {
            let countValue = event.target.value;
            this.createNestedInputElements('select', 'input-select-elements', createdElements, countValue);

        });
    }

    createSelectTypeWiseFields(type, containerId) {
        if (type === 'static') {
            this.createInputFieldsForStaticSelectType(containerId);
        } else {
            this.createInputFieldsForApiSelectType(containerId);
        }

    }

    createInputFieldsForApiSelectType(containerId) {
        let optionBn = '';
        let optionEn = '';
        let selectValue = '';
        if (elementProperties) {
            optionBn = elementProperties.select_api_option_bn ?? '';
            optionEn = elementProperties.select_api_option_en ?? '';
            selectValue = elementProperties.select_api_value ?? '';
        }

        document.getElementById(containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                       <label >Select Api value Keys:</label>
                                                              <input type="text" name="select_api_option_bn" id="input-select-option-bn" class="col-md-4 form-control mb-2" placeholder="Option BN" required value="${optionBn}">
                                                              <input type="text" name="select_api_option_en" id="input-select-option-en" class="col-md-4 form-control mb-2" placeholder="Option EN" required value="${optionEn}">
                                                              <input type="text" name="select_api_value" id="input-select-value" class="col-md-4 form-control mb-2" placeholder="Value" required value="${selectValue}">
                                                            </div>`;

    }

    createNestedSelectElements(i, container, createdElements) {

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


    createInputFieldsForInputTypeRadio(containerId) {
        let radioType = 'static';
        if (elementProperties && elementProperties.input_radio_type) {
            radioType = elementProperties.input_radio_type;
        }
        document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="radio-type">Radio Type:</label>
                                                            <select name="input_radio_type" id="radio-type"
                                                             class="form-control">
                                                                <option value="static" ${radioType === 'static' ? 'selected' : ''}>Static</option>
                                                                <option value="api" ${radioType === 'api' ? 'selected' : ''}>Api</option>
                                                                </select>
                                                      </div>
                                                       <div class="g-create-form">
                                                            <div id="radio-type-wise-value" class="row">

                                                            </div>
                                                        </div>

`;


        this.createRadioTypeWiseFields(radioType, 'radio-type-wise-value');
        document.getElementById('radio-type').addEventListener('change', (event) => {
            let selectedValue = event.target.value;
            let containerId = 'radio-type-wise-value';

            // Remove all existing input fields from the container
            removeAllChildren(containerId);

            this.createRadioTypeWiseFields(selectedValue, containerId);
        });

    }

    createRadioTypeWiseFields(type, containerId) {
        if (type === 'static') {
            this.createInputFieldsForStaticRadioType(containerId);
        } else {
            this.createInputFieldsForApiRadioType(containerId);
        }

    }

    createInputFieldsForStaticRadioType(containerId) {
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

        this.createNestedInputElements('radio', 'input-radio-elements', createdElements, count);

        // Adding or removing input fields on count value change
        document.getElementById('input-radio-count').addEventListener('change', (event) => {
            let countValue = event.target.value;
            this.createNestedInputElements('radio', 'input-radio-elements', createdElements, countValue);

        });
    }

    createInputFieldsForApiRadioType(containerId) {
        let radioBnValue = '';
        let radioEnValue = '';
        if (elementProperties) {
            radioBnValue = elementProperties.input_api_radio_label_bn ?? '';
            radioEnValue = elementProperties.input_api_radio_label_en ?? '';
        }
        document.getElementById(containerId).innerHTML = `<div class="col-md-4 mb-3 form-group">
                                                            <label for="input-radio-label-bn">Radio label (Bn) :</label>
                                                            <input class="form-control" type="text" name="input_api_radio_label_bn" id="input-radio-label-bn" value="${radioBnValue}">
                                                          </div>
                                                         <div class="col-md-4 mb-3 form-group">
                                                            <label for="input-radio-label-en">Radio label (En) :</label>
                                                            <input class="form-control" type="text" name="input_api_radio_label_en" id="input-radio-label-en" value="${radioEnValue}">
                                                         </div>
`;

    }

    createNestedRadioElements(i, container, createdElements) {

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


    createInputFieldsForInputTypeCheckbox(containerId) {
        let checkboxType = 'static';
        if (elementProperties && elementProperties.input_checkbox_type) {
            checkboxType = elementProperties.input_checkbox_type;
        }
        document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="checkbox-type">Checkbox Type:</label>
                                                            <select name="input_checkbox_type" id="checkbox-type"
                                                             class="form-control">
                                                                <option value="static" ${checkboxType === 'static' ? 'selected' : ''}>Static</option>
                                                                <option value="api" ${checkboxType === 'api' ? 'selected' : ''}>Api</option>
                                                                </select>
                                                      </div>
                                                       <div class="g-create-form">
                                                            <div id="checkbox-type-wise-value" class="row">

                                                            </div>
                                                        </div>

`;


        this.createCheckboxTypeWiseFields(checkboxType, 'checkbox-type-wise-value');
        document.getElementById('checkbox-type').addEventListener('change', (event) => {
            let selectedValue = event.target.value;
            let containerId = 'checkbox-type-wise-value';

            // Remove all existing input fields from the container
            removeAllChildren(containerId);

            this.createCheckboxTypeWiseFields(selectedValue, containerId);
        });

    }

    createCheckboxTypeWiseFields(type, containerId) {
        if (type === 'static') {
            this.createInputFieldsForStaticCheckboxType(containerId);
        } else {
            this.createInputFieldsForApiCheckboxType(containerId);
        }

    }

    createInputFieldsForApiCheckboxType(containerId) {
        let checkboxValue='';
        if (elementProperties ) {
            checkboxValue = elementProperties.input_api_checkbox_value??'';

        }
        document.getElementById(containerId).innerHTML = `<div class="form-group col-md-4 mb-3">
                                                            <label for="input-api-checkbox-value">Checkbox :</label>
                                                            <input class="form-control" type="text" name="input_api__checkbox_value" id="input-api-checkbox-value" value="${checkboxValue}">
                                                          </div>`;


    }


    createInputFieldsForStaticCheckboxType(containerId) {
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

        this.createNestedInputElements('checkbox', 'input-checkbox-elements', createdElements, count);

        // Adding or removing input fields on count value change
        document.getElementById('input-checkbox-count').addEventListener('change', (event) => {
            let countValue = event.target.value;
            this.createNestedInputElements('checkbox', 'input-checkbox-elements', createdElements, countValue);

        });
    }


    createNestedCheckboxElements(i, container, createdElements) {
        let checkboxValue = '';
        if (elementProperties && elementProperties.checkbox_values && elementProperties.checkbox_values[i - 1]) {
            checkboxValue = elementProperties.checkbox_values[i - 1]['checkbox_value'];

        }

        let containerDiv = document.createElement('div');
        containerDiv.classList.add("col-md-4", "mb-3", "form-group");
        containerDiv.innerHTML = `<label for="input-checkbox-value">Checkbox ${i}:</label>
                                  <input class="form-control" type="text" name="input_checkbox_value[]" id="input-checkbox-value" value="${checkboxValue}">`;

        container.appendChild(containerDiv);
        createdElements.push(containerDiv);

    }

    createInputFieldsForInputTypePIN(containerId) {
        let placeholderBn = '';
        let placeholderEn = '';
        let minLength = 1;
        let maxLength = 1;
        let pattern = '';
        let defaultValue = '';
        let required = '';
        if (elementProperties) {
            placeholderBn = elementProperties.input_pin_placeholder_bn ?? '';
            placeholderEn = elementProperties.input_pin_placeholder_en ?? '';
            minLength = elementProperties.input_pin_min_length ?? 1;
            maxLength = elementProperties.input_pin_max_length ?? 1;
            pattern = elementProperties.input_pin_pattern ?? '';
            defaultValue = elementProperties.input_pin_default_value ?? '';
            required = elementProperties.input_pin_required ?? '';
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
                                                                <input class="form-check" type="checkbox" name="input_pin_required" id="input-pin-required" value="Y" ${required === 'Y' ? 'checked' : ''}>
                                                            </div>`;
    }

    createInputFieldsForInputTypeOTP(containerId) {
        let placeholderBn = '';
        let placeholderEn = '';
        let minLength = 1;
        let maxLength = 1;
        let pattern = '';
        let defaultValue = '';
        let required = '';
        if (elementProperties) {
            placeholderBn = elementProperties.input_otp_placeholder_bn ?? '';
            placeholderEn = elementProperties.input_otp_placeholder_en ?? '';
            minLength = elementProperties.input_otp_min_length ?? 1;
            maxLength = elementProperties.input_otp_max_length ?? 1;
            pattern = elementProperties.input_otp_pattern ?? '';
            defaultValue = elementProperties.input_otp_default_value ?? '';
            required = elementProperties.input_otp_required ?? '';
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
                                                                <input class="form-check" type="checkbox" name="input_otp_required" id="input-otp-required" value="Y" ${required === 'Y' ? 'checked' : ''}>
                                                            </div>`;
    }

    createInputFieldsForInputTypeExpireDate(containerId) {
        let placeholderBn = '';
        let placeholderEn = '';
        let minLength = 1;
        let maxLength = 1;
        let pattern = '';
        let defaultValue = '';
        let required = '';
        if (elementProperties) {
            placeholderBn = elementProperties.input_expire_date_placeholder_bn ?? '';
            placeholderEn = elementProperties.input_expire_date_placeholder_en ?? '';
            minLength = elementProperties.input_expire_date_min_length ?? 1;
            maxLength = elementProperties.input_expire_date_max_length ?? 1;
            pattern = elementProperties.input_expire_date_pattern ?? '';
            defaultValue = elementProperties.input_expire_date_default_value ?? '';
            required = elementProperties.input_expire_date_required ?? '';
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
                                                                <input class="form-check" type="checkbox" name="input_expire_date_required" id="input-expire-date-required" value="Y" ${required === 'Y' ? 'checked' : ''}>
                                                            </div>`;
    }
}
