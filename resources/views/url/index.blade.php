@extends('layouts.app')

@section('content')
        <div class="estoqueProduto">
            @include('url._partials.showList')
        </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const URL_GET_LIST = '{{ route('getList', [ session()->get('users') ])}}';
        const URL_REGISTER = '{{ route('urlRegister', [ session()->get('users') ])}}';
        const URL_EDIT     = '{{ route('urlEdit', [ session()->get('users') ])}}';
        const URL_DELETE   = '{{ route('urlDelete', [ session()->get('users') ])}}';
    </script>

    <script src="{{ mix('js/url/index.js') }}"></script>
@endsection

@section('modals')
    @include('url.modals.newEditUrl')
    @include('url.modals.deleteUrl')
@endsection
