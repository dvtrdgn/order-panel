<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                {{ $slot }}
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">{{ $title }}</h4>
    </div>
    <div class="d-none d-md-block">
        {{ $link }}
    </div>
</div>
