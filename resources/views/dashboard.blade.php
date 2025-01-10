<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="dashboard-content">
        

        <h1 class="fw-semibold text-capitalize">Welcome, {{ Auth::user()->name }}!</h1>
        <p>Here is an overview of your organization:</p>
        <div class="row">
            @foreach ($cards as $card)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card p-3 border border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas {{ $card['icon'] }} {{ $card['custom_class'] }} me-2" style="font-size: 2rem;"></i>
                        <div class="title mt-2">
                            <h5 class="fw-bold {{ $card['custom_class'] }}">{{ $card['title'] }}</h5>
                        </div>
                        
                    </div>
                    <p>{{ $card['description'] }}</p>
                    <h2>{{ $card['total'] }}</h2>
                    <a style="width: 70px" href="{{ route($card['route']) }}">Details &gt;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
