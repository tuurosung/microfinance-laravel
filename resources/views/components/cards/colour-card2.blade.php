<div class="card {{ $colour }}-light">
    <div class="card-body text-center px-9 py-9">
        <div
            class="flex items-center justify-center  rounded bg-{{ $colour }} shrink-0 mb-6 mx-auto w-13 h-13 p-4">
            <i class="fi fi-sr-{{ $icon }} text-2xl text-white m-0 "></i>
        </div>

        <h4 class="flex items-center justify-center justify-content-center gap-1 font-normal text-2xl mb-0">
            {{ $value }}</h4>
        <!-- <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
            Details</a> -->
            <h6 class="font-bold fs-3 my-3">{{ $title }}</h6>
    </div>
</div>
