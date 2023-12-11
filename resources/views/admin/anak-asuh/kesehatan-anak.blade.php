@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Anak Asuh /</span> <b>Kesehatan Anak Asuh</b>
        </h4>


        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="d-flex pad-rem">
                <div class="w-75 mt-3 mb-3 quick-sand">
                    <h3>
                        Tabel Kesehatan Anak Asuh
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
                                Tambah Kesehatan Anak
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Kesehatan Anak
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="dataForm">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="anak_id" class="form-label">Anak Asuh</label>
                                                <select class="form-select" id="anak_id" name="anak_id"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih Anak Asuh</option>
                                                </select>
                                                <div id="anak_idError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="penyakit_id" class="form-label">Penyakit</label>
                                                <select class="form-select" id="penyakit_id" name="penyakit_id"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih Penyakit</option>
                                                    <option value="1">Batuk</option>
                                                    <option value="2">Demam</option>
                                                    <option value="3">Flu</option>
                                                </select>
                                                <div id="penyakit_idError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_sakit" class="form-label">Tanggal
                                                    Sakit</label>
                                                <input class="form-control" type="date" id="tanggal_sakit"
                                                    name="tanggal_sakit" />
                                                <div id="tanggal_sakitError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status Kesehatan</label>
                                                <select class="form-select" id="status" name="status"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih
                                                        Status Kesehatan
                                                    </option>
                                                    <option value="Sembuh">
                                                        Sembuh
                                                    </option>
                                                    <option value="Sedang Sakit">
                                                        Sedang Sakit
                                                    </option>
                                                </select>
                                                <div id="statusError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="obat_penyakit" class="form-label">Obat Penyakit</label>
                                                <input type="text" id="obat_penyakit" name="obat_penyakit"
                                                    class="form-control" placeholder="Nama Anak ..." />
                                                <div id="obat_penyakitError" class="invalid-feedback"></div>
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
                                        <h5 class="modal-title" id="exampleModalLabel1">Edit Kesehatan Anak
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="editForm">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="text" hidden id="editId" name="id">
                                                <label for="editanak_id" class="form-label">Anak Asuh</label>
                                                <select class="form-select" id="editanak_id" name="anak_id"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih Anak Asuh</option>
                                                </select>
                                                <div id="editanak_idError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editpenyakit_id" class="form-label">Penyakit</label>
                                                <select class="form-select" id="editpenyakit_id" name="penyakit_id"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih Penyakit</option>
                                                    <option value="1">Batuk</option>
                                                    <option value="2">Demam</option>
                                                    <option value="3">Flu</option>
                                                </select>
                                                <div id="editpenyakit_idError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edittanggal_sakit" class="form-label">Tanggal
                                                    Sakit</label>
                                                <input class="form-control" type="date" id="edittanggal_sakit"
                                                    name="tanggal_sakit" />
                                                <div id="edittanggal_sakitError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editstatus" class="form-label">Status Kesehatan</label>
                                                <select class="form-select" id="editstatus" name="status"
                                                    aria-label="Default select example">
                                                    <option value="" hidden>Pilih
                                                        Status Kesehatan
                                                    </option>
                                                    <option value="Sembuh">
                                                        Sembuh
                                                    </option>
                                                    <option value="Sedang Sakit">
                                                        Sedang Sakit
                                                    </option>
                                                </select>
                                                <div id="editstatusError" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="editobat_penyakit" class="form-label">Obat Penyakit</label>
                                                <input type="text" id="editobat_penyakit" name="obat_penyakit"
                                                    class="form-control" placeholder="Nama Anak ..." />
                                                <div id="editobat_penyakitError" class="invalid-feedback"></div>
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
                            <th class="col-md-2 text-center fw-bold">Nama Anak</th>
                            <th class="col-md-2 text-center fw-bold">Nama Penyakit</th>
                            <th class="col-md-1 text-center fw-bold">Obat Penyakit</th>
                            <th class="col-md-2 text-center fw-bold">Status</th>
                            <th class="col-md-2 text-center fw-bold">Tanggal Sakit</th>
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
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            axios.get('http://127.0.0.1:8000/api/kesehatan-anak')
                .then(function(response) {
                    // Handle successful response
                    console.log(response.data.kesehatan);
                    const data = response.data.kesehatan;
                    const anak = response.data.anak;
                    data.forEach(function(item, index) {
                        item.nomer = index + 1;
                    });

                    var select = $('#anak_id');
                    select.append('<option value="" hidden>Pilih Anak Asuh</option>');

                    anak.forEach(function(anak) {
                        select.append('<option value="' + anak.id + '">' + anak.nama + '</option>');
                    });

                    var selectEdit = $('#editanak_id');
                    anak.forEach(function(anak) {
                        selectEdit  .append('<option value="' + anak.id + '">' + anak.nama + '</option>');
                    });
                    console.log(data);
                    // Build DataTables
                    const dataTable = $('#dataTable').DataTable({
                        data: data,
                        columns: [{
                                data: 'nomer'
                            },
                            {
                                data: 'anak_asuhs.nama'
                            },
                            {
                                data: 'penyakit_id'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: 'tanggal_sakit'
                            },
                            {
                                data: 'obat_penyakit'
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
                        const tr = $(this).closest('tr');
                        const row = dataTable.row(tr).data();
                        console.log(row.id);

                        $('#editId').val(row.id);
                        $('#editanak_id').val(row.anak_id);
                        $('#editpenyakit_id').val(row.penyakit_id);
                        $('#editstatus').val(row.status);
                        $('#edittanggal_sakit').val(row.tanggal_sakit);
                        $('#editobat_penyakit').val(row.obat_penyakit);

                        // Show the edit modal
                        $('#editModal').modal('show');
                    });

                    // Handle click event on delete buttons
                    $('#dataTable').on('click', '.delete-data', function() {
                        const tr = $(this).closest('tr');

                        // Check if a valid DataTable row is available
                        if (dataTable && tr.length > 0) {
                            const row = dataTable.row(tr).data();
                            if (row) {
                                const dataId = row.id;

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
                                                `http://127.0.0.1:8000/api/kesehatan-anak/${dataId}`
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

    {{-- <script>
        axios.get('http://127.0.0.1:8000/api/kesehatan-anak')
            .then(function(response) {
                console.log(response.data);
                // Proses respons data di sini
            })
            .catch(function(error) {
                console.error('Error fetching data:', error);
            });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Menangani submit formulir edit
            $('#editForm').submit(function(event) {
                event.preventDefault();

                // Mengambil data formulir
                const formData = new FormData(this);
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                const idValue = formData.get('id');

                // Kirim permintaan Ajax
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/kesehatan-anak/' + idValue,
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
            const dataForm = document.getElementById('dataForm');

            // Menangani submit formulir
            dataForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah formulir untuk melakukan submit secara normal

                // Mendapatkan data formulir
                const formData = new FormData(dataForm);

                // Kirim permintaan POST menggunakan Axios
                axios.post('http://127.0.0.1:8000/api/kesehatan-anak', formData)
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
                        const basicModal = new bootstrap.Modal(document.getElementById('basicModal'));
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
