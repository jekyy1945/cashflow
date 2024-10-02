<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pemasukan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .all{
                    background-color: #3ABEF9;
                }
                .container {
                    min-height: 100vh;
                    align-items: center;
                    justify-content: center;
                    display: flex;

                }
                .pemasukan-container {
                    max-width: 400px;
                    margin: auto;
                    padding: 50px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    width: 100vh;
                    color: black;
                    background-color: #A7E6FF;
                }
            </style>
        </head>
        <body>
            <div class="all">
                <div class="container">
                       {{--  <div class="container mt-5">
                          @if ($errors->any())
                        <ul>
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $item)
                                <li>
                                    {{
                                        $item
                                    }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>  --}}
                        <div class="pemasukan-container">
                            <form method="POST" action="/dashboard">
                                @csrf
                                @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <h4>Tambahkan Data</h4>
                                <div class="form-group mb-2">
                                    <label for="nominal">Nominal</label>
                                    <input type="number" class="form-control" name="nominal" id="nominal"placeholder="Masukkan nominal">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="input" class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="nominal"placeholder="Enter nominal">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tipe">Tipe</label>
                                    <select name="tipe" id="tipe">
                                        <option value="pemasukan">Pemasukan</option>
                                        <option value="pengeluaran">Pengeluaran</option>
                                    </select>
                                </div>
                                <a href="/dashboard" class="btn btn-dark">kembali</a>
                                <button class="btn btn-primary" type="submit">kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    </html>
