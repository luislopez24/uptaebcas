
<style type="text/css">

  /* BOTON PARA AYUDA */

  :root{
    --car_img: url('vista/config/img/contactoayuda.png');

  }


  .car{
    width: 3em;
    height: 5em;
    position: absolute;
    background-size: calc(100% - .5em) auto;
    background-image: var(--car_img);
    background-repeat: no-repeat;
  }

  .car::before{
    opacity: 0;
    text-align: center;
    min-width: 200%;
    content: 'Contactar soporte';
    position: absolute;
    background: #111;
    color: #eee;
    font-size: 0.5em;
    font-family: arial;
    bottom: calc(100% + 0.5em); 
    display: inline-block;
    padding: 0.3em .5em;
    border-radius: 1em;
    left: 50%;
    transition: all ease .3s;
    transform: translateX(-50%) translateY(100%);

  }

  .car:focus{
    outline: none;
    box-shadow: inset 0 0 0 2px lime;

  }

  .car:hover::before{
    opacity: 1;
    transform: translateX(-50%) translateY(0%);  

  }

  .xy1{

    left: 65%;
    top: 10%;
    outline: none!important;
    outline: none !important;
    border: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;

  }

</style>