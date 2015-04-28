
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
                    console.log(result);
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

    function sendToStaff(obj){ // нажатие на кнопку - выпадает модальное окно


        var confID = $(obj).data('item');
        var confName = $(obj).data('name');
        console.log(confName);

        var modalContainer = $('#my-modal');
        var modalBody = modalContainer.find('.modal-body');
        modalContainer.modal({show:true});


        $.ajax({
            url: 'get-form-move',
            type: "GET",
            data: {'id':confID, 'one':1},
            success: function (data) {

                $('.modal-body').html(data);
                modalContainer.modal({show:true});
            }

        });

    $(document).on("submit", '.move-form-one', function (e) {

        e.preventDefault();
        var newStaff = $('#uploadform-staff').val();
        var comment = $('#uploadform-comment').val();
        var pageHref=location;
        var string =pageHref.toString();
        var oldStaff = string.slice(string.search(/id=/)+3);
        var route ;
        if(confName=='monitor') {
            route = 'move-monitor';
        }
        if(confName=='units') {
            route = 'move-system-unit';
        }
        if(confName == 'printer'){
            route = 'move-printer';
        }
        console.log(route);

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
                url: route,
                type: "POST",
                data: {'newStaff': newStaff, 'id':confID, 'comment': comment},
                success: function (result) {
                    console.log(result);
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
    if (confirm("Вы уверены что хотите перенести конфигурацию на склад?")) {
        $.ajax({
            url: "send-to-store",
            type: "POST",
            data: {'id':$(obj).attr("id")},
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