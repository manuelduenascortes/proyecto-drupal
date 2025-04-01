(function ($, Drupal) {
    Drupal.behaviors.miTema = {
      attach: function (context, settings) {
        $('h1', context).css('color', 'blue');
      }
    };
  })(jQuery, Drupal);