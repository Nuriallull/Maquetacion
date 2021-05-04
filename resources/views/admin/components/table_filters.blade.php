<div class="table-filter" id="table-filter">
    <div class="table-filter-container">
        <form class="filter-form" id="filter-form" action="{{route($route.'_filter')}}" autocomplete="off">             

            {{ csrf_field() }}


            @foreach ($filters as $key => $items)
            
                @if($key == 'parent')
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="category_id" class="label-highlight">Filtrar por</label>
                            </div>
                            <div class="form-input">
                                <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                    <option value="all"}}>Todas</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}"}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>    
                            </div>
                        </div>
                    </div>    
                @endif

                @if($key == 'category')
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="category_id" class="label-highlight">Filtrar por categoría</label>
                            </div>
                            <div class="form-input">
                                <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                    <option value="all"}}>Todas</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}"}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>    
                            </div>
                        </div>
                    </div>    
                @endif

                @if($key == 'search')
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="search" class="label-highlight">Buscar palabra</label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="search" class="input-highlight" value="">
                            </div>
                        </div>
                    </div>    
                @endif

                @if($key == 'created_at')
                    <div class="two-columns">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="date" class="label-highlight"> Fecha de creación desde</label>
                            </div>
                            <div class="form-input">
                                <input type="date" name="created_at_from" class="input-highlight" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label for="date" class="label-highlight"> Fecha de creación hasta</label>
                            </div>
                            <div class="form-input">
                                <input type="date" name="created_at_since" class="input-highlight" value="">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="two-columns">
                <div class="form-group">
                    <div class="form-label">
                        <label> Ordenar por
                    </div>
                    <select name="direction"> 
                        <option value="desc"> Orden descendente</option>
                        <option value="asc" selected> Orden ascendente</option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        <label> Ordenar por
                    </div>
                    <select name="order"> 
                        @foreach($order as $key => $item)
                            <option value="{{$item}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
            </div>                 
        </form>
    </div>
    <div class="table-filter-buttons">
        <div class="table-filter-button apply-filter" id="apply-filter">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M12 20C7.59 20 4 16.41 4 12S7.59 4 12 4 20 7.59 20 12 16.41 20 12 20M16.59 7.58L10 14.17L7.41 11.59L6 13L10 17L18 9L16.59 7.58Z" />
            </svg>
        </div>
        <div class="table-filter-button open-filter" id="open-filter">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M11 11L16.76 3.62A1 1 0 0 0 16.59 2.22A1 1 0 0 0 16 2H2A1 1 0 0 0 1.38 2.22A1 1 0 0 0 1.21 3.62L7 11V16.87A1 1 0 0 0 7.29 17.7L9.29 19.7A1 1 0 0 0 10.7 19.7A1 1 0 0 0 11 18.87V11M13 16L18 21L23 16Z" />
            </svg>
        </div>
    </div>
</div>