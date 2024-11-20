<form action="{{ url('/user/ajax') }}" method="POST" id="form-tambah">
    @csrf
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="form-tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_level">Id Level</label>
                        <input type="text" name="id_level" id="id_level" class="form-control" required>
                        <small id="error-id_level" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi">Id Prodi</label>
                        <input type="text" name="id_prodi" id="id_prodi" class="form-control" required>
                        <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email User</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="no_tlp">Nomor Telepon User</label>
                        <input type="text" name="no_tlp" id="no_tlp" class="form-control" required>
                        <small id="error-no_tlp" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle form submission
        $("#form-tambah").on("submit", function(e) {
            e.preventDefault();

            // AJAX request
            $.ajax({
                url: "{{ url('/users/ajax') }}", // Endpoint untuk menyimpan data
                method: "POST",
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    if (response.status) {
                        $('#createModal').modal('hide'); // Tutup modal
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        $('#dataTable').DataTable().ajax.reload(); // Reload data tabel
                    } else {
                        $('.error-text').text(''); // Bersihkan error sebelumnya
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]); // Tampilkan error pada elemen spesifik
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan pada server. Silakan coba lagi.'
                    });
                }
            });
        });
    });
</script>
