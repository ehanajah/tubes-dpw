document.addEventListener('DOMContentLoaded', function () {

  const confirmButton = document.getElementById('confirmButton');
  confirmButton.addEventListener('click', function () {
    const receiptName = document.getElementById('username').value;
    const address = document.getElementById('address').value;
    const region = document.getElementById('provinsi').value;
    const city = document.getElementById('city').value;
    const zip = document.getElementById('zip').value;

    if (!receiptName || !address || !region || !city || !zip) {
      // Jika ada form yang belum diisi, tampilkan pesan alert
      Swal.fire('Error!', 'Please fill in all the required fields.', 'error');
    } else {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Sure!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Success!',
            'Let\'s Wait Your Order Came Into Your House.',
            'success'
          )
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      });
    }
  });
});

$('.nav-scroll').on('click', function(e){
 
  var tujuan = $(this).attr('href');
  var elemenTujuan = $(tujuan);

  $('html').animate({
      scrollTop: elemenTujuan.offset().top - 20
  }, 600);

  e.preventDefault();
});