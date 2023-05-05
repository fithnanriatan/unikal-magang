const base_url = $('#page-top #base-url').data('url')

const flashAuth = $('.flash-data').data('flashauth');

const Toast = Swal.mixin({
	toast: true,
	position: 'top',
	showConfirmButton: false,
	timer: 1500,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}

})

if (flashAuth) {
	Swal.fire({
		toast: true,
		icon: 'success',
		titleText: flashAuth,
		position: 'top',
		backdrop: false,
		showConfirmButton: false,
		timer: 1500,
		showClass: {
			popup: 'animate__animated animate__bounceInDown'
		},
		hideClass: {
			popup: 'animate__animated animate__fadeOut'
		}
	})
}
