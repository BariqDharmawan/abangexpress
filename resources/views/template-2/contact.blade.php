<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <x-template2.section-title heading="{{ $sectionTitle->our_contact }}" />

        <div class="row">

            <div class="col-lg-6 d-flex align-items-stretch">
                <ul class="info">
                    @foreach ($ourContactList as $contactList)
                    <li id="{{ $contactList->id }}">
                        <i class="bi {{ $contactList->icon }}"></i>
                        <h4 class="list-group-simple__text">
                            {{ $contactList->title }}
                        </h4>
                        <p class="list-group-simple__subtext">
                            <a href="" target="__blank"></a>
                        </p>
                    </li>
                    @endforeach
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
