<section id="contact">
    <div class="container" data-aos="fade-up">
        <x-section-header text="{{ $sectionTitle->our_contact }}" />

        <div class="row contact-info">

            {{-- get contact using ajax --}}
            <div class="col-md-4">
                <x-template1.list-group-simple icon="bi-geo-alt" id="location" text="" subtext="" link=""
                    class="contact-address" subtext-class="contact-value" />
            </div>

            <div class="col-md-4">
                <x-template1.list-group-simple icon="bi-phone" id="phone" text="" subtext="" link=""
                    class="contact-phone" subtext-class="contact-value" />
            </div>

            <div class="col-md-4">
                <x-template1.list-group-simple icon="bi-envelope" id="email" text="" subtext="" link=""
                    class="contact-email" subtext-class="contact-value" />
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
