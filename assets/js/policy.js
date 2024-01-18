// $(function () {
//     var form_policy = $('form#policy');


//     var options = {
//         url: policy_object.url,
//         data: {
//             action: 'policy_action',
//             nonce: policy_object.nonce
//         },
//         type: 'POST',
//         dataType: 'json',
//         beforeSubmit: function (xhr) {

//         },
//         success: function (request, xhr, status, error) {
//             if (request.message === 'POLICY-OK') {
//                 $('form#policy').css('display', 'none');
//             }
//             else if (request.message === 'POLICY-ERROR') {
//             }
//         },
//         error: function (request, status, error) {
//         }
//     };
//     // Отправка формы
//     form_policy.ajaxForm(options);


// });

$(function () {
    $(document).on('click', '#policy .cookie__btn', function (e) {
        e.preventDefault();

        var th = $(this);
        var policy = th.parent();
        //var error_mess = 'Произошла ошибка';
        var ajax_url = "/wp-admin/admin-ajax.php";
        var data = {
            action: 'policy_action',
            feedback: 'accept-policy',
            nonce: policy_object.nonce
        };
        $.ajax({
            type: 'POST',
            url: ajax_url,
            dataType: 'json',
            data: data,
            success: function (data) {
                //th.html('Принять');
                if (data.message === 'POLICY-OK') {
                    console.log('POLICY-OK');
                    policy.css('display', 'none');
                }
                else if (data.message === 'POLICY-ERROR') {
                    console.log('POLICY-ERROR');
                    policy.css('display', 'none');
                    //policy.addClass('error');
                    // setTimeout(() => {
                    //     set_message(error_mess);
                    // }, 200);
                }
                return true;
            },
            error: function () {
                console.log('POLICY-ERROR-function');
                // th.html('Принять');
                policy.css('display', 'none');
                //policy.addClass('error');
                // setTimeout(() => {
                //     set_message(error_mess);
                // }, 200);
                return false;
            }
        });

    });

});