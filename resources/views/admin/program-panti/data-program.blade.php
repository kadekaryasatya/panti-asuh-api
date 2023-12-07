@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Artikel /</span> <b>Data Artikel</b>
        </h4>


        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="d-flex pad-rem">
                <div class="w-75 mt-3 mb-3 quick-sand">
                    <h3>
                        Tabel Data Artikel
                    </h3>
                </div>
                <div class="col-lg-3 col-md-6 quick-sand">
                    <div class="mt-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="">

                            </div>
                            <div class=""></div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                <i class='bx bx-plus m-1'></i>
                                Tambah Data Artikel
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Artikel
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="dataForm">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="jenis_program_id" class="form-label">Jenis Kegiatan</label>
                                                <select class="form-select" id="jenis_program_id" name="jenis_program_id"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih Jenis Kegiatan</option>
                                                </select>
                                                <div id="jenis_program_idError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="row">
                                                <input type="text" hidden value="True" name="isAdmin">
                                                <div class="col mb-3">
                                                    <label for="judul" class="form-label">Nama Program</label>
                                                    <input type="text" id="judul" name="judul" class="form-control"
                                                        placeholder="Nama Program ..." />
                                                    <div id="judulError" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi
                                                </label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                                                <div id="deskripsiError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="jadwal" class="form-label">Jadwal Program</label>
                                                    <input type="text" id="jadwal" name="jadwal" class="form-control"
                                                        placeholder="Jadwal Program ..." />
                                                    <div id="jadwalError" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gambar_thumbnail" class="form-label">GambarThumbnail
                                                    Program</label>
                                                <input class="form-control" type="file" id="gambar_thumbnail"
                                                    name="gambar_thumbnail" />
                                                <div id="gambar_thumbnailError" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="postSubmit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Anak
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="editForm">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" id="editId" name="id" />
                                                <label for="editjenis_program_id" class="form-label">Jenis
                                                    Kegiatan</label>
                                                <select class="form-select" id="editjenis_program_id"
                                                    name="jenis_program_id" aria-label="Default select example">
                                                    <option value="" hidden>Pilih Jenis Kegiatan</option>
                                                </select>
                                                <div id="editjenis_program_idError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="row">
                                                <input type="text" hidden value="True" name="isAdmin">
                                                <div class="col mb-3">
                                                    <label for="editjudul" class="form-label">Nama Program</label>
                                                    <input type="text" id="editjudul" name="judul"
                                                        class="form-control" placeholder="Nama Program ..." />
                                                    <div id="editjudulError" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editdeskripsi" class="form-label">Deskripsi
                                                </label>
                                                <textarea class="form-control" id="editdeskripsi" name="deskripsi" rows="3"></textarea>
                                                <div id="editdeskripsiError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="editjadwal" class="form-label">Jadwal Program</label>
                                                    <input type="text" id="editjadwal" name="jadwal"
                                                        class="form-control" placeholder="Jadwal Program ..." />
                                                    <div id="editjadwalError" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editgambar_thumbnail" class="form-label">GambarThumbnail
                                                    Program</label>
                                                <input class="form-control" type="file" id="editgambar_thumbnail"
                                                    name="gambar_thumbnail" />
                                                <div id="editgambar_thumbnailError" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="postSubmit"
                                                class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive pad-rem">
                <table class="datatables-basic table border-top quick-sand" id="dataTable">
                    <thead>
                        <tr>
                            <th class="col-md-1 text-center fw-bold">No</th>
                            <th class="col-md-1 text-center fw-bold">Jenis Program</th>
                            <th class="col-md-1 text-center fw-bold">Judul</th>
                            <th class="col-md-1 text-center fw-bold">Jadwal</th>
                            <th class="col-md-1 text-center fw-bold">Deskripsi</th>
                            <th class="col-md-1 text-center fw-bold">Dibuat Oleh</th>
                            <th class="col-md-2 text-center fw-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tableBody">
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Fetch data using Axios
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            axios.get('http://127.0.0.1:8000/api/program-panti')
                .then(function(response) {
                    // Handle successful response
                    var data = response.data.program;
                    var jenis = response.data.jenis;
                    data.forEach(function(item, index) {
                        item.nomer = index + 1;
                    });
                    console.log(response.data);

                    var select = $('#jenis_program_id');
                    select.empty();
                    select.append('<option value="" hidden>Pilih Jenis Program</option>');

                    jenis.forEach(function(jenis) {
                        select.append('<option value="' + jenis.id + '">' + jenis.nama + '</option>');
                    });

                    var select = $('#editjenis_program_id');
                    select.empty();
                    select.append('<option value="" hidden>Pilih Jenis Program</option>');

                    jenis.forEach(function(jenis) {
                        select.append('<option value="' + jenis.id + '">' + jenis.nama + '</option>');
                    });

                    // Build DataTables
                    var dataTable = $('#dataTable').DataTable({
                        data: data,
                        columns: [{
                                data: 'nomer'
                            },
                            {
                                data: 'jenis_program.nama'
                            },
                            {
                                data: 'judul'
                            },
                            {
                                data: 'jadwal'
                            },
                            {
                                data: 'deskripsi'
                            },
                            {
                                data: 'isAdmin'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    // Customize your action buttons here
                                    return `
                                    <button type="button" class="btn btn-primary btn-sm btn-edit">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm delete-data" data-id="${row.id}">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                `;
                                }
                            }
                        ]
                    });

                    $('#dataTable').on('click', '.btn-edit', function() {
                        var tr = $(this).closest('tr');
                        var row = dataTable.row(tr).data();
                        console.log(row.id);

                        $('#editId').val(row.id);
                        $('#editjenis_program_id').val(row.jenis_program_id);
                        $('#editjudul').val(row.judul);
                        $('#editjadwal').val(row.jadwal);
                        $('#editdeskripsi').val(row.deskripsi);

                        // Show the edit modal
                        $('#editModal').modal('show');
                    });

                    // Handle click event on delete buttons
                    $('#dataTable').on('click', '.delete-data', function() {
                        var tr = $(this).closest('tr');

                        // Check if a valid DataTable row is available
                        if (dataTable && tr.length > 0) {
                            var row = dataTable.row(tr).data();
                            if (row) {
                                var dataId = row.id;

                                // Confirm deletion using SweetAlert2
                                Swal.fire({
                                    title: 'Konfirmasi Hapus Data',
                                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Ya, Hapus!',
                                    cancelButtonText: 'Batal'
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        // Delete data using Axios
                                        axios.delete(
                                                `http://127.0.0.1:8000/api/program-panti/${dataId}`
                                            )
                                            .then(function(response) {
                                                // Handle success
                                                console.log('Data berhasil dihapus:',
                                                    response.data);

                                                // Show success message using SweetAlert2
                                                Swal.fire({
                                                    title: 'Sukses!',
                                                    text: 'Data berhasil dihapus.',
                                                    icon: 'success'
                                                }).then(function() {
                                                    // Reload the page after clicking "OK" on SweetAlert2
                                                    location.reload();
                                                });
                                            })
                                            .catch(function(error) {
                                                // Handle error
                                                console.error('Error deleting data:',
                                                    error);
                                            });
                                    }
                                });
                            } else {
                                console.error('Error: Unable to retrieve DataTable row data.');
                            }
                        } else {
                            console.error('Error: Invalid DataTable or row element.');
                        }
                    });


                })
                .catch(function(error) {
                    // Handle error
                    console.error('Error fetching data:', error);
                });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Menangani submit formulir edit
            $('#editForm').submit(function(event) {
                event.preventDefault();

                // Mengambil data formulir
                var formData = new FormData(this);

                var idValue = formData.get('id');

                // Kirim permintaan Ajax
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/program-panti/' + idValue,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Cache-Control': 'no-cache',
                        'Accept': 'application/json',
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('Data berhasil diupdate:', response);

                        // Tampilkan notifikasi SweetAlert2
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data berhasil diupdate!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Muat ulang halaman setelah mengklik OK
                            location.reload();
                        });
                    },
                    error: function(error) {
                        console.error('Error updating data:', error);

                        // Tampilkan notifikasi SweetAlert2 untuk kesalahan
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengupdate data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan formulir
            var dataForm = document.getElementById('dataForm');

            // Menangani submit formulir
            dataForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah formulir untuk melakukan submit secara normal

                // Mendapatkan data formulir
                var formData = new FormData(dataForm);
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }

                // Kirim permintaan POST menggunakan Axios
                axios.post('http://127.0.0.1:8000/api/program-panti', formData)
                    .then(function(response) {
                        // Handle success
                        console.log('Data berhasil disimpan:', response.data);

                        // Tampilkan notifikasi SweetAlert2 untuk sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan!',
                            timer: 2000, // Durasi notifikasi (ms)
                            showConfirmButton: true // Tidak menampilkan tombol OK
                        }).then(function() {
                            // Me-reload halaman setelah mengklik "OK"
                            location.reload();
                        });

                        // Tutup modal jika diperlukan
                        var basicModal = new bootstrap.Modal(document.getElementById('basicModal'));
                        basicModal.hide();
                    })
                    .catch(function(error) {
                        // Handle error
                        console.error('Gagal menyimpan data:', error);

                        // Tampilkan notifikasi SweetAlert2 untuk error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menyimpan data. Silakan periksa kembali formulir Anda.'
                        });
                    });
            });
        });
    </script>
@endsection
