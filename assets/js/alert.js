const base_url = $('#page-top #base-url').data('url')

const flashAuth = $('.flash-data').data('flashauth');
const flashMain = $('.flash-data').data('flashmain');
const flashEror = $('.flash-data').data('flasheror');

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

if (flashMain) {

	Toast.fire({
		icon: 'success',
		title: flashMain,
		width: 470
	})

}

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

if (flashEror) {
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: flashEror,
		footer: "<a href='"+base_url+"'>Hapus atau Ubah Data Pembimbing atau Siswa</a>"
	})
}

// logout
$('.btn-logout').on('click', function (e) {

	e.preventDefault()

	Swal.fire({
		title: 'Ready to Leave?',
		text: 'Select "Logout" below if you are ready to end your current session.',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Logout'
	}).then((result) => {
		if (result.isConfirmed) {

			document.location.href = $(this).attr('href')

		}
	})

})

// confirm hapus
// $('.btn-hapus').on('click', function (e) {

// 	e.preventDefault()
// 	const href = $(this).attr('href')

// 	Swal.fire({
// 		icon: 'warning',
// 		title: 'Apakah anda yakin?',
// 		text: "Data sekolah akan dihapus",
// 		showCancelButton: true,
// 		confirmButtonColor: '#3085d6',
// 		cancelButtonColor: '#d33',
// 		confirmButtonText: 'Hapus'
// 	}).then((result) => {
// 		if (result.isConfirmed) {
// 			document.location.href = href
// 		}
// 	})

// })

$('.table').on('click', '.btn-hapus', function (e) {

	e.preventDefault()
	const href = $(this).attr('href')
	const id = $(this).data('id');

	Swal.fire({
		icon: 'warning',
		title: 'Apakah anda yakin?',
		text: "Data akan dihapus",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus'
	}).then((result) => {
		if (result.isConfirmed) {
			// Delete Data //
			$.ajax({
				url: href,
				data: {id: id},
				method: 'POST',
				
				dataType: 'json',
				success: function (data) {

					// mengarahkan ke url alert
					// window.location.href = base_url + "dashboard/alert/" + data.flash + '/' + data.message + '/' + data.target

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
					Toast.fire({
						icon: 'success',
						title: data.message,
						width: 370
					})

                    window.location.href = base_url + "dashboard/alert/" + data.flash + '/' + data.message + '/' + data.target

				}
			})

		}
	})

})