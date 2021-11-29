define( 
    [ 
      'jquery', 
      'Magento_Ui/js/modal/modal' 
    ], 
    function($) { 
       "use strict"; 
       //creating jquery widget 
       $.widget('Ambab.Popup', { 
          options: { 
             modalForm: '#popup', 
             modalButton: '.popup-open' 
          }, 
          _create: function() { 
              this.options.modalOption = this.getModalOptions(); 
              this._bind(); 
          }, 
          getModalOptions: function() { 
              /** * Modal options */ 
              var options = { 
                type: 'popup', 
                responsive: true, 
                innerScroll: true,
                clickableOverlay: true, 
                title: $.mage.__('Bank EMI Details'), 
                buttons: [{ 
                   text: $.mage.__('Yes'), 
                   class: '', 
                   click: function () { 
                      this.closeModal(); 
                   } 
                }] 
              };  
              return options; 
          }, 
           _bind: function(){ 
              var modalOption = this.options.modalOption; 
              var modalForm = this.options.modalForm; 
              $(document).on('click', this.options.modalButton, function(){ 
                 $(modalForm).modal(modalOption); 
                 $(modalForm).trigger('openModal'); 
              }); 
           } 
       }); 
       return $.Ambab.Popup; 
    } 
 );