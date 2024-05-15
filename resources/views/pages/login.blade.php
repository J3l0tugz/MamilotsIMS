<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mamilots - IMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ ('..\media\mamilots_icon.png') }}">
</head>

<body>
    <div class="container-fluid d-flex justify-content-end align-items-lg-center" style="height: 100vh;">
        <div class="row my-custom-row justify-content-end align-items-center">
            <div class="col-lg-4">
                <div class="text-nowrap justify-content-center">
                    @if ($errors->any())
                        <div class="alert alert-danger p-2 pb-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="container container-fluid col-4 col-lg-10">
                        <img class="img-fluid" src="{{ asset('media/mamilots_white.png') }}" alt="Mamilot's logo">
                    </div>

                    <p class="label text-center">
                        INVENTORY MANAGEMENT SYSTEM
                    </p>

                    <p id="text" class="px-2 text-wrap d-none d-lg-block text-start"><br>Mamilot’s Homemade Food
                        Products, a food manufacturing business specializing in producing best-quality taro chips. With
                        a commitment to quality and flavor, this food manufacturing business has carved a niche for
                        itself in the market.<br>
                        <br>The partnership between Mamilot’s and its suppliers is important to its production process.
                        Taro is the fundamental raw ingredient provided by these trustworthy suppliers. The purchase
                        method includes timely delivery of fresh taro to the manufacturing site. Mamilot's assures that
                        raw taro fulfills high quality criteria before it enters the processing process. Taro chips are
                        made by processing raw taro. Taro chips are created by cutting, frying, and seasoning raw taro.
                        Quality control procedures are implemented during production to maintain consistent quality.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 row-lg-12 offset-1">
                <div class="mb-5 mt-lg-5">
                    <div class="border bg-light display-7 p-5 rounded">
                        <div class="mt-lg-5"></div>
                        <strong id="login-text" class="display-5">
                            Login
                        </strong>

                        <form class="col g-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3 mt-2 mcol-md-12 col-lg-8 col-xl-6">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" class="form-control" name="employee_id" id="inputEmail4">
                            </div>

                            <div class="mb-4 col-md-12 col-lg-8 col-xl-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="inputPassword4">
                            </div>

                            {{-- <div class="mb-4 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div> --}}

                            <div class="mb-4 col-md-12 col-lg-8 col-xl-6">
                                <button type="submit" class="btn btn-primary w-100">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
