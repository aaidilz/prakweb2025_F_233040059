// Reset form ketika modal ditutup
const formModal = document.getElementById('formModal');
if (formModal) {
  formModal.addEventListener('hidden.bs.modal', function () {
    // Reset form
    document.getElementById('formUser').reset();
    // Reset form action ke store (tambah)
    document.getElementById('formUser').action = document.getElementById('formUser').getAttribute('data-action-store');
    // Reset judul modal
    document.getElementById('formModalLabel').textContent = 'Tambah Data User';
    // Reset button text
    document.querySelector('.modal-footer button[type=submit]').textContent = 'Tambah Data';
    // Clear id
    document.getElementById('id').value = '';
  });

  // Ketika modal dibuka untuk tambah data
  const btnTambah = document.querySelector('[data-bs-target="#formModal"]:not(.tampilModalUbah)');
  if (btnTambah) {
    btnTambah.addEventListener('click', function () {
      const form = document.getElementById('formUser');
      const baseUrl = form.action.split('/user/')[0];
      form.action = baseUrl + '/user/store';
      document.getElementById('formModalLabel').textContent = 'Tambah Data User';
      document.querySelector('.modal-footer button[type=submit]').textContent = 'Tambah Data';
    });
  }

  // Ketika tombol ubah diklik
  const btnUbah = document.querySelectorAll('.tampilModalUbah');
  btnUbah.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.getAttribute('data-id');
      const form = document.getElementById('formUser');
      const baseUrl = form.action.split('/user/')[0];
      
      // Ubah form action ke update
      form.action = baseUrl + '/user/update';
      document.getElementById('formModalLabel').textContent = 'Ubah Data User';
      document.querySelector('.modal-footer button[type=submit]').textContent = 'Ubah Data';
      
      // Fetch data user
      fetch(baseUrl + '/user/getubah', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id
      })
      .then(response => response.json())
      .then(data => {
        document.getElementById('id').value = data.id;
        document.getElementById('name').value = data.name;
        document.getElementById('email').value = data.email;
      })
      .catch(error => console.error('Error:', error));
    });
  });
}
