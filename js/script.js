document.addEventListener('DOMContentLoaded', function () {

  const confirmButton = document.getElementById('confirmButton');
  confirmButton.addEventListener('click', function (e) {
    e.preventDefault();

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
          paymentForm.submit();
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

// Scroll navbar
$('.nav-scroll').on('click', function (e) {

  var target = $(this).attr('href');
  var targetElement = $(target);

  $('html').animate({
    scrollTop: targetElement.offset().top
  });

  e.preventDefault();
});

function goBack() {
  window.history.back();
}

