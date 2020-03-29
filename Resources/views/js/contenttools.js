(function() {
    var ImageUploader;

    ImageUploader = (function() {
        ImageUploader.imagePath = 'image.png';

        ImageUploader.imageSize = [600, 174];

        function ImageUploader(dialog) {
            this._dialog = dialog;
            this._dialog.addEventListener('cancel', (function(_this) {
                return function() {
                    return _this._onCancel();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.cancelupload', (function(_this) {
                return function() {
                    return _this._onCancelUpload();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.clear', (function(_this) {
                return function() {
                    return _this._onClear();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.fileready', (function(_this) {
                return function(ev) {
                    return _this._onFileReady(ev.detail().file);
                };
            })(this));
            this._dialog.addEventListener('imageuploader.mount', (function(_this) {
                return function() {
                    return _this._onMount();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.rotateccw', (function(_this) {
                return function() {
                    return _this._onRotateCCW();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.rotatecw', (function(_this) {
                return function() {
                    return _this._onRotateCW();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.save', (function(_this) {
                return function() {
                    return _this._onSave();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.unmount', (function(_this) {
                return function() {
                    return _this._onUnmount();
                };
            })(this));
        }

        ImageUploader.prototype._onCancel = function() {};

        ImageUploader.prototype._onCancelUpload = function() {
            clearTimeout(this._uploadingTimeout);
            return this._dialog.state('empty');
        };

        ImageUploader.prototype._onClear = function() {
            return this._dialog.clear();
        };

        ImageUploader.prototype._onFileReady = function(file) {
            var upload;
            console.log(file);
            this._dialog.progress(0);
            this._dialog.state('uploading');
            upload = (function(_this) {
                return function() {
                    var progress;
                    progress = _this._dialog.progress();
                    progress += 1;
                    if (progress <= 100) {
                        _this._dialog.progress(progress);
                        return _this._uploadingTimeout = setTimeout(upload, 25);
                    } else {
                        return _this._dialog.populate(ImageUploader.imagePath, ImageUploader.imageSize);
                    }
                };
            })(this);
            return this._uploadingTimeout = setTimeout(upload, 25);
        };

        ImageUploader.prototype._onMount = function() {};

        ImageUploader.prototype._onRotateCCW = function() {
            var clearBusy;
            this._dialog.busy(true);
            clearBusy = (function(_this) {
                return function() {
                    return _this._dialog.busy(false);
                };
            })(this);
            return setTimeout(clearBusy, 1500);
        };

        ImageUploader.prototype._onRotateCW = function() {
            var clearBusy;
            this._dialog.busy(true);
            clearBusy = (function(_this) {
                return function() {
                    return _this._dialog.busy(false);
                };
            })(this);
            return setTimeout(clearBusy, 1500);
        };

        ImageUploader.prototype._onSave = function() {
            var clearBusy;
            this._dialog.busy(true);
            clearBusy = (function(_this) {
                return function() {
                    _this._dialog.busy(false);
                    return _this._dialog.save(ImageUploader.imagePath, ImageUploader.imageSize, {
                        alt: 'Example of bad variable names'
                    });
                };
            })(this);
            return setTimeout(clearBusy, 1500);
        };

        ImageUploader.prototype._onUnmount = function() {};

        ImageUploader.createImageUploader = function(dialog) {
            return new ImageUploader(dialog);
        };

        return ImageUploader;

    })();

    window.ImageUploader = ImageUploader;

    window.onload = function() {
        var FIXTURE_TOOLS, IMAGE_FIXTURE_TOOLS, LINK_FIXTURE_TOOLS, editor, req;
        ContentTools.IMAGE_UPLOADER = ImageUploader.createImageUploader;
        ContentTools.StylePalette.add([new ContentTools.Style('By-line', 'article__by-line', ['p']), new ContentTools.Style('Caption', 'article__caption', ['p']), new ContentTools.Style('Example', 'example', ['pre']), new ContentTools.Style('Example + Good', 'example--good', ['pre']), new ContentTools.Style('Example + Bad', 'example--bad', ['pre'])]);
        editor = ContentTools.EditorApp.get();
        editor.init('[data-editable], [data-fixture]', 'data-name');
     	
       
		

        
        editor.addEventListener('saved', function(ev) {
            var saved;
            var regions = ev.detail().regions;
            //console.log(regions);
            if (Object.keys(regions).length === 0) {
                return;
            }
            editor.busy(true);
            /*
            saved = (function(_this) {
                return function() {
                    editor.busy(false);
                    return new ContentTools.FlashUI('ok');
                };
            })(this);
            return setTimeout(saved, 2000);
            */
            /*
            payload = new FormData();
            payload.append('page', window.location.pathname);
            payload.append('_token',$( "input[name='_token']" ).val());
            payload.append('_method','PUT');
            payload.append('regions', JSON.stringify(regions));
            */
            var data={
                page:window.location.pathname,
                _token:$( "input[name='_token']" ).val(),
                _method:'PUT',
                regions:JSON.stringify(regions)  
            };
            //console.log(data);
            var actionurl=base_url+'/admin/blog/'+lang+'/post/updatecontenttools';
            $.ajax({
                url: actionurl,
                type: 'post',
                dataType: 'json',
                data:  data
            }).done(function( data ) {
                editor.busy(false);
                new ContentTools.FlashUI('ok');
               // modal.find('.form-msg').html('<div class="alert alert-success"><strong>Success </strong>'+data.msg+'</div>');
            }).fail(function(response){
                console.log(response);
                var err='';
                var errors=response.responseJSON.errors;
                for(i in errors){
                    err=err+'<div class="alert alert-danger"><strong>Error! </strong>'+i+' '+errors[i]+'</div>';
                }
                //modal.find('.form-msg').html(err);
                editor.busy(false);
                new ContentTools.FlashUI('no');
            });


            /* 
            payload = new FormData();
    		payload.append('page', window.location.pathname);
    		payload.append('_token',$( "input[name='_token']" ).val());
            payload.append('_method','PUT');
    		payload.append('regions', JSON.stringify(regions));
    		function onStateChange(ev) {  
    			console.log(ev);
    			//$('#msg').html(ev.srcElement.responseText);
                //document.write(ev.srcElement.responseText);
        		// Check if the request is finished
        		if (ev.target.readyState == 4) {
	            	editor.busy(false);
            		if (ev.target.status == '200') {
                		// Save was successful, notify the user with a flash
                		new ContentTools.FlashUI('ok');
            		} else {
	                	// Save failed, notify the user with a flash
    	            	new ContentTools.FlashUI('no');
        	    	}
        		}
    		};//end onStateChange
    		xhr = new XMLHttpRequest();
    		xhr.addEventListener('readystatechange', onStateChange);
    		//xhr.open('POST', base_url+'/admin/blog/'+lang+'/post/updateContentTools'); //update a parte perche' gli do in pasto un array post|txt|<post_id>  aggiorno la tabella post il campo txt id ..
            xhr.open('POST', base_url+'/admin/blog/'+lang+'/post/updatecontenttools');
            // admin/blog/{lang}/{container}/{item}/updatecontenttools 
            //xhr.open('PUT', base_url+'/admin/blog/'+lang+'/post/updateContentTools');
    		//console.log(payload);
    		xhr.send(payload);
            //*/
        });
        
        /*
        editor.addEventListener('save', function(ev) {
        	console.log('save');
        	var regions = ev.detail().regions;
        	console.log(ev.detail().regions);
        	 // Collect the contents of each region into a FormData instance
    		payload = new FormData();
    		payload.append('page', window.location.pathname);
    		payload.append('_token',$( "input[name='_token']" ).val());
    		//payload.append('images', JSON.stringify(getImages())); //http://getcontenttools.com/tutorials/handling-image-uploads
    		payload.append('regions', JSON.stringify(regions));
    		// Send the updated content to the server to be saved
    		function onStateChange(ev) {
    			//console.log(ev.srcElement);
    			$('#msg').html(ev.srcElement.responseText);
        		// Check if the request is finished
        		if (ev.target.readyState == 4) {
	            	editor.busy(false);
            		if (status == '200') {
                		// Save was successful, notify the user with a flash
                		new ContentTools.FlashUI('ok');
            		} else {
	                	// Save failed, notify the user with a flash
    	            	new ContentTools.FlashUI('no');
        	    	}
        		}
    		};//end onStateChange
    		xhr = new XMLHttpRequest();
    		xhr.addEventListener('readystatechange', onStateChange);
    		xhr.open('POST', base_url+'/admin/blog/'+lang+'/post/updateContentTools'); //update a parte perche' gli do in pasto un array post|txt|<post_id>  aggiorno la tabella post il campo txt id ..
    		//console.log(payload);
    		xhr.send(payload);

        });
        */

        FIXTURE_TOOLS = [
            ['undo', 'redo', 'remove']
        ];
        IMAGE_FIXTURE_TOOLS = [
            ['undo', 'redo', 'image']
        ];
        LINK_FIXTURE_TOOLS = [
            ['undo', 'redo', 'link']
        ];
        ContentEdit.Root.get().bind('focus', function(element) {
            var tools;
            if (element.isFixed()) {
                if (element.type() === 'ImageFixture') {
                    tools = IMAGE_FIXTURE_TOOLS;
                } else if (element.tagName() === 'a') {
                    tools = LINK_FIXTURE_TOOLS;
                } else {
                    tools = FIXTURE_TOOLS;
                }
            } else {
                tools = ContentTools.DEFAULT_TOOLS;
            }
            if (editor.toolbox().tools() !== tools) {
                return editor.toolbox().tools(tools);
            }
        });
        req = new XMLHttpRequest();
        req.overrideMimeType('application/json');
        req.open('GET', 'https://raw.githubusercontent.com/GetmeUK/ContentTools/master/translations/lp.json', true);
        return req.onreadystatechange = function(ev) {
            var translations;
            if (ev.target.readyState === 4) {
                translations = JSON.parse(ev.target.responseText);
                ContentEdit.addTranslations('lp', translations);
                return ContentEdit.LANGUAGE = 'lp';
            }
        };
    };

}).call(this);