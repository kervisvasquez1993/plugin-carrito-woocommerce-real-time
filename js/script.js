var swiper = new Swiper('.swiper-container', {
    slidesPerView: 2,
    spaceBetween: 10,
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 50,
      },
    }
  });
var stickymenu = document.querySelector(".category_slider_eliza")

if(stickymenu){
var stickymenuoffset = stickymenu.offsetTop
window.addEventListener("scroll", function(e){
    requestAnimationFrame(function(){
        if (window.pageYOffset > stickymenuoffset){
            stickymenu.classList.add('p')
        }
        else{
            stickymenu.classList.remove('p')
        }
    })
})}

let swiper_wrapper = document.querySelector('.swiper-wrapper')

if(swiper_wrapper)
{
      
      let sumador = document.querySelectorAll('.qib-container')
      let sumadorArr = Array.from(sumador)
      sumadorArr.forEach(elem =>{
        elem.classList.add('no_mostrar')
      })



      // evento del input 
        let enviar = document.querySelectorAll('a.button.product_type_simple')
       // console.log(enviar)




      // carrito de compra 
      let $items = document.querySelector('#items');
      let carrito = [];
      let total = 0;
      let $carrito = document.querySelector('#carrito');
      let $total = document.querySelector('#total');
      let $botonVaciar = document.querySelector('#boton-vaciar');
      let cartProductos = document.querySelector('.products.columns-5')


      document.addEventListener('click', (e)=>
      {
        let valor =  e.target.classList
        let input
         if(valor.contains('add_to_cart_button')  || valor.contains('plus') || valor.contains('minus'))
          {
            e.preventDefault()
            if(valor.contains('add_to_cart_button'))
            {
              e.target.classList.add('no_mostrar')
              let elemetoHermano = e.target.previousElementSibling
              elemetoHermano.classList.remove('no_mostrar')
             
            }
            else if(valor.contains('plus'))
            {
              let elemento = e.target
              let elem1 = elemento.parentElement
              let inputSuma = elem1.querySelector('input').value
              input = Number(inputSuma) + 1
            }

            else if(valor.contains('minus'))
            {
              let elemento = e.target
              let elem1 = elemento.parentElement
              let inputResta = elem1.querySelector('input').value
              input = Number(inputResta) -1
              if(input <= 1 ){
                input = 1
              }
            }
            let padreCart = e.target.parentElement.parentElement
            leerDatos(padreCart, input)
           }
      })






    function leerDatos(producto, input = 1 )
    {
      let padreProducto 
      let productArr =Array.from(producto.classList)
      productArr.forEach( elem => {
        if(elem === "product-type-simple")
        {
          padreProducto = producto
        }
        else{
          padreProducto = producto.parentElement
        }
      })
      
      const infoProducto = {
        imagen    : padreProducto.querySelector('img').src,
        titulo    : padreProducto.querySelector('.woocommerce-loop-product__title').textContent,
        precio    : padreProducto.querySelector('.woocommerce-Price-amount.amount bdi').textContent,
        id        : padreProducto.querySelector('a.add_to_cart_button').getAttribute('data-product_id'),
        sku       : padreProducto.querySelector('a.add_to_cart_button').getAttribute('data-product_sku'),
        cantidad  : input
        
      }
      
      
      let resultado
    
      const exist = carrito.some(curso => curso.id === infoProducto.id ) 
      if(exist)
      {
        // actualizamos la cantidad
        const productos = carrito.map( producto =>
        {
          if(producto.id === infoProducto.id)
          {
              
              producto.cantidad = infoProducto.cantidad
              return producto
          }
          else
           {
             return producto
           }
        })
        console.log()
        carrito = [...productos]
        
      }
      else
      {
          carrito = [...carrito, infoProducto]
      }
  
      console.log(carrito)
  }

}