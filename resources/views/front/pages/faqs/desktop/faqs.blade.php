<div class="faqs">

    <div class="faqs-title">
        <h3>@lang('front/faqs.title')</h3>
    </div>

    @foreach ($faqs as $faq)
        <div class="faq" data-content="{{$loop->iteration}}">
            <div class="faq-title-container">

                <div class="faq-title">
                    <h3>{{isset($faq->locale['title']) ? $faq->locale['title'] : ""}}</h3>
                </div>

                <div class="faq-plus-button" data-button="{{$loop->iteration}}"></div>
            </div>
            <div class="faq-description">
                <div class="faq-description-text">
                <p>  {!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!} </p>
                </div>
            </div>   
        </div>
    @endforeach

</div>
