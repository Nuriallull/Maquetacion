@extends ('admin.layout.master')

@section('content')
   
    <div class="table">

        <div class= "table-title"> 
            <h2> Título de la tabla </h2>
        </div>

        <div class="table-content"> 
            <table>
                <tr>
                    <th> ID </th>
                    <th> Pregunta </th>
                    <th> Respuesta </th>
                    <th> Acción </th>
                </tr>

                <tr>
                    <td> 1 </td>
                    <td> ¿Cuánto tarda el envío? </td>
                    <td> Entre 24-48 horas </td>
                    <td> 
                        <button class="boton-editar"> 
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="#F1C40F" d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                            </svg>
                        </button>
                        <button class="boton-eliminar">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="#CB4335" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </button> 
                    </td>
                </tr>

                <tr>
                    <td> 2 </td>
                    <td> ¿Cuánto cuesta la devolución? </td>
                    <td> Es totalmente gratuita </td>
                    <td> 
                        <button class="boton-editar"> 
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="#F1C40F" d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                            </svg>
                        </button>
                        <button class="boton-eliminar">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="#CB4335" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </button> 
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="form">

        <div class= "form-title"> 
            <h2> Título del formulario</h2>
        </div>

        <div class="form-content">

            <form> 
                <div class= "form-group"> 
                    <div class= "form-label">
                        <label for="name"> Pregunta </label>
                    </div>
                    
                    <div class= "form-input">
                        <input class="text" id="fname" name="fname">
                    </div>
                </div>

                <div class= "form-group">
                    <div class= "form-label">
                        <label for="lname"> Respuesta</label>
                    </div>
                    
                    <div class= "form-input">
                        <input class="text" id="lname" name="lname">
                    </div>
                </div>

                <div class= "form-group">
                    <div class="form-input">
                        <button class="submit">Enviar</button>                           
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 