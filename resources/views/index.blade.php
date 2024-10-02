<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Family CashFlow</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="starter-page-page">
    <header id="header" class="header sticky-top">
        <div class="branding d-flex align-items-center bg bg-primary">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="/dashboard" class="logo d-flex align-items-center">
                    <h1 class="sitename text-white">Family Cash Flow</h1>
                </a>
                <a href="/logout" class="btn btn-danger btn-md">logout</a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </header>

    <main class="main">

        <!-- Stats Section -->
        <section id="stats" class="stats section">
            <div class="button">

            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4 d-flex justify-content-center">
                    <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-card-heading"></i>
                        <div class="stats-item">
                            <span>
                                Rp.{{number_format($saldo,0,',','.') }}
                            </span>
                            <p>Saldo</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-arrow-90deg-left"></i>
                        <div class="stats-item">
                            <span>
                                Rp.{{ number_format($pemasukan,0,',','.') }}
                            </span>
                            <p>History Pemasukan</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-arrow-90deg-right"></i>
                        <div class="stats-item">
                            <span>
                                Rp.{{ number_format($pengeluaran,0,',','.') }}
                            </span>
                            <p>History Pengeluaran</p>
                        </div>
                    </div><!-- End Stats Item -->
                </div>
            </div>
        </section>

        <!-- Clients Section -->
        <section id="clients" class="clients section light-background mt-5">

            <div class="container">
                <div class="search-add d-flex justify-content-between">
                    <form class="d-flex" role="search" method="get" action="">
                        <input class="form-control me-2" type="search" placeholder="Masukkan Keterangan"
                            aria-label="Search" name="cari" style="width:350px" autocomplete="off">
                        <button class="btn btn-outline-success" type="submit">Cari</button>
                    </form>
                    <div class="tambahan">
                        <a href="/dashboard/create" class="btn btn-primary">+ tambah</a>
                        <a href="/export-users" class="btn btn-success">Export</a>
                        <a href="dashboard" class="btn btn-success">refresh</a>
                    </div>
                </div>
                <div class="swiper init-swiper">
                    <table class="table table-striped">
                        <div class="type-filter">
                            <form action="" method="GET" class="row" id="form-type">
                                <select class="form-contro col" aria-label="Default select example" name="filter">
                                    <option selected>Tipe</option>
                                    <option value="pemasukan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm col">filter</button>
                            </form>

                        </div>

                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal </th>
                                <th scope="col">Tipe</th>
                                @if (Auth::user()->role == 'admin')
                                <th scope="col">aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <th>{{ $loop->iteration + $data->firstItem() - 1 }}</th>
                                <td>{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->tipe }}</td>
                                @if (Auth::user()->role == 'admin')
                                <td class="d-flex gap-2">
                                    <a href="{{ url('/dashboard/'.$item->id.'/edit') }}"
                                        class="btn btn-warning btn-sm">edit</a>
                                    <form action="{{ url('/dashboard/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>

        </section><!-- /Clients Section -->

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
