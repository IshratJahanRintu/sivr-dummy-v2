class Paragraph {
    constructor() {
        this.containerId = 'element-wise-value';
        this.createInputFieldsForParagraph = this.createInputFieldsForParagraph.bind(this);
    }


     createInputFieldsForParagraph() {
    let apiKey = '';
    let apiDataComparison = '';
    let apiDataCalculation = '';
    if (elementProperties) {
        apiKey = elementProperties.paragraph_api_keys ?? '';
        apiDataComparison = elementProperties.paragraph_api_data_comparison ?? '';
        apiDataCalculation = elementProperties.paragraph_api_data_calculation ?? '';
    }
    document.getElementById(this.containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
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
}
