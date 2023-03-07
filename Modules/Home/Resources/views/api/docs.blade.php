@extends('home::layouts.main')

@section('content')

    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.js')}}"></script>


        <main>
            <div class="container mt-3">
                <h2>Api Documentasion</h2>
                <hr>
                <button class="btn btn-info">Create token</button>
                <div class="spinner-border mt-3 ml-5" role="status" hidden>
                    <span class="sr-only"></span>
                </div>


                <hr>
                <div class="mt-3">
                    <h2 class="token"></h2>
                </div>
            </div>
        </main>



        <script>

            $('.btn').on('click', function (){
                $.ajax({
                    method: "POST",
                    url:  "{{route('create_token')}}",
                    beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('.spinner-border').removeAttr('hidden');
                        $('.btn').attr({hidden: true});
                    },
                    complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                        $('.btn').removeAttr('hidden');
                        $('.spinner-border').attr({hidden: true});
                    },
                }).done(function (msg){

                    if(!msg.error){
                        $('.token').text(msg);
                    }
                    else{
                        alert("Error: "+ msg.error);
                    }
                })
            });


        </script>

@endsection
