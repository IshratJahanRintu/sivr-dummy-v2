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

const button=new Button(elementProperties);
const compareApi=new CompareApi();
const table=new Table();
const input=new Input();
const paragraph=new Paragraph();
const link=new Link();
// Create a map of selected values to corresponding functions
let valueToFunctionMap = {
    button: button.createInputFieldsForButton,
    compare_api: compareApi.createInputFieldsForCompareApi,
    table: table.createInputFieldsForTable,
    input: input.createInputFieldsForInputType,
    paragraph: paragraph.createInputFieldsForParagraph,
    link: link.createInputFieldsForHyperlink,


};



//initially create input fields for element type  selected
let initialInputFieldsCreation = typeof pageElement !== 'undefined' && pageElement.type ? valueToFunctionMap[pageElement.type] : valueToFunctionMap['button'];
initialInputFieldsCreation();
document.getElementById('g-element-type').addEventListener('change', function () {
    let selectedValue = this.value;
    let containerId = 'element-wise-value';

    // Remove all existing input fields from the container
    removeAllChildren(containerId);

    // Get the function for the selected value from the map
    let createInputFieldsFunction = valueToFunctionMap[selectedValue];

    if (createInputFieldsFunction) {
        // Call the function to create the new input fields
        createInputFieldsFunction.call(this);

    }
});
