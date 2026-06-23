<div class="card card-body py-3">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
                <h4 class="mb-4 mb-sm-0 cal-sans fw-500">{{ $pageTitle }}</h4>
                <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item d-flex align-items-center">
                            <a class="text-primary text-decoration-none d-flex" href="../main/index.html">
                                <i class="fi fi-rr-house-chimney fs-18px"></i>
                            </a>
                        </li>

                       {{ $slot }}
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
