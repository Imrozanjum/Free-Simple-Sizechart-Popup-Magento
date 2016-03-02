jQuery(function ($) {
	
	
	
	
	var contact = {
		message: null,
		init: function () {
			$('#Mambaweb-contact-form a').click(function (e) {
				e.preventDefault();
				// load the contact form using ajax
				$value = $('#Mambaweb-contact-form > a').attr('href') + '?product_id=' + this.id + '&product_options=' + $(this).attr('productoptions');
				//alert($value);
				$.get($value, function(data){
					//alert(data);
					// create a modal dialog with the data
					$(data).modal({
						closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
						position: ["16%",],
						overlayId: 'contact-overlay',
						containerId: 'contact-container',
						onOpen: contact.open,
						onShow: contact.show,
						onClose: contact.close
					});
				});
			});


			$('#Mambaweb-contact-form a').hover(function(e) {
				var productOptions = '';
				var productOptionsCount = 0;

				$$('#product-options-wrapper dt').each(function(dt) {
					// get custom option's label
					var label = '';
					$A(dt.down('label').childNodes).each(function(node) {
						if (node.nodeType == 3) {
						  label += node.nodeValue;
						}
					});
					label = jQuery.trim(label);

					if (productOptionsCount > 0) {
					  productOptions += ' <br>';
					}
					productOptions += label + ': ';

		  			var dd = dt.next();
					var div = dd.down('div');

					var comboBox = div.down('select');
					if (comboBox) {
						$A(comboBox.options).each(function(opt, i) {
							if (comboBox.value == opt.getAttribute('value')) {
								var key = $.trim($(opt).text());
								productOptions += key;
							}
						});
					}

					var checkboxCount = 0;
					$(div).attr('class', 'currentdiv');
					$$('.currentdiv input').each(function(inputBox) {
						if (inputBox.type == 'checkbox' || inputBox.type == 'radio') {
							if (inputBox.checked) {
								inputBoxSpan = $(inputBox).next();
								inputBoxSpanLabel = $(inputBoxSpan).children();
								if (checkboxCount > 0) {
									productOptions += ', ';
								}
								productOptions += $(inputBoxSpanLabel).text();
								checkboxCount++;
							}
						}
						else {
							productOptions += inputBox.value;
						}
					});

					$$('.currentdiv textarea').each(function(textArea) {
						productOptions += textArea.value;
					});
					$(div).removeClass('currentdiv');

					productOptionsCount++;
				});
				$(this).attr('productoptions', productOptions);
			});


		},
		open: function (dialog) {
			// add padding to the buttons in firefox/mozilla
			
		///********************************  Edit By *****************************
		//************* Code for validation of textbox and print message while lose focus*******/	
			
			var temp;  //variable for store text box value 
			
			$('#contact-container #contact-name').focusout(function () {
    					
    				if(!(jQuery.trim($(this).val()).length))
    				{
    				$('#contact-name-error').html("Please Enter Name");
					}
					else
					{
						$('#contact-name-error').html("");
					}
			});
			
			
			$('#contact-container #contact-email').focusout(function () {
    					
    				
    				if(!(jQuery.trim($(this).val()).length))
    				{
    						$('#contact-email-error').html("Please Enter Email Id");
    						
					}
					else {
							
							var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  							if(regex.test(jQuery.trim($(this).val())))
  							{
								$('#contact-email-error').html("");
  							}
  							else
  							{
  								$('#contact-email-error').html("Please Enter valid email id");
  							}
						}
				});
			
			$('#contact-container #country_name').focusout(function () {
    				
    					
    				if(!$(this).val())
    				{
    					$('#country_name-error').html("&nbsp;&nbsp;&nbsp;Please Select Country");
					}
					else
					{
						$('#country_name-error').html("");
					}
			});
			
			$('#contact-container #contact-message').focusout(function () {
    				
    					
    				if(!$(this).val())
    				{
    					$('#contact-message-error').html("Please Enter Message");
					}
					else
					{
						$('#contact-message-error').html("&nbsp;");
					}
			});
			
			
		
			
			//***************************************  End Validation ********************************//
			
			
			if ($.browser.mozilla) {
				$('#contact-container .contact-button').css({
					'padding-bottom': '2px'
				});
			}
			// input field font size
			if ($.browser.safari) {
				$('#contact-container .contact-input').css({
					'font-size': '.9em'
				});
			}

			// dynamically determine height
			var h = 280;
			if ($('#contact-subject').length) {
				h += 26;
			}
			if ($('#contact-cc').length) {
				h += 22;
			}

			var title = $('#contact-container .contact-title').html();
			$('#contact-container .contact-title').html('Loading...');
			dialog.overlay.fadeIn(200, function () {
				dialog.container.fadeIn(200, function () {
					dialog.data.fadeIn(200, function () {
						$('#contact-container .contact-content').animate({
							
						}, function () {
							$('#contact-container .contact-title').html(title);
							$('#contact-container form').fadeIn(200, function () {
								$('#contact-container #contact-name').focus();

								$('#contact-container .contact-cc').click(function () {
									var cc = $('#contact-container #contact-cc');
									cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
								});

								// fix png's for IE 6
								if ($.browser.msie && $.browser.version < 7) {
									$('#contact-container .contact-button').each(function () {
										if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
											var src = RegExp.$1;
											$(this).css({
												backgroundImage: 'none',
												filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
											});
										}
									});
								}
							});
						});
					});
				});
			});
		},
		show: function (dialog) {
			$('#contact-container .contact-send').click(function (e) {
				e.preventDefault();
				// validate form
				if (contact.validate()) {
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(function () {
						//msg.removeClass('contact-error').empty();
					});
					$('#contact-container .contact-title').html('Sending...');
					$('#contact-container form').fadeOut(200);
					$('#contact-container .contact-content').animate({
						height: '354px'
					}, function () {
						$('#contact-container .contact-loading').fadeIn(200, function () {
							$.ajax({
								url: $value,
								data: $('#contact-container form').serialize() + '&action=send',
								type: 'post',
								cache: false,
								dataType: 'html',
								success: function (data) {
									$('#contact-container .contact-loading').fadeOut(200, function () {
										$('#contact-container .contact-title').html('Thank you for Contacting us.');
										msg.html(data).fadeIn(200);
										$('.modal-close').click();
									});
								},
								error: contact.error
							});
						});
					});
				}
				else {
					if ($('#contact-container .contact-message:visible').length > 0) {
						var msg = $('#contact-container .contact-message div');
						msg.fadeOut(200, function () {
							msg.empty();
							contact.showError();
							msg.fadeIn(200);
							$('.modal-close').click();
						});
					}
					else {
						$('#contact-container .contact-message').animate({
							height: '30px'
						}, contact.showError);
					}
					
				}
			});
		},
		close: function (dialog) {
			$('#contact-container .contact-message').fadeOut();
			$('#contact-container .contact-title').html();
			$('#contact-container form').fadeOut(200);
			$('#contact-container .contact-content').animate({
				height: 40
			}, function () {
				dialog.data.fadeOut(200, function () {
					dialog.container.fadeOut(200, function () {
						dialog.overlay.fadeOut(200, function () {
							$.modal.close();
						});
					});
				});
			});
		},
		error: function (xhr) {
			alert(xhr.statusText);
		},
		
		
		
		
		validate: function () {
			// variable for check all text field have data
			var flag=1;
			
			
			if (!$('#contact-container #contact-name').val()) {
				$('#contact-name-error').html("Please Enter Name");
				flag=0;
			}
			else{
				$('#contact-name-error').html("");
			}
			
			////************* Email Id validation ***********///////
			
			var email = $('#contact-container #contact-email').val();
			if (!email) {
				
				$('#contact-email-error').html("Please Enter Email Id");
				flag=0;
			}
			else {
				if (!contact.validateEmail(email)) {
					$('#contact-email-error').html("Please Enter Valid Email Id");
					flag=0;
				}
				else{
					
					$('#contact-email-error').html(" ");
				}
			}
			
			////************ Phone Numbe validation  ************////			
			
			   stri = $('#contact-container #contact-telephone').val();
								
				if(isNaN(stri))
				 {
   					
   					$('#contact-telephone-error').html("Pelase Enter valid Phome number");
				    flag=0;   
				}
				else
				{
					$('#contact-telephone-error').html("");
					
				}


			//********* ********* Country Name Validation **********////

			if (!$('#contact-container #country_name').val()) {
				$('#country_name-error').html("&nbsp;&nbsp;&nbsp;Please Select Country");
				flag=0;
			}
			else
			{
					$('#country_name-error').html("");
			}
		
		

			if (!$('#contact-container #contact-message').val()) {
				$('#contact-message-error').html("Please Enter Message");
				flag=0;
			}
			else
			{
				$('#contact-message-error').html("&nbsp;");
			}

		/**************************** Policy Validation *****************/
			
			
			if($('#spantermsandcondition').html().length > 10)
			{
				
				if( !$('#termsandcondition').is(':checked'))
				{
					flag=0;
				$('#termsandcondition-error').html("Please Confirm it");
				}
				else
				{
							$('#termsandcondition-error').html("");
					
				}
				
			}
			
		

			
			if (flag) {
			
				return true;
			}
			else {
				return false;
			}
		},
		
		
		validateEmail: function (email) {
			var at = email.lastIndexOf("@");

			// Make sure the at (@) sybmol exists and  
			// it is not the first or last character
			if (at < 1 || (at + 1) === email.length)
				return false;

			// Make sure there aren't multiple periods together
			if (/(\.{2,})/.test(email))
				return false;

			// Break up the local and domain portions
			var local = email.substring(0, at);
			var domain = email.substring(at + 1);

			// Check lengths
			if (local.length < 1 || local.length > 64 || domain.length < 4 || domain.length > 255)
				return false;

			// Make sure local and domain don't start with or end with a period
			if (/(^\.|\.$)/.test(local) || /(^\.|\.$)/.test(domain))
				return false;

			// Check for quoted-string addresses
			// Since almost anything is allowed in a quoted-string address,
			// we're just going to let them go through
			if (!/^"(.+)"$/.test(local)) {
				// It's a dot-string address...check for valid characters
				if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
					return false;
			}

			// Make sure domain contains only valid characters and at least one period
			if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
				return false;	

			return true;
		},
		showError: function () {
			$('#contact-container .contact-message')
				.html($('<div class="contact-error"></div>').append(contact.message))
				.fadeIn(200);
		}
	};

	contact.init();

});