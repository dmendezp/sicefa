(function(){

    const sliders = [...document.querySelectorAll('.testimony_body')];
    const buttonNext =document.querySelector('#next');
    const buttonBefore =document.querySelector('#before');
    let value;
    

    buttonNext.addEventListener('click',()=>{
        changePosition(1);
    });
    
    buttonBefore.addEventListener('click',()=>{7
        changePosition(-1);
    });

    const changePosition = (add)=>{
        const currentTestimony = document.querySelector('.testimony_body--show').dataset.id;
        value = Number(currentTestimony);
        value+= add;


        sliders[Number(currentTestimony)-1].classList.remove('testimony_body--show');
        if(value === sliders.length+1 || value === 0){
            value = value === 0 ? sliders.length : 1;
        }

        sliders[value-1].classList.add('testimony_body--show');


    }

})();