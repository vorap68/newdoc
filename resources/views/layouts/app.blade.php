<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')


        <!-- Page Content -->
        <main>
            <div class="container mt-5">
                @yield('content')
            </div>
        </main>
    </div>
</body>

<script>
 $(document).ready(function(){
  
    $('#massDel').click(function(){
        const selectedIds = $('.user-del:checked').map(function(){
            return $(this).val();
        }).get();
        console.log(selectedIds);
        $.ajax({
            url: "{{route('users.mass-delete')}}",
            method:"POST",
            data: {
                    _token: "{{ csrf_token() }}",
                    users_ids: selectedIds
                },
            success:function(responce){
                console.log(responce.ids);
                $('.user-del:checked').prop('checked',false);
                setTimeout(function() {
                        location.reload(); // Перезагрузка через 1 секунду
                    }, 1000);
            }    
        })
    })

    $('#massForceDel').click(function(){
        const selectedForceIds = $('.user-forcedel:checked').map(function(){
            return $(this).val();
        }).get();
        console.log(selectedForceIds);
        $.ajax({
            url: "{{route('users.mass-forcedelete')}}",
            method:"POST",
            data: {
                    _token: "{{ csrf_token() }}",
                    users_ids: selectedForceIds
                },
            success:function(responce){
                console.log(responce.ids);
                $('.user-forcedel:checked').prop('checked',false);
                setTimeout(function() {
                        location.reload(); // Перезагрузка через 1 секунду
                    }, 1000);
            }    
        })
    })

  $('#massRestory').click(function(){
        const selectedRestoreIds = $('.user-restore:checked').map(function(){
            return $(this).val();
        }).get();
        console.log(selectedRestoreIds);
        $.ajax({
            url:"{{route('users.mass-restore')}}",
            method:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                users_ids: selectedRestoreIds
            },
           success:function(response){
            window.location.href = response.restory;
            }
            
   } );
  })
})
    
 
</script>

</html>
