
$(document).ready(function () {

    $('.move').click(function(event){ // нажатие на кнопку - выпадает модальное окно
        event.preventDefault();

        var url = 'get-form-move';
        var UserID = $(this).attr("id");

        var modalContainer = $('#my-modal');
        var modalBody = modalContainer.find('.modal-body');
        modalContainer.modal({show:true});


        $.ajax({
            url: url,
            type: "GET",
            data: {'id':UserID},
            success: function (data) {

                $('.modal-body').html(data);
                modalContainer.modal({show:true});
            }

        });
    });
    $(document).on("submit", '.move-form', function (e) {

        e.preventDefault();
        var newStaff = $('#uploadform-staff').val();
        var comment = $('#uploadform-comment').val();
        var pageHref=location;
        var string =pageHref.toString();
        var oldStaff = string.slice(string.search(/id=/)+3);

        if(newStaff == ""){
            var error = $('.error');
            error.empty();
            error.append('Вы не выбрали сотрудника!');
        } else if(newStaff === oldStaff){
            var error = $('.error');
            error.empty();
            error.append('Нельзя перемещать конфигурации одному и тому же сотруднику!');
        }
            else {

            $.ajax({
                url: "send-to-staff",
                type: "POST",
                data: {'newStaff': newStaff, 'oldStaff': oldStaff, 'comment': comment},
                success: function (result) {

                    var modalContainer = $('#my-modal');
                    var modalBody = modalContainer.find('.modal-body');
                    var insidemodalBody = modalContainer.find('.gb-user-form');

                    if (result == 'true') {
                        insidemodalBody.html(result).hide(); //

                        $("#my-modal").modal('hide');
                        location.reload();
                    }
                    else {

                        modalBody.html(result).hide().fadeIn();
                    }
                }

            });
        }
    });
});

    function sendOneTo(obj) { // нажатие на кнопку - выпадает модальное окно


        var confID = $(obj).data('item');
        var confName = $(obj).data('name');
        var sendTo = $(obj).data('sendto');

        var modalContainer = $('#my-modal');
        var modalBody = modalContainer.find('.modal-body');
        modalContainer.modal({show: true});


        $.ajax({
            url: 'get-form-move',
            type: "GET",
            data: {'id': confID, 'one': 1},
            success: function (data) {


                $('.modal-body').html(data);
                if(sendTo == 'store'){
                    $('#list-staff').remove();
                }
                modalContainer.modal({show: true});
            }

        });





            $(document).on("submit", '.move-form-one', function (e) {

                e.preventDefault();
                var newStaff = $('#uploadform-staff').val();
                var comment = $('#uploadform-comment').val();
                var pageHref = location;
                var string = pageHref.toString();
                var oldStaff = string.slice(string.search(/id=/) + 3);
                var route;
                if (confName == 'monitor') {
                    route = 'move-monitor';
                }
                if (confName == 'units') {
                    route = 'move-system-unit';
                }
                if (confName == 'printer') {
                    route = 'move-printer';
                }


                    if (newStaff == "") {
                        var error = $('.error');
                        error.empty();
                        error.append('Вы не выбрали сотрудника!');

                    } else if (newStaff === oldStaff) {
                        var error = $('.error');
                        error.empty();
                        error.append('Нельзя перемещать конфигурации одному и тому же сотруднику!');
                    }
                    else {

                    $.ajax({
                        url: route,
                        type: "POST",
                        data: {'newStaff': newStaff, 'id':confID, 'comment': comment},
                        success: function (result) {

                            var modalContainer = $('#my-modal');
                            var modalBody = modalContainer.find('.modal-body');
                            var insidemodalBody = modalContainer.find('.gb-user-form');

                            if (result == 'true') {
                                insidemodalBody.html(result).hide(); //

                                $("#my-modal").modal('hide');
                                location.reload();
                            }
                            else {

                                modalBody.html(result).hide().fadeIn();
                            }
                        }

                    });
                }
            });

        }
function sendStore(obj){
    var message;
    var staffId;
    var status = '0';
    if(obj.hasAttribute('data-staff-id')){
         message = "Если необходимо передать конфигурации новому сотруднику, необходимо нажать кнопку \"Переместить все\", иначе все будет перемещено на склад!";
        staffId = $(obj).data('staff-id');
        status = '1';
    } else {
        message = "Вы уверены что хотите перенести конфигурацию на склад?";
        staffId = $(obj).attr("id");
    }

    if (confirm(message)) {
        $.ajax({
            url: "send-to-store",
            type: "POST",
            data: {'id':staffId , 'status':status},
            success: function (result) {
                console.log(result);
                if (result == 'true') {

                    $('#my-modal').modal('hide');
                    location.reload();
                }
                else {
                    var modalContainer = $('#my-modal');
                    var modalBody = modalContainer.find('.modal-body');
                    modalBody.html(result).hide().fadeIn();
                }
            }
        });
    }


}