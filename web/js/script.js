$(function () {
    $(document).on('click','.videos2__item_href',function(){
            th = $(this);
            $.ajax({
                type: "POST",
                url: "/my/youtube-ajax",
                data: ({videoId: th.data('id')}),
                success: function (response) {
                   $('#myModal .modal-body').html(response);
                   $('#myModal').modal('show');
                }
            });
            return false;
        });
})