const h1 = document.querySelector('.video-text')
const theChip = document.querySelector('#the-chip')
const UAV = document.querySelector('#UAV')
const img = document.querySelector('#the-chip img')

document.addEventListener('scroll', (e) =>{
    let scrolled = document.documentElement.scrollTop /
    (document.documentElement.scrollHeight - document.documentElement.clientHeight)

    theChip.style.width = theChip.style.height = document.documentElement.clientWidth * 20 * (scrolled * scrolled *scrolled) +'px'
    //the h1 move to the top
    if(scrolled <= 0.1){
        h1.style.opacity = (0.1 - scrolled) / 0.1
        h1.style.marginTop = scrolled * 1000 * -1 + 'px'
    }else{
        h1.style.opacity = 0
    }
    // The SVG appear
    if(scrolled <= 0.2){
        UAV.style.opacity = (scrolled - 0.1) / 0.1
    }else{
        UAV.style.opacity = 1
    }
    // The SVG Zoom in 
    if(scrolled >= 0.75){
        img.style.opacity = (1-scrolled) / 0.1
        theChip.classList.add('transparent')
    }else{
        theChip.classList.remove('transparent')
    }

    if(scrolled >=0.95){
        theChip.style.opacity = (1 - scrolled) / 0.05
    }else{
        theChip.style.opacity = 1
    }
})