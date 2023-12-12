@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Donasi /</span> <b>Data Donasi</b>
        </h4>


        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="d-flex pad-rem">
                <div class="w-75 mt-3 mb-3 quick-sand">
                    <h3>
                        Tabel Data Donasi
                    </h3>
                </div>
                <div class="col-lg-3 col-md-6 quick-sand">
                    <div class="mt-3 mb-3">
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Anak
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
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
                            <th class="col-md-1 text-center fw-bold">Nama</th>
                            <th class="col-md-1 text-center fw-bold">Email</th>
                            <th class="col-md-1 text-center fw-bold">Nominal</th>
                            <th class="col-md-2 text-center fw-bold">Pesan</th>
                            <th class="col-md-1 text-center fw-bold">Bukti Transfer</th>
                            <th class="col-md-1 text-center fw-bold">Donatur</th>
                            <th class="col-md-1 text-center fw-bold">Status</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
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
            axios.get('http://127.0.0.1:8000/api/donasi')
                .then(function(response) {
                    // Handle successful response
                    var data = response.data;
                    data.forEach(function(item, index) {
                        item.nomer = index + 1;
                    });

                    // Build DataTables
                    var dataTable = $('#dataTable').DataTable({
                        data: data,
                        columns: [{
                                data: 'nomer'
                            },
                            {
                                data: 'nama'
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'nominal',
                                render: function(data, type, row) {
                                    return formatRupiah(data);
                                }
                            },
                            {
                                data: 'pesan'
                            },
                            // Inside DataTable
                            {
                                data: 'bukti_bayar',
                                render: function(data, type, row) {
                                    return '<a href="javascript:;" data-src="{{ asset('bukti-bayar') }}/' +
                                        data +
                                        '" data-fancybox="gallery" data-caption="Bukti Bayar"><img src="{{ asset('bukti-bayar') }}/' +
                                        data + '" alt="Bukti Bayar" class="img-thumbnail"></a>';
                                }
                            },
                            {
                                data: 'donatur'
                            },
                            {
                                data: 'isValid',
                                render: function(data, type, row) {

                                    // Customize your action buttons here
                                    if (row.isValid == 'berhasil') {
                                        return `
                                                <button type="button" class="btn btn-success btn-sm" >
                                                    <i class='bx bx-check'></i>Berhasil
                                                </button>
                                            `;
                                    } else if (row.isValid == 'pending') {
                                        return `
                                                <button type="button" class="btn btn-warning btn-sm update-data" data-id="${row.id}">
                                                    <i class='bx bxs-hourglass-top'></i>Pending
                                                </button>
                                            `;
                                    } else {
                                        return `
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <i class='bx bx-x'></i>Gagal
                                                </button>
                                            `;
                                    }
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    // Customize your action buttons here
                                    return `
                                    <button type="button" class="btn btn-danger btn-sm delete-data" data-id="${row.id}">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                `;
                                }
                            }
                        ]
                    });

                    function formatRupiah(nominal) {
                        return 'Rp ' + numeral(nominal).format('0,0');
                    };

                    $('#dataTable').on('click', '.update-data', function() {
                        var tr = $(this).closest('tr');

                        // Check if a valid DataTable row is available
                        if (dataTable && tr.length > 0) {
                            var row = dataTable.row(tr).data();
                            if (row) {
                                dataId = row.id; // Assign value to dataId
                                Swal.fire({
                                    title: 'Konfirmasi Hapus Data',
                                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Sukses',
                                    cancelButtonText: 'Gagal',
                                    showCloseButton: true,
                                    reverseButtons: true
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        // Send update request with 'success' status
                                        sendUpdateRequest('berhasil');
                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                        // User clicked 'Gagal'
                                        // Send update request with 'failure' status
                                        sendUpdateRequest('gagal');
                                    }
                                });
                            } else {
                                console.error('Error: Unable to retrieve DataTable row data.');
                            }
                        } else {
                            console.error('Error: Invalid DataTable or row element.');
                        }
                    });

                    function sendUpdateRequest(status) {
                        // Send update request using Axios
                        axios.put(`http://127.0.0.1:8000/api/donasi/${dataId}`, {
                                status: status
                            })
                            .then(function(response) {
                                // Handle success
                                console.log('Data berhasil diupdate:', response.data);

                                // Show success message using SweetAlert2
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: 'Data berhasil diupdate.',
                                    icon: 'success'
                                }).then(function() {
                                    // Reload the page after clicking "OK" on SweetAlert2
                                    location.reload();
                                });
                            })
                            .catch(function(error) {
                                // Handle error
                                console.error('Error updating data:', error);

                                // Show error message using SweetAlert2
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat mengupdate data.',
                                    icon: 'error'
                                });
                            });
                    }

                    function sendUpdateRequest(status) {
                        // Send update request using Axios
                        axios.put(`http://127.0.0.1:8000/api/donasi/${dataId}`, {
                                isValid: status
                            })
                            .then(function(response) {
                                // Handle success
                                console.log('Data berhasil diupdate:', response.data);

                                // Show success message using SweetAlert2
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: 'Data berhasil diupdate.',
                                    icon: 'success'
                                }).then(function() {
                                    // Reload the page after clicking "OK" on SweetAlert2
                                    location.reload();
                                });
                            })
                            .catch(function(error) {
                                // Handle error
                                console.error('Error updating data:', error);

                                // Show error message using SweetAlert2
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat mengupdate data.',
                                    icon: 'error'
                                });
                            });
                    }

                    // Handle click event on delete buttons
                    $('#dataTable').on('click', '.delete-data', function() {
                        var tr = $(this).closest('tr');

                        // Check if a valid DataTable row is available
                        if (dataTable && tr.length > 0) {
                            var row = dataTable.row(tr).data();
                            if (row) {
                                var dataId = row.id;
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
                                                `http://127.0.0.1:8000/api/donasi/${dataId}`)
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
@endsection
