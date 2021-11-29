require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function (
        $,
        modal
    ) {
        var modaloption = {
            type: 'popup',
            title:'Bank Emi Details',
            responsive: true,
            innerScroll: true,
            clickableOverlay: true,
            buttons: []
    };
    var popup = modal(modaloption, $('#information-mpdal'));
    $("#request-more").on('click',function(){ 
        $("#information-mpdal").modal("openModal");
    });
}
);

require([
    'jquery',
    'accordion'], function ($) {
    $("#element").collapsible();
});

