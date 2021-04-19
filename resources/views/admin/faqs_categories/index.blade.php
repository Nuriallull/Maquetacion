@extends('admin.layout.table_form')

@section('table')

    @if($agent->isMobile())

        <div class="titulo-lang">
            <h1>
                @lang('admin/faqscategories.parent_section')
            </h1>
        </div>

        <div id="table-container">   
        
            @foreach($faqs_categories as $faq_category_element)
                <div class="table-row swipe-element">
                    <div class="table-field-container swipe-front">
                        <div class="table-field"> 
                            <p><span>ID:</span>  {{$faq_category_element->id}} </p>
                        </div> 
                        <div class="table-field"> 
                            <p><span>Nombre:</span> {{$faq_category_element->name}} </p>
                        </div> 
                    </div>
                    <div class="table-icons-container swipe-back">
                        <div class="table-icons edit-button right-swipe" data-url="{{route('faqs_edit', ['faq' => $faq_category_element->id])}}">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div> 
                        
                        <div class="table-icons delete-button left-swipe" data-url="{{route('faqs_destroy', ['faq' => $faq_category_element->id])}}">
                            <svg class="table-icons" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    @endif

@endsection

@if($agent->isDesktop())
<div class="titulo-lang">
    <h1>
    @lang('admin/faqscategories.parent_section')
    </h1>
</div>

<div id="table-container">   
    <table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    @foreach($faqs_categories as $faq_category_element)
    <tr class="table">
                <td> {{$faq_category_element->id}}</td> 
                <td>{{$faq_category_element->name}}</td> 
        
            <td>
                <div class="table-icons" data-url="{{route('faqs_edit', ['faq' => $faq_category_element->id])}}">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                    </svg>
                </div> 
                
                <div class="table-icons" data-url="{{route('faqs_destroy', ['faq' => $faq_category_element->id])}}">
                    <svg class="table-icons" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                    </svg>
                </div>
            </td>
            
    
     </tr>
    @endforeach

</table>
</div>
    
@endif 

@section('form')


    <div class="form-container">
        <form class="admin-form" id="faqs-form" action="{{route("faqs_categories_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($faq_category->id) ? $faq_category->id : ''}}">
            
            <div class="form-group">
                <div class="form-label">
                    <label for="name" class="label-highlight">Nombre</label>
                </div>
                <div class="form-input">
                    <input type="text" name="name" value="{{isset($faq_category->name) ? $faq_category->name : ''}}" class="input-highlight"  />
                </div>
            </div>
        </form>
    </div>
    
    <div class="form-footer">        
        <div class="form-submit">
            <button id="send-button">Enviar</button>
        </div>
    </div>

@endsection






    


