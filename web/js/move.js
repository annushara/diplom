
$(document).ready(function () {

    $('.move').click(function(event){ // нажатие на кнопку - выпадает модальное окно
        event.preventDefault();

        var url = 'where-move';
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
        var form = $(this);
        console.log(form.serialize());
        $.ajax({
            url: "submitmove",
            type: "POST",
            data: form.serialize(),
            success: function (result) {
                console.log(result);
                var modalContainer = $('#my-modal');
                var modalBody = modalContainer.find('.modal-body');
                var insidemodalBody = modalContainer.find('.gb-user-form');

                if (result == 'true') {
                    insidemodalBody.html(result).hide(); //
                    //$('#my-modal').modal('hide');
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').append("<strong>Спасибо! Ваше сообщение отправлено.</strong>");
                    $('#success > .alert-success').append('</div>');

                    setTimeout(function() { // скрываем modal через 4 секунды
                        $("#my-modal").modal('hide');
                    }, 4000);
                }
                else {
                    modalBody.html(result).hide().fadeIn();
                }
            }
        });
    });

});
function sendStore(obj){
    if (confirm("Вы уверены что хотите перенести конфигурацию на склад?")) {
        $.ajax({
            url: "send-store",
            type: "POST",
            data: {'id':$(obj).attr("id")},
            success: function (result) {
                console.log(result);

                if (result == 'true') {
                    alert(1);
                    $('#my-modal').modal('hide');
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