$(document).ready(function () {
    function getTagifySettings(whitelist){
        return {
            dropdown: {
                classname: "color-blue",
                enabled: 0,
                maxItems: 5,
                position: "input",
                closeOnSelect: false,
                highlightFirst: true,
            },
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(';'),
            delimiters: [';'],
            whitelist: whitelist,
            enforceWhitelist : true,
        };
    }

    // const tagifyBranch = new Tagify($('#branches-input')[0], getTagifySettings(branches));
    const tagifyDepartment = new Tagify($('#departments-input')[0], getTagifySettings(departments));
    const tagifyChannel = new Tagify($('#channels-input')[0], getTagifySettings(channels));
    const tagifyConcern = new Tagify($('#concerns-input')[0], getTagifySettings(concerns));

    // tagifyBranch.addTags(branches, true);
    tagifyDepartment.addTags(departments, true);
    tagifyChannel.addTags(channels, true);
    tagifyConcern.addTags(concerns, true);
});
