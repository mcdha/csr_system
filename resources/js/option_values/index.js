$(document).ready(function () {
    const tagifyValues = new Tagify($('#values-input')[0], {
        dropdown: {
            classname: "color-blue",
            enabled: 0, // disable suggestions
            maxItems: 5,
            position: "input", // place the dropdown near the typed text
            closeOnSelect: false, // keep the dropdown open after selecting a suggestion
            highlightFirst: true
        },
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(';'),
        delimiters: [';'],
    });

    tagifyValues.addTags(optionValues, true);

    $('#field-input').change(function () {
        let field = $(this).val();
        window.location.href = queriesOptionValues.replace(':field', field)
    });
});