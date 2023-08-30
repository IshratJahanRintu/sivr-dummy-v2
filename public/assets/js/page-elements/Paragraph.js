class Paragraph {
    constructor() {
        this.containerId = 'element-wise-value';
        this.createInputFieldsForParagraph = this.createInputFieldsForParagraph.bind(this);
    }


    createInputFieldsForParagraph() {
        let containerId = 'paragraph-api-elements';
        let createdElements = [];
        let count = 1;

        if (elementProperties) {
            count = elementProperties.paragraph_api_count ?? '';

        }
        document.getElementById(this.containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-en">Display Text (EN)</label>
                                                            <textarea class="form-control" type="text"
                                                                   name="display_name_en"
                                                                   id="g-element-text-en"
                                                                   ></textarea>
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-bn">Display Text (BN)</label>
                                                            <textarea class="form-control" type="text"
                                                                   name="display_name_bn"
                                                                   id="g-element-text-bn"
                                                                   ></textarea>
                                                        </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                            <label for="paragraph-api-count">Paragraph Api Count:</label>
                                                            <input class="form-control" name="paragraph_api_count" id="paragraph-api-count" type="number" min="1" max="10" value="${count}">
                                                               </div>

                                                        <div class="g-create-form">
                                                        <div id="paragraph-api-elements"></div>
                                                         </div>


`;
        this.createParagraphApiElements(containerId, createdElements, count);
        // Adding or removing input fields on count value change
        document.getElementById('paragraph-api-count').addEventListener('change', (event)=> {
            let countValue = event.target.value;
            this.createParagraphApiElements(containerId, createdElements, countValue);


        });
    }


    createParagraphApiElements(containerId, createdElements, countValue) {
        countValue = parseInt(countValue);


        const container = document.getElementById(containerId);

        // Add or remove input fields based on the countValue
        while (createdElements.length < countValue) {
            this.addField(createdElements.length + 1, container, createdElements);
        }

        while (createdElements.length > countValue) {
            removeLastField(container);
            createdElements.pop();
        }
    }


    addField(i,container,createdElements) {

        let apiKeys = '';
        let apiDataComparison = '';
        let apiDataCalculation = '';
        if (elementProperties && elementProperties.paragraph_api_values && elementProperties.paragraph_api_values[i - 1]) {
            apiKeys = elementProperties.paragraph_api_values[i - 1]['api_keys'];
            apiDataComparison = elementProperties.paragraph_api_values[i - 1]['api_data_comparison'];
            apiDataCalculation = elementProperties.paragraph_api_values[i - 1]['api_data_calculation'];
        }

        let containerDiv = document.createElement('div');
        containerDiv.classList.add("container-fluid", "border", "border-secondary-subtle", "rounded", "mb-3", "p-3");
                                   containerDiv.innerHTML = `<div class="form-group  mb-3">
                                                                <label for="paragraph-api-keys-${i}">Api keys ${i}:</label>
                                                                <input class="form-control" type="text" name="paragraph_api_keys[]" id="paragraph-api-keys-${i}" value="${apiKeys}">
                                                            </div>
                                                            <div class="form-group  mb-3">
                                                                <label for="paragraph-api-data-comparison-${i}">API Data Comparison ${i}:</label>
                                                                <input class="form-control" type="text" name="paragraph_api_data_comparison[]" id="paragraph-api-data-comparison-${i}" value="${apiDataComparison}">
                                                            </div>
                                                            <div class="form-group  mb-3">
                                                                <label for="paragraph-api-data-calculation-${i}">API Data Calculation ${i}:</label>
                                                                <input class="form-control" type="text" name="paragraph_api_data_calculation[]" id="paragraph-api-data-calculation-${i}" value="${apiDataCalculation}">
                                                            </div>
       `;
        container.appendChild(containerDiv);

        createdElements.push(containerDiv);



    }

}
