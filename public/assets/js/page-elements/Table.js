class Table {
    constructor() {
        this.containerId='element-wise-value';
        this.createInputFieldsForTable = this.createInputFieldsForTable.bind(this);
    }
 createInputFieldsForTable() {

    let type = 'static';
    let headingBn = '';
    let headingEn = '';
    let rows=1;
    let columns=1
    if (elementProperties) {
        type = elementProperties.table_type ?? '';
        headingBn = elementProperties.table_heading_bn ?? '';
        headingEn = elementProperties.table_heading_en ?? '';
        rows=elementProperties.rows??1;
        columns=elementProperties.columns??1;

    }
    document.getElementById(this.containerId).innerHTML = `
                                                    <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-en">Display Text (EN)</label>
                                                            <input class="form-control" type="text"
                                                                   name="display_name_en"
                                                                   id="g-element-text-en"
                                                                   value="">
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-bn">Display Text (BN)</label>
                                                            <input class="form-control" type="text"
                                                                   name="display_name_bn"
                                                                   id="g-element-text-bn"
                                                                   value="">
                                                        </div>
                                                    <div class="form-group col-md-4 mb-3">
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
                                                            <label for="rows">Number of rows:</label>
                                                            <input class="form-control" type="number"
                                                                   name="rows"
                                                                   id="rows"
                                                                   value="${rows}" min="1">
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="columns">Number of columns:</label>
                                                            <input class="form-control" type="number"
                                                                   name="columns"
                                                                   id="columns"
                                                                   value="${columns}" min="1">
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
    if (type!=='static'){
        this.createInputFieldsForDynamicTable('table-type-wise-value');
    }


    document.getElementById('table-type').addEventListener('change',  (event)=> {
        let selectedValue = event.target.value;
        let containerId = 'table-type-wise-value';

        // Remove all existing input fields from the container
        removeAllChildren(containerId);



        if (selectedValue!=='static'){
            this.createInputFieldsForDynamicTable('table-type-wise-value');
        }

    });
}

 createInputFieldsForDynamicTable(containerId) {
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
}
