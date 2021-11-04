$(function () {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: true,
          content: function () {
				return '<img width="100%" class="img-fluid" src="'+$(this).data('img') + '" />';
          },
          title: 'Toolbox'
    });
})