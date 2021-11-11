<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <x-template2.section-title heading="{{ $sectionTitle->our_contact }}" />

        <div class="row">

            <div class="col-lg-6 d-flex align-items-stretch">
                <ul class="info">
                    @include('template-2.list-contact', [
                        'icon' => 'bi-geo-alt',
                        'title' => 'Location',
                        'link' => $ourContact->link_address,
                        'subtext' => $ourContact->address
                    ])
                    @include('template-2.list-contact', [
                        'icon' => 'bi-envelope',
                        'title' => 'Email',
                        'link' => 'mailto:' . $ourContact->email,
                        'subtext' => $ourContact->email
                    ])
                    @include('template-2.list-contact', [
                        'icon' => 'bi-phone',
                        'title' => 'Call',
                        'link' => 'tel:' . $ourContact->telephone,
                        'subtext' => $ourContact->telephone
                    ])
                </ul>
            </div>

            <div class="col-lg-6 d-flex align-items-stretch shadow embeded-full">
                @isset($aboutUs)
                {!! $aboutUs->address_embed !!}
                @endisset
            </div>
        </div>

    </div>
</section>
