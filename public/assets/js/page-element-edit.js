const elementType = document.getElementById('edit-element-type');
const elementNames = document.getElementById('edit-element-name-area');
const elementRowColumns = document.getElementById('edit-no-row-column-area');
const elementName = document.getElementById('edit-element-name');
const elementValue = document.getElementById('edit-element-value');
const elementRows = document.getElementById('edit-element-no-rows');
const elementColumns = document.getElementById('edit-element-no-columns');
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
