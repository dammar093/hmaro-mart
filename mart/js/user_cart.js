

let icon=document.getElementById('cart-image');
icon.addEventListener('click',()=>{
 let cart=document.querySelector('.cart');
    if(cart.style.display=='none')
    {
        cart.style.display='block';
    }
    else{
        cart.style.display='none';
    }
    console.log('click');
});
