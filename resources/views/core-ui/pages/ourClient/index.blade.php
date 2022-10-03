@extends('core-ui.layouts.default')
@section('content')
    @if (session('success'))
        @include('core-ui.components.notification',['message' => session('success'), 'status'=>'success'])
    @endif
    @if (session('error'))
        @include('core-ui.components.notification',['message' => session('error'), 'status'=>'error'])
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Cấu hình trang "Liên hệ"</h5>
        </div>
        <div class="card-body">
            <form action="{{route('ourClient.update')}}" method="post">
                @csrf

                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-3">
                                <div class="mb-3">
                                    <h5>EN</h5>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Short title</label>
                                    <input type="text" value="{{ $ourClients->short_title_en ?? '' }}"
                                           name="short_title_en"
                                           class="form-control"
                                           placeholder="Title EN">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title </label>
                                    <input type="text" value="{{ $ourClients->title_en ?? '' }}" name="title_en"
                                           class="form-control"
                                           placeholder="Title EN">
                                </div>

                            </div>

                            <div class="flex-grow-1 mb-3">
                                <div class="mb-3">
                                    <h5>VI</h5>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Short title</label>
                                    <input type="text" value="{{ $ourClients->short_title_vi ?? '' }}"
                                           name="short_title_vi"
                                           class="form-control"
                                           placeholder="Title VI">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title </label>
                                    <input type="text" value="{{ $ourClients->title_vi ?? '' }}" name="title_vi"
                                           class="form-control"
                                           placeholder="Title VI">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="flex-grow-1 me-3">
                            <h4>Logo</h4>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="flex-grow-1 me-3">
                            <h4>Url</h4>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-flex">
                    <div class="flex-grow-1 client_list">
                        @if($countClient)
                            @foreach(json_decode($ourClients->client_info) as $key => $ourClient)

                                <div class="d-flex">
                                    <div class="flex-grow-1 me-3">
                                        <div class="mb-3">
                                            <div style="width: 80px; height: 90px; cursor: pointer"
                                                 class="logo_upload border p-1">
                                                <div
                                                    class="upload_logo {{ $ourClient->logo ? 'd-none' : ''}} bg-dark w-100 h-100 d-flex justify-content-center align-items-center">
                                                </div>
                                                <img
                                                    class="preview_logo {{$ourClient->logo ? '': 'd-none'}} w-100 h-100"
                                                    src="{{ $ourClient->logo ?? '#'}}"
                                                    alt="">
                                            </div>
                                            <input type="text" value="{{$ourClient->logo}}" name="logo[]"
                                                   class="logo_value invisible">
                                        </div>

                                    </div>
                                    <div class="flex-grow-1 mb-3">
                                        <div class="mb-3">
                                            <input type="text"
                                                   value="{{$ourClient->url}}"
                                                   name="url[]"
                                                   class="form-control">
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="button" class="add-client btn btn-primary">+</button>
                                            @if($key > 0)
                                                <button type="button" class="remove-client btn btn-danger">x</button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex">
                                <div class="flex-grow-1 me-3">
                                    <div class="mb-3">
                                        <div style="width: 80px; height: 90px; cursor: pointer"
                                             class="logo_upload border p-1">
                                            <div
                                                class="upload_logo {{ old('image') ? 'd-none' : ''}} bg-dark w-100 h-100 d-flex justify-content-center align-items-center">
                                            </div>
                                            <img class="preview_logo d-none w-100 h-100" src="{{ '#'}}"
                                                 alt="">
                                        </div>
                                        <input type="text" name="logo[0]" class="logo_value invisible">
                                    </div>

                                </div>
                                <div class="flex-grow-1 mb-3">
                                    <div class="mb-3">
                                        <input type="text"
                                               name="url[0]"
                                               class="form-control">
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="button" class="add-client btn btn-primary">+</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>

    <script>


        $(document).on('click', '.logo_upload', function () {
            let tag = $(this).parent()
            console.log((tag))
            CKFinder.modal({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        var file = evt.data.files.first();
                        var url = file.getUrl();
                        console.log(url)
                        tag.find(".logo_value").val(url);
                        tag.find(".upload_logo").addClass('d-none')
                        tag.find(".preview_logo").removeClass('d-none').attr("src", url);
                    });
                }
            });
        });
      let  key = <?php echo $countClient; ?> + 1;
        $(document).on('click', '.add-client', function () {
            let html = `<div class="d-flex">
                            <div class="flex-grow-1 me-3">
                                <div class="mb-3">
                                    <div style="width: 80px; height: 90px; cursor: pointer"
                                         class="logo_upload border p-1">
                                        <div
                                            class="upload_logo bg-dark w-100 h-100 d-flex justify-content-center align-items-center">
                                        </div>
                                        <img class="preview_logo d-none w-100 h-100" src="#"
                                             alt="">
                                    </div>
                                    <input type="text" name="logo[${key}]" class="logo_value invisible">
                                </div>

                            </div>
                            <div class="flex-grow-1 mb-3">
                                <div class="mb-3">
                                    <input type="text"
                                           name="url[${key}]"
                                           class="form-control">
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="button" class="add-client btn btn-primary">+</button>
                                    <button type="button" class="remove-client btn btn-danger">x</button>
                                </div>
                            </div>
                        </div>`
            $('.client_list').append(html);
            key++;
        });

        $(document).on('click', '.remove-client', function () {
            $(this).parent().parent().parent().remove()
        })


    </script>


@endsection
