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
            <form action="{{route('social.update')}}" method="post">
                @csrf

                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-3">
                                <div class="mb-3">
                                    <h5>EN</h5>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title </label>
                                    <input type="text" value="{{ $socials->title_en ?? '' }}" name="title_en"
                                           class="form-control"
                                           placeholder="Title EN">
                                </div>

                            </div>

                            <div class="flex-grow-1 mb-3">
                                <div class="mb-3">
                                    <h5>VI</h5>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title </label>
                                    <input type="text" value="{{ $socials->title_vi ?? '' }}" name="title_vi"
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
                            <h4>Icon</h4>
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
                    <div class="flex-grow-1 social_list">
                        @if($countClient)
                            @foreach(json_decode($socials->social_info) as $key => $social)

                                <div class="d-flex">
                                    <div class="flex-grow-1 me-3">
                                        <div class="mb-3">
                                            <input type="text"
                                                   value="{{$social->icon}}"
                                                   name="icon[]"
                                                   class="form-control">
                                        </div>

                                    </div>
                                    <div class="flex-grow-1 mb-3">
                                        <div class="mb-3">
                                            <input type="text"
                                                   value="{{$social->url}}"
                                                   name="url[]"
                                                   class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="add-social btn btn-primary">+</button>
                                            @if($key > 0)
                                                <button type="button" class="remove-social btn btn-danger">x</button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex">
                                <div class="flex-grow-1 me-3">
                                    <div class="mb-3">
                                        <input type="text"
                                               name="icon[0]"
                                               class="form-control">
                                    </div>

                                </div>
                                <div class="flex-grow-1 mb-3">
                                    <div class="mb-3">
                                        <input type="text"
                                               name="url[0]"
                                               class="form-control">
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="button" class="add-social btn btn-primary">+</button>
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

      let  key = <?php echo $countClient; ?> + 1;
        $(document).on('click', '.add-social', function () {
            let html = `<div class="d-flex">
                            <div class="flex-grow-1 me-3">
                                <div class="mb-3">
                                    <input type="text"
                                       value=""
                                       name="icon[${key}]"
                                       class="form-control">
                                </div>

                            </div>
                            <div class="flex-grow-1 mb-3">
                                <div class="mb-3">
                                    <input type="text"
                                           value=""
                                           name="url[${key}]"
                                           class="form-control">
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="button" class="add-social btn btn-primary">+</button>
                                    <button type="button" class="remove-social btn btn-danger">x</button>
                                </div>
                            </div>
                        </div>`
            $('.social_list').append(html);
            key++;
        });

        $(document).on('click', '.remove-social', function () {
            $(this).parent().parent().parent().remove()
        })


    </script>


@endsection
