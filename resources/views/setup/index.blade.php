@extends('portal.ninja2020.layout.clean')
@section('meta_title', ctrans('texts.setup'))

@section('body')
<div class="container mx-auto mb-10 mt-4">
    <form action="{{ url('/setup') }}" method="post">
        @csrf

        <div class="grid grid-cols-12 px-6">
            <div class="col-span-12 md:col-start-4 md:col-span-6 mt-4 md:mt-10">
                <h1 class="text-center text-2xl font-semibold">Invoice Ninja Setup</h1>
                <p class="text-sm text-center">{{ ctrans('texts.if_you_need_help') }}
                    <a href="https://www.invoiceninja.com/forums/forum/support/" class="button-link">{{ ctrans('texts.support_forum') }}</a>
                </p>

                @if($errors->any())
                    <div class="alert alert-failure">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('setup_error'))
                    <div class="alert alert-failure mt-4">
                        <span class="font-bold">{{ ctrans('texts.error_title') }}:</span>
                        <pre class="bg-white p-3 mt-2 rounded overflow-y-scroll">{{ session('setup_error') }}</pre>
                    </div>
                @endif

                @if($check['system_health'] === false)
                    @include('setup._issues')
                @else

                    @include('setup._application')
                    @include('setup._database')
                    @include('setup._mail')
                    @include('setup._account')

                    <div class="flex justify-center mt-4">
                        <div class="flex flex-col">
                            <div class="mt-4 text-sm">
                                <input type="checkbox" class="form-checkbox mr-2" name="terms_of_service" required>
                                <span>{{ ctrans('texts.i_agree') }}
                                    <a class="button-link" href="https://www.invoiceninja.com/self-hosting-terms-service/">{{ ctrans('texts.terms_of_service') }}</a>
                                </span>
                            </div>
                            <div class="mt-2 text-sm">
                                <input type="checkbox" class="form-checkbox mr-2" name="privacy_policy" required>
                                <span>{{ ctrans('texts.i_agree') }}
                                    <a class="button-link" href="https://www.invoiceninja.com/self-hosting-privacy-data-control/">{{ ctrans('texts.privacy_policy') }}</a>
                                </span>
                            </div>

                            <button type="submit" class="button button-primary w-1/2 my-4">{{ ctrans('texts.submit') }}</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection

@push('footer')
    <script src="{{ asset('js/setup/setup.js') }}"></script>
@endpush