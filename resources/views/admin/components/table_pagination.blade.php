<div class="table-pagination">
    <div class="table-pagination-buttons">
        <div class="pagination-button" data-page="{{$items->url(1)}}"> 
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M18.41,16.59L13.82,12L18.41,7.41L17,6L11,12L17,18L18.41,16.59M6,6H8V18H6V6Z" />
            </svg>
        </div>

        <span class="pagination-button" data-page="{{$items->previousPageUrl()}}"> Anterior</span>
        <span class="pagination-button" data-page="{{$items->nextPageUrl()}}"> Siguiente </span>   
        
        <div class="pagination-button" data-page="{{$items->url($items->lastPage())}}">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M5.59,7.41L10.18,12L5.59,16.59L7,18L13,12L7,6L5.59,7.41M16,6H18V18H16V6Z" />
            </svg>
        </div>
    </div>

    <div class="pagination-pages"> 
        <p> Mostrando {{$items->currentPage()}} de {{$items->lastPage()}} páginas </p>
    </div>
</div>