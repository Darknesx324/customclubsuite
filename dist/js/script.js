function start_loader(){
	$('body').append('<div id="preloader"><div class="loader-holder"><div></div><div></div><div></div><div></div>')
}
function end_loader(){
	 $('#preloader').fadeOut('fast', function() {
		$('#preloader').remove();
      })
}
// function 
window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
	   	 var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	      Toast.fire({
	        icon: $bg,
	        title: $msg
	      })
	  }

$(document).ready(function(){
	// Login
	$('#login-frm').submit(function(e){
		e.preventDefault()
		start_loader()
		if($('.err_msg').length > 0)
			$('.err_msg').remove()
		$.ajax({
			url:_base_url_+'classes/Login.php?f=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)

			},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					if(resp.status == 'success'){
						location.replace(_base_url_+'admin');
					}else if(resp.status == 'incorrect'){
						var _frm = $('#login-frm')
						var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>"
						_frm.prepend(_msg)
						_frm.find('input').addClass('is-invalid')
						$('[name="username"]').focus()
					}
						end_loader()
				}
			}
		})
	})
	//Establishment Login
	$('#flogin-frm').submit(function(e){
		e.preventDefault()
		start_loader()
		if($('.err_msg').length > 0)
			$('.err_msg').remove()
		$.ajax({
			url:_base_url_+'classes/Login.php?f=flogin',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)

			},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					if(resp.status == 'success'){
						location.replace(_base_url_+'faculty');
					}else if(resp.status == 'incorrect'){
						var _frm = $('#flogin-frm')
						var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>"
						_frm.prepend(_msg)
						_frm.find('input').addClass('is-invalid')
						$('[name="username"]').focus()
					}
						end_loader()
				}
			}
		})
	})

	//user login
	$('#slogin-frm').submit(function(e){
		e.preventDefault()
		start_loader()
		if($('.err_msg').length > 0)
			$('.err_msg').remove()
		$.ajax({
			url:_base_url_+'classes/Login.php?f=slogin',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)

			},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					if(resp.status == 'success'){
						location.replace(_base_url_+'student');
					}else if(resp.status == 'incorrect'){
						var _frm = $('#slogin-frm')
						var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>"
						_frm.prepend(_msg)
						_frm.find('input').addClass('is-invalid')
						$('[name="username"]').focus()
					}
						end_loader()
				}
			}
		})
	})
	// System Info
	$('#system-frm').submit(function(e){
		e.preventDefault()
		start_loader()
		if($('.err_msg').length > 0)
			$('.err_msg').remove()
		$.ajax({
			url:_base_url_+'classes/SystemSettings.php?f=update_settings',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					// alert_toast("Data successfully saved",'success')
						location.reload()
				}else{
					$('#msg').html('<div class="alert alert-danger err_msg">An Error occured</div>')
					end_load()
				}
			}
		})
	})

	// Auto-adjust dropdown position when near bottom edge
	function adjustDropdownPosition() {
		$('.dropdown-menu.show, .dropdown-menu[style*="display"]').each(function() {
			var $dropdown = $(this);
			var $toggle = $dropdown.siblings('.dropdown-toggle, [data-toggle="dropdown"]').first();
			if ($toggle.length === 0) {
				$toggle = $dropdown.closest('.dropdown, .btn-group').find('.dropdown-toggle, [data-toggle="dropdown"]').first();
			}
			var $parent = $dropdown.closest('.dropdown, .btn-group');
			
			if ($toggle.length === 0) return;
			
			// Get button position
			var toggleOffset = $toggle.offset();
			var toggleHeight = $toggle.outerHeight();
			var toggleWidth = $toggle.outerWidth();
			var toggleBottom = toggleOffset.top + toggleHeight;
			var toggleRight = toggleOffset.left + toggleWidth;
			
			// Get dropdown dimensions
			var dropdownHeight = $dropdown.outerHeight() || 200;
			var dropdownWidth = $dropdown.outerWidth() || 240;
			
			// Get viewport dimensions
			var windowHeight = $(window).height();
			var windowWidth = $(window).width();
			var scrollTop = $(window).scrollTop();
			var scrollLeft = $(window).scrollLeft();
			var viewportBottom = scrollTop + windowHeight;
			var viewportRight = scrollLeft + windowWidth;
			
			// Calculate space
			var spaceBelow = viewportBottom - toggleBottom;
			var spaceAbove = toggleOffset.top - scrollTop;
			var spaceRight = viewportRight - toggleRight;
			var spaceLeft = toggleOffset.left - scrollLeft;
			
			var topPosition, leftPosition, rightPosition;
			
			// For fixed position dropdowns (in tables)
			if ($dropdown.css('position') === 'fixed' || $parent.closest('.table').length > 0) {
				// Calculate top position
				if (spaceBelow >= dropdownHeight + 20) {
					// Enough space below
					topPosition = toggleBottom + 5;
				} else if (spaceAbove >= dropdownHeight + 20) {
					// Not enough space below, but enough above
					topPosition = toggleOffset.top - dropdownHeight - 5;
				} else {
					// Not enough space either way, position at bottom with scroll
					topPosition = Math.max(20, viewportBottom - dropdownHeight - 20);
					$dropdown.css({
						'max-height': (viewportBottom - topPosition - 10) + 'px',
						'overflow-y': 'auto'
					});
				}
				
				// Calculate horizontal position
				if (spaceRight >= dropdownWidth) {
					// Enough space on right
					leftPosition = toggleOffset.left;
					rightPosition = 'auto';
				} else if (spaceLeft >= dropdownWidth) {
					// Not enough space on right, but enough on left
					leftPosition = 'auto';
					rightPosition = viewportRight - toggleRight;
				} else {
					// Center it
					leftPosition = Math.max(10, (viewportRight - dropdownWidth) / 2);
					rightPosition = 'auto';
				}
				
				$dropdown.css({
					'position': 'fixed',
					'top': topPosition + 'px',
					'left': typeof leftPosition === 'number' ? leftPosition + 'px' : leftPosition,
					'right': rightPosition,
					'z-index': '9999'
				});
			} else {
				// For absolute position dropdowns
				if (spaceBelow < 50 && spaceAbove > dropdownHeight + 50) {
					$parent.addClass('dropup');
					$dropdown.css({
						'top': 'auto',
						'bottom': '100%',
						'margin-top': '0',
						'margin-bottom': '5px'
					});
				} else if (spaceBelow < 50) {
					var maxHeight = Math.min(dropdownHeight, spaceBelow - 20);
					$dropdown.css({
						'max-height': maxHeight + 'px',
						'overflow-y': 'auto'
					});
				}
				
				// Horizontal positioning
				if (spaceRight < dropdownWidth && spaceLeft > dropdownWidth) {
					$dropdown.css({
						'left': 'auto',
						'right': '0'
					});
				} else if (toggleRight + dropdownWidth > viewportRight) {
					$dropdown.css({
						'left': 'auto',
						'right': '10px'
					});
				}
			}
		});
	}

	// Adjust dropdowns on show
	$(document).on('show.bs.dropdown', '.dropdown, .btn-group', function() {
		setTimeout(adjustDropdownPosition, 10);
	});

	$(document).on('shown.bs.dropdown', '.dropdown, .btn-group', function() {
		adjustDropdownPosition();
	});

	// Adjust on scroll and resize
	$(window).on('scroll resize', function() {
		if ($('.dropdown-menu.show').length > 0) {
			adjustDropdownPosition();
		}
	});

	// Also handle Bootstrap dropdown events - ensure clicks work
	$(document).on('click', '.dropdown-toggle, [data-toggle="dropdown"]', function(e) {
		e.stopPropagation();
		setTimeout(function() {
			adjustDropdownPosition();
		}, 50);
	});

	// Ensure delete buttons work - use event delegation with higher priority
	$(document).off('click', '.delete_data').on('click', '.delete_data', function(e) {
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this);
		var id = $this.attr('data-id');
		
		if (!id) {
			console.error('No data-id found on delete button');
			return false;
		}
		
		// Close dropdown first
		$this.closest('.dropdown-menu').removeClass('show');
		$this.closest('.btn-group').removeClass('show');
		
		// Try to find the delete function from the script tags or use a generic one
		var deleteFuncName = 'delete_item';
		
		// Check if there's a delete function defined in the page
		if (typeof window.delete_service_request === 'function') {
			deleteFuncName = 'delete_service_request';
		} else if (typeof window.delete_mechanic === 'function') {
			deleteFuncName = 'delete_mechanic';
		} else if (typeof window.delete_service === 'function') {
			deleteFuncName = 'delete_service';
		} else if (typeof window.delete_user === 'function') {
			deleteFuncName = 'delete_user';
		} else if (typeof window.delete_category === 'function') {
			deleteFuncName = 'delete_category';
		}
		
		_conf("¿Está seguro de eliminar este elemento permanentemente?", deleteFuncName, [id]);
		return false;
	});

	// Ensure dropdown items are clickable - don't prevent default for non-delete items
	$(document).on('click', '.dropdown-item:not(.delete_data)', function(e) {
		// Allow normal link behavior
	});

	// Ensure dropdown toggles work
	$(document).on('click', '.dropdown-toggle', function(e) {
		e.stopPropagation();
		var $toggle = $(this);
		var $menu = $toggle.siblings('.dropdown-menu').first();
		if ($menu.length === 0) {
			$menu = $toggle.closest('.dropdown, .btn-group').find('.dropdown-menu').first();
		}
		
		if ($menu.length > 0) {
			// Close other dropdowns
			$('.dropdown-menu.show').not($menu).removeClass('show');
			$('.btn-group.show').not($toggle.closest('.btn-group')).removeClass('show');
			
			// Toggle this dropdown
			$menu.toggleClass('show');
			$toggle.closest('.dropdown, .btn-group').toggleClass('show');
			
			// Adjust position
			setTimeout(adjustDropdownPosition, 10);
		}
	});

	// Close dropdowns when clicking outside
	$(document).on('click', function(e) {
		if (!$(e.target).closest('.dropdown, .btn-group, .dropdown-menu, .dropdown-toggle').length) {
			$('.dropdown-menu.show').removeClass('show');
			$('.dropdown.show, .btn-group.show').removeClass('show');
		}
	});

	// Ensure modals are properly centered and closable
	$('#confirm_modal, #uni_modal').on('show.bs.modal', function() {
		var $modal = $(this);
		var $dialog = $modal.find('.modal-dialog');
		
		// Force centering
		$dialog.css({
			'margin': '0 auto',
			'top': '50%',
			'transform': 'translateY(-50%)',
			'position': 'relative'
		});
		
		// Ensure backdrop is clickable
		$modal.attr('data-backdrop', 'true');
		$modal.attr('data-keyboard', 'true');
	});

	// Close modal on backdrop click
	$('#confirm_modal, #uni_modal').on('click', function(e) {
		if ($(e.target).hasClass('modal') || $(e.target).hasClass('modal-backdrop')) {
			$(this).modal('hide');
		}
	});

	// Close modal on ESC key
	$(document).on('keydown', function(e) {
		if (e.key === 'Escape' || e.keyCode === 27) {
			$('#confirm_modal, #uni_modal').modal('hide');
		}
	});

	// Ensure close buttons work
	$('.modal .close, .modal [data-dismiss="modal"]').on('click', function() {
		$(this).closest('.modal').modal('hide');
	});
})
