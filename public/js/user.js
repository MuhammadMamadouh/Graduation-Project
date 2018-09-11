(function ($) {
    $(document).ready(function () {
        $('#cssmenu').prepend('<div id="bg-one"></div><div id="bg-two"></div><div id="bg-three"></div><div id="bg-four"></div>');
    });
})(jQuery);
$(document).ready(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient);

    });
});
(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-67062609-1', 'auto');
ga('send', 'pageview');
// $(document).ready(function () {
//     size_li = $(".review_load li").size();
//     x = 5;
//     $('.review_load li:lt(' + x + ')').show();
//     $('#loadMore').click(function () {
//         x = (x + 5 <= size_li) ? x + 5 : size_li;
//         $('.review_load li:lt(' + x + ')').show();
//     });
//     $('#showLess').click(function () {
//         x = (x - 5 < 0) ? 5 : x - 5;
//         $('.review_load li').not(':lt(' + x + ')').hide();
//     });
// });

