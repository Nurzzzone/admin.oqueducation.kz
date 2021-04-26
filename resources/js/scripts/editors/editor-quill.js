/*=========================================================================================
	File Name: editor-quill.js
	Description: Quill is a modern rich text editor built for compatibility and extensibility.
	----------------------------------------------------------------------------------------
	Item Name: Frest HTML Admin Template
	Version: 1.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  var Font = Quill.import('formats/font');
  Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
  Quill.register(Font, true);

  // Snow Editor

  var snowEditor = new Quill('#snow-container .editor', {
    bounds: '#snow-container .editor',
    modules: {
      'formula': true,
      'syntax': true,
      'toolbar': '#snow-container .quill-toolbar'
    },
    theme: 'snow',
  });

  $('#create-teacher').on('submit', function() {
    var value = snowEditor.container.innerHTML;
    var textarea = $('#teacher-textarea').val('value');
  });

  var editors = [snowEditor];

})(window, document, jQuery);
