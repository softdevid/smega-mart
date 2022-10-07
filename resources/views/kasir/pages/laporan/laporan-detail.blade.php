<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan {{ $title }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;600;700&family=Poppins:wght@200;300;400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="container">

        <div class="my-5 grid grid-cols-2">
            <div>
                <h1>Smega Mart</h1>
            </div>
            <div class="text-right">
                Laporan: {{ date('d-m-Y', strtotime($inputan)) }} <br>
                Keuntungan: Rp. 200.000
            </div>
        </div>

        <div class="relative my-5 overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400" id="table-datatables">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Barcode
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Barang
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga Beli
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga Jual
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah Jual
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <th scope="row"
                            class="whitespace-nowrap py-4 px-6 font-medium text-gray-900 dark:text-white">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="py-4 px-6">
                            Sliver
                        </td>
                        <td class="py-4 px-6">
                            Laptop
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                    </tr>
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <th scope="row"
                            class="whitespace-nowrap py-4 px-6 font-medium text-gray-900 dark:text-white">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="py-4 px-6">
                            Sliver
                        </td>
                        <td class="py-4 px-6">
                            Laptop
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                    </tr>
                </tbody>
                <tr>
                    <title>
                        <th colspan="12">Total: 200.000</th>
                    </title>
                </tr>
            </table>
        </div>
    </div>

    {{-- export pdf dll --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    {{-- <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/jquery.dataTables.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-datatables').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf', 'print']
            });
        });
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script defer src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>

</body>

</html>
