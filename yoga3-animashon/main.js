// setTimeout ( rellax , 10000);
// анимации появления обьектов
    AOS.init({
        duration: 1000,
      })

      // слайдер
  document.querySelectorAll('slider').forEach(slider => {
  
    let imgs = [...slider.querySelectorAll('img')];
    
    let update = n => slider.style.backgroundPosition = 
        imgs.map((_,i) => `${1300*(i-n)}px 0px`).join(',');
        
    slider.style.backgroundImage = 
        imgs.map(img => `url(${img.getAttribute('src')})`).join(',');
    
    imgs.forEach((img, n) => img.onclick = () => update(n));
    
    update(0);
  });


  // вращение логотипа
  let block = anime({  
    targets: '#transforms .block',
    rotateY: '360',
    easing: 'linear',
    loop: true,
    duration: 7000,
 });

 // паралакс
 var rellax = new Rellax('.rellax', {
  speed: 1.3,
  center: true,
  round: false,
  vertical: true,
  horizontal: false
});
  /* let block1 = anime({
    targets: '#transforms1 .block1',
    rotateY: '20',
    easing: 'linear',
    loop: false,
    duration: 1500,
 }); */

  