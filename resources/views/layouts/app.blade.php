<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-3" id="successMessage">
                {{ session('success') }}
            </div>
        @endif

    </div>
</nav>

<body>
    <main>
        @yield('content')
    </main>
</body>

<footer>

</footer>

</html>
<script>
    // Automatically hide the success message after 3 seconds
    setTimeout(function() {

        document.getElementById("successMessage").style.display = 'none';
    }, 3000);
</script>
