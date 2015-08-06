jQuery(document).ready(function () {

    jQuery("#club_course").validate({
        rules: {
            "course[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "course[date]": {
                required: true,
                date: true
            },
            "course[detail_description]": {
                required: true,
            },
        },
        messages: {
            "course[title]": {
                required: "Please provide a title for course.",
                minlength: "The course title should be at least 2 characters long.",
                maxlength: "Course title can be a maximum of 255 characters in length."
            },
            "course[date]": {
                required: "Please provide a valid start date.",
                date: "Please provide a valid date."
            },
            "course[detail_description]": {
                required: "Please provide discription.",
            },
        },
    });



    jQuery("#club_event").validate({
        rules: {
            "event[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "event[date]": {
                required: true,
                date: true
            },
            "event[description]": {
                required: true,
            },
        },
        messages: {
            "event[title]": {
                required: "Please provide a title for event.",
                minlength: "The course title should be at least 2 characters long.",
                maxlength: "Course title can be a maximum of 255 characters in length."
            },
            "event[date]": {
                required: "Please provide a valid start date.",
                date: "Please provide a valid date."
            },
            "event[description]": {
                required: "Please provide discription.",
            },
        },
    });
});