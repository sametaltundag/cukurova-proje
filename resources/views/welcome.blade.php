<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <form action="{{route('giris')}}" method="post">
                        @csrf

                        <div class="col-12 d-flex justify-content-center align-items-center flex-column gap-3">
                            <h1>Admin Giriş</h1>

                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="name">E-Mail</label>
                                <input type="text" name="email" placeholder="Kullanıcı eposta girin" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Şifre</label>
                                <input type="password" name="password" placeholder="Şifre" class="form-control">
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-outline-primary" type="submit">Giriş Yap</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
