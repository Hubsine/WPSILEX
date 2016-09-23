(function() {
	tinymce.create('tinymce.plugins.tdltiny', {
		init : function(ed, url) {
		 ed.addCommand('shortcodeGenerator', function() {
		 	
		 		tb_show("Sellegance Shortcodes", url + '/shortcode_generator/shortcode-generator.php?&width=630&height=600');

				
		 });
			//Add button
			ed.addButton('scgenerator', {
				title : 'Sellegance Shortcodes',
				cmd : 'shortcodeGenerator',
				text: 'shortcodes',
				classes:'sellegance widget btn',
				icon: 'code',
				//image : url + '/shortcode_generator/icons/shortcode-generator.png'
			});
        },
        createControl : function(n, cm) {
			  return null;
        },
		  getInfo : function() {
			return {
				longname : 'Sellegance TinyMCE',
				author : 'Everthemes',
				authorurl : 'http://everthemes.com',
				infourl : 'http://everthemes.com',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
    });
    tinymce.PluginManager.add('tdl_buttons', tinymce.plugins.tdltiny);
})();