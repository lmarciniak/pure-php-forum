$(function() {
    $(".del").click(function() {
        const url = $(this).attr('ajaxurl');
        const parent = $(this).parent();
        const id = $(this).attr('id');
        console.log(url);
        $.post(url, function (o) {
            if (o.result == 1) {
                if (id == "topic") {
                    alert("The topic has been deleted!");
                    history.go(-1);
                } else {
                    parent.hide('slow', function () {
                        this.remove();
                    });
                }
            }
        }, 'json');
    });
});