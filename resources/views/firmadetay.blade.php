<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

        <style>
            .totals {
                color: #6c757d;
                opacity: 0.9;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h1 class="text-center">Hoşgeldiniz | {{ Auth::user()->name }}</h1>
            </div>

            <div class="row mt-4">
                <div class="col-4 shadow">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <div class="icon">
                                <i class="fas fa-users" style="font-size:50px;"></i>
                            </div>

                            <div class="count">
                                <h5 class="card-title">Toplam Firma</h5>
                                <h1 class="card-text text-center">{{ $firmalar }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 shadow">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <div class="icon">
                                <i class="fas fa-paste" style="font-size:50px;"></i>
                            </div>

                            <div class="count">
                                <h5 class="card-title">Toplam Teklif</h5>
                                <h1 class="card-text text-center">{{ $teklifler}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 shadow">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <div class="icon">
                                <i class="fas fa-sign-in-alt" style="font-size:50px;"></i>
                            </div>

                            <div class="count">
                                <h5 class="card-title">Günlük Giriş</h5>
                                <h1 class="card-text text-center">741</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <a href="{{route('panel.index')}}" class="btn btn-success">Firma Ara</a>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="form-group">
                        <p>Firma Adı: {{ $firma->ad }}</p>
                        <p>Tel: {{ $firma->numara }}</p>
                        <p>Eposta: {{ $firma->email }}</p>
                        <p>Teklif Sayısı: {{ $count }}</p>
                    </div>
                </div>
            </div>

            <form action="{{route('teklifkaydet', $firma->id)}}" method="post">
                @csrf

                <div class="row teklif-satirlar">

                    <div class="row mt-3 teklif-satir">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">No</label>
                                <input placeholder="1" id="no" disabled class="form-control">
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Hizmet Ad</label>
                                <input type="text" required name="hizmetad[]" placeholder="Hizmet/Ürün adı giriniz" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Adet Miktarı</label>
                                <input type="number" required id="adet" name="adet[]" placeholder="Adet Miktarı" value="1" class="form-control" min="1">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Birim Fiyat</label>
                                <input type="number" required id="birimfiyat" name="birimfiyat[]" placeholder="Birim Fiyat" value="0" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">KDV</label>
                                <select name="kdvtip[]" class="form-select">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">İskonto (%)</label>
                                <input type="number" required name="iskonto[]" id="iskonto" placeholder="(%)" value="0" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">TOPLAM KDV</label>
                                <input placeholder="0" name="toplamkdv[]"  id="toplamkdv" value="0" readonly class="form-control totals">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">TOPLAM İskonto</label>
                                <input placeholder="0" name="toplamiskonto[]"  id="toplamiskonto" value="0" readonly class="form-control totals">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">TOPLAM Fiyat</label>
                                <input placeholder="0"  id="toplamfiyat" value="0" readonly name="toplamfiyat[]" class="form-control totals">
                            </div>
                        </div>
                    </div>


                </div>


                <div class="row mt-3">
                    <div class="col">
                        <button type="button" id="satirekle" class="btn btn-sm btn-primary">Satır Ekle</button>
                        <button type="submit" class="btn btn-sm btn-success">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('app.js')}}"></script>

    </body>
</html>
