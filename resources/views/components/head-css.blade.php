@foreach($css() as $style)
    <link
            rel="preload"
            href="{{url(asset('build/' . $style))}}"
            as="style"
            onload="this.onload=null;this.rel='stylesheet'"
    />
    <noscript>
        <link
                href="{{url(asset('build/' . $style))}}"
                rel="stylesheet"
                type="text/css"
        />
    </noscript>
@endforeach

<style>{!! $inlineCss() !!}</style>