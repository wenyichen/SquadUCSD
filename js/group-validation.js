$().ready(function () {
    $("#editGroupForm").validate({
        // Specify validation rules
        rules: {
            groupname: {
                required: true,
                maxlength: 40
            },
            course: {
                maxlength: 40
            },
            size: {
                required: true,
                digits: true.
                max: maxSize,
                min: minSize
               
            }
        },
        // Specify validation error messages
        messages: {
            groupname: {
                required: "Group name cannot be empty.",
                maxlength: "Group name should be less than 40 characters."
            },
            course: {
                maxlength: "Class name should be less than 40 characters."
            },
            size: {
                required: "Size cannot be empty.",
                min: "Group size cannot be less than current members.",
                max: "The maximum group size is 10."
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function (form) {
            form.submit();
        }
    });

});