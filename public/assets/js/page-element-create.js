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
