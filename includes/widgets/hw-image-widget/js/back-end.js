jQuery(document).ready(function() {
	
	hwim = {
		selectImage: function(id) {
			// Switch to our custom media library.
			wp.media.view.MediaFrame.Select = hwim.hwimMediaLibrary;
			
			var mediaFrame = wp.media({
				title : 'HW Image Widget',
				multiple : false,
				type: 'post',
				library : { type : 'image' },
				button : { text : objectL10n.insertIntoWidget }
			});

			// Media library closed.
			mediaFrame.on('close', function() {
				// Restore original media library.
				wp.media.view.MediaFrame.Select = hwim.originalMediaLibrary;
  			});
			
			// Image was selected from Media Library.
			mediaFrame.on('insert', function() {
				var image = mediaFrame.state().get('selection').toJSON();
				hwim.imageSelected(
						id,
						image[0],
						jQuery('select.size', mediaFrame.el).val()
					);
			});
			
			// Image was selected by URL.
			mediaFrame.on('select', function() {
				hwim.imageEmbeded(
						id,
						jQuery('label.embed-url input', mediaFrame.el).val(),
						jQuery('label.setting.alt-text input', mediaFrame.el).val()
					);
			});
			
			mediaFrame.open();
		},
		
		removeImage: function(id) {
			jQuery(id + ' .remove-image-link').hide();
			jQuery(id + ' .img-thumb').html('');
			jQuery(id + ' .src').attr('value', '');
			jQuery(id + ' .display-width').attr('value', '');
			jQuery(id + ' .display-height').attr('value', '');
			jQuery(id + ' .original-width').attr('value', '');
			jQuery(id + ' .original-height').attr('value', '');
		},
				
		imageSelected: function(id, image, selectedSize) {
			objSize = image.sizes[selectedSize];
			
			jQuery(id + ' .remove-image-link').show();
			jQuery(id + ' .img-thumb').html('<img src="' + objSize.url + '" style="max-width: 100%;">');
			jQuery(id + ' .src').attr('value', objSize.url);
			jQuery(id + ' .display-width').attr('value', objSize.width);
			jQuery(id + ' .display-height').attr('value', objSize.height);
			jQuery(id + ' .original-width').attr('value', objSize.width);
			jQuery(id + ' .original-height').attr('value', objSize.height);
			jQuery(id + ' .alt').attr('value', image.alt);

			if (image.title != '' && jQuery('.title').attr('value') == '') {
				jQuery('.title').attr('value', image.title);
			}
		},
		
		imageEmbeded: function(id, src, alt) {
			// Load image and get size data.
			var img = new Image();
			img.widgetId = id;
			
			img.onload = function() {
				jQuery(this.widgetId + ' .display-width').attr('value', this.width);
				jQuery(this.widgetId + ' .display-height').attr('value', this.height);
				jQuery(this.widgetId + ' .original-width').attr('value', this.width);
				jQuery(this.widgetId + ' .original-height').attr('value', this.height);
			}
			
			jQuery(id + ' .remove-image-link').show();
			jQuery(id + ' .img-thumb').html('<img src="' + src + '" style="max-width: 100%;">');
			jQuery(id + ' .src').attr('value', src);
			jQuery(id + ' .alt').attr('value', alt);
			
			img.src = src;
		},
		
		displaySize: function(id, val) {
			console.log('displaySize: ' + id + ', ' + val);
			
			if (val == 'fixed') {
				jQuery(id + ' div.fixed-size').slideDown(200);
			} else {
				jQuery(id + ' div.fixed-size').slideUp(200);
			}
		},
				
		// Keeps track of aspect ratio checkbox.
		keepAspectRatio: function(id) {
			if (jQuery(id + ' .keep-aspect-ratio').prop('checked')) {
				this.calcAspectRatio(id, 'x');
			}
		},
		
		target: function(id) {
			if (jQuery(id + ' .target-option').val() != 'other') {
				jQuery(id + ' .target-name').hide();
			} else {
				jQuery(id + ' .target-name').show();
			}
		},
				
		calcAspectRatio: function(id, axis) {
			console.log('calcAspectRatio: ' + id + ', ' + axis);
			
			if (jQuery(id + ' .keep-aspect-ratio').prop('checked')) {
				var display_width = jQuery(id + ' .display-width').attr('value');
				var display_height = jQuery(id + ' .display-height').attr('value');
				var original_width = jQuery(id + ' .original-width').attr('value');
				var original_height = jQuery(id + ' .original-height').attr('value');
				var aspect_ratio = 0;

				if (this.isValidInt(display_width) && axis == 'x') {
					aspect_ratio = original_width / original_height;
					jQuery('.display-height').attr('value', Math.round(display_width / aspect_ratio));
				}

				if (this.isValidInt(display_height) && axis == 'y') {
					aspect_ratio = original_height / original_width;
					jQuery('.display-width').attr('value', Math.round(display_height / aspect_ratio));
				}

				if (display_width == '' && axis == 'x') {
					jQuery('.display-height').attr('value', '');
				}

				if (display_height == '' && axis == 'y') {
					jQuery('.display-width').attr('value', '');
				}
			}
		},
				
		isValidInt: function(val) {
			var intRegex = /^\d+$/;
			return intRegex.test(val);
		},
				
		openTextEditor: function(id) {
			hwim.editorForId = id;
			
			if (!!!hwim.getCookie('TinyMCE_hwim-tmce_size')) {
				hwim.setCookie('TinyMCE_hwim-tmce_size', 'cw=622&ch=200');
			}
			
			tinyMCE.get('hwim-tmce').setContent(jQuery(id + ' .text').attr('value'));
			jQuery('#hwim-te').css('display', 'block');
			jQuery('#hwim-te-backdrop').css('display', 'block');
		},
				
		closeTextEditor: function(evt) {
			evt.preventDefault();
			
			if (evt.data.save == true) {
				jQuery(hwim.editorForId + ' .text').attr('value', tinyMCE.get('hwim-tmce').getContent());
				jQuery(hwim.editorForId + ' .text-preview').html(tinyMCE.get('hwim-tmce').getContent());
			}
			
			jQuery('#hwim-te-backdrop').css('display', 'none');
			jQuery('#hwim-te').css('display', 'none');
		},
				
		init: function() {
			// Bind editor buttons.
			jQuery('#hwim-te-backdrop').bind('click', {save: false}, this.closeTextEditor);
			jQuery('.hwim-te-close').bind('click', {save: false}, this.closeTextEditor);
			jQuery('.hwim-te-btn-discard').bind('click', {save: false}, this.closeTextEditor);
			jQuery('.hwim-te-btn-save').bind('click', {save: true}, this.closeTextEditor);
			
			// Keep a copy of original image library.
			try {
				this.originalMediaLibrary = wp.media.view.MediaFrame.Select;
				this.hwimMediaLibrary = this.createMediaLibrary();
			} catch(e) {
				console.log('Unable to load Media Library');
			}
		},
		
		getCookie: function(c_name)	{
			var c_value = document.cookie;
			var c_start = c_value.indexOf(" " + c_name + "=");
			if (c_start == -1)
			{
				c_start = c_value.indexOf(c_name + "=");
			}
			if (c_start == -1)
			{
				c_value = null;
			}
			else
			{
				c_start = c_value.indexOf("=", c_start) + 1;
				var c_end = c_value.indexOf(";", c_start);
				if (c_end == -1)
				{
					c_end = c_value.length;
				}
				c_value = unescape(c_value.substring(c_start, c_end));
			}
			return c_value;
		},
				
		setCookie: function(c_name,value,exdays) {
			var exdate = new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toUTCString());
			document.cookie = c_name + "=" + c_value;
		},
				
		createMediaLibrary: function() {
			return wp.media.view.MediaFrame.Select.extend({
				initialize: function() {
					wp.media.view.MediaFrame.prototype.initialize.apply(this, arguments);

					_.defaults(this.options, {
						multiple: true,
						editing: false,
						state: 'insert'
					});

					this.createSelection();
					this.createStates();
					this.bindHandlers();
					this.createIframeStates();
				},
				createStates: function() {
					var options = this.options;

					// Add the default states.
					this.states.add([
						// Main states.
						new wp.media.controller.Library({
							id: 'insert',
							title: objectL10n.insertMedia,
							priority: 20,
							toolbar: 'main-insert',
							filterable: 'image',
							library: wp.media.query(options.library),
							multiple: options.multiple ? 'reset' : false,
							editable: true,
							// If the user isn't allowed to edit fields,
							// can they still edit it locally?
							allowLocalEdits: true,
							// Show the attachment display settings.
							displaySettings: true,
							// Update user settings when users adjust the
							// attachment display settings.
							displayUserSettings: true
						}),
						// Embed states.
						new wp.media.controller.Embed(),
					]);


					if (wp.media.view.settings.post.featuredImageId) {
						this.states.add(new wp.media.controller.FeaturedImage());
					}
				},
				bindHandlers: function() {
					// from Select
					this.on('router:create:browse', this.createRouter, this);
					this.on('router:render:browse', this.browseRouter, this);
					this.on('content:create:browse', this.browseContent, this);
					this.on('content:render:upload', this.uploadContent, this);
					this.on('toolbar:create:select', this.createSelectToolbar, this);
					//

					this.on('menu:create:gallery', this.createMenu, this);
					this.on('toolbar:create:main-insert', this.createToolbar, this);
					this.on('toolbar:create:main-gallery', this.createToolbar, this);
					this.on('toolbar:create:featured-image', this.featuredImageToolbar, this);
					this.on('toolbar:create:main-embed', this.mainEmbedToolbar, this);

					var handlers = {
						menu: {
							'default': 'mainMenu'
						},
						content: {
							'embed': 'embedContent',
							'edit-selection': 'editSelectionContent'
						},
						toolbar: {
							'main-insert': 'mainInsertToolbar'
						}
					};

					_.each(handlers, function(regionHandlers, region) {
						_.each(regionHandlers, function(callback, handler) {
							this.on(region + ':render:' + handler, this[ callback ], this);
						}, this);
					}, this);
				},
				// Menus
				mainMenu: function(view) {
					view.set({
						'library-separator': new wp.media.View({
							className: 'separator',
							priority: 100
						})
					});
				},
				// Content
				embedContent: function() {
					var view = new wp.media.view.Embed({
						controller: this,
						model: this.state()
					}).render();

					this.content.set(view);
					view.url.focus();
				},
				editSelectionContent: function() {
					var state = this.state(),
							selection = state.get('selection'),
							view;

					view = new wp.media.view.AttachmentsBrowser({
						controller: this,
						collection: selection,
						selection: selection,
						model: state,
						sortable: true,
						search: false,
						dragInfo: true,
						AttachmentView: wp.media.view.Attachment.EditSelection
					}).render();

					view.toolbar.set('backToLibrary', {
						text: objectL10n.returnToLibrary,
						priority: -100,
						click: function() {
							this.controller.content.mode('browse');
						}
					});

					// Browse our library of attachments.
					this.content.set(view);
				},
				// Toolbars
				selectionStatusToolbar: function(view) {
					var editable = this.state().get('editable');

					view.set('selection', new wp.media.view.Selection({
						controller: this,
						collection: this.state().get('selection'),
						priority: -40,
						// If the selection is editable, pass the callback to
						// switch the content mode.
						editable: editable && function() {
							this.controller.content.mode('edit-selection');
						}
					}).render());
				},
				mainInsertToolbar: function(view) {
					var controller = this;

					this.selectionStatusToolbar(view);

					view.set('insert', {
						style: 'primary',
						priority: 80,
						text: objectL10n.selectImage,
						requires: {selection: true},
						click: function() {
							var state = controller.state(),
									selection = state.get('selection');

							controller.close();
							state.trigger('insert', selection).reset();
						}
					});
				},
				featuredImageToolbar: function(toolbar) {
					this.createSelectToolbar(toolbar, {
						text: 'Set Featured Image',
						state: this.options.state || 'upload'
					});
				},
				mainEmbedToolbar: function(toolbar) {
					toolbar.view = new wp.media.view.Toolbar.Embed({
						controller: this,
						text: objectL10n.insertImage
					});
				}

			});
		}
	};
	hwim.init();
});



