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
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
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
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
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


    jQuery("#club_promotion").validate({
        rules: {
            "promotion[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "promotion[description]": {
                required: true,
            },
        },
        messages: {
            "promotion[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "promotion[description]": {
                required: "Please provide discription.",
            },
        },
    });


    jQuery("#club_restaurant").validate({
        rules: {
            "restaurant[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "restaurant[description]": {
                required: true,
            },
            "restaurant[dress_code]": {
                required: true,
            },
            "restaurant[guest_dining_policy]": {
                required: true,
            },
        },
        messages: {
            "restaurant[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "restaurant[description]": {
                required: "Please provide discription.",
            },
            "restaurant[dress_code]": {
                required: "Please provide dress code.",
            },
            "restaurant[guest_dining_policy]": {
                required: "Please provide guest's dining policy.",
            },
        },
    });


    jQuery("#club_pool").validate({
        rules: {
            "pool[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "pool[description]": {
                required: true,
            },
            "pool[type]": {
                required: true,
            },
        },
        messages: {
            "pool[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "pool[description]": {
                required: "Please provide discription.",
            },
            "pool[type]": {
                required: "Please provide dress code.",
            },
        },
    });


    jQuery("#club_beach").validate({
        rules: {
            "beach[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "beach[description]": {
                required: true,
            },
            "beach[type]": {
                required: true,
            },
        },
        messages: {
            "beach[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "beach[description]": {
                required: "Please provide discription.",
            },
            "beach[type]": {
                required: "Please provide dress code.",
            },
        },
    });


    jQuery("#club_class").validate({
        rules: {
            "class[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "class[description]": {
                required: true,
            },
            "class[start_date]": {
                required: true,
                date: true,
            },
            "class[days]": {
                required: true,
            },
            "class[time]": {
                required: true,
            },
            ".select2-search__field": {
                required: true,
            },
        },
        messages: {
            "class[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "class[description]": {
                required: "Please provide discription.",
            },
            "class[start_date]": {
                required: "Please provide date.",
                date: true,
            },
            "class[days]": {
                required: "Please provide days.",
            },
            "class[time]": {
                required: "Please provide time.",
            },
            ".select2-search__field": {
                required: "Please provide days.",
            },
        },
    });


    jQuery("#club_activity").validate({
        rules: {
            "activity[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "activity[description]": {
                required: true,
            },
            "activity[start_date]": {
                required: true,
                date: true,
            },
            "activity[end_date]": {
                required: true,
                date: true,
            },
        },
        messages: {
            "activity[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "activity[description]": {
                required: "Please provide discription.",
            },
            "activity[start_date]": {
                required: "Please provide start date.",
                date: true,
            },
            "activity[end_date]": {
                required: "Please provide end date.",
                date: true,
            },
        },
    });

    jQuery("#club_camp").validate({
        rules: {
            "camp[title]": {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            "camp[description]": {
                required: true,
            },
            "camp[start_date]": {
                required: true,
                date: true,
            },
            "camp[end_date]": {
                required: true,
                date: true,
            },
        },
        messages: {
            "camp[title]": {
                required: "Please provide a title.",
                minlength: "The title should be at least 2 characters long.",
                maxlength: "Title can be a maximum of 255 characters in length."
            },
            "camp[description]": {
                required: "Please provide discription.",
            },
            "camp[start_date]": {
                required: "Please provide start date.",
                date: true,
            },
            "camp[end_date]": {
                required: "Please provide end date.",
                date: true,
            },
        },
    });
    
    
       jQuery("#club_gallery").validate({
        rules: {
            "gallery[title]": {
                required: true,
            },
            "gallery[description]": {
                required: true,
            },
        },
        messages: {
            "gallery[title]": {
                required: "Please select a event title, if empty add another event",
            },
            "gallery[description]": {
                required: "Please provide discription.",
            },
        },
    });

});