export function scrollWindowElement (element){

    'use strict';

    let scrollWindowElement = element;
//* declaramos el elemento que es la tabla, que se moverá al hacer el evento touch. Global state variables
    let STATE_DEFAULT = 1;
    let STATE_TOP_SIDE = 2;
    let STATE_BOTTOM_SIDE = 3;
//* aqui estamos dandole valores numericos a los lados de la tabla para saber por donde identficarlos.
    let rafPending = false;
    let initialTouchPos = null;
    let lastTouchPos = null;
    let currentYPosition = 0;
    let currentState = STATE_DEFAULT;
    let handleSize = 10;

    // Handle the start of gestures
    this.handleGestureStart = function(evt) {
        if(evt.touches && evt.touches.length > 1) {
            return;
        }
// Add the move and end listeners
        if (scrollWindowElement.PointerEvent) {
            evt.target.setPointerCapture(evt.pointerId);
        } else {
            document.addEventListener('mousemove', this.handleGestureMove, true);
            document.addEventListener('mouseup', this.handleGestureEnd, true);
        }

        initialTouchPos = getGesturePointFromEvent(evt);

    }.bind(this);

    // END handle-start-gesture

    this.handleGestureMove = function (evt) {

        if(!initialTouchPos) {
            return;
        }

        lastTouchPos = getGesturePointFromEvent(evt);

        if(rafPending) {
            return;
        }

        rafPending = true;
    //code for initiating animation the elements:
        window.requestAnimFrame(onAnimFrame);

    }.bind(this);

    this.handleGestureEnd = function(evt) {

        evt.preventDefault();

        if(evt.touches && evt.touches.length > 0) {
            return;
        }

        rafPending = false;

        if (scrollWindowElement.PointerEvent) {
            evt.target.releasePointerCapture(evt.pointerId);
        } else {
            document.removeEventListener('mousemove', this.handleGestureMove, true);
            document.removeEventListener('mouseup', this.handleGestureEnd, true);
        }

        updateScrollRestPosition();

        initialTouchPos = null;

    }.bind(this);

//* funcion para calcular la posicion del raton
    function updateScrollRestPosition() {

        let transformStyle;
        let differenceInY = initialTouchPos.y - lastTouchPos.y;
    //* declaramos la funcion que captura cuánto ha movido el dedo en el eje y (verticalmente)
        currentYPosition = currentYPosition - differenceInY;
// Go to the default state and change
    //* declaramos la funcion en la que se calcula la diferencia entre el scroll de una caja y el de la otra.
        if(Math.sign(differenceInY) == 1) {
            currentYPosition = currentYPosition + 200;
            console.log(currentYPosition);
        }
        
        if(Math.sign(differenceInY) == -1) {
            currentYPosition = currentYPosition - 200;
            console.log(currentYPosition);
        }

        if(scrollWindowElement.offsetTop < 0){

            transformStyle = 'translateY('+currentYPosition+'px)';

            scrollWindowElement.style.msTransform = transformStyle;
            scrollWindowElement.style.MozTransform = transformStyle;
            scrollWindowElement.style.webkitTransform = transformStyle;
            scrollWindowElement.style.transform = transformStyle;

            scrollWindowElement.style.transition = 'all 300ms ease-out';
        };
    }

    function getGesturePointFromEvent(evt) {

        let point = {};

        if(evt.targetTouches) {
            point.y = evt.targetTouches[0].clientY;
        } else {
            point.y = evt.clientY;
        }

        return point; 

    }

    function onAnimFrame() {

        if(!rafPending) {
            return;
        }
        // Which way it goes left to right
        let differenceInY = initialTouchPos.y - lastTouchPos.y;
        let newYTransform  = (currentYPosition - differenceInY)+'px';
        let transformStyle = 'translateY('+newYTransform+')';

        scrollWindowElement.style.webkitTransform = transformStyle;
        scrollWindowElement.style.MozTransform = transformStyle;
        scrollWindowElement.style.msTransform = transformStyle;
        scrollWindowElement.style.transform = transformStyle;

        rafPending = false;
    }

    //* Check if pointer events are supported:
    scrollWindowElement.addEventListener('touchstart', this.handleGestureStart, {passive: true} );
    scrollWindowElement.addEventListener('touchmove', this.handleGestureMove, {passive: true} );
    scrollWindowElement.addEventListener('touchend', this.handleGestureEnd, true);
    scrollWindowElement.addEventListener('touchcancel', this.handleGestureEnd, true);
};   