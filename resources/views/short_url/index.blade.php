@extends('website.layouts.redesign.dashboard')

@section('page-title')
    Short URL Service
@endsection

@section('container')

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card mb-3">

                <div class="card-header bg-dark text-white mb-1">
                    @yield('page-title')
                    <a class="badge bg-info float-end" href="{{ route('short_url::edit', ['id' => 'new']) }}">
                        Create Short URL</a>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover table-sm align-middle">

                        <thead>

                        <tr class="bg-dark text-white">
                            <td></td>
                            <td>Description</td>
                            <td>Url</td>
                            <td class="text-center">Clicks</td>
                            <td class="text-center">Target</td>
                            <td class="text-center">QR code</td>
                        </tr>

                        </thead>

                        @foreach($urls as $url)

                            <tr>

                                <td class="ps-2">
                                    <a href="{{ route('short_url::delete', ['id' => $url->id]) }}"
                                       class="fa fa-trash-alt text-danger me-2"></a>
                                    <a href="{{ route('short_url::edit', ['id' => $url->id]) }}"
                                       class="fa fa-pencil-alt text-success"></a>
                                </td>
                                <td style="overflow-wrap: break-word; max-width: 200px">
                                    {{ $url->description }}
                                </td>
                                <td>
                                    <span class="text-muted">saproto.nl/go</span><strong>/{{ $url->url }}</strong>
                                </td>
                                <td class="text-center">
                                    {{ $url->clicks }}
                                </td>
                                <td class="text-center">
                                    <button
                                       data-bs-toggle="popover"
                                       data-bs-placement="right"
                                       data-bs-trigger="focus"
                                       data-bs-content="{{ $url->target }}"
                                       class="btn badge bg-info">
                                        <i class="fas fa-link text-white"></i>
                                    </button>
                                </td>

                                <td class="text-center qr-code-container">
                                    <button class="btn badge bg-info"><i class="fas fa-eye text-white"></i></button>
                                    <div class="qr-code mx-auto my-2 d-none cursor-pointer" data-size="48" data-content="saproto.nl/go/{{ $url->url }}"></div>
                                </td>

                            </tr>

                        @endforeach

                    </table>

                </div>

                <div class="card-footer pb-0">
                    {{ $urls->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection

@push('javascript')
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        const QrCodeContainers = Array.from(document.querySelectorAll('.qr-code-container'))
        QrCodeContainers.forEach((el) => {
            let button = el.getElementsByTagName("button")[0]
            let qrCode = el.getElementsByTagName("div")[0]
            button.onclick = (_) => {
                button.classList.add('d-none')
                qrCode.classList.remove('d-none')
            }
            qrCode.onclick = (_) => {
                button.classList.remove('d-none')
                qrCode.classList.add('d-none')
            }
        })
    </script>
@endpush