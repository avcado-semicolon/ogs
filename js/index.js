// let listElements = document.querySelectorAll('.link');

// listElements.forEach(listElement => {
//     listElement.addEventListener('click', ()=>{
//         if (listElement.classList.contains('active')){
//             listElement.classList.remove('active');
//         }else{
//             listElements.forEach (listE => {
//                 listE.classList.remove('active');
//             })
//             listElement.classList.toggle('active');
//         }
//     })
// });

let btnprint = document.getElementById("pdf");
btnprint.addEventListener('click', function() {
  window.print()
})

