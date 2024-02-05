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
                                <h1 class="card-text text-center">{{$firmalar}}</h1>
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
                                <h1 class="card-text text-center">{{$teklifler}}</h1>
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
            </div>
            <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#firmaekle">
                <i class="fas fa-plus"></i> Firma Ekle
            </button>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Firma Ara</label>
                        <input type="text" id="firmaara" name="firmaara" class="form-control">
                        <ul id="firmaResults" class="list-group"></ul>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade" id="firmaekle" tabindex="-1" aria-labelledby="firmaekleLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="firmaekleLabel">Yeni Firma OLUŞTUR</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('firmakaydet')}}">
                    @csrf
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Firma Adı:</label>
                      <input type="text" required name="ad" placeholder="Firma adı girin" class="form-control" id="recipient-name">
                    </div>

                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Telefon:</label>
                      <input type="text" class="form-control" name="numara" placeholder="Firma telefon numarası">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="recipient-name" placeholder="Firma e posta girin">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-success">Oluştur <i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#firmaara').on('input', function () {
                    var searchItem = $(this).val();

                    // eğer arama boşsa input verileri temizler
                    if (searchItem === '') {
                        $('#firmaResults').empty();
                        return;
                    }

                    $.ajax({
                        url: '/firmaara',
                        type: 'GET',
                        data: {
                            'searchItem': searchItem
                        },
                        success: function (data) {
                            // veri ekler
                            $('#firmaResults').empty(); // Önceki içeriği temizle

                            // sadece 5 tane veriyi bize göstermeye yarar
                            $.each(data.slice(0, 5), function (index, value) {
                                // firma için li ve a elemenet ekler
                                var listItem = '<li class="list-group-item"><a href="/firma-detay/' + value.id + '">' + value.ad + '</a></li>';
                                $('#firmaResults').append(listItem);
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>


    </body>
</html>
