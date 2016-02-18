// (function(Endold, ProductApp) {
//     var $form = null;
//     var $buttonCancel = null;
//     var $save = null;
//     var app = {
//         init: function() {
//             $form = $('#product-save');
//             $save = $('#save-iframe');
//             $buttonCancel = $('#cancel-button');

//             app.bindEvents();
//         },
//         bindEvents: function() {
//             $form.bind('submit', app.submitBefore );
//             $buttonCancel.bind('click', ProductApp.cancelModify);
//             $save.bind('load', app.saveResponse);
//         },

//         /* do save */
//         submitBefore: function(event) {
//             // event.preventDefault();
//             /* 設定執行的頁面 */
//             $form.attr('action', Endold.cmdTo(221));

//         },
//         saveResponse: function() {
//             var response = $save[0].contentDocument.body.innerHTML;
//             ProductApp.cancelModify();
//             ProductApp.gridReload();

//         }
//     };

//     window.ProductModifyApp = app;

// })(parent.parent.Endold, parent.ProductApp);
// window.ProductModifyApp.init();
