<section id="contact">
    <div class="container" data-aos="fade-up">
        <x-section-header text="{{ $sectionTitle->our_contact }}" />

        <div class="row contact-info">

            {{-- get contact using ajax --}}
            <div class="col-md-4">
                <x-template1.list-group-simple icon="bi-geo-alt" id="location"
                text="{{ $ourContact->address }}" link="{{ $ourContact->link_address }}" />
            </div>

            <div class="col-md-4">
                <x-template1.list-group-simple icon="bi-phone" id="phone" text="{{ $ourContact->telephone }}"
                link="tel:{{ $ourContact->telephone }}" />
            </div>

            <div class="col-md-4">
                <x-template1.list-group-simple icon="bi-envelope" id="email" text="{{ $ourContact->email }}"
                link="mailto:{{ $ourContact->email }}" />
            </div>
            {{-- end of that --}}

        </div>
    </div>

    <div class="container mb-4 embeded-full">
        @isset($aboutUs)
        {!! $aboutUs->address_embed !!}
        @endisset
    </div>
</section>
