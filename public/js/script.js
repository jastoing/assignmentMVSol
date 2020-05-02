$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        enablePagination: false,
        transitionEffectSpeed: 500,
        labels: {
            current: ""
        }
    });

    $('#regForm').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength : 5
            },
            subscription: {
                required: true
            }
        },
        messages: {
            name: "Please Enter your Name",
            email: "Please Enter your email",
            password: {
                required: "Please Enter a password",
                minlength: "Enter at least {0} characters"
            },
            subscription: "Please choose a subscription"
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('type') == 'checkbox') {
                $(".errorTxt").html(error);
            }
            else {
                error.insertAfter(element);
            }
        }
    });

    $('#step2Form').validate({
        rules: {
            _2step: {
                required: true
            }
        },
        messages: {
            _2step: "Please Enter 2 step code"
        }
    });

    $('.forward').click(function(){

        if ($('#name').valid() && $('#email').valid() && $('#password').valid() ) {
           // $(".sbsc_check").rules("add", {required:true});

            $("#wizard").steps('next');
        }
        
    });
    

});