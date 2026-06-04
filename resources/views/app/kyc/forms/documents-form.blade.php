<!-- Documents Form -->

<h4 class="text-lg mb-8">Upload Documents</h4>

<div class="grid grid-cols-4 gap-4 mb-6">
    @foreach ($cif->kyc->kycDocuments as $document)

        <div class="text-center">
            <div class="w-full h-44 mb-3"
                style="background-image: url('{{ $document->fileUrl }}'); background-size: cover; background-position: center;">
            </div>
            <form action="{{ route('cif.kyc.documents.delete',  $document) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-danger">Delete</button>
            </form>
        </div>



    @endforeach
</div>

<div class="grid grid-cols-12 gap-6 mb-6">
    <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">



        <form action="{{ route('cif.kyc.documents.store', $cif) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="document_type" value="passport_photo_file" />
            <div class="card">
                <div class="card-body">
                    <i class="fi fi-sr-mode-portrait text-6xl text-info"></i>
                    <h5 class="card-title mb-0">Passport Picture</h5>
                    <p class="card-subtitle  mb-6">Upload passport picture.</p>
                    <div>

                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input name="passport_photo" type="file" class="block w-full text-sm text-gray-500
                                file:mx-1 file:py-2
                                file:px-10
                                file:rounded-3 file:border-0
                                file:text-sm file:font-normal
                                file:bg-primary file:text-white
                                hover:file:bg-primaryemphasis
                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                dark:file:bg-primary
                                dark:hover:file:bg-primary
                                " required>
                        </label>
                    </div>

                    <button type="submit"
                        class="btn btn-primary hover:bg-primaryemphasis text-white rounded-none w-full mt-3">
                        <i class="fi fi-rr-cloud-upload-alt me-3"></i>Upload</button>

                </div>
            </div>
        </form>
    </div>
    <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">

        <form action="{{ route('cif.kyc.documents.store', $cif) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="document_type" value="ghana_card_photo_file" />
            <div class="card">
                <div class="card-body">
                    <i class="fi fi-sr-mode-landscape text-6xl text-primary"></i>
                    <h5 class="card-title mb-0">Ghana Card</h5>
                    <p class="card-subtitle  mb-6">Upload Ghana Card.</p>
                    <div>

                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input name="ghana_card_photo" type="file" class="block w-full text-sm text-gray-500
                                    file:mx-1 file:py-2
                                    file:px-10
                                    file:rounded-3 file:border-0
                                    file:text-sm file:font-normal
                                    file:bg-primary file:text-white
                                    hover:file:bg-primaryemphasis
                                    file:disabled:opacity-50 file:disabled:pointer-events-none
                                    dark:file:bg-primary
                                    dark:hover:file:bg-primary
                                    " required>
                        </label>
                    </div>

                    <button class="btn btn-primary hover:bg-primaryemphasis text-white rounded-none w-full mt-3">
                        <i class="fi fi-rr-cloud-upload-alt me-3"></i>Upload</button>

                </div>
            </div>
        </form>
    </div>
    <!-- <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fi fi-sr-mode-portrait text-6xl"></i>
                                        <h5 class="card-title mb-0">Passport Picture</h5>
                                        <p class="card-subtitle  mb-6">Upload passport picture.</p>
                                        <form action="">

                                            <label class="block">
                                                <span class="sr-only">Choose profile photo</span>
                                                <input id="form_InputFile6" type="file" class="block w-full text-sm text-gray-500
                                                                file:me-4 file:py-2 file:px-4
                                                                file:rounded-md file:border-0
                                                                file:text-sm file:font-semibold
                                                                file:bg-primary file:text-white
                                                                hover:file:bg-primaryemphasis
                                                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                                                dark:file:bg-primary
                                                                dark:hover:file:bg-primary
                                                              ">
                                            </label>
                                        </form>

                                    </div>
                                </div>
                            </div> -->


</div>
