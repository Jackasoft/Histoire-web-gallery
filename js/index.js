
const barList = document.querySelector(".barlist");
const bars = document.querySelector(".bars");
const navlinks = document.querySelectorAll(".barlist li");
const img = document.querySelectorAll(".allImg");


let windowWidth = window.innerWidth;
let getLatestOpenedImg;

if(img){
  img.forEach((image,index)=>{
     image.onclick = function(){
       let getElementCss = window.getComputedStyle(image);
       let getImageFullUrl = getElementCss.getPropertyValue("background-image");
       let getImagePos = getImageFullUrl.split("/uploads/");
       let setNewImageUrl = getImagePos[1].replace('")','');

      // alert(index)
       getLatestOpenedImg = index + 1;
       let container = document.body;
       let newImgWindow = document.createElement("div");
       container.appendChild(newImgWindow);
       newImgWindow.setAttribute("class","img-window");
       newImgWindow.setAttribute("onclick","closeImg()");

       let newImage =  document.createElement("img");
       newImgWindow.appendChild(newImage);
       newImage.setAttribute("src","uploads/" + setNewImageUrl);
       newImage.setAttribute("id","current-image");

       newImage.onload = function(){
         let imgWidth = this.width;
         let calcImgToEdge =(( windowWidth - imgWidth) / 2) - 80;

          let nextBtn = document.createElement("a");
          let nextBtnText = document.createTextNode("next");
          nextBtn.appendChild(nextBtnText);
          container.appendChild(nextBtn);
          nextBtn.setAttribute("class","img-nextBtn");
          nextBtn.setAttribute("onclick","changeImg(1)");
          nextBtn.style.cssText = "right:"+ calcImgToEdge +"px;";
          
          let prevBtn = document.createElement("a");
          let prevBtnText = document.createTextNode("Prev");
          prevBtn.appendChild(prevBtnText);
          container.appendChild(prevBtn);
          prevBtn.setAttribute("class","img-prevBtn");
          prevBtn.setAttribute("onclick","changeImg(0)");
          prevBtn.style.cssText = "left:"+ calcImgToEdge +"px;";

       }

     }
  });
}

function closeImg(){
  document.querySelector(".img-window").remove();
  document.querySelector(".img-nextBtn").remove();
  document.querySelector(".img-prevBtn").remove();
}

function changeImg(changeDir){
  document.querySelector("#current-image").remove();
  let getImgWindow  = document.querySelector(".img-window");
  let newImg =  document.createElement("img");
  getImgWindow.appendChild(newImg);

  let calcNewImg;
  if(changeDir === 1){
    calcNewImg = getLatestOpenedImg + 1;
    if(calcNewImg > img.length){
      calcNewImg = 1;
    }
  }else if(changeDir === 0){
    calcNewImg = getLatestOpenedImg - 1;
    if(calcNewImg < 1){
      calcNewImg = img.length;
    }
  }
 
  let getElementCss = window.getComputedStyle(img[calcNewImg]);
  let getImageFullUrl = getElementCss.getPropertyValue("background-image");
  let getImagePos = getImageFullUrl.split("/uploads/");
  let setNewImageUrl = getImagePos[1].replace('")','');

  newImg.setAttribute("src","uploads/" + setNewImageUrl);
  newImg.setAttribute("id","current-image");

  getLatestOpenedImg = calcNewImg;

  newImg.onload = function(){
    imgWidth = this.width;
    let calcImgToEdge = (( windowWidth - imgWidth) / 2) - 80;

    let nextBtn = document.querySelector(".img-nextBtn");
    nextBtn.style.cssText = "right:"+ calcImgToEdge +"px;";
    
    let prevBtn = document.querySelector(".img-prevBtn");
    prevBtn.style.cssText = "left:"+ calcImgToEdge +"px;";
          
  } 
  
}




bars.addEventListener('click',()=>{
    //toggle method
    barList.classList.toggle('barlist-active');

    //animations on the links
  navlinks.forEach((link,index)=>{
      if(link.style.animation){
        link.style.animation = '';

      }else{
        link.style.animation = `listFade 0.5s ease forwards ${index / 7 + 0.2}s`;

      }
    console.log(index);
});
//bars animation
    bars.classList.toggle('toggle');
});

