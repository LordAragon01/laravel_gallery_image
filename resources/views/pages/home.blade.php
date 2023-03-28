@extends('layout.index')

@section('content')

    <div class="row">

        <div class="w-100 d-flex flex-row justify-content-center align-items-center">

            @if($check_apiurl)

                <div class="d-flex flex-column my-3 w-100">

                    <h1 class="my-3 order-1 col-12">Galeria de Imagens</h1>

                    <div class="order-2 d-flex flex-lg-row flex-column gallery_base col-12" role="list" aria-describedby="Gallery List of Images">

                        <div class="card col-12 col-lg-3 col-md-6 mx-2 my-2" aria-labelledby="Card Image">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
        
                        <div class="card col-12 col-lg-3 col-md-6 mx-2 my-2">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
        
                        <div class="card col-12 col-lg-3 col-md-6 mx-2 my-2">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
        
                        <div class="card col-12 col-lg-3 col-md-6 mx-2 my-2">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
        
                        <div class="card col-12 col-lg-3 col-md-6 mx-2 my-2">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            </div>
                        </div>

                    </div>

                </div>

            @else

                <h1 class="my-3 order-1 col-12">Nenhuma Imagem para apresentar</h1>

            @endif

        </div>
        
    </div>

@endsection